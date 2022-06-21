<?php
require('../libs/conex.php');
require('../libs/ciudades.lib.php');
$link=conectar();

 session_start();
 $_SESSION['errores']=[];

 if (isset($_POST['enviar'])) {
 	$errores=[];
    if($_POST['ciudad']==""){
   		$error++;
   		array_push($errores, "La ciudad no puede estar vacia.");
   	}
     if($error>0){
       array_push($_SESSION['errores'], $errores);
     }
  }
  ?>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>Ciudades</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
   </head>
   <body>
     <?php
     	include('../libs/menu.php')
      ?>
      <div class="container">



     <?php
      if (!($_POST) && !($_GET))
      {
        include('list.php');
      }
        elseif ($_GET['mod']=="new")
        {
          if($error>0){
            include('formWE.php');
            include('form.php');
          }else{
            include('form.php');
          }
        }
        elseif ($_GET['mod']=="edit")
        {
        if ($_GET['id'])
        {
          $res=mostrarCiudad($link,$_GET['id']);
          include('form.php');
        }
        }
        elseif ($_GET['mod']=="delete")
        {
            if ($_GET['id']) {
              borrarCiudad($link,$_GET);
              include('list.php');
              // code...
            }

        }elseif ($_POST) {
          // code...
          if($error>0){
            include('formWE.php');
            include('form.php');
          }else{
            if ($_POST['id']==-1)
            {
              $salida= agregarCiudad($link,$_POST);
              include('list.php');
              //echo $salida;
            } elseif ($_POST['id']!='') {
              $salida= editarCiudad($link,$_POST);
              include('list.php');
            }
          }
        }

      ?>
      </div>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
      <footer style=" margin-top: 5%"></footer>
   </body>
 </html>
