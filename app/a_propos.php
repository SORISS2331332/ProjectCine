<?php   
    $about = simplexml_load_file("./textes/a_propos.xml");
    session_start()
    
?>
<?php include "includes/changerSession.php"?>
<?php include "includes/checkCookie.php"?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $about->titre->$langue ." | Cosmos Ciné"; ?></title>
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
    <div class="table_container" >
        <div>
            <h1><?php echo $about->titre->$langue; ?></h1>
        </div>
        <table >
            <tr>
            <?php
            for($i = 0; $i < Count($about->table->colonne); $i++){
                echo ("<th>".$about->table->colonne[$i]->titre->$langue."</th>"); 
            }
            ?>
            </tr>
            <tr>
                <?php
                for($i = 0; $i < Count($about->table->colonne); $i++){
                    echo ("<td>".$about->table->colonne[$i]->contenu->$langue."</td>"); 
                }
                ?>
            </tr>
        </table>
    </div>
    <!-- End Container -->

    <!-- Start Footer -->
    <?php
        include "includes/footer.php"
    ?>
    <!-- End Footer -->
</body>
</html>