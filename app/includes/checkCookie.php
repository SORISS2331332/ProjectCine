<?php
    $langue = "FR";
    if(isset($_COOKIE["langue"])){
        if($_COOKIE["langue"] == "Anglais"){
            $langue = "EN";
        }
    }
?>