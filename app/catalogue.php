<?php
    session_start();
    $catalog = simplexml_load_file("./textes/catalogue.xml");
    $filmsXml = simplexml_load_file("./textes/films.xml");
    $selection = simplexml_load_file("./textes/selection.xml");
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
    <title><?php echo $catalog->titre->$langue; ?> | Cosmos Ciné</title>
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
    <div class="containeur">
        <nav class="navbar navbar-light ">

            <div class="container-fluid">
                <form class="d-flex">
                    <!-- A gerer la recherche-->
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                </form>
            </div>
        </nav>

        <div class="catalogue-wrapper">
        <?php 
            include "includes/connexionBD.php";
            
            if(isset($_POST["filtre"])){
                $filtre = $_POST["filtre"];
                $reponse1 = $connexion->prepare("SELECT * FROM tblFilm film INNER JOIN tblType typ ON film.noType = typ.noType
                WHERE typ.nom=?");
                $reponse1->execute([$filtre]);
                $indice= 0;
                while($film = $reponse1->fetch()){
                    afficherFilm($indice,$film["titre"],$film["note"],$film["nom"],$film["description"],$filmsXml->detail->$langue, $film["noFilm"]);
                    $indice++;
                }
            }
            else if(isset($_POST["tri"])){
                $tri = $_POST["tri"];
                $reponse2 = $connexion->prepare("SELECT * FROM tblFilm film INNER JOIN tblType typ ON film.noType = typ.noType
                ORDER BY $tri DESC");
                $reponse2->execute();
                $indice= 0;
                while($film = $reponse2->fetch()){
                    afficherFilm($indice,$film["titre"],$film["note"],$film["nom"],$film["description"],$filmsXml->detail->$langue, $film["noFilm"]);
                    $indice++;
                }
            }
            else{
                $reponse = $connexion->prepare("SELECT * FROM tblFilm film INNER JOIN tblType typ ON film.noType = typ.noType");
                $reponse->execute();
                $indice= 0;
                while($film = $reponse->fetch()){
                    afficherFilm($indice,$film["titre"],$film["note"],$film["nom"],$film["description"],$filmsXml->detail->$langue, $film["noFilm"]);
                    $indice++;
                }
            }
            
        ?>
        </div>
    </div>
    <!-- End Container -->

    <!-- Start Footer -->
    <?php
        include "includes/footer.php"
    ?>
    <!-- End Footer -->
</body>
</html>
