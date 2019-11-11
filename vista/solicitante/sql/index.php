<?php 
session_start();
	
	if(@$_GET['sql']){ @$sql = $_GET['sql']; }
	if(@$_SESSION['sql']){ @$sql = $_SESSION['sql']; }

	if(@$sql=="a"){  //si no existe datos registrado
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf-8'>
		<META http-equiv="Content-Type" content="text/html; charset=iso-8859-1" >
		<title>SICAU-SG</title>
		<link rel='stylesheet' type='text/css' href='../../assets/css/trabajadores.css'>
		<script type='text/javascript' src='../../assets/js/validaciones.js'></script>
	</head>
	<body>

		<div class='contenedor'>
			<h1 class='page-title'>
				<i></i>
				Añadir Solicitante
			</h1>
			<a href='../../../controlador/ctr_solicitante.php?list=1' class='btn btn-warning'>
				<i></i>
				<span>Volver a la lista</span>
			</a>
			
		</div>

		<div class='contenedor'>
			<div class='panel panel-bordered'>
				<form name='formulario' class='formulario' onsubmit='return validarsolicitante(this)' method='post' action='../../../controlador/ctr_solicitante.php'>
					<div class='panel-body'>
						<div class='form-group'>
							<label for='cedula'>Cédula</label>
							<input type='text' class='form-control' name='cedula' placeholder='...' value='' autocomplete='off' onkeypress='return soloNumeros(event)' maxlength='10'>
						</div>
						<div class='form-group'>
							<label for='nombre'>Nombre</label>
							<input type='text' class='form-control' name='nombre' placeholder='...' value='' autocomplete='off' onkeypress='return soloLetras(event)' onkeyup='mayusculainicial(this)' id='miInput' maxlength='50'>
						</div>
						<div class='form-group'>
							<label for='apellido'>Apellido</label>
							<input type='text' class='form-control' name='apellido' placeholder='...' value='' autocomplete='off' onkeypress='return soloLetras(event)' onkeyup='mayusculainicial(this)' id='miInput' maxlength='50'>
						</div>
						<div class='form-group'>
							<label for='sexo'>Sexo</label>
							<input type='radio' class='' name='sexo' value='m' id='sexo'>M
							<input type='radio' class='' name='sexo' value='f' id='sexo'>F
						</div>
						<div class='form-group'>
							<label for='id_cargo'>Cargo</label>
							<select name='id_cargo' class='form-control' id='cargo' >
								<option value=''>...</option>
								<?php  
									@$_SESSION['selectcargo'];
									@$datosa = $_SESSION['selectcargo'];//arreglo que trae los datos de la tabla
									foreach(@$datosa as $a){
								?>
									<option value='<?php echo $a->id; ?>'><?php echo $a->nombre; ?></option>
								<?php 
									}

							 	?>
								
							</select>
						</div>
						<div class='form-group'>
							<label for='telefono'>Telefono</label>
							<input type='text' class='form-control' name='telefono' placeholder='...' value='' autocomplete='off' onkeypress='return soloTelefono(event)' id='miInput' maxlength='12'>
						</div>
						<div class='form-group'>
							<label for='correo'>Correo</label>
							<input type='text' class='form-control' name='correo' placeholder='...' value='' autocomplete='off' id='miInput' maxlength='75'>
						</div>
					</div>

					<div class='panel-footer'>
						<input type='submit' class='btn btn-primary save' name='guardar' value='Guardar'>
					</div>
				</form>
<?php 
	}
	if(@$sql=="b"){//si se trata de una consulta 

@$datosc = $_SESSION['selectci'];//arreglo que trae los datos de la tabla
foreach($datosc as $b){
	//se optiene el valor de cada campo de la tabla
	@$cedulasol=$b['cedulasol'];
	@$nombresol=$b['nombresol'];
	@$apellidosol=$b['apellidosol'];
	@$sexosol=$b['sexosol'];
	@$nombrecar=$b['nombrecar'];
	@$telefonosol=$b['telefonosol'];
	@$correosol=$b['correosol'];
	@$estatussol=$b['estatussol'];
}
?>

<!DOCTYPE html>
	<html>
	<head>
		<meta charset='utf-8'>
		<title>SICAU-SG</title>
		<link rel='stylesheet' type='text/css' href='../../assets/css/trabajadores.css'>
		<script type='text/javascript'></script>
	</head>
	<body>

		<div class='contenedor'>
			<h1 class='page-title'>
				<i></i>
				Viendo Solicitante 
			</h1>

			<a href='../../../controlador/ctr_solicitante.php?list=2' class='btn btn-warning'>
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
					<h3 class='panel-title'>Sexo</h3>
				</div>
				<div class='panel-body panel-divisor padding-divisor' style='padding-top: 0;'>
					<p>
						<?php
							if($sexosol=='m'){echo"Masculino";}
							if($sexosol=='f'){echo"Femenino";}
						?>		
					</p>
				</div>

				<hr style='margin:0;'>

				<div class='panel-heading' style='border-bottom: 0;'>
					<h3 class='panel-title'>Cargo</h3>
				</div>
				<div class='panel-body panel-divisor padding-divisor' style='padding-top: 0;'>
					<p>
						<?php 
							echo "$nombrecar";
					 	?>
						
					</p>
				</div>

				<hr style='margin:0;'>

				<div class='panel-heading' style='border-bottom: 0;'>
					<h3 class='panel-title'>Telefono</h3>
				</div>
				<div class='panel-body panel-divisor padding-divisor' style='padding-top: 0;'>
					<p><?php echo"$telefonosol"; ?></p>
				</div>

				<hr style='margin:0;'>	

				<div class='panel-heading' style='border-bottom: 0;'>
					<h3 class='panel-title'>Correo</h3>
				</div>
				<div class='panel-body <?php if($estatussol=='i'){ echo 'panel-divisor padding-divisor';}?>' style='padding-top: 0;'>
					<p><?php echo"$correosol"; ?></p>
				</div>
				<?php if($estatussol=='i'){?>
					<hr style='margin:0;'>
					<div class='panel-heading' style='border-bottom: 0;'>
						<h3 class='panel-title'>Estatus</h3>
					</div>
					<div class='panel-body' style='padding-top: 5px;'>
						<p><span style="color: red; font-weight: bold; margin-right: 5px;">INACTIVO</span> 
							<?php if(@$_SESSION['TipoUsu']=="adm"){ ?>
							<a class="btn btn-add-new" onclick="javascript:return confirm('¿Está seguro que quiere Habilitar este registro?');"  href="../../../controlador/ctr_solicitante.php?sql=h&ci=<?php echo $cedulasol; ?>">
					<i></i>
					<span>Habilitar</span>
			</a><?php } ?></p>
					</div>
				<?php } ?>
<?php 
	}
	if(@$sql=="c"){//si se trata de una consulta 

@$datosc = $_SESSION['selectci'];//arreglo que trae los datos de la tabla
foreach($datosc as $c){
	//se optiene el valor de cada campo de la tabla
	@$cedulasol=$c['cedulasol'];
	@$nombresol=$c['nombresol'];
	@$apellidosol=$c['apellidosol'];
	@$sexosol=$c['sexosol'];
	@$nombrecar=$c['nombrecar'];
	@$telefonosol=$c['telefonosol'];
	@$correosol=$c['correo'];
}
?>

<!DOCTYPE html>
	<html>
	<head>
		<meta charset='utf-8'>
		<title>SICAU-SG</title>
		<link rel='stylesheet' type='text/css' href='../../assets/css/trabajadores.css'>
		<script type='text/javascript'></script>
	</head>
	<body>

		<div class='contenedor'>
			<h1 class='page-title'>
				<i></i>
				Viendo Solicitante
			</h1>

			<a href='../../../controlador/ctr_solicitante.php?list=1' class='btn btn-warning'>
				<i></i>
				<span>Volver a la lista</span>
			</a>

			<a href="" class='btn btn-buscar'>
				<i></i>
				<span>Imprimir</span>
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
					<h3 class='panel-title'>Sexo</h3>
				</div>
				<div class='panel-body panel-divisor padding-divisor' style='padding-top: 0;'>
					<p>
						<?php
							if($sexosol=='m'){echo"Masculino";}
							if($sexosol=='f'){echo"Femenino";}
						?>		
					</p>
				</div>

				<hr style='margin:0;'>

				<div class='panel-heading' style='border-bottom: 0;'>
					<h3 class='panel-title'>Cargo</h3>
				</div>
				<div class='panel-body panel-divisor padding-divisor' style='padding-top: 0;'>
					<p>
						<?php 
							echo "$nombrecar";
					 	?>
						
					</p>
				</div>

				<?php if(empty($correosol)){ ?>

					<hr style='margin:0;'>

					<div class='panel-heading' style='border-bottom: 0;'>
						<h3 class='panel-title'>Telefono</h3>
					</div>
					<div class='panel-body' style='padding-top: 0;'>
						<p><?php echo"$telefonosol"; ?></p>
					</div>

				<?php }else{ ?>

					<hr style='margin:0;'>

					<div class='panel-heading' style='border-bottom: 0;'>
						<h3 class='panel-title'>Telefono</h3>
					</div>
					<div class='panel-body panel-divisor padding-divisor' style='padding-top: 0;'>
						<p><?php echo"$telefonosol"; ?></p>
					</div>

					<hr style='margin:0;'>

					<div class='panel-heading' style='border-bottom: 0;'>
						<h3 class='panel-title'>Correo</h3>
					</div>
					<div class='panel-body' style='padding-top: 0;'>
						<p><?php echo"$correosol"; ?></p>
					</div>

				<?php } ?>

<?php 
	}
	if(@$sql=="m"){ //si se trata de actualizar
@$datosm = $_SESSION['mostrarper'];//arreglo que trae los datos de la tabla
foreach($datosm as $d){
	//se optiene el valor de cada campo de la tabla
	@$id=$d['idsol'];
	@$cedula=$d['cedulasol'];
	@$nombre=$d['nombresol'];
	@$apellido=$d['apellidosol'];
	@$sexo=$d['sexosol'];
	@$id_cargo=$d['idcar'];
	@$telefono=$d['telefonosol'];
	@$correo=$d['correo'];
}

	include("../../../modelo/clase_cargo.php");
	$car = new Cargo();
	$datoss = $car->Listar();
	$_SESSION['selectcargo'] = $datoss;

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
				Editar Solicitante
			</h1>
			<a href='../../../controlador/ctr_solicitante.php?list=1' class='btn btn-warning'>
				<i></i>
				<span>Volver a la lista</span>
			</a>		
		</div>

		<div class='contenedor'>
			<div class='panel panel-bordered'>
				<form name='formulario' class='formulario' onsubmit='return validarsolicitante(this)' method='post' action='../../../controlador/ctr_solicitante.php'>
					<div class='panel-body'>
						<div class='form-group' style='display: none;'>
							<input type='text' class='form-control' name='id' placeholder='...' value='<?php echo "$id"; ?>' autocomplete='off' maxlength='11'>
						</div>
						<div class='form-group'>
							<label for='cedula'>Cédula</label>
							<input type='text' class='form-control' name='cedula' placeholder='...' value='<?php echo "$cedula"; ?>' autocomplete='off' onkeypress='return soloNumeros(event)' maxlength='10'>
						</div>
						<div class='form-group'>
							<label for='nombre'>Nombre</label>
							<input type='text' class='form-control' name='nombre' placeholder='...' value='<?php echo "$nombre"; ?>' autocomplete='off' onkeypress='return soloLetras(event)' onkeyup='mayusculainicial(this)' id='miInput' maxlength='50'>
						</div>
						<div class='form-group'>
							<label for='apellido'>Apellido</label>
							<input type='text' class='form-control' name='apellido' placeholder='...' value='<?php echo "$apellido"; ?>' autocomplete='off' onkeypress='return soloLetras(event)' onkeyup='mayusculainicial(this)' id='miInput' maxlength='50'>
						</div>
						<div class='form-group'>
							<label for='sexo'>Sexo</label>
							<input type='radio' <?php if($sexo=='m'){echo"checked";} ?> name='sexo' value='m' id='miInput'>M
							<input type='radio' <?php if($sexo=='f'){echo"checked";} ?> name='sexo' value='f' id='miInput'>F
						</div>
						<div class='form-group'>
							<label for='cargo'>Cargo</label>
							<select name='id_cargo' class='form-control' id='id_cargo' >
								<option value=''>...</option>
								<?php  
									@$_SESSION['selectcargo'];
									@$datosa = $_SESSION['selectcargo'];//arreglo que trae los datos de la tabla
									foreach(@$datosa as $a){
								?>
									<option value='<?php echo $a->id; ?>' <?php if($a->id==$id_cargo){echo "selected";} ?>><?php echo $a->nombre; ?></option>
								<?php 
									}

							 	?>
							</select>
						</div>
						<div class='form-group'>
							<label for='telefono'>Telefono</label>
							<input type='text' class='form-control' name='telefono' placeholder='...' value='<?php echo "$telefono"; ?>' autocomplete='off' onkeypress='return soloTelefono(event)' id='miInput' maxlength='12'>
						</div>
						<div class='form-group'>
							<label for='correo'>Correo</label>
							<input type='text' class='form-control' name='correo' placeholder='...' value='<?php echo "$correo"; ?>' autocomplete='off'  id='miInput' maxlength='75'>
						</div>
					</div>

					<div class='panel-footer'>
						<input type='submit' class='btn btn-primary' name='accion' value='Actualizar'>
					</div>
				</form>

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
				Solicitante <span style='color:red;'>INACTIVOS</span>
			</h1>
			<a href='../../../controlador/ctr_solicitante.php?list=1' class='btn btn-warning'>
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
									<th>Cargo</th>
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
											<td><?php echo $r->nombresol." ". $r->apellidosol; ?></td>
											<td><?php echo $r->nombrecar;?></td>
										<td>
											<a onclick="javascript:return confirm('¿Seguro que quiere habilitar este registro?');" href="../../../controlador/ctr_solicitante.php?sql=h&id=<?php echo $r->idsol; ?>" class='btn btn-add-new pull-right'>Habilitar</a>
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
					<img src='../../assets/img/uptyab.jpg' class='img'>
				</div>
					<h1 class='page-title'>
						<i></i>
						Reporte Solicitantes
					</h1>
				
				<div class='contenedor'>
					<div class='panel panel-bordered'>
						<div class='panel-body'>
							<div class='tabla center'>
								<table class='table table-hover' id='tabla'>
									<thead>
										<tr>
											<th>Cedula</th>
											<th>Nombre y Apellido</th>
											<th>Sexo</th>
											<th>Cargo</th>
											<th>Telefono</th>
											<th>Correo</th>
										</tr>
									</thead>
									<tbody>";

	@$datosrep = $_SESSION['reportarcat'];

	foreach(@$datosrep as $r):
	@$sexo=$r->sexo;
	@$correo=$r->correo;
	if($sexo=='m'){$sex='Masculino';}else{$sex='Femenino';}
	if(empty($correo)){$correo='-';}
	$html .= "
		<tr>
			<td style='color: #526069;'>".$r->cedulasol."</td>
			<td style='color: #526069;'>".$r->nombresol." ".$r->apellidosol."</td>
			<td style='color: #526069;'>".$sex."</td>
			<td style='color: #526069;'>".$r->nombrecar."</td>
			<td style='color: #526069;'>".$r->telefono."</td>";
	if($correo=='-'){
	$html .= "
			<td style='color: #526069;' align='center'>".$correo."</td>
		</tr>";
	}else{
	$html .= "
			<td style='color: #526069;'>".$correo."</td>
		</tr>";
	}
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
	$dompdf->stream("SICAU-SOLICITANTES.pdf", array('Attachment'=>'0'));
}
?>