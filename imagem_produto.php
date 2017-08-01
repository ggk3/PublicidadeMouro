<?php 
session_start();

if(!isset($_SESSION['usuario'])){
	header("Location: home.php");
}

require_once('bd.class.php');

$objBd = new bd();
$link = $objBd->conecta_mysql();

if(!isset($_GET['id'])){
	header("Location: home.php");
}else{
	$produtoId = $_GET['id'];
	$produtoNome = $_GET['nome'];
}


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
		<h3 id="h2texto">Enviar imagem para <b><?= $produtoNome?></b> </h3>
			<form enctype="multipart/form-data" action="upload_imagem.php?id=<?= $produtoId?>" method="POST">
			    <!-- MAX_FILE_SIZE deve preceder o campo input -->
			    <input type="hidden" name="MAX_FILE_SIZE" value="300000000" />
			    <!-- O Nome do elemento input determina o nome da array $_FILES -->
			    
			    	<h4 id="texto">Enviar esse arquivo: </h4>


			    	<input name="userfile" type="file" class="filestyle" id="enviar" />
			    	<output id="list"></output>
			    	<input type="submit" value="Enviar arquivo" class="btn btn-success" />

			</form>
			</div>


    </div>
</div>

<script>
  function handleFileSelect(evt) {
    var files = evt.target.files; // FileList object

    // files is a FileList of File objects. List some properties.
    var output = [];
    for (var i = 0, f; f = files[i]; i++) {
      output.push('<li><strong>', escape(f.name), '</strong> (', f.type || 'n/a', ') - ',
                  f.size, ' bytes, last modified: ',
                  f.lastModifiedDate.toLocaleDateString(), '</li>');
    }
    document.getElementById('list').innerHTML = '<ul>' + output.join('') + '</ul>';
  }

  document.getElementById('enviar').addEventListener('change', handleFileSelect, false);
  
</script>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>



