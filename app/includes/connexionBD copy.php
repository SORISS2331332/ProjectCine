<?php

$server = "dicjlinux01.cegepjonquiere.ca";
$user = "2331332";
$password = "idée16";

try {
    $connexion = new PDO("mysql:host=$server;dbname=2023_2331332_BDFilms",$user,$password);

}
catch (PDOException $erreur){
    die("Connexion échouée. Erreur : ". $erreur ->getMessage());
}
?>