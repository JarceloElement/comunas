<?php
 #[AllowDynamicProperties]

class StatusInfocentroData {
	public static $tablename = "status_type";


	public function __construct(){
		$this->status = "";
	}

	public function add(){
		$sql = "insert into status_type (status) ";
		$sql .= "value (\"$this->status\")";
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
		$sql = "update ".self::$tablename." set status=\"$this->status\" where id=$this->id";
		Executor::doit($sql);
	}

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new StatusInfocentroData());
	}

	public static function getAll(){
		$sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new StatusInfocentroData());

	}
	
	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where status like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new StatusInfocentroData());
	}

	public static function getBySQL($sql){
		$query = Executor::doit($sql);
		return Model::many($query[0],new StatusInfocentroData());
	}

}

?>