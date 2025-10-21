<?php
 #[AllowDynamicProperties]

class InternetTypeData {
	public static $tablename = "internet_type";

	public function __construct(){
		$this->type = "";
	}

	public function add(){
		$sql = "insert into internet_type (type) ";
		$sql .= "value (\"$this->type\")";
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
		$sql = "update ".self::$tablename." set type=\"$this->type\" where id=$this->id";
		Executor::doit($sql);
	}

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new InternetTypeData());
	}

	public static function getAll(){
		$sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new InternetTypeData());

	}
	
	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where type like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new InternetTypeData());
	}

	public static function getBySQL($sql){
		$query = Executor::doit($sql);
		return Model::many($query[0],new InternetTypeData());
	}

}

?>