<?php

require_once('bd.class.php');

$objBd = new bd();
$link = $objBd->conecta_mysql();


$sql = "SELECT * FROM produtos WHERE ativo = 1";
$resultado_id = mysqli_query($link, $sql);

$sql = "SELECT titulo FROM util";
$resultado_titulo = mysqli_query($link, $sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    
    <title>Mouro Promoções</title>
    <link rel="icon" href="imagens/mouro.png">

    <!-- Normalize -->
    <link rel="stylesheet" type="text/css" href="css/normalize.css">
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/estilo.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Special+Elite" rel="stylesheet">
    <script src="js/jquery-3.1.1.js"></script>
   
  </head>
  <body>

  <div id="fundo-externo">
    <div id="fundo">
        <img src="imagens/fundo.png" alt="" />
    </div>
  </div>
      
  <div class='col-md-12' align="center">

      <?php 
      if($resultado_titulo) {
        while($titulo = mysqli_fetch_array($resultado_titulo)){
          $titulo_ativo = $titulo['titulo'];
        }
      }

      ?>      
      <a href="home.php" class="link"><h1 class="titulo-ativo"><?php echo $titulo_ativo; ?></h1></a>
  </div>

		<div class="col-md-12" style="margin-top: 2%;">

			<?php 
				if($resultado_id){
          $contador = 0;
          $grupos = 0;
    				while($produto = mysqli_fetch_array($resultado_id)){
              if($contador == 0 ){
                $grupos+=1;
                echo "<div class='conjunto".$grupos."'>";
              }

    					echo "<div class='col-md-6 fundo-item' align='center'>";

              $preco_item = number_format($produto['preco'], 2, ',', '');

    					echo "<h2 class='itens' >" . $produto['descricao'] ."</h2>"; 

              echo "</div>";

              echo "<div class='col-md-3 fundo-branco' align='left'>";

              echo " <h2 class='itens-preco'>  R$ ". $preco_item . "</h2>";

    					echo "</div>";

              

             
              if($contador == 5){
                echo "</div>";
                
                $contador = 0;
              }else{
                $contador+= 1;
              }
              


    				}
            if($contador != 0){
              echo "</div>";
            }
			}else{
				echo "erro na execução da consulta";
			}

      

			?>


      

</div>
  <?php echo "<span id='qt_grupo'>";
      echo $grupos;
      echo "</span>"; ?>


      <script type="text/javascript">
        $('#qt_grupo').hide();

        var i;
        var grupos = document.getElementById("qt_grupo").textContent;
        var cont = 1;

        for(i = 1; i <= grupos; i++){
          $('.conjunto'+i).hide();
        }
        
        
        $('.conjunto'+grupos).show();

        setInterval(function() { 

        
          for(i = 1; i <= grupos; i++){
            if(cont == i ){

              if(i == 1){
                var conjuntoFadeIn = ".conjunto" + grupos;
                var conjuntoFadeOut = ".conjunto" + i;
                $(conjuntoFadeIn).fadeOut(1000, function(){
                  
                      $(conjuntoFadeOut).fadeIn(1000);
                  
                });
              }else{
                var conjuntoFadeIn = ".conjunto" + (i-1);
                var conjuntoFadeOut = ".conjunto" + i;
                $(conjuntoFadeIn).fadeOut(1000, function(){
                 
                      $(conjuntoFadeOut).fadeIn(1000);
                  
                });
              }
              
            }

            if(i == grupos){
              cont ++;
            }

          }

          if(cont > grupos){
              cont = 1;
            
          }

            
         }, 8000);

        
        
        
      </script>
		
  </body>
</html>