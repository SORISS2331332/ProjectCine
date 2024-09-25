<?php
    function afficherCommentaire($nom,$date,$commentaire, $note){
        echo ('
                <div class="desc">
                    <h3><i class="fa-solid fa-user"></i> '.$nom.'</h3>
                    <div >
                        <p >
                            <small>'.$date.'</small>
                        </p>
                        <p>'.$commentaire.'</p>'.
                        afficherNote($note).'
                    </div>
                </div><br>
            
        ');
    }

    function afficherNote($note){
        if($note == 1){
            return "<p class=note>★☆☆☆☆</p>";
        }
        if($note == 2){
            return "<p class=note>★★☆☆☆</p>";
        }
        if($note == 3){
            return"<p class=note>★★★☆☆</p>";
        }
        if($note == 4){
            return"<p class=note>★★★★☆</p>";
        }
        if($note == 5){
            return"<p class=note>★★★★★</p>";
        }
    }
    $reponseTotal = $connexion->prepare("SELECT COUNT(noCommentaire) as total FROM tblCommentaire WHERE noFilm = ?");
    $reponseTotal->execute([$indiceFilm]);
    $total = $reponseTotal->fetch();
    echo '<div class="commentaire">';
    echo '<h2>'.$total["total"] .' '.$catalog->nombre->$langue.'</h2>';

    $reponseComment = $connexion->prepare("SELECT * FROM tblCommentaire com INNER JOIN tblUtilisateur Ut ON com.noUtilisateur = Ut.noUtilisateur
    WHERE noFilm = ?");
    $reponseComment->execute([$indiceFilm]);
    while($comment = $reponseComment->fetch()){
        afficherCommentaire($comment["prenom"],$comment["date"],$comment["commentaire"],$comment["noteFilm"]);
    }
    if(isset($_SESSION["noUtilisateur"])){
        $user = $_SESSION["noUtilisateur"];
        if($user != ""){
            echo ('
                <div class="comment-form">
                    <h3>'.$catalog->comTitre->$langue.'</h3>
                    <form  method="post" action="action/detail.php?index='.$indiceFilm.'">
                        <div class="form-group">
                            <input type="text" name="user" value='. $user.'>
                        </div>
                        <div class="form-group">
                            <textarea name="comment" cols="60" rows="10" placeholder="message"></textarea>
                        </div>

                        <div>
                            <h1>'.$catalog->notation->$langue.'</h1>
                            <select name="note" >
                                <option value="1" >1</option>
                                <option value="2" >2</option>
                                <option value="3" >3</option>
                                <option value="4" >4</option>
                                <option value="5" >5</option>
                            </select>
                        </div>
                        <br>
                        <button class="btn">'.$catalog->bouton->$langue.'</button>
                    </form>
                </div>');
            }
    }
    else{
        echo "<h3>".$catalog->connex->$langue."</h3>";
    }

    
?>


