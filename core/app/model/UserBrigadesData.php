<?php
 #[AllowDynamicProperties]
 class UserBrigadesData {
	public static $tablename = "user_brigades";

	public function __construct(){

		$this->id = "";
		$this->fk_id_user = "";
		$this->fk_id_brigade = "1";
		$this->municipio = "";
		$this->parroquia = "";
		$this->ciudad = "";
		$this->comunidad = "";
		$this->info_cod = "";

	}



	public function add(){

		if (intval($this->municipio) >= 1) {
			$municipio_n = MunicipioData::getById2($this->municipio);
			$this->municipio_name = $municipio_n->municipio;

		} else {
			$this->municipio_name = $this->municipio;
		}

		if (intval($this->parroquia) >= 1) {
			$parroquia_n = ParroquiaData::getById2($this->parroquia);
			$this->parroquia_name = $parroquia_n->parroquia;

		} else {
			$this->parroquia_name = $this->parroquia;
		}

		if (intval($this->ciudad) >= 1) {
			$ciudad_n = CiudadData::getById2($this->ciudad);
			$this->ciudad_name = $ciudad_n->ciudad;

		} else {
			$this->ciudad_name = $this->ciudad;
		}

		$sql = "INSERT into user_brigades (
		fk_id_user, 
		fk_id_brigade, 
		municipio, 
		parroquia, 
		ciudad,
		comunidad,
		info_cod
			)";
		$sql .= " VALUES (
			?,
			?,
			?,
			?,
			?,
			?,
			?
			) RETURNING id;";
		$values = [
			(int)$this->fk_id_user,
			(int)$this->fk_id_brigade,
			$this->municipio_name,
			$this->parroquia_name,
			$this->ciudad_name,
			$this->comunidad,
			$this->info_cod,

		];

		// echo implode(",",$values);
		$resul = ExecutorPg::insert($sql, $values);
		// return $resul[2]->lastInsertId('participants_list'.'_id_seq');
		return $resul;
	}



	public static function delById($id){
		$sql = "delete from ".self::$tablename." where id=$id";
		Executor::doit($sql);
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where id=$this->id";
		Executor::doit($sql);
	}

	public function delByIdActivity(){
		$sql = "delete from ".self::$tablename." where id_activity=$this->id_activity";
		Executor::doit($sql);
	}

	// public function delByIdActivity($id){
	// 	$con = Database::getCon();
	// 	$query = "delete from ".self::$tablename." where id_activity=$id";
	// 	return $query;
	// }

	public function update(){

		if (intval($this->municipio) >= 1) {
			$municipio_n = MunicipioData::getById2($this->municipio);
			$this->municipio_name = $municipio_n->municipio;

		} else {
			$this->municipio_name = $this->municipio;
		}

		if (intval($this->parroquia) >= 1) {
			$parroquia_n = ParroquiaData::getById2($this->parroquia);
			$this->parroquia_name = $parroquia_n->parroquia;

		} else {
			$this->parroquia_name = $this->parroquia;
		}

		if (intval($this->ciudad) >= 1) {
			$ciudad_n = CiudadData::getById2($this->ciudad);
			$this->ciudad_name = $ciudad_n->ciudad;

		} else {
			$this->ciudad_name = $this->ciudad;
		}

		$sql = "UPDATE " . self::$tablename . " set 
		fk_id_user = ?, 
		fk_id_brigade = ?, 
		municipio = ?, 
		parroquia = ?, 
		ciudad = ?,
		comunidad = ?,
		info_cod = ?
		where id = ?;";
		$values = [
			(int)$this->fk_id_user,
			(int)$this->fk_id_brigade,
			$this->municipio_name,
			$this->parroquia_name,
			$this->ciudad_name,
			$this->comunidad,
			$this->info_cod,
			$this->id
		];
		ExecutorPg::update($sql, $values);
	}



	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = ExecutorPg::doit($sql);
		return ModelPg::one($query[0],new UserBrigadesData());
	}


	public static function getByIdActivity($id){
		$sql = "select * from ".self::$tablename." where id_activity=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new UserBrigadesData());
	}

	
	
	public static function getAll(){
		$sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new UserBrigadesData());

	}

	public static function getBySQL($sql){
		$query = Executor::doit($sql);
		return Model::many($query[0],new UserBrigadesData());
	}

	public static function getBySQLPg($sql)
	{
		$query = ExecutorPg::get($sql);
		return $query;
	}
	
	public static function getRepeatedDni($dni){
		$sql = "SELECT * from ".self::$tablename." where user_dni='$dni' AND user_dni!='No cedulado' ";
		$query = ExecutorPg::doit($sql);
		$array = ModelPg::one($query[0], new UserBrigadesData());
		if ($array->id == "") {
			return "null";
		} else {
			return $array;
		}
	}

	public static function getByDni($dni){
		$sql = "SELECT * from ".self::$tablename." INNER JOIN final_users ON ".self::$tablename.".fk_id_user = final_users.id where final_users.user_dni='$dni' AND final_users.user_dni!='No cedulado' ";
		$query = ExecutorPg::doit($sql);
		$array = ModelPg::one($query[0], new UserBrigadesData());
		if ($array->id == "") {
			return "null";
		} else {
			return $array;
		}
	}

	public static function getByEmail($email){
		$sql = "SELECT * from ".self::$tablename." INNER JOIN final_users ON ".self::$tablename.".fk_id_user = final_users.id where final_users.user_correo='$email' AND final_users.user_correo!='' ";
		$query = ExecutorPg::doit($sql);
		$array = ModelPg::one($query[0], new UserBrigadesData());
		if ($array->id == "") {
			return "null";
		} else {
			return $array;
		}
	}

	public static function getByUID($user_id){
		$sql = "SELECT * from ".self::$tablename." INNER JOIN final_users ON ".self::$tablename.".fk_id_user = final_users.id where final_users.id=$user_id ";
		$query = ExecutorPg::doit($sql);
		$array = ModelPg::one($query[0], new UserBrigadesData());
		if ($array->id == "") {
			return "null";
		} else {
			return $array;
		}
	}

	public static function getRepeatedParentRef($dni){
		$sql = "SELECT * from ".self::$tablename." where parent_ref='$dni' AND user_dni='No cedulado' ";
		$query = ExecutorPg::doit($sql);
		// return $sql;
		// return $query[0];
		$array = ModelPg::one($query[0], new UserBrigadesData());
		if ($array->id == "") {
			return "null";
		} else {
			return $array;
		}
	}

	public static function getRepeatedEmail($email){
		$sql = "select * from ".self::$tablename." where user_correo='$email'";
		$query = ExecutorPg::doit($sql);
		$array = ModelPg::one($query[0], new UserBrigadesData());
		if ($array->id == "") {
			return "null";
		} else {
			return $array;
		}
	}

	public static function getByFinalUser($user_dni,$user_id,$user_email){
		$sql = "SELECT * from ".self::$tablename." where (user_id='$user_id') or (user_dni='$user_dni') or (user_dni='$user_dni' and user_correo='$user_email')";
		$query = ExecutorPg::doit($sql);
		$array = ModelPg::one($query[0], new UserBrigadesData());
		if ($array->id == "") {
			return "null";
		} else {
			return $array;
		}
	}


	public static function getRepeatedParentRefUpdate($id,$dni){
		$sql = "SELECT * from ".self::$tablename." where id!='$id' AND parent_ref='$dni' AND user_dni='No cedulado' ";
		$query = ExecutorPg::doit($sql);
		$array = ModelPg::one($query[0], new UserBrigadesData());
		if ($array->id == "") {
			return "null";
		} else {
			return $array;
		}
	}

	public static function getByUserId($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = ExecutorPg::doit($sql);
		$array = ModelPg::one($query[0], new UserBrigadesData());
		if ($array->id == "") {
			return "null";
		} else {
			return $array;
		}
	}

	


}

?>