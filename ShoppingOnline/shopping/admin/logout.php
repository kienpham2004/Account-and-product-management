<?php 
session_start();
$_SESSION['login']=="";
session_unset();
$_SESSION['err']="You have successfully logout";
header("location:index.php");
?>
