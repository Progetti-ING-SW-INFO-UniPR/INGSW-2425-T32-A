<?php


header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

require_once "presenter.php";

$resultat=new presenter($db);


$method = $_SERVER['REQUEST_METHOD'];
$data = json_decode(file_get_contents("php://input"),true);

$request_uri = explode("/", $_SERVER["REQUEST_URI"]); 
$id = isset($request_uri[3]) ? intval($request_uri[3]) : NULL;

if($request_uri[2]=="evento"){
    $resultat->handleRequest($method,$data,$id);
}

if($request_uri[2]=="utente"){
    richiesta($method,$data,$db);
}