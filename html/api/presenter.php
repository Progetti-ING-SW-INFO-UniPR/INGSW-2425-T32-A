<?php

$host="ids-db-1";
$nome_database="test";
$nome="root";
$password="root_password";

$db= new PDO("mysql:dbname=$nome_database;host=$host", "$nome", "$password");

var_dump($db);

$res=$db->query("SELECT * FROM eventi");

$result=$res->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($result);

class EventoView {
    public function response($data, $status = 200) {
        http_response_code($status);
        echo json_encode($data);
    }

    public function error($message, $status = 400) {
        http_response_code($status);
        echo json_encode(["error" => $message]);
    }
}

class EventoModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Créer un article
    public function createArticle($title, $body) {
        $query = "INSERT INTO articles (title, body) VALUES (:title, :body)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":body", $body);
        return $stmt->execute();
    }

    // recuperer tous les evenements
    public function getEventi() {
        $query = "SELECT * FROM test";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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



class EventoPresenter {
    private $model;
    private $view;

    public function __construct($db) {
        $this->model = new EventoModel($db);
        $this->view = new EventoView();
    }

    public function handleRequest($method, $data) {
        switch ($method) {
            case 'GET':
                $articles = $this->model->getEventi();
                $this->view->response($articles);
                break;

            case 'POST':
                if (!empty($data->title) && !empty($data->body)) {
                    $success = $this->model->createArticle($data->title, $data->body);
                    if ($success) {
                        $this->view->response(["message" => "Article created"], 201);
                    } else {
                        $this->view->error("Failed to create article.");
                    }
                } else {
                    $this->view->error("Invalid data provided.");
                }
                break;

            case 'PUT':
                if (!empty($data->id) && (!empty($data->title) || !empty($data->body))) {
                    $success = $this->model->updateArticle($data->id, $data->title, $data->body);
                    if ($success) {
                        $this->view->response(["message" => "Article updated"]);
                    } else {
                        $this->view->error("Failed to update article.");
                    }
                } else {
                    $this->view->error("Invalid data provided.");
                }
                break;

            case 'DELETE':
                if (!empty($data->id)) {
                    $success = $this->model->deleteArticle($data->id);
                    if ($success) {
                        $this->view->response(["message" => "Article deleted"]);
                    } else {
                        $this->view->error("Failed to delete article.");
                    }
                } else {
                    $this->view->error("Invalid data provided.");
                }
                break;

            default:
                $this->view->error("Invalid request method", 405);
                break;
        }
    }
}

