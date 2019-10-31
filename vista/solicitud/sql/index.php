<?php 
session_start();
	
	if(@$_GET['sql']){ @$sql = $_GET['sql']; }
	if(@$_SESSION['sql']){ @$sql = $_SESSION['sql']; }

	if($sql=="a"){

	  //si no existe datos registrado
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf-8'>
		<title>SICAU-SG</title>
		<link rel='stylesheet' type='text/css' href='../../assets/css/newsolicitudes.css'>
		<script type='text/javascript' src='../../assets/js/validaciones.js'></script>
		<script language='javascript' src='../../assets/js/jquery-1.3.min.js'></script>
		<script language='javascript'>
			$(document).ready(function(){
			   // Parametros para el area
			   $("#area").change(function () {
			   		$("#area option:selected").each(function () {
							elegido=$(this).val();
							$.post("select.php", { elegido: elegido }, function(data){
							$("#id_subarea").html(data);
						});			
			        });
			   })
			});
		</script>
	</head>
	<body>

		<div class='contenedor'>
			<center><h1 class='page-title'>
				<i></i>
				Solicitud Prestación de Servicios
			</h1></center>
			
		</div>

		<div class='contenedor'>
			<div class='panel panel-bordered'>

				<form name='formulario' class='formulario' onsubmit='return validarsolicitud(this)' method='post' action='../../../controlador/ctr_solicitud.php'>


					<div class='panel-body'>
						<div class='form-group' style='display: none;'>
							<?php date_default_timezone_set('America/Caracas'); ?>
							<input type='date' class='form-control' name='fecha' value='<?php echo date('Y-m-d')?>'>
						</div>
						<div class='form-group'>
							<label for='cedula'>Cédula</label>
							<input type='text' class='form-control' name='cedula' placeholder='...' value='' autocomplete='off'>
						</div>
						<div class='form-group'>
							<label for='motivo'>Motivo</label>
							<input type='text' class='form-control' name='motivo' placeholder='...' value='' autocomplete='off'>
						</div>
						<div class='form-group'>
							<label for='id_tipo'>Tipo</label>
							<select class='form-control form-controlselect' name='id_tipo' id='id_tipo'>
								<option value=''>...</option>
								<?php  
									@$_SESSION['selecttipo'];
									@$datosa = $_SESSION['selecttipo'];//arreglo que trae los datos de la tabla
									foreach(@$datosa as $a){
								?>
									<option value='<?php echo $a->id; ?>'><?php echo $a->nombre; ?></option>
								<?php 
									}

							 	?>
							</select>
						</div>

						<div class='form-group'>
						<?php include ('conexion.php'); ?>

							<label for='area'>Area</label>
							<?php		
								//VERIFICAR LAS AREAS EXISTENTES.
									$consulta = "SELECT * FROM area WHERE estatus='a'";
									$resultado = mysql_query($consulta);
									$num_resultados = mysql_num_rows($resultado);
									echo "<select name=\"area\" id=\"area\" class='form-control form-controlselect'>"; 
									echo "<option value=\"_\" selected>...</option>";
									if ($num_resultados ){ 
									while ($row = mysql_fetch_array($resultado)){
									if ($row[0] == $_POST['area']){
									echo "<option value='".$row[0]."'selected>".$row[1]."</option>";
									}else{
									echo "<option value='".$row[0]."'>".$row[1]."</option>";
										}	
									}
								}	
									echo "</select>";
							?>
						</div>
						<div class='form-group'>
							<label for='id_subarea'>Subarea</label>
							<select class='form-control form-controlselect' name='id_subarea' id='id_subarea'>
								<option value='' selected>...</option>	
							</select>
						</div>
						</div>
						<div class='form-group'>
							<label for='comentario'>Comentario</label>
							<textarea class='form-control' name='comentario' placeholder='...' value='' autocomplete='off' rows='4'></textarea>
						</div>
					</div>



					<div class='panel-footer'>
						<input type='reset' class='btn btn-delete' name='limpiar' value='Limpiar'>
						<input type='submit' class='btn btn-primary save' name='registrar' value='Registrar'>
					</div>
				</form>
			</div>
		</div>
<?php 
	}if($sql=="c"){//si se trata de una consulta 

@$datosc = $_SESSION['selectid'];//arreglo que trae los datos de la tabla
foreach($datosc as $c){
	//se optiene el valor de cada campo de la tabla
	@$nombresol=$c['nombresol'];
	@$apellidosol=$c['apellidosol'];
	@$cedulasol=$c['cedulasol'];
	@$tipo=$c['tipo'];
	@$area=$c['area'];
	@$subarea=$c['subarea'];
	@$fecha=$c['fecha'];
	@$motivo=$c['motivo'];
	@$comentario=$c['comentario'];
	@$idsoli=$c['idsoli'];

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
				Viendo Solicitud
			</h1>
			&nbsp;
			<a href='../../../controlador/ctr_solicitud.php?list=1' class='btn btn-warning'>
				<i></i>
				<span>Volver a la lista</span>
			</a>
			<a onclick="javascript:return confirm('¿Seguro de completar este registro?');" href="../../../controlador/ctr_solicitud.php?sql=v&id=<?php echo $idsoli; ?>" class='btn btn-add-new' style='margin-left: 3px;'>Completar</a>
			
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
					<h3 class='panel-title'>Tipo</h3>
				</div>
				<div class='panel-body panel-divisor padding-divisor' style='padding-top: 0;'>
					<p><?php echo"$tipo"; ?></p>
				</div>

				<hr style='margin:0;'>


				<div class='panel-heading' style='border-bottom: 0;'>
					<h3 class='panel-title'>Area</h3>
				</div>
				<div class='panel-body panel-divisor padding-divisor' style='padding-top: 0;'>
					<p><?php echo"$area"; ?></p>
				</div>

				<hr style='margin:0;'>


				<div class='panel-heading' style='border-bottom: 0;'>
					<h3 class='panel-title'>Subarea</h3>
				</div>
				<div class='panel-body panel-divisor padding-divisor' style='padding-top: 0;'>
					<p><?php echo"$subarea"; ?></p>
				</div>

				<?php if($comentario){ ?>

				<hr style='margin:0;'>

				<div class='panel-heading' style='border-bottom: 0;'>
					<h3 class='panel-title'>Comentario</h3>
				</div>
				<div class='panel-body panel-divisor padding-divisor' style='padding-top: 0;'>
					<p><?php echo"$comentario"; ?></p>
				</div>

				<?php } ?>

				<hr style='margin:0;'>	

				<div class='panel-heading' style='border-bottom: 0;'>
					<h3 class='panel-title'>Fecha</h3>
				</div>
				<div class='panel-body' style='padding-top: 0;'>
					<p>
						<?php
							$fecha_bd= $fecha;
							$fecha_nueva = date('d-m-Y', strtotime($fecha_bd));
							echo $fecha_nueva;
						?>
					</p>
				</div>
<?php }
if($sql=='i'){ ?>
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
				Solicitudes Completadas
			</h1>
			<a href='../../../controlador/ctr_solicitud.php?list=1' class='btn btn-warning'>
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
									<th>Cedula</th>
									<th>Nombre y Apellido</th>
									<!--<th>Motivo</th>-->
									<th>Tipo</th>
									<th>Fecha Solicitud</th>
									<th>Fecha Completada</th>
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
										<td><?php echo $r->tipo; ?></td>
										<td>
											<?php 
												$fecha_bd= $r->fechasoli;
												$fecha_nueva = date('d-m-Y', strtotime($fecha_bd));
												echo $fecha_nueva;
											?>
										</td>
										<td>
											<?php 
												$fecha_bd1= $r->fechaser;
												$fecha_nueva1 = date('d-m-Y', strtotime($fecha_bd1));
												echo $fecha_nueva1;
											?>
										</td>
										<td>
											<a href="../../../controlador/ctr_solicitud.php?sql=k&id=<?php echo $r->idsoli; ?>" class='btn btn-warning pull-right'>Ver</a>
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

<?php }if($sql=="k"){//si se trata de una consulta 

@$datosk = $_SESSION['selectid'];//arreglo que trae los datos de la tabla
foreach($datosk as $k){
	//se optiene el valor de cada campo de la tabla
	@$nombresol=$k['nombresol'];
	@$apellidosol=$k['apellidosol'];
	@$cedulasol=$k['cedulasol'];
	@$tipo=$k['tipo'];
	@$area=$k['area'];
	@$subarea=$k['subarea'];
	@$fecha=$k['fecha'];
	@$motivo=$k['motivo'];
	@$comentario=$k['comentario'];
	@$fechasoli=$k['fechasoli'];
	@$fechaser=$k['fechaser'];

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
				Viendo Solicitud
			</h1>
			&nbsp;
			<a href='../../../controlador/ctr_solicitud.php?list=2' class='btn btn-warning'>
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
					<h3 class='panel-title'>Tipo</h3>
				</div>
				<div class='panel-body panel-divisor padding-divisor' style='padding-top: 0;'>
					<p><?php echo"$tipo"; ?></p>
				</div>

				<hr style='margin:0;'>


				<div class='panel-heading' style='border-bottom: 0;'>
					<h3 class='panel-title'>Area</h3>
				</div>
				<div class='panel-body panel-divisor padding-divisor' style='padding-top: 0;'>
					<p><?php echo"$area"; ?></p>
				</div>

				<hr style='margin:0;'>


				<div class='panel-heading' style='border-bottom: 0;'>
					<h3 class='panel-title'>Subarea</h3>
				</div>
				<div class='panel-body panel-divisor padding-divisor' style='padding-top: 0;'>
					<p><?php echo"$subarea"; ?></p>
				</div>

				<?php if($comentario){ ?>

				<hr style='margin:0;'>

				<div class='panel-heading' style='border-bottom: 0;'>
					<h3 class='panel-title'>Comentario</h3>
				</div>
				<div class='panel-body panel-divisor padding-divisor' style='padding-top: 0;'>
					<p><?php echo"$comentario"; ?></p>
				</div>

				<?php } ?>

				<hr style='margin:0;'>	

				<div class='panel-heading' style='border-bottom: 0;'>
					<h3 class='panel-title'>Fecha Solicitud</h3>
				</div>
				<div class='panel-body panel-divisor padding-divisor' style='padding-top: 0;'>
					<p>
						<?php
							$fecha_bd= $fechasoli;
							$fecha_nueva = date('d-m-Y', strtotime($fecha_bd));
							echo $fecha_nueva;
						?>
					</p>
				</div>

				<hr style='margin:0;'>	

				<div class='panel-heading' style='border-bottom: 0;'>
					<h3 class='panel-title'>Fecha Completada</h3>
				</div>
				<div class='panel-body' style='padding-top: 0;'>
					<p>
						<?php
							$fecha_bd= $fechaser;
							$fecha_nueva = date('d-m-Y', strtotime($fecha_bd));
							echo $fecha_nueva;
						?>
					</p>
				</div>
<?php } ?>
	</body>
</html>