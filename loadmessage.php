<?php
session_start();
$bdd = new PDO('mysql:host=db5008791486.hosting-data.io;dbname=dbs7409810;charset=utf8','dbu1696701', '$Shadow94');
//Recuperation des messages 
$getMessage = $bdd->prepare('SELECT * FROM messages INNER JOIN users ON users.id = messages.id_user WHERE id_salon = ? ORDER BY messages.id ASC');
$getMessage->execute(array($_SESSION['roomid']));

while ($message = $getMessage->fetch()) {

if ($_SESSION['id'] == $message['id_user']) {
?>
    <div class="row message-body">
        <div class="col-sm-12 message-main-sender">
            <div class="sender">
                <div class="message-text">
                    <?= $message['message']; ?>
                </div>
                <span class="message-time pull-right">
                    <?= $message['pseudo']; ?>
                </span>
            </div>
        </div>
    </div>
<?php
} else {

?>

    <div class="row message-body">
        <div class="col-sm-12 message-main-receiver">
            <div class="receiver">
                <div class="message-text">
                    <?= $message['message']; ?>
                </div>
                <span class="message-time pull-right">
                    <?= $message['pseudo']; ?>
                </span>
            </div>
        </div>
    </div>
<?php

}
}
?>