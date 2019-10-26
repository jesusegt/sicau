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
		<script type='text/javascript' src='../../assets/js/usuario.js'></script>
	</head>
	<body>

		<div class='contenedor'>
			<h1 class='page-title'>
				<i></i>
				Añadir Usuario
			</h1>
			<a href='../../../controlador/ctr_usuario.php?list=1' class='btn btn-warning'>
				<i></i>
				<span>Volver a la lista</span>
			</a>
			
		</div>

		<div class='contenedor'>
			<div class='panel panel-bordered'>
				<form name='formulario' class='formulario' onsubmit="return usuario(this);" method='post' action='../../../controlador/ctr_usuario.php'>
					<div class='panel-body'>
						<div class='form-group'>
							<label for='cedula'>Cédula</label>
							<input type='text' class='form-control' name='cedula' placeholder='...' value='' autocomplete='off' onkeypress='return soloNumeros(event)'
							id='miInput'>
						</div>
						<div class='form-group'>
							<label for='nombre'>Nombre</label>
							<input type='text' class='form-control' name='nombre' placeholder='...' value='' autocomplete='off' onkeypress='return soloLetras(event)'
							id='miInput'>
						</div>
						<div class='form-group'>
							<label for='apellido'>Apellido</label>
							<input type='text' class='form-control' name='apellido' placeholder='...' value='' autocomplete='off' onkeypress='return soloLetras(event)'
							id='miInput'>
						</div>
						<div class='form-group'>
							<label for='tipo'>Tipo</label>
							<select class='form-control' name='tipo' id='tipo'>
								<option value=''>...</option> 
								<option value='adm'>Administrador</option>
								<option value='enc'>Encargado</option>
							</select>
						</div>

						<div class='form-group'>
							<label for='nombre_usu'>Usuario</label>
							<input type='text' class='form-control' name='nombre_usu' placeholder='...' value='' autocomplete='off' id='miInput'>
						</div>
						<div class='form-group'>
							<label for='contrasena'>Contraseña</label>
							<input type='password' class='form-control' name='contrasena' placeholder='...' value='' autocomplete='off' id='miInput'>
						</div>
						<div class='form-group'>
							<label for='pw'>Confirmar Contraseña</label>
							<input type='password' class='form-control' name='pw' placeholder='...' value='' autocomplete='off' id='miInput'>
						</div>
					</div>

					<div class='panel-footer'>
						<input type='submit' class='btn btn-primary save' name='guardar' value='Guardar'>
					</div>
				</form>
<?php 
	}
	if($sql=="b"){//si se trata de una consulta 

@$datosc = $_SESSION['selectci'];//arreglo que trae los datos de la tabla
foreach($datosc as $b){
	//se optiene el valor de cada campo de la tabla
	@$cedula=$b['cedula'];
	@$nombre=$b['nombre'];
	@$apellido=$b['apellido'];
	@$tipo=$b['tipo'];
	@$estatus=$b['estatus'];

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
				Viendo Usuario
			</h1>
			<a href='../../../controlador/ctr_usuario.php?list=1' class='btn btn-warning'>
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
					<p><?php echo"$cedula"; ?></p>
				</div>

				<hr style='margin:0;'>	

				<div class='panel-heading' style='border-bottom: 0;'>
					<h3 class='panel-title'>Nombre y Apellido</h3>
				</div>
				<div class='panel-body panel-divisor padding-divisor' style='padding-top: 0;'>
					<p><?php echo"$nombre $apellido"; ?></p>
				</div>

				<hr style='margin:0;'>

				<div class='panel-heading' style='border-bottom: 0;'>
					<h3 class='panel-title'>Tipo</h3>
				</div>
				<div class='panel-body <?php if($estatus=='i'){ echo 'panel-divisor padding-divisor';}?>' style='padding-top: 0;'>
					<p>
						<?php 
							if($tipo=='0'){echo"-";}
							if($tipo=='adm'){echo"Administrador";}
					 		if($tipo=='enc'){echo"Encargado";}
					 	?>
					</p>
				</div>

				<hr style='margin:0;'>

				<?php if($estatus=='i'){?>
					<hr style='margin:0;'>
					<div class='panel-heading' style='border-bottom: 0;'>
						<h3 class='panel-title'>Estatus</h3>
					</div>
					<div class='panel-body' style='padding-top: 5px;'>
						<p><span style="color: red; font-weight: bold; margin-right: 5px;">INACTIVO</span> 
					<?php if(@$_SESSION['TipoUsu']=="adm"){ ?>
							<a class="btn btn-add-new" onclick="javascript:return confirm('¿Está seguro que quiere Habilitar este registro?');"  href="../../../controlador/ctr_usuario.php?sql=h&ci=<?php echo $cedula; ?>">
					<i></i>
					<span>Habilitar</span>
			</a><?php } ?></p>
					</div>
				<?php } ?>
<?php 
	}
	if($sql=="c"){//si se trata de una consulta 

@$datosc = $_SESSION['selectci'];//arreglo que trae los datos de la tabla
foreach($datosc as $c){
	//se optiene el valor de cada campo de la tabla
	@$cedula=$c['cedula'];
	@$nombre=$c['nombre'];
	@$apellido=$c['apellido'];
	@$tipo=$c['tipo'];
	@$estatus=$b['estatus'];
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
				Viendo Usuario
			</h1>
			<a href='../../../controlador/ctr_usuario.php?list=1' class='btn btn-warning'>
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
					<p><?php echo"$cedula"; ?></p>
				</div>

				<hr style='margin:0;'>	

				<div class='panel-heading' style='border-bottom: 0;'>
					<h3 class='panel-title'>Nombre y Apellido</h3>
				</div>
				<div class='panel-body panel-divisor padding-divisor' style='padding-top: 0;'>
					<p><?php echo"$nombre $apellido"; ?></p>
				</div>

				<hr style='margin:0;'>

				<div class='panel-heading' style='border-bottom: 0;'>
					<h3 class='panel-title'>Tipo</h3>
				</div>
				<div class='panel-body <?php if($estatus=='i'){ echo 'panel-divisor padding-divisor';}?>' style='padding-top: 0;'>
					<p>
						<?php 
							if($tipo=='0'){echo"-";}
							if($tipo=='adm'){echo"Administrador";}
					 		if($tipo=='enc'){echo"Encargado";}
					 	?>
					</p>
				</div>

				<hr style='margin:0;'>

				<?php if($estatus=='i'){?>
					<hr style='margin:0;'>
					<div class='panel-heading' style='border-bottom: 0;'>
						<h3 class='panel-title'>Estatus</h3>
					</div>
					<div class='panel-body' style='padding-top: 5px;'>
						<p><span style="color: red; font-weight: bold; margin-right: 5px;">INACTIVO</span> <a class="btn btn-add-new" onclick="javascript:return confirm('¿Está seguro que quiere Habilitar este registro?');"  href="../../../controlador/ctr_solicitante.php?sql=h&ci=<?php echo $cedula; ?>">
					<i></i>
					<span>Habilitar</span>
			</a></p>
					</div>
				<?php } ?>
<?php 
	}
	if($sql=="m"){ //si se trata de actualizar
@$datosm = $_SESSION['mostrarper'];//arreglo que trae los datos de la tabla
foreach($datosm as $d){
	//se optiene el valor de cada campo de la tabla
	@$cedula=$d['cedula'];
	@$nombre=$d['nombre'];
	@$apellido=$d['apellido'];
	@$tipo=$d['tipo'];
	@$nombre_usu=$d['nombre_usu'];
	@$contrasena=$d['contrasena'];
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf-8'>
		<title>SICAU-SG</title>
		<link rel='stylesheet' type='text/css' href='../../assets/css/trabajadores.css'>
		<script type='text/javascript' src='../../assets/js/formulario.js'></script>
	</head>
	<body>

		<div class='contenedor'>
			<h1 class='page-title'>
				<i></i>
				Editar Usuario
			</h1>
			<a href='../../../controlador/ctr_usuario.php?list=1' class='btn btn-warning'>
				<i></i>
				<span>Volver a la lista</span>
			</a>		
		</div>

		<div class='contenedor'>
			<div class='panel panel-bordered'>
				<form name='formulario' class='formulario' onsubmit='return validarusuario(this)' method='post' action='../../../controlador/ctr_usuario.php'>
					<div class='panel-body'>
					<div class='form-group'>
							<label for='cedula'>Cédula</label>
							<input type='text' class='form-control' name='cedula' placeholder='...' value='<?php echo $cedula; ?>' autocomplete='off' onkeypress='return soloNumeros(event)'
							id='miInput' onfocus='this.blur()'>
						</div>
						<div class='form-group'>
							<label for='nombre'>Nombre</label>
							<input type='text' class='form-control' name='nombre' placeholder='...' value='<?php echo $nombre; ?>' autocomplete='off' onkeypress='return soloLetras(event)'
							id='miInput' onfocus='this.blur()'>
						</div>
						<div class='form-group'>
							<label for='apellido'>Apellido</label>
							<input type='text' class='form-control' name='apellido' placeholder='...' value='<?php echo $apellido; ?>' autocomplete='off' onkeypress='return soloLetras(event)'
							id='miInput' onfocus='this.blur()'>
						</div>
						<div class='form-group'>
							<label for='tipo'>Tipo</label>
							<select class='form-control' name='tipo' id='tipo'>
								<option value=''>...</option> 
								<option value='adm' <?php if($tipo=='adm'){echo'selected';} ?>>Administrador</option>
								<option value='enc' <?php if($tipo=='enc'){echo'selected';} ?>>
								Encargado</option>
							</select>
						</div>
					</div>
					<div class='panel-footer'>
						<input type='submit' class='btn btn-primary' name='accion' value='Actualizar'>
					</div>
				</form>
<?php 
	}
	if($sql=="v"){//si se trata de una consulta 

@$datosv = $_SESSION['selectci'];//arreglo que trae los datos de la tabla
foreach($datosv as $v){
	//se optiene el valor de cada campo de la tabla
	@$cedula=$v['cedula'];
	@$nombre=$v['nombre'];
	@$apellido=$v['apellido'];
	@$tipo=$v['tipo'];
	@$nombre_usu=$v['nombre_usu'];
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf-8'>
		<title>SICAU-SG</title>
		<link rel='stylesheet' type='text/css' href='../../assets/css/newsolicitudes.css'>
		<script type='text/javascript' src='../../assets/js/validaciones.js'></script>
	</head>
	<body>

		<div class='contenedor'>
			<h1 class='page-title'>
				<i></i>
				Perfil de Usuario
			</h1>
			
		</div>

		<div class='contenedor'>

			<div class='panel panel-bordered' style='padding-bottom: 5px;'>
				<center><img src='../../assets/img/usuario.jpg' class='img-user' width='80px' height='80px' style='margin-top: 15px;'></center>
				<div class='panel-heading' style='border-bottom: 0;'>
					<h3 class='panel-title'>Nombre y Apellido</h3>
				</div>
				<div class='panel-body panel-divisor padding-divisor' style='padding-top: 0;'>
					<p><?php echo $nombre." ".$apellido;?></p>
				</div>

				<hr style='margin:0;'>

				<div class='panel-heading' style='border-bottom: 0;'>
					<h3 class='panel-title'>Cédula</h3>
				</div>
				<div class='panel-body panel-divisor padding-divisor' style='padding-top: 0;'>
					<p><?php echo $cedula;?></p>
				</div>

				<hr style='margin:0;'>

				<div class='panel-heading' style='border-bottom: 0;'>
					<h3 class='panel-title'>Tipo</h3>
				</div>
				<div class='panel-body panel-divisor padding-divisor' style='padding-top: 0;'>
					<p>
						<?php 
							if($tipo=='adm'){echo"Administrador";}
							if($tipo=='enc'){echo"Encargado";} 
						?>
					</p>
				</div>

				<hr style='margin:0;'>

				<div class='panel-heading' style='border-bottom: 0;'>
					<h3 class='panel-title'>Usuario</h3>
				</div>
				<div class='panel-body' style='padding-top: 0;'>
					<p><?php echo $nombre_usu ?></p>
				</div>
					
					<div class='panel-footer'>
						<a href='../../../controlador/ctr_usuario.php?sql=p&ci=<?php echo $cedula; ?>'>
							<input type='button' class='btn btn-primary' name='accion' value='Editar'>
						</a>
					</div>
<?php 
	}
	if($sql=="p"){ //si se trata de actualizar
@$datosp = $_SESSION['mostrarper'];//arreglo que trae los datos de la tabla
foreach($datosp as $p){
	//se optiene el valor de cada campo de la tabla
	@$cedula=$p['cedula'];
	@$nombre=$p['nombre'];
	@$apellido=$p['apellido'];
	@$nombre_usu=$p['nombre_usu'];
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf-8'>
		<title>SICAU-SG</title>
		<link rel='stylesheet' type='text/css' href='../../assets/css/trabajadores.css'>
		<script type='text/javascript' src='../../assets/js/formulario.js'></script>
	</head>
	<body>

		<div class='contenedor'>
			<h1 class='page-title'>
				<i></i>
				Editar Perfil
			</h1>
			<a href='../../../controlador/ctr_usuario.php?sql=v&ci=<?php echo $cedula; ?>' class='btn btn-warning'>
				<i></i>
				<span>Volver al perfil</span>
			</a>		
		</div>

		<div class='contenedor'>
			<div class='panel panel-bordered'>
				<form name='formulario' class='formulario' onsubmit='return validarusuario(this)' method='post' action='../../../controlador/ctr_usuario.php'>
					<div class='panel-body'>
						<div class='form-group' style='display: none;'>
							<label for='cedula'>Cédula</label>
							<input type='text' class='form-control' name='cedula' placeholder='...' value='<?php echo $cedula; ?>' autocomplete='off' onkeypress='return soloNumeros(event)'
							id='miInput' style=''>
						</div>
						<div class='form-group'>
							<label for='nombre'>Nombre</label>
							<input type='text' class='form-control' name='nombre' placeholder='...' value='<?php echo $nombre; ?>' autocomplete='off' onkeypress='return soloLetras(event)'
							id='miInput'>
						</div>
						<div class='form-group'>
							<label for='apellido'>Apellido</label>
							<input type='text' class='form-control' name='apellido' placeholder='...' value='<?php echo $apellido; ?>' autocomplete='off' onkeypress='return soloLetras(event)'
							id='miInput'>
						</div>

						<div class='form-group'>
							<label for='nombre_usu'>Usuario</label>
							<input type='text' class='form-control' name='nombre_usu' placeholder='...' value='<?php echo $nombre_usu; ?>' autocomplete='off' id='miInput'>
						</div>
					</div>

					<div class='panel-footer'>
						<input type='submit' class='btn btn-primary' name='perfil' value='Actualizar'>
					</div>
				</form>								
<?php 
	}
	if($sql=="k"){ //si se trata de actualizar
@$datosk = $_SESSION['mostrarper'];//arreglo que trae los datos de la tabla
foreach($datosk as $k){
	//se optiene el valor de cada campo de la tabla
	@$cedula=$k['cedula'];
	@$nombre=$k['nombre'];
	@$apellido=$k['apellido'];
	@$tipo=$k['tipo'];
	@$nombre_usu=$k['nombre_usu'];
	@$contrasena=$k['contrasena'];
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf-8'>
		<title>SICAU-SG</title>
		<link rel='stylesheet' type='text/css' href='../../assets/css/newsolicitudes.css'>
		<script type='text/javascript' src='../../assets/js/contrasena.js'></script>
	</head>
	<body>

		<div class='contenedor'>
			<h1 class='page-title'>
				<i></i>
				Cambiar Contraseña
			</h1>
			
		</div>

		<div class='contenedor'>
			<div class='panel panel-bordered'>

				<form name='formulario' class='formulario' onsubmit='return validarcontrasena(this)' method='post' action='../../../controlador/ctr_usuario.php'>
					<div class='panel-body'>
						<div class='form-group'>
							<input type='text' class='form-control' name='cedula' placeholder='...' value='<?php echo"$cedula"; ?>' autocomplete='off'  maxlength='10' style='display: none;'>
						</div>
						<div class='form-group'>
							<label for='contrasena'>Contraseña Actual</label>
							<input type='password' class='form-control' name='contrasena' placeholder='...' value='' autocomplete='off'>
						</div>
					</div>

					<div class='panel-footer'>
						<input type='reset' class='btn btn-delete' name='cancelar' value='Limpiar'>
						<input type='submit' class='btn btn-primary save' name='pw' value='Verificar'>
					</div>
				</form>
<?php 
	}
	if($sql=="o"){ //si se trata de actualizar
@$datoso = $_SESSION['mostrarper'];//arreglo que trae los datos de la tabla
foreach($datoso as $o){
	//se optiene el valor de cada campo de la tabla
	@$cedula=$o['cedula'];
	@$nombre=$o['nombre'];
	@$apellido=$o['apellido'];
	@$tipo=$o['tipo'];
	@$nombre_usu=$o['nombre_usu'];
	@$contrasena=$o['contrasena'];
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf-8'>
		<title>SICAU-SG</title>
		<link rel='stylesheet' type='text/css' href='../../assets/css/newsolicitudes.css'>
		<script type='text/javascript' src='../../assets/js/contrasena.js'></script>
	</head>
	<body>

		<div class='contenedor'>
			<h1 class='page-title'>
				<i></i>
				Cambiar Contraseña
			</h1>
			
		</div>

		<div class='contenedor'>
			<div class='panel panel-bordered'>

				<form name='formulario' class='formulario' onsubmit='return validarcontrasena2(this)' method='post' action='../../../controlador/ctr_usuario.php'>
					<div class='panel-body'>
						<div class='form-group'>
							<input type='text' class='form-control' name='cedula' placeholder='...' value='<?php echo"$cedula"; ?>' autocomplete='off'  maxlength='10' style='display: none;'>
						</div>
						<div class='form-group'>
							<label for='contrasena'>Nueva Contraseña</label>
							<input type='password' class='form-control' name='contrasena' placeholder='...' value='' autocomplete='off'>
						</div>
						<div class='form-group'>
							<label for='pwc'>Confirmar Contraseña</label>
							<input type='password' class='form-control' name='pwc' placeholder='...' value='' autocomplete='off'>
						</div>
					</div>

					<div class='panel-footer'>
						<input type='reset' class='btn btn-delete' name='cancelar' value='Limpiar'>
						<input type='submit' class='btn btn-primary save' name='pw' value='Guardar'>
					</div>
				</form>					
<?php 
	}
?>
			</div>
		</div>
	</body>
</html>
