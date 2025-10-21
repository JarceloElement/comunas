<?php
class PersonalTypeData {
	public static $tablename = "personal_type";

	public function __construct(){
		$this->name = "";
	}

	public function add(){
		$sql = "insert into personal_type (type) ";
		$sql .= "value (\"$this->name\")";
		return Executor::doit($sql);
	}

	public static function delById($id){
		$sql = "delete from ".self::$tablename." where id=$id";
		Executor::doit($sql);
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where id=$this->id";
		Executor::doit($sql);
	}

	public function update(){
		$sql = "update ".self::$tablename." set name=\"$this->type\" where id=$this->id";
		Executor::doit($sql);
	}

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new PersonalTypeData());
	}


	public static function getNameById($id){
		$con = Database::getCon();
		$query = $con->query("select * from ".self::$tablename." where id=$id");
		
		while($res = mysqli_fetch_array($query)){
			$resul[] = $res;
		  }
	
		// foreach($resul as $p):
		// 	$html.= "<option value='".$p['id_municipio']."'>".$p['municipio']."</option>";
		// endforeach;
	
		// return $html;
		return $resul;
	}
	
	public static function getAll(){
		$sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new PersonalTypeData());

	}
	
	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where type like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new PersonalTypeData());
	}

	public static function getBySQL($sql){
		$query = Executor::doit($sql);
		return Model::many($query[0],new PersonalTypeData());
	}

}

?>