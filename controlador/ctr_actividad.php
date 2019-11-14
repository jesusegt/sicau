<?php  

	session_start();

	include("../modelo/clase_actividad.php"); //incluir el archivo de la clase

	$act = new Actividad(); //Creo el objeto de la clase 	

	/*============================================================================*/
	/*### CATALAGO ##############################################################*/
	/*============================================================================*/
	if(isset($_GET['list']) && $_GET['list']=="1"){//verifica que se alla presionado el boton especifico
		$datos = $act->Listar();//Invocamos al método de consultar persona
		/*if(empty($datos)) //Si el método, retorna un arreglo vacío
		{
			echo "<script>alert('No existe ninguna actividad registrada.')</script>";//Mensaje de Registro no válida
			echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/actividad/sql/'>"; // ir a la pantalla de inicio
		}else{*/
			$_SESSION['catalago'] = $datos;
			echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/actividad/'>"; // ir a la pantalla de inicio
	
		//}
	}

	/*==========================================================================*/
	/*### FORMULARIO REGISTRO ##################################################*/
	/*==========================================================================*/
	if(isset($_GET['sql']) && $_GET['sql']=="a") //verifica que se alla presionado el boton especifico
		{
		$sql="a";
		$_SESSION['sql'] = $sql;
		header("Location: ../vista/actividad/sql/");//mostrar el archivo con los datos	

	}

	/*============================================================================*/
	/*### REGISTAR ###############################################################*/
	/*============================================================================*/
	if(isset($_POST['registrar']) && $_POST['registrar']=="Registrar")//verifica que se alla presionado el boton especifico
		{
		$act->setCedula($_POST['cedula']);
		$act->setFecha($_POST['fecha']);

		$datos = $act->RegistrarActividad($_POST['cedula'],$_POST['fecha']); //Invocamos al método de iniciar
		
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

		$act->setTipo_rep($_POST['tipo_rep']);
		$act->setFechaini($_POST['fechaini']);
		$act->setFechafin($_POST['fechafin']);
		$act->setMes($_POST['mes']);
		//seteamos el asistencia
		if($tipo_rep=='1'){
			$datos = $act->ListarReporte3(); //Invocamos al método de iniciar
			if(empty($datos)) //Si el método, retorna un arreglo vacío
			{
			}else{
				@$_SESSION['sql'] = $sql;
				@$_SESSION['reportarcat'] = $datos;//variable sesion que guarda un arreglo con los campos de la bd
				header("Location: ../vista/actividad/sql/");//mostrar el archivo con los datos	
			}
		}
		if($tipo_rep=='2'){
			$datos = $act->ListarReporte2($_POST['mes']); //Invocamos al método de iniciar
			if(empty($datos)) //Si el método, retorna un arreglo vacío
			{
			}else{
				@$_SESSION['sql'] = $sql;
				@$_SESSION['reportarcat'] = $datos;//variable sesion que guarda un arreglo con los campos de la bd
				header("Location: ../vista/actividad/sql/");//mostrar el archivo con los datos	
			}
		}
		if($tipo_rep=='3'){
			$datos = $act->ListarReporte(); //Invocamos al método de iniciar
			if(empty($datos)) //Si el método, retorna un arreglo vacío
			{
			}else{
				@$_SESSION['sql'] = $sql;
				@$_SESSION['reportarcat'] = $datos;//variable sesion que guarda un arreglo con los campos de la bd
				header("Location: ../vista/actividad/sql/");//mostrar el archivo con los datos	
			}
		}
		if($tipo_rep=='4'){
			$datos = $act->ListarReporte4($_POST['fechaini'],$_POST['fechafin']); //Invocamos al método de iniciar
			if(empty($datos)) //Si el método, retorna un arreglo vacío
			{
			}else{
				@$_SESSION['sql'] = $sql;
				@$_SESSION['reportarcat'] = $datos;//variable sesion que guarda un arreglo con los campos de la bd
				header("Location: ../vista/actividad/sql/");//mostrar el archivo con los datos	
			}
		}
	}
?>