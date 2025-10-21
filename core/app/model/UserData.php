<?php
class UserData {
	public static $tablename = "user";

	public function __construct(){
		$this->name = "";
		$this->lastname = "";
		$this->username = "";
		$this->user_dni = "";
		$this->email = "";
		$this->password = "";
		$this->is_active = "1";
		$this->user_type = "1";
		$this->gender = "";
		$this->region = "";
		$this->code_info = "";
		$this->rol = "";
		$this->is_organization = "0";
		$this->organization_name = "";
		$this->created_at = "NOW()";
	}

	public function add(){
		$sql = "insert into ".self::$tablename." 
		(name,
		lastname,
		username,
		user_dni,
		email,
		password,
		is_active,
		user_type,
		gender,
		region,
		code_info,
		is_organization,
		organization_name,
		rol) ";
		$sql .= "value (\"$this->name\",
		\"$this->lastname\",
		\"$this->username\",
		\"$this->user_dni\",
		\"$this->email\",
		\"$this->password\",
		\"$this->is_active\",
		\"$this->user_type\",
		\"$this->gender\",
		\"$this->region\",
		\"$this->code_info\",
		\"$this->is_organization\",
		\"$this->organization_name\",
		\"$this->rol\")";
		Executor::doit($sql);
	}

	public static function delById($id){
		$sql = "delete from ".self::$tablename." where id=$id";
		Executor::doit($sql);
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where id=$this->id";
		Executor::doit($sql);
	}

// partiendo de que ya tenemos creado un objecto UserData previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set 
		name=\"$this->name\",
		lastname=\"$this->lastname\",
		email=\"$this->email\",
		username=\"$this->username\",
		user_dni=\"$this->user_dni\",
		is_active=\"$this->is_active\",
		user_type=\"$this->user_type\",
		gender=\"$this->gender\",
		region=\"$this->region\",
		code_info=\"$this->code_info\",
		is_organization=\"$this->is_organization\",
		organization_name=\"$this->organization_name\",
		rol=\"$this->rol\" 
		where id=$this->id";
		Executor::doit($sql);
	}

	public function update_passwd(){
		$sql = "update ".self::$tablename." set password=\"$this->password\" where id=$this->id";
		Executor::doit($sql);
	}

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new UserData());
	}



	public static function getAll(){
		$sql = "select * from ".self::$tablename." order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new UserData());
	}


	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where title like '%$q%' or content like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new UserData());
	}


	public static function getRepeated($user,$email){
		$sql = "select * from ".self::$tablename." where username=\"$user\" and email=\"$email\"";
		$query = Executor::doit($sql);
		return Model::one($query[0],new UserData());
	}

	public static function getRepeatedEmail($email){
		$sql = "select * from ".self::$tablename." where email=\"$email\"";
		$query = Executor::doit($sql);
		return Model::one($query[0],new UserData());
	}

	public static function getRepeatedUser($username){
		$sql = "select * from ".self::$tablename." where username=\"$username\"";
		$query = Executor::doit($sql);
		return Model::one($query[0],new UserData());
	}

	public static function getRepeatedDni($dni){
		$sql = "select * from ".self::$tablename." where user_dni=\"$dni\" ";
		$query = Executor::doit($sql);
		return Model::one($query[0],new UserData());
	}
	
	public static function getBySQL($sql){
		$query = Executor::doit($sql);
		return Model::many($query[0],new UserData());
	}
}

?>