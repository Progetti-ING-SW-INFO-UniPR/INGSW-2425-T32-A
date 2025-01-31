<?php 

include "database.php";


class model{
    
    private $pdo;

    public function __construct($database){
        $this->pdo=$database;
    }

    // Créer un article
    public function createArticle($title, $body, $db) {
        $query = "INSERT INTO articles (title, body) VALUES (:title, :body)";
        $stmt = $db->query($query);
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":body", $body);
        return $stmt->execute();
    }

    // recuperer tous les evenements
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

    // Mettre à jour un article
    public function updateArticle($id, $title, $body) {
        $query = "UPDATE articles SET title = :title, body = :body WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":body", $body);
        return $stmt->execute();
    }

    // Supprimer un article
    public function deleteArticle($id) {
        $query = "DELETE FROM eventi WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}


 function registra_account($data,$db) {
        $req = $db->prepare("INSERT INTO account SET nome_utente=?, indirizzo_mail=?, mdp=?, tipologia=?");
        $success =  $req->execute([
            $data["nome_utente"], 
            $data["indirizzo_mail"], 
            $data["password"], 
            $data["tipologia"]
        ]);
    
        return $success;
}