<?php
session_start();
?>
<?php
if (!$_SESSION['personas']) {
	$_SESSION['personas']=[];
}
	array_push($_SESSION['personas'], $_POST);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
	<meta charset="utf-8">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<title>Here we go again</title>
</head>
<body>
	<div class="container">
		<div id="form">
		  <form class="container" action="formulario.php" method="post">

		  <!-- Last name input -->
		  <div class="form-outline mb-4">
		    <input type="text" name="apellido" class="form-control" placeholder="Ingrese el apellido" />
		    <label class="form-label" for="form4Example2">Apellidos</label>
		  </div>

		  <!-- Name input -->
		  <div class="form-outline mb-4">
		    <input type="text" name="nombre" class="form-control" placeholder="Ingrese el nombre" />
		    <label class="form-label" for="form4Example3">Nombres</label>
		  </div>

		  <!-- birthdate input -->
		  <div class="form-outline mb-4">
		    <input type="date" name="fenac" class="form-control" data-date-format="DD/MMM/YYY"/>
		    <label class="form-label" for="form4Example3">Fecha de Nacimiento</label>
		  </div>

		  <!-- Submit button -->
		  <button type="submit" value="enviar" class="btn btn-primary btn-block mb-4">Send</button>
		</form>

		</div>
	</div>




<?php
	$errores=[];
	$error=0;
	if($_POST['nombre']==""){
		$error++;
		array_push($errores, "El nombre no puede estar vacio.");
	}
	if($_POST['apellido']==""){
		$error++;
		array_push($errores, "El apellido no puede estar vacio.");
	}
	$nfecha=date_parse($_POST['fenac']);
	if($nfecha['error_count']){
		$error++;
		array_push($errores, "La fecha debe ser válida.");
	}

	if ($error>0) {
		print_r($errores);
		echo "<br><br>La solicitud no puede ser validada.";
	}else{
		echo 	"<table  class="."table table-striped".">
		<div class="."container".">
			<thead>
			  	<tr id="."tab_cabe".">
				    <th>Apellido</th>
				    <th>Nombre</th>
				    <th>F. Nacimiento</th>
				</tr>
			</thead>
			<tbody id="."tab_datos".">
				<tr>";
			for ($i=0; $i<count($_SESSION['personas']) ; $i++) {
				echo "<td>".$_SESSION['personas'][$i]['apellido']."</td><td>".$_SESSION['personas'][$i]['nombre']."</td><td>".$_SESSION['personas'][$i]['fenac']."</td>"."</tr>";
			}
			echo "</tbody>
		</div>
	</table>";
	}
?>
</body>
</html>
