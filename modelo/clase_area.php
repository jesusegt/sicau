<?php 
	class Area
	{
		//variables
		private $nombre;

		public function __construct(){

		}
		// Nombre
			//setters
				public function setNombre($nombre){
					$this->nombre = $nombre;
				}
			//getters
				public function getNombre(){
					return $this->nombre;
				}


		/* CATALAGO */
			public function Listar(){
				require_once("conexionpdo.php");//se llama al archivo para la conexion

				$sql = "SELECT * FROM area WHERE estatus='a' ORDER BY nombre ASC";//consulto si existe el registro
				$result = $con->prepare($sql);//preparar la sentencia sql
				$result->execute();
				return $result->fetchAll(PDO::FETCH_OBJ);
			}

		/* CATALAGO INACTIVOS */
			public function ListarInactivo(){
				require_once("conexionpdo.php");//se llama al archivo para la conexion

				$sql = "SELECT * FROM area WHERE estatus='i' ORDER BY nombre ASC";//consulto si existe el registro
				$result = $con->prepare($sql);//preparar la sentencia sql
				$result->execute();
				return $result->fetchAll(PDO::FETCH_OBJ);
		}


		/* REGISTRAR */
			public function RegistrarArea($nombre){
				require_once("conexionpdo.php"); //se llama al archivo para la conexion

				$sql = "INSERT INTO area (nombre, estatus)VALUES (:nombre, :estatus)"; //sentencia sql para registrar 
				$insert = $con->prepare($sql); //preparar la sentencia sql
					//Excecute
				$insert->execute(array('nombre'=>$nombre, 'estatus'=>'a'));
				return $insert; //retornar el resultado de la sentencia sql
			}

		/* BUSCAR */
			public function ConsultarArea($id){
				require_once("conexionpdo.php");//se llama al archivo para la conexion
					
				$sql = "SELECT * FROM area WHERE id=:id";//sentencia sql para consultar
				$result = $con->prepare($sql);//preparar la sentencia sql
			    	$params = array('id'=>$id); 
			    	$result->execute($params); //ejecuta la sentencia sql
				$data = $result->fetchAll();//Acomoda en un arreglo el resultado de la búsqueda
				return $data;//retornar el resultado de la sentencia sql
			}

		/* MOSTRAR */
			public function MostrarArea($id){
				require_once("conexionpdo.php");//se llama al archivo para la conexion
				
				$sql = "SELECT * FROM area WHERE id=:id";//sentencia sql para consultar
				$result = $con->prepare($sql);//preparar la sentencia sql
				$params = array ('id'=>$id);
				$result->execute($params);//ejecuta la sentencia sql
				$data = $result->fetchAll();//Acomoda en un arreglo el resultado de la búsqueda
				return $data;//retornar el resultado de la sentencia sql
			}

		/* ACTUALIZAR */
			public function ActualizarArea($id, $nombre){
				require_once("conexionpdo.php");//se llama al archivo para la conexion
				
				$sql = "UPDATE area SET nombre='$nombre' WHERE id=:id";//sentencia sql para actualizar
				$result = $con->prepare($sql);//preparar la sentencia sql
				$params = array ('id'=>$id);
				$cambio = $result->execute($params);//ejecuta la sentencia sql
				return $cambio;//retornar el resultado de la sentencia sql
			}

		/* ELIMINAR */
			public function EliminarArea($id){
				require_once("conexionpdo.php");//se llama al archivo para la conexion
				 
				$sql = "SELECT * FROM area WHERE id=:id";//consulto si existe el registro
				$result = $con->prepare($sql);//preparar la sentencia sql
				$params = array ("id"=>$id);
				$result->execute($params);//ejecuta la sentencia sql
				$data = $result->fetchAll();//Acomoda en un arreglo el resultado de la búsqueda

				if($data){//si el arreglo no esta vacio luego elimino
					$sqld = "UPDATE area SET estatus='i' WHERE id=:id";//elimino el registro
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
			public function HabilitarArea($id){
				require_once("conexionpdo.php");//se llama al archivo para la conexion
				 
				$sql = "SELECT * FROM area WHERE id=:id";//consulto si existe el registro
				$result = $con->prepare($sql);//preparar la sentencia sql
				$params = array ("id"=>$id);
				$result->execute($params);//ejecuta la sentencia sql
				$data = $result->fetchAll();//Acomoda en un arreglo el resultado de la búsqueda

				if($data){//si el arreglo no esta vacio luego elimino
					$sqld = "UPDATE area SET estatus='a' WHERE id=:id";//elimino el registro
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

				$sql = "SELECT * FROM area WHERE estatus='a' ORDER BY nombre ASC";//consulto si existe el registro
				$result = $con->prepare($sql);//preparar la sentencia sql
				$result->execute();
				return $result->fetchAll(PDO::FETCH_OBJ);
			}



	} // CIERRE CLASE area


	

?>