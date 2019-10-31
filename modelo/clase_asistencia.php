<?php 
	class Asistencia {
		//variables
		private $cedula, $fecha;

		public function __construct(){

		}
		// Nombre
			//setters
				public function setCedula($cedula){
					$this->cedula = $cedula;
				}
			//getters
				public function getCedula(){
					return $this->cedula;
				}

		// Nombre
			//setters
				public function setFecha($fecha){
					$this->fecha = $fecha;
				}
			//getters
				public function getFecha(){
					return $this->fecha;
				}

		// Nombre
			//setters
				public function setHora($hora){
					$this->hora = $hora;
				}
			//getters
				public function getHora(){
					return $this->hora;
				}



		/* CATALAGO */
			public function Listar(){
				require_once("conexionpdo.php");//se llama al archivo para la conexion

				$sql = "SELECT a.id AS idasis,
								a.fecha AS fechaasis,
								a.hora AS hora,
								a.accion AS accion,
								s.cedula AS cedulasol, 
								s.nombre AS nombresol,
								s.apellido AS apellidosol
						FROM asistencia AS a INNER JOIN solicitante AS s 
						ON a.id_sol=s.id ORDER BY a.id ASC";//consulto si existe el registro
				$result = $con->prepare($sql);//preparar la sentencia sql
				$result->execute();
				return $result->fetchAll(PDO::FETCH_OBJ);
			}


		/* REGISTRAR */
			public function RegistrarAsistencia($cedula, $fecha, $hora){
				require_once("conexionpdo.php"); //se llama al archivo para la conexion


				$sql = "SELECT * FROM solicitante WHERE cedula='$this->cedula'";//sentencia sql para consultar
				$result = $con->prepare($sql);//preparar la sentencia sql
		    	$result->execute(); //ejecuta la sentencia sql
				$data = $result->fetchAll();
				$hoy=date('a');//Acomoda en un arreglo el resultado de la búsqueda
				foreach($data as $u){
					//se optiene el valor de cada campo de la tabla
					@$idsol=$u['id'];
					@$estatus=$u['estatus'];
					@$cedu=$u['cedula'];
					@$id_cargo=$u['id_cargo'];

					
				}
				if(empty($data)){ //Si el método, retorna un arreglo vacío;
					echo "<script>alert('Obrero no existente, si usted es un Obrero de la institución contacte al encargado del sistema para ser registrado.')</script>";//Mensaje de Registro no válida
					echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/regasis.php'>"; // ir a la pantalla de inicio
				}else{ //Si el areglo NO retornó vacío	
					if(@$id_cargo=="1"){

						if(@$estatus=="i"){
						echo "<script>alert('Obrero inactivo, para ser activado nuevamente contacte al encargado del sistema.')</script>";//Mensaje de Registro válida
						echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/regasis.php'>"; // ir a la pantalla de inicio
						}else{
						
							if($hoy=='Sun' OR $hoy=='Sat'){

								echo "<script>alert('Hoy es un día no laborable, Asistencia no registrada.')</script>";//Mensaje de Registro válida
								echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/regasis.php'>";

							}else{

								$sql = "SELECT * FROM dia_feriado WHERE estatus='a' AND (fecha_inicial<='$this->fecha' AND fecha_final >= '$this->fecha')";//sentencia sql para consultar
								$result = $con->prepare($sql);//preparar la sentencia sql
				    			$result->execute(); //ejecuta la sentencia sql
								$data = $result->fetchAll();

								if(empty($data)){

									$sql = "SELECT * FROM permiso WHERE id=$idsol AND estatus='a' AND (fecha_inicial<='$this->fecha' AND fecha_final >= '$this->fecha')";//sentencia sql para consultar
									$result = $con->prepare($sql);//preparar la sentencia sql
					    			$result->execute(); //ejecuta la sentencia sql
									$data = $result->fetchAll();

									if(empty($data)){


										$sql = "SELECT * FROM asistencia WHERE id_sol=$idsol AND fecha='$this->fecha'";//sentencia sql para consultar
										$result = $con->prepare($sql);//preparar la sentencia sql
						    			$result->execute(); //ejecuta la sentencia sql
										$data = $result->fetchAll();
										foreach($data as $a){
											//se optiene el valor de cada campo de la tabla
											@$accion=$a['accion'];
										}
											if(empty($data)){
												echo "<script>alert('Hora de entrada registrada con exito.')</script>";//Mensaje de Registro válida
												echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../index.html'>"; // ir a la pantalla de inicio
												$sql = "INSERT INTO asistencia (fecha, hora, accion, id_sol)VALUES (:fecha, :hora, :accion, :idsol)"; //sentencia sql para registrar 
												$insert = $con->prepare($sql); //preparar la sentencia sql
													//Excecute
												$insert->execute(array('fecha'=>$fecha, 'hora'=>$hora, 'accion'=>'entrada', 'idsol'=>$idsol));
												//return $insert;

											}else{
												if($accion == 'entrada'){
													 // ir a la pantalla de inicio

													$sql = "INSERT INTO asistencia (fecha, hora, accion, id_sol)VALUES (:fecha, :hora, :accion, :idsol)"; //sentencia sql para registrar 
													$insert = $con->prepare($sql); //preparar la sentencia sql
													//Excecute
													$insert->execute(array('fecha'=>$fecha, 'hora'=>$hora, 'accion'=>'salida', 'idsol'=>$idsol));
													echo "<script>alert('Hora de salida registrada con exito.')</script>";//Mensaje de Registro válida
													echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../index.html'>";
													//return $insert;

												}else{
													echo "<script>alert('Ya fue registrada la asistencia el dia de hoy.')</script>";//Mensaje de Registro válida
													echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/regasis.php'>"; // ir a la pantalla de inicio
												}
											}

									}else{

										echo "<script>alert('El Obrero está de permiso.')</script>";//Mensaje de Registro válida
										echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/regasis.php'>";
									}
									
								}else{
									echo "<script>alert('Hoy es un día feriado, Asistencia no registrada.')</script>";//Mensaje de Registro válida
									echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/regasis.php'>";
								}
							}						
						
						}
					}else{

						echo "<script>alert('Obrero no existente, si usted es un Obrero de la institución contacte al encargado del sistema para ser registrado.')</script>";//Mensaje de Registro válida
						echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/regasis.php'>"; // ir a la pantalla de inicio
						}	
					}
				}
			

		/* REGISTRAR 2*/
			public function RegistrarAsis($cedula, $fecha, $hora){
				require_once("conexionpdo.php"); //se llama al archivo para la conexion

				$sql = "SELECT * FROM solicitante WHERE cedula='$this->cedula'";//sentencia sql para consultar
				$result = $con->prepare($sql);//preparar la sentencia sql
		    	$result->execute(); //ejecuta la sentencia sql
				$data = $result->fetchAll();
				$hoy=date('a');//Acomoda en un arreglo el resultado de la búsqueda
				foreach($data as $u){
					//se optiene el valor de cada campo de la tabla
					@$idsol=$u['id'];
					@$estatus=$u['estatus'];
					@$cedu=$u['cedula'];
					@$id_cargo=$u['id_cargo'];

					
				}
				if(empty($data)){ //Si el método, retorna un arreglo vacío;
					echo "<script>alert('Obrero no existente')</script>";//Mensaje de Registro no válida
					echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/asistencia/sql/'>"; // ir a la pantalla de inicio
				}else{ //Si el areglo NO retornó vacío	
					if(@$id_cargo=="1"){

						if(@$estatus=="i"){
						echo "<script>alert('Obrero inactivo.')</script>";//Mensaje de Registro válida
						echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/asistencia/sql/'>"; // ir a la pantalla de inicio
						}else{
						
							if($hoy=='Sun' OR $hoy=='Sat'){

								echo "<script>alert('Hoy es un día no laborable, Asistencia no registrada.')</script>";//Mensaje de Registro válida
								echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/asistencia/sql/'>";

							}else{

								$sql = "SELECT * FROM dia_feriado WHERE estatus='a' AND (fecha_inicial<='$this->fecha' AND fecha_final >= '$this->fecha')";//sentencia sql para consultar
								$result = $con->prepare($sql);//preparar la sentencia sql
				    			$result->execute(); //ejecuta la sentencia sql
								$data = $result->fetchAll();

								if(empty($data)){

									$sql = "SELECT * FROM permiso WHERE id=$idsol AND estatus='a' AND (fecha_inicial<='$this->fecha' AND fecha_final >= '$this->fecha')";//sentencia sql para consultar
									$result = $con->prepare($sql);//preparar la sentencia sql
					    			$result->execute(); //ejecuta la sentencia sql
									$data = $result->fetchAll();

									if(empty($data)){


										$sql = "SELECT * FROM asistencia WHERE id_sol=$idsol AND fecha='$this->fecha'";//sentencia sql para consultar
										$result = $con->prepare($sql);//preparar la sentencia sql
						    			$result->execute(); //ejecuta la sentencia sql
										$data = $result->fetchAll();
										foreach($data as $a){
											//se optiene el valor de cada campo de la tabla
											@$accion=$a['accion'];
										}
											if(empty($data)){
												echo "<script>alert('Hora de entrada registrada con exito.')</script>";//Mensaje de Registro válida
												echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=ctr_asistencia.php?list=1'>"; // ir a la pantalla de inicio
												$sql = "INSERT INTO asistencia (fecha, hora, accion, id_sol)VALUES (:fecha, :hora, :accion, :idsol)"; //sentencia sql para registrar 
												$insert = $con->prepare($sql); //preparar la sentencia sql
													//Excecute
												$insert->execute(array('fecha'=>$fecha, 'hora'=>$hora, 'accion'=>'entrada', 'idsol'=>$idsol));
												return $insert;

											}else{
												if($accion == 'entrada'){
													echo "<script>alert('Hora de salida registrada con exito.')</script>";//Mensaje de Registro válida
													echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=ctr_asistencia.php?list=1'>"; // ir a la pantalla de inicio
													$sql = "INSERT INTO asistencia (fecha, hora, accion, id_sol)VALUES (:fecha, :hora, :accion, :idsol)"; //sentencia sql para registrar 
													$insert = $con->prepare($sql); //preparar la sentencia sql
													//Excecute
													$insert->execute(array('fecha'=>$fecha, 'hora'=>$hora, 'accion'=>'salida', 'idsol'=>$idsol));
													return $insert;

												}else{
													echo "<script>alert('Ya fue registrada la asistencia el dia de hoy.')</script>";//Mensaje de Registro válida
													echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/asistencia/sql/'>"; // ir a la pantalla de inicio
												}
											}

									}else{

										echo "<script>alert('El Obrero está de permiso.')</script>";//Mensaje de Registro válida
										echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/asistencia/sql/'>";
									}
									
								}else{
									echo "<script>alert('Hoy es un día feriado, Asistencia no registrada.')</script>";//Mensaje de Registro válida
									echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/asistencia/sql/'>";
								}
							}

						
						
						
						}
					}else{

						echo "<script>alert('Obrero no existente, si usted es un Obrero de la institución contacte al encargado del sistema para ser registradoasdasdas.')</script>";//Mensaje de Registro válida
						echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/regasis.php'>"; // ir a la pantalla de inicio
						}	
					}
				}
	

	}//cierre de la clase

?>