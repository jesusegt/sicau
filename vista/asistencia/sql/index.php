<?php 
session_start();
	
	if(@$_GET['sql']){ @$sql = $_GET['sql']; }
	if(@$_SESSION['sql']){ @$sql = $_SESSION['sql']; }

	if($sql=="a"){  //si no existe datos registrado
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset='UTF-8'>
		<title>SICAU-SG</title>
		<link rel='stylesheet' type='text/css' href='../../assets/css/estilo.css'>
	</head>
	<body>


		<form name='formulario' class='formulario' onsubmit='return validarasistencia(this)' method='post' action='../../../controlador/ctr_asistencia.php'>
			<table class='tabla tregasis'>
				<tr>
					<td align='center'>
						<h2 class='h2regasis'>Registrar Asistencia</h2>
					</td>
				</tr>
				<tr>
					<td align='center'>
							<input type='text' class='tipotext' id='cedula' name='cedula' autocomplete='off' placeholder='Cedula del Trabajador' value='' maxlength='10' onkeypress='return soloNumeros(event)'>
					</td>
				</tr>
				<?php date_default_timezone_set('America/Caracas'); ?>
				<tr style="display:;">
					<td align='center'>
							<input type='date' class='tipotext' id='fecha' name='fecha' value='<?php echo date('Y-m-d')?>'>
					</td>
				</tr>
				<tr style="display:;">
					<td align='center'>
							<input type='time' class='tipotext' id='hora_entrada' name='hora' value='<?php echo date('H:i:s')?>'>
					</td>
				</tr>
				
					<td align='center'>
							<input type='submit' class='btn' name='registrar2' value='Registrar'>
					</td>
				</tr>
			</table>
		</form>
<script type='text/javascript' src='../../assets/js/validaciones.js'></script>
<?php 
}if($sql=="i"){
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset='utf-8'>
	<title>SICAU-SG</title>
	<link rel='stylesheet' type='text/css' href='../../assets/data/datatables.min.css'>
	<link rel='stylesheet' type='text/css' href='../../assets/css/trabajadores.css'>
	<link rel='stylesheet' type='text/css' href='../../assets/data/main.css'>

</head>
<body>


		<div class='contenedor'>
			<h1 class='page-title'>
				<i></i>
				Asistencias
			</h1>
			<a href='../../../controlador/ctr_asistencia.php?list=1' class='btn btn-warning'>
				<i></i>
				<span>Volver</span>
			</a>	
		</div>
		<div class='contenedor'>
			<div class='panel panel-bordered'>
				<div class='panel-body'>
					<!--<div class='busqueda'>
						<input type='text' name='buscar' placeholder='Buscar' class='inputbusqueda' id='buscar'>
					</div>-->
					<div class='tabla'>
						<table class='table table-hover' id='tabla'>
							<thead>
								<tr>
									<th>Cédula</th>
									<th>Nombre y Apellido</th>
									<th>Fecha</th>
									<th>Hora</th>
									<th>Accion</th>
								</tr>
							</thead>
							<tbody>
								<?php
									if(@$_SESSION['catalago']){
									@$datoss = $_SESSION['catalago'];//arreglo que trae los datos de la tabla

									foreach(@$datoss as $r): 
								?>
									<tr>
										<td><?php echo $r->cedulasol; ?></td>
										<td><?php echo $r->nombresol." ".$r->apellidosol; ?></td>
										<td>
											<?php 
												$fecha_bd= $r->fechaasis;
												$fecha_nueva = date('d-m-Y', strtotime($fecha_bd));
												echo $fecha_nueva;
											?>
										</td>
										<td>
											<?php
												$hora_bd = $r->hora;
												$hora_nueva = date ('h:i A', strtotime($hora_bd));
												echo $hora_nueva;
											?>
										</td>
										<td>
											<?php echo $r->accion; ?>
										</td>
									</tr>
								<?php endforeach; 
									}
								?>
							</tbody>
						</table>
					</div>
					<!--
						<div class='pull-left'>
							<div class='show-res'>
								Mostrando todas las entradas
							</div>
						</div>
						<div class='pull-right'>
								<ul class='pagination' id='pagina'>
									
								</ul>
						</div>
					-->
				</div>
			</div>
		</div>

<script type='text/javascript' src='../../assets/data/jquery/jquery-3.3.1.min.js'></script>
<script type='text/javascript' src='../../assets/data/datatables.min.js'></script>
<script type='text/javascript' src='../../assets/data/main.js'></script>

	<?php 
	$_SESSION['list']=null;
	$_SESSION['sql']=null;
	$_SESSION['selectid']=null;
	$_SESSION['mostrarper']=null;
	$_SESSION['catalago']=null; 
	?>
<?php } if($sql=="mr"){	
?>
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
<?php 
	}
if($sql=='r'){

	ini_set("memory_limit","124M");
	set_time_limit(300);

	require_once("../../assets/dompdf/dompdf_config.inc.php");

	date_default_timezone_set('America/Caracas');

	$fecha=date('Y-m-d');

	$fecha_bd= $fecha;
	$fecha_nueva = date('d-m-Y', strtotime($fecha_bd));

	$aristides='"Aristides Bastidas"';

	$html =
		"<!DOCTYPE html>
		<html>
		<head>
			<link rel='stylesheet' type='text/css' href='../../assets/css/reportes.css'>
		</head>
		<body>
				<div class='contenedor'>
					<h1 class='sicau-sg'>SICAU-SG</h1>
					<span>Unidad Servicios Generales</span><br>
					<span>Universidad Politecnica Territorial de Yaracuy ".$aristides."</span><br>
					<span>Independencia, Yaracuy</span><br>
					<span>Venezuela</span>
					<img src='../../assets/img/uptyab.jpg' class='img'>
				</div>
					<h1 class='page-title'>
						<i></i>
						Reporte Todas las Asistencias
					</h1>
				<div class='contenedor'>
					<div class='panel panel-bordered'>
						<div class='panel-body'>
							<div class='tabla'>
								<table class='table table-hover' id='tabla'>
									<thead>
										<tr>
											<th>Cédula</th>
											<th>Nombre y Apellido</th>
											<th>Fecha</th>
											<th>Hora de Entrada</th>
											<th>Hora de Salida</th>
										</tr>
									</thead>
									<tbody>";

	@$datosrep = $_SESSION['reportarcat'];

	foreach(@$datosrep as $r):

		$fecha_bd1= $r->fechaasis;
		$fecha_nueva1 = date('d-m-Y', strtotime($fecha_bd1));

		$hora_bd = $r->horaen;
		$hora_nueva = date ('h:i A', strtotime($hora_bd));

		$hora_bd2 = $r->horasa;
		$hora_nueva2 = date ('h:i A', strtotime($hora_bd2));

	$html .= "
		<tr>
			<td style='color: #526069;'>".$r->cedulasol."</td>
			<td style='color: #526069;'>".$r->nombresol." ".$r->apellidosol."</td>
			<td style='color: #526069;'>".$fecha_nueva1."</td >
			<td style='color: #526069;'>".$hora_nueva."</td>
			<td style='color: #526069;'>".$hora_nueva2."</td>
		</tr>";
	endforeach;
	$html .= "
		</tbody></table>
		</div></div>
		</div></div>
		<div class='footer'>
			<span >PRIVADO Y CONFIDENCIAL</span>
			<span class='sicau'>| SICAU-SG</span>
		</div>
		<div class='pull-right'>
			<span class='pull-right'>$fecha_nueva</span>
		</div>
		</body></html>";

	$dompdf = new DOMPDF();
	$dompdf->set_paper('a4', 'portrait'); 
	$dompdf->load_html(utf8_decode($html));
	$dompdf->render($html);
	$dompdf->stream("SICAU-ASISTENCIAS.pdf", array('Attachment'=>'0'));
}
?>
	</body>
</html>

