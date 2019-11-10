<!DOCTYPE html>
<html>
	<head>
		<meta charset='UTF-8'>
		<title>SICAU-SG</title>
		<link rel='stylesheet' type='text/css' href='../../assets/css/estilo.css'>
		<link rel='stylesheet' type='text/css' href='../../assets/css/menureporte.css'>
	</head>
	
	<body>


		<form name='formulario' class='formulario' onsubmit='return validarreporte(this)' method='post' action='../../../controlador/ctr_asistencia.php' target='blank' id='form'>
			<table class='tabla tregasis'>
				<tr>
					<td align='center'>
						<h2 class='h2regasis'>Periodo a Consultar</h2>
					</td>
				</tr>
				<tr>
					<td align='center'>
							<select class='tipotext' name='tipo_rep' id='tipo_rep' onchange='seleccionado()'>
								<option value=''>...</option>
								<option value='1'>Últimos 15 días</option>
								<option value='2'>Mes especifico</option>
								<option value='3'>Todas</option>
								<option value='4'>Personalizado</option>
							</select>
					</td>
				</tr>
				<tr id='perso' class='ocultar box' >
					<td align='center'>
							<input type='date' class='tipotext' id='fecha1' name='fechaini' value=''>
					</td>
				</tr>
				<tr id='perso2' class='ocultar box' >
					<td align='center'>
							<input type='date' class='tipotext' id='fecha2' name='fechafin' value=''>
					</td>
				</tr>
				<tr id='mess' class='ocultar box' >
					<td align='center'>
							<select class='tipotext' name='mes' id='mes'>
								<option value=''>...</option>
								<option value='01'>Enero</option>
								<option value='02'>Febrero</option>
								<option value='03'>Marzo</option>
								<option value='04'>Abril</option>
								<option value='05'>Mayo</option>
								<option value='06'>Junio</option>
								<option value='07'>Julio</option>
								<option value='08'>Agosto</option>
								<option value='09'>Septiembre</option>
								<option value='10'>Octubre</option>
								<option value='11'>Noviembre</option>
								<option value='12'>Diciembre</option>

							</select>
					</td>
				</tr>
				
					<td align='center'>
							<input type='submit' class='btn' name='reporte' value='Procesar'>
					</td>
				</tr>
			</table>
		</form>
<script type='text/javascript' src='../../assets/js/jquery-3.3.1.min.js'></script>
<script type='text/javascript' src='../../assets/js/reporte.js'></script>
</body></html>