<?php 
    session_start();
    include "includes/changerSession.php"; 
    $inscription = simplexml_load_file("./textes/inscription.xml");
?>
<?php include "includes/checkCookie.php"?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $inscription->titre[0]->$langue ?>| Cosmos Ciné</title>
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
</head>
<body>
    <!-- Start Header -->
    <?php
        include "includes/header.php"
    ?>
    <!-- End Header -->

    <!-- Start Container -->
    <div class="form-container register">
        <h1><?php echo strtoupper($inscription->titre[0]->$langue) ?></h1>
        
        <div>
            <p class="message">
                <?php 
                    if(isset($_GET['message'])){
                        echo($inscription->message->$langue); 
                    }
                    else{
                        echo("");
                    }
                ?>
            </p>
            <form class="form" action="action/creationCompte.php" method="post">
                <section>
                    <div class="infos">
                        <div><h1><?php echo $inscription->titre[2]->$langue ?></h1></div>
                        <div>
                            <label for="prenom"><?php echo $inscription->formulaire->prenom->$langue ?> <span class="obligatoire">*</span></label>
                            <input type="text" name= "prenom">
                        </div>
                        <div>
                            <label for="nom"><?php echo $inscription->formulaire->nom->$langue ?> <span class="obligatoire">*</span></label>
                            <input type="text" name= "nom">
                        </div>
                        <div>
                            <label for="email"><?php echo $inscription->formulaire->email->$langue ?> <span class="obligatoire">*</span></label>
                            <input type="email" name= "email">
                        </div>
                        <div>
                            <label for="password"><?php echo $inscription->formulaire->password->$langue ?></label>
                            <span class="obligatoire">*</span>
                            <input type="password" name= "password">
                        </div>
                    </div>
                    <div class="adresse">
                        <h1><?php echo $inscription->titre[1]->$langue ?></h1>
                        <div>
                            <label for="rue"><?php echo $inscription->formulaire->rue->$langue ?> <span class="obligatoire">*</span></label>
                            
                            <input type="text" name= "rue" >
                        </div>
                        <div>
                            <label for="NoCivique"><?php echo $inscription->formulaire->numero->$langue ?><span class="obligatoire">*</span></label>
                            <input type="text" name= "NoCivique" >
                        </div>
                        <div>
                            <label for="CodePostal"><?php echo $inscription->formulaire->poste->$langue ?> </label>
                            <input type="text" name= "CodePostal" >
                        </div>
                        <div>
                            <label for="province"><?php echo $inscription->formulaire->province->$langue ?></label>
                            <input type="text" name= "province" >
                        </div>
                        <div>
                            <label for="ville"><?php echo $inscription->formulaire->ville->$langue ?> <span class="obligatoire">*</span></label>
                            <input type="text" name= "ville" >
                        </div>
                        <div>
                            <label for="pays"><?php echo $inscription->formulaire->pays->$langue ?> </label>
                            <input type="text" name= "pays" >
                        </div>
                    </div>
                </section>
                
                <div id="Connexion" class="register">
                    <button type="submit"><?php echo $inscription->formulaire->login->$langue ?></button>
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