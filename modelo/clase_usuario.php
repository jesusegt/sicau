<?php 
	class Usuario
	{
		//variables
		private $cedula, $nombre, $apellido, $tipo, $usuario, $contraseña;

		public function __construct(){

		}
		// CEDULA
			//setters
				public function setCedula($cedula){
					$this->cedula = $cedula;
				}
			//getters
				public function getCedula(){
					return $this->cedula;
				}
		// NOMBRE
			//setters
				public function setNombre($nombre){
					$this->nombre = $nombre;
				}
			//getters
				public function getNombre(){
					return $this->nombre;
				}
		// APELLIDO
			//setters
				public function setApellido($apellido){
					$this->apellido = $apellido;
				}
			//getters
				public function getApellido(){
					return $this->apellido;
				}
		// tipo
			//setters
				public function setTipo($tipo){
					$this->tipo = $tipo;
				}
			//getters
				public function getTipo(){
					return $this->tipo;
				}
		// usuario
			//setters
				public function setNombre_usu($nombre_usu){
					$this->nombre_usu = $nombre_usu;
				}
			//getters
				public function getNombre_usu(){
					return $this->nombre_usu;
				}
		// contrasena
			//setters
				public function setContrasena($contrasena){
					$this->contrasena = $contrasena;
				}
			//getters
				public function getContrasena(){
					return $this->contrasena;
				}
		// contrasena
			//setters
				public function setClavea($clavea){
					$this->clavea = $clavea;
				}
			//getters
				public function getClavea(){
					return $this->contrasena;
				}	


		/* CATALAGO */
			public function Listar(){
				require_once("conexionpdo.php");//se llama al archivo para la conexion

				$sql = "SELECT * FROM usuario WHERE estatus='a' ";//consulto si existe el registro
				$result = $con->prepare($sql);//preparar la sentencia sql
				$result->execute();
				return $result->fetchAll(PDO::FETCH_OBJ);
			}

		/* CATALAGO INACTIVOS */
			public function ListarInactivo(){
				require_once("conexionpdo.php");//se llama al archivo para la conexion

				$sql = "SELECT * FROM usuario WHERE estatus='i' ";//consulto si existe el registro
				$result = $con->prepare($sql);//preparar la sentencia sql
				$result->execute();
				return $result->fetchAll(PDO::FETCH_OBJ);
		}


		/* REGISTRAR */
			public function RegistrarUsuario($cedula, $nombre, $apellido, $tipo, $nombre_usu, $contrasena){
				require_once("conexionpdo.php"); //se llama al archivo para la conexion

				$sql = "INSERT INTO usuario (cedula, nombre, apellido,  tipo,  nombre_usu, contrasena, estatus)VALUES (:cedula, :nombre, :apellido, :tipo,  :nombre_usu, :contrasena, :estatus)"; //sentencia sql para registrar 
				$insert = $con->prepare($sql); //preparar la sentencia sql
					//Excecute
				$insert->execute(array('cedula'=>$cedula, 'nombre'=>$nombre, 'apellido'=>$apellido, 'tipo'=>$tipo, 'nombre_usu'=>$nombre_usu, 'contrasena'=>$contrasena, 'estatus'=>'a'));
				return $insert; //retornar el resultado de la sentencia sql
			}

		/* BUSCAR */
			public function BuscarUsuario($cedula){
				require_once("conexionpdo.php");//se llama al archivo para la conexion
					
				$sql = "SELECT * FROM usuario WHERE cedula=:cedula";//sentencia sql para consultar
				$result = $con->prepare($sql);//preparar la sentencia sql
			    	$params = array('cedula'=>$cedula); 
			    	$result->execute($params); //ejecuta la sentencia sql
				$data = $result->fetchAll();//Acomoda en un arreglo el resultado de la búsqueda
				return $data;//retornar el resultado de la sentencia sql
			}

		/* CONSULTAR */
			public function ConsultarUsuario($cedula){
				require_once("conexionpdo.php");//se llama al archivo para la conexion
					
				$sql = "SELECT * FROM usuario WHERE cedula=:cedula";//sentencia sql para consultar
				$result = $con->prepare($sql);//preparar la sentencia sql
			    	$params = array('cedula'=>$cedula); 
			    	$result->execute($params); //ejecuta la sentencia sql
				$data = $result->fetchAll();//Acomoda en un arreglo el resultado de la búsqueda
				return $data;//retornar el resultado de la sentencia sql
			}

		/* MOSTRAR */
			public function MostrarUsuario($cedula){
				require_once("conexionpdo.php");//se llama al archivo para la conexion
				
				$sql = "SELECT * FROM usuario WHERE cedula=:cedula";//sentencia sql para consultar
				$result = $con->prepare($sql);//preparar la sentencia sql
				$params = array ('cedula'=>$cedula);
				$result->execute($params);//ejecuta la sentencia sql
				$data = $result->fetchAll();//Acomoda en un arreglo el resultado de la búsqueda
				return $data;//retornar el resultado de la sentencia sql
			}

		/* ACTUALIZAR */
			public function ActualizarUsuario($cedula,$nombre,$apellido,$tipo,$nombre_usu,$contrasena){
				require_once("conexionpdo.php");//se llama al archivo para la conexion
				
				$sql = "UPDATE usuario SET nombre='$nombre', apellido='$apellido', tipo='$tipo', nombre_usu='$nombre_usu', contrasena='$contrasena' WHERE cedula=:cedula";//sentencia sql para actualizar
				$result = $con->prepare($sql);//preparar la sentencia sql
				$params = array ('cedula'=>$cedula);
				$cambio = $result->execute($params);//ejecuta la sentencia sql
				return $cambio;//retornar el resultado de la sentencia sql
			}

		/* ELIMINAR */
			public function EliminarUsuario($cedula){
				require_once("conexionpdo.php");//se llama al archivo para la conexion
				 
				$sql = "SELECT * FROM usuario WHERE cedula=:cedula";//consulto si existe el registro
				$result = $con->prepare($sql);//preparar la sentencia sql
				$params = array ("cedula"=>$cedula);
				$result->execute($params);//ejecuta la sentencia sql
				$data = $result->fetchAll();//Acomoda en un arreglo el resultado de la búsqueda

				if($data){//si el arreglo no esta vacio luego elimino
					$sqld = "UPDATE usuario SET estatus='i' WHERE cedula=:cedula";//elimino el registro
					$resultd = $con->prepare($sqld);//preparar la sentencia sql
					$paramsd = array ("cedula"=>$cedula);
					$resultd->execute($paramsd);//ejecuta la sentencia sql
					$delete = $result->execute();//ejecuta la sentencia sql
					return $delete;//retorno 1, para demostrar que fue elimnado el registro encontrado
				}else{
					return $data;//retorno vacio, para demostrar que no existe el registro
				}
			}

		/* HABILITAR */
			public function HabilitarUsuario($cedula){
				require_once("conexionpdo.php");//se llama al archivo para la conexion
				 
				$sql = "SELECT * FROM usuario WHERE cedula=:cedula";//consulto si existe el registro
				$result = $con->prepare($sql);//preparar la sentencia sql
				$params = array ("cedula"=>$cedula);
				$result->execute($params);//ejecuta la sentencia sql
				$data = $result->fetchAll();//Acomoda en un arreglo el resultado de la búsqueda

				if($data){//si el arreglo no esta vacio luego elimino
					$sqld = "UPDATE usuario SET estatus='a' WHERE cedula=:cedula";//elimino el registro
					$resultd = $con->prepare($sqld);//preparar la sentencia sql
					$paramsd = array ("cedula"=>$cedula);
					$resultd->execute($paramsd);//ejecuta la sentencia sql
					$delete = $result->execute();//ejecuta la sentencia sql
					return $delete;//retorno 1, para demostrar que fue elimnado el registro encontrado
				}else{
					return $data;//retorno vacio, para demostrar que no existe el registro
				}
			}

		/* INICIAR SESION */
			public function IniciarSesion($nombre_usu,$contrasena){
			require_once("conexionpdo.php");//se llama al archivo para la conexion

			$sql = "SELECT * FROM usuario WHERE nombre_usu='$this->nombre_usu' AND contrasena='$this->contrasena'";//sentencia sql para consultar
			$result = $con->prepare($sql);//preparar la sentencia sql
		    $result->execute(); //ejecuta la sentencia sql
			$data = $result->fetchAll();//Acomoda en un arreglo el resultado de la búsqueda
				foreach($data as $u){
					//se optiene el valor de cada campo de la tabla
					@$tipo=$u['tipo'];
					@$estatus=$u['estatus'];
					@$cit=$u['cedula'];
					@$nombre=$u['nombre'];
					@$apellido=$u['apellido'];
					@$idu=$u['id'];
				}
				if(empty($data)){ //Si el método, retorna un arreglo vacío;
					echo "<script>alert('Usuario y/o Contraseña inválido(s)... Verifique nuevamente.!!!')</script>";//Mensaje de Registro no válida
					echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/login.html'>"; // ir a la pantalla de inicio
				}else{ //Si el areglo NO retornó vacío	
					if(@$estatus=="I"){
					echo "<script>alert('Usuario Inactivo... Consulte al Administrador del Sistema.!!!')</script>";//Mensaje de Registro válida
					echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../'>"; // ir a la pantalla de inicio
					}else{
					@$_SESSION['cambio']='a';
					@$_SESSION['TipoUsu']=$tipo;
					@$_SESSION['CedulaTipoUsu']=$cit;
					@$_SESSION['perfilusuario']=$nombre." ".$apellido;
					//@$_SESSION['nombreusu']=$nombre;
					//@$_SESSION['apeusu']=$apellido;
					@$_SESSION['idu']=$idu;//se optiene la sesion del tipo de usuario
					echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/'>"; // ir a la pantalla de inicio
					}	
				}
			}

		/* CERRAR SESION */
			public function CerrarSesion(){
				@$_SESSION['TipoUsu']="";
				@$_SESSION['CedulaTipoUsu']="";
				@$_SESSION['nombreusu']="";
				@$_SESSION['apeusu']="";//se optiene la sesion del tipo de usuario
				echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../'>"; // ir a la pantalla de inicio
			}

		/* MOSTRAR PERFIL */
			public function MostrarPerfil($cedula){
				require_once("conexionpdo.php");//se llama al archivo para la conexion
				
				$sql = "SELECT * FROM usuario WHERE cedula=:cedula";//sentencia sql para consultar
				$result = $con->prepare($sql);//preparar la sentencia sql
				$params = array ('cedula'=>$cedula);
				$result->execute($params);//ejecuta la sentencia sql
				$data = $result->fetchAll();//Acomoda en un arreglo el resultado de la búsqueda
				return $data;//retornar el resultado de la sentencia sql
			}

		/* ACTUALIZAR PERFIL*/
			public function ActualizarPerfil($cedula,$nombre,$apellido,$nombre_usu){
				require_once("conexionpdo.php");//se llama al archivo para la conexion
				
				$sql = "UPDATE usuario SET nombre='$nombre', apellido='$apellido', nombre_usu='$nombre_usu' WHERE cedula=:cedula";//sentencia sql para actualizar
				$result = $con->prepare($sql);//preparar la sentencia sql
				$params = array ('cedula'=>$cedula);
				$cambio = $result->execute($params);//ejecuta la sentencia sql
				@$_SESSION['perfilusuario']=$nombre." ".$apellido;
				return $cambio;

				//retornar el resultado de la sentencia sql
			}	

		/* MOSTRAR CONTRASEÑA */
			public function MostrarContrasena($cedula){
				require_once("conexionpdo.php");//se llama al archivo para la conexion
				
				$sql = "SELECT * FROM usuario WHERE cedula=:cedula";//sentencia sql para consultar
				$result = $con->prepare($sql);//preparar la sentencia sql
				$params = array ('cedula'=>$cedula);
				$result->execute($params);//ejecuta la sentencia sql
				$data = $result->fetchAll();//Acomoda en un arreglo el resultado de la búsqueda
				return $data;//retornar el resultado de la sentencia sql
			}

		/* VERIFICAR CONTRASEÑA */
			public function VerificarClave($cedula,$contrasena){
			require_once("conexionpdo.php");//se llama al archivo para la conexion

			$sql = "SELECT * FROM usuario WHERE cedula='$this->cedula' AND contrasena='$this->contrasena'";//sentencia sql para consultar
			$result = $con->prepare($sql);//preparar la sentencia sql
		    $result->execute(); //ejecuta la sentencia sql
			$data = $result->fetchAll();//Acomoda en un arreglo el resultado de la búsqueda
				foreach($data as $u){
					//se optiene el valor de cada campo de la tabla
					@$tipo=$u['tipo'];
					@$estatus=$u['estatus'];
					@$cic=$u['cedula'];
					
				}
				if(empty($data)){ //Si el método, retorna un arreglo vacío;
					echo "<script>alert('Usuario y/o Contraseña inválido(s)... Verifique nuevamente.!!!')</script>";//Mensaje de Registro no válida
					echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/bienvenido.html'>"; // ir a la pantalla de inicio
				}else{ //Si el areglo NO retornó vacío	
					if(@$estatus=="I"){
					echo "<script>alert('Usuario Inactivo... Consulte al Administrador del Sistema.!!!')</script>";//Mensaje de Registro válida
					echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../'>"; // ir a la pantalla de inicio
					}else{
					@$_SESSION['TipoUsu']=$tipo;
					@$_SESSION['CedulaTipoUsu']=$cic;
					//se optiene la sesion del tipo de usuario
					echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../controlador/ctr_usuario.php?sql=o&ci=$cic'>"; // ir a la pantalla de inicio
					}	
				}
			}

		/* CAMBIAR COTRASEÑA */
			public function CambiarContrasena($cedula,$contrasena,$clavea){
				require_once("conexionpdo.php");//se llama al archivo para la conexion
				
				$sql = "UPDATE usuario SET contrasena='$contrasena' WHERE cedula=:cedula";//consulto si existe el registro
				$result = $con->prepare($sql);//preparar la sentencia sql
				$params = array ('cedula'=>$cedula);
				$cambio = $result->execute($params);//ejecuta la sentencia sql
				return $cambio;//retornar el resultado de la sentencia sql
					
			}	



	} // CIERRE CLASE usuario


	

?>