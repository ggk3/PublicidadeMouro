<?php 

require_once('bd.class.php');

$usuario = $_POST['usuario'];
$senha = md5($_POST['senha']);

$objBd = new bd();
$link = $objBd->conecta_mysql();

$usuario_existe = false;

$sql = "select * from usuarios where usuario = '$usuario' ";
if($resultado_id = mysqli_query($link, $sql)){
	$dados = mysqli_fetch_array($resultado_id);
	if(isset($dados['usuario'])){
		$usuario_existe = true;
	}
}else{
	echo "erro ao tentar localizar or egistro de usuario no banco de dados";
}

if($usuario_existe){
	$retorno_get = '';

	if($usuario_existe){
		$retorno_get.="erro_usuario=1";
	}

	header("Location: novo_usuario.php?".$retorno_get);
	die();
}




$sql = "INSERT INTO usuarios(usuario, senha) values ('$usuario', '$senha')";
if(mysqli_query($link, $sql)){
	header("Location: novo_usuario.php?sucesso=1");
}
?>