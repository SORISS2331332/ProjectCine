<?php


session_start();

function connecterUtilisateur(){
    include "../includes/connexionBD.php";
    if(isset($_POST["email"]) && isset($_POST["password"])){
        $email = $_POST["email"];
        $pass = $_POST["password"];

        $requete = "SELECT * FROM tblUtilisateur WHERE courriel = ? ";
        $reponse = $connexion->prepare($requete);
        $reponse->execute([$email]);
        if($user = $reponse->fetch()){
            $retour = password_verify($pass, $user["motDePasse"]);
            if($retour){
                $_SESSION["noUtilisateur"] = $user["noUtilisateur"];
                header("Location: ../catalogue.php");
                exit();
            }
            else{
                header("Location: ../connexion.php?message2=Mauvais utilisateur ou mot de passe");
                exit();
            }
        }
        else if($email == "" && $pass == ""){
            header("Location: ../connexion.php?message1= Veuillez fournir  un utlisateur et un mot de passe");
            
            exit();
        }
        else{
            header("Location: ../connexion.php?message2=Mauvais utilisateur ou mot de passe");
            exit();
        }
    }
    else{
        header("Location: ../connexion.php");
        exit();
    }
}
connecterUtilisateur();
?>
