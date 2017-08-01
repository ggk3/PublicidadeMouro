<?php

session_start();

if(!isset($_SESSION['usuario'])) header("Location: home.php");

require_once('bd.class.php');

$objBd = new bd();
$link = $objBd->conecta_mysql();

$para = $_GET['para'];

if($para == 0){
	$sql = "UPDATE produtos SET ativo = 1 WHERE id_produto = ".$_GET['id'];
}else{
	$sql = "UPDATE produtos_outdoor SET ativo = 1 WHERE id_produto = ".$_GET['id'];
}
mysqli_query($link, $sql);

if($para == 0){
	$sql = "SELECT quant_ativos FROM util";
}else{
	$sql = "SELECT quant_ativos_outdoor FROM util";
}

$resultado_ativos = mysqli_query($link, $sql);

if($resultado_ativos){
	while($ativo = mysqli_fetch_array($resultado_ativos)){
		if($para == 0){
			$quant_ativo = $ativo['quant_ativos'];
		}else{
			$quant_ativo = $ativo['quant_ativos_outdoor'];
		}
		
		echo $quant_ativo;
	}		
}
$quant_ativo++;
if($para == 0){
	$sql = "UPDATE util SET quant_ativos = $quant_ativo";
}else{
	$sql = "UPDATE util SET quant_ativos_outdoor = $quant_ativo";
}

mysqli_query($link, $sql);

if($para == 0){
	header("Location: painel_ativos.php");
}else{
	header("Location: painel_outdoor.php");
}




?>