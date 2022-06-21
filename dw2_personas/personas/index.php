<?php
require('../libs/conex.php');
require('../libs/ciudades.lib.php');
require('../libs/personas.lib.php');
$link=conectar();

session_start();
$_SESSION['errores']=[];

if (isset($_POST['enviar'])) {
 $errores=[];
 if($_POST['cin']==""){
  $error++;
  array_push($errores, "El Número de Cédula de Identidad no puede estar vacio.");
}
 if($_POST['nombre']==""){
  $error++;
  array_push($errores, "El nombre no puede estar vacio.");
}
if($_POST['apellido']==""){
  $error++;
  array_push($errores, "El apellido no puede estar vacio.");
}
if($_POST['fenac']==""){
  $error++;
  array_push($errores, "La fecha no puede estar vacia.");
}
 if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
     $error++;
     array_push($errores,"El email debe ser valido ");
 }
    if($error>0){
      array_push($_SESSION['errores'], $errores);
    }
 }

 ?>
 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>Personas</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
   </head>
   <body>
     <?php
      include('../libs/menu.php');
      ?>
     <div class="container">

     <?php
      if (!($_POST) && !($_GET)){
        include('list.php');
      }
      elseif ($_GET['mod']=="new"){
        $ciudades=mostrarCiudades($link);
        if($error>0){
          include('formWE.php');
        }
        include('form.php');
      }
      elseif ($_GET['mod']=="edit"){
        if ($_GET['id']){
          $ciudades=mostrarCiudades($link);
          $res=mostrarPorId($link,$_GET['id']);
          include('form.php');
        }
      }
      elseif ($_GET['mod']=="delete"){
        if ($_GET['id']) {
          borrarPersona($link,$_GET);
          include('list.php');
        }
      }elseif ($_POST) {
        if($error>0){
          $ciudades=mostrarCiudades($link);
          include('formWE.php');
          include('form.php');
        }else{
          if ($_POST['id']==-1){
            $salida= agregarPersona($link,$_POST);
            include('list.php');
            //echo $salida;
          } elseif ($_POST['id']!='') {
            $salida= editarPersona($link,$_POST);
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
