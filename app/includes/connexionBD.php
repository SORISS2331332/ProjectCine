<?php

$server = "localhost";
$user = "root";
$password = "";

try {
    $connexion = new PDO("mysql:host=$server;dbname=BDFilms",$user,$password);

}
catch (PDOException $erreur){
    die("Connexion échouée. Erreur : ". $erreur ->getMessage());
}
?>