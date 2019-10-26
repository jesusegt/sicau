<?php 
echo "fecha del día de hoy: ". date('d/m/Y');

echo "hora: ". date('a');

date_default_timezone_set('America/Caracas');

echo "fecha del día de hoy: ". date('d/m/Y');

echo "hora: ". date('a');

 $zonahoraria = date_default_timezone_get();
    echo 'Zona horaria predeterminada: ' . $zonahoraria;

 echo date('h:i:s');

require_once("../modelo/conexionpdo.php");

$sql = "SELECT MAX(id) FROM solicitud";
$result = $con->prepare($sql);//preparar la sentencia sql
							    	$result->execute(); //ejecuta la sentencia sql
									$data = $result->fetchAll();
foreach($data as $u){
					//se optiene el valor de cada campo de la tabla
					@$idsol=$u['MAX(id)'];}
echo $idsol;
print_r ($data);

$id_solicitud=$idsol+1;
echo $id_solicitud;
 ?>