<?php

include "database.php";
include "model.php";

$resultat=getEventi($db);


echo "J'ai récuperé des résultats de la table eventi a travers une fonction et je les ai envodé en Json";

echo $resultat;


//Okay, pour aujourd'hui je m'arrete au niveau du point d'entrée de l'api,
//J'ai rencontré principalement deux problèmes, celui di non file found, c'est à dire pour le résoudre, il faudrait éviter de créer
//beaucoup de dossiers et ne créer que des fichiers qui portent chacun les appelations de model, view e presenter
//ensuite le deuxième problème, c'était la récuperation des objets json a travers la fonction du model d'abord, puisque on ne doit pas 
// toucher directement au modele qui est celui qui fait la gestion directe des données avec la base des données et ne toucher quau presentateur
// qui lui fait le lien entre la vue et le model, 
//la vue s'occupe simplement de renvoyer une fonction qui renvoie la réponses au serveur http et le type de données qui dans ce cas est json