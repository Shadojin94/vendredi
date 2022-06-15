<?php
session_start();
$bdd = new PDO('mysql:host=db5008791486.hosting-data.io;dbname=dbs7409810;charset=utf8','dbu1696701', '$Shadow94');
if(isset($_POST['valider'])){
    if(!empty($_POST['pseudo'])){

        $getUser = $bdd->prepare('SELECT * FROM users WHERE pseudo = ?');
        $getUser->execute(array($_POST['pseudo']));

        if($getUser->rowCount()>0){

            $_SESSION['pseudo'] = $_POST['pseudo'];
            $_SESSION['id'] = $getUser->fetch()['id'];
            header('Location: index.php?id=1');

        }else{
            echo "Aucun utilisateur";  
        }

    }else{
        echo "Veuillez mettre un pseudo";
    }

}
?>
<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
        <title>Test de connexion PHP Chat</title>
    </head>
    <body>
        <form method="POST" action="" align="center">
            <label>Connexion (Patrick, Jane, Marie)</label><br>
            <input type="text" name="pseudo" placeholder="Pseudo">
            <br>
            <input type="submit" name="valider"><br><br>
            <a href="users.php" style="text-align:center;" >Creer un utilisateur</a>
        </form>
        <br/>
        
    </body>
</html>