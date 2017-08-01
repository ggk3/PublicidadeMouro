<?php 
session_start();

if(!isset($_SESSION['usuario'])){
	header("Location: home.php");
}

if($_GET['erro_usuario'] == 1){
	$erro = 1;
}else{
	$erro = 0;
}

if($_GET['sucesso'] == 1){
	$sucesso = 1;
}else{
	$sucesso = 0;
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
	          	<li><a href="home.php" class="active">Home</a></li>
	            <li><a href="painel_ativos.php">Painel Indoor</a></li>
	            <li><a href="painel_outdoor.php">Painel Outdoor</a></li>
	            <li  class="active"><a href="novo_usuario.php">Novo Usuario</a></li>
	            
	          </ul>
		<ul class="nav navbar-nav navbar-right">
			<?php if($login != 0){?><li><a href="sair.php">Sair</a></li> <?php } ?>
		</ul>
	</div>
	</div>
</nav>

<div class="container">
	
		<div class="col-md-12">
				<?php if($sucesso == 1){ echo "<h1>Usuário Registrado com Sucesso!</h1>";} ?>
				<h2>Cadastrar novo usuário</h2>
		</div>
		<div class="col-md-3">

		
		<form method="post" action="registra_usuario.php">

			<div class="espacamento">
				<input type="text" class="form-control" name="usuario" placeholder="Usuário" maxlength="20"/>
			</div>

			<div class="espacamento">
				<input type="password" class="form-control red" name="senha" placeholder="Senha" maxlength="20"/>
			</div>

			
			<button type="buttom" class="btn btn-success" id="btn_login">Cadastrar</button>

			<br /><br />
			<?php 
				if($erro == 1){
					echo '<font color=#FF0000>Usuário já existente</font>';
				}
			 ?>
		</form>
	</div>
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