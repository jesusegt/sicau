<?php 
	class Solicitante
	{
		//variables
		private $cedula, $nombre, $apellido, $telefono, $correo, $sexo, $id_cargo;

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
		// SEXO
			//setters
				public function setSexo($sexo){
					$this->sexo = $sexo;
				}
			//getters
				public function getSexo(){
					return $this->sexo;
				}
		// CARGO
			//setters
				public function setId_cargo($id_cargo){
					$this->id_cargo = $id_cargo;
				}
			//getters
				public function getId_cargo(){
					return $this->id_cargo;
				}
		// TELEFONO
			//setters
				public function setTelefono($telefono){
					$this->telefono = $telefono;
				}
			//getters
				public function getTelefono(){
					return $this->telefono;
				}
		// Correo
			//setters
				public function setCorreo($correo){
					$this->correo = $correo;
				}
			//getters
				public function getCorreo(){
					return $this->correo;
				}


		/* CATALAGO */
			public function Listar(){
				require_once("conexionpdo.php");//se llama al archivo para la conexion

				$sql = "SELECT s.id AS idsol,
								s.cedula AS cedulasol, 
								s.nombre AS nombresol,
								s.apellido AS apellidosol,
								s.sexo AS sexosol, 
								s.estatus AS estatussol, 
								c.id AS idcar, 
								c.nombre AS nombrecar
						FROM solicitante AS s INNER JOIN cargo AS c 
						ON s.id_cargo=c.id WHERE s.estatus='a'";//consulto si existe el registro
				$result = $con->prepare($sql);//preparar la sentencia sql
				$result->execute();
				return $result->fetchAll(PDO::FETCH_OBJ);
			}

		/* CATALAGO INACTIVOS */
			public function ListarInactivo(){
				require_once("conexionpdo.php");//se llama al archivo para la conexion

				$sql = "SELECT s.id AS idsol,
								s.cedula AS cedulasol, 
								s.nombre AS nombresol,
								s.apellido AS apellidosol,
								s.sexo AS sexosol, 
								s.estatus AS estatussol, 
								c.id AS idcar, 
								c.nombre AS nombrecar
						FROM solicitante AS s INNER JOIN cargo AS c 
						ON s.id_cargo=c.id WHERE s.estatus='i'";//consulto si existe el registro
				$result = $con->prepare($sql);//preparar la sentencia sql
				$result->execute();
				return $result->fetchAll(PDO::FETCH_OBJ);
		}


		/* REGISTRAR */
			public function RegistrarSolicitante($cedula, $nombre, $apellido, $sexo, $id_cargo, $telefono, $correo){
				require_once("conexionpdo.php"); //se llama al archivo para la conexion

				$sql = "INSERT INTO solicitante (cedula, nombre, apellido, sexo, id_cargo,  telefono, estatus)VALUES (:cedula, :nombre, :apellido, :sexo, :id_cargo,  :telefono, :estatus)"; //sentencia sql para registrar 
				$insert = $con->prepare($sql); //preparar la sentencia sql
					//Excecute
				$insert->execute(array('cedula'=>$cedula, 'nombre'=>$nombre, 'apellido'=>$apellido, 'sexo'=>$sexo, 'id_cargo'=>$id_cargo, 'telefono'=>$telefono, 'estatus'=>'a'));
				 //retornar el resultado de la sentencia sql

						if(empty($correo)){
							echo "<script>alert('Solicitante registrado con exito.')</script>";//Mensaje de Registro válida
							echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=ctr_solicitante.php?list=1'>"; // Otra manera de redireccionar, esta permite que el mensaje anterior sea mostrado...
						}else{
							$sql = "INSERT INTO correo_sol (cedula_sol, correo)VALUES (:cedula, :correo)"; //sentencia sql para registrar 
							$insert = $con->prepare($sql); //preparar la sentencia sql
						//Excecute
							$insert->execute(array('cedula'=>$cedula, 'correo'=>$correo));
							 //retornar el resultado de la sentencia sql
							echo "<script>alert('Solicitante registrado con exito.')</script>";//Mensaje de Registro válida
							echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=ctr_solicitante.php?list=1'>"; // Otra manera de redireccionar, esta permite que el mensaje anterior sea mostrado...
						}


			}

		/* BUSCAR */
			public function ConsultarSolicitante($cedula){
				require_once("conexionpdo.php");//se llama al archivo para la conexion
				
				$sql = "SELECT * FROM correo_sol WHERE cedula_sol=:cedula";//sentencia sql para consultar
					$result = $con->prepare($sql);//preparar la sentencia sql
			    	$params = array('cedula'=>$cedula); 
			    	$result->execute($params); //ejecuta la sentencia sql
					$data = $result->fetchAll();
				if(empty($data)){
					$sql = "SELECT s.id AS idsol,
									s.cedula AS cedulasol, 
									s.nombre AS nombresol,
									s.apellido AS apellidosol,
									s.sexo AS sexosol,
									s.telefono AS telefonosol,
									c.id AS idcar, 
									c.nombre AS nombrecar, 
									c.estatus AS estatuscar
							FROM solicitante AS s INNER JOIN cargo AS c 
							ON s.id_cargo=c.id
							WHERE s.cedula=:cedula";//sentencia sql para consultar
					$result = $con->prepare($sql);//preparar la sentencia sql
				    	$params = array('cedula'=>$cedula); 
				    	$result->execute($params); //ejecuta la sentencia sql
					$data = $result->fetchAll();//Acomoda en un arreglo el resultado de la búsqueda
				}else{
					$sql = "SELECT s.id AS idsol,
									s.cedula AS cedulasol, 
									s.nombre AS nombresol,
									s.apellido AS apellidosol,
									s.sexo AS sexosol,
									s.telefono AS telefonosol,
									c.id AS idcar, 
									c.nombre AS nombrecar, 
									c.estatus AS estatuscar,
									a.cedula_sol AS cedulacor,
									a.correo AS correo
							FROM solicitante AS s, cargo AS c, correo_sol AS a 
							WHERE s.cedula=:cedula AND s.id_cargo=c.id AND a.cedula_sol=:cedula";//sentencia sql para consultar
					$result = $con->prepare($sql);//preparar la sentencia sql
				    	$params = array('cedula'=>$cedula); 
				    	$result->execute($params); //ejecuta la sentencia sql
					$data = $result->fetchAll();//Acomoda en un arreglo el resultado de la búsqueda
				}	
				return $data;//retornar el resultado de la sentencia sql
			}

		/* CONSULTAR */
			public function BuscarSolicitante($cedula){
				require_once("conexionpdo.php");//se llama al archivo para la conexion
					
				$sql = "SELECT * FROM solicitante WHERE cedula=:cedula";//sentencia sql para consultar
				$result = $con->prepare($sql);
				$params = array('cedula'=>$cedula); 
			    $result->execute($params);//preparar la sentencia sql
				$data = $result->fetchAll();//Acomoda en un arreglo el resultado de la búsqueda
				foreach($data as $u){
					//se optiene el valor de cada campo de la tabla
					@$id=$u['id'];	
				}
				
				if(empty($data)){ //Si el método, retorna un arreglo vacío;
					echo "<script>alert('Obrero no existente, si usted es un Obrero de la institución contacte al encargado del sistema para ser registrado.')</script>";//Mensaje de Registro no válida
					echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/regasis.html'>"; // ir a la pantalla de inicio
				}else{ //Si el areglo NO retornó vacío	
					if(@$id_cargo=="1"){

						if(@$estatus=="i"){
						echo "<script>alert('Obrero inactivo, para ser activado nuevamente contacte al encargado del sistema.')</script>";//Mensaje de Registro válida
						echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/regasis.html'>"; // ir a la pantalla de inicio
						}else{
						echo "<script>alert('Asistencia registrada con exito')</script>";//Mensaje de Registro válida
						echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../index.html'>"; // ir a la pantalla de inicio
						$sql = "INSERT INTO asistencia (fecha, id_sol)VALUES (:fecha, :id)"; //sentencia sql para registrar 
						$insert = $con->prepare($sql); //preparar la sentencia sql
							//Excecute
						$insert->execute(array('fecha'=>$fecha, 'id'=>$id));
						
						
						return $insert;
						}
					}else{

						echo "<script>alert('Obrero no existente, si usted es un Obrero de la institución contacte al encargado del sistema para ser registrado.')</script>";//Mensaje de Registro válida
						echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/regasis.html'>"; // ir a la pantalla de inicio
						}	
					}
				}//retornar el resultado de la sentencia sql
			

		/* MOSTRAR */
			public function MostrarSolicitante($cedula){
				require_once("conexionpdo.php");//se llama al archivo para la conexion
				
					$sql = "SELECT * FROM correo_sol WHERE cedula_sol=:cedula";//sentencia sql para consultar
					$result = $con->prepare($sql);//preparar la sentencia sql
			    	$params = array('cedula'=>$cedula); 
			    	$result->execute($params); //ejecuta la sentencia sql
					$data = $result->fetchAll();
				if(empty($data)){
					$sql = "SELECT s.id AS idsol,
									s.cedula AS cedulasol, 
									s.nombre AS nombresol,
									s.apellido AS apellidosol,
									s.sexo AS sexosol,
									s.telefono AS telefonosol,
									c.id AS idcar, 
									c.nombre AS nombrecar, 
									c.estatus AS estatuscar
							FROM solicitante AS s INNER JOIN cargo AS c 
							ON s.id_cargo=c.id
							WHERE s.cedula=:cedula";//sentencia sql para consultar
					$result = $con->prepare($sql);//preparar la sentencia sql
				    	$params = array('cedula'=>$cedula); 
				    	$result->execute($params); //ejecuta la sentencia sql
					$data = $result->fetchAll();//Acomoda en un arreglo el resultado de la búsqueda
				}else{
					$sql = "SELECT s.id AS idsol,
									s.cedula AS cedulasol, 
									s.nombre AS nombresol,
									s.apellido AS apellidosol,
									s.sexo AS sexosol,
									s.telefono AS telefonosol,
									c.id AS idcar, 
									c.nombre AS nombrecar, 
									c.estatus AS estatuscar,
									a.cedula_sol AS cedulacor,
									a.correo AS correo
							FROM solicitante AS s, cargo AS c, correo_sol AS a 
							WHERE s.cedula=:cedula AND s.id_cargo=c.id AND a.cedula_sol=:cedula";//sentencia sql para consultar
					$result = $con->prepare($sql);//preparar la sentencia sql
				    	$params = array('cedula'=>$cedula); 
				    	$result->execute($params); //ejecuta la sentencia sql
					$data = $result->fetchAll();//Acomoda en un arreglo el resultado de la búsqueda
				}
				return $data;//retornar el resultado de la sentencia sql
			}

		/* ACTUALIZAR */
			public function ActualizarSolicitante($cedula,$nombre,$apellido,$sexo,$id_cargo,$telefono,$correo){
				require_once("conexionpdo.php");//se llama al archivo para la conexion
				
				$sql = "UPDATE solicitante SET nombre='$nombre', apellido='$apellido', sexo='$sexo', id_cargo='$id_cargo', telefono='$telefono' WHERE cedula=:cedula";//sentencia sql para actualizar
				$result = $con->prepare($sql);//preparar la sentencia sql
				$params = array ('cedula'=>$cedula);
				$cambio = $result->execute($params);//ejecuta la sentencia sql

				if(empty($correo)){
							echo "<script>alert('Solicitante actualizado con exito.')</script>";//Mensaje de Registro válida
							echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=ctr_solicitante.php?list=1'>"; // Otra manera de redireccionar, esta permite que el mensaje anterior sea mostrado...
						}else{
							$sql = "SELECT * FROM correo_sol WHERE cedula_sol=:cedula";
							$result = $con->prepare($sql);//preparar la sentencia sql
					    	$params = array('cedula'=>$cedula); 
					    	$result->execute($params); //ejecuta la sentencia sql
							$data = $result->fetchAll();

							if(empty($data)){
								$sql = "INSERT INTO correo_sol (cedula_sol, correo)VALUES (:cedula, :correo)"; //sentencia sql para registrar 
								$insert = $con->prepare($sql); //preparar la sentencia sql
							//Excecute
								$insert->execute(array('cedula'=>$cedula, 'correo'=>$correo));
								 //retornar el resultado de la sentencia sql
								echo "<script>alert('Solicitante actualizado con exito.')</script>";//Mensaje de Registro válida
								echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=ctr_solicitante.php?list=1'>"; // Otra manera de redireccionar, esta permite que el mensaje anterior sea mostrado...
							}else{
								$sql = "UPDATE correo_sol SET correo='$correo' WHERE cedula_sol=:cedula";//sentencia sql para actualizar
								$result = $con->prepare($sql);//preparar la sentencia sql
								$params = array ('cedula'=>$cedula);
								$cambio = $result->execute($params);

								echo "<script>alert('Solicitante actualizado con exito.')</script>";//Mensaje de Registro válida
								echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=ctr_solicitante.php?list=1'>"; // Otra manera de redireccionar, esta permite que el mensaje anterior sea mostrado...
							}
						}
			}

		/* ELIMINAR */
			public function EliminarSolicitante($cedula){
				require_once("conexionpdo.php");//se llama al archivo para la conexion
				 
				$sql = "SELECT * FROM solicitante WHERE cedula=:cedula";//consulto si existe el registro
				$result = $con->prepare($sql);//preparar la sentencia sql
				$params = array ("cedula"=>$cedula);
				$result->execute($params);//ejecuta la sentencia sql
				$data = $result->fetchAll();//Acomoda en un arreglo el resultado de la búsqueda

				if($data){//si el arreglo no esta vacio luego elimino
					$sqld = "UPDATE solicitante SET estatus='i' WHERE cedula=:cedula";//elimino el registro
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
			public function HabilitarSolicitante($cedula){
				require_once("conexionpdo.php");//se llama al archivo para la conexion
				 
				$sql = "SELECT * FROM solicitante WHERE cedula=:cedula";//consulto si existe el registro
				$result = $con->prepare($sql);//preparar la sentencia sql
				$params = array ("cedula"=>$cedula);
				$result->execute($params);//ejecuta la sentencia sql
				$data = $result->fetchAll();//Acomoda en un arreglo el resultado de la búsqueda

				if($data){//si el arreglo no esta vacio luego elimino
					$sqld = "UPDATE solicitante SET estatus='a' WHERE cedula=:cedula";//elimino el registro
					$resultd = $con->prepare($sqld);//preparar la sentencia sql
					$paramsd = array ("cedula"=>$cedula);
					$resultd->execute($paramsd);//ejecuta la sentencia sql
					$delete = $result->execute();//ejecuta la sentencia sql
					return $delete;//retorno 1, para demostrar que fue elimnado el registro encontrado
				}else{
					return $data;//retorno vacio, para demostrar que no existe el registro
				}
			}






	} // CIERRE CLASE SOLICITANTE


	

?>