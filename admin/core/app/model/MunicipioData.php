

<?php
 #[AllowDynamicProperties]

	// require ('../../controller/Database.php');


class MunicipioData {

	var $ID_estado = "";


	public static $tablename = "municipios";


	public function __construct(){
		$this->id_estado = "";
		$this->id_municipio = "";
		$this->municipio = "";




	}




	public static function getRepeated($name,$id_estado){
		$sql = "select * from ".self::$tablename." where municipio=\"$name\" and id_estado=\"$id_estado\"";
		$query = Executor::doit($sql);
		return Model::one($query[0],new InfoData());
	}



	public function add(){
		$sql = "insert into ".self::$tablename." (id_estado,municipio) ";
		$sql .= "value (\"$this->id_estado\",\"$this->municipio\")";
		Executor::doit($sql);
	}

	public static function delById($id){
		$sql = "delete from ".self::$tablename." where id_municipio=$id";
		Executor::doit($sql);
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where id_municipio=$this->id_municipio";
		Executor::doit($sql);
	}

// partiendo de que ya tenemos creado un objecto MunicipioData previamente utilizamos el contexto
	public function update_active(){
		$sql = "update ".self::$tablename." set last_active_at=NOW() where id_municipio=$this->id_municipio";
		Executor::doit($sql);
	}


	public function update(){
		$sql = "update ".self::$tablename." set id_estado=\"$this->id_estado\",municipio=\"$this->municipio\" where id_municipio=$this->id_municipio";
		Executor::doit($sql);
	}


	public static function getBySQL($sql){
		$query = Executor::doit($sql);
		return Model::many($query[0],new MunicipioData());
	}


	public static function getById($id){
		$html = "";
		$con = Database::getCon();
		$query = $con->query("select * from ".self::$tablename." where id_municipio=$id");
		
		while($res = mysqli_fetch_array($query)){
			$resul[] = $res;
		  }

		// foreach($resul as $p):
		// 	$html.= "<option value='".$p['id_municipio']."'>".$p['municipio']."</option>";
        // endforeach;

		// return $html;
		return $resul;

	}


	public static function getById2($id){
		$sql = "select * from ".self::$tablename." where id_municipio=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new MunicipioData());
	}





	public static function getNameById($id){
		$name = "";
		$con = Database::getCon();
		$query = $con->query("select municipio from ".self::$tablename." where id_municipio=$id");
		
		while($res = mysqli_fetch_array($query)){
			$resul[] = $res;
		  }
	
		foreach($resul as $p):
			$name.= $p['municipio'];
		endforeach;
	
		return $name;
	}




	public static function getIdEstadoByIdMunic($id){
		$name = "";
		$con = Database::getCon();
		$query = $con->query("select id_estado from ".self::$tablename." where id_municipio=$id");
		
		while($res = mysqli_fetch_array($query)){
			$resul[] = $res;
		  }
	
		foreach($resul as $p):
			$name.= $p['id_estado'];
		endforeach;
	
		return $name;
	}


	public static function byEstado($id){
		$sql = "select * from ".self::$tablename." where id_estado=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new MunicipioData());

	}



	public static function getAll(){
		$sql = "select * from ".self::$tablename." order by id_municipio asc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new MunicipioData());
	}

	public static function getAllActive(){
		$sql = "select * from estados,interval 3 second)";
		$query = Executor::doit($sql);
		return Model::many($query[0],new MunicipioData());
	}

	public static function getAllUnActive(){
		$sql = "select * from estados ,interval 3 second)";
		$query = Executor::doit($sql);
		return Model::many($query[0],new MunicipioData());
	}




	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where estado like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new MunicipioData());
	}


	public static function getIdByName($name){
		$con = Database::getCon();
		$query = $con->query("select * from ".self::$tablename." where municipio='$name'");
		
		while($res = mysqli_fetch_array($query)){
			$resul[] = $res;
		}
		if(isset($resul)){
			return $resul;
		}else {
			return null;
		}
	}

}


    # ----------

		// $ID_estado = $_GET["ID_estado"];
		// $MunicipioData = new MunicipioData($ID_estado);



		// if ($ID_estado == 1){ 

		// 	// getById($ID_estado);
		// 	echo "Hooollaa";


		// }
			


?>