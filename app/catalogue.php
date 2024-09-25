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
        echo ("
            
            <div class='carte'>
                    <div class='image-wrapper'>
                        <div class='container'> 
                            <div id='myCarousel".$indice."' class='carousel slide' data-ride='carousel'>
                                <!-- Indicators -->
                                <ol class='carousel-indicators'>
                                    <li data-target='#myCarousel".$indice."' data-slide-to='0' class='active'></li>
                                    <li data-target='#myCarousel".$indice."' data-slide-to='1'></li>
                                    <li data-target='#myCarousel".$indice."' data-slide-to='2'></li>
                                </ol>
                        
                                <!-- Wrapper for slides -->
                                <div class='carousel-inner'>
                                    <div  class='item active'>
                                        <img id='ima1' src='".$tabImg[0]."' alt='".$titre."'>
                                    </div>
                                    <div  class='item'>
                                        <img id='ima2' src='".$tabImg[1]."' alt='".$titre."'>
                                    </div>
                                    <div  class='item'>
                                        <img id='ima3' src='".$tabImg[2]."' alt='".$titre."'>
                                    </div>
                                </div>
                        
                                <!-- Left and right controls -->
                                <a class='left carousel-control' href='#myCarousel".$indice."' data-slide='prev'>
                                    <span class='glyphicon glyphicon-chevron-left'></span>
                                    <span class='sr-only'>Previous</span>
                                </a>
                                <a class='right carousel-control' href='#myCarousel".$indice."' data-slide='next'>
                                    <span class='glyphicon glyphicon-chevron-right'></span>
                                    <span class='sr-only'>Next</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <div class='text'>
                        <h1>$titre</h1>
                        <div>
                            <p>$type : $detailType</p>
                            <p class='note'>Note : ".afficherNoteFilm($note)." (".$note." / 5)</p>
                        </div>
                        <div id='details-button-wrapper'>
                            <button><a href ='details_film.php?index=".$numero."'>".$detail."</a></button>
                        </div>
                    </div>
            </div>
            
        ");
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
    include "includes/changerSession.php";
?>
<?php include "includes/checkCookie.php"?>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $catalog->titre->$langue; ?> | Cosmos Ciné</title>
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    <link rel = 'stylesheet' href = 'https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css'>
    <script src = 'https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js'></script>
    <script src = 'https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js'></script>
</head>
<body>
    <!-- Start Header -->
    <?php
        include "includes/header.php"
    ?>
    <!-- End Header -->

    <!-- Start Container -->
    <div class="containeur">
        <div class="selection">
            <form class='langueControl' method='post' action='catalogue.php'> 
                <div>
                <?php echo $selection->filtre->titre->$langue ?> 
                <select class="select" name="filtre" >
                        <option value="Action">Action</option>
                        <option value="Animation">Animation</option>
                        <option value="Documentaire"><?php echo $selection->filtre->options->option[0]->$langue ?></option>
                        <option value="Drame"><?php echo $selection->filtre->options->option[1]->$langue ?></option>
                        <option value="Horreur"><?php echo $selection->filtre->options->option[2]->$langue ?></option>
                        <option value="Comédie"><?php echo $selection->filtre->options->option[3]->$langue ?></option>
                        <option value="Science-fiction">Science-fiction</option>
                    </select>
                </div>
                <div id="Connect">
                    <button type="submit">OK</button>
                </div>
            </form>
            <form class='langueControl' method='post' action='catalogue.php'> 
                <div>
                <?php echo $selection->trier->titre->$langue ?>
                <select class="select" name="tri" >
                    <option value="titre"><?php echo $selection->trier->options->option[0]->$langue ?></option>
                    <option value="note"><?php echo $selection->trier->options->option[1]->$langue ?></option>
                    </select>
                </div>
                <div id="Connect">
                    <button type="submit">OK</button>
                </div>
            </form>
        </div>
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
