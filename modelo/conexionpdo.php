<?php

try {
	//paso de nombre del servidor y de la base de datos
	$dsn = "mysql:host=localhost;dbname=sicau";
	//nombre del usuario en MySQL
	$usuario="root";
	//clave del usuario en MySQL
	$clave="";
	//conexion
	$con = new PDO($dsn, $usuario, $clave);
	$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
	//Si hubieran errores de conexión, se lanzará un objeto PDOException. 
	//Se puede capturar la excepción si fuera necesario manejar la condición del error
	catch (PDOException $e){
		print "¡Error de Conexion!: " . $e->getMessage() . "<br/>";
		die();
}

?>
