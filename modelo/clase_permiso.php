<?php 
	class Permiso
	{
		//variables
		private $cedula, $motivo, $fecha_inicial, $fecha_final;

		public function __construct(){

		}
		// NOMBRE
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
				public function setMotivo($motivo){
					$this->motivo = $motivo;
				}
			//getters
				public function getMotivo(){
					return $this->motivo;
				}

		// NOMBRE
			//setters
				public function setFecha_inicial($fecha_inicial){
					$this->fecha_inicial = $fecha_inicial;
				}
			//getters
				public function getFecha_inicial(){
					return $this->fecha_inicial;
				}

		// NOMBRE
			//setters
				public function setFecha_final($fecha_final){
					$this->fecha_final = $fecha_final;
				}
			//getters
				public function getFecha_final(){
					return $this->fecha_final;
				}


		/* CATALAGO */
			public function Listar(){
				require_once("conexionpdo.php");//se llama al archivo para la conexion

				$sql = "SELECT p.id AS idperm,
								p.fecha_inicial AS fechaini,
								p.fecha_final AS fechafin,
								p.estatus AS estatusperm,
								s.cedula AS cedulasol, 
								s.nombre AS nombresol,
								s.apellido AS apellidosol
						FROM sol_per AS sp INNER JOIN solicitante AS s 
						ON sp.id_sol=s.id INNER JOIN permiso AS p ON sp.id_per=p.id WHERE p.estatus='a'";//consulto si existe el registro
				$result = $con->prepare($sql);//preparar la sentencia sql
				$result->execute();
				return $result->fetchAll(PDO::FETCH_OBJ);
			}

		/* CATALAGO INACTIVOS */
			public function ListarInactivo(){
				require_once("conexionpdo.php");//se llama al archivo para la conexion

				$sql = "SELECT p.id AS idperm,
								p.fecha_inicial AS fechaini,
								p.fecha_final AS fechafin,
								p.estatus AS estatusperm,
								s.cedula AS cedulasol, 
								s.nombre AS nombresol,
								s.apellido AS apellidosol
						FROM sol_per AS sp INNER JOIN solicitante AS s 
						ON sp.id_sol=s.id INNER JOIN permiso AS p ON sp.id_per=p.id WHERE p.estatus='i'";//consulto si existe el registro
				$result = $con->prepare($sql);//preparar la sentencia sql
				$result->execute();
				return $result->fetchAll(PDO::FETCH_OBJ);
		}


		/* REGISTRAR */
			public function RegistrarPermiso($cedula, $motivo, $fecha_inicial, $fecha_final){
				require_once("conexionpdo.php"); //se llama al archivo para la conexion

				$sql = "SELECT * FROM solicitante WHERE cedula='$this->cedula'";//sentencia sql para consultar
				$result = $con->prepare($sql);//preparar la sentencia sql
		    	$result->execute(); //ejecuta la sentencia sql
				$data = $result->fetchAll();//Acomoda en un arreglo el resultado de la búsqueda
				foreach($data as $u){
					//se optiene el valor de cada campo de la tabla
					@$idsol=$u['id'];
					@$estatus=$u['estatus'];
					@$id_cargo=$u['id_cargo'];
					
				}
				if(empty($data)){ //Si el método, retorna un arreglo vacío;
					echo "<script>alert('La Cedula ingresada no pertenece a ningun Obrero.')</script>";//Mensaje de Registro no válida
					echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/permiso/sql/?sql=a'>"; // ir a la pantalla de inicio
				}else{ //Si el areglo NO retornó vacío	
					if(@$id_cargo=="1"){

						if(@$estatus=="i"){

							echo "<script>alert('Obrero inactivo, para ser activado nuevamente contacte al Administrador del sistema.')</script>";//Mensaje de Registro válida
							echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/permiso/sql/?sql=a'>"; // ir a la pantalla de inicio

						}else{
							// FROM sol_per AS sp INNER JOIN solicitante AS s ON sp.id_sol=s.id INNER JOIN permiso AS p ON sp.id_per=p.id WHERE
							$sql = "SELECT * FROM sol_per AS sp INNER JOIN permiso AS p ON sp.id_per=p.id WHERE sp.id_sol=$idsol AND (p.fecha_inicial<='$this->fecha_inicial' AND p.fecha_final >= '$this->fecha_final')";//sentencia sql para consultar
							$result = $con->prepare($sql);//preparar la sentencia sql
						    $result->execute(); //ejecuta la sentencia sql
							$data = $result->fetchAll();

							if(empty($data)){
								$sql = "SELECT MAX(id) FROM permiso";
								$result = $con->prepare($sql);//preparar la sentencia sql
								$result->execute(); //ejecuta la sentencia sql
								$data = $result->fetchAll();
								foreach($data as $u){//se optiene el valor de cada campo de la tabla
								@$idperm=$u['MAX(id)'];}
												
								$id_permiso=$idperm+1;
								if (empty($data)) {
									echo "<script>alert('Error.')</script>";
								}else{
									/*echo "<script>alert('Permiso registrado con exito.')</script>";//Mensaje de Registro válida
									echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../controlador/ctr_permiso.php?list=1'>"; // ir a la pantalla de inicio*/
									$sql = "INSERT INTO permiso (motivo, fecha_inicial, fecha_final, estatus)VALUES (:motivo, :fecha_inicial, :fecha_final, :estatus)"; //sentencia sql para registrar 
									$insert = $con->prepare($sql); //preparar la sentencia sql
										//Excecute
									$insert->execute(array('motivo'=>$motivo, 'fecha_inicial'=>$fecha_inicial, 'fecha_final'=>$fecha_final, 'estatus'=>'a'));
									//return $insert;
										if($id_permiso){
											echo "<script>alert('Permiso registrado con exito.')</script>";//Mensaje de Registro válida
											echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../controlador/ctr_permiso.php?list=1'>"; // ir a la pantalla de inicio
											$sql = "INSERT INTO sol_per (id_sol, id_per)VALUES (:id, :id_per)"; //sentencia sql para registrar 
											$insert = $con->prepare($sql); //preparar la sentencia sql
												//Excecute
											$insert->execute(array('id'=>$idsol, 'id_per'=>$id_permiso));
											//return $insert;
										}else{
											echo "<script>alert('Error2.')</script>";
										}
								}

							}else{

								echo "<script>alert('El Obrero ingresado ya tiene un permiso registrado en el periodo indicado.')</script>";//Mensaje de Registro válida
								echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/permiso/sql/?sql=a'>";

							}
						}
					}else{

						echo "<script>alert('La Cedula ingresada no pertenece a ningun Obrero.')</script>";//Mensaje de Registro válida
						echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/permiso/sql/?sql=a'>"; // ir a la pantalla de inicio
					}	
				}
			}

		/* CONSULTAR */
			public function ConsultarPermiso($id){
				require_once("conexionpdo.php");//se llama al archivo para la conexion
					
				$sql = "SELECT p.id AS idperm,
								p.motivo AS motivo,
								p.fecha_inicial AS fechaini,
								p.fecha_final AS fechafin,
								s.cedula AS cedulasol, 
								s.nombre AS nombresol,
								s.apellido AS apellidosol
						FROM sol_per AS sp INNER JOIN solicitante AS s 
						ON sp.id_sol=s.id INNER JOIN permiso AS p 
						ON sp.id_per=p.id WHERE p.id=:id";//sentencia sql para consultar
				$result = $con->prepare($sql);//preparar la sentencia sql
			    	$params = array('id'=>$id); 
			    	$result->execute($params); //ejecuta la sentencia sql
				$data = $result->fetchAll();//Acomoda en un arreglo el resultado de la búsqueda
				return $data;//retornar el resultado de la sentencia sql
			}

		/* MOSTRAR */
			public function MostrarPermiso($id){
				require_once("conexionpdo.php");//se llama al archivo para la conexion
				// FROM sol_per AS sp INNER JOIN solicitante AS s ON sp.id_sol=s.id INNER JOIN permiso AS p ON sp.id_per=p.id WHERE
				$sql = "SELECT p.id AS idperm,
								p.motivo AS motivo,
								p.fecha_inicial AS fechaini,
								p.fecha_final AS fechafin,
								s.cedula AS cedulasol
						FROM sol_per AS sp INNER JOIN solicitante AS s 
						ON sp.id_sol=s.id INNER JOIN permiso AS p 
						ON sp.id_per=p.id  WHERE p.id=:id";//sentencia sql para consultar
				$result = $con->prepare($sql);//preparar la sentencia sql
				$params = array ('id'=>$id);
				$result->execute($params);//ejecuta la sentencia sql
				$data = $result->fetchAll();//Acomoda en un arreglo el resultado de la búsqueda
				return $data;//retornar el resultado de la sentencia sql
			}

		/* ACTUALIZAR */
			public function ActualizarPermiso($id, $cedula, $motivo, $fecha_inicial, $fecha_final){
				require_once("conexionpdo.php");//se llama al archivo para la conexion
				
				$sql = "SELECT * FROM solicitante WHERE cedula='$this->cedula'";//sentencia sql para consultar
				$result = $con->prepare($sql);//preparar la sentencia sql
		    	$result->execute(); //ejecuta la sentencia sql
				$data = $result->fetchAll();//Acomoda en un arreglo el resultado de la búsqueda
				foreach($data as $u){
					//se optiene el valor de cada campo de la tabla
					@$id_sol=$u['id'];
					@$estatus=$u['estatus'];
					@$id_cargo=$u['id_cargo'];
					
				}
				if(empty($data)){ //Si el método, retorna un arreglo vacío;
					echo "<script>alert('La Cedula ingresada no pertenece a ningun Obrero.')</script>";//Mensaje de Registro no válida
					echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/permiso/sql/?sql=a'>"; // ir a la pantalla de inicio
				}else{ //Si el areglo NO retornó vacío	
					if(@$id_cargo=="1"){

						if(@$estatus=="i"){
							echo "<script>alert('Obrero inactivo, para ser activado nuevamente contacte al Administrador del sistema.')</script>";//Mensaje de Registro válida
							echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/permiso/sql/?sql=a'>"; // ir a la pantalla de inicio
						}else{
							echo "<script>alert('Permiso actualizado con exito.')</script>";//Mensaje de Registro válida
							echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../controlador/ctr_permiso.php?list=1'>"; // ir a la pantalla de inicio
							$sql = "UPDATE permiso SET motivo='$motivo', fecha_inicial='$fecha_inicial', fecha_final='$fecha_final' WHERE id=:id"; //sentencia sql para registrar 
							$result = $con->prepare($sql);//preparar la sentencia sql
							$params = array ('id'=>$id);
							$cambio = $result->execute($params);//ejecuta la sentencia sql
							return $cambio;
						}

					}else{

						echo "<script>alert('La Cedula ingresada no pertenece a ningun Obrero.')</script>";//Mensaje de Registro válida
						echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/permiso/sql/?sql=a'>"; // ir a la pantalla de inicio
					}	
				}
			}

		/* ELIMINAR */
			public function EliminarPermiso($id){
				require_once("conexionpdo.php");//se llama al archivo para la conexion
				 
				$sql = "SELECT * FROM permiso WHERE id=:id";//consulto si existe el registro
				$result = $con->prepare($sql);//preparar la sentencia sql
				$params = array ("id"=>$id);
				$result->execute($params);//ejecuta la sentencia sql
				$data = $result->fetchAll();//Acomoda en un arreglo el resultado de la búsqueda

				if($data){//si el arreglo no esta vacio luego elimino
					$sqld = "UPDATE permiso SET estatus='i' WHERE id=:id";//elimino el registro
					$resultd = $con->prepare($sqld);//preparar la sentencia sql
					$paramsd = array ("id"=>$id);
					$resultd->execute($paramsd);//ejecuta la sentencia sql
					$delete = $result->execute();//ejecuta la sentencia sql
					return $delete;//retorno 1, para demostrar que fue elimnado el registro encontrado
				}else{
					return $data;//retorno vacio, para demostrar que no existe el registro
				}
			}

		/* HABILITAR */
			public function HabilitarPermiso($id){
				require_once("conexionpdo.php");//se llama al archivo para la conexion
				 
				$sql = "SELECT * FROM permiso WHERE id=:id";//consulto si existe el registro
				$result = $con->prepare($sql);//preparar la sentencia sql
				$params = array ("id"=>$id);
				$result->execute($params);//ejecuta la sentencia sql
				$data = $result->fetchAll();//Acomoda en un arreglo el resultado de la búsqueda

				if($data){//si el arreglo no esta vacio luego elimino
					$sqld = "UPDATE permiso SET estatus='a' WHERE id=:id";//elimino el registro
					$resultd = $con->prepare($sqld);//preparar la sentencia sql
					$paramsd = array ("id"=>$id);
					$resultd->execute($paramsd);//ejecuta la sentencia sql
					$delete = $result->execute();//ejecuta la sentencia sql
					return $delete;//retorno 1, para demostrar que fue elimnado el registro encontrado
				}else{
					return $data;//retorno vacio, para demostrar que no existe el registro
				}
			}

		/* LISTAR REPORTE */
			public function ListarReporte(){
				require_once("conexionpdo.php");//se llama al archivo para la conexion

				$sql = "SELECT p.id AS idperm,
								p.fecha_inicial AS fechaini,
								p.fecha_final AS fechafin,
								p.motivo AS motivo,
								p.estatus AS estatusperm,
								s.cedula AS cedulasol, 
								s.nombre AS nombresol,
								s.apellido AS apellidosol
						FROM sol_per AS sp INNER JOIN solicitante AS s 
						ON sp.id_sol=s.id INNER JOIN permiso AS p ON sp.id_per=p.id WHERE p.estatus='a'";//consulto si existe el registro
				$result = $con->prepare($sql);//preparar la sentencia sql
				$result->execute();
				return $result->fetchAll(PDO::FETCH_OBJ);
			}



	} // CIERRE CLASE permiso


	

?>