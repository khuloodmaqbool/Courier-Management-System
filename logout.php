<?php 
$connect = mysqli_connect('localhost', 'root', '', 'newcourier2',3307);

session_start();
session_destroy();

header("location: signin.php");
exit();
?>