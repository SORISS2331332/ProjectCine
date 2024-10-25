<?php 
    session_start();
    session_destroy();
    $connexionText = simplexml_load_file("./textes/connexion.xml");
?>
<?php include "includes/checkCookie.php"?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $connexionText->titre->$langue ?>| Cosmos Ciné</title>
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <!-- Start Header -->
    <?php
        include "includes/header.php";
        
    ?>
    <!-- End Header -->

    <!-- Start Container -->
    <div class="form-container">
        <h1><?php echo strtoupper($connexionText->titre->$langue) ?></h1>
        
        <div>
            <p class="message">
                <?php 
                    if(isset($_GET['message1'])){
                        echo($connexionText->messages->message[0]->$langue); 
                    }
                    elseif(isset($_GET['message2'])){
                        echo($connexionText->messages->message[1]->$langue); 
                    }
                    else{
                        echo("");
                    }
                ?>
            </p>
            <form action="action/connexion-action.php" method="post">
                <div>
                    <label for="email"><?php echo $connexionText->formulaire->email->$langue ?> :</label>
                    <input type="email" name= "email">
                </div>
                <div>
                    <label for="password"><?php echo $connexionText->formulaire->password->$langue ?>:</label>
                    <input minlength="5" type="password" name= "password">
                </div>
                <div>
                    <p class="lienCreation">
                        <?php echo $connexionText->formulaire->compte1->$langue ?>
                        <a href="inscription.php"><?php echo $connexionText->formulaire->compte2->$langue ?></a>
                    </p>
                </div>
                <div id="Connexion">
                    <button type="submit"><?php echo $connexionText->formulaire->login->$langue ?></button>
                </div>
            </form>
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