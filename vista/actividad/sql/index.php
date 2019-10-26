
<!DOCTYPE html>
<html>
	<head>
		<meta charset='UTF-8'>
		<title>SICAU-SG</title>
		<link rel='stylesheet' type='text/css' href='../../assets/css/estilo.css'>
		<script type='text/javascript' src='../../assets/js/regasis.js'></script>
		
		
	</head>
	<body style="background: none;">


		<form name='formulario' class='formulario' onsubmit='return validar(this)' method='post' action='../../../controlador/ctr_actividad.php'>
			<table class='tabla tregasis'>
				<tr>
					<td align='center'>
						<h2 class='h2regasis'>Registrar Actividad</h2>
					</td>
				</tr>
				<tr>
					<td align='center'>
							<input type='text' class='tipotext' id='cedula' name='cedula' autocomplete='off' placeholder='Cedula del Obrero' value=''>
					</td>
				</tr>
				<?php date_default_timezone_set('America/Caracas'); ?>
				<tr style="display:;">
					<td align='center'>
							<input type='date' class='tipotext' id='fecha' name='fecha' value='<?php echo date('Y-m-d')?>'>
					</td>
				</tr>
				<tr>			
					<td align='center'>
							<input type='submit' class='btn' name='registrar' value='Registrar'>
					</td>
				</tr>
			</table>
		</form>



	</body>
</html>