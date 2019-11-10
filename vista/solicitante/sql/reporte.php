<?php session_start(); ?>
<!DOCTYPE html>
		<html>
		<head>
			<meta charset='utf-8'>
			<?php date_default_timezone_set('America/Caracas'); ?>
			<title>SICAU-SG <?php echo date('Y-m-d')?></title>
			<link rel='stylesheet' type='text/css' href='../../assets/css/reportes.css'>
		</head>
		<body>
				<div class='contenedor'>
					<h1 class='sicau-sg'>SICAU-SG</h1>
					<span>Unidad Servicios Generales</span><br>
					<span>Universidad Politécnica Territorial de Yaracuy "Aristides Bastidas"</span><br>
					<span>Independencia, Yaracuy</span><br>
					<span>Venezuela</span>
					<img src='../../assets/img/uptyab.jpg' class='img'>
				</div>
					<h1 class='page-title'>
						<i></i>
						Solicitante
					</h1>
				
				<div class='contenedor'>
					<div class='panel panel-bordered'>
						<div class='panel-body'>
							<div class='tabla'>
								<table class='table table-hover' id='tabla'>
									<thead>
										<tr>
											<th >Cedula</th>
											<th >Nombre y Apellido</th>
											<th >Sexo</th>
											<th >Cargo</th>
											<th >Telefono</th>
											<th >Correo</th>
										</tr>
									</thead>
									<tbody>
<?php @$datosrep = $_SESSION['reportarcat'];

	foreach(@$datosrep as $r):
	@$sexo=$r->sexo;
	@$correo=$r->correo;
	if($sexo=='m'){$sex='Masculino';}else{$sex='Femenino';}
	if(empty($correo)){$correo=' ';}?>
		<tr>
			<td style='color: #526069;'><?php echo $r->cedulasol; ?></td>
			<td style='color: #526069;'><?php echo $r->nombresol." ".$r->apellidosol?></td>
			<td style='color: #526069;'><?php echo $sex?></td>
			<td style='color: #526069;'><?php echo $r->nombrecar?></td>
			<td style='color: #526069;'><?php echo $r->telefono?></td>
			<td style='color: #526069;'><?php echo $correo?></td>
		</tr>
	<?php endforeach; ?>
		</tbody></table>
		<img src='../../assets/img/cap.jpg'>
		</div></div>
		</div></div>
		</body></html>