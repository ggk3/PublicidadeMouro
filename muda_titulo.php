<?php

session_start();

if(!isset($_SESSION['usuario'])) header("Location: home.php");

require_once('bd.class.php');

$objBd = new bd();
$link = $objBd->conecta_mysql();




$sql = "UPDATE util SET titulo = '".$_GET['titulo']."'";
mysqli_query($link, $sql);

header("Location: home.php");

?>