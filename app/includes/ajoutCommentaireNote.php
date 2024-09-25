<?php
    if(isset($_POST["user"]) && isset($_POST["comment"]) && isset($_POST["note"])){
        $comment = $_POST["comment"];
        $user = $_POST["user"];
        $date = date("Y-m-d H:i:s");
        $note = $_POST["note"];
        //Insertion du commentaire
        if($comment != "" && $user != ""){
            $requeteInsertion = "INSERT INTO tblCommentaire(date,commentaire,noFilm,noUtilisateur,noteFilm) VALUES
            (?,?, ?,?,?)";
            $insertion = $connexion->prepare($requeteInsertion);
            $insertion->execute([$date,$comment,$indiceFilm,$user,$note]);
        }
        //Insertion Note sans commentaire
        else if($comment == "" && $user != ""){
            $requeteInsertionNote = "INSERT INTO tblCommentaire(date,commentaire,noFilm,noUtilisateur,noteFilm) VALUES
            (?,?, ?,?,?)";
            $insertionNote = $connexion->prepare($requeteInsertionNote);
            $insertionNote->execute([$date,$catalog->com->$langue,$indiceFilm,$user,$note]);
        }

        //Ajout de note
        $noteMoyenne = $connexion->prepare("SELECT titre,note, AVG(noteFilm) AS noteF FROM tblCommentaire AS com 
        INNER JOIN tblFilm AS film ON film.noFilm = com.noFilm
        
        WHERE com.noFilm = ?
        GROUP BY com.noFilm"
        );
        $noteMoyenne->execute([$indiceFilm]);
        if($note = $noteMoyenne->fetch()){
            if($note["noteF"] != null && $note["noteF"] != 0)
            $moyenne = round((($note["noteF"]+$note["note"]) /2),2);
            $requeteNote = $connexion->prepare("UPDATE tblFilm SET note = ? WHERE noFilm = ?");
            $requeteNote->execute([$moyenne,$indiceFilm]);
        }
    }

?>