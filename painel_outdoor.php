<?php 
session_start();

if(!isset($_SESSION['usuario'])){
	header("Location: home.php");
}

require_once('bd.class.php');

$objBd = new bd();
$link = $objBd->conecta_mysql();

if(isset($_GET['busca'])){
	$sql = "SELECT * FROM produtos_outdoor WHERE descricao LIKE '%".$_GET['busca']."%' ORDER BY ativo DESC";
}else{
	$sql = "SELECT * FROM produtos_outdoor ORDER BY ativo DESC, imagem DESC";
}

$resultado_id = mysqli_query($link, $sql);

$sql = "SELECT quant_ativos_outdoor FROM util";

$resultado_ativos = mysqli_query($link, $sql);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Mercado Mouro</title>

	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<link rel="icon" href="imagens/mouro.png" type="image/x-icon" />
	<link rel="stylesheet" type="text/css" href="css/estilo.css">
</head>
<body style="margin-top: 70px;">
<nav class="navbar navbar-inverse navbar-custom navbar-fixed-top">
	<div class="container">

	<!-- header -->
        <div class="navbar-header">

        <!-- botao toggle-->
        <button type="button" class="navbar-toggle collapsed fixed-top" data-toggle="collapse" data-target="#barra-navegacao">
          <span class="sr-only">alternar navegação</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>

        </div>
		
		<div class="collapse navbar-collapse" id="barra-navegacao">
		<ul class="nav navbar-nav ">
	          	<li><a href="index.php">Indoor</a></li>
	          	<li><a href="outdoor.php">Outdoor</a></li>
	          	<li><a href="home.php">Home</a></li>
	            <li><a href="painel_ativos.php">Painel Indoor</a></li>
	            <li  class="active"><a href="painel_outdoor.php">Painel Outdoor</a></li>
	            <li><a href="novo_usuario.php">Novo Usuario</a></li>
	            
	          </ul>
		<ul class="nav navbar-nav navbar-right">
			<li>
				<a href="sair.php">Sair</a></li>
			</li>
		</ul>
	</div>
	</div>
</nav>

<div class="container">
	<div class="col-md-12">
		<h3 id="h2buscar">Buscar</h2>
		<form action="painel_outdoor.php" method="get">
			<div class="col-md-4">
				<input type="text" name="busca" class="form-control">
			</div>
			<div class="col-md-4">
				<button class="btn btn-success">Buscar</button>
				<a href="painel_outdoor.php" class="btn btn-warning">Limpar Busca</a>
				
			</div>
		</form>
		<form method="post" action="atualiza_nomes.php?para=1">
		<div class="col-md-4">
		<button class="btn btn-primary">Atualizar Nomes</button>
			<?php 
			if($resultado_ativos){
				while($ativo = mysqli_fetch_array($resultado_ativos)){
					$quant_ativo = $ativo['quant_ativos_outdoor'];
				}
			} ?>
			<span id="ativos"><b>Ativos: <?php echo $quant_ativo; ?></b></span>
			<a href="limpar_ativos.php?para=1" class="btn btn-danger">Limpar Ativos</a>
		</div>
		
	</div>

	<div class="col-md-12">
	
	
	
	
	<?php
	$contador = 0;

	
	if($resultado_id){
		while($produto = mysqli_fetch_array($resultado_id)){

			if($contador == 0 ){
				
				echo "<div class='col-md-6'>";
				echo "<table border='1'>";
			}

			
			$preco_item = number_format($produto['preco'], 2, ',', '');

			echo "<tr>";

			echo "<td> <input type='text' value='" . $produto['descricao'] . "' class='form-control' name='id". $produto['id_produto']."' maxlength='45'></td>";

			echo "<td style='width: 15%;'>R$ " . $preco_item . "</td>";

			if($produto['ativo'] == 0){
				echo "<td align='center' style='width: 13%;'> " . "<a href='ativar.php?para=1&id=".$produto['id_produto']."'>Ativar</a>" . "</td>";
			}else{
				echo "<td align='center' style='width: 13%;'> " . "<a href='desativar.php?para=1&id=".$produto['id_produto']."'>Desativar</a>" . "</td>";
			}

			if($produto['imagem'] == 0){
				echo "<td align='center' style='width: 20%;'> " . "<a href='imagem_produto.php?id=".$produto['id_produto']."&nome=".$produto['descricao']."'>Enviar Img</a>";
			}else{
				echo "<td align='center' style='width: 20%;'> " . "<a href='imagem_produto.php?id=".$produto['id_produto']."&nome=".$produto['descricao']."'>Alterar Img</a>";
			}

			
			echo "</td>";

			    	

			
			echo "</tr>";

			if($contador == 17){
				
				echo '</table>';
				echo "</div>";
				$contador = 0;
			}else{
				$contador+= 1;
			}

			

			

			
		}
		echo '</table>';
		echo "</div>";
	}else{
		echo "erro na execução da consulta";
	}
	

	?>
	</form>
	</div>
</div>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>



