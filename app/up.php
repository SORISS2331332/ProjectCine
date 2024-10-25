<?php
// Dossier de destination
$targetDir = "images/"; // Assure-toi que ce dossier existe
$targetFile = $targetDir . basename($_FILES["image"]["name"]);
$uploadOk = 1;

// Vérifie si le fichier est une image
$imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        echo "Le fichier est une image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "Ce n'est pas une image.";
        $uploadOk = 0;
    }
}

// Vérifie si le fichier existe déjà
if (file_exists($targetFile)) {
    echo "Désolé, le fichier existe déjà.";
    $uploadOk = 0;
}

// Limite la taille du fichier (5 Mo par exemple)
if ($_FILES["image"]["size"] > 5000000) {
    echo "Désolé, votre fichier est trop gros.";
    $uploadOk = 0;
}

// Autorise certains formats de fichier
if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
    echo "Désolé, seuls les fichiers JPG, JPEG, PNG et GIF sont autorisés.";
    $uploadOk = 0;
}

// Vérifie si $uploadOk est à 0 en cas d'erreur
if ($uploadOk == 0) {
    echo "Désolé, votre fichier n'a pas été téléchargé.";
// Si tout est ok, essaie de télécharger le fichier
} else {
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
        echo "Le fichier " . htmlspecialchars(basename($_FILES["image"]["name"])) . " a été téléchargé.";
    } else {
        echo "Désolé, une erreur s'est produite lors du téléchargement de votre fichier.";
    }
}
?>