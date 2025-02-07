<?php

session_start();

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Content-Type: application/json; charset=UTF-8"); 
ob_clean(); 

require_once "presenter.php";

$resultat=new presenter($db);

$method = $_SERVER['REQUEST_METHOD'];
$data = json_decode(file_get_contents("php://input"),true);

$request_uri = explode("/", $_SERVER["REQUEST_URI"]); 
$id = isset($request_uri[3]) ? intval($request_uri[3]) : NULL;

if($request_uri[2]=="evento"){
    if($_FILES["image"]["name"]!=NULL){
        $target_dir = "../img/";
        $file_name = basename($_FILES["image"]["name"]);
        $target_file = $target_dir . $file_name;
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
    }else{
        $file_name="default";
    }
       
    $data = [
        "titolo" => $_POST['title'] ?? null,
        "luogo" => $_POST['luogo'] ?? null,
        "hashtag" => $_POST['hashtag'] ?? null,
        "datetime" => $_POST['datetime'] ?? null,
        "autore" => $_SESSION['id_account'] ?? null,
        "descrizione" => $_POST['descrizione'] ?? null,
        "immagine" => $file_name 
    ];

    $resultat->handleRequest($method,$data,$id);
}

if($request_uri[2]=="utente"){
    richiesta($method,$data,$db);
}

if($request_uri[2]=="backend"){
    $data=["action" => "getEvent",
    "id_account"=>$_SESSION['id_account']];
    
    richiesta($method,$data,$db)  ;  
}
