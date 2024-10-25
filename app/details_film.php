<?php
    session_start();
    
    //include "includes/changerSession.php";
    $catalog = simplexml_load_file("./textes/catalogue.xml");
    $filmsXml = simplexml_load_file("./textes/films.xml");
    $acteurs = simplexml_load_file("./textes/acteurs.xml");

    function afficherFilm($indice,$titre,$note,$type,$detailType,$detail,$numero){
        include "includes/connexionBD.php";
        $recupImg = $connexion->prepare("SELECT * FROM tblLienImage WHERE noFilm=? LIMIT 3");
        $recupImg->execute([$numero]);
        $tabImg = array(4);
        $i = 0;
        while($img = $recupImg->fetch()){
            $tabImg[$i] = $img["lien"];
            $i++;
        }
        echo ('
            
            <div class="carte">
                    <div class="image-wrapper">
                        <div class="container"> 

                            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                    <img id="ima1" src="'.$tabImg[0].'" class="d-block w-100" alt="image 1">
                                    </div>
                                    <div class="carousel-item">
                                    <img id="ima2" src="'.$tabImg[1].'" class="d-block w-100" alt="image 2">
                                    </div>
                                    <div class="carousel-item">
                                    <img id="ima3" src="'.$tabImg[2].'" class="d-block w-100" alt="image 3">
                                    </div>
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                            
                        </div>
                    </div>
                    
                    <div class="text">
                        <h1>'.$titre.'</h1>
                        <div>
                            <p>'.$type.' : '.$detailType.'</p>
                            <p class="note">Note : '.afficherNoteFilm($note).' ('.$note.' / 5)</p>
                        </div>
                        <div id="details-button-wrapper">
                            <button><a href ="details_film.php?index='.$numero.'">'.$detail.'</a></button>
                        </div>
                    </div>
            </div>
            
       ');
    }
    function afficherNoteFilm($note){
        if($note < 2){
            return "★☆☆☆☆";
        }
        else if($note >= 2 && $note < 2.5){
            return "★★☆☆☆";
        }
        else if($note >= 2.5 && $note < 3.5){
            return"★★★☆☆";
        }
        else if($note >= 3.5 && $note < 4.5){
            return"★★★★☆";
        }
        else if($note >= 4.5 ){
            return"★★★★★";
        }
    }
?>
<?php include "includes/checkCookie.php"?>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $catalog->info->$langue; ?> | Cosmos Ciné</title>
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    
    <!-- Start Header -->
    <?php
        include "includes/header.php"
    ?>
    <!-- End Header -->

    <!-- Start Container -->
    <div class="details">
            <?php
            include "includes/connexionBD.php";
            

            //Trouver le nombre maximal de film afin de traiter des gros nombres entrés
            //manuellement dans l'url
            $resultat = $connexion->prepare("SELECT noFilm FROM tblFilm ORDER BY nofilm DESC LIMIT 1");
            $resultat->execute();
            $film = $resultat->fetch();
            $nombre = $film['noFilm'];

            if(isset($_GET['index'])  && $_GET['index'] > 0 && $nombre >= $_GET['index']){
                $indiceFilm = $_GET['index'];
                

                //Ajout de commentaire avant d'afficher le film
                $reponse = $connexion->prepare("SELECT * FROM tblFilm film INNER JOIN tblType typ ON film.noType = typ.noType
                WHERE noFilm = ?");
                $reponse->execute([$indiceFilm]);
                $indice =0;
                while($film = $reponse->fetch()){
                    afficherFilm($indice,$film["titre"],$film["note"],$film["nom"],$film["description"],$filmsXml->detail->$langue, $film["noFilm"]);
                    $indice++;
                }
                    //Système de commentaire
                    include "commentaire.php"; 
                }
                //Masquer les erreurs si l'index a été saisi incorrectement manuellement dans l'url
                else{
                    echo "<h1 class='erreurMessage'>".$catalog->erreur->$langue ."</h1>";
                }
                echo "</div>"
        ?>
    </div>
    <!-- End Container -->

    <!-- Start Footer -->
    <?php
        include "includes/footer.php"
    ?>
    <!-- End Footer -->
</body>
</html>
