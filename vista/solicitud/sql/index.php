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
						<div class='form-group' style='display: none;'>
						<?php include('../../../modelo/conexionpdo.php');
							$sql = "SELECT MAX(id) FROM solicitud";
									$result = $con->prepare($sql);//preparar la sentencia sql
									$result->execute(); //ejecuta la sentencia sql
									$data = $result->fetchAll();
									foreach($data as $u){//se optiene el valor de cada campo de la tabla
									@$idsol=$u['MAX(id)'];}

									$id_solicitud=$idsol+1;
						?>
							<input type='text' class='form-control' name='id_solicitud' placeholder='...' value='<?php echo $id_solicitud; ?>' autocomplete='off'>
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
	}
?>		


	</body>
</html>