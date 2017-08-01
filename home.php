<?php 


session_start();

$erro = isset($_GET['erro']) ? $_GET['erro'] : 0;

if(!isset($_SESSION['usuario'])){
	$login = 0;
}else{
	$login = 1;
}

require_once('bd.class.php');

$objBd = new bd();
$link = $objBd->conecta_mysql();

$sql = "SELECT titulo FROM util";

$resultado_id = mysqli_query($link, $sql);
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Mercado Mouro</title>

	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<link rel="icon" href="imagens/mouro.png" type="image/x-icon" />
	<link rel="stylesheet" type="text/css" href="css/estilo.css">

</head>
<body>

<nav class="navbar navbar-inverse navbar-custom">
	<div class="container">

	<!-- header -->
        <div class="navbar-header">

        <!-- botao toggle-->
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#barra-navegacao">
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
	          	<li class="active"><a href="home.php" class="active">Home</a></li>
	            <li><a href="painel_ativos.php">Painel Indoor</a></li>
	            <li><a href="painel_outdoor.php">Painel Outdoor</a></li>
	            <li><a href="novo_usuario.php">Novo Usuario</a></li>
	            
	          </ul>
		<ul class="nav navbar-nav navbar-right">
			<?php if($login != 0){?><li><a href="sair.php">Sair</a></li> <?php } ?>
		</ul>
	</div>
	</div>
</nav>

<div class="container">
<?php 
	if($login == 0){
		?>	
			<div class="col-md-12">
				<h2>Por favor, realize o login para continuar!</h2>
			</div>
			<div class="col-md-3">
			
			<form method="post" action="validar_acesso.php" id="formLogin">

				<div class="espacamento">
					<input type="text" class="form-control" id="campo_usuario" name="usuario" placeholder="Usuário" maxlength="20"/>
				</div>

				<div class="espacamento">
					<input type="password" class="form-control red" id="campo_senha" name="senha" placeholder="Senha" maxlength="20"/>
				</div>

				
				<button type="buttom" class="btn btn-primary" id="btn_login">Entrar</button>

				<br /><br />
				<?php 
					if($erro == 2){
						echo '<font color=#FF0000>Usuario ou senha inválidos</font>';
					}
				 ?>
			</form>
			</div>
			<div class="col-md-6"> </div>

		<?php
	}else {
		if($erro == 11){
			?>
		
			<h2>Banco de dados atualizado com sucesso!</h2>
			<?php
		}
		?>
			<div class="col-md-6">
				
			<?php
				if($resultado_id){
					while($titulo = mysqli_fetch_array($resultado_id)){
						$titulo_ativo = $titulo['titulo'];
					}
				}
				?>
				<div class="col-md-12">
					<h3 id="h2texto">Titulo Publicidade Indoor</h3>
					<form method="get" action="muda_titulo.php">
						<div class="col-md-5">
							<label id="titulo-atual">Titulo Atual: <?php echo $titulo_ativo; ?> </label>
						</div>
						<div class="col-md-8">
								<input type="text" name="titulo" class="form-control" placeholder="Digite o novo Titulo">
						</div>
						<div class="col-md-4">
								<button class="btn btn-success">Alterar Titulo</button>
						</div>
						
					</form>
				</div>
				<div class="col-md-12">
					<hr>
				</div>
			<h3 id="h2texto">Enviar arquivo Banco de Dados Indoor</h3>
			<form enctype="multipart/form-data" action="upload.php?para=0" method="POST">
			    <!-- MAX_FILE_SIZE deve preceder o campo input -->
			    <input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
			    <!-- O Nome do elemento input determina o nome da array $_FILES -->
			    
			    	<h4 id="texto">Enviar esse arquivo: </h4>


			    	<input name="userfile" type="file" class="filestyle" id="enviarIndoor" />
			    	<output id="listIndoor"></output>
			    	<input type="submit" value="Enviar arquivo" class="btn btn-success" />

			</form>
			</div>

			<div class="col-md-6">

				<div class="col-md-12">
				
			<h3 id="h2texto">Enviar arquivo Banco de Dados Outdoor</h3>
			<form enctype="multipart/form-data" action="upload.php?para=1" method="POST">
			    <!-- MAX_FILE_SIZE deve preceder o campo input -->
			    <input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
			    <!-- O Nome do elemento input determina o nome da array $_FILES -->
			    
			    	<h4 id="texto">Enviar esse arquivo: </h4>


			    	<input name="userfile" type="file" class="filestyle" id="enviarOutdoor" />
			    	<output id="listOutdoor"></output>
			    	<input type="submit" value="Enviar arquivo" class="btn btn-success" />

			</form>
			</div>
			</div>

			
			

<script>
  function handleFileSelectIndoor(evt) {
    var files = evt.target.files; // FileList object

    // files is a FileList of File objects. List some properties.
    var output = [];
    for (var i = 0, f; f = files[i]; i++) {
      output.push('<li><strong>', escape(f.name), '</strong> (', f.type || 'n/a', ') - ',
                  f.size, ' bytes, last modified: ',
                  f.lastModifiedDate.toLocaleDateString(), '</li>');
    }
    document.getElementById('listIndoor').innerHTML = '<ul>' + output.join('') + '</ul>';
  }

  function handleFileSelectOutdoor(evt) {
    var files = evt.target.files; // FileList object

    // files is a FileList of File objects. List some properties.
    var output = [];
    for (var i = 0, f; f = files[i]; i++) {
      output.push('<li><strong>', escape(f.name), '</strong> (', f.type || 'n/a', ') - ',
                  f.size, ' bytes, last modified: ',
                  f.lastModifiedDate.toLocaleDateString(), '</li>');
    }
    document.getElementById('listOutdoor').innerHTML = '<ul>' + output.join('') + '</ul>';
  }

  document.getElementById('enviarIndoor').addEventListener('change', handleFileSelectIndoor, false);
  document.getElementById('enviarOutdoor').addEventListener('change', handleFileSelectOutdoor, false);
  
</script>
			


		<?php
	}
		
?>

</div>
<footer id="rodape" style="position: absolute;">
    <div class="container">
    	<span style="color:#ccc;">Developed by 4GE</span>
    </div>
</footer>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>