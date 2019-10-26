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
		<link rel='stylesheet' type='text/css' href='../../assets/css/trabajadores.css'>
		<script type='text/javascript' src='../../assets/js/validaciones.js'></script>
	</head>
	<body>

		<div class='contenedor'>
			<h1 class='page-title'>
				<i></i>
				Añadir Subarea
			</h1>
			<a href='../../../controlador/ctr_subarea.php?list=1' class='btn btn-warning'>
				<i></i>
				<span>Volver a la lista</span>
			</a>
			
		</div>

		<div class='contenedor'>
			<div class='panel panel-bordered'>
				<form name='formulario' class='formulario' onsubmit='return validarsubarea(this)' method='post' action='../../../controlador/ctr_subarea.php'>
					<div class='panel-body'>
						<div class='form-group'>
							<label for='id_area'>Area</label>
							<select name='id_area' class='form-control' id='area'>
								<option value=''>...</option>
								<?php  
									@$_SESSION['selectarea'];
									@$datosa = $_SESSION['selectarea'];//arreglo que trae los datos de la tabla
									foreach(@$datosa as $a){
								?>
									<option value='<?php echo $a->id; ?>'><?php echo $a->nombre; ?></option>
								<?php 
									}

							 	?>
							</select>

							<!--<input type='text' class='form-control' name='nombre' placeholder='...' value='' autocomplete='off' onkeypress='return soloLetras(event)' id='miInput'>-->
						</div>
						<div class='form-group'>
							<label for='nombre'>Sub-area</label>
							<input type='text' class='form-control' name='nombre' placeholder='...' value='' autocomplete='off'  id='miInput'>
						</div>

					<div class='panel-footer'>
						<input type='submit' class='btn btn-primary save' name='guardar' value='Guardar'>
					</div>
				</form>
<?php 
	}
	if($sql=="c"){//si se trata de una consulta 

@$datosc = $_SESSION['selectid'];//arreglo que trae los datos de la tabla
foreach($datosc as $c){
	//se optiene el valor de cada campo de la tabla
	@$idsub=$c['idsub'];
	@$idare=$c['idare'];
	@$nombreare=$c['nombreare'];
	@$nombresub=$c['nombresub'];

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
				Viendo Subarea
			</h1>
			&nbsp;
			<a href='../../../controlador/ctr_subarea.php?list=1' class='btn btn-warning'>
				<i></i>
				<span>Volver a la lista</span>
			</a>
			
		</div>

		<div class='contenedor'>
			<div class='panel panel-bordered' style='padding-bottom: 5px;'>

				<div class='panel-heading' style='border-bottom: 0;'>
					<h3 class='panel-title'>ID</h3>
				</div>
				<div class='panel-body panel-divisor padding-divisor' style='padding-top: 0;'>
					<p><?php echo"$id"; ?></p>
				</div>

				<hr style='margin:0;'>	

				<div class='panel-heading' style='border-bottom: 0;'>
					<h3 class='panel-title'>Area</h3>
				</div>
				<div class='panel-body' style='padding-top: 0;'>
					<p>
						<?php 
							if($area=='0'){echo"-";}
							if($area=='ar'){echo"Area Verde";}
					 		if($area=='au'){echo"Aula";}
					 		if($area=='dp'){echo"Departamento";}
					 		if($area=='pa'){echo"Pasillo";}
					 	?>
					 		
					 </p>
				</div>
				<div class='panel-heading' style='border-bottom: 0;'>
					<h3 class='panel-title'>Sub-Area</h3>
				</div>
				<div class='panel-body' style='padding-top: 0;'>
					<p><?php echo"$subarea"; ?></p>
				</div>
<?php 
	}
	if($sql=="m"){ //si se trata de actualizar
@$datosm = $_SESSION['mostrarper'];//arreglo que trae los datos de la tabla
foreach($datosm as $d){
	//se optiene el valor de cada campo de la tabla
	@$id=$d['id'];
	@$nombre=$d['nombre'];
	@$id_area=$d['id_area'];
}
	include("../../../modelo/clase_area.php");
	$are = new Area();
	$datoss = $are->Listar();
	$_SESSION['selectarea'] = $datoss;
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
				Editar Subarea
			</h1>
			<a href='../../../controlador/ctr_subarea.php?list=1' class='btn btn-warning'>
				<i></i>
				<span>Volver a la lista</span>
			</a>
			
		</div>

		<div class='contenedor'>
			<div class='panel panel-bordered'>
				<form name='formulario' class='formulario' onsubmit='return validarsubarea(this)' method='post' action='../../../controlador/ctr_subarea.php'>
					<div class='panel-body'>
						<div class='form-group'>
							<input type='text' class='form-control' name='id' placeholder='...' value='<?php echo "$id"; ?>' autocomplete='off' id='miInput' style='display: none;'>
						</div>
						<div class='form-group'>
							<label for='id_area'>Area</label>
							<select name='id_area' class='form-control' id='area'>
								<option value=''>...</option>
								<?php  
									@$_SESSION['selectarea'];
									@$datosa = $_SESSION['selectarea'];//arreglo que trae los datos de la tabla
									foreach(@$datosa as $a){
								?>
									<option value='<?php echo $a->id; ?>' <?php if($a->id==$id_area){echo "selected";} ?>><?php echo $a->nombre; ?></option>
								<?php 
									}

							 	?>
							</select>

							<!--<input type='text' class='form-control' name='nombre' placeholder='...' value='' autocomplete='off' onkeypress='return soloLetras(event)' id='miInput'>-->
						</div>
						<div class='form-group'>
							<label for='nombre'>Sub-area</label>
							<input type='text' class='form-control' name='nombre' placeholder='...' value='<?php echo "$nombre"; ?>' autocomplete='off'  id='miInput'>
						</div>

					<div class='panel-footer'>
						<input type='submit' class='btn btn-primary save' name='accion' value='Actualizar'>
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
				Subarea <span style='color:red;'>INACTIVOS</span>
			</h1>
			<a href='../../../controlador/ctr_subarea.php?list=1' class='btn btn-warning'>
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
									<th>Area</th>
									<th>Sub-Area</th>
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
										<td>
											<?php echo $r->nombreare; ?>
										 </td>
										<td><?php echo $r->nombresub; ?></td>
										<td>
											<a onclick="javascript:return confirm('¿Seguro que quiere habilitar este registro?');" href="../../../controlador/ctr_subarea.php?sql=h&id=<?php echo $r->idsub; ?>" class='btn btn-add-new pull-right'>Habilitar</a>
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

<?php } ?>
			</div>
		</div>
	</body>
</html>