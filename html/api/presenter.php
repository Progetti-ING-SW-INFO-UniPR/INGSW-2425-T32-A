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
                }else{
                    $articles = $this->model->getEventi();
                    $this->view->response($articles);
                } 
                
                break;

            case 'POST':
                if($this->model->inserimento_evento($data)){
                    echo json_encode(["success" => true, "message" => "L'evento è stato aggiunto con successo"]);
                } else{
                    echo json_encode(["success" => false, "message" => "Errore durante l'inserimento"]);
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
                if ($id != NULL) {
                    if ($this->model->rimozione($id)) {
                       echo json_encode(["success" => true, "message" => "L'evento è stato cancellato con successo"]);
                    } else {
                       echo json_encode(["success" => false, "message" => "Errore"]);
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




function richiesta($method,$data,$database) {
    switch ($method) {
        case "POST":
            if (isset($data["action"]) && $data["action"] == "login") {
                if(login($data,$database)==false){
                    echo json_encode(["success" => false, "message" => "I dati non sono corretti !"]);
                } else{
                    $user=login($data,$database);
                    echo json_encode([
                        "success" => true,
                        "message" => "Connessione stabilita !",
                        "user" => [
                            "id" => $user["id_account"],
                            "nome_utente" => $user["nome_utente"],
                            "indirizzo_mail" => $user["indirizzo_mail"],
                            "tipologia" => $user["tipologia"]
                        ]
                    ]);
                }
               
            } elseif (isset($data["action"]) && $data["action"] == "register") {
               if(registra_account($data,$database))
                     echo json_encode(["success" => true, "message" => "I dati sono stati inseriti correttamento, verrai reindirizzato nella pagina di login..."]);
                else   
                     echo json_encode(["success" => false, "message" => "Errore !"]);
            } 

            break;
        case "GET":
            if(isset($data["id_account"]) && $data["action"]=="getEvent"){
                $articles=getEventiByUser($data["id_account"],$database);
                if (!$articles) {
                    echo json_encode(["success" => false, "message" => "Aucun événement trouvé"]);
                } else {
                    echo json_encode(["success" => true, "eventi" => $articles]);
                }
                exit;
            }
            break;
        case "DELETE":
            
            break;
        default:
            echo json_encode(["error" => "Metodo non supportato"]);
    }
}