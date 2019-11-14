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
		<title>SICAU-SG</title>
		<link rel='stylesheet' type='text/css' href='../../assets/css/trabajadores.css'>
		<link rel='stylesheet' type='text/css' href='../../assets/jquery-ui/jquery-ui.min.css'>
		
	</head>
	<body>

		<div class='contenedor'>
			<h1 class='page-title'>
				<i></i>
				Añadir Permiso
			</h1>
			<a href='../../../controlador/ctr_permiso.php?list=1' class='btn btn-warning'>
				<i></i>
				<span>Volver a la lista</span>
			</a>
			
		</div>

		<div class='contenedor'>
			<div class='panel panel-bordered'>
				<form name='formulario' class='formulario' onsubmit='return validarpermiso(this)' method='post' action='../../../controlador/ctr_permiso.php'>
					<div class='panel-body'>
						<div class='form-group'>
							<label for='cedula'>Cédula</label>
							<input type='text' class='form-control' name='cedula' placeholder='...' value='' autocomplete='off'  id='miInput' onkeypress='return soloNumeros(event)' maxlength='10'>
						</div>
						<div class='form-group'>
							<label for='motivo'>Motivo</label>
							<input type='text' class='form-control' name='motivo' placeholder='...' value='' autocomplete='off'  id='miInput' maxlength='50' onkeypress='return soloAlfanumerico(event)' onkeyup='mayusculainicial(this)'>
						</div>
						<div class='form-group'>
							<label for='fecha_inicial'>Fecha Inicial</label>
							<input type='text' class='form-control' name='fecha_inicial' placeholder='dd-mm-aa' value='' autocomplete='off'  id='fecha_ini' onkeypress='return soloFecha(event)'>
						</div>

						<div class='form-group'>
							<label for='fecha_final'>Fecha Final</label>
							<input type='text' class='form-control' name='fecha_final' placeholder='dd-mm-aa' value='' autocomplete='off'  id='fecha_fin' onkeypress='return soloFecha(event)'>
						</div>
						
					<div class='panel-footer'>
						<input type='submit' class='btn btn-primary save' name='guardar' value='Guardar'>
					</div>
				</form>
<script type='text/javascript' src='../../assets/js/validaciones.js'></script>
<script type='text/javascript' src='../../assets/js/jquery-3.3.1.min.js'></script>
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
	}
	if($sql=="c"){//si se trata de una consulta 

@$datosc = $_SESSION['selectid'];//arreglo que trae los datos de la tabla
foreach($datosc as $c){
	//se optiene el valor de cada campo de la tabla
	@$idperm=$c['idperm'];
	@$cedulasol=$c['cedulasol'];
	@$nombresol=$c['nombresol'];
	@$apellidosol=$c['apellidosol'];
	@$motivo=$c['motivo'];
	@$fechaini=$c['fechaini'];
	@$fechafin=$c['fechafin'];
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset='utf-8'>
	<title>SICAU-SG</title>
	<link rel='stylesheet' type='text/css' href='../../assets/css/trabajadores.css'>
	<script type='text/javascript' src='../../assets/js/validaciones.js'></script>
</head>
<body>

	<div class='contenedor'>
			<h1 class='page-title'>
				<i></i>
				Viendo Permiso
			</h1>
			&nbsp;
			<a href='../../../controlador/ctr_permiso.php?list=1' class='btn btn-warning'>
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
					<p><?php echo"$cedulasol"; ?></p>
				</div>	

				<hr style='margin:0;'>

				<div class='panel-heading' style='border-bottom: 0;'>
					<h3 class='panel-title'>Nombre y Apellido</h3>
				</div>
				<div class='panel-body panel-divisor padding-divisor' style='padding-top: 0;'>
					<p><?php echo"$nombresol $apellidosol"; ?></p>
				</div>	

				<hr style='margin:0;'>


				<div class='panel-heading' style='border-bottom: 0;'>
					<h3 class='panel-title'>Motivo</h3>
				</div>
				<div class='panel-body panel-divisor padding-divisor' style='padding-top: 0;'>
					<p><?php echo"$motivo"; ?></p>
				</div>

				<hr style='margin:0;'>	

				<div class='panel-heading' style='border-bottom: 0;'>
					<h3 class='panel-title'>Fecha Inicial</h3>
				</div>
				<div class='panel-body panel-divisor padding-divisor' style='padding-top: 0;'>
					<p>
						<?php
							$fecha_bd= $fechaini;
							$fecha_nueva = date('d-m-Y', strtotime($fecha_bd));
							echo $fecha_nueva;
						?>
					</p>
				</div>

				<hr style='margin:0;'>	

				<div class='panel-heading' style='border-bottom: 0;'>
					<h3 class='panel-title'>Fecha Final</h3>
				</div>
				<div class='panel-body' style='padding-top: 0;'>
					<p>
						<?php
							$fecha_bd= $fechafin;
							$fecha_nueva = date('d-m-Y', strtotime($fecha_bd));
							echo $fecha_nueva; 
						?>
					</p>
				</div>
<?php 
	}
	if($sql=="m"){ //si se trata de actualizar
@$datosm = $_SESSION['mostrarper'];//arreglo que trae los datos de la tabla
foreach($datosm as $d){
	//se optiene el valor de cada campo de la tabla
	@$id=$d['idperm'];
	@$cedula=$d['cedulasol'];
	@$motivo=$d['motivo'];
	@$fecha_inicial=$d['fechaini'];
	@$fecha_final=$d['fechafin'];

	$fecha_bdi= $fecha_inicial;
	$fecha_inicial = date('d-m-Y', strtotime($fecha_bdi));

	$fecha_bdf= $fecha_final;
	$fecha_final = date('d-m-Y', strtotime($fecha_bdf));
}
?>	
<!DOCTYPE html>
	<html>
	<head>
		<meta charset='utf-8'>
		<title>SICAU-SG</title>
		<link rel='stylesheet' type='text/css' href='../../assets/css/trabajadores.css'>
		<link rel='stylesheet' type='text/css' href='../../assets/jquery-ui/jquery-ui.min.css'>
	</head>
	<body>

		<div class='contenedor'>
			<h1 class='page-title'>
				<i></i>
				Editar Permiso
			</h1>
			<a href='../../../controlador/ctr_permiso.php?list=1' class='btn btn-warning'>
				<i></i>
				<span>Volver a la lista</span>
			</a>
			
		</div>

		<div class='contenedor'>
			<div class='panel panel-bordered'>
				<form name='formulario' class='formulario' onsubmit='return validarpermiso(this)' method='post' action='../../../controlador/ctr_permiso.php'>
					<div class='panel-body'>
						<div class='form-group'>
							<input type='text' class='form-control' name='id' placeholder='...' value='<?php echo "$id"; ?>' autocomplete='off' id='miInput' style='display: none;'>
						</div>

						<div class='form-group'>
							<label for='nombre'>Cédula</label>
							<input type='text' class='form-control' name='cedula' placeholder='...' value='<?php echo "$cedula"; ?>' autocomplete='off' onkeypress='return soloNumeros(event)' id='miInput' maxlength='10'>
						</div>

						<div class='form-group'>
							<label for='nombre'>Motivo</label>
							<input type='text' class='form-control' name='motivo' placeholder='...' value='<?php echo "$motivo"; ?>' autocomplete='off' id='miInput' maxlength='50' onkeypress='return soloAlfanumerico(event)' onkeyup='mayusculainicial(this)'>
						</div>

						<div class='form-group'>
							<label for='nombre'>Fecha Inicial</label>
							<input type='text' class='form-control' name='fecha_inicial' placeholder='dd-mm-aa' value='<?php echo "$fecha_inicial"; ?>' autocomplete='off' id='fecha_ini' maxlength='10' onkeypress='return soloFecha(event)'>
						</div>

						<div class='form-group'>
							<label for='nombre'>Fecha Final</label>
							<input type='text' class='form-control' name='fecha_final' placeholder='dd-mm-aa' value='<?php echo "$fecha_final"; ?>' autocomplete='off' id='fecha_fin' maxlength='10' onkeypress='return soloFecha(event)'>
						</div>

					<div class='panel-footer'>
						<input type='submit' class='btn btn-primary save' name='accion' value='Actualizar'>
					</div>
				</form>
<script type='text/javascript' src='../../assets/js/validaciones.js'></script>
<script type='text/javascript' src='../../assets/js/jquery-3.3.1.min.js'></script>
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
	}
	if($sql=='i'){
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
				Permiso <span style='color:red;'>INACTIVOS</span>
			</h1>
			<a href='../../../controlador/ctr_permiso.php?list=1' class='btn btn-warning'>
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
									<th>Fecha Inicial</th>
									<th>Fecha Final</th>
									<th class='actions text-right'>Acciones</th>
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
												$fecha_bd= $r->fechaini;
												$fecha_nueva = date('d-m-Y', strtotime($fecha_bd));
												echo $fecha_nueva;
											?>
										</td>
										<td>
											<?php
												$fecha_bd= $r->fechafin;
												$fecha_nueva = date('d-m-Y', strtotime($fecha_bd));
												echo $fecha_nueva; 
											?>
										</td>
										<td>
											<a onclick="javascript:return confirm('¿Seguro que quiere habilitar este registro?');" href="../../../controlador/ctr_permiso.php?sql=h&id=<?php echo $r->idperm; ?>" class='btn btn-add-new pull-right'>Habilitar</a>
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

<script type='text/javascript' src='../../assets/data/jquery/jquery-3.3.1.min.js'></script>
<script type='text/javascript' src='../../assets/data/datatables.min.js'></script>
<script type='text/javascript' src='../../assets/data/main.js'></script>

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
			<link rel='stylesheet' type='text/css' href='../../assets/css/reportes2.css'>
		</head>
		<body>
				<div class='contenedor'>
					<h1 class='sicau-sg'>SICAU-SG</h1>
					<span>Unidad Servicios Generales</span><br>
					<span>Universidad Politecnica Territorial de Yaracuy ".$aristides."</span><br>
					<span>Independencia, Yaracuy</span><br>
					<span>Venezuela</span>
					<label class='imgg'><img src='../../assets/img/uptyab.jpg' class='img'></label>
				</div>
					<h1 class='page-title'>
						<i></i>
						Reporte Permisos
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
											<th>Motivo</th>
											<th>Fecha Inicial</th>
											<th>Fecha Final</th>	
										</tr>
									</thead>
									<tbody>";

	@$datosrep = $_SESSION['reportarcat'];

	foreach(@$datosrep as $r):

		$fecha_bd1= $r->fechaini;
		$fecha_inicial1 = date('d-m-Y', strtotime($fecha_bd1));

		$fecha_bd2= $r->fechafin;
		$fecha_final1 = date('d-m-Y', strtotime($fecha_bd2));

	$html .= "
		<tr>
			<td style='color: #526069;'>".$r->cedulasol."</td>
			<td style='color: #526069;'>".$r->nombresol." ".$r->apellidosol."</td>
			<td style='color: #526069;'>".$r->motivo."</td>
			<td style='color: #526069;'>".$fecha_inicial1."</td>
			<td style='color: #526069;'>".$fecha_final1."</td>
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
	$dompdf->stream("SICAU-PERMISOS.pdf", array('Attachment'=>'0'));
	$_SESSION['sql'] = '';
	$_SESSION['reportarcat'] = '';
}
?>
			</div>
		</div>
	</body>
</html>