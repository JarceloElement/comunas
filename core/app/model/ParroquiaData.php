<?php
#[AllowDynamicProperties]
class ParroquiaData {
	public static $tablename = "parroquias";


	public function __construct(){
		$this->id_estado = "";
		$this->id_municipio = "";
		$this->parroquia = "";
	}


	public static function getRepeated($id_municipio,$name){
		$sql = "select * from ".self::$tablename." where id_municipio=\"$id_municipio\" and parroquia=\"$name\"";
		$query = Executor::doit($sql);
		return Model::one($query[0],new ParroquiaData());
	}


	public function add(){
		$sql = "insert into ".self::$tablename." (id_municipio,parroquia) ";
		$sql .= "value (\"$this->id_municipio\",\"$this->parroquia\")";
		Executor::doit($sql);
	}

	public static function delById($id){
		$sql = "delete from ".self::$tablename." where id_parroquia=$id";
		Executor::doit($sql);
	}
	
	public function del(){
		$sql = "delete from ".self::$tablename." where id_parroquia=$this->id_parroquia";
		Executor::doit($sql);
	}

// partiendo de que ya tenemos creado un objecto ParroquiaData previamente utilizamos el contexto
	public function update_active(){
		$sql = "update ".self::$tablename." set last_active_at=NOW() where id_parroquia=$this->id_parroquia";
		Executor::doit($sql);
	}


	public function update(){
		$sql = "update ".self::$tablename." set id_municipio=\"$this->id_municipio\",parroquia=\"$this->parroquia\" where id_parroquia=$this->id_parroquia";
		Executor::doit($sql);
	}

	public static function getById2($id){
		$sql = "select * from ".self::$tablename." where id_parroquia=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new ParroquiaData());
	}


	public static function getById($id){
		$con = Database::getCon();
		$query = $con->query("select * from ".self::$tablename." where id_parroquia=$id");
		
		while($res = mysqli_fetch_array($query)){
			$resul[] = $res;
		  }
	
		// foreach($resul as $p):
		// 	$html.= "<option value='".$p['id_municipio']."'>".$p['municipio']."</option>";
		// endforeach;
	
		// return $html;
		return $resul;
	}




	public static function getNameById($id){
		$name = "";
		$con = Database::getCon();
		$query = $con->query("select parroquia from ".self::$tablename." where id_parroquia=$id");
		
		while($res = mysqli_fetch_array($query)){
			$resul[] = $res;
		  }
	
		foreach($resul as $p):
			$name.= $p['parroquia'];
		endforeach;
	
		return $name;
	}




	public static function getBySQL($sql){
		$query = Executor::doit($sql);
		return Model::many($query[0],new ParroquiaData());
	}


	public static function getAll(){
		$sql = "select * from ".self::$tablename." order by id_parroquia asc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ParroquiaData());
	}

	public static function getAllActive(){
		$sql = "select * from estados,interval 3 second)";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ParroquiaData());
	}

	public static function getAllUnActive(){
		$sql = "select * from estados ,interval 3 second)";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ParroquiaData());
	}




	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where estado like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ParroquiaData());
	}


}

?>