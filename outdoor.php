<?php

require_once('bd.class.php');

$objBd = new bd();
$link = $objBd->conecta_mysql();


$sql = "SELECT * FROM produtos_outdoor WHERE ativo = 1";
$resultado_id = mysqli_query($link, $sql);
$nomes;
$precos;
$ids;
$kg;
$cont = 0;
while($produto = mysqli_fetch_array($resultado_id)){
    $nomes[$cont] = $produto['descricao'];
    $precos[$cont] = $produto['preco'];
    $ids[$cont] = $produto['id_produto'];
    $kg[$cont] = $produto['tipo'];
    $cont++;
}
$nomesAux = implode("|", $nomes);
$precosAux = implode("|", $precos);
$idsAux = implode("|", $ids);
$kgAux = implode("|", $kg);

?>


<!DOCTYPE html>
<html>
<head>
	<title>Outdoor Mouro</title>
	<link rel="icon" href="imagens/mouro.png">
	<!-- Normalize -->
    <link rel="stylesheet" type="text/css" href="css/normalize.css">
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/estilo_outdoor.css">
	<script src="js/jquery-3.1.1.js"></script>

</head>
<body>

<div id="fundo-externo">
    <div id="fundo">
        <img src="imagens/fundo_outdoor.png" alt="" />
    </div>
  </div>

 <div class="col-md-12" id="capa" align="center">
 	<img id="promocao" style="height:0%;width:0%; position: absolute;left: 50%;top: 50%" src="imagens/promocao.png">
 	<!--h1 id="feira" style="font-size: 2.5em; color: #fff; position: absolute; left: 80%; top: 38%;" class="feira">TODO DIA <br>É DIA DE FEIRA!</h1>
 	<h1 id="hort" style="font-size: 0em; color: #fff; position: absolute; left: 70%; top: 60%;" class="hort">HORTIFRUTI</h1-->
 	<a href="home.php"><img id="logo" src="imagens/logo.png" style="width: 20%; position: absolute; right: -20%; top: 82%;" ></a>

    <div style="text-align: center;position: absolute;left: 58%; top: 38%;width: 42%">
        <h1 id="item" style="font-size: 4em; color: #fff; " class="item">TESTE</h1>
    </div>
    <div style="text-align: center;position: absolute;left: 58%; top: 52%;width: 42%;">
        <h1 id="valor" style="font-size: 11em; color: #0be583; margin-left: 15%;" class="valor">TESTE</h1>
    </div>

    
    
    <span id="bola2" style="background-color: rgba(11, 234, 123, 0.8); position: absolute; left: -10%; top: 45%; padding: 5%; border-radius: 50%; "></span>
    <span id="bola4" style="background-color: rgba(4, 192, 209, 0.8); position: absolute; left: -10%; top: 45%; padding: 5%; border-radius: 50%; "></span>
    <span id="bola3" style="background-color: rgba(136, 147, 142, 0.8); position: absolute; left: -10%; top: 45%; padding: 5%; border-radius: 50%; "></span>
    <span id="bola1" style="background-color: #fff; position: absolute; left: 10%; top: 45%; padding: 5%; border-radius: 50%; "></span>
    <img id="imagem" src="imagens/goiaba.png" style="position: absolute; left: 25%; top: 55%; width: 0%;">
 </div>

 

<script> 
$(document).ready(function(){
    function setTopo(){
        $(window).scrollTop(0);
    }
    $(window).bind('scroll', function(){$(window).scrollTop(0);});


        var promocao = $("#promocao");
        /*var horti = $("#hort");
        var feira = $("#feira");*/
        var logo = $("#logo");
        var item = $("#item");
        var valor = $("#valor");
        var bola1 = $("#bola1");
        var bola2 = $("#bola2");
        var bola3 = $("#bola3");
        var bola4 = $("#bola4");
        var imagem = $("#imagem");
        var random;

        var quantidade = <?= $cont ?>;
        var nomes = "<?php echo $nomesAux ?>";
        nomes = nomes.split("|");
        var precos = "<?php echo $precosAux ?>";
        precos = precos.split("|");
        var ids = "<?php echo $idsAux ?>";
        ids = ids.split("|");
        var kg = "<?php echo $kgAux ?>";
        kg = kg.split("|");

        inicio();

        function inicio(){
            //feira.hide();
        bola1.hide();
        item.hide();
        valor.hide();

        promocao.animate({height: '50%',width:'50%', left: '25%', top: '25%'}, "slow");
        logo.animate({right: '4%'}, 400 );
        /*horti.animate({fontSize: '8em', left: '45%', top: '50%'}, "slow", function(){feira.show(); feira.animate({left: '45%', top: '38%'}, 400); ; });*/
         contador = -1;

        setTimeout(function(){
            
                bolas();
           
            
        }, 2500);

       
        }

        
        function bolas(){
            
            
            if(contador == quantidade -1){
                inicio();
                return 0;
            }else{
                contador++;

            }

            
            random = Math.floor(Math.random() * 6);
             
            
            

            switch(random){
                //verdinho e azul
                case 0:
                    //bola 2 é a maior
                    //bola 4 é a do meio
                    //bola 3 é a menor
                    bola2.css({"background-color": "rgba(11, 234, 123, 0.8)"});
                    bola3.css({"background-color": "rgba(136, 147, 142, 0.8)"});
                    bola4.css({"background-color": "rgba(4, 192, 209, 0.8)"});
                break;
                //amarelo e verdinho
                case 1:
                    bola2.css({"background-color": "rgba(255, 255, 0, 0.5)"});
                    bola3.css({"background-color": "rgba(136, 147, 142, 0.9)"});
                    bola4.css({"background-color": "rgba(4, 192, 209, 0.8)"});
                break;
                //amarelo e laranja
                case 2:
                    bola2.css({"background-color": "rgba(255, 255, 0, 0.5)"});
                    bola3.css({"background-color": "rgba(136, 147, 142, 0.8)"});
                    bola4.css({"background-color": "rgba(255, 0, 0, 0.6)"});
                    
                break;
                //amarelo e azul
                case 3:
                    bola2.css({"background-color": "rgba(255, 255, 0, 0.5)"});
                    bola3.css({"background-color": "rgba(136, 147, 142, 0.9)"});
                    bola4.css({"background-color": "rgba(0, 101, 255, 0.8)"});
                break;
                //vermelho e amarelo
                case 4:
                    bola2.css({"background-color": "rgba(255, 22, 22, 0.8)"});
                    bola3.css({"background-color": "rgba(136, 147, 142, 0.9)"});
                    bola4.css({"background-color": "rgba(255, 225, 0, 0.8)"});
                break;
                //vinho co vinhinho
                case 5:
                    bola2.css({"background-color": "rgba(130, 20, 40, 0.8)"});
                    bola3.css({"background-color": "rgba(136, 147, 142, 0.9)"});
                    bola4.css({"background-color": "rgba(255, 255, 255, 0.5)"});
                break;

            }

                
               



            promocao.animate({height: '22%', width:'30%', left: '62%', top: '8%'}, "slow");

            
            imagem.attr("src" , "imagensProd/imagem"+ids[contador]+".png");
            precoUni = precos[contador].split(".");
            

            var unidade = "UN"; 
            if(kg[contador] == 0){
                unidade = "KG";
            }

            item.html(nomes[contador]);
            item.fadeIn(1000);
            valor.html(precoUni[0]+",<sup style='font-size: 0.6em;'>"+precoUni[1]+"</sup><sub style='font-size: 0.4em; color: #fff; left: -90px; '>"+ unidade+"</sub>");
            valor.fadeIn(1000);


            bola1.show();
            bola1.animate({left: '2%', top: '15%',padding: '22%'}, "slow", function(){
                imagem.animate({width:'35%', height: '60%', left: '7%', top: '25%'}, "slow");
            });

            bola2.animate({left: '10%', top: '20%',padding: '15%'}, "slow");
            bola2.animate({left: '-19%', top: '-10%',padding: '38%'}, "slow");

            bola3.animate({left: '10%', top: '20%',padding: '15%'}, "slow");
            bola3.animate({left: '-1%', top: '10%',padding: '25%'}, "slow");
            bola3.animate({left: '-3%', top: '7%',padding: '27%'}, 3000);

            bola4.animate({left: '10%', top: '20%',padding: '15%'}, "slow");
            bola4.animate({left: '-4%', top: '5%',padding: '28%'}, "slow");
            bola4.animate({left: '-6%', top: '2%',padding: '30%'}, 3000, function(){
                bola2.animate({left: '-19%', top: '-15%',padding: '44%'}, "slow", function(){
                    item.fadeOut();
                    valor.fadeOut();
                    
                    bola2.animate({left: '25%', top: '50%',padding: '0%'}, 300);
                    bola4.animate({left: '25%', top: '50%',padding: '0%'}, 350);
                    bola3.animate({left: '25%', top: '50%',padding: '0%'}, 355);
                    bola1.animate({left: '25%', top: '50%',padding: '0%'}, 360);
                    imagem.animate({left: '25%', top: '50%',width: '0%', height: '0%'}, 340, function(){
                        bolas();
                    });
                });
            });


            

            
        }


		/*function animaHoti(){
			horti.css({"left": "50%", "top": "50%", "font-size": "5em"});
		}*/

		
        
        /*promocao.animate({left: '250px'}, "slow");
        promocao.animate({width: '300px', opacity: '0.8'}, "slow");
        promocao.animate({height: '100px', opacity: '0.4'}, "slow");
        promocao.animate({width: '100px', opacity: '0.8'}, "slow");*/
    	
   /* }, 5000);*/

});
</script> 




</body>
</html>