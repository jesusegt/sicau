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
	<body style="background: none;">


		<form name='formulario' class='formulario' onsubmit='return validaractividad(this);' method='post' action='../../../controlador/ctr_actividad.php'>
			<table class='tabla tregasis'>
				<tr>
					<td align='center'>
						<h2 class='h2regasis'>Registrar Actividad</h2>
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
				<tr>			
					<td align='center'>
							<input type='submit' class='btn' name='registrar' value='Registrar'>
					</td>
				</tr>
			</table>
		</form>
<script type='text/javascript' src='../../assets/js/validaciones.js'></script>

<?php 
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
										</tr>
									</thead>
									<tbody>";

	@$datosrep = $_SESSION['reportarcat'];

	foreach(@$datosrep as $r):

		$fecha_bd1= $r->fechaact;
		$fecha_nueva1 = date('d-m-Y', strtotime($fecha_bd1));

	$html .= "
		<tr>
			<td style='color: #526069;'>".$r->cedulasol."</td>
			<td style='color: #526069;'>".$r->nombresol." ".$r->apellidosol."</td>
			<td style='color: #526069;'>".$fecha_nueva1."</td >
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