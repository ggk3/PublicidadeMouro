<?php

session_start();

if(!isset($_SESSION['usuario'])) header("Location: home.php");

require_once('bd.class.php');

$objBd = new bd();
$link = $objBd->conecta_mysql();
// Nas versões do PHP anteriores a 4.1.0, $HTTP_POST_FILES deve ser utilizado ao invés
// de $_FILES.
$para = $_GET['para'];

$uploaddir = './arquivos/';
$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

echo '<pre>';
$tipo = $_FILES['userfile']['type']; 
if($tipo == "text/plain"){
	if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {	
	    //ABRE O ARQUIVO TXT
		$ponteiro = fopen ($uploadfile,"r");
		

		//LÊ O ARQUIVO ATÉCHEGAR AO FIM 
		while (!feof ($ponteiro)) {
			$atualiza = 0;
		  //LÊ UMALINHA DO ARQUIVO
		  $linha = fgets($ponteiro);

		  $cod_dep = substr($linha, 0, 2);
		  $tipo_prod = substr($linha, 2, 1);
		  $cod_item = substr($linha, 3, 6);
		  $preco_item = substr($linha, 9, 6);
		  //$validade = substr($linha, 15, 3);
		  $descricao = substr($linha, 18, 50);
		  $descricao = str_replace("  ", "", $descricao);
		  //$cod_inf_extra = substr($linha, 68, 6);
		  //$cod_img_item = substr($linha, 74, 3);
		  //$cod_inf_nutri = substr($linha, 77, 4);
		  //$imprime_data_validade = substr($linha, 81, 1);
		  //$imprime_data_embalagem = substr($linha, 82, 1);
		  //$cod_fornecedor = substr($linha, 83, 4);
		  //$lote = substr($linha, 87, 12);
		  //$reservado = substr($linha, 99, 11);
		  //$versao_preco = substr($linha, 100, 1);
		  //$bytes_reservados = substr($linha, 101, 2);

		  $preco_item = floatval($preco_item/100);
		  $preco_item = number_format($preco_item, 2, '.', '');

		  if($para == 0){
		  	$sql = "SELECT preco FROM produtos WHERE id_produto = $cod_item";
		  }else{
		  	$sql = "SELECT preco FROM produtos_outdoor WHERE id_produto = $cod_item";
		  }
		  
		  $resultado_id = mysqli_query($link, $sql);
		  if($resultado_id){
			while($produto = mysqli_fetch_array($resultado_id)){

				if($produto['preco'] != $preco_item){
					if($para == 0){
						$sql = "UPDATE produtos SET preco = $preco_item WHERE id_produto = $cod_item";
					}else{
					  	$sql = "UPDATE produtos_outdoor SET preco = $preco_item WHERE id_produto = $cod_item";
					}
					mysqli_query($link, $sql);
					$atualiza = 1;
				}
			}
		}

		if($atualiza != 1){
			if($para == 0){
				$sql = "INSERT INTO produtos(id_produto, departamento, descricao, preco, tipo) values($cod_item, $cod_dep, '$descricao', $preco_item, $tipo_prod)";
			}else{
			  	$sql = "INSERT INTO produtos_outdoor(id_produto, departamento, descricao, preco, tipo) values($cod_item, $cod_dep, '$descricao', $preco_item, $tipo_prod)";
			}
			
		  mysqli_query($link, $sql);
		}


		  
		}//FECHA WHILE

		//FECHAO PONTEIRO DO ARQUIVO
		fclose ($ponteiro);

		header("Location: home.php?erro=11");




	} else {
	    echo "Possível ataque de upload de arquivo!\n";
	}
}else{
		echo "Arquivo enviado não corresponde ao esperado\nEnvie um arquivo .txt!";
}


/*echo 'Aqui está mais informações de debug:';
print_r($_FILES);
*/
print "</pre>";

?>