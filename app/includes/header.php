<header class="Entete">
    <?php 
        $header = simplexml_load_file("./textes/header.xml");
        $connexionText = simplexml_load_file("./textes/connexion.xml");
        $segments = explode('/', $_SERVER['REQUEST_URI']);
        $page = $segments[count($segments) - 1];
        $_SESSION["page"] = $page; 
    ?>
    <?php include "checkCookie.php" ?>
    <div >
        <a href="index.php"><img src="images/logo.jpeg" alt="Cosmos Ciné"></a>
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
    
    
</header>