<?php 

include "database.php";


class model{
    
    private $pdo;

    public function __construct($database){
        $this->pdo=$database;
    }


    public function getEventi() {
        $res=$this->pdo->query("SELECT * FROM eventi");
        $result=$res->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getEventiById($id) {
        $res=$this->pdo->prepare("SELECT * FROM eventi WHERE id_evento=$id");
        $res->execute();
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
    
        $req = $this->pdo->prepare("INSERT INTO eventi SET titolo=?, descrizione=?, luogo_svolgimento=?, data_svolgimento=?, immagine=?, autore=?,data_creazione=NOW()");
        
        $success =  $req->execute([
            $data["titolo"], 
            $data["descrizione"], 
            $data["luogo"],
            $data["datetime"],
            $data["immagine"],
            $data["autore"]
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