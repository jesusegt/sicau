<!DOCTYPE html>
<html>
	<head>
		<meta charset='UTF-8'>
		<title>SICAU-SG</title>
		<link rel='stylesheet' type='text/css' href='assets/css/estilo.css'>
		<link rel='stylesheet' type='text/css' href='assets/css/menublanco.css'>
		<script type='text/javascript' src='assets/js/regasis.js'></script>
		
		
	</head>
	<body onLoad='startclock()'>

		<header>
				<nav>
					<div class='contenido logo-nav'>

					<label>SICAU-SG</label>

					<label class='uptyab'><img src='assets/img/uptyab.jpg' width='50px' height='50px' class='uptyab'></label>
					</div>
				</nav>
		</header>


		<form name='formulario' class='formulario' onsubmit='return validar(this)' method='post' action='../controlador/ctr_asistencia.php'>
			<table class='tabla tregasis'>
				<tr>
					<td align='center'>
						<h2 class='h2regasis'>Registrar Asistencia</h2>
					</td>
				</tr>
				<tr>
					<td align='center'>
							<input type='text' class='tipotext' id='cedula' name='cedula' autocomplete='off' placeholder='Cedula del Trabajador' value=''>
					</td>
				</tr>
				<?php date_default_timezone_set('America/Caracas'); ?>
				<tr style="display:none;">
					<td align='center'>
							<input type='date' class='tipotext' id='fecha' name='fecha' value='<?php echo date('Y-m-d')?>'>
					</td>
				</tr>
				<tr style="display:none;">
					<td align='center'>
							<input type='time' class='tipotext' id='hora_entrada' name='hora' value='<?php echo date('H:i:s')?>'>
					</td>
				</tr>
				
					<td align='center'>
							<input type='submit' class='btn' name='registrar' value='Registrar'>
					</td>
				</tr>
				<tr>
					<td align='center'>
						<a href='../index.html'>
							<input type='button' class='btn btn_atras' value='REGRESAR'>
						</a>
					</td>
				</tr>
			</table>
		</form>



	</body>
</html>