<?php
 #[AllowDynamicProperties]

class OperativeInfoData {
	public static $tablename = "operative_info";


	public function __construct(){
		$this->operative_type = "";
	}

	public function add(){
		$sql = "insert into operative_info (operative_type) ";
		$sql .= "value (\"$this->operative_type\")";
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
		$sql = "update ".self::$tablename." set operative_type=\"$this->operative_type\" where id=$this->id";
		Executor::doit($sql);
	}

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new OperativeInfoData());
	}

	public static function getAll(){
		$sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new OperativeInfoData());

	}
	
	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where operative_type like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new OperativeInfoData());
	}

	public static function getBySQL($sql){
		$query = Executor::doit($sql);
		return Model::many($query[0],new OperativeInfoData());
	}
}

?>