<?php
include("conexion.php");

//buscar municipio segun la eleccion
$consulta =("SELECT * FROM subarea WHERE id_area LIKE '$_POST[elegido]'");
$resultado = mysql_query($consulta);
	echo "<option value='' selected>...</option>";
if ($row =mysql_fetch_array($resultado)) {
	do {
		echo 
		'<option value="'.$row[0].'">'.$row[1].'</option>';//se muestra los valores en el select
	}while($row =mysql_fetch_array($resultado));
}
?>