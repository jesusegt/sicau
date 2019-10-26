<?php  

	session_start();

	include("../modelo/clase_asistencia.php"); //incluir el archivo de la clase

	$asis = new Asistencia(); //Creo el objeto de la clase 	

	/*============================================================================*/
	/*### CATALAGO ##############################################################*/
	/*============================================================================*/
	if(isset($_GET['list']) && $_GET['list']=="1"){//verifica que se alla presionado el boton especifico
		$datos = $asis->Listar();//Invocamos al método de consultar persona
		if(empty($datos)) //Si el método, retorna un arreglo vacío
		{
			echo "<script>alert('No existe ninguna Asistencia registrada.')</script>";//Mensaje de Registro no válida
			echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/asistencia/sql/'>"; // ir a la pantalla de inicio
		}else{
			$_SESSION['catalago'] = $datos;
			echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/asistencia/'>"; // ir a la pantalla de inicio
	
		}
	}

	/*============================================================================*/
	/*### REGISTRAR 1 ##############################################################*/
	/*============================================================================*/
	if(isset($_POST['registrar']) && $_POST['registrar']=="Registrar")//verifica que se alla presionado el boton especifico
		{
		$asis->setCedula($_POST['cedula']);
		$asis->setFecha($_POST['fecha']);
		$asis->setHora($_POST['hora']);
		//seteamos el asistencia

		$datos = $asis->RegistrarAsistencia($_POST['cedula'],$_POST['fecha'],$_POST['hora']); //Invocamos al método de iniciar
	}

	/*============================================================================*/
	/*### REGISTRAR 2 ##############################################################*/
	/*============================================================================*/
	if(isset($_POST['registrar2']) && $_POST['registrar2']=="Registrar")//verifica que se alla presionado el boton especifico
		{
		$asis->setCedula($_POST['cedula']);
		$asis->setFecha($_POST['fecha']);
		$asis->setHora($_POST['hora']);
		//seteamos el asistencia

		$datos = $asis->RegistrarAsis($_POST['cedula'],$_POST['fecha'],$_POST['hora']); //Invocamos al método de iniciar
	}
?>