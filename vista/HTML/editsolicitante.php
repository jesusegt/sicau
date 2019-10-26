<?php
session_start();

$datos = $_SESSION['mostrarper'];//arreglo que trae los datos de la tabla
foreach($datos as $d)
{
	//se optiene el valor de cada campo de la tabla
	$cedula=$d['cedula'];
	$nombre=$d['nombre'];
	$apellido=$d['apellido'];
}
?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf-8'>
		<title>SICAU-SG</title>
		<link rel='stylesheet' type='text/css' href='../CSS/trabajadores.css'>
		<script type='text/javascript' src='../JS/validaciones.js'></script>
	</head>
	<body>

		<div class='contenedor'>
			<h1 class='page-title'>
				<i></i>
				Editar Solicitante
			</h1>
			<a href='solicitantes.html' class='btn btn-warning'>
				<i></i>
				<span>Volver a la lista</span>
			</a>		
		</div>

		<div class='contenedor'>
			<div class='panel panel-bordered'>
				<form name='formulario' class='formulario' onsubmit='return validarsolicitante(this)' method='post' action='../controlador/ctr_solicitante.html'>
					<div class='panel-body'>
						<div class='form-group'>
							<label for='cedula'>Cédula</label>
							<input type='text' class='form-control' name='cedula' placeholder='...' value='<?php echo"$cedula"; ?>' autocomplete='off' onkeypress='return soloNumeros(event)' maxlength='10'>
						</div>
						<div class='form-group'>
							<label for='nombre'>Nombre</label>
							<input type='text' class='form-control' name='nombre' placeholder='...' value='<?php echo"$nombre"; ?>' autocomplete='off' onkeypress='return soloLetras(event)' onblur='limpia()' id='miInput'>
						</div>
						<div class='form-group'>
							<label for='apellido'>Apellido</label>
							<input type='text' class='form-control' name='apellido' placeholder='...' value='<?php echo"$apellido"; ?>' autocomplete='off' onkeypress='return soloLetras(event)' onblur='limpia()' id='miInput'>
						</div>
					</div>

					<div class='panel-footer'>
						<a href='infosolicitante.php'>
							<input type='button' class='btn btn-primary' name='guardar' value='Cancelar'>
						</a>
						<input type='submit' class='btn btn-primary' name='guardar' value='Guardar'>
					</div>
				</form>
			</div>
		</div>

		


	</body>
</html>

<?php
$_SESSION['mostrarper'] ="";//se vacia la variable sesion
?>
