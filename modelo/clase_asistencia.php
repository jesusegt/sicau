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

		// Nombre
			//setters
				public function setTipo_rep($tipo_rep){
					$this->tipo_rep = $tipo_rep;
				}
			//getters
				public function getTipo_rep(){
					return $this->tipo_rep;
				}

		// Nombre
			//setters
				public function setFechaini($fechaini){
					$this->fechaini = $fechaini;
				}
			//getters
				public function getFechaini(){
					return $this->fechaini;
				}

		// Nombre
			//setters
				public function setFechafin($fechafin){
					$this->fechafin = $fechafin;
				}
			//getters
				public function getFechafin(){
					return $this->fechafin;
				}

		// Nombre
			//setters
				public function setMes($mes){
					$this->mes = $mes;
				}
			//getters
				public function getMes(){
					return $this->mes;
				}



		/* CATALAGO */
			public function Listar(){
				require_once("conexionpdo.php");//se llama al archivo para la conexion

				$sql = "SELECT 
							T3.cedulasol, T3.nombresol, T3.apellidosol, T1.fechaasis, T1.horaen, T2.horasa
						FROM
						( SELECT id AS idasis,
								 fecha AS fechaasis,
								 hora AS horaen,
								 accion AS accion,
						 		 id_sol AS idsol
						  FROM asistencia WHERE accion='entrada'
						) T1
						INNER JOIN
						( SELECT id AS idasis,
								 fecha AS fechaasis,
								 hora AS horasa,
								 accion AS accion,
						 		 id_sol AS idsol
						  FROM asistencia WHERE accion='salida'
						) T2 ON T1.idsol = T2.idsol
						INNER JOIN
						( SELECT id AS idsol, 
								 cedula AS cedulasol, 
								 nombre AS nombresol, 
								 apellido AS apellidosol
						  FROM solicitante
						) T3 ON T1.idsol = T3.idsol
						WHERE T1.fechaasis=T2.fechaasis ORDER BY T1.idasis ASC;";//consulto si existe el registro
				$result = $con->prepare($sql);//preparar la sentencia sql
				$result->execute();
				return $result->fetchAll(PDO::FETCH_OBJ);
			}

		/* CATALAGO INCOMPLETAS */
			public function ListarIncompleta(){
				require_once("conexionpdo.php");//se llama al archivo para la conexion

				$sql = "SELECT a.id AS idasis,
								a.fecha AS fechaasis,
								a.hora AS hora,
								a.accion AS accion,
								s.cedula AS cedulasol, 
								s.nombre AS nombresol,
								s.apellido AS apellidosol
						FROM asistencia AS a INNER JOIN solicitante AS s 
						ON a.id_sol=s.id WHERE accion='entrada' AND a.estatus='i' ORDER BY a.id ASC";//consulto si existe el registro
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
				$hoy=date('D');//Acomoda en un arreglo el resultado de la búsqueda
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

									$sql = "SELECT * FROM sol_per AS sp INNER JOIN permiso AS p ON sp.id_per=p.id WHERE sp.id_sol=$idsol AND (p.fecha_inicial<='$this->fecha' AND p.fecha_final >= '$this->fecha') AND estatus='a'";//sentencia sql para consultar
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
												$sql = "INSERT INTO asistencia (fecha, hora, accion, estatus, id_sol)VALUES (:fecha, :hora, :accion, :estatus, :idsol)"; //sentencia sql para registrar 
												$insert = $con->prepare($sql); //preparar la sentencia sql
													//Excecute
												$insert->execute(array('fecha'=>$fecha, 'hora'=>$hora, 'accion'=>'entrada', 'estatus'=>'i', 'idsol'=>$idsol));
												//return $insert;

											}else{
												if($accion == 'entrada'){
													 // ir a la pantalla de inicio

													$sql = "INSERT INTO asistencia (fecha, hora, accion, estatus, id_sol)VALUES (:fecha, :hora, :accion, :estatus, :idsol)"; //sentencia sql para registrar 
													$insert = $con->prepare($sql); //preparar la sentencia sql
													//Excecute
													$insert->execute(array('fecha'=>$fecha, 'hora'=>$hora, 'accion'=>'salida', 'estatus'=>'a', 'idsol'=>$idsol));
													//return $insert;
													$estatus='a';

													if ($estatus) {
														$sql = "UPDATE asistencia SET estatus='$estatus' WHERE id_sol=:idsol AND fecha=:fecha"; //sentencia sql para registrar 
														$result = $con->prepare($sql);//preparar la sentencia sql
														$params = array ('idsol'=>$idsol, 'fecha'=>$fecha);
														$cambio = $result->execute($params);//ejecuta la sentencia sql
														echo "<script>alert('Hora de salida registrada con exito.')</script>";//Mensaje de Registro válida
														echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../index.html'>";
													}
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
				$hoy=date('D');//Acomoda en un arreglo el resultado de la búsqueda
				foreach($data as $u){
					//se optiene el valor de cada campo de la tabla
					@$idsol=$u['id'];
					@$estatus=$u['estatus'];
					@$cedu=$u['cedula'];
					@$id_cargo=$u['id_cargo'];

					
				}
				if(empty($data)){ //Si el método, retorna un arreglo vacío;
					echo "<script>alert('Obrero no existente')</script>";//Mensaje de Registro no válida
					echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../controlador/ctr_asistencia.php?sql=a'>"; // ir a la pantalla de inicio
				}else{ //Si el areglo NO retornó vacío	
					if(@$id_cargo=="1"){

						if(@$estatus=="i"){
						echo "<script>alert('Obrero inactivo.')</script>";//Mensaje de Registro válida
						echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../controlador/ctr_asistencia.php?sql=a'>"; // ir a la pantalla de inicio
						}else{
						
							if($hoy=='Sun' OR $hoy=='Sat'){

								echo "<script>alert('Hoy es un día no laborable, Asistencia no registrada.')</script>";//Mensaje de Registro válida
								echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../controlador/ctr_asistencia.php?sql=a'>";

							}else{

								$sql = "SELECT * FROM dia_feriado WHERE estatus='a' AND (fecha_inicial<='$this->fecha' AND fecha_final >= '$this->fecha')";//sentencia sql para consultar
								$result = $con->prepare($sql);//preparar la sentencia sql
				    			$result->execute(); //ejecuta la sentencia sql
								$data = $result->fetchAll();

								if(empty($data)){

									$sql = "SELECT * FROM sol_per AS sp INNER JOIN permiso AS p ON sp.id_per=p.id WHERE sp.id_sol=$idsol AND (p.fecha_inicial<='$this->fecha' AND p.fecha_final >= '$this->fecha') AND estatus='a'";//sentencia sql para consultar
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
												$sql = "INSERT INTO asistencia (fecha, hora, accion, estatus, id_sol)VALUES (:fecha, :hora, :accion, :estatus, :idsol)"; //sentencia sql para registrar 
												$insert = $con->prepare($sql); //preparar la sentencia sql
													//Excecute
												$insert->execute(array('fecha'=>$fecha, 'hora'=>$hora, 'accion'=>'entrada', 'estatus'=>'i', 'idsol'=>$idsol));
												//return $insert;

											}else{
												if($accion == 'entrada'){

													$sql = "INSERT INTO asistencia (fecha, hora, accion, estatus, id_sol)VALUES (:fecha, :hora, :accion, :estatus, :idsol)"; //sentencia sql para registrar 
													$insert = $con->prepare($sql); //preparar la sentencia sql
													//Excecute
													$insert->execute(array('fecha'=>$fecha, 'hora'=>$hora, 'accion'=>'salida', 'estatus'=>'a', 'idsol'=>$idsol));
													//return $insert;
													$estatus='a';

													if ($estatus) {
														$sql = "UPDATE asistencia SET estatus='$estatus' WHERE id_sol=:idsol AND fecha=:fecha"; //sentencia sql para registrar 
														$result = $con->prepare($sql);//preparar la sentencia sql
														$params = array ('idsol'=>$idsol, 'fecha'=>$fecha);
														$cambio = $result->execute($params);//ejecuta la sentencia sql
														echo "<script>alert('Hora de salida registrada con exito.')</script>";//Mensaje de Registro válida
														echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../controlador/ctr_asistencia.php?list=1'>"; // ir a la pantalla de inicio
													}

												}else{
													echo "<script>alert('Ya fue registrada la asistencia el dia de hoy.')</script>";//Mensaje de Registro válida
													echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../controlador/ctr_asistencia.php?sql=a'>"; // ir a la pantalla de inicio
												}
											}

									}else{

										echo "<script>alert('El Obrero está de permiso.')</script>";//Mensaje de Registro válida
										echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../controlador/ctr_asistencia.php?sql=a'>";
									}
									
								}else{
									echo "<script>alert('Hoy es un día feriado, Asistencia no registrada.')</script>";//Mensaje de Registro válida
									echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../controlador/ctr_asistencia.php?sql=a'>";
								}
							}

						
						
						
						}
					}else{

						echo "<script>alert('Obrero no existente, si usted es un Obrero de la institución contacte al encargado del sistema para ser registradoasdasdas.')</script>";//Mensaje de Registro válida
						echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/regasis.php'>"; // ir a la pantalla de inicio
						}	
					}
				}
	/* REPORTES COMPLETAS*/
		/* LISTAR TODAS */
			public function ListarReporteC(){
				require_once("conexionpdo.php");//se llama al archivo para la conexion

				$sql = "SELECT 
							T3.cedulasol, T3.nombresol, T3.apellidosol, T1.fechaasis, T1.horaen, T2.horasa
						FROM
						( SELECT id AS idasis,
								 fecha AS fechaasis,
								 hora AS horaen,
								 accion AS accion,
						 		 id_sol AS idsol
						  FROM asistencia WHERE accion='entrada'
						) T1
						INNER JOIN
						( SELECT id AS idasis,
								 fecha AS fechaasis,
								 hora AS horasa,
								 accion AS accion,
						 		 id_sol AS idsol
						  FROM asistencia WHERE accion='salida'
						) T2 ON T1.idsol = T2.idsol
						INNER JOIN
						( SELECT id AS idsol, 
								 cedula AS cedulasol, 
								 nombre AS nombresol, 
								 apellido AS apellidosol
						  FROM solicitante
						) T3 ON T1.idsol = T3.idsol
						WHERE T1.fechaasis=T2.fechaasis ORDER BY T1.idasis ASC;";//consulto si existe el registro
				$result = $con->prepare($sql);//preparar la sentencia sql
				$result->execute();
				return $result->fetchAll(PDO::FETCH_OBJ);
			}

		/* LISTAR MES */
			public function ListarReporteC2($mes){
				require_once("conexionpdo.php");//se llama al archivo para la conexion

				$year= date('Y');
				$sql = "SELECT 
							T3.cedulasol, T3.nombresol, T3.apellidosol, T1.fechaasis, T1.horaen, T2.horasa
						FROM
						( SELECT id AS idasis,
								 fecha AS fechaasis,
								 hora AS horaen,
								 accion AS accion,
						 		 id_sol AS idsol
						  FROM asistencia WHERE accion='entrada'
						) T1
						INNER JOIN
						( SELECT id AS idasis,
								 fecha AS fechaasis,
								 hora AS horasa,
								 accion AS accion,
						 		 id_sol AS idsol
						  FROM asistencia WHERE accion='salida'
						) T2 ON T1.idsol = T2.idsol
						INNER JOIN
						( SELECT id AS idsol, 
								 cedula AS cedulasol, 
								 nombre AS nombresol, 
								 apellido AS apellidosol
						  FROM solicitante
						) T3 ON T1.idsol = T3.idsol
						WHERE T1.fechaasis=T2.fechaasis AND (T1.fechaasis>='$year-$mes-01' AND T1.fechaasis <= '$year-$mes-31') ORDER BY T1.idasis ASC;";//consulto si existe el registro
				$result = $con->prepare($sql);//preparar la sentencia sql
				$result->execute();
				return $result->fetchAll(PDO::FETCH_OBJ);
			}

		/* LISTAR -15 DÍAS */
			public function ListarReporteC3(){
				require_once("conexionpdo.php");//se llama al archivo para la conexion

				$fechahoy=date('Y-m-d');
				$fechanew= date('Y-m-d',strtotime($fechahoy.'- 15 days'));

				$sql = "SELECT 
							T3.cedulasol, T3.nombresol, T3.apellidosol, T1.fechaasis, T1.horaen, T2.horasa
						FROM
						( SELECT id AS idasis,
								 fecha AS fechaasis,
								 hora AS horaen,
								 accion AS accion,
						 		 id_sol AS idsol
						  FROM asistencia WHERE accion='entrada'
						) T1
						INNER JOIN
						( SELECT id AS idasis,
								 fecha AS fechaasis,
								 hora AS horasa,
								 accion AS accion,
						 		 id_sol AS idsol
						  FROM asistencia WHERE accion='salida'
						) T2 ON T1.idsol = T2.idsol
						INNER JOIN
						( SELECT id AS idsol, 
								 cedula AS cedulasol, 
								 nombre AS nombresol, 
								 apellido AS apellidosol
						  FROM solicitante
						) T3 ON T1.idsol = T3.idsol
						WHERE T1.fechaasis=T2.fechaasis AND (T1.fechaasis>='$fechanew' AND T1.fechaasis <= '$fechahoy') ORDER BY T1.idasis ASC;";//consulto si existe el registro
				$result = $con->prepare($sql);//preparar la sentencia sql
				$result->execute();
				return $result->fetchAll(PDO::FETCH_OBJ);
			}

		/* LISTAR PERSONALIZADO */
			public function ListarReporteC4($fechaini,$fechafin){
				require_once("conexionpdo.php");//se llama al archivo para la conexion

				$fecha_bdi= $fechaini;
				$fechaini = date('Y-m-d', strtotime($fecha_bdi));

				$fecha_bdf= $fechafin;
				$fechafin = date('Y-m-d', strtotime($fecha_bdf));

				$sql = "SELECT 
							T3.cedulasol, T3.nombresol, T3.apellidosol, T1.fechaasis, T1.horaen, T2.horasa
						FROM
						( SELECT id AS idasis,
								 fecha AS fechaasis,
								 hora AS horaen,
								 accion AS accion,
						 		 id_sol AS idsol
						  FROM asistencia WHERE accion='entrada'
						) T1
						INNER JOIN
						( SELECT id AS idasis,
								 fecha AS fechaasis,
								 hora AS horasa,
								 accion AS accion,
						 		 id_sol AS idsol
						  FROM asistencia WHERE accion='salida'
						) T2 ON T1.idsol = T2.idsol
						INNER JOIN
						( SELECT id AS idsol, 
								 cedula AS cedulasol, 
								 nombre AS nombresol, 
								 apellido AS apellidosol
						  FROM solicitante
						) T3 ON T1.idsol = T3.idsol
						WHERE T1.fechaasis=T2.fechaasis AND (T1.fechaasis>='$fechaini' AND T1.fechaasis <= '$fechafin') ORDER BY T1.idasis ASC;";//consulto si existe el registro
				$result = $con->prepare($sql);//preparar la sentencia sql
				$result->execute();
				return $result->fetchAll(PDO::FETCH_OBJ);
			}


	/* REPORTES INCOMPLETAS*/

		/* LISTAR TODAS */
			public function ListarReporteI(){
				require_once("conexionpdo.php");//se llama al archivo para la conexion

				$sql = "SELECT a.id AS idasis,
								a.fecha AS fechaasis,
								a.hora AS hora,
								a.accion AS accion,
								s.cedula AS cedulasol, 
								s.nombre AS nombresol,
								s.apellido AS apellidosol
						FROM asistencia AS a INNER JOIN solicitante AS s 
						ON a.id_sol=s.id WHERE accion='entrada' AND a.estatus='i' ORDER BY a.id ASC";//consulto si existe el registro
				$result = $con->prepare($sql);//preparar la sentencia sql
				$result->execute();
				return $result->fetchAll(PDO::FETCH_OBJ);
			}

		/* LISTAR MES */
			public function ListarReporteI2($mes){
				require_once("conexionpdo.php");//se llama al archivo para la conexion

				@$year= date('Y');
				$sql = "SELECT a.id AS idasis,
								a.fecha AS fechaasis,
								a.hora AS hora,
								a.accion AS accion,
								s.cedula AS cedulasol, 
								s.nombre AS nombresol,
								s.apellido AS apellidosol
						FROM asistencia AS a INNER JOIN solicitante AS s 
						ON a.id_sol=s.id WHERE accion='entrada' AND a.estatus='i' AND (a.fecha>='$year-$mes-01' AND a.fecha<='$year-$mes-31') ORDER BY a.id ASC";//consulto si existe el registro
				$result = $con->prepare($sql);//preparar la sentencia sql
				$result->execute();
				return $result->fetchAll(PDO::FETCH_OBJ);
			}

		/* LISTAR -15 DÍAS */
			public function ListarReporteI3(){
				require_once("conexionpdo.php");//se llama al archivo para la conexion

				$fechahoy=date('Y-m-d');
				$fechanew= date('Y-m-d',strtotime($fechahoy.'- 15 days'));

				$sql = "SELECT a.id AS idasis,
								a.fecha AS fechaasis,
								a.hora AS hora,
								a.accion AS accion,
								s.cedula AS cedulasol, 
								s.nombre AS nombresol,
								s.apellido AS apellidosol
						FROM asistencia AS a INNER JOIN solicitante AS s 
						ON a.id_sol=s.id WHERE accion='entrada' AND a.estatus='i' AND (a.fecha>='$fechanew' AND a.fecha<='$fechahoy') ORDER BY a.id ASC";//consulto si existe el registro
				$result = $con->prepare($sql);//preparar la sentencia sql
				$result->execute();
				return $result->fetchAll(PDO::FETCH_OBJ);
			}

		/* LISTAR PERSONALIZADO */
			public function ListarReporteI4($fechaini,$fechafin){
				require_once("conexionpdo.php");//se llama al archivo para la conexion

				$fecha_bdi= $fechaini;
				$fechaini = date('Y-m-d', strtotime($fecha_bdi));

				$fecha_bdf= $fechafin;
				$fechafin = date('Y-m-d', strtotime($fecha_bdf));

				$sql = "SELECT a.id AS idasis,
								a.fecha AS fechaasis,
								a.hora AS hora,
								a.accion AS accion,
								s.cedula AS cedulasol, 
								s.nombre AS nombresol,
								s.apellido AS apellidosol
						FROM asistencia AS a INNER JOIN solicitante AS s 
						ON a.id_sol=s.id WHERE accion='entrada' AND a.estatus='i' AND (a.fecha>='$fechaini' AND a.fecha<='$fechafin') ORDER BY a.id ASC";//consulto si existe el registro
				$result = $con->prepare($sql);//preparar la sentencia sql
				$result->execute();
				return $result->fetchAll(PDO::FETCH_OBJ);
			}

	}//CIERRE DE LA CLASE

?>