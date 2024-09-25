<?php 
    session_start();
    $acteurs = simplexml_load_file("./textes/acteurs.xml");
?>
<?php include "includes/checkCookie.php"?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $acteurs->titre->$langue ?>| Cosmos Ciné</title>
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
</head>
<body>
    <!-- Start Header -->
    <?php
        include "includes/changerSession.php";
        include "includes/header.php";
    ?>
    <!-- End Header -->

    <!-- Start Container -->
    <div class="table_container">
        <div><h1><?php echo $acteurs->tableau->titre->$langue ?></h1></div>
        <div class ="studio">
            <table>
                <tr>
                    <th><?php echo $acteurs->tableau->prenom->$langue ?></th>
                    <th><?php echo $acteurs->tableau->nom->$langue ?></th>
                    <th><?php echo $acteurs->tableau->taille->$langue ?></th>
                    <th><?php echo $acteurs->tableau->nation->$langue ?></th>
                    <th><?php echo $acteurs->tableau->age->$langue ?></th>
                    <th><?php echo $acteurs->tableau->ville->$langue ?></th>
                </tr>

                <?php 
                    include "includes/connexionBD.php";
                    $maRequete = "SELECT *, TIMESTAMPDIFF(year,dateNaissance, now()) AS Age, 'colorCellule' AS classe  FROM tblActeur AS Ac
                        INNER JOIN tblAdresse Ad ON Ad.noAdresse = Ac.noAdresse
                        WHERE taille <= (SELECT AVG(taille) AS tailleMoyenne FROM tblActeur)
                        UNION 
                        SELECT *, TIMESTAMPDIFF(year,dateNaissance, now()) As Age, '' AS classe  FROM tblActeur As Ac
                        INNER JOIN tblAdresse Ad ON Ad.noAdresse = Ac.noAdresse
                        WHERE taille > (SELECT AVG(taille) AS tailleMoyenne FROM tblActeur)
                        ORDER BY prenom,nom";
                    $reponse = $connexion->prepare($maRequete);
                    $reponse->execute();
                    
                    while($acteur = $reponse->fetch()){
                        echo("
                        <tr>
                            <td>".$acteur['prenom']."</td>
                            <td>".$acteur['nom']."</td>".
                            "<td class = ".$acteur['classe']." >".$acteur['taille']."</td>
                            <td>".$acteur['nationalite']."</td>
                            <td>".$acteur['Age']."</td>".
                            "<td>".$acteur['ville']."</td>
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