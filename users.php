<?php

$bdd = new PDO('mysql:host=db5008791486.hosting-data.io;dbname=dbs7409810;charset=utf8', 'dbu1696701', '$Shadow94');

// CREER UN USER 

if (isset($_POST['submit'])) {

    include('upload.php');

    if (isset($target_file)) {

        $setavatar = $target_file;
    }
    if ($uploadOk == 0) {
        $setavatar = "img/2002300-belle-femme-avatar-personnage-icone-gratuit-vectoriel.jpg";
        $notifupload = "Vous n'avez pas d'avatar";
    }

    if (!empty($_POST['pseudo'])) {
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $setuser = $bdd->prepare('INSERT INTO users(pseudo, avatar)VALUES(?,?)');
        $setuser->execute(array($_POST['pseudo'],  $setavatar));
    }
}

//END CREER UN USER 

?>
<form id="create_user" action="" method="post" enctype="multipart/form-data">
    <input type="text" name="pseudo" placeholder="Pseudo" value="">
    Select image to upload:
    <input type="file" name="picture" id="avatar">
    <input type="submit" value="Enregistrer" name="submit">
</form>

<?php
if (!empty($notifupload)) {
    echo $notifupload;
}
//VOIR LES UTILISATEURS
$getUser = $bdd->query('SELECT * FROM users');
while ($user = $getUser->fetch()) {
?>
    <div class="row sideBar-body">
        <div class="col-sm-3 col-xs-3 sideBar-avatar">
            <div class="avatar-icon">
                <img src="<?php echo $user['avatar']; ?>">
            </div>
        </div>
        <div class="col-sm-9 col-xs-9 sideBar-main">
            <div class="row">
                <div class="col-sm-8 col-xs-8 sideBar-name">
                    <a href=".?id=<?php echo $user['id']; ?>"><span class="name-meta"><?php echo $user['pseudo']; ?></span></a>
                </div>
                <div class="col-sm-4 col-xs-4 pull-right sideBar-time">
                    <span class="time-meta pull-right">18:18
                    </span>
                </div>
            </div>
        </div>
    </div>

<?php
}
//END VOIR LES UTILISATEURS   
?>