<?php
session_start();

$datoss = $_SESSION['selectci'];//arreglo que trae los datos de la tabla
foreach($datoss as $d){
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
			<a href='solicitantes.html' class='btn btn-warning'>
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
			</div>
			
		</div>



	</body>
</html>
<?php
$_SESSION['selectci']="";//se vacia la variable sesion
?>