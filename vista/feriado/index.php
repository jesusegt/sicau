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

</head>
<body>


		<div class='contenedor'>
			<h1 class='page-title'>
				<i></i>
				Día Feriado
			</h1>
			<a href='sql/?sql=a' class='btn btn-add-new'>
				<i></i>
				<span>Añadir</span>
			</a>
			<?php if(@$_SESSION['TipoUsu']=='adm'){ ?>
			<a href='../../controlador/ctr_feriado.php?list=2' class='btn btn-delete'>
				<i></i>
				<span>Inactivos</span>
			</a>
			<?php } ?>
			<a href='../../controlador/ctr_feriado.php?sql=r' class='btn btn_imprimir' target='blank' style='margin-left: 3px;'>
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

									<th>Motivo</th>
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

										<td><?php echo $r->motivo; ?></td>
										<td>
											<?php 
												$fecha_bd= $r->fecha_inicial;
												$fecha_nueva = date('d-m-Y', strtotime($fecha_bd));
												echo $fecha_nueva;
											?>
										</td>
										<td>
											<?php 
											$fecha_bd= $r->fecha_final;
											$fecha_nueva = date('d-m-Y', strtotime($fecha_bd));
											echo $fecha_nueva;
											?>
										</td>
										<td>
											<a onclick="javascript:return confirm('¿Seguro de eliminar este registro?');" href="../../controlador/ctr_feriado.php?sql=e&id=<?php echo $r->id; ?>" class='btn btn-delete pull-right'>Eliminar</a>
											<a href="../../controlador/ctr_feriado.php?sql=m&id=<?php echo $r->id; ?>" class='btn btn-primary pull-right'>Editar</a>
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

	<?php 
	$_SESSION['list']=null;
	$_SESSION['sql']=null;
	$_SESSION['selectid']=null;
	$_SESSION['mostrarper']=null;
	$_SESSION['catalago']=null; 
	?>
	</body>
</html>