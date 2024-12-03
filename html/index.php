<?php 
echo "Jérémie Fwwapa Korangi";

$host="ids-db-1";
$dbname="reti";
$user="root";
$mdp="root_password";

$pdo=new PDO("mysql:dbname=$dbname;host=$host", "$user", "$mdp");

$result=$pdo->query('SELECT * FROM test')->fetchAll();

var_dump($result);

class Personne{
    var $prenom;
    var $age;

    function print(){
        echo "Je m'appelle $this->prenom et j'ai $this->age ans";
    }


    function __construct(public $nom, public $ag){
        $this->prenom=$nom;
        $this->age=$ag;
    }
   
}

$jeremie= new Personne("jeremie", 24);
$jeremie->print();


function calcolatrice ($var1, $var2){
    return $var1+$var2;
}

function modifica ($var1, $var2){
    $contatore=0;

    while($contatore < $var2){
        $var1[$contatore]=$var1[$contatore]+1;
        $contatore++;
    }

    return $var1;
}

function hashing($var1,$metodo){
    if($metodo==1)
        return password_hash($var1,PASSWORD_DEFAULT);
    if($metodo==2)
        return password_hash($var1,PASSWORD_BCRYPT);
}

$test = calcolatrice(1,2);


$arr = [1,2,3,4]; 
$result = modifica($arr,4);

$contatore=0;
while($contatore < 4){
    echo $result[$contatore];
    $contatore++;
}

echo '\n';

$pass=hashing("Jérémie",1);


if (password_verify("Jérémie",$pass))
    echo "La password corrisponde";
else    
    echo "La password non corrisponde";