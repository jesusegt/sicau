<?php session_start() ?>
<!DOCTYPE html>
		<html>
		<head>
			<link rel='stylesheet' type='text/css' href='../../assets/css/reportes.css'>
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
						Reporte Asistencias de los ultimos 15 dias 
					</h1>

					<?php 
						$fecha_actual = date("d-m-Y");
						//sumo 1 día
						echo date("d-m-Y",strtotime($fecha_actual."+ 1 days")); 
						//resto 1 día
						$fechanew= date("d-m-Y",strtotime($fecha_actual."- 15 days")); 
						echo $fechanew;
					?>
				
				<div class='contenedor'>
					<div class='panel panel-bordered'>
						<div class='panel-body'>
							<div class='tabla'>
								<table class='table table-hover' id='tabla'>
									<thead>
										<tr>
											<th>Cédula</th>
											<th>Nombre y Apellido</th>
											<th>Fecha</th>
											<th>Hora de Entrada</th>
											<th>Hora de Salida</th>
										</tr>
									</thead>
									<tbody>

	<?php @$datosrep = $_SESSION['reportarcat'];
		foreach(@$datosrep as $r): 
								?>
									<tr>
										<td style='color: #526069;'><?php echo $r->cedulasol; ?></td>
										<td style='color: #526069;'><?php echo $r->nombresol." ".$r->apellidosol; ?></td>
										<td style='color: #526069;'>
											<?php 
												$fecha_bd= $r->fechaasis;
												$fecha_nueva = date('d-m-Y', strtotime($fecha_bd));
												echo $fecha_nueva;
											?>
										</td >
										<td style='color: #526069;'>
											<?php
												$hora_bd = $r->horaen;
												$hora_nueva = date ('h:i A', strtotime($hora_bd));
												echo $hora_nueva;
											?>
										</td>
										<td style='color: #526069;'>
											<?php
												$hora_bd2 = $r->horasa;
												$hora_nueva2 = date ('h:i A', strtotime($hora_bd2));
												echo $hora_nueva2;
											?>
										</td style='color: #526069;'>
									</tr>
								<?php endforeach;
								?>
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
		</body></html>