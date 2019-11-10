<?php  

	session_start();

	include("../modelo/clase_subarea.php");
	include("../modelo/clase_area.php"); //incluir el archivo de la clase

	$are = new Subarea(); //Creo el objeto de la clase 	
	$area = new Area();


 	/*============================================================================*/
	/*### CATALAGO ##############################################################*/
	/*============================================================================*/
	if(isset($_GET['list']) && $_GET['list']=="1"){//verifica que se alla presionado el boton especifico
		$datos = $are->Listar();//Invocamos al método de consultar persona
		if(empty($datos)) //Si el método, retorna un arreglo vacío
		{
			$_SESSION['sql'] = "a";
			echo "<script>alert('No existe ningun Subarea registrada.')</script>";//Mensaje de Registro no válida
			echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=ctr_subarea.php?sql=a'>"; // ir a la pantalla de inicio
		}else{
			$_SESSION['catalago'] = $datos;
			echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/subarea/'>"; // ir a la pantalla de inicio
			//break;	
		}
	}

	/*============================================================================*/
	/*### CATALAGO INACTIVOS #####################################################*/
	/*============================================================================*/
	if(isset($_GET['list']) && $_GET['list']=="2"){//verifica que se alla presionado el boton especifico
		$datos = $are->ListarInactivo();//Invocamos al método de consultar persona
		if(empty($datos)) //Si el método, retorna un arreglo vacío
		{
			echo "<script>alert('No existen registros inactivos.')</script>";//Mensaje de Registro no válida
			echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=ctr_subarea.php?list=1'>"; // ir a la pantalla de inicio
		}else{
			$_SESSION['sql'] = 'i';
			$_SESSION['catalago'] = $datos;
			echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/subarea/sql/'>"; // ir a la pantalla de inicio
			//break;	
		}
	}

	/*============================================================================*/
	/*### LISTAR AREA ##############################################################*/
	/*============================================================================*/
	if(isset($_GET['sql']) && $_GET['sql']=="a")//verifica que se alla presionado el boton especifico
		{
		$datos = $area->Listar();//Invocamos al método de consultar persona recibiendo la id
		
			$_SESSION['sql'] = "a";
			$_SESSION['selectarea'] = $datos;
			echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/subarea/sql/'>";
			//break;

	}


	/*============================================================================*/
	/*### REGISTRAR ##############################################################*/
	/*============================================================================*/
	if(isset($_POST['guardar']) && $_POST['guardar']=="Guardar")//verifica que se alla presionado el boton especifico
	{
		$are->setId_area($_POST['id_area']);//seteamos el nombre
		$are->setNombre($_POST['nombre']);
		$datos = $are->RegistrarSubarea($_POST['id_area'], $_POST['nombre']); //Invocamos al método de registrar
		if(empty($datos)){ //Si el método, retorna un arreglo vacío;
			echo "<script>alert('No se pudo registrar los datos')</script>";//Mensaje de Registro no válida
			echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/subarea/sql/?sql=a'>"; // ir a la pantalla de inicio
		}else{ //Si el areglo NO retornó vacío		
			echo "<script>alert('Subarea registrada con exito')</script>";//Mensaje de Registro válida
			echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=ctr_subarea.php?list=1'>"; // Otra manera de redireccionar, esta permite que el mensaje anterior sea mostrado...
		}
	}

	/*============================================================================*/
	/*### CONSULTAR ##############################################################*/
	/*============================================================================*/
	if(isset($_GET['sql']) && $_GET['sql']=="c")//verifica que se alla presionado el boton especifico
		{
		$sql="c";
		$id = $_GET['id'];
		$datos = $are->ConsultarSubarea($id);//Invocamos al método de consultar persona recibiendo la id
		if(empty($datos)) //Si el método, retorna un arreglo vacío
		{
		}else{
			$_SESSION['selectid'] = $datos;
			$_SESSION['sql'] = $sql;
			header("Location: ../vista/subarea/sql/");//mostrar el archivo con los datos	
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
		
		$datos = $are->MostrarSubarea($id);//Invocamos al método para mostrar persona recibiendo la id
		if(empty($datos)) //Si el método, retorna un arreglo vacío
		{
		}else{
			
			$_SESSION['mostrarper'] = $datos;//variable sesion que guarda un arreglo con los campos de la bd
			$_SESSION['sql'] = $sql;
			header("Location: ../vista/subarea/sql/");//mostrar el archivo con los datos
			//break;

		}
	}

	

	/*=============================================================================*/
	/*### ACTUALIZAR ##############################################################*/
	/*=============================================================================*/
	if(isset($_POST['accion']) && $_POST['accion']=="Actualizar"){//verifica que se alla presionado el boton especifico
		$id = $_POST['id'];
		$id_area = $_POST['id_area'];
		$nombre = $_POST['nombre'];

		$are->setId_area($_POST['id_area']); //seteamos la nombre
		$are->setNombre($_POST['nombre']);

		$datos = $are->ActualizarSubarea($id, $id_area, $nombre);//Invocamos al método de actualizar persona recibiendo la id
		if(empty($datos)) //Si el método, retorna un arreglo vacío
		{
			echo "<script>alert('No se pudo actualizar los datos')</script>";//Mensaje de Registro no válida
			echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/subarea/'>"; // ir a la pantalla de inicio
		}else //Si el areglo NO retornó vacío
		{			
			echo "<script>alert('Datos actualizados con exito')</script>";//Mensaje de Registro válida
			echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=ctr_subarea.php?list=1'>"; // ir a la pantalla de inicio
		}	
	}

	/*===========================================================================*/
	/*### ELIMINAR ##############################################################*/
	/*===========================================================================*/
	if(isset($_GET['sql']) && $_GET['sql']=="e"){//verifica que se alla presionado el boton especifico
		$sql="e";
		$id = $_GET['id'];
		$datos = $are->EliminarSubarea($id);//Invocamos al método para eliminar persona recibiendo la id
		if(empty($datos)) //Si el método, retorna un arreglo vacío
		{
		}else{
			echo "<script>alert('Datos eliminados con exito.')</script>";//Mensaje de Registro válida
			echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=ctr_subarea.php?list=1'>"; // ir a la pantalla de inicio
		}
	}

	/*===========================================================================*/
	/*### HABILITAR ##############################################################*/
	/*===========================================================================*/
	if(isset($_GET['sql']) && $_GET['sql']=="h"){//verifica que se alla presionado el boton especifico
		$sql="h";
		$id = $_GET['id'];
		$datos = $are->HabilitarSubarea($id);//Invocamos al método para eliminar persona recibiendo la id
		if(empty($datos)) //Si el método, retorna un arreglo vacío
		{
		}else{
			echo "<script>alert('Registro habilitado con exito.')</script>";//Mensaje de Registro válida
			echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=ctr_subarea.php?list=2'>"; // ir a la pantalla de inicio
		}
	}
	
	/*==========================================================================*/
	/*### PDF 01 ###############################################################*/
	/*==========================================================================*/
	if(isset($_GET['sql']) && $_GET['sql']=="r") //verifica que se alla presionado el boton especifico
		{
		$sql="r";
		$datos = $are->listarReporte();//Invocamos al método para mostrar persona recibiendo la cedula
		if(empty($datos)) //Si el método, retorna un arreglo vacío
		{
		}else{
			$_SESSION['sql'] = $sql;
			$_SESSION['reportarcat'] = $datos;//variable sesion que guarda un arreglo con los campos de la bd
			header("Location: ../vista/subarea/sql/");//mostrar el archivo con los datos	

		}
	}
	
?>