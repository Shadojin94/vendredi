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

<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Creer un nouvel utilisateur</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="loginpage/images/icons/favicon.ico" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="loginpage/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="loginpage/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="loginpage/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="loginpage/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="loginpage/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="loginpage/css/util.css">
    <link rel="stylesheet" type="text/css" href="loginpage/css/main.css">
    <!--===============================================================================================-->
    <style>
        label.label-file.input100 {
            padding-top: 1em;
        }

        .label-file {
            cursor: pointer;
            color: #00b1ca;
            font-weight: bold;
        }

        .label-file:hover {
            color: #25a5c4;
        }


        .input-file {
            display: none;
        }
    </style>
</head>

<body>

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-pic js-tilt" data-tilt>
                    <img src="loginpage/images/img-01.png" alt="IMG">
                </div>

                <form class="login100-form validate-form" id="create_user" action="" method="post" enctype="multipart/form-data">
                    <span class="login100-form-title">
                        Créer un nouvel utilisateur
                    </span>
                    <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">

                        <input class="input100" type="text" name="pseudo" placeholder="Pseudo" value="">


                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-user" aria-hidden="true"></i>
                        </span>

                    </div>
                    <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">

                        <label for="file" class="label-file input100">Choisir une image</label>
                        <input class="input-file" type="file" name="picture" id="file">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-file-image-o" aria-hidden="true"></i>
                        </span>


                    </div>




                    <div class="container-login100-form-btn">
                        <input class="login100-form-btn" type="submit" value="Enregistrer" name="submit">

                    </div>

                    <div class="text-center p-t-12">
                        <span class="txt1">
                            CREER
                        </span>
                        <a class="txt2" href="#">
                            UN NOUVEL UTILISATEUR
                        </a>
                    </div>

                    <div class="text-center p-t-136">

                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--===============================================================================================-->
    <script src="loginpage/vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="loginpage/vendor/bootstrap/js/popper.js"></script>
    <script src="loginpage/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="loginpage/vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="loginpage/vendor/tilt/tilt.jquery.min.js"></script>
    <script>
        $('.js-tilt').tilt({
            scale: 1.1
        })
    </script>
    <!--===============================================================================================-->


</body>

</html>