<?php
require_once('../libs/conex.php');
require('../libs/ciudades.lib.php');

// CORS
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST');
    header("Access-Control-Allow-Headers: X-Requested-With");
// cors fin
header("Content-Type: application/json; charset=UTF-8");
$link=conectar();
if (!$_GET['id'])
{
$res=mostrarCiudades($link);
}
else
{
$res=mostrarCiudad($link,$_GET['id']);
}
$dbdata = array();
  while ( $row = $res->fetch_assoc())  {
	$dbdata[]=$row;
  }

 echo json_encode($dbdata);
?>
