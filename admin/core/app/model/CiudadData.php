<?php
class CiudadData {
	public static $tablename = "ciudades";

	public $id_estado;
	public $id_ciudad;
	public $ciudad;
	public $capital;


	public function __construct(){
		$this->id_estado = "";
		$this->id_ciudad = "";
		$this->ciudad = "";
		$this->capital = "";
	}

	public function add(){
		$sql = "insert into ".self::$tablename." (id_estado,ciudad,capital) ";
		$sql .= "value (\"$this->id_estado\",\"$this->ciudad\",\"$this->capital\")";
		Executor::doit($sql);
	}

	public static function delById($id){
		$sql = "delete from ".self::$tablename." where id_ciudad=$id";
		Executor::doit($sql);
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where id_ciudad=$this->id_ciudad";
		Executor::doit($sql);
	}

// partiendo de que ya tenemos creado un objecto CiudadData previamente utilizamos el contexto
	public function update_active(){
		$sql = "update ".self::$tablename." set last_active_at=NOW() where id_ciudad=$this->id_ciudad";
		Executor::doit($sql);
	}


	public function update(){
		$sql = "update ".self::$tablename." set ciudad=\"$this->ciudad\",id_estado=\"$this->id_estado\",capital=\"$this->capital\" where id_ciudad=$this->id_ciudad";
		Executor::doit($sql);
	}

	public static function getById2($id){
		$sql = "select * from ".self::$tablename." where id_ciudad=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new CiudadData());
	}



	public static function getById($id){
		$con = Database::getCon();
		$query = $con->query("select * from ".self::$tablename." where id_ciudad=$id");
		
		while($res = mysqli_fetch_array($query)){
			$resul[] = $res;
		  }
	
		// foreach($resul as $p):
		// 	$html.= "<option value='".$p['id_municipio']."'>".$p['municipio']."</option>";
		// endforeach;
	
		// return $html;
		return $resul;
	}

	public static function getRepeated($id_estado,$ciudad){
		$con = Database::getCon();
		$query = $con->query("select * from ".self::$tablename." where id_estado=$id_estado and ciudad='$ciudad'");
		$resul = null;
		
		while($res = mysqli_fetch_array($query)){
			$resul[] = $res;
		  }
	
		return $resul;
	}


	public static function getAll(){
		$sql = "select * from ".self::$tablename." order by id_estado asc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new CiudadData());
	}

	public static function getAllActive(){
		$sql = "select * from estados,interval 3 second)";
		$query = Executor::doit($sql);
		return Model::many($query[0],new CiudadData());
	}

	public static function getAllUnActive(){
		$sql = "select * from estados ,interval 3 second)";
		$query = Executor::doit($sql);
		return Model::many($query[0],new CiudadData());
	}




	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where estado like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new CiudadData());
	}


}

?>