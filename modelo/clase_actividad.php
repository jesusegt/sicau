<?php


	class Actividad {
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


		/* CATALAGO */
			public function Listar(){
				require_once("conexionpdo.php");//se llama al archivo para la conexion
				//FROM sol_per AS sp INNER JOIN solicitante AS s ON sp.id_sol=s.id INNER JOIN permiso AS p ON sp.id_per=p.id WHERE

				$sql = "SELECT a.id AS idact,
								a.fecha AS fechaact,
								s.cedula AS cedulasol, 
								s.nombre AS nombresol,
								s.apellido AS apellidosol
						FROM sol_act AS sa INNER JOIN solicitante AS s 
						ON sa.id_sol=s.id INNER JOIN actividad AS a 
						ON sa.id_act=a.id ORDER BY a.id ASC";//consulto si existe el registro
				$result = $con->prepare($sql);//preparar la sentencia sql
				$result->execute();
				return $result->fetchAll(PDO::FETCH_OBJ);
			}


		/* REGISTRAR */
			public function RegistrarActividad($cedula, $fecha){
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
					echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/actividad/sql/'>"; // ir a la pantalla de inicio
				}else{ //Si el areglo NO retornó vacío	
					if(@$id_cargo=="1"){

						if(@$estatus=="i"){
						echo "<script>alert('Obrero inactivo, para ser activado nuevamente contacte al encargado del sistema.')</script>";//Mensaje de Registro válida
						echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/actividad/sql/'>"; // ir a la pantalla de inicio
						}else{
						
							if($hoy=='Sun' OR $hoy=='Sat'){

								echo "<script>alert('Hoy es un día no laborable, actividad no registrada.')</script>";//Mensaje de Registro válida
								echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/actividad/sql/'>";

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


										$sql = "SELECT * FROM sol_act AS sa INNER JOIN solicitante AS s 
														ON sa.id_sol=s.id INNER JOIN actividad AS a 
														ON sa.id_act=a.id WHERE sa.id_sol=$idsol AND a.fecha='$this->fecha'";//sentencia sql para consultar
										$result = $con->prepare($sql);//preparar la sentencia sql
						    			$result->execute(); //ejecuta la sentencia sql
										$data = $result->fetchAll();
											if(empty($data)){
												$sql = "SELECT MAX(id) FROM actividad";
												$result = $con->prepare($sql);//preparar la sentencia sql
												$result->execute(); //ejecuta la sentencia sql
												$data = $result->fetchAll();
												foreach($data as $u){//se optiene el valor de cada campo de la tabla
												@$idactv=$u['MAX(id)'];}
												
												$id_actividad=$idactv+1;
												
												if(empty($data)) {
													echo"<script>alert('Error')</script>";
												}else{

													/*echo "<script>alert('Actividad registrada con exito.')</script>";//Mensaje de Registro válida
													echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=ctr_actividad.php?list=1'>"; // ir a la pantalla de inicio*/

													$idu=@$_SESSION['idu'];

													$sql = "INSERT INTO actividad (fecha, id_usu)VALUES (:fecha, :idu)"; //sentencia sql para registrar 
													$insert = $con->prepare($sql); //preparar la sentencia sql
														//Excecute
													$insert->execute(array('fecha'=>$fecha, 'idu'=>$idu));

														if($id_actividad){
															echo "<script>alert('Actividad registrada con exito.')</script>";//Mensaje de Registro válida
															echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=ctr_actividad.php?list=1'>"; // ir a la pantalla de inicio
															$sql = "INSERT INTO sol_act (id_sol, id_act)VALUES (:idsol, :idact)"; //sentencia sql para registrar 
															$insert = $con->prepare($sql); //preparar la sentencia sql
																//Excecute
															$insert->execute(array('idsol'=>$idsol, 'idact'=>$id_actividad));

														}else{
															echo"<script>alert('Error2')</script>";
														}
												}


											}else{
													echo "<script>alert('Ya fue registrada la actividad el día de hoy.')</script>";//Mensaje de Registro válida
													echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/actividad/sql/'>"; // ir a la pantalla de inicio
												
											}

									}else{

										echo "<script>alert('El Obrero está de permiso.')</script>";//Mensaje de Registro válida
										echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/actividad/sql/'>";
									}
									
								}else{
									echo "<script>alert('Hoy es un día feriado, actividad no registrada.')</script>";//Mensaje de Registro válida
									echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/actividad/sql/'>";
								}
							}

						
						
						
						}
					}else{

						echo "<script>alert('Obrero no existente, si usted es un Obrero de la institución contacte al encargado del sistema para ser registrado.')</script>";//Mensaje de Registro válida
						echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/actividad/sql/'>"; // ir a la pantalla de inicio
						}	
					}
				}
			}

?>