<?php
    session_start();
    //include "includes/changerSession.php";
    $index = simplexml_load_file("./textes/index.xml");
?>
<?php include "includes/checkCookie.php"?>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $index->titre->$langue; ?> | Cosmos Ciné</title>
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    
    <!-- Start Header -->
    <?php
        include "includes/header.php"
    ?>
    <!-- End Header -->

    <!-- Start Container -->
    <div class="contain">
        <div class="container-image">
            <img src="images/imglogo.jpg" alt="">
        </div>
        <div class="container-text">
            <article  >
                <p><?php echo $index->textes->texte[0]->$langue; ?></p>
                <p><?php echo $index->textes->texte[1]->$langue; ?></p>
                <button><a href="connexion.php"><?php echo $index->bouton->$langue; ?></a></button>
            </article>
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
