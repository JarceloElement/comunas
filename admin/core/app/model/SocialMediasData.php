<?php
class SocialMediasData {
	public static $tablename = "social_medias";
	
	public $nombre;


	public function __construct(){
		$this->nombre = "";
	}

	public function add(){
		$sql = "INSERT into social_medias (nombre) ";
		$sql .= "values ('$this->nombre')";
		return ExecutorPg::doit($sql);
	}

	
	public static function delById($id){
		$sql = "delete from ".self::$tablename." where id=$id";
		Executor::doit($sql);
	}
	public static function del($id){
		$sql = "delete from ".self::$tablename." where id=$id";
		ExecutorPg::doit($sql);
	}


	// public function update(){
	// 	$sql = "update ".self::$tablename." set line_action=\"$this->line_action\" where StridategicActionData=$this->StridategicActionData";
	// 	Executor::doit($sql);
	// }


	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = ExecutorPg::doit($sql);
		return ModelPg::one($query[0],new SocialMediasData());
	}

	public static function getAll(){
		$sql = "select * from ".self::$tablename;
		$query = ExecutorPg::doit($sql);
		return ModelPg::many($query[0],new SocialMediasData());

	}
	
		public static function getByNombre($nombre){
		$sql = "select * from ".self::$tablename." where nombre='$nombre'";
		$query = ExecutorPg::doit($sql);
		return ModelPg::one($query[0],new SocialMediasData());
	}

	public static function getBySQL($sql)
	{
		$query = ExecutorPg::get($sql);
		return $query;
	}


	public static function specificActionById($sql){
		$query = Executor::doit($sql);
		return Model::one($query[0],new SocialMediasData());
	}
}

?>