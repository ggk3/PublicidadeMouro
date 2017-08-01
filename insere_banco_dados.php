<?php 
session_start();

if(!isset($_SESSION['usuario'])) header("Location: home.php");

require_once('bd.class.php');

$objBd = new bd();
$link = $objBd->conecta_mysql();

for()
$sql = "INSERT INTO tweet(id_usuario, tweet) values($id_usuario, '$tweet')";
mysqli_query($link, $sql);
?>