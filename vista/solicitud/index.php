<?php 
session_start();

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset='utf-8'>
	<title>SICAU-SG</title>
	<link rel='stylesheet' type='text/css' href='../assets/data/datatables.min.css'>
	<link rel='stylesheet' type='text/css' href='../assets/css/trabajadores.css'>
	<link rel='stylesheet' type='text/css' href='../assets/data/main.css'>
	<link rel='stylesheet' type='text/css' href='../assets/css/modal.css'>
	<link rel='stylesheet' type='text/css' href='../assets/jquery-ui/jquery-ui.min.css'>	
</head>
<body>
<!-- MODAL -->
	<div id="boxes">

	<div id="dialog" class="window">
		<form name='formulario' class='formulario' onsubmit='return validarreporte(this)' method='post' action='../../controlador/ctr_solicitud.php' target='blank' id='form'>
			<table class='tablam tregasis'>
				<tr>
					<td align='center'>
						<h2 class='h2regasis'>
							Periodo a Consultar 
							<!-- BOTON CERRAR MODAL -->
							<a href="#" class="close" onclick='cerrar()'>
								<img src='../assets/img/close.png' width='20px' height='20px'>
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
							<input type='submit' class='btn_modal' name='reporte' value='Procesar'>
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
				Solicitudes 
			</h1>
			<a href='../../controlador/ctr_solicitud.php?list=2' class='btn btn-add-new'>
				<i></i>
				<span>Solicitudes Realizadas</span>
			</a>
			<a href='#dialog' class='btn btn_imprimir' name='modal' style="margin-left: 3px;">
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
									<!--<th>Motivo</th>-->
									<th>Tipo</th>
									<th>Fecha</th>
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
										<!--<td><?php echo $r->motivosoli; ?></td>-->
										<td><?php echo $r->tiposol; ?></td>
										<td>
											<?php 
												$fecha_bd= $r->fechasoli;
												$fecha_nueva = date('d-m-Y', strtotime($fecha_bd));
												echo $fecha_nueva;
											?>
										</td>
										<td>
											<a onclick="javascript:return confirm('¿Seguro de realizar esta Solicitud?');" href="../../controlador/ctr_solicitud.php?sql=v&id=<?php echo $r->idsoli; ?>" class='btn btn-add-new pull-right' style='margin-left: 3px;'>Realizar</a>
											<a href="../../controlador/ctr_solicitud.php?sql=c&id=<?php echo $r->idsoli; ?>" class='btn btn-warning pull-right'>Ver</a>
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

<script type='text/javascript' src='../assets/data/jquery/jquery-3.3.1.min.js'></script>
<script type='text/javascript' src='../assets/data/datatables.min.js'></script>
<script type='text/javascript' src='../assets/data/main.js'></script>
<script type='text/javascript' src='../assets/js/modal.js'></script>
<script type='text/javascript' src='../assets/js/validaciones.js'></script>
<script type='text/javascript' src='../assets/js/reporte.js'></script>
<script type='text/javascript' src='../assets/jquery-ui/jquery-ui.min.js'></script>
<script type='text/javascript' src='../assets/jquery-ui/jquery.ui.datepicker-es.js'></script>
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
	?>
	</body>
</html>