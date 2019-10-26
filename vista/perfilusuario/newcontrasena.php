
<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf-8'>
		<title>SICAU-SG</title>
		<link rel='stylesheet' type='text/css' href='../assets/css/newsolicitudes.css'>
		<script type='text/javascript' src='../assets/js/validaciones.js'></script>
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

				<form name='formulario' class='formulario' onsubmit='return validarpw(this)' method='post' action='../../ctr_usuario.php'>
					<div class='panel-body'>
						<div class='form-group'>
							<label for='pwa'>Contraseña Actual</label>
							<input type='password' class='form-control' name='pwa' placeholder='...' value='' autocomplete='off'  maxlength='10'>
						</div>
						<div class='form-group'>
							<label for='pwn'>Nueva Contraseña</label>
							<input type='password' class='form-control' name='pwn' placeholder='...' value='' autocomplete='off'>
						</div>
						<div class='form-group'>
							<label for='pwc'>Confirmar Contraseña</label>
							<input type='password' class='form-control' name='pwc' placeholder='...' value='' autocomplete='off'>
						</div>
					</div>

					<div class='panel-footer'>
						<input type='reset' class='btn btn-delete' name='cancelar' value='Limpiar'>
						<input type='submit' class='btn btn-primary save' name='guardar' value='Guardar'>
					</div>
				</form>
			</div>
		</div>

		


	</body>
</html>