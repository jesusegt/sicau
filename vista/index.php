<?php
session_start();
$ciclave=@$_SESSION['CedulaTipoUsu'];
$cambio1=@$_SESSION['cambio'];
//$nombreusu=@$_SESSION['nombreusu'];
//$apeusu=@$_SESSION['apeusu'];
	if(@$_GET['cambio']){ @$sql = $_GET['cambio']; }
	if(@$_SESSION['cambio']){ @$cambio = $_SESSION['cambio']; }

	if($cambio=="a"){
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset='UTF-8'>
		<title>SICAU-SG</title>
		<link rel='stylesheet' type='text/css' href='assets/css/menuazul.css'>
		<script type='text/javascript' src='assets/js/menuazul.js'></script>
	</head>
	<body >

		<header>

				<nav>
					<div class='contenido logo-nav'>
						<a href='index.php' class='logo'>SICAU-SG</a>
					<ul class='menu'>
						<li><a href='#'>Archivos</a>
							<ul class='submenu'>
								<li><a href='../controlador/ctr_area.php?list=1' target='inferior'>Area</a>
									<!--<ul class='submenu'>
										<li><a href='area.html' target='inferior'>Areas Verdes</a></li>
										<li><a href='aulas.html' target='inferior'>Aulas</a></li>
										<li><a href='departamento.html' target='inferior'>Departamentos</a></li>
									</ul>-->
								</li>
								<li><a href='../controlador/ctr_subarea.php?list=1' target='inferior'>Subarea</a></li>
								<li><a href='../controlador/ctr_cargo.php?list=1' target='inferior'>Cargo</a></li>
								<li><a href='../controlador/ctr_feriado.php?list=1' target='inferior'>Día Feriado</a></li>
								<li><a href='../controlador/ctr_permiso.php?list=1' target='inferior'>Permiso</a></li>
								<li><a href='../controlador/ctr_solicitante.php?list=1' target='inferior'>Solicitante</a></li>
								<li><a href='../controlador/ctr_tiposol.php?list=1' target='inferior'>Tipo de solicitud</a></li>
								<?php if(@$_SESSION['TipoUsu']=="adm"){ ?>
								<li><a href='../controlador/ctr_usuario.php?list=1' target='inferior'>Usuario</a></li>
								<?php } ?>
							</ul>
						</li>
						<li><a href='#'>Funciones</a>
							<ul class='submenu'>
								<li><a href='actividad/sql/index.php' target='inferior'>Actividad</a></li>
								<li><a href='asistencia/sql/index.php' target='inferior'>Asistencia</a></li>
								<li><a href='../controlador/ctr_solicitud.php?sql=a' target='inferior'>Solicitud</a></li>
							</ul>
						</li>
						<li><a href='#'>Historiales</a>
							<ul class='submenu'>
								<li><a href='../controlador/ctr_actividad.php?list=1' target='inferior'>Actividades</a></li>
								<li><a href='../controlador/ctr_asistencia.php?list=1' target='inferior'>Asistencias</a></li>
								<li><a href='../controlador/ctr_solicitud.php?list=1' target='inferior'>Solicitudes</a></li>
							</ul>
						</li>
						<li><a href='#'>Ayuda</a>
							<ul class='submenu'>
								<li><a href='#'>Manual de Usuario</a></li>
								<li><a href='#'>Manual de Sistema</a></li>
							</ul>
						</li>
					</ul>
					<ul class='menu-usuario'>
						<li><span onclick='mostrar()'><?php echo $_SESSION['perfilusuario']; ?></span>
							<ul class='submenu-usuario' id='submenu-usuario'>
								<li><a href='../controlador/ctr_usuario.php?sql=v&ci=<?php echo $ciclave; ?>' target='inferior' id="A">Perfil</a></li>
								<li><a href='../controlador/ctr_usuario.php?sql=o&ci=<?php echo $ciclave; ?>' target='inferior'>Cambiar Contraseña</a></li>
								<li><a href='../controlador/ctr_usuario.php?salir=1'>Cerrar Sesion</a></li>
							</ul>
						</li>
					</ul>
					</div>
				</nav>
		</header>

		<center>
		<iframeset cols='100%,*' rows='100%,*'>
		<iframe src='bienvenido.html' name='inferior' scrolling='yes' marginwidth='0' frameborder='no' noresize='no' width='800' height='800'></iframe>
		</iframeset>
		</center>
<?php } 
if($cambio=="b"){
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset='UTF-8'>
		<title>SICAU-SG</title>
		<link rel='stylesheet' type='text/css' href='assets/css/menuazul.css'>
		<script type='text/javascript' src='assets/js/menuazul.js'></script>
	</head>
	<body>

		<header>

				<nav>
					<div class='contenido logo-nav'>
						<a href='index.php' class='logo'>SICAU-SG</a>
					<ul class='menu'>
						<li><a href='#'>Archivos</a>
							<ul class='submenu'>
								<li><a href='../controlador/ctr_area.php?list=1' target='inferior'>Area</a>
									<!--<ul class='submenu'>
										<li><a href='area.html' target='inferior'>Areas Verdes</a></li>
										<li><a href='aulas.html' target='inferior'>Aulas</a></li>
										<li><a href='departamento.html' target='inferior'>Departamentos</a></li>
									</ul>-->
								</li>
								<li><a href='../controlador/ctr_subarea.php?list=1' target='inferior'>Subarea</a></li>
								<li><a href='../controlador/ctr_cargo.php?list=1' target='inferior'>Cargo</a></li>
								<li><a href='../controlador/ctr_feriado.php?list=1' target='inferior'>Día Feriado</a></li>
								<li><a href='../controlador/ctr_permiso.php?list=1' target='inferior'>Permiso</a></li>
								<li><a href='../controlador/ctr_solicitante.php?list=1' target='inferior'>Solicitante</a></li>
								<li><a href='../controlador/ctr_tiposol.php?list=1' target='inferior'>Tipo de solicitud</a></li>
								<?php if(@$_SESSION['TipoUsu']=="adm"){ ?>
								<li><a href='../controlador/ctr_usuario.php?list=1' target='inferior'>Usuario</a></li>
								<?php } ?>
							</ul>
						</li>
						<li><a href='#'>Funciones</a>
							<ul class='submenu'>
								<li><a href='actividad/sql/index.php' target='inferior'>Actividad</a></li>
								<li><a href='asistencia/sql/index.php' target='inferior'>Asistencia</a></li>
								<li><a href='../controlador/ctr_solicitud.php?sql=a' target='inferior'>Solicitud</a></li>
							</ul>
						</li>
						<li><a href='#'>Historiales</a>
							<ul class='submenu'>
								<li><a href='../controlador/ctr_actividad.php?list=1' target='inferior'>Actividades</a></li>
								<li><a href='../controlador/ctr_asistencia.php?list=1' target='inferior'>Asistencias</a></li>
								<li><a href='../controlador/ctr_solicitud.php?list=1' target='inferior'>Solicitudes</a></li>
							</ul>
						</li>
						<li><a href='#'>Ayuda</a>
							<ul class='submenu'>
								<li><a href='#'>Manual de Usuario</a></li>
								<li><a href='#'>Manual de Sistema</a></li>
							</ul>
						</li>
					</ul>
					<ul class='menu-usuario'>
						<li><span onclick='mostrar()'><?php echo $_SESSION['perfilusuario']; ?></span>
							<ul class='submenu-usuario' id='submenu-usuario'>
								<li><a href='../controlador/ctr_usuario.php?sql=v&ci=<?php echo $ciclave; ?>' target='inferior' id="A">Perfil</a></li>
								<li><a href='../controlador/ctr_usuario.php?sql=k&ci=<?php echo $ciclave; ?>' target='inferior'>Cambiar Contraseña</a></li>
								<li><a href='../controlador/ctr_usuario.php?salir=1'>Cerrar Sesion</a></li>
							</ul>
						</li>
					</ul>
					</div>
				</nav>
		</header>

		<center>
		<iframeset cols='100%,*' rows='100%,*'>
		<iframe src='../controlador/ctr_usuario.php?sql=v&ci=<?php echo $ciclave; ?>' name='inferior' scrolling='yes' marginwidth='0' frameborder='no' noresize='no' width='800' height='800'></iframe>
		</iframeset>
		</center>
<?php 
@$_SESSION['cambio']='a';
} ?>
	</body>
</html>
