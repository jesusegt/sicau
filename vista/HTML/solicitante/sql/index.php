<?php 
session_start();
	
	if(@$_GET['sql']){ @$sql = $_GET['sql']; }
	if(@$_SESSION['sql']){ @$sql = $_SESSION['sql']; }

	if($sql=="a"){  //si no existe datos registrado
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf-8'>
		<META http-equiv="Content-Type" content="text/html; charset=iso-8859-1" >
		<title>SICAU-SG</title>
		<link rel='stylesheet' type='text/css' href='../../../CSS/trabajadores.css'>
		<script type='text/javascript' src='../../../JS/validaciones.js'></script>
	</head>
	<body>

		<div class='contenedor'>
			<h1 class='page-title'>
				<i></i>
				Añadir Solicitante
			</h1>
			<a href='../../../controlador/ctr_solicitante.php?list=1' class='btn btn-warning'>
				<i></i>
				<span>Volver a la lista</span>
			</a>
			
		</div>

		<div class='contenedor'>
			<div class='panel panel-bordered'>
				<form name='formulario' class='formulario' onsubmit='return validarsolicitante(this)' method='post' action='../../../controlador/ctr_solicitante.php'>
					<div class='panel-body'>
						<div class='form-group'>
							<label for='cedula'>Cédula</label>
							<input type='text' class='form-control' name='cedula' placeholder='...' value='' autocomplete='off' onkeypress='return soloNumeros(event)' maxlength='10'>
						</div>
						<div class='form-group'>
							<label for='nombre'>Nombre</label>
							<input type='text' class='form-control' name='nombre' placeholder='...' value='' autocomplete='off' onkeypress='return soloLetras(event)' onblur='limpia()' id='miInput'>
						</div>
						<div class='form-group'>
							<label for='apellido'>Apellido</label>
							<input type='text' class='form-control' name='apellido' placeholder='...' value='' autocomplete='off' onkeypress='return soloLetras(event)' onblur='limpia()' id='miInput'>
						</div>
					</div>

					<div class='panel-footer'>
						<input type='submit' class='btn btn-primary save' name='guardar' value='Guardar'>
					</div>
				</form>
<?php 
	}
	if($sql=="c"){//si se trata de una consulta 

@$datosc = $_SESSION['selectci'];//arreglo que trae los datos de la tabla
foreach($datosc as $c){
	//se optiene el valor de cada campo de la tabla
	@$cedula=$c['cedula'];
	@$nombre=$c['nombre'];
	@$apellido=$c['apellido'];
}
?>

<!DOCTYPE html>
	<html>
	<head>
		<meta charset='utf-8'>
		<title>SICAU-SG</title>
		<link rel='stylesheet' type='text/css' href='../CSS/trabajadores.css'>
		<script type='text/javascript'></script>
	</head>
	<body>

		<div class='contenedor'>
			<h1 class='page-title'>
				<i></i>
				Viendo Solicitante
			</h1>
			<a href='editsolicitante.php' class='btn btn-primary'>
				<i></i>
				<span>Editar</span>
			</a>
			&nbsp;
			<a href='../../../controlador/ctr_solicitante.php?list=1' class='btn btn-warning'>
				<i></i>
				<span>Volver a la lista</span>
			</a>
			
		</div>

		<div class='contenedor'>
			<div class='panel panel-bordered' style='padding-bottom: 5px;'>

				<div class='panel-heading' style='border-bottom: 0;'>
					<h3 class='panel-title'>Cédula</h3>
				</div>
				<div class='panel-body panel-divisor padding-divisor' style='padding-top: 0;'>
					<p><?php echo"$cedula"; ?></p>
				</div>

				<hr style='margin:0;'>	

				<div class='panel-heading' style='border-bottom: 0;'>
					<h3 class='panel-title'>Nombre</h3>
				</div>
				<div class='panel-body' style='padding-top: 0;'>
					<p><?php echo"$nombre $apellido"; ?></p>
				</div>
<?php 
	}
	if($sql=="m"){ //si se trata de actualizar
@$datosm = $_SESSION['mostrarper'];//arreglo que trae los datos de la tabla
foreach($datosm as $d){
	//se optiene el valor de cada campo de la tabla
	@$cedula=$d['cedula'];
	@$nombre=$d['nombre'];
	@$apellido=$d['apellido'];
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
			<a href='../../../controlador/ctr_solicitante.php?list=1' class='btn btn-warning'>
				<i></i>
				<span>Volver a la lista</span>
			</a>		
		</div>

		<div class='contenedor'>
			<div class='panel panel-bordered'>
				<form name='formulario' class='formulario' onsubmit='return validarsolicitante(this)' method='post' action='../../../controlador/ctr_solicitante.php'>
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
						<input type='submit' class='btn btn-primary' name='accion' value='Actualizar'>
					</div>
				</form>
<?php 
	}
?>
			</div>
		</div>
	</body>
</html>