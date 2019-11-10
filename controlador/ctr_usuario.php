<?php  

	session_start();

	include("../modelo/clase_usuario.php"); //incluir el archivo de la clase

	$usu = new Usuario(); //Creo el objeto de la clase 	

	/*============================================================================*/
	/*### CATALAGO ##############################################################*/
	/*============================================================================*/
	if(isset($_GET['list']) && $_GET['list']=="1"){//verifica que se alla presionado el boton especifico
		$datos = $usu->Listar();//Invocamos al método de consultar persona
		if(empty($datos)) //Si el método, retorna un arreglo vacío
		{
			$_SESSION['sql'] = "a";
			echo "<script>alert('No existe ningun usuario registrado.')</script>";//Mensaje de Registro no válida
			echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/usuario/sql/'>"; // ir a la pantalla de inicio
		}else{
			$_SESSION['catalago'] = $datos;
			echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/usuario/'>"; // ir a la pantalla de inicio
	
		}
	}

	/*============================================================================*/
	/*### CATALAGO INACTIVOS #####################################################*/
	/*============================================================================*/
	if(isset($_GET['list']) && $_GET['list']=="2"){//verifica que se alla presionado el boton especifico
		$datos = $usu->ListarInactivo();//Invocamos al método de consultar persona
		if(empty($datos)) //Si el método, retorna un arreglo vacío
		{
			echo "<script>alert('No existen registros inactivos.')</script>";//Mensaje de Registro no válida
			echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=ctr_usuario.php?list=1'>"; // ir a la pantalla de inicio
		}else{
			$_SESSION['sql'] = 'i';
			$_SESSION['catalago'] = $datos;
			echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/usuario/sql/'>"; // ir a la pantalla de inicio
			//break;	
		}
	}


	/*============================================================================*/
	/*### REGISTRAR ##############################################################*/
	/*============================================================================*/
	if(isset($_POST['guardar']) && $_POST['guardar']=="Guardar")//verifica que se alla presionado el boton especifico
	{
		$usu->setCedula($_POST['cedula']);//seteamos la cedula
		$usu->setNombre($_POST['nombre']);//seteamos el nombre
		$usu->setApellido($_POST['apellido']);//seteamos el apellido
		$usu->setTipo($_POST['tipo']);
		$usu->setNombre_usu($_POST['nombre_usu']);
		$usu->setContrasena($_POST['contrasena']);


		$datos = $usu->RegistrarUsuario($_POST['cedula'],$_POST['nombre'],$_POST['apellido'],$_POST['tipo'],$_POST['nombre_usu'],$_POST['contrasena']); //Invocamos al método de registrar
		if(empty($datos)){ //Si el método, retorna un arreglo vacío;
			echo "<script>alert('No se pudo registrar los datos')</script>";//Mensaje de Registro no válida
			echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/usuario/sql/?sql=a'>"; // ir a la pantalla de inicio
		}else{ //Si el areglo NO retornó vacío		
			echo "<script>alert('usuario registrado con exito')</script>";//Mensaje de Registro válida
			echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=ctr_usuario.php?list=1'>"; // Otra manera de redireccionar, esta permite que el mensaje anterior sea mostrado...
		}
	}

	/*============================================================================*/
	/*### BUSCAR ##############################################################*/
	/*============================================================================*/
	if(isset($_POST['accion']) && $_POST['accion']=="Buscar")//verifica que se alla presionado el boton especifico
	{
		$sql="b";
		$cedula = $_POST['cedula'];
		$datos = $usu->BuscarUsuario($cedula);//Invocamos al método de consultar persona recibiendo la cedula
		if(empty($datos)) //Si el método, retorna un arreglo vacío
		{
			echo "<script>alert('No existen datos')</script>";//Mensaje de Registro no válida
			echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/usuario/>"; // ir a la pantalla de inicio
		}else{
			$_SESSION['selectci'] = $datos;
			$_SESSION['sql'] = $sql;
			header("Location: ../vista/usuario/sql/");//mostrar el archivo con los datos	
			//break;	
		}
	}

	/*============================================================================*/
	/*### CONSULTAR ##############################################################*/
	/*============================================================================*/
	if(isset($_GET['sql']) && $_GET['sql']=="c")//verifica que se alla presionado el boton especifico
		{
		$sql="c";
		$cedula = $_GET['ci'];
		$datos = $usu->ConsultarUsuario($cedula);//Invocamos al método de consultar persona recibiendo la cedula
		if(empty($datos)) //Si el método, retorna un arreglo vacío
		{
		}else{
			$_SESSION['selectci'] = $datos;
			$_SESSION['sql'] = $sql;
			header("Location: ../vista/usuario/sql/");//mostrar el archivo con los datos	
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
		$datos = $usu->MostrarUsuario($id);//Invocamos al método para mostrar persona recibiendo la cedula
		if(empty($datos)) //Si el método, retorna un arreglo vacío
		{
		}else{
			$_SESSION['mostrarper'] = $datos;//variable sesion que guarda un arreglo con los campos de la bd
			$_SESSION['sql'] = $sql;
			header("Location: ../vista/usuario/sql/");//mostrar el archivo con los datos
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
		$tipo = $_POST['tipo'];

		$usu->setCedula($_POST['cedula']);
		$usu->setNombre($_POST['nombre']); //seteamos la nombre
		$usu->setApellido($_POST['apellido']); //seteamos el apellido
		$usu->setTipo($_POST['tipo']);

		$datos = $usu->ActualizarUsuario($id,$cedula,$nombre,$apellido,$tipo);//Invocamos al método de actualizar persona recibiendo la cedula
		if(empty($datos)) //Si el método, retorna un arreglo vacío
		{
			echo "<script>alert('No se pudo actualizar los datos')</script>";//Mensaje de Registro no válida
			echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/usuario/'>"; // ir a la pantalla de inicio
		}else //Si el areglo NO retornó vacío
		{			
			echo "<script>alert('Datos actualizados con exito')</script>";//Mensaje de Registro válida
			echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=ctr_usuario.php?list=1'>"; // ir a la pantalla de inicio
		}	
	}

	/*===========================================================================*/
	/*### ELIMINAR ##############################################################*/
	/*===========================================================================*/
	if(isset($_GET['sql']) && $_GET['sql']=="e"){//verifica que se alla presionado el boton especifico
		$sql="e";
		$cedula = $_GET['ci'];
		$datos = $usu->EliminarUsuario($cedula);//Invocamos al método para eliminar persona recibiendo la cedula
		if(empty($datos)) //Si el método, retorna un arreglo vacío
		{
		}else{
			echo "<script>alert('Datos eliminados con exito.')</script>";//Mensaje de Registro válida
			echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=ctr_usuario.php?list=1'>"; // ir a la pantalla de inicio
		}
	}

	/*===========================================================================*/
	/*### HABILITAR ##############################################################*/
	/*===========================================================================*/
	if(isset($_GET['sql']) && $_GET['sql']=="h"){//verifica que se alla presionado el boton especifico
		$sql="h";
		$cedula = $_GET['ci'];
		$datos = $usu->HabilitarUsuario($cedula);//Invocamos al método para eliminar persona recibiendo la cedula
		if(empty($datos)) //Si el método, retorna un arreglo vacío
		{
		}else{
			echo "<script>alert('Usuario habilitado exitosamente.')</script>";//Mensaje de Registro válida
			echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=ctr_usuario.php?list=1'>"; // ir a la pantalla de inicio
		}
	}
	
	/*============================================================================*/
	/*### INICIAR SESION #########################################################*/
	/*============================================================================*/
	if(isset($_POST['iniciar']) && $_POST['iniciar']=="Iniciar Sesion")//verifica que se alla presionado el boton especifico
		{
		$usu->setNombre_usu($_POST['nombre_usu']);//seteamos el usuario
		$usu->setContrasena($_POST['contrasena']);//seteamos la clave

		$datos = $usu->IniciarSesion($_POST['nombre_usu'],$_POST['contrasena']); //Invocamos al método de iniciar
	}

	/*============================================================================*/
	/*### CERRAR SESION ##########################################################*/
	/*============================================================================*/
	if(isset($_GET['salir']) && $_GET['salir']=="1")//verifica que se alla presionado el boton especifico
		{

		$datos = $usu->CerrarSesion(); //Invocamos al método de iniciar
	}	
	
	/*============================================================================*/
	/*### VER PERFIL ##############################################################*/
	/*============================================================================*/
	if(isset($_GET['sql']) && $_GET['sql']=="v")//verifica que se alla presionado el boton especifico
		{
		$sql="v";
		$cedula = $_GET['ci'];
		$datos = $usu->ConsultarUsuario($cedula);//Invocamos al método de consultar persona recibiendo la cedula
		if(empty($datos)) //Si el método, retorna un arreglo vacío
		{
		}else{
			$_SESSION['selectci'] = $datos;
			$_SESSION['sql'] = $sql;
			header("Location: ../vista/usuario/sql/");//mostrar el archivo con los datos	
			//break;	
		}
	}
	/*============================================================================*/
	/*### Mostrar PERFIL #########################################################*/
	/*============================================================================*/
	
	if(isset($_GET['sql']) && $_GET['sql']=="p")//verifica que se alla presionado el boton especifico
		{
		$sql="p";
		$cedula = $_GET['ci'];
		$datos = $usu->MostrarPerfil($cedula);//Invocamos al método para mostrar persona recibiendo la cedula
		if(empty($datos)) //Si el método, retorna un arreglo vacío
		{
		}else{
			$_SESSION['mostrarper'] = $datos;//variable sesion que guarda un arreglo con los campos de la bd
			$_SESSION['sql'] = $sql;
			header("Location: ../vista/usuario/sql/");//mostrar el archivo con los datos
			//break;	
		}
	}

	/*=============================================================================*/
	/*### ACTUALIZAR PERFIL #######################################################*/
	/*=============================================================================*/
	if(isset($_POST['perfil']) && $_POST['perfil']=="Actualizar"){//verifica que se alla presionado el boton especifico

		$cedula = $_POST['cedula'];
		$nombre = $_POST['nombre'];
		$apellido = $_POST['apellido'];
		$nombre_usu = $_POST['nombre_usu'];

		$usu->setNombre($_POST['nombre']); //seteamos la nombre
		$usu->setApellido($_POST['apellido']); //seteamos el apellido
		$usu->setNombre_usu($_POST['nombre_usu']);

		$datos = $usu->ActualizarPerfil($cedula,$nombre,$apellido,$nombre_usu);//Invocamos al método de actualizar persona recibiendo la cedula
		if(empty($datos)) //Si el método, retorna un arreglo vacío
		{
			echo "<script>alert('No se pudo actualizar los datos')</script>";//Mensaje de Registro no válida
			echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/usuario/'>";// ir a la pantalla de inicio
			//echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/usuario/'>";// ir a la pantalla de inicio

		}else //Si el areglo NO retornó vacío
		{	
			$cambio="b";
			$_SESSION['cambio']= $cambio;
			echo "<script>alert('Datos actualizados con exito')</script>";//Mensaje de Registro válida
			//echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=ctr_usuario.php?sql=v&ci=$cedula'>"; // ir a la pantalla de inicio
			echo "<script>window.parent.location.href= '../vista/index.php';</script>"; // ir a la pantalla de inicio
		}	
	}

	/*==========================================================================*/
	/*### MOSTRAR CONTRASEÑA ###################################################*/
	/*==========================================================================*/
	if(isset($_GET['sql']) && $_GET['sql']=="k")//verifica que se alla presionado el boton especifico
		{
		$sql="k";
		$cedula = $_GET['ci'];
		$datos = $usu->MostrarContrasena($cedula);//Invocamos al método para mostrar persona recibiendo la cedula
		if(empty($datos)) //Si el método, retorna un arreglo vacío
		{
		}else{
			$_SESSION['mostrarper'] = $datos;//variable sesion que guarda un arreglo con los campos de la bd
			$_SESSION['sql'] = $sql;
			header("Location: ../vista/usuario/sql/");//mostrar el archivo con los datos
			//break;	
		}
	}

	/*============================================================================*/
	/*### CONTRASEÑA ACTUAL #########################################################*/
	/*============================================================================*/
	if(isset($_POST['pw']) && $_POST['pw']=="Verificar")//verifica que se alla presionado el boton especifico
		{
		$usu->setCedula($_POST['cedula']);//seteamos el usuario
		$usu->setContrasena($_POST['contrasena']);//seteamos la clave

		$datos = $usu->VerificarClave($_POST['cedula'],$_POST['contrasena']); //Invocamos al método de iniciar
	}
	/*==========================================================================*/
	/*### MOSTRAR CONTRASEÑA ###################################################*/
	/*==========================================================================*/
	if(isset($_GET['sql']) && $_GET['sql']=="o")//verifica que se alla presionado el boton especifico
		{
		$sql="o";
		$cedula = $_GET['ci'];
		$datos = $usu->MostrarContrasena($cedula);//Invocamos al método para mostrar persona recibiendo la cedula
		if(empty($datos)) //Si el método, retorna un arreglo vacío
		{
		}else{
			$_SESSION['mostrarper'] = $datos;//variable sesion que guarda un arreglo con los campos de la bd
			$_SESSION['sql'] = $sql;
			header("Location: ../vista/usuario/sql/");//mostrar el archivo con los datos
			//break;	
		}
	}
	/*=============================================================================*/
	/*### CAMBIAR CONTRASEÑA ##############################################################*/
	/*=============================================================================*/
	if(isset($_POST['pw']) && $_POST['pw']=="Guardar"){//verifica que se alla presionado el boton especifico

		$usu->setCedula($_POST['cedula']);
		$usu->setContrasena_actual($_POST['contrasena_actual']);
		$usu->setContrasena($_POST['contrasena']);

		$datos = $usu->CambiarContrasena($_POST['cedula'], $_POST['contrasena_actual'], $_POST['contrasena']);//Invocamos al método de actualizar persona recibiendo la cedula
		/*if(empty($datos)) //Si el método, retorna un arreglo vacío
		{
			echo "<script>alert('No se pudo actualizar los datos')</script>";//Mensaje de Registro no válida
			echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/perfilusuario/newcontrasena.php'>"; // ir a la pantalla de inicio
		}else //Si el areglo NO retornó vacío
		{			
			echo "<script>alert('Contraseña cambiada con exito')</script>";//Mensaje de Registro válida
			echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/bienvenido.html'>"; // ir a la pantalla de inicio
		}*/	
	}
?>