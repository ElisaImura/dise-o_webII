<?php
require('../libs/conex.php');
require('../libs/ciudades.lib.php');
require('../libs/personas.lib.php');
// CORS
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST');
    header("Access-Control-Allow-Headers: X-Requested-With");
// cors fin
header("Content-Type: application/json; charset=UTF-8");
$link=conectar();
if (!$_GET['id'])
{
$res=mostrarTodos($link);
}
else
{
$res=mostrarPorId($link,$_GET['id']);
}
$dbdata = array();
//Fetch into associative array
  while ( $row = $res->fetch_assoc())  {
	$dbdata[]=$row;
  }
//Print array in JSON format
 echo json_encode($dbdata);

?>
