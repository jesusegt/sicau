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
			$_SESSION['sql'] = "a";
			echo "<script>alert('No existe ninguna Asistencia registrada.')</script>";//Mensaje de Registro no válida
			echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/asistencia/sql/'>"; // ir a la pantalla de inicio
		}else{
			$_SESSION['catalago'] = $datos;
			echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/asistencia/'>"; // ir a la pantalla de inicio
	
		}
	}

	/*============================================================================*/
	/*### CATALAGO INCOMPLETAS ###################################################*/
	/*============================================================================*/
	if(isset($_GET['list']) && $_GET['list']=="2"){//verifica que se alla presionado el boton especifico
		$datos = $asis->ListarIncompleta();//Invocamos al método de consultar persona
		if(empty($datos)) //Si el método, retorna un arreglo vacío
		{
			echo "<script>alert('No existe ninguna Asistencia Incompleta.')</script>";//Mensaje de Registro no válida
			echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/asistencia/'>"; // ir a la pantalla de inicio
		}else{
			$_SESSION['sql'] = "i";
			$_SESSION['catalago'] = $datos;
			echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/asistencia/sql/'>"; // ir a la pantalla de inicio
	
		}
	}

	/*==========================================================================*/
	/*### FORMULARIO REGISTRO ##################################################*/
	/*==========================================================================*/
	if(isset($_GET['sql']) && $_GET['sql']=="a") //verifica que se alla presionado el boton especifico
		{
		$sql="a";
		$_SESSION['sql'] = $sql;
		header("Location: ../vista/asistencia/sql/");//mostrar el archivo con los datos	

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

	/*==========================================================================*/
	/*### MENU REPORTES ########################################################*/
	/*==========================================================================*/
	if(isset($_GET['sql']) && $_GET['sql']=="mr") //verifica que se alla presionado el boton especifico
		{
		$sql="mr";
		$_SESSION['sql'] = $sql;
		header("Location: ../vista/asistencia/sql/");//mostrar el archivo con los datos	

	}

	/*==========================================================================*/
	/*### PDF 01 ###############################################################*/
	/*==========================================================================*/
	if(isset($_GET['sql']) && $_GET['sql']=="r") //verifica que se alla presionado el boton especifico
		{
		$sql="r";
		$datos = $asis->ListarReporte();//Invocamos al método para mostrar persona recibiendo la cedula
		if(empty($datos)) //Si el método, retorna un arreglo vacío
		{
		}else{
			$_SESSION['sql'] = $sql;
			$_SESSION['reportarcat'] = $datos;//variable sesion que guarda un arreglo con los campos de la bd
			header("Location: ../vista/asistencia/sql/");//mostrar el archivo con los datos	

		}
	}

	/*==========================================================================*/
	/*### PDF 02 ###############################################################*/
	/*==========================================================================*/
	if(isset($_GET['sql']) && $_GET['sql']=="r2") //verifica que se alla presionado el boton especifico
		{
		$sql="r";
		$datos = $asis->ListarReporte2();//Invocamos al método para mostrar persona recibiendo la cedula
		if(empty($datos)) //Si el método, retorna un arreglo vacío
		{
		}else{
			$_SESSION['sql'] = $sql;
			$_SESSION['reportarcat'] = $datos;//variable sesion que guarda un arreglo con los campos de la bd
			header("Location: ../vista/asistencia/sql/reporte-prueba2.php");//mostrar el archivo con los datos	

		}
	}

	/*==========================================================================*/
	/*### PDF 03 ###############################################################*/
	/*==========================================================================*/
	if(isset($_GET['sql']) && $_GET['sql']=="r3") //verifica que se alla presionado el boton especifico
		{
		$sql="r";
		$datos = $asis->ListarReporte3();//Invocamos al método para mostrar persona recibiendo la cedula
		if(empty($datos)) //Si el método, retorna un arreglo vacío
		{
		}else{
			$_SESSION['sql'] = $sql;
			$_SESSION['reportarcat'] = $datos;//variable sesion que guarda un arreglo con los campos de la bd
			header("Location: ../vista/asistencia/sql/reporte-prueba3.php");//mostrar el archivo con los datos	
		}
	}

	/*============================================================================*/
	/*### REGISTRAR 2 ##############################################################*/
	/*============================================================================*/
	if(isset($_POST['reporte']) && $_POST['reporte']=="Procesar")//verifica que se alla presionado el boton especifico
	{
		$sql="r";
		$_SESSION['reportarcat']='';
		$tipo_rep = $_POST['tipo_rep'];
		$fechaini = $_POST['fechaini'];
		$fechafin = $_POST['fechafin'];
		$mes = $_POST['mes'];

		$asis->setTipo_rep($_POST['tipo_rep']);
		$asis->setFechaini($_POST['fechaini']);
		$asis->setFechafin($_POST['fechafin']);
		$asis->setMes($_POST['mes']);
		//seteamos el asistencia
		if($tipo_rep=='1'){
			$datos = $asis->ListarReporte3(); //Invocamos al método de iniciar
			if(empty($datos)) //Si el método, retorna un arreglo vacío
			{
			}else{
				$_SESSION['sql'] = $sql;
				$_SESSION['reportarcat'] = $datos;//variable sesion que guarda un arreglo con los campos de la bd
				header("Location: ../vista/asistencia/sql/");//mostrar el archivo con los datos	
			}
		}
		if($tipo_rep=='2'){
			$datos = $asis->ListarReporte2($_POST['mes']); //Invocamos al método de iniciar
			if(empty($datos)) //Si el método, retorna un arreglo vacío
			{
			}else{
				$_SESSION['sql'] = $sql;
				$_SESSION['reportarcat'] = $datos;//variable sesion que guarda un arreglo con los campos de la bd
				header("Location: ../vista/asistencia/sql/");//mostrar el archivo con los datos	
			}
		}
		if($tipo_rep=='3'){
			$datos = $asis->ListarReporte(); //Invocamos al método de iniciar
			if(empty($datos)) //Si el método, retorna un arreglo vacío
			{
			}else{
				$_SESSION['sql'] = $sql;
				$_SESSION['reportarcat'] = $datos;//variable sesion que guarda un arreglo con los campos de la bd
				header("Location: ../vista/asistencia/sql/");//mostrar el archivo con los datos	
			}
		}
		if($tipo_rep=='4'){
			$datos = $asis->ListarReporte4($_POST['fechaini'],$_POST['fechafin']); //Invocamos al método de iniciar
			if(empty($datos)) //Si el método, retorna un arreglo vacío
			{
			}else{
				$_SESSION['sql'] = $sql;
				$_SESSION['reportarcat'] = $datos;//variable sesion que guarda un arreglo con los campos de la bd
				header("Location: ../vista/asistencia/sql/");//mostrar el archivo con los datos	
			}
		}
	}
?>