<?php  

	session_start();

	include("../modelo/clase_actividad.php"); //incluir el archivo de la clase

	$act = new Actividad(); //Creo el objeto de la clase 	

	/*============================================================================*/
	/*### CATALAGO ##############################################################*/
	/*============================================================================*/
	if(isset($_GET['list']) && $_GET['list']=="1"){//verifica que se alla presionado el boton especifico
		$datos = $act->Listar();//Invocamos al método de consultar persona
		if(empty($datos)) //Si el método, retorna un arreglo vacío
		{
			echo "<script>alert('No existe ninguna actividad registrada.')</script>";//Mensaje de Registro no válida
			echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/actividad/sql/'>"; // ir a la pantalla de inicio
		}else{
			$_SESSION['catalago'] = $datos;
			echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/actividad/'>"; // ir a la pantalla de inicio
	
		}
	}
	if(isset($_POST['registrar']) && $_POST['registrar']=="Registrar")//verifica que se alla presionado el boton especifico
		{
		$act->setCedula($_POST['cedula']);
		$act->setFecha($_POST['fecha']);

		$datos = $act->RegistrarActividad($_POST['cedula'],$_POST['fecha']); //Invocamos al método de iniciar
		
	}
?>