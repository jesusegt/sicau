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
		/*if(empty($datos)) //Si el método, retorna un arreglo vacío
		{
			$_SESSION['sql'] = "a";
			echo "<script>alert('No existe ninguna solicitud registrada.')</script>";//Mensaje de Registro no válida
			echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/solicitud/sql/'>"; // ir a la pantalla de inicio
		}else{*/
			$_SESSION['catalago'] = $datos;
			echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/solicitud/'>"; // ir a la pantalla de inicio
	
		//}
	}

	/*============================================================================*/
	/*### CATALAGO COMPLETADOS ###################################################*/
	/*============================================================================*/
	if(isset($_GET['list']) && $_GET['list']=="2"){//verifica que se alla presionado el boton especifico
		$datos = $solicitud->ListarCompletado();//Invocamos al método de consultar persona
		if(empty($datos)) //Si el método, retorna un arreglo vacío
		{
			echo "<script>alert('No existen Solicitudes realizadas.')</script>";//Mensaje de Registro no válida
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

	/*============================================================================*/
	/*### REPORTE ################################################################*/
	/*============================================================================*/
	if(isset($_POST['reporte']) && $_POST['reporte']=="Procesar")//verifica que se alla presionado el boton especifico
	{
		@$sql="r";
		@$_SESSION['reportarcat']=null;
		$tipo_rep = $_POST['tipo_rep'];
		$fechaini = $_POST['fechaini'];
		$fechafin = $_POST['fechafin'];
		$mes = $_POST['mes'];

		$solicitud->setTipo_rep($_POST['tipo_rep']);
		$solicitud->setFechaini($_POST['fechaini']);
		$solicitud->setFechafin($_POST['fechafin']);
		$solicitud->setMes($_POST['mes']);
		//seteamos el asistencia
		if($tipo_rep=='1'){
			$datos = $solicitud->ListarReporte3(); //Invocamos al método de iniciar
			if(empty($datos)) //Si el método, retorna un arreglo vacío
			{
			}else{
				@$_SESSION['sql'] = $sql;
				@$_SESSION['reportarcat'] = $datos;//variable sesion que guarda un arreglo con los campos de la bd
				header("Location: ../vista/solicitud/sql/");//mostrar el archivo con los datos	
			}
		}
		if($tipo_rep=='2'){
			$datos = $solicitud->ListarReporte2($_POST['mes']); //Invocamos al método de iniciar
			if(empty($datos)) //Si el método, retorna un arreglo vacío
			{
			}else{
				@$_SESSION['sql'] = $sql;
				@$_SESSION['reportarcat'] = $datos;//variable sesion que guarda un arreglo con los campos de la bd
				header("Location: ../vista/solicitud/sql/");//mostrar el archivo con los datos	
			}
		}
		if($tipo_rep=='3'){
			$datos = $solicitud->ListarReporte(); //Invocamos al método de iniciar
			if(empty($datos)) //Si el método, retorna un arreglo vacío
			{
			}else{
				@$_SESSION['sql'] = $sql;
				@$_SESSION['reportarcat'] = $datos;//variable sesion que guarda un arreglo con los campos de la bd
				header("Location: ../vista/solicitud/sql/");//mostrar el archivo con los datos	
			}
		}
		if($tipo_rep=='4'){
			$datos = $solicitud->ListarReporte4($_POST['fechaini'],$_POST['fechafin']); //Invocamos al método de iniciar
			if(empty($datos)) //Si el método, retorna un arreglo vacío
			{
			}else{
				@$_SESSION['sql'] = $sql;
				@$_SESSION['reportarcat'] = $datos;//variable sesion que guarda un arreglo con los campos de la bd
				header("Location: ../vista/solicitud/sql/");//mostrar el archivo con los datos	
			}
		}
	}

	/*============================================================================*/
	/*### REPORTE COMPLETADAS ####################################################*/
	/*============================================================================*/
	if(isset($_POST['reporte2']) && $_POST['reporte2']=="Procesar")//verifica que se alla presionado el botoCn especifico
	{
		@$sql="t";
		@$_SESSION['reportarcat']=null;
		$tipo_rep = $_POST['tipo_rep'];
		$fechaini = $_POST['fechaini'];
		$fechafin = $_POST['fechafin'];
		$mes = $_POST['mes'];

		$solicitud->setTipo_rep($_POST['tipo_rep']);
		$solicitud->setFechaini($_POST['fechaini']);
		$solicitud->setFechafin($_POST['fechafin']);
		$solicitud->setMes($_POST['mes']);
		//seteamos el asistencia
		if($tipo_rep=='1'){
			$datos = $solicitud->ListarReporteC3(); //Invocamos al método de iniciar
			if(empty($datos)) //Si el método, retorna un arreglo vacío
			{
			}else{
				@$_SESSION['sql'] = $sql;
				@$_SESSION['reportarcat'] = $datos;//variable sesion que guarda un arreglo con los campos de la bd
				header("Location: ../vista/solicitud/sql/");//mostrar el archivo con los datos	
			}
		}
		if($tipo_rep=='2'){
			$datos = $solicitud->ListarReporteC2($_POST['mes']); //Invocamos al método de iniciar
			if(empty($datos)) //Si el método, retorna un arreglo vacío
			{
			}else{
				@$_SESSION['sql'] = $sql;
				@$_SESSION['reportarcat'] = $datos;//variable sesion que guarda un arreglo con los campos de la bd
				header("Location: ../vista/solicitud/sql/");//mostrar el archivo con los datos	
			}
		}
		if($tipo_rep=='3'){
			$datos = $solicitud->ListarReporteC(); //Invocamos al método de iniciar
			if(empty($datos)) //Si el método, retorna un arreglo vacío
			{
			}else{
				@$_SESSION['sql'] = $sql;
				@$_SESSION['reportarcat'] = $datos;//variable sesion que guarda un arreglo con los campos de la bd
				header("Location: ../vista/solicitud/sql/");//mostrar el archivo con los datos	
			}
		}
		if($tipo_rep=='4'){
			$datos = $solicitud->ListarReporteC4($_POST['fechaini'],$_POST['fechafin']); //Invocamos al método de iniciar
			if(empty($datos)) //Si el método, retorna un arreglo vacío
			{
			}else{
				@$_SESSION['sql'] = $sql;
				@$_SESSION['reportarcat'] = $datos;//variable sesion que guarda un arreglo con los campos de la bd
				header("Location: ../vista/solicitud/sql/");//mostrar el archivo con los datos	
			}
		}
	}
?>