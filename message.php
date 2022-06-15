<?php
session_start();
$bdd = new PDO('mysql:host=db5008791486.hosting-data.io;dbname=dbs7409810;charset=utf8', 'dbu1696701', '$Shadow94');
if (!$_SESSION['pseudo']) {
    header('Location: connexion.php');
}
if (isset($_GET['id']) and !empty($_GET['id'])) {
    $getid =  $_GET['id'];
    $getUser = $bdd->prepare('SELECT * FROM users WHERE id = ?');
    $getUser->execute(array($getid));
    if ($getUser->rowCount() > 0) {
        if (isset($_POST['envoyer'])) {
            $message = htmlspecialchars($_POST['message']);
            $insererMessage = $bdd->prepare('INSERT INTO messages(message, id_user, id_salon)VALUES(?,?,?)');
            $insererMessage->execute(array($message, $getid, $_SESSION['id']));
        }
    } else {
        echo "Aucun utilisateur trouvé";
    }
} else {
    echo "Utilisateur ID non reconnu";
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Message chat</title>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
</head>

<body>
    <form id="send_form" method="POST" action="">
        <textarea id="send1" name="message"></textarea>
        <br>
        <input type="submit" name="envoyer">
    </form>

    <section id="messages">

        <?php
        $getMessage = $bdd->prepare('SELECT * FROM messages WHERE id_salon = ? AND id_user = ? OR id_salon = ? AND id_user = ?');
        $getMessage->execute(array($_SESSION['id'], $getid, $getid, $_SESSION['id']));
        while ($message = $getMessage->fetch()) {
            if ($message['id_user'] == $_SESSION['id']) {
        ?>
                <p style="color:red;"><?= $message['message']; ?></p>
            <?php
            } elseif ($message['id_user'] == $getid) {

            ?>
                <p style="color:green;"><?= $message['message']; ?></p>
        <?php
            }
        }
        ?>
    </section>
    <script>
        let input1 = document.getElementById('send1');

        document.getElementById("send_form").addEventListener("submit", function(e) {
            if (empty(input1.value)) { // You should check other inputs if you have.
                e.preventDefault();
                return false;
            }
            // Empecher les formulaires d'être envoyer plusieurs fois au chargement
        });

        $("#prospects_form").submit(function(e) {
            e.preventDefault();
        });
    </script>
</body>

</html>