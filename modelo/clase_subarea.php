<?php 
	class Subarea
	{
		//variables
		private $area, $nombre;

		public function __construct(){

		}
		// Area
			//setters
				public function setId_area($id_area){
					$this->id_area = $id_area;
				}
			//getters
				public function getId_area(){
					return $this->id_area;
				}
		// Subarea
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

				$sql = "SELECT s.id AS idsub, s.nombre AS nombresub, s.estatus AS estatussub, a.id AS idare, a.nombre AS nombreare, a.estatus AS estatusare  FROM subarea AS s INNER JOIN area AS a ON s.id_area=a.id WHERE s.estatus='a' ORDER BY a.nombre, s.nombre ASC";//consulto si existe el registro
				$result = $con->prepare($sql);//preparar la sentencia sql
				$result->execute();
				return $result->fetchAll(PDO::FETCH_OBJ);
			}
		/* CATALAGO INACTIVOS */
			public function ListarInactivo(){
				require_once("conexionpdo.php");//se llama al archivo para la conexion

				$sql = "SELECT s.id AS idsub, s.nombre AS nombresub, s.estatus AS estatussub, a.id AS idare, a.nombre AS nombreare, a.estatus AS estatusare  FROM subarea AS s INNER JOIN area AS a ON s.id_area=a.id WHERE s.estatus='i' ORDER BY a.nombre, s.nombre ASC";//consulto si existe el registro
				$result = $con->prepare($sql);//preparar la sentencia sql
				$result->execute();
				return $result->fetchAll(PDO::FETCH_OBJ);
		}


		/* REGISTRAR */
			public function RegistrarSubarea($id_area, $nombre){
				require_once("conexionpdo.php"); //se llama al archivo para la conexion

				$sql = "INSERT INTO subarea (id_area, nombre, estatus)VALUES (:id_area, :nombre, :estatus)"; //sentencia sql para registrar 
				$insert = $con->prepare($sql); //preparar la sentencia sql
					//Excecute
				$insert->execute(array('id_area'=>$id_area, 'nombre'=>$nombre, 'estatus'=>'a'));
				return $insert; //retornar el resultado de la sentencia sql
			}

		/* BUSCAR */
			public function ConsultarSubarea($id){
				require_once("conexionpdo.php");//se llama al archivo para la conexion
					
				$sql = "SELECT * FROM subarea WHERE id=:id";//sentencia sql para consultar
				$result = $con->prepare($sql);//preparar la sentencia sql
			    	$params = array('id'=>$id); 
			    	$result->execute($params); //ejecuta la sentencia sql
				$data = $result->fetchAll();//Acomoda en un arreglo el resultado de la búsqueda
				return $data;//retornar el resultado de la sentencia sql
			}

		/* MOSTRAR */
			public function MostrarSubarea($id){
				require_once("conexionpdo.php");//se llama al archivo para la conexion
				
				$sql = "SELECT * FROM subarea WHERE id=:id";//sentencia sql para consultar
				$result = $con->prepare($sql);//preparar la sentencia sql
				$params = array ('id'=>$id);
				$result->execute($params);//ejecuta la sentencia sql
				$data = $result->fetchAll();//Acomoda en un arreglo el resultado de la búsqueda
				return $data;//retornar el resultado de la sentencia sql
			}

		/* ACTUALIZAR */
			public function ActualizarSubarea($id, $id_area, $nombre){
				require_once("conexionpdo.php");//se llama al archivo para la conexion

				$sql = "UPDATE subarea SET id_area='$id_area', nombre='$nombre' WHERE id=:id";//sentencia sql para actualizar
				$result = $con->prepare($sql);//preparar la sentencia sql
				$params = array ('id'=>$id);
				$cambio = $result->execute($params);//ejecuta la sentencia sql
				return $cambio;//retornar el resultado de la sentencia sql
			}

		/* ELIMINAR */
			public function EliminarSubarea($id){
				require_once("conexionpdo.php");//se llama al archivo para la conexion
				 
				$sql = "SELECT * FROM subarea WHERE id=:id";//consulto si existe el registro
				$result = $con->prepare($sql);//preparar la sentencia sql
				$params = array ("id"=>$id);
				$result->execute($params);//ejecuta la sentencia sql
				$data = $result->fetchAll();//Acomoda en un arreglo el resultado de la búsqueda

				if($data){//si el arreglo no esta vacio luego elimino
					$sqld = "UPDATE subarea SET estatus='i' WHERE id=:id";//elimino el registro
					$resultd = $con->prepare($sqld);//preparar la sentencia sql
					$paramsd = array ("id"=>$id);
					$resultd->execute($paramsd);//ejecuta la sentencia sql
					$delete = $result->execute();//ejecuta la sentencia sql
					return $delete;//retorno 1, para demostrar que fue elimnado el registro encontrado
				}else{
					return $data;//retorno vacio, para demostrar que no existe el registro
				}
			}

			public function ListarArea(){
				require_once("conexionpdo.php");//se llama al archivo para la conexion

				$sqla = "SELECT * FROM area WHERE estatus='a' ";//consulto si existe el registro
				$result = $con->prepare($sqla);//preparar la sentencia sql
				$result->execute();
				return $result->fetchAll(PDO::FETCH_OBJ);
			}

			/* HABILITAR */
			public function HabilitarSubarea($id){
				require_once("conexionpdo.php");//se llama al archivo para la conexion
				 
				$sql = "SELECT * FROM subarea WHERE id=:id";//consulto si existe el registro
				$result = $con->prepare($sql);//preparar la sentencia sql
				$params = array ("id"=>$id);
				$result->execute($params);//ejecuta la sentencia sql
				$data = $result->fetchAll();//Acomoda en un arreglo el resultado de la búsqueda

				if($data){//si el arreglo no esta vacio luego elimino
					$sqld = "UPDATE subarea SET estatus='a' WHERE id=:id";//elimino el registro
					$resultd = $con->prepare($sqld);//preparar la sentencia sql
					$paramsd = array ("id"=>$id);
					$resultd->execute($paramsd);//ejecuta la sentencia sql
					$delete = $result->execute();//ejecuta la sentencia sql
					return $delete;//retorno 1, para demostrar que fue elimnado el registro encontrado
				}else{
					return $data;//retorno vacio, para demostrar que no existe el registro
				}
			}





	} // CIERRE CLASE area


	

?>