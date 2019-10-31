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
			$_SESSION['sql'] = "a";
			echo "<script>alert('No existe ninguna solicitud registrada.')</script>";//Mensaje de Registro no válida
			echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/solicitud/sql/'>"; // ir a la pantalla de inicio
		}else{
			$_SESSION['catalago'] = $datos;
			echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/solicitud/'>"; // ir a la pantalla de inicio
	
		}
	}

	/*============================================================================*/
	/*### CATALAGO COMPLETADOS ###################################################*/
	/*============================================================================*/
	if(isset($_GET['list']) && $_GET['list']=="2"){//verifica que se alla presionado el boton especifico
		$datos = $solicitud->ListarCompletado();//Invocamos al método de consultar persona
		if(empty($datos)) //Si el método, retorna un arreglo vacío
		{
			echo "<script>alert('No existen registros completados.')</script>";//Mensaje de Registro no válida
			echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=ctr_solicitud.php?list=1'>"; // ir a la pantalla de inicio
		}else{
			$_SESSION['sql'] = 'i';
			$_SESSION['catalago'] = $datos;
			echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/solicitud/sql/'>"; // ir a la pantalla de inicio
			//break;	
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

	/*============================================================================*/
	/*### CONSULTAR ##############################################################*/
	/*============================================================================*/
	if(isset($_GET['sql']) && $_GET['sql']=="c")//verifica que se alla presionado el boton especifico
		{
		$sql="c";
		$id = $_GET['id'];
		$datos = $solicitud->ConsultarSolicitud($id);//Invocamos al método de consultar persona recibiendo la id
		if(empty($datos)) //Si el método, retorna un arreglo vacío
		{
		}else{
			$_SESSION['selectid'] = $datos;
			$_SESSION['sql'] = $sql;
			header("Location: ../vista/solicitud/sql/");//mostrar el archivo con los datos	
			//break;	
		}
	}

	/*===========================================================================*/
	/*### COMPLETAR ##############################################################*/
	/*===========================================================================*/
	if(isset($_GET['sql']) && $_GET['sql']=="v"){//verifica que se alla presionado el boton especifico
		$sql="v";
		$id = $_GET['id'];
		$datos = $solicitud->CompletarSolicitud($id);//Invocamos al método para eliminar persona recibiendo la id
		if(empty($datos)) //Si el método, retorna un arreglo vacío
		{
		}else{
			echo "<script>alert('Registro completado con exito.')</script>";//Mensaje de Registro válida
			echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=ctr_solicitud.php?list=1'>"; // ir a la pantalla de inicio
		}
	}

	/*============================================================================*/
	/*### CONSULTAR COMPLETADOS ##################################################*/
	/*============================================================================*/
	if(isset($_GET['sql']) && $_GET['sql']=="k")//verifica que se alla presionado el boton especifico
		{
		$sql="k";
		$id = $_GET['id'];
		$datos = $solicitud->ConsultarServicio($id);//Invocamos al método de consultar persona recibiendo la id
		if(empty($datos)) //Si el método, retorna un arreglo vacío
		{
		}else{
			$_SESSION['selectid'] = $datos;
			$_SESSION['sql'] = $sql;
			header("Location: ../vista/solicitud/sql/");//mostrar el archivo con los datos	
			//break;	
		}
	}
?>