<?php 
session_start();
$_SESSION = array();
//Pour se deconnecter
session_destroy();
header('Location: login.php');
?>