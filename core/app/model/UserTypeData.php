<?php
class UserTypeData {
	public static $tablename = "user_type";

	public function __construct(){
		$this->user_type = "";
		$this->user_type_name = "";
	}

	public function add(){
		$sql = "insert into user_type (user_type, user_type_name) ";
		$sql .= "value (\"$this->user_type\",\"$this->user_type_name\")";
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
		return Model::one($query[0],new UserTypeData());
	}


	public static function getNameById($id){
		$con = Database::getCon();
		$query = $con->query("select * from ".self::$tablename." where user_type=$id");
    
        foreach($query as $p):
            $active_name = $p["user_type_name"];
        endforeach;

		// foreach($resul as $p):
		// 	$html.= "<option value='".$p['id_municipio']."'>".$p['municipio']."</option>";
		// endforeach;
	
		// return $html;
		return $active_name;
	}
	
	public static function getAll(){
		$sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new UserTypeData());

	}
	
	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where user_type_name like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new UserTypeData());
	}

	public static function getBySQL($sql){
		$query = Executor::doit($sql);
		return Model::many($query[0],new UserTypeData());
	}

}

?>