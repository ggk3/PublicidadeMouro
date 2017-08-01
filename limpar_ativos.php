<?php

session_start();

if(!isset($_SESSION['usuario'])) header("Location: home.php");

require_once('bd.class.php');

$objBd = new bd();
$link = $objBd->conecta_mysql();

$para = $_GET['para'];

if($para == 0){
	$sql = "UPDATE produtos SET ativo = 0";
}else{
	$sql = "UPDATE produtos_outdoor SET ativo = 0";
}

mysqli_query($link, $sql);

if($para == 0){
	$sql = "UPDATE util SET quant_ativos = 0";

}else{
	$sql = "UPDATE util SET quant_ativos_outdoor = 0";

}
mysqli_query($link, $sql);

if($para == 0){
	header("Location: painel_ativos.php");
}else{
	header("Location: painel_outdoor.php");
}



?>