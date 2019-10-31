<?php


	class Solicitud {
		//variables
		private $cedula, $fecha;

		public function __construct(){

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
				public function setCedula($cedula){
					$this->cedula = $cedula;
				}
			//getters
				public function getCedula(){
					return $this->cedula;
				}
		// Nombre
			//setters
				public function setMotivo($motivo){
					$this->motivo = $motivo;
				}
			//getters
				public function getMotivo(){
					return $this->motivo;
				}
		// Nombre
			//setters
				public function setId_tipo($id_tipo){
					$this->id_tipo = $id_tipo;
				}
			//getters
				public function getId_tipo(){
					return $this->id_tipo;
				}
		// Nombre
			//setters
				public function setId_subarea($id_subarea){
					$this->id_subarea = $id_subarea;
				}
			//getters
				public function getId_subarea(){
					return $this->id_subarea;
				}
		// Nombre
			//setters
				public function setComentario($comentario){
					$this->comentario = $comentario;
				}
			//getters
				public function getComentario(){
					return $this->comentario;
				}
		// Nombre
			/*/setters
				public function setId_solicitud($id_solicitud){
					$this->id_solicitud = $id_solicitud;
				}
			//getters
				public function getId_solicitud(){
					return $this->id_solicitud;
				}*/




		/* CATALAGO */
			public function Listar(){
				require_once("conexionpdo.php");//se llama al archivo para la conexion

				$sql = "SELECT a.id AS idsoli,
								a.fecha AS fechasoli,
								a.motivo AS motivosoli,
								a.estatus AS estatus,
								a.id_tipo AS idcon,
								a.id_sol AS idsolcon,
								s.id AS idsol,
								s.cedula AS cedulasol, 
								s.nombre AS nombresol,
								s.apellido AS apellidosol,
								t.id AS idtipo,
								t.nombre AS tiposol
						FROM solicitud AS a, solicitante AS s, tipo_solicitud AS t WHERE a.estatus='a' AND t.id=a.id_tipo AND s.id=a.id_sol ORDER BY a.id ASC";//consulto si existe el registro
				$result = $con->prepare($sql);//preparar la sentencia sql
				$result->execute();
				return $result->fetchAll(PDO::FETCH_OBJ);
			}

		/* CATALAGO COMPLETADOS*/
			public function ListarCompletado(){
				require_once("conexionpdo.php");//se llama al archivo para la conexion

				//FROM solicitud AS ss INNER JOIN solicitante AS s ON ss.id_sol=s.id INNER JOIN tipo_solicitud AS t ON ss.id_tipo=t.id INNER JOIN subarea AS saON ss.id_subarea=sa.id INNER JOIN area AS a ON sa.id_area=a.id WHERE ss.id=:id
				$sql = "SELECT  ss.id AS idsoli,
								ss.fecha AS fechasoli,
								se.fecha AS fechaser,
								s.nombre AS nombresol,
								s.apellido AS apellidosol,
								s.cedula AS cedulasol,
								t.nombre AS tipo
						FROM servicio AS se INNER JOIN solicitud AS ss 
						ON se.id_solicitud=ss.id INNER JOIN solicitante AS s 
						ON ss.id_sol=s.id INNER JOIN tipo_solicitud AS t
						ON ss.id_tipo=t.id WHERE ss.estatus='i' ORDER BY se.id ASC";//consulto si existe el registro
				$result = $con->prepare($sql);//preparar la sentencia sql
				$result->execute();
				return $result->fetchAll(PDO::FETCH_OBJ);
			}


		/* REGISTRAR */
			public function RegistrarSolicitud($fecha,$cedula,$motivo,$id_tipo,$id_subarea,$comentario){
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
					
				}
				if(empty($data)){ //Si el método, retorna un arreglo vacío;
					echo "<script>alert('Solicitante no existente, verifique la cédula del solicitante o solicite al administrador del sistema que lo registre.')</script>";//Mensaje de Registro no válida
					echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/solicitud/sql/'>"; // ir a la pantalla de inicio
				}else{ //Si el areglo NO retornó vacío	

					$sql = "SELECT MAX(id) FROM solicitud";
					$result = $con->prepare($sql);//preparar la sentencia sql
					$result->execute(); //ejecuta la sentencia sql
					$data = $result->fetchAll();
					foreach($data as $u){//se optiene el valor de cada campo de la tabla
						@$idsoll=$u['MAX(id)'];}
					$id_solicitud=$idsoll+1;

						if(@$estatus=="i"){
						echo "<script>alert('Solicitante inactivo, para ser activado nuevamente contacte al administrador del sistema.')</script>";//Mensaje de Registro válida
						echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/solicitud/sql/'>"; // ir a la pantalla de inicio
						}else{

							$idu=@$_SESSION['idu'];

							$sql = "INSERT INTO solicitud (fecha, motivo, estatus, id_sol, id_usu, id_tipo, id_subarea)VALUES (:fecha, :motivo, :estatus, :idsol, :idu, :id_tipo, :id_subarea)"; //sentencia sql para registrar 
							$insert = $con->prepare($sql); //preparar la sentencia sql
													//Excecute
							$insert->execute(array('fecha'=>$fecha, 'motivo'=>$motivo, 'estatus'=>'a','idsol'=>$idsol, 'idu'=>$idu, 'id_tipo'=>$id_tipo, 'id_subarea'=>$id_subarea));

								if(empty($comentario)){
									echo "<script>alert('Solicitud registrada con exito.')</script>";//Mensaje de Registro válida
									echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=ctr_solicitud.php?list=1'>"; // Otra manera de redireccionar, esta permite que el mensaje anterior sea mostrado...

								}else{
									
											$sql = "INSERT INTO solicitud_comentario (id_solicitud, comentario)VALUES (:id_solicitud, :comentario)"; //sentencia sql para registrar 
											$insert = $con->prepare($sql); //preparar la sentencia sql
										//Excecute
											$insert->execute(array('id_solicitud'=>$id_solicitud, 'comentario'=>$comentario));
											 //retornar el resultado de la sentencia sql
											echo "<script>alert('Solicitud registrada con exito.')</script>";//Mensaje de Registro válida
											echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=ctr_solicitud.php?list=1'>"; // Otra manera de redireccionar, esta permite que el mensaje anterior sea mostrado...
									}
								}

						}
					}
				
			
		/* CONSULTAR */
			public function ConsultarSolicitud($id){
				require_once("conexionpdo.php");//se llama al archivo para la conexion
				
				$sql = "SELECT * FROM solicitud_comentario WHERE id_solicitud=:id";//sentencia sql para consultar
				$result = $con->prepare($sql);//preparar la sentencia sql
			    $params = array('id'=>$id); 
			    $result->execute($params); //ejecuta la sentencia sql
				$data = $result->fetchAll();

				if(empty($data)){
					$sql = "SELECT 	s.cedula AS cedulasol, 
									s.nombre AS nombresol,
									s.apellido AS apellidosol,
									t.nombre AS tipo,
									a.nombre AS area,
									sa.nombre AS subarea,
									ss.motivo AS motivo,
									ss.fecha AS fecha,
									ss.id AS idsoli
							FROM solicitud AS ss INNER JOIN solicitante AS s 
							ON ss.id_sol=s.id INNER JOIN tipo_solicitud AS t 
							ON ss.id_tipo=t.id INNER JOIN subarea AS sa
							ON ss.id_subarea=sa.id INNER JOIN area AS a 
							ON sa.id_area=a.id WHERE ss.id=:id";//sentencia sql para consultar
					$result = $con->prepare($sql);//preparar la sentencia sql
				    	$params = array('id'=>$id); 
				    	$result->execute($params); //ejecuta la sentencia sql
					$data = $result->fetchAll();//Acomoda en un arreglo el resultado de la búsqueda

				}else{
					$sql = "SELECT 	s.cedula AS cedulasol, 
									s.nombre AS nombresol,
									s.apellido AS apellidosol,
									t.nombre AS tipo,
									a.nombre AS area,
									sa.nombre AS subarea,
									ss.motivo AS motivo,
									ss.fecha AS fecha,
									ss.id AS idsoli,
									sc.comentario AS comentario
							FROM solicitud AS ss INNER JOIN solicitante AS s 
							ON ss.id_sol=s.id INNER JOIN tipo_solicitud AS t 
							ON ss.id_tipo=t.id INNER JOIN subarea AS sa
							ON ss.id_subarea=sa.id INNER JOIN area AS a 
							ON sa.id_area=a.id INNER JOIN solicitud_comentario AS sc
							ON sc.id_solicitud=ss.id WHERE ss.id=:id";//sentencia sql para consultar
					$result = $con->prepare($sql);//preparar la sentencia sql
				    	$params = array('id'=>$id); 
				    	$result->execute($params); //ejecuta la sentencia sql
					$data = $result->fetchAll();//Acomoda en un arreglo el resultado de la búsqueda

				}

				return $data;//retornar el resultado de la sentencia sql
			}

		/* COMPLETAR */
			public function CompletarSolicitud($id){
				require_once("conexionpdo.php");//se llama al archivo para la conexion
				 
				$sql = "SELECT * FROM solicitud WHERE id=:id";//consulto si existe el registro
				$result = $con->prepare($sql);//preparar la sentencia sql
				$params = array ("id"=>$id);
				$result->execute($params);//ejecuta la sentencia sql
				$data = $result->fetchAll();//Acomoda en un arreglo el resultado de la búsqueda

				if($data){//si el arreglo no esta vacio luego elimino

					$sqld = "UPDATE solicitud SET estatus='i' WHERE id=:id";//elimino el registro
					$resultd = $con->prepare($sqld);//preparar la sentencia sql
					$paramsd = array ("id"=>$id);
					$resultd->execute($paramsd);//ejecuta la sentencia sql
					$delete = $result->execute();//ejecuta la sentencia sql

					date_default_timezone_set('America/Caracas');
					$fecha_servicio=date('Y-m-d');

					if($fecha_servicio){

						$sqld = "INSERT INTO servicio (fecha, estatus, id_solicitud)VALUES (:fecha, :estatus, :id_solicitud)"; //sentencia sql para registrar 
						$insert = $con->prepare($sqld); //preparar la sentencia sql
											//Excecute
						$insert->execute(array('fecha'=>$fecha_servicio, 'estatus'=>'a', 'id_solicitud'=>$id));//ejecuta la sentencia sql
						return $insert;//retorno 1, para demostrar que fue elimnado el registro encontrado
					}
				}else{
					return $data;//retorno vacio, para demostrar que no existe el registro
				}
			}

		/* CONSULTAR COMPLETADOS */
			public function ConsultarServicio($id){
				require_once("conexionpdo.php");//se llama al archivo para la conexion
				
				$sql = "SELECT * FROM solicitud_comentario WHERE id_solicitud=:id";//sentencia sql para consultar
				$result = $con->prepare($sql);//preparar la sentencia sql
			    $params = array('id'=>$id); 
			    $result->execute($params); //ejecuta la sentencia sql
				$data = $result->fetchAll();

				if(empty($data)){
					$sql = "SELECT 	s.cedula AS cedulasol, 
									s.nombre AS nombresol,
									s.apellido AS apellidosol,
									t.nombre AS tipo,
									a.nombre AS area,
									sa.nombre AS subarea,
									ss.motivo AS motivo,
									ss.fecha AS fechasoli,
									se.fecha AS fechaser
							FROM servicio AS se INNER JOIN solicitud AS ss 
							ON se.id_solicitud=ss.id INNER JOIN solicitante AS s 
							ON ss.id_sol=s.id INNER JOIN tipo_solicitud AS t 
							ON ss.id_tipo=t.id INNER JOIN subarea AS sa
							ON ss.id_subarea=sa.id INNER JOIN area AS a 
							ON sa.id_area=a.id WHERE ss.id=:id";//sentencia sql para consultar
					$result = $con->prepare($sql);//preparar la sentencia sql
				    	$params = array('id'=>$id); 
				    	$result->execute($params); //ejecuta la sentencia sql
					$data = $result->fetchAll();//Acomoda en un arreglo el resultado de la búsqueda

				}else{
					$sql = "SELECT 	s.cedula AS cedulasol, 
									s.nombre AS nombresol,
									s.apellido AS apellidosol,
									t.nombre AS tipo,
									a.nombre AS area,
									sa.nombre AS subarea,
									ss.motivo AS motivo,
									ss.fecha AS fechasoli,
									se.fecha AS fechaser,
									sc.comentario AS comentario
							FROM servicio AS se INNER JOIN solicitud AS ss 
							ON se.id_solicitud=ss.id INNER JOIN solicitante AS s 
							ON ss.id_sol=s.id INNER JOIN tipo_solicitud AS t 
							ON ss.id_tipo=t.id INNER JOIN subarea AS sa
							ON ss.id_subarea=sa.id INNER JOIN area AS a 
							ON sa.id_area=a.id INNER JOIN solicitud_comentario AS sc
							ON sc.id_solicitud=ss.id WHERE ss.id=:id";//sentencia sql para consultar
					$result = $con->prepare($sql);//preparar la sentencia sql
				    	$params = array('id'=>$id); 
				    	$result->execute($params); //ejecuta la sentencia sql
					$data = $result->fetchAll();//Acomoda en un arreglo el resultado de la búsqueda

				}

				return $data;//retornar el resultado de la sentencia sql
			}

	}
?>