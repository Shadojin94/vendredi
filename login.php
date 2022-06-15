<?php
session_start();
$bdd = new PDO('mysql:host=db5008791486.hosting-data.io;dbname=dbs7409810;charset=utf8','dbu1696701', '$Shadow94');
//Formulaire pour se logguer
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
<html lang="fr">
<head>
	<title>Vendredi  ChatX</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="loginpage/images/icons/favicon.ico"/>
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
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="loginpage/images/img-01.png" alt="IMG">
				</div>

				<form class="login100-form validate-form" method="POST" action="">
					<span class="login100-form-title">
                    Vendredi  ChatX
					</span>
                    <p style="text-align:center;padding:1em;">(Patrick, Jane, Marie)</p>
					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                        
						<input class="input100" type="text" name="pseudo" placeholder="Pseudo ">
                        
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
                        
					</div>
					
					<div class="container-login100-form-btn">
                    <input class="login100-form-btn" type="submit" name="valider" value="valider">
						
					</div>

					<div class="text-center p-t-12">
						<span class="txt1">
							CREER 
						</span>
						<a class="txt2" href="registrer.php">
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
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->


</body>
</html>