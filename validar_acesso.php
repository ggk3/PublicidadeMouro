<?php  

session_start();

require_once('bd.class.php');

$usuario = $_POST['usuario'];
$senha = md5($_POST['senha']);

$sql = "SELECT usuario FROM usuarios WHERE usuario = '$usuario' AND senha = '$senha'";

$objBd = new bd();
$link = $objBd->conecta_mysql();


$resultado_id = mysqli_query($link, $sql);
if($resultado_id){
	$dados_usuario = mysqli_fetch_array($resultado_id);
	if(isset($dados_usuario['usuario'])){
		$_SESSION['usuario'] = $dados_usuario['usuario'];
		header("Location: home.php");
	}else{
		header("Location: home.php?erro=2");
	}
}else{
	echo 'Erro na execução da consulta';
}

?>