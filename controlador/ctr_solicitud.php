<?php  

	session_start();

	include("../modelo/clase_solicitud.php");
	include("../modelo/clase_tiposol.php"); //incluir el archivo de la clase

	$solicitud = new Solicitud();
	$tipo = new Tiposol(); //Creo el objeto de la clase 	

	/*============================================================================*/
	/*### CATALAGO ##############################################################*/
	/*============================================================================*/
	if(isset($_GET['list']) && $_GET['list']=="1"){//verifica que se alla presionado el boton especifico
		$datos = $solicitud->Listar();//Invocamos al método de consultar persona
		if(empty($datos)) //Si el método, retorna un arreglo vacío
		{
			echo "<script>alert('No existe ninguna solicitud registrada.')</script>";//Mensaje de Registro no válida
			echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/solicitud/sql/'>"; // ir a la pantalla de inicio
		}else{
			$_SESSION['catalago'] = $datos;
			echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/solicitud/'>"; // ir a la pantalla de inicio
	
		}
	}

	/*============================================================================*/
	/*### LISTAR TIPO #############################################################*/
	/*============================================================================*/
	if(isset($_GET['sql']) && $_GET['sql']=="a")//verifica que se alla presionado el boton especifico
		{
		$datos = $tipo->Listar();//Invocamos al método de consultar persona recibiendo la id
		
			$_SESSION['sql'] = "a";
			$_SESSION['selecttipo'] = $datos;
			echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/solicitud/sql/'>";
			//break;

	}

	/*============================================================================*/
	/*### REGISTRAR ##############################################################*/
	/*============================================================================*/

	if(isset($_POST['registrar']) && $_POST['registrar']=="Registrar")//verifica que se alla presionado el boton especifico
		{
		$solicitud->setFecha($_POST['fecha']);
		$solicitud->setCedula($_POST['cedula']);
		$solicitud->setMotivo($_POST['motivo']);
		$solicitud->setId_tipo($_POST['id_tipo']);
		$solicitud->setId_Subarea($_POST['id_subarea']);
		$solicitud->setComentario($_POST['comentario']);

		$datos = $solicitud->RegistrarSolicitud($_POST['fecha'],$_POST['cedula'],$_POST['motivo'],$_POST['id_tipo'],$_POST['id_subarea'],$_POST['comentario']); //Invocamos al método de iniciar
	}
?>