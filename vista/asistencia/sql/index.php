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
							<input type='text' class='tipotext' id='cedula' name='cedula' autocomplete='off' placeholder='Cédula del Obrero' value='' maxlength='10' onkeypress='return soloNumeros(event)'>
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
}if($sql=="i"){ // CATALOGO INCOMPLETAS
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset='utf-8'>
	<title>SICAU-SG</title>
	<link rel='stylesheet' type='text/css' href='../../assets/data/datatables.min.css'>
	<link rel='stylesheet' type='text/css' href='../../assets/css/trabajadores.css'>
	<link rel='stylesheet' type='text/css' href='../../assets/data/main.css'>
	<link rel='stylesheet' type='text/css' href='../../assets/css/modal.css'>
	<link rel='stylesheet' type='text/css' href='../../assets/jquery-ui/jquery-ui.min.css'>


</head>
<body>

<!-- MODAL -->
	<div id="boxes">

	<div id="dialog" class="window">
		<form name='formulario' class='formulario' onsubmit='return validarreporte(this)' method='post' action='../../../controlador/ctr_asistencia.php' target='blank' id='form'>
			<table class='tablam tregasis'>
				<tr>
					<td align='center'>
						<h2 class='h2regasis'>
							Periodo a Consultar 
							<!-- BOTON CERRAR MODAL -->
							<a href="#" class="close" onclick='cerrar()'>
								<img src='../../assets/img/close.png' width='20px' height='20px'>
							</a>
						</h2>

					</td>
				</tr>
				<tr>
					<td align='center'>
							<select class='tipotext select' name='tipo_rep' id='tipo_rep' onchange='seleccionado()'>
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
							<input type='text' class='tipotext' id='fecha_ini' name='fechaini' value='' placeholder='dd-mm-aa' maxlength='10' autocomplete='off' onkeypress='return soloFecha(event)'>
					</td>
				</tr>
				<tr id='perso2' class='ocultar box' >
					<td align='center'>
							<input type='text' class='tipotext' id='fecha_fin' name='fechafin' value='' placeholder='dd-mm-aa' maxlength='10' autocomplete='off' onkeypress='return soloFecha(event)'>
					</td>
				</tr>
				<tr id='mess' class='ocultar box' >
					<td align='center'>
							<select class='tipotext select' name='mes' id='mes'>
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
							<input type='submit' class='btn_modal' name='reporte2' value='Procesar'>
					</td>
				</tr>
			</table>
		</form> 
	</div>
	<!-- FONDO CON DESENFOQUE-->	
 		<div id="mask" class='mask'></div>
	</div>

<!-- CONTENIDO PÁGINA -->
		<div class='contenedor'>
			<h1 class='page-title'>
				<i></i>
				Asistencias
			</h1>
			<a href='../../../controlador/ctr_asistencia.php?list=1' class='btn btn-warning'>
				<i></i>
				<span>Volver</span>
			</a>
			<a href='#dialog' class='btn btn_imprimir' style='margin-left: 3px;' name='modal'>
				<i></i>
				<span>Reporte</span>
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
<script type='text/javascript' src='../../assets/js/modal.js'></script>
<script type='text/javascript' src='../../assets/js/validaciones.js'></script>
<script type='text/javascript' src='../../assets/js/reporte.js'></script>
<script type='text/javascript' src='../../assets/jquery-ui/jquery-ui.min.js'></script>
<script type='text/javascript' src='../../assets/jquery-ui/jquery.ui.datepicker-es.js'></script>
<script type="text/javascript">
	$(function () {
		$.datepicker.setDefaults($.datepicker.regional["es"]);
			$("#fecha_ini,#fecha_fin").datepicker({
				beforeShowDay: $.datepicker.noWeekends 
			});
	});
</script>

<?php 
	$_SESSION['list']=null;
	$_SESSION['sql']=null;
	$_SESSION['selectid']=null;
	$_SESSION['mostrarper']=null;
	$_SESSION['catalago']=null;
	$_SESSION['reportarcat']=null;

}if($sql=='r'){ //REPORTE COMPLETAS

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
			<link rel='stylesheet' type='text/css' href='../../assets/css/reportes2.css'>
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
								<table class='table table-hover full' id='tabla'>
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
	$_SESSION['sql']=null;
	$_SESSION['reportarcat']=null;

}if($sql=="t"){ //REPORTE INCOMPLETAS

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
			<link rel='stylesheet' type='text/css' href='../../assets/css/reportes2.css'>
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
								<table class='table table-hover full' id='tabla'>
									<thead>
										<tr>
											<th>Cédula</th>
											<th>Nombre y Apellido</th>
											<th>Fecha</th>
											<th>Hora</th>
											<th>Accion</th>
										</tr>
									</thead>
									<tbody>";

	@$datosrep = $_SESSION['reportarcat'];

	foreach(@$datosrep as $r):

		$fecha_bd1= $r->fechaasis;
		$fecha_nueva1 = date('d-m-Y', strtotime($fecha_bd1));

		$hora_bd = $r->hora;
		$hora_nueva = date ('h:i A', strtotime($hora_bd));

	$html .= "
		<tr>
			<td style='color: #526069;'>".$r->cedulasol."</td>
			<td style='color: #526069;'>".$r->nombresol." ".$r->apellidosol."</td>
			<td style='color: #526069;'>".$fecha_nueva1."</td >
			<td style='color: #526069;'>".$hora_nueva."</td>
			<td style='color: #526069;'>".$r->accion."</td>
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
	$_SESSION['sql']=null;
	$_SESSION['reportarcat']=null;
}
?>
	</body>
</html>

