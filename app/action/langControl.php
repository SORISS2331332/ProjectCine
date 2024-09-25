<?php
session_start();
    $nbSecondesParJour = 24 * 60 * 60;
    $nbJours = 50;
    $expiration = time() + $nbSecondesParJour*$nbJours;
    if(isset($_POST["langue"])){
        $nomLangue = $_POST["langue"];
    }
    else{
        $nomLangue = "Français";
    }
    setcookie("langue",$nomLangue ,$expiration, "/");
    header("Location: ../".$_SESSION['page']);
?>