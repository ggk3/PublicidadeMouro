<?php

session_start();

if(!isset($_SESSION['usuario'])) header("Location: home.php");

require_once('bd.class.php');

$objBd = new bd();
$link = $objBd->conecta_mysql();


$id = $_GET['id'];

$uploaddir = './imagensProd/';
$uploadfile = $uploaddir . "imagem" . $id . ".png";

echo '<pre>';
$tipo = $_FILES['userfile']['type']; 
echo $tipo;
if($tipo == "image/png"){
	if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {	
		$sql = "UPDATE produtos_outdoor SET imagem = 1 WHERE id_produto = ".$id;
		mysqli_query($link, $sql);
	    header("Location: painel_outdoor.php");
	} else {
	    echo "Possível ataque de upload de arquivo!\n";
	}
}else{
	echo $tipo;
		echo "<h2>Arquivo enviado não corresponde ao esperado\nEnvie um arquivo .png!</h2>";
		echo "</br><a href='imagem_produto.php?id=$id' class='btn btn-success'>Voltar</a>";
}


/*echo 'Aqui está mais informações de debug:';
print_r($_FILES);
*/
print "</pre>";

?>