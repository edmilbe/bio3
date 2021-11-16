<?php
 header("Content-Type: text/html; charset=ISO-8859-1",true);
?>
<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title><?=$this->siteTitle();?></title>
    <script src="<?=PROOT?>js/jquery-2.2.4.min.js"></script>
    <link rel="shortcut icon" href="<?=PROOT?>files/2x_feito/2x_shop_em_baixo3.jpg" type="image/x-png"/>

    <script src="<?=PROOT?>js/bootstrap.min.js"></script>
    <script src="<?=PROOT?>js/shooping.js"></script>
    <script src="<?=PROOT?>js/valid/<?=Session::get(LANG);?>.js"></script>
    <script src="<?=PROOT?>js/home.js"></script>


    <link href="<?=PROOT?>css/all.css" rel="stylesheet" type="text/css">
    <link href="<?=PROOT?>css/interface.css" rel="stylesheet" type="text/css">
    <link href="<?=PROOT?>css/cabecalho.css" rel="stylesheet" type="text/css">
    <link href="<?=PROOT?>css/compra-detalhes.css" rel="stylesheet" type="text/css">
    <link href="<?=PROOT?>css/produtos-view.css" rel="stylesheet" type="text/css">
    <link href="<?=PROOT?>css/shopping-all.css" rel="stylesheet" type="text/css">

    <script>
      s_carrinho();
    </script>
    <?= $this->content('head'); ?>
  </head>
  <body>
  <div class="cont-full">
    <?php include 'main_manu.php'; ?>
    <div class="cont-grupo">
      <div class="group">

          <?= $this->content('body'); ?>

      </div>
    </div>
  </div>
  <?= $this->content('bfooter'); ?>

  <script>

    function minproduct(){
      var fotodivs = document.getElementsByClassName("fotodivs-min");
      var shopping = document.getElementsByClassName("shopping-min");
      var item = document.getElementsByClassName("item-min");

      var i;
      if(innerWidth <= 300){
        for(i = 0; i < fotodivs.length; i++ ){
          fotodivs[i].style.maxWidth  = "70px";
          fotodivs[i].style.height    = "40px";
          shopping[i].style.display   = "none";
          item[i].style.display       = "block";

        }
      }else{
        for(i = 0; i < fotodivs.length; i++ ){
          fotodivs[i].style.maxWidth  = "230px";
          fotodivs[i].style.height    = "150px";
          shopping[i].style.display   = "inline-block";
          item[i].style.display       = "inline-block";

        }
      }

    }
    function menuchange(){
      fechamenu();
      var i;

      if(innerWidth < 1100){
        document.getElementById("nav-menu").style.display = "none";
        for(i = 0; i < document.getElementsByClassName("menu-item").length; i++){
          document.getElementsByClassName("menu-item")[i].style.display = "block";

          document.getElementsByClassName("menu-item")[i].style.textAlign = "left";



        }


        document.getElementById("menu-button").style.display = "inline-block";




      }else{
        for(i = 0; i < document.getElementsByClassName("menu-item").length; i++){
          document.getElementsByClassName("menu-item")[i].style.display = "inline-block";
          document.getElementsByClassName("menu-item")[i].style.textAlign = "center";
        }
        document.getElementById("menu-button").style.display = "none";
        document.getElementById("nav-menu").style.display = "inline-block";




      }
      minproduct()
    }
    function abremenu(){
      document.getElementById("menu-button").style.display = "none";
      document.getElementById("menu-close").style.display = "block";

      document.getElementById("nav-menu").style.display = "inline-block";
    }
    function fechamenu(){
      document.getElementById("menu-close").style.display = "none";
      document.getElementById("menu-button").style.display = "inline-block";

      document.getElementById("nav-menu").style.display = "none";
    }
    window.onresize = menuchange;
    menuchange();
  </script>
  </body>

</html>

<?php

?>

