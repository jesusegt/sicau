 <?php 
	class Feriado
	{
		//variables
		private $motivo, $fecha_inicial, $fecha_final;

		public function __construct(){

		}
		// Motivo
			//setters
				public function setMotivo($motivo){
					$this->motivo = $motivo;
				}
			//getters
				public function getMotivo(){
					return $this->motivo;
				}

		// Fecha Inicial
			//setters
				public function setFecha_inicial($fecha_inicial){
					$this->fecha_inicial = $fecha_inicial;
				}
			//getters
				public function getFecha_inicial(){
					return $this->fecha_inicial;
				}

		// Fecha Final
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

				$sql = "SELECT * FROM dia_feriado WHERE estatus='a' ";//consulto si existe el registro
				$result = $con->prepare($sql);//preparar la sentencia sql
				$result->execute();
				return $result->fetchAll(PDO::FETCH_OBJ);
			}

		/* CATALAGO INACTIVOS */
			public function ListarInactivo(){
				require_once("conexionpdo.php");//se llama al archivo para la conexion

				$sql = "SELECT * FROM dia_feriado WHERE estatus='i' ";//consulto si existe el registro
				$result = $con->prepare($sql);//preparar la sentencia sql
				$result->execute();
				return $result->fetchAll(PDO::FETCH_OBJ);
			}

		/* REGISTRAR */
			public function RegistrarFeriado($motivo, $fecha_inicial, $fecha_final){
				require_once("conexionpdo.php"); //se llama al archivo para la conexion

				$sql = "INSERT INTO dia_feriado (motivo, fecha_inicial, fecha_final, estatus)VALUES (:motivo, :fecha_inicial, :fecha_final, :estatus)"; //sentencia sql para registrar 
				$insert = $con->prepare($sql); //preparar la sentencia sql
					//Excecute
				$insert->execute(array('motivo'=>$motivo, 'fecha_inicial'=>$fecha_inicial, 'fecha_final'=>$fecha_final, 'estatus'=>'a'));
				return $insert; //retornar el resultado de la sentencia sql
			}

		/* BUSCAR */
			public function ConsultarFeriado($id){
				require_once("conexionpdo.php");//se llama al archivo para la conexion
					
				$sql = "SELECT * FROM dia_feriado WHERE id=:id";//sentencia sql para consultar
				$result = $con->prepare($sql);//preparar la sentencia sql
			    	$params = array('id'=>$id); 
			    	$result->execute($params); //ejecuta la sentencia sql
				$data = $result->fetchAll();//Acomoda en un arreglo el resultado de la búsqueda
				return $data;//retornar el resultado de la sentencia sql
			}

		/* MOSTRAR */
			public function MostrarFeriado($id){
				require_once("conexionpdo.php");//se llama al archivo para la conexion
				
				$sql = "SELECT * FROM dia_feriado WHERE id=:id";//sentencia sql para consultar
				$result = $con->prepare($sql);//preparar la sentencia sql
				$params = array ('id'=>$id);
				$result->execute($params);//ejecuta la sentencia sql
				$data = $result->fetchAll();//Acomoda en un arreglo el resultado de la búsqueda
				return $data;//retornar el resultado de la sentencia sql
			}

		/* ACTUALIZAR */
			public function ActualizarFeriado($id, $motivo, $fecha_inicial, $fecha_final){
				require_once("conexionpdo.php");//se llama al archivo para la conexion
				
				$sql = "UPDATE dia_feriado SET motivo='$motivo', fecha_inicial='$fecha_inicial', fecha_final='$fecha_final' WHERE id=:id";//sentencia sql para actualizar
				$result = $con->prepare($sql);//preparar la sentencia sql
				$params = array ('id'=>$id);
				$cambio = $result->execute($params);//ejecuta la sentencia sql
				return $cambio;//retornar el resultado de la sentencia sql
			}

		/* ELIMINAR */
			public function EliminarFeriado($id){
				require_once("conexionpdo.php");//se llama al archivo para la conexion
				 
				$sql = "SELECT * FROM dia_feriado WHERE id=:id";//consulto si existe el registro
				$result = $con->prepare($sql);//preparar la sentencia sql
				$params = array ("id"=>$id);
				$result->execute($params);//ejecuta la sentencia sql
				$data = $result->fetchAll();//Acomoda en un arreglo el resultado de la búsqueda

				if($data){//si el arreglo no esta vacio luego elimino
					$sqld = "UPDATE dia_feriado SET estatus='i' WHERE id=:id";//elimino el registro
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
			public function HabilitarFeriado($id){
				require_once("conexionpdo.php");//se llama al archivo para la conexion
				 
				$sql = "SELECT * FROM dia_feriado WHERE id=:id";//consulto si existe el registro
				$result = $con->prepare($sql);//preparar la sentencia sql
				$params = array ("id"=>$id);
				$result->execute($params);//ejecuta la sentencia sql
				$data = $result->fetchAll();//Acomoda en un arreglo el resultado de la búsqueda

				if($data){//si el arreglo no esta vacio luego elimino
					$sqld = "UPDATE dia_feriado SET estatus='a' WHERE id=:id";//elimino el registro
					$resultd = $con->prepare($sqld);//preparar la sentencia sql
					$paramsd = array ("id"=>$id);
					$resultd->execute($paramsd);//ejecuta la sentencia sql
					$delete = $result->execute();//ejecuta la sentencia sql
					return $delete;//retorno 1, para demostrar que fue elimnado el registro encontrado
				}else{
					return $data;//retorno vacio, para demostrar que no existe el registro
				}
			}

		/* CATALAGO */
			public function ListarReporte(){
				require_once("conexionpdo.php");//se llama al archivo para la conexion

				$sql = "SELECT * FROM dia_feriado WHERE estatus='a' ";//consulto si existe el registro
				$result = $con->prepare($sql);//preparar la sentencia sql
				$result->execute();
				return $result->fetchAll(PDO::FETCH_OBJ);
			}




	} // CIERRE CLASE feriado


	

?>