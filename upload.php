<?php

$target_dir = "img/";
$target_file = $target_dir . basename($_FILES["picture"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
$notifupload = "";

// Vérifier si le fichier image est une image réelle ou une fausse image.
if (isset($_POST["submit"])) {
  $check = getimagesize($_FILES["picture"]["tmp_name"]);
  if ($check !== false) {
    $notifupload = "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    $notifupload = "File is not an image.";
    $uploadOk = 0;
  }
}

// Vérifier si le fichier existe déjà
if (file_exists($target_file)) {
  $notifupload = "Sorry, file already exists.";
  $uploadOk = 0;
}

//Vérifiez la taille du fichier
if ($_FILES["picture"]["size"] > 5000000) {
  $notifupload = "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Autoriser certains formats de fichiers
if (
  $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif"
) {
  $notifupload = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Vérifier si $uploadOk est mis à 0 par une erreur
if ($uploadOk == 0) {
  $notifupload = "Sorry, your file was not uploaded.";
  // si tout est ok, essayez de télécharger le fichier
} else {
  if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
    $notifupload = "The file " . htmlspecialchars(basename($_FILES["picture"]["name"])) . " has been uploaded.";
  } else {
    $notifupload = "Sorry, there was an error uploading your file.";
  }
}
?>