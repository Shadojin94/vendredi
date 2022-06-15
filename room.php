<?php

$bdd = new PDO('mysql:host=db5008791486.hosting-data.io;dbname=dbs7409810;charset=utf8', 'dbu1696701', '$Shadow94');

// CREER UN SALON 
if (isset($_POST['submit'])) {

    include('upload.php');

    if (isset($target_file)) {

        $setpicture = $target_file;
    }
    if ($uploadOk == 0) {
        $setpicture = "img/room.png";
        $notifupload = "Vous n'avez pas d'image de salon";
    }

    if (!empty($_POST['room'])) {
        $pseudo = htmlspecialchars($_POST['room']);
        $setuser = $bdd->prepare('INSERT INTO rooms(nom, picture)VALUES(?,?)');
        $setuser->execute(array($_POST['room'],  $setpicture));
    }
}

?>



<form id="create_room" action="index.php?id=1" method="post" enctype="multipart/form-data">
    <input type="text" name="room" placeholder="Salon" value="">
    Select image to upload:
    <input type="file" name="picture" id="picture">
    <input id="newroom" type="submit" value="Créer" name="submit">
</form>

<?php
if (!empty($notifupload)) {
    echo $notifupload;
}
//VOIR LES UTILISATEURS
$getRoom = $bdd->query('SELECT * FROM rooms');
while ($room = $getRoom->fetch()) {
?>
    <div class="row sideBar-body">
        <div class="col-sm-3 col-xs-3 sideBar-avatar">
            <div class="avatar-icon">
                <img src="<?php echo $room['picture']; ?>">
            </div>
        </div>
        <div class="col-sm-9 col-xs-9 sideBar-main">
            <div class="row">
                <div class="col-sm-8 col-xs-8 sideBar-name">
                    <a href=".?id=<?php echo $room['id']; ?>"><span class="name-meta"><?php echo $room['nom']; ?></span></a>
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