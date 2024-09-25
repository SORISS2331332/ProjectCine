<?php
$no  = $_GET['index'];
$catalog = simplexml_load_file("../textes/catalogue.xml");
$indiceFilm = $no;
include "../includes/checkCookie.php";
include "..//includes/connexionBD.php";
include "../includes/ajoutCommentaireNote.php";
header("Location: ../details_film.php?index=$no");
exit();
?>