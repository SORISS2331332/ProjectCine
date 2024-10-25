<?php
    $footer = simplexml_load_file("./textes/footer.xml");
?>
<?php include "checkCookie.php" ?>
<footer id="footerPage">
    <div class="footerLinks">
        <section class="informations">
            <ul>
                <li><a href="a_propos.php"><i class="fa fa-user-gear" ></i><?php echo $footer->informations->information[0]->$langue; ?></a></li>
                <li><a href="#"><i class="fa fa-lock"></i><?php echo $footer->informations->information[1]->$langue; ?></a></li>
                <li><a href="#"><i class="fa fa-phone"></i><?php echo $footer->informations->information[2]->$langue; ?></a></li>
            </ul>
        </section>
        <section class="reseaux">
            <ul>
                <li><a href="#"><i class="fa-brands fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                <li><a href="#"><i class="fa-brands fa-youtube"></i></a></li>
            </ul>
        </section>
    </div>
    <form action="">
        <h2><?php echo $footer->titre->$langue; ?></h2>
        <input type="text" placeholder=<?php echo $footer->texte->$langue; ?>>
        <button type="submit"><?php echo $footer->bouton->$langue; ?></button>
    </form>
    <?php
        if(isset($_COOKIE["langue"])){
            if($_COOKIE["langue"] == "Français"){
                echo("<p> &copy; 2024,".$footer->copyright->$langue ."</p>");
            }
            else{
                echo("<p> &copy; 2024, ".$footer->copyright->$langue ."</p>");
            }
        }
        else{
            echo("<p> &copy; 2024, Travaux étudiants,	Tous droits réservés.</p>");
        }
        
    ?>
    
    
</footer>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>