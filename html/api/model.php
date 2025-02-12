<?php 

include "database.php";


class model{
    
    private $pdo;

    public function __construct($database){
        $this->pdo=$database;
    }


    public function getEventi() {
        $res=$this->pdo->query("SELECT *, (SELECT COUNT(*) FROM eventi) AS totale FROM eventi JOIN account WHERE autore=id_account;");
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

    public function updateArticle($id, $title, $body) {
        $query = "UPDATE articles SET title = :title, body = :body WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":body", $body);
        return $stmt->execute();
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