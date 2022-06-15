<?php
session_start();
$bdd = new PDO('mysql:host=db5008791486.hosting-data.io;dbname=dbs7409810;charset=utf8', 'dbu1696701', '$Shadow94');
if (!$_SESSION['pseudo']) {
    //Si utilisateur n'est pas loggué
    header('Location: login.php');
}
if (isset($_GET['id']) and !empty($_GET['id']) or !$_SESSION['pseudo']) {
    $getid =  $_GET['id'];
    $getUser = $bdd->prepare('SELECT * FROM users WHERE id = ?');
    $getUser->execute(array($getid));

    if (isset($_POST['envoyer'])) {
        if (!empty($_POST['message'])) {
            $message = htmlspecialchars($_POST['message']);
            $insererMessage = $bdd->prepare('INSERT INTO messages(message, id_user, id_salon)VALUES(?,?,?)');
            $insererMessage->execute(array($message, $_SESSION['id'], $getid));
        }
    }
} else {
    //Si utilisateur n'est pas loggué
    header('Location: login.php');
}
?>

<html lang="fr">

<head>
    <title>Whatsapp Template</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <!-- Font Awesome File -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        .custom_body {
            background: linear-gradient(-135deg, #c850c0, #4158d0) !important;
        }

        .app {
            border-radius: 15px !important;
        }
    </style>
</head>


<body class="custom_body">

    <div class="container app">
        <div class="row app-one">

            <div class="col-sm-4 side">
                <div class="side-one">
                    <!-- Heading -->
                    <?php
                    $getUserId = $_SESSION['id'];
                    $getUser = $bdd->query('SELECT * FROM users WHERE id = ' . $getUserId);
                    while ($user = $getUser->fetch()) {
                        $userName = $user['pseudo'];
                        $userImg = $user['avatar'];
                    }
                    ?>
                    <div class="row heading">
                        <div class="col-sm-7 col-xs-7 heading-avatar">
                            <div class="heading-avatar-icon">
                                <img src="<?php echo $userImg; ?>">
                                <span><?php echo $userName; ?></span>
                            </div>
                        </div>
                        <div class="col-sm-1 col-xs-1  heading-dot  pull-right">
                            <i id="add_room" class="fa fa-plus-square fa-2x  pull-right" aria-hidden="true" data-toggle="modal" data-target="#exampleModalCenter"></i>
                        </div>
                        <div class="col-sm-2 col-xs-2 heading-compose  pull-right">
                            <i class="fa fa-comments fa-2x  pull-right" aria-hidden="true"></i>
                        </div>
                    </div>
                    <!-- Heading End -->

                    <!-- SearchBox -->
                    <div class="row searchBox" style="display:none;">
                        <div class="col-sm-12 searchBox-inner">
                            <div class="form-group has-feedback">
                                <input id="searchText" type="text" class="form-control" name="searchText" placeholder="Search">
                                <span class="glyphicon glyphicon-search form-control-feedback"></span>
                            </div>
                        </div>
                    </div>

                    <!-- Search Box End -->
                    <!-- sideBar -->

                    <div class="row sideBar">
                        <?php
                        $getRooms = $bdd->query('SELECT * FROM rooms');
                        while ($room = $getRooms->fetch()) {
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
                                            <span class="time-meta pull-right">
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }

                        ?>
                    </div>

                    <!-- Sidebar End -->
                </div>
                <div class="side-two">

                    <!-- Heading -->
                    <div class="row newMessage-heading">
                        <div class="row newMessage-main">
                            <div class="col-sm-2 col-xs-2 newMessage-back">
                                <i class="fa fa-arrow-left" aria-hidden="true"></i>
                            </div>
                            <div class="col-sm-10 col-xs-10 newMessage-title">
                                Les utilisateurs
                            </div>
                        </div>
                    </div>
                    <!-- Heading End -->

                    <!-- ComposeBox -->
                    <div class="row composeBox" style="display:none;">
                        <div class="col-sm-12 composeBox-inner">
                            <div class="form-group has-feedback">
                                <input id="composeText" type="text" class="form-control" name="searchText" placeholder="Search People">
                                <span class="glyphicon glyphicon-search form-control-feedback"></span>
                            </div>
                        </div>
                    </div>
                    <!-- ComposeBox End -->

                    <!-- sideBar -->
                    <!-- Les utilisateurs du Salon -->
                    <div class="row compose-sideBar">


                        <div class="row sideBar">
                            <?php
                            $getSalonId = $_GET['id'];
                            $getUserRoom = $bdd->prepare('SELECT * FROM messages INNER JOIN users ON users.id = messages.id_user WHERE id_salon = ? GROUP BY pseudo');
                            $getUserRoom->execute(array($_GET['id']));
                            while ($userRoom = $getUserRoom->fetch()) {
                            ?>
                                <div class="row sideBar-body">
                                    <div class="col-sm-3 col-xs-3 sideBar-avatar">
                                        <div class="avatar-icon">
                                            <img src="<?php echo $userRoom['avatar']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-9 col-xs-9 sideBar-main">
                                        <div class="row">
                                            <div class="col-sm-8 col-xs-8 sideBar-name">
                                                <a href=".?id=<?php echo $userRoom['id']; ?>"><span class="name-meta"><?php echo $userRoom['pseudo']; ?></span></a>
                                            </div>
                                            <div class="col-sm-4 col-xs-4 pull-right sideBar-time">
                                                <span class="time-meta pull-right">
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }

                            ?>
                        </div>


                    </div>
                </div>
                <!-- Sidebar End -->
            </div>


            <!-- New Message Sidebar End -->

            <!-- Conversation Start -->
            <div class="col-sm-8 conversation">
                <!-- Heading -->
                <?php
                $getid = $_GET['id'];
                $_SESSION['roomid'] = $getid;
                $getRoom = $bdd->query('SELECT * FROM rooms WHERE id = ' . $getid);
                while ($room = $getRoom->fetch()) {
                    $roomName = $room['nom'];
                    $roomImg = $room['picture'];
                }
                ?>
                <div class="row heading">
                    <div class="col-sm-2 col-md-1 col-xs-3 heading-avatar">
                        <div class="heading-avatar-icon">
                            <img src="<?php echo $roomImg; ?>">
                        </div>
                    </div>
                    <div class="col-sm-8 col-xs-7 heading-name">
                        <a class="heading-name-meta">Salon <?php echo $roomName; ?>


                        </a>
                        <span class="heading-online">Online</span>
                    </div>
                    <div class="col-sm-1 col-xs-1  heading-dot pull-right">
                        <a href="logout.php"><i class="fa fa-power-off fa-2x  pull-right" aria-hidden="true"></i></a>
                    </div>

                </div>
                <!-- Heading End -->

                <!-- Message Box -->

                <div class="row message" id="conversation">

                </div>
                <!-- Message Box End -->

                <!-- Reply Box -->
                <form method="POST" action="" id="myform">
                    <div class="row reply">
                        <div class="col-sm-1 col-xs-1 reply-emojis" style="display:none;">
                            <i class="fa fa-smile-o fa-2x"></i>
                        </div>
                        <div class="col-sm-9 col-xs-9 reply-main">

                            <textarea class="form-control" rows="1" id="comment" name="message"></textarea>

                        </div>
                        <div class="col-sm-1 col-xs-1 reply-recording" style="display:none;">
                            <i class="fa fa-microphone fa-2x" aria-hidden="true"></i>
                        </div>
                        <div class="col-sm-1 col-xs-1 reply-send">
                            <button class="fa fa-send fa-2x" aria-hidden="true" type="submit" form="myform" name="envoyer"></button>
                        </div>
                    </div>
                </form>
                <!-- Reply Box End -->
            </div>
            <!-- Conversation End -->
        </div>
        <!-- App One End -->
    </div>

    <!-- App End -->

    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Creer un salon</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php include('room.php'); ?>
                </div>

            </div>
        </div>
    </div>
</body>
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }

    $(".heading-compose").click(function() {
        $(".side-two").css({
            "left": "0"
        });
    });

    $(".newMessage-back").click(function() {
        $(".side-two").css({
            "left": "-100%"
        });
    });

    // Pour rentre les messages instantanés
    setInterval('load_message()', 500);
    // Pour voir les derniers les messages au chargement
    function load_message() {
        $('#conversation').load('loadmessage.php');
        var objDiv = document.getElementById("conversation");
        objDiv.scrollTop = objDiv.scrollHeight;

    }
</script>

</html>