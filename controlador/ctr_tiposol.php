<?php  

	session_start();

	include("../modelo/clase_tiposol.php"); //incluir el archivo de la clase

	$tiposol = new Tiposol(); //Creo el objeto de la clase 	

	/*============================================================================*/
	/*### CATALAGO ##############################################################*/
	/*============================================================================*/
	if(isset($_GET['list']) && $_GET['list']=="1"){//verifica que se alla presionado el boton especifico
		$datos = $tiposol->Listar();//Invocamos al método de consultar persona
		if(empty($datos)) //Si el método, retorna un arreglo vacío
		{
			$_SESSION['sql'] = "a";
			echo "<script>alert('No existe ningun tipo de solicitud registrada.')</script>";//Mensaje de Registro no válida
			echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/tipo_solicitud/sql/'>"; // ir a la pantalla de inicio
		}else{
			$_SESSION['catalago'] = $datos;
			echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/tipo_solicitud/'>"; // ir a la pantalla de inicio
			//break;	
		}
	}

	/*============================================================================*/
	/*### CATALAGO INACTIVOS #####################################################*/
	/*============================================================================*/
	if(isset($_GET['list']) && $_GET['list']=="2"){//verifica que se alla presionado el boton especifico
		$datos = $tiposol->ListarInactivo();//Invocamos al método de consultar persona
		if(empty($datos)) //Si el método, retorna un arreglo vacío
		{
			echo "<script>alert('No existen registros inactivos.')</script>";//Mensaje de Registro no válida
			echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=ctr_tiposol.php?list=1'>"; // ir a la pantalla de inicio
		}else{
			$_SESSION['sql'] = 'i';
			$_SESSION['catalago'] = $datos;
			echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/tipo_solicitud/sql/'>"; // ir a la pantalla de inicio
			//break;	
		}
	}



	/*============================================================================*/
	/*### REGISTRAR ##############################################################*/
	/*============================================================================*/
	if(isset($_POST['guardar']) && $_POST['guardar']=="Guardar")//verifica que se alla presionado el boton especifico
	{
		$tiposol->setNombre($_POST['nombre']);//seteamos el nombre


		$datos = $tiposol->RegistrarTiposol($_POST['nombre']); //Invocamos al método de registrar
		if(empty($datos)){ //Si el método, retorna un arreglo vacío;
			echo "<script>alert('No se pudo registrar los datos')</script>";//Mensaje de Registro no válida
			echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/tipo_solicitud/sql/?sql=a'>"; // ir a la pantalla de inicio
		}else{ //Si el areglo NO retornó vacío		
			echo "<script>alert('Tipo de solicitud registrada con exito')</script>";//Mensaje de Registro válida
			echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=ctr_tiposol.php?list=1'>"; // Otra manera de redireccionar, esta permite que el mensaje anterior sea mostrado...
		}
	}

	/*============================================================================*/
	/*### CONSULTAR ##############################################################*/
	/*============================================================================*/
	if(isset($_GET['sql']) && $_GET['sql']=="c")//verifica que se alla presionado el boton especifico
		{
		$sql="c";
		$id = $_GET['id'];
		$datos = $tiposol->ConsultarTiposol($id);//Invocamos al método de consultar persona recibiendo la id
		if(empty($datos)) //Si el método, retorna un arreglo vacío
		{
		}else{
			$_SESSION['selectid'] = $datos;
			$_SESSION['sql'] = $sql;
			header("Location: ../vista/tipo_solicitud/sql/");//mostrar el archivo con los datos	
			//break;	
		}
	}

	/*==========================================================================*/
	/*### MOSTRAR ##############################################################*/
	/*==========================================================================*/
	if(isset($_GET['sql']) && $_GET['sql']=="m")//verifica que se alla presionado el boton especifico
		{
		$sql="m";
		$id = $_GET['id'];
		$datos = $tiposol->MostrarTiposol($id);//Invocamos al método para mostrar persona recibiendo la id
		if(empty($datos)) //Si el método, retorna un arreglo vacío
		{
		}else{
			$_SESSION['mostrarper'] = $datos;//variable sesion que guarda un arreglo con los campos de la bd
			$_SESSION['sql'] = $sql;
			header("Location: ../vista/tipo_solicitud/sql/");//mostrar el archivo con los datos
			//break;	
		}
	}

	/*=============================================================================*/
	/*### ACTUALIZAR ##############################################################*/
	/*=============================================================================*/
	if(isset($_POST['accion']) && $_POST['accion']=="Actualizar"){//verifica que se alla presionado el boton especifico
		$id = $_POST['id'];
		$nombre = $_POST['nombre'];

		$tiposol->setNombre($_POST['nombre']); //seteamos la nombre

		$datos = $tiposol->ActualizarTiposol($id, $nombre);//Invocamos al método de actualizar persona recibiendo la id
		if(empty($datos)) //Si el método, retorna un arreglo vacío
		{
			echo "<script>alert('No se pudo actualizar los datos')</script>";//Mensaje de Registro no válida
			echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/tipo_solicitud/'>"; // ir a la pantalla de inicio
		}else //Si el areglo NO retornó vacío
		{			
			echo "<script>alert('Datos actualizados con exito')</script>";//Mensaje de Registro válida
			echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=ctr_tiposol.php?list=1'>"; // ir a la pantalla de inicio
		}	
	}

	/*===========================================================================*/
	/*### ELIMINAR ##############################################################*/
	/*===========================================================================*/
	if(isset($_GET['sql']) && $_GET['sql']=="e"){//verifica que se alla presionado el boton especifico
		$sql="e";
		$id = $_GET['id'];
		$datos = $tiposol->EliminarTiposol($id);//Invocamos al método para eliminar persona recibiendo la id
		if(empty($datos)) //Si el método, retorna un arreglo vacío
		{
		}else{
			echo "<script>alert('Datos eliminados con exito.')</script>";//Mensaje de Registro válida
			echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=ctr_tiposol.php?list=1'>"; // ir a la pantalla de inicio
		}
	}

	/*===========================================================================*/
	/*### HABILITAR ##############################################################*/
	/*===========================================================================*/
	if(isset($_GET['sql']) && $_GET['sql']=="h"){//verifica que se alla presionado el boton especifico
		$sql="h";
		$id = $_GET['id'];
		$datos = $tiposol->HabilitarTiposol($id);//Invocamos al método para eliminar persona recibiendo la id
		if(empty($datos)) //Si el método, retorna un arreglo vacío
		{
		}else{
			echo "<script>alert('Registro habilitado con exito.')</script>";//Mensaje de Registro válida
			echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=ctr_tiposol.php?list=2'>"; // ir a la pantalla de inicio
		}
	}
	
	/*==========================================================================*/
	/*### PDF 01 ###############################################################*/
	/*==========================================================================*/
	if(isset($_GET['sql']) && $_GET['sql']=="r") //verifica que se alla presionado el boton especifico
		{
		$sql="r";
		$datos = $tiposol->listarReporte();//Invocamos al método para mostrar persona recibiendo la cedula
		if(empty($datos)) //Si el método, retorna un arreglo vacío
		{
		}else{
			$_SESSION['sql'] = $sql;
			$_SESSION['reportarcat'] = $datos;//variable sesion que guarda un arreglo con los campos de la bd
			header("Location: ../vista/tipo_solicitud/sql/");//mostrar el archivo con los datos	

		}
	}
	

?>