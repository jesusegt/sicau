
<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf-8'>
		<title>SICAU-SG</title>
		<link rel='stylesheet' type='text/css' href='../CSS/trabajadores.css'>
		<script type='text/javascript' src='../JS/formulario.js'></script>
		<script type="text/javascript">
			
			function confirmar(f){
				
				var cerrar = confirm("¿Está seguro que quiere eliminar este registro?");
					if (cerrar){
						return true;
					}else{
						return false;
					}
				}
		</script>
	</head>
	<body>

			<div class='contenedor'>
				<h1 class='page-title'>
					<i></i>
					Solicitantes
				</h1>
				<a href='addsolicitante.html' class='btn btn-add-new'>
					<i></i>
					<span>Añadir nuevo</span>
					
				</a>
				
			</div>
			<div class='contenedor'>
				<div class='panel panel-bordered'>
					<div class='panel-body'>
						<div class='busqueda'>
							<input type='text' name='cedula' placeholder='Buscar' class='inputbusqueda'>
							<span class='btn_buscar'>
								<input type='submit' name='accion' value='Buscar' class='btn btn-buscar'>
									<i class=''></i>
								</button>
							</span>
						</div>
						<div class='tabla'>
							<table class='table table-hover'>
								<thead>
									<tr>
										<th>ID</th>
										<th>Cedula</th>
										<th>Nombre y Apellido</th>
										<th class='actions text-right'>Acciones</th>
									</tr>
								</thead>
								<tbody>
									<tr>
							
											<td></td>
											<td></td>
											<td></td>
											<td>
											<form method='POST' action='../controlador/ctr_solicitante.php' onsubmit='return confirmar(this)'>
											<input type='text' name='cedula' value='$cedula'  style='display: none;'>
											<input type='submit' class='btn btn-delete pull-right' name='accion' value='Eliminar'>
											<input type='submit' class='btn btn-warning pull-right' name='accion' value='Ver'>
												</form>
											</td>
										</tr>

								</tbody>
							</table>
						</div>
						<div class='pull-left'>
							<div class='show-res'>
								Mostrando todas las entradas
							</div>
						</div>
						<div class='pull-right'>
								<ul class='pagination'>
									<li class='page-item disabled'>
										<span><</span>
									</li>
									<li class='page-item active'>
										<span>1</span>
									</li>
									<li class='page-item disabled'>
										<span>></span>
									</li>
								</ul>
						</div>
					</div>
				</div>
			</div>



	</body>
</html>