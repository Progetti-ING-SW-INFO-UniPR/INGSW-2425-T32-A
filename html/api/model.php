<?php 

include "database.php";


class model{
    
    private $pdo;

    public function __construct($database){
        $this->pdo=$database;
    }


    public function getEventi() {
        $res=$this->pdo->query("SELECT *, (SELECT COUNT(*) FROM eventi) AS totale FROM eventi JOIN account WHERE autore=id_account ORDER BY data_creazione DESC");
        $result=$res->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getEventiById($id) {
        $res=$this->pdo->prepare("SELECT * FROM eventi JOIN account WHERE autore=id_account AND id_evento=?;");
        $res->execute([$id]);
        $result=$res->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getEventiByUser($id) {
        $res=$this->pdo->prepare("SELECT * FROM eventi WHERE autore=?");
        $res->execute([$id]);
        $result=$res->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }

    public function aggiornamento_evento($id, $data) {
        $req = $this->pdo->prepare("UPDATE eventi SET titolo=?, descrizione=?, luogo_svolgimento=?, data_svolgimento=?, immagine=?, hashtag=? WHERE id_evento=?");
        
        $success =  $req->execute([
            $data["titolo"], 
            $data["descrizione"], 
            $data["luogo"],
            $data["datetime"],
            $data["immagine"],
            $data["hashtag"],
            $id
        ]);
     
    if ($success) {
        $sql = "SELECT account FROM iscrizione WHERE evento = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]); 
        $utenti = $stmt->fetchAll(PDO::FETCH_COLUMN); 

        $sqlInsert = "INSERT INTO notifica (utente, evento, descrizione, status, data_creazione) 
        VALUES (?, ?, 'Un evento su cui è iscritto è stato aggiornato. Clicca per vederlo !', 1, NOW())";
        $stmtInsert = $this->pdo->prepare($sqlInsert);

        foreach ($utenti as $utente) {
             $stmtInsert->execute([$utente, $id]); 
        }

    }
    
        return $success;
    }

    public function rimozione($id) {
        $query = "DELETE FROM eventi WHERE id_evento = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    function inserimento_evento($data) {
    
        $req = $this->pdo->prepare("INSERT INTO eventi SET titolo=?, descrizione=?, luogo_svolgimento=?, data_svolgimento=?, immagine=?, autore=?, hashtag=?, data_creazione=NOW()");
        
        $success =  $req->execute([
            $data["titolo"], 
            $data["descrizione"], 
            $data["luogo"],
            $data["datetime"],
            $data["immagine"],
            $data["autore"],
            $data["hashtag"]
        ]);
    
        return $success;
    }
}


 function registra_account($data,$db) {

        $mdp_hashed=password_hash($data["password"],PASSWORD_DEFAULT);
        $req = $db->prepare("INSERT INTO account SET nome_utente=?, indirizzo_mail=?, mdp=?, tipologia=?");
        
        $success =  $req->execute([
            $data["nome_utente"], 
            $data["indirizzo_mail"], 
            $mdp_hashed,
            $data["tipologia"]
        ]);
    
        return $success;
}

function login($data,$db){
        session_start();
        $req = $db->prepare("SELECT * FROM account WHERE indirizzo_mail = ?");
        $req->execute([$data["indirizzo_mail"]]);
        $user = $req->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($data["password"], $user["mdp"])) {
            $_SESSION["id_account"] = $user["id_account"];
            $_SESSION["nome_utente"] = $user["nome_utente"];
            $_SESSION["indirizzo_mail"] = $user["indirizzo_mail"];
            $_SESSION["tipologia"] = $user["tipologia"];

            return $user;
            
        } else {
            return false;
        }
}


function getEventiByUser($id,$db) {
    $res=$db->prepare("SELECT * FROM eventi WHERE autore=?");
    $res->execute([$id]);
    $result=$res->fetchAll(PDO::FETCH_ASSOC);
    
    return $result;
}

function iscrizione($data,$db){
    $res=$db->prepare("SELECT COUNT(*) as totale FROM iscrizione WHERE evento=? AND account=?");
    $res->execute([$data["id_evento"],$data["id_account"]]);
    $success=$res->fetch(PDO::FETCH_ASSOC);

    if($success["totale"]==0){
        $req = $db->prepare("INSERT INTO iscrizione SET evento=?, account=?, data_iscrizione=NOW(), status=1");
        
        $result =  $req->execute([
            $data["id_evento"], 
            $data["id_account"]
        ]);

        return $result;
    }else{
        return false;
    }

}


function iscrizione_esterno($data, $db) {
    $res=$db->prepare("SELECT COUNT(*) as totale FROM iscrizione WHERE evento=? AND account=?");
    $res->execute([$data["evento"],$data["indirizzo_mail"]]);
    $success=$res->fetch(PDO::FETCH_ASSOC);


    if($success["totale"]==0){
        $req = $db->prepare("INSERT INTO iscrizione SET evento=?, account=?, data_iscrizione=NOW(), status=1");
        
        $result =  $req->execute([
            $data["evento"], 
            $data["indirizzo_mail"]
        ]);

        return $result;
    }else{
        return false;
    }
}

function getEventByHashtag($hashtag,$db){
    $res=$db->prepare("SELECT * FROM eventi WHERE hashtag LIKE ?");
    $res->execute(["%".$hashtag."%"]);
    $result=$res->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}


function getNotifica($data,$db){
    $res = $db->prepare("SELECT * 
                           FROM notifica 
                           WHERE utente = ? AND status=1
                           ORDER BY data_creazione DESC");
    $res->execute([$data['id_account']]);
    $notifications = $res->fetchAll(PDO::FETCH_ASSOC);

    return $notifications;
}


function getEventiIscritti($data,$db){
    $res=$db->prepare("SELECT * FROM iscrizione JOIN eventi WHERE iscrizione.evento=eventi.id_evento AND iscrizione.account=?");
    $res->execute([$data["id_account"]]);
    $success=$res->fetchAll(PDO::FETCH_ASSOC);
    return $success;
}

function deleteIscrizione($data,$db){
    $res=$db->prepare("DELETE FROM iscrizione WHERE evento=? AND account=?");
    $success=$res->execute([$data["id_evento"],$data["id_account"]]);
    return $success;
}

function deleteNotifica($data,$db){
    $res=$db->prepare("DELETE FROM notifica WHERE evento=? AND utente=?");
    $success=$res->execute([$data["id_evento"],$data["id_account"]]);
    return $success;
}

function getStatistiche($data,$db){
    $res1=$db->prepare("SELECT COUNT(*) as eventi_disponibili FROM eventi");
    $res1->execute();
    $req1=$res1->fetchColumn();

    $res2=$db->prepare("SELECT COUNT(*) AS eventi_inseriti FROM eventi WHERE autore=?");
    $res2->execute([$data["id_account"]]);
    $req2=$res2->fetchColumn();

    $res3=$db->prepare("SELECT COUNT(*) AS eventi_iscritti FROM iscrizione WHERE account=?");
    $res3->execute([$data["id_account"]]);
    $req3=$res3->fetchColumn();

    $dati=["eventi_disponibili"=>$req1,"eventi_inseriti"=>$req2,"eventi_iscritti"=>$req3];

    return $dati;

}