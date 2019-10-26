
<?php 
//CONECTAR AL GESTOR DE BASE DE DATO.
	$bd="sicau";
	@ $conectar = mysql_pconnect("localhost", "root", "");
	if (!$conectar){ 
	echo "No se pudo conectar.!";
	exit;
	}else{
	//CREANDO LA BASE DE DATO SI NO EXISTE
	$sql_bd="create database if not exists $bd";
	$result=mysql_query($sql_bd);

	//SELECCIONAR LA BASE DE DATO.
	$seleccionar = mysql_select_db($bd, $conectar);
	if(!$seleccionar){
		echo"No se pudo seleccionar la base de datos.!";
		exit;}
	}
?>