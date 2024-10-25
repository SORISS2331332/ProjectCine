
    <?php 
        $header = simplexml_load_file("./textes/header.xml");
        $connexionText = simplexml_load_file("./textes/connexion.xml");
        $segments = explode('/', $_SERVER['REQUEST_URI']);
        $page = $segments[count($segments) - 1];
        $_SESSION["page"] = $page; 
    ?>
    <?php include "checkCookie.php" ?>

<nav class="navbar navbar-expand-lg navbar-light  en-tete">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php"><img src="images/logo2.jpg" alt="Cosmos Ciné"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="  navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <!-- class="<?php //if($page == "index.php"){echo "active";} ?>-->
                    
                <a class='nav-link <?php if($page == "index.php"){echo "main";} ?>' aria-current="page"  href="index.php"><i class="fa fa-home"></i><?php echo $header->nav->home->$langue; ?></a>
                </li>
                <li class="nav-item">
                <a class="nav-link <?php if($page == "catalogue.php"){echo "main";} ?>" href="catalogue.php"><i class="fa fa-book"></i><?php echo $header->nav->catalogue->$langue; ?></a>
                </li>
                
                <li class="nav-item">
                <a class= 'nav-link <?php if($page == "a_propos.php"){echo "main";} ?>' href="a_propos.php"><i class="fa fa-id-card"></i><?php echo $header->nav->about->$langue; ?></a>
                </li>
            </ul>
            <div class= "profil">
                <form class='langueControl' method='post' action='action/langControl.php'> 
                    <div>
                        <select class="select" name="langue" >
                            <option value="Français" <?php if($langue == "FR"){echo "selected='selected'";}?>>Français</option>
                            <option value="Anglais" <?php if($langue == "EN"){echo "selected='selected'";}?>>English</option>
                        </select>
                    </div>
                    <div id="Connect">
                        <button type="submit">OK</button>
                    </div>
                </form>

            
                <div class="connexionBouton connexionBtn">
                    <form class='langueControl' method='post' action="connexion.php"> 
                        
                        <?php
                            include "includes/connexionBD.php";
                            if($page == "connexion.php"){
                                echo("<a  class='main' href='connexion.php'><i class='fa fa-user'></i>".$header->nav->login->$langue."</a>");
                            }
                            else{
                                if(isset($_SESSION["noUtilisateur"])){
                                    $numero = $_SESSION['noUtilisateur'];
                                    $reponse = $connexion->prepare("SELECT * FROM tblUtilisateur WHERE noUtilisateur = ?");
                                    $reponse->execute([$numero]);
                                    $user = $reponse->fetch();
                                    
                                    echo("<div><p>".$header->nav->user->$langue." ".$user["prenom"]."</p></div>");
                                    echo('<div id="Deconnect">
                                    <button type="submit">'.$header->nav->logout->$langue.'</button>
                                </div>');
                                }
                                else{
                                    echo("<a href='connexion.php'><i class='fa fa-user'></i> ".$header->nav->login->$langue."</a>");
                                }
                            }
                        ?>
                    </form>
                </div>
            </div>
        </div>
        
        
    </div>
</nav>
