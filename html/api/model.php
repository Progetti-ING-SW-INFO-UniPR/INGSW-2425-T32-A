<?php 

include "database.php";


    // Créer un article
    function createArticle($title, $body, $db) {
        $query = "INSERT INTO articles (title, body) VALUES (:title, :body)";
        $stmt = $db->query($query);
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":body", $body);
        return $stmt->execute();
    }

    // recuperer tous les evenements
     function getEventi($pdo) {
        $res=$pdo->query("SELECT * FROM eventi");
        $result=$res->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($result);
    }

    // Mettre à jour un article
     function updateArticle($id, $title, $body) {
        $query = "UPDATE articles SET title = :title, body = :body WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":body", $body);
        return $stmt->execute();
    }

    // Supprimer un article
     function deleteArticle($id) {
        $query = "DELETE FROM eventi WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }

