<?php

session_start();

if(!isset($_SESSION['usuario'])) header("Location: home.php");

require_once('bd.class.php');

$objBd = new bd();
$link = $objBd->conecta_mysql();

$para = $_GET['para'];

if($para == 0){
	$sql = "SELECT id_produto FROM produtos ORDER BY id_produto";
}else{
	$sql = "SELECT id_produto FROM produtos_outdoor ORDER BY id_produto";
}

$produtos = mysqli_query($link, $sql);

if($produtos){
	while($produto = mysqli_fetch_array($produtos)){
		if($para == 0){
			$sql = "UPDATE produtos SET descricao = '".$_POST['id'.$produto['id_produto']]."' WHERE id_produto = ". $produto['id_produto'];
		}else{
			$sql = "UPDATE produtos_outdoor SET descricao = '".$_POST['id'.$produto['id_produto']]."' WHERE id_produto = ". $produto['id_produto'];
		}
		
		mysqli_query($link, $sql);

	}
} 

if($para == 0){
	header("Location: painel_ativos.php");
}else{
	header("Location: painel_outdoor.php");
}

?>