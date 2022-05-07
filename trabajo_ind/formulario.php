<?php
session_start();
if (@!$_SESSION['personas']) {
	$_SESSION['personas']=[];
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
	<meta charset="utf-8">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<title>Here we go again</title>
</head>
<body style="align-items:center;">
	<div class="container">
		<div class="col-4">
		  <form class="container" action="formulario.php" method="post" style="margin-bottom: 100px; margin-top: 150px; margin-left: 100%">

		  <!-- Last name input -->
		  <div class="form-outline mb-4">
		    <input type="text" name="apellido" class="form-control" placeholder="Ingrese el apellido" />
		    <label class="form-label" for="form4Example2">Last name</label>
		  </div>

		  <!-- Name input -->
		  <div class="form-outline mb-4">
		    <input type="text" name="nombre" class="form-control" placeholder="Ingrese el nombre" />
		    <label class="form-label" for="form4Example3">Name</label>
		  </div>

		  <!-- birthdate input -->
		  <div class="form-outline mb-4">
		    <input type="date" name="fenac" class="form-control" data-date-format="DD/MMM/YYY"/>
		    <label class="form-label" for="form4Example3">Date of birth</label>
		  </div>

		  <!-- Submit button -->
		  <button type="submit" name="enviar" class="btn btn-primary btn-block mb-4">Send</button>
			<button type="submit" name="borrar" class="btn btn-primary btn-block mb-4">Delete</button>
			<button type="submit" name="destruir" class="btn btn-primary btn-block mb-4">Destroy</button>
		</form>

		</div>
	</div>

<?php
	if (isset($_POST['borrar'])) {
		unset($_SESSION['personas']);
	}

	if (isset($_POST['destruir'])) {
		session_destroy();
	}
?>

<?php
	if (isset($_POST['enviar'])) {
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
			array_push($_SESSION['personas'], $_POST);
		}
		echo 	"<table  class="."table table-secondary>
		<div class="."container".">
			<div class="."col-4".">
			<thead>
			  	<tr id="."tab_cabe".">
				    <th>Apellido</th>
				    <th>Nombre</th>
				    <th>F. Nacimiento</th>
				</tr>
			</thead>
			</div>
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
