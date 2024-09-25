<?php 
    session_start();
    include "includes/changerSession.php";
    $studios = simplexml_load_file("./textes/studios.xml");
?>
<?php include "includes/checkCookie.php"?>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $studios->titre->$langue ?>| Cosmos Ciné</title>
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
</head>
<body>
    <!-- Start Header -->
    <?php
        include "includes/header.php";
        include "includes/connexionBD.php";
    ?>
    <!-- End Header -->

    <!-- Start Container -->
    <div class="table_container">
        <div><h1><?php echo $studios->tableau->titre->$langue ?></h1></div>
        <div class ="studio">
            <table>
                <tr>
                    <th><?php echo $studios->tableau->nom->$langue ?></th>
                    <th><?php echo $studios->tableau->date->$langue ?></th>
                    <th><?php echo $studios->tableau->adresse->$langue ?></th>
                    <th><?php echo $studios->tableau->province->$langue ?></th>
                    <th><?php echo $studios->tableau->pays->$langue ?></th>
                </tr>

                <?php 
                    include "includes/connexionBD.php";
                    $requete = "SELECT *, CONCAT(noCivique, ' ', rue, ',', codePostal) AS Adresse 
                    FROM tblAdresse  Ad INNER JOIN tblStudio St ON St.noAdresse = Ad.noAdresse ORDER BY nom";
                    $reponse = $connexion->prepare($requete);
                    $reponse->execute();
                    
                    while($studio = $reponse->fetch()){
                        echo("
                        <tr>
                            <td>".$studio['nom']."</td>
                            <td>".$studio['dateCreation']."</td>
                            <td>".$studio['Adresse']."</td>
                            <td>".$studio['province']."</td>
                            <td>".$studio['pays']."</td>
                        </tr>
                        ");
                    }
                ?>
                
            </table>
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