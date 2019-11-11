<?php  

	session_start();

	include("../modelo/clase_solicitante.php");
	include("../modelo/clase_cargo.php"); //incluir el archivo de la clase

	$soli = new Solicitante();
	$car = new Cargo(); //Creo el objeto de la clase 	

	/*============================================================================*/
	/*### CATALAGO ##############################################################*/
	/*============================================================================*/
	if(isset($_GET['list']) && $_GET['list']=="1"){//verifica que se alla presionado el boton especifico
		$datos = $soli->Listar();//Invocamos al método de consultar persona
		/*if(empty($datos)) //Si el método, retorna un arreglo vacío
		{
			$_SESSION['sql'] = "a";
			echo "<script>alert('No existe ningun solicitante registrado.')</script>";//Mensaje de Registro no válida
			echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=ctr_solicitante.php?sql=a'>"; // ir a la pantalla de inicio
		}else{*/
			$_SESSION['catalago'] = $datos;
			echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/solicitante/'>"; // ir a la pantalla de inicio
			//break;	
		//}
	}

	/*============================================================================*/
	/*### CATALAGO INACTIVOS #####################################################*/
	/*============================================================================*/
	if(isset($_GET['list']) && $_GET['list']=="2"){//verifica que se alla presionado el boton especifico
		$datos = $soli->ListarInactivo();//Invocamos al método de consultar persona
		if(empty($datos)) //Si el método, retorna un arreglo vacío
		{
			echo "<script>alert('No existen registros inactivos.')</script>";//Mensaje de Registro no válida
			echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=ctr_solicitante.php?list=1'>"; // ir a la pantalla de inicio
		}else{
			$_SESSION['sql'] = 'i';
			$_SESSION['catalago'] = $datos;
			echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/solicitante/sql/'>"; // ir a la pantalla de inicio
			//break;	
		}
	}

	/*============================================================================*/
	/*### LISTAR CARGO ##############################################################*/
	/*============================================================================*/
	if(isset($_GET['sql']) && $_GET['sql']=="a")//verifica que se alla presionado el boton especifico
		{
		$datos = $car->Listar();//Invocamos al método de consultar persona recibiendo la id
		
			$_SESSION['sql'] = "a";
			$_SESSION['selectcargo'] = $datos;
			echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/solicitante/sql/'>";
			//break;

	}

	/*============================================================================*/
	/*### REGISTRAR ##############################################################*/
	/*============================================================================*/
	if(isset($_POST['guardar']) && $_POST['guardar']=="Guardar")//verifica que se alla presionado el boton especifico
	{
		$soli->setCedula($_POST['cedula']);//seteamos la cedula
		$soli->setNombre($_POST['nombre']);//seteamos el nombre
		$soli->setApellido($_POST['apellido']);//seteamos el apellido
		$soli->setSexo($_POST['sexo']);
		$soli->setId_cargo($_POST['id_cargo']);
		$soli->setTelefono($_POST['telefono']);
		$soli->setCorreo($_POST['correo']);


		$datos = $soli->RegistrarSolicitante($_POST['cedula'],$_POST['nombre'],$_POST['apellido'],$_POST['sexo'],$_POST['id_cargo'],$_POST['telefono'],$_POST['correo']); //Invocamos al método de registrar
	}

	/*============================================================================*/
	/*### BUSCAR ##############################################################*/
	/*============================================================================*/
	if(isset($_POST['accion']) && $_POST['accion']=="Buscar")//verifica que se alla presionado el boton especifico
	{
		$sql="b";
		$cedula = $_POST['cedula'];
		$datos = $soli->BuscarSolicitante($cedula);//Invocamos al método de consultar persona recibiendo la cedula
		if(empty($datos)) //Si el método, retorna un arreglo vacío
		{
			echo "<script>alert('No existen datos')</script>";//Mensaje de Registro no válida
			echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/solicitante/>"; // ir a la pantalla de inicio
		}else{
			$_SESSION['selectci'] = $datos;
			$_SESSION['sql'] = $sql;
			header("Location: ../vista/solicitante/sql/");//mostrar el archivo con los datos	
			//break;	
		}
	}

	

	/*============================================================================*/
	/*### CONSULTAR ##############################################################*/
	/*============================================================================*/
	if(isset($_GET['sql']) && $_GET['sql']=="c")//verifica que se alla presionado el boton especifico
		{
		$sql="c";
		$id = $_GET['id'];
		$datos = $soli->ConsultarSolicitante($id);//Invocamos al método de consultar persona recibiendo la cedula
		if(empty($datos)) //Si el método, retorna un arreglo vacío
		{ echo 'hola';
		}else{
			$_SESSION['selectci'] = $datos;
			$_SESSION['sql'] = $sql;
			header("Location: ../vista/solicitante/sql/");//mostrar el archivo con los datos	
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
		$datos = $soli->MostrarSolicitante($id);//Invocamos al método para mostrar persona recibiendo la cedula
		if(empty($datos)) //Si el método, retorna un arreglo vacío
		{
		}else{
			$_SESSION['mostrarper'] = $datos;//variable sesion que guarda un arreglo con los campos de la bd
			$_SESSION['sql'] = $sql;
			header("Location: ../vista/solicitante/sql/");//mostrar el archivo con los datos
			//break;	
		}
	}

	/*=============================================================================*/
	/*### ACTUALIZAR ##############################################################*/
	/*=============================================================================*/
	if(isset($_POST['accion']) && $_POST['accion']=="Actualizar"){//verifica que se alla presionado el boton especifico
		$id = $_POST['id'];
		$cedula = $_POST['cedula'];
		$nombre = $_POST['nombre'];
		$apellido = $_POST['apellido'];
		$sexo = $_POST['sexo'];
		$id_cargo = $_POST['id_cargo'];
		$telefono = $_POST['telefono'];
		$correo = $_POST['correo'];

		$soli->setCedula($_POST['cedula']); //seteamos la cedula
		$soli->setNombre($_POST['nombre']); //seteamos el nombre
		$soli->setapellido($_POST['apellido']); //seteamos el apellido
		$soli->setSexo($_POST['sexo']);
		$soli->setId_cargo($_POST['id_cargo']);
		$soli->setTelefono($_POST['telefono']);
		$soli->setCorreo($_POST['correo']);

		$datos = $soli->ActualizarSolicitante($id,$cedula,$nombre,$apellido,$sexo,$id_cargo,$telefono,$correo);//Invocamos al método de actualizar persona recibiendo la cedula
	}

	/*===========================================================================*/
	/*### ELIMINAR ##############################################################*/
	/*===========================================================================*/
	if(isset($_GET['sql']) && $_GET['sql']=="e"){//verifica que se alla presionado el boton especifico
		$sql="e";
		$id = $_GET['id'];
		$datos = $soli->EliminarSolicitante($id);//Invocamos al método para eliminar persona recibiendo la cedula
		if(empty($datos)) //Si el método, retorna un arreglo vacío
		{
		}else{
			echo "<script>alert('Datos eliminados con exito.')</script>";//Mensaje de Registro válida
			echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=ctr_solicitante.php?list=1'>"; // ir a la pantalla de inicio
		}
	}

	/*===========================================================================*/
	/*### HABILITAR ##############################################################*/
	/*===========================================================================*/
	if(isset($_GET['sql']) && $_GET['sql']=="h"){//verifica que se alla presionado el boton especifico
		$sql="h";
		$id = $_GET['id'];
		$datos = $soli->HabilitarSolicitante($id);//Invocamos al método para eliminar persona recibiendo la cedula
		if(empty($datos)) //Si el método, retorna un arreglo vacío
		{
		}else{
			echo "<script>alert('Solicitante habilitado exitosamente.')</script>";//Mensaje de Registro válida
			echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=ctr_solicitante.php?list=1'>"; // ir a la pantalla de inicio
		}
	}
	
	/*==========================================================================*/
	/*### PDF 01 ###############################################################*/
	/*==========================================================================*/
	if(isset($_GET['sql']) && $_GET['sql']=="r") //verifica que se alla presionado el boton especifico
		{
		$sql="r";
		$datos = $soli->listarReporte();//Invocamos al método para mostrar persona recibiendo la cedula
		if(empty($datos)) //Si el método, retorna un arreglo vacío
		{
		}else{
			$_SESSION['sql'] = $sql;
			$_SESSION['reportarcat'] = $datos;//variable sesion que guarda un arreglo con los campos de la bd
			header("Location: ../vista/solicitante/sql/");//mostrar el archivo con los datos	

		}
	}
	

?>