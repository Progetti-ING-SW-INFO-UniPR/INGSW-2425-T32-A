<?php 

$host="ids-db-1";
$nome_database="test";
$nome="root";
$password="root_password";

$db= new PDO("mysql:dbname=$nome_database;host=$host", "$nome", "$password");


