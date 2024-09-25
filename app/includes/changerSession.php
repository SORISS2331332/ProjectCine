<?php 
    if(isset($_POST["session"])){
        session_destroy();
        header("Location: connexion.php");
    exit();
    }
    
?>