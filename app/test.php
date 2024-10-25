<form action="up.php" method="post" enctype="multipart/form-data">
    <input type="file" name="image" required>
    <input type="submit" value="Upload">
</form>





<div >
        <a href="index.php"><img src="images/logo2.jpg" alt="Cosmos Ciné"></a>
    </div>
    <nav>
        <a class="<?php if($page == "index.php"){echo "active";} ?>" href="index.php"><i class="fa fa-home"></i><?php echo $header->nav->home->$langue; ?></a>
        <a  class="<?php if($page == "catalogue.php"){echo "active";} ?>" href="catalogue.php"><i class="fa fa-book"></i><?php echo $header->nav->catalogue->$langue; ?></a>
        <a  class="<?php if($page == "a_propos.php"){echo "active";} ?>" href="a_propos.php"><i class="fa fa-id-card"></i><?php echo $header->nav->about->$langue; ?></a>
    </nav>
    <form class='langueControl' method='post' action='action/langControl.php'> 
        <div>
        <?php echo $connexionText->formulaire->select->$langue ?> 
        <select class="select" name="langue" >
                <option value="Français" <?php if($langue == "FR"){echo "selected='selected'";}?>>Français</option>
                <option value="Anglais" <?php if($langue == "EN"){echo "selected='selected'";}?>>English</option>
            </select>
        </div>
        <div id="Connect">
            <button type="submit">OK</button>
        </div>
    </form>
    <div class="connexionBouton">
        <form class='langueControl' method='post' action=<?php echo $page?>> 
            <div class="form-group">
                <input type="text" name="session" value='true'>
            </div>
            <?php
                include "includes/connexionBD.php";
                if(isset($_SESSION["noUtilisateur"])){
                    $numero = $_SESSION['noUtilisateur'];
                    $reponse = $connexion->prepare("SELECT * FROM tblUtilisateur WHERE noUtilisateur = ?");
                    $reponse->execute([$numero]);
                    $user = $reponse->fetch();
                    
                    echo("<p>".$header->nav->user->$langue." ".$user["prenom"]."</p>");
                    echo('<div id="Deconnect">
                    <button type="submit">'.$header->nav->logout->$langue.'</button>
                </div>');
                }
                elseif($page == "connexion.php"){
                    echo("<a  class='active' href='connexion.php'><i class='fa fa-user'></i>".$header->nav->login->$langue."</a>");
                }
                else{
                    echo("<a href='connexion.php'><i class='fa fa-user'></i> ".$header->nav->login->$langue."</a>");
                }
            ?>
        </form>
    </div>




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