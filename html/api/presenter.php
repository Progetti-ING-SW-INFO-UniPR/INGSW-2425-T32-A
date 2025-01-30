<?php

require_once "database.php";
require_once "model.php";
require_once "view.php";

class Presenter {
    private $model;
    private $view;

    public function __construct($db) {
        $this->model = new model($db);
        $this->view = new view();
    }

    public function handleRequest($method, $data,$id) {
        switch ($method) {
            case 'GET':
                if($id != NULL){
                    $articles=$this->model->getEventiById($id);
                    $this->view->response($articles);
                } else{
                    $articles = $this->model->getEventi();
                    $this->view->response($articles);
                }
              
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

