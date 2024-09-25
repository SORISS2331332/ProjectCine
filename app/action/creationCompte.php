<?php

session_start();

include "../includes/connexionBD.php";

if(isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["nom"]) && isset($_POST["prenom"])  &&
isset($_POST["rue"]) && isset($_POST["ville"])  && isset($_POST["pays"]) ){
    $email = $_POST["email"];
    $password = $_POST["password"];
    $prenom = $_POST["prenom"];
    $nom = $_POST["nom"];
    $rue = $_POST["rue"];
    $ville = $_POST["ville"];
    $pays = $_POST["pays"];
    $noCivique = $_POST["NoCivique"];
    $CodePostal = $_POST["CodePostal"];
    $province = $_POST["province"];

    if($email == "" || $password == "" || $prenom == "" || $nom == "" || $rue == "" && $ville == "" && $noCivique == "" ){
        header("Location: ../inscription.php?message=Veuillez remplir les champs avec * !");
        exit();
    }
    else{
        //Insérer d'abord l'adresse car elle est une clé étrangère de Utilisateur
        $requete1 = "INSERT INTO tblAdresse(rue,noCivique,codePostal,province,pays,ville) VALUES
        (?,?, ?,?, ?,?)";
        $reponse1 = $connexion->prepare($requete1);
        $reponse1->execute([$rue,$noCivique,$CodePostal,$province,$pays,$ville]);

        //Récuperer le numero de l'adresse entrée ci-haut !
        $resultat = $connexion->prepare("SELECT noAdresse FROM tblAdresse ORDER BY noAdresse DESC LIMIT 1");
        $resultat->execute();
        $adresse = $resultat->fetch();
        $nombre = $adresse['noAdresse'];

        //Insertion de l'utilisateur avec son numero d'adresse
        $requete2 = "INSERT INTO tblUtilisateur(nom, prenom, courriel,motDePasse,noAdresse) VALUES
        (?,?, ?,?, ?)";
        $reponse2 = $connexion->prepare($requete2);
        $password = password_hash($password, PASSWORD_DEFAULT);
        $reponse2->execute([$nom,$prenom,$email,$password,$nombre]);

        //Redirection a la page de connexion !
        header("Location: ../connexion.php");
        exit();
    }
}
?>
