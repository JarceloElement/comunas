<?php
 #[AllowDynamicProperties]
 class FinalUsersData {
	public static $tablename = "final_users";

	public function __construct(){
		$this->id = "";
		$this->user_id = "";
		$this->user_type = "1";
		$this->user_nombres = "";
		$this->user_nombre_2 = "";
		$this->user_apellidos = "";
		$this->user_apellido_2 = "";
		$this->user_nationality = "";
		$this->user_has_document = "";
		$this->user_dni = "";
		$this->parent_dni = "";
		$this->child_number = "";
		$this->parent_ref = "";
		$this->user_correo = "";
		$this->user_telefono = "";
		$this->user_genero = "";
		$this->user_etnia = "";
		$this->user_f_nacimiento = "";
		$this->user_edad = "";
		$this->user_comunity_type = "";
		$this->user_nivel_academ = "";
		$this->user_profesion = "";
		$this->user_ocupacion = "";
		$this->user_empleado = "";
		$this->user_institucion = "";
		$this->user_pertenece_organizacion = "";
		$this->user_organizacion = "";
		$this->user_estado = "";
		$this->user_municipio = "";
		$this->user_direccion = "";
		$this->disability_type = "";

		$this->red_x = "";
		$this->red_facebook = "";
		$this->red_instagram = "";
		$this->red_linkedin = "";
		$this->red_youtube = "";
		$this->red_tiktok = "";
		$this->red_whatsapp = "";
		$this->red_telegram = "";
		$this->red_snapchat = "";
		$this->red_pinterest = "";

		$this->profile_image = "root_profile.png";
	}

	



	public function add(){

		// if ($this->id_activity != null){
		// 	$activity = ReportActivityData::getById($this->id_activity);
		// 	$this->name_activity = $activity->activity_title;
		// }

		if ($this->user_estado != null){
			$estado_n = EstadoData::getById($this->user_estado);
			foreach($estado_n as $p):
				$this->estado_name = $p['estado'];
			endforeach;
		}	
		  
		if ($this->user_municipio != null){
			$municipio_n = MunicipioData::getById($this->user_municipio);
			foreach($municipio_n as $p):
				$this->municipio_name = $p['municipio'];
			endforeach;
		}

		// if ($this->parish != null){
		// 	$parroquia_n = ParroquiaData::getById($this->parish);
		// 	foreach($parroquia_n as $p):
		// 		$this->parroquia_name = $p['parroquia'];
		// 	endforeach;
		// }

		// if ($this->ciudad != null){
		// 	$ciudad_n = CiudadData::getById($this->ciudad);
		// 	foreach($ciudad_n as $p):
		// 		$this->ciudad_name = $p['ciudad'];
		// 	endforeach;
		// }

	

		$sql = "INSERT into final_users (
		user_type, 
		user_id, 
		user_nombres, 
		user_nombre_2, 
		user_apellidos,
		user_apellido_2,
		user_nationality, 
		user_has_document, 
		user_dni, 
		parent_dni, 
		child_number, 
		parent_ref, 
		user_correo, 
		user_telefono, 
		user_genero, 
		user_etnia, 
		disability_type, 
		user_f_nacimiento, 
		user_edad, 
		user_comunity_type, 
		user_nivel_academ, 
		user_profesion, 
		user_ocupacion, 
		user_empleado, 
		user_institucion, 
		user_pertenece_organizacion, 
		user_organizacion, 
		user_estado, 
		user_municipio,
		user_direccion,
		red_x,
		red_facebook,
		red_instagram,
		red_linkedin,
		red_youtube,
		red_tiktok,
		red_whatsapp,
		red_telegram,
		red_snapchat,
		red_pinterest,
		profile_image
			)";
		$sql .= " VALUES (
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?
			) RETURNING id;";
		$values = [
			$this->user_type,
			(int)$this->user_id,
			$this->user_nombres,
			$this->user_nombre_2,
			$this->user_apellidos,
			$this->user_apellido_2,
			$this->user_nationality,
			$this->user_has_document,
			$this->user_dni,
			$this->parent_dni,
			(int)$this->child_number,
			$this->parent_ref,
			$this->user_correo,
			$this->user_telefono,
			$this->user_genero,
			$this->user_etnia,
			$this->disability_type,
			$this->user_f_nacimiento,
			$this->user_edad,
			$this->user_comunity_type,
			$this->user_nivel_academ,
			$this->user_profesion,
			$this->user_ocupacion,
			$this->user_empleado,
			$this->user_institucion,
			$this->user_pertenece_organizacion,
			$this->user_organizacion,
			$this->estado_name,
			$this->municipio_name,
			$this->user_direccion,
			$this->red_x,
			$this->red_facebook,
			$this->red_instagram,
			$this->red_linkedin,
			$this->red_youtube,
			$this->red_tiktok,
			$this->red_whatsapp,
			$this->red_telegram,
			$this->red_snapchat,
			$this->red_pinterest,
			$this->profile_image
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

		if (intval($this->user_estado) >= 1){
			$estado_n = EstadoData::getById($this->user_estado);
			foreach($estado_n as $p):
				$this->estado_name = $p['estado'];
			endforeach;
		}else{$this->estado_name = $this->user_estado;}	
		  

		if (intval($this->user_municipio) >= 1){
			$municipio_n = MunicipioData::getById($this->user_municipio);
			foreach($municipio_n as $p):
				$this->municipio_name = $p['municipio'];
			endforeach;
		}else{$this->municipio_name = $this->user_municipio;}	
		

		// if ($this->parish >= 1){
		// 	$parroquia_n = ParroquiaData::getById($this->parish);
		// 	foreach($parroquia_n as $p):
		// 		$this->parroquia_name = $p['parroquia'];
		// 	endforeach;
		// }else{$this->parroquia_name = $this->parish;}	


	// 	$sql = " update ".self::$tablename." set 
	// 	user_id='$this->user_id',
	// 	user_type='$this->user_type',
	// 	user_nombres='$this->user_nombres',
	// 	user_nombre_2='$this->user_nombre_2',
	// 	user_apellidos='$this->user_apellidos',
	// 	user_apellido_2='$this->user_apellido_2',
	// 	user_nationality='$this->user_nationality',
	// 	user_has_document='$this->user_has_document',
	// 	user_dni='$this->user_dni',
	// 	parent_dni='$this->parent_dni',
	// 	child_number='$this->child_number',
	// 	parent_ref='$this->parent_ref',
	// 	user_correo='$this->user_correo',
	// 	user_telefono='$this->user_telefono',
	// 	user_genero='$this->user_genero',
	// 	user_etnia='$this->user_etnia',
	// 	disability_type='$this->disability_type',
	// 	user_f_nacimiento='$this->user_f_nacimiento',
	// 	user_edad='$this->user_edad',
	// 	user_nivel_academ='$this->user_nivel_academ',
	// 	user_profesion='$this->user_profesion',
	// 	user_ocupacion='$this->user_ocupacion',
	// 	user_empleado='$this->user_empleado',
	// 	user_institucion='$this->user_institucion',
	// 	user_pertenece_organizacion='$this->user_pertenece_organizacion',
	// 	user_organizacion='$this->user_organizacion',
	// 	user_estado='$this->estado_name',
	// 	user_municipio='$this->municipio_name',
	// 	user_direccion='$this->user_direccion',
	// 	red_x='$this->red_x',
	// 	red_facebook='$this->red_facebook',
	// 	red_instagram='$this->red_instagram',
	// 	red_linkedin='$this->red_linkedin',
	// 	red_youtube='$this->red_youtube',
	// 	red_tiktok='$this->red_tiktok',
	// 	red_whatsapp='$this->red_whatsapp',
	// 	red_telegram='$this->red_telegram',
	// 	red_snapchat='$this->red_snapchat',
	// 	red_pinterest='$this->red_pinterest'
	// 	where id=$this->id";
	// 	Executor::doit($sql);
	// }

		$sql = "UPDATE " . self::$tablename . " set 
		user_id = ?, 
		user_type = ?, 
		user_nombres = ?, 
		user_nombre_2 = ?, 
		user_apellidos = ?, 
		user_apellido_2 = ?, 
		user_nationality = ?, 
		user_has_document = ?, 
		user_dni = ?, 
		parent_dni = ?, 
		child_number = ?, 
		parent_ref = ?, 
		user_correo = ?, 
		user_telefono = ?, 
		user_genero = ?, 
		user_etnia = ?, 
		disability_type = ?, 
		user_f_nacimiento = ?, 
		user_edad = ?, 
		user_nivel_academ = ?, 
		user_profesion = ?, 
		user_ocupacion = ?, 
		user_empleado = ?, 
		user_institucion = ?, 
		user_pertenece_organizacion = ?, 
		user_organizacion = ?, 
		user_estado = ?, 
		user_municipio = ?, 
		user_direccion = ?, 
		red_x = ?, 
		red_facebook = ?, 
		red_instagram = ?, 
		red_linkedin = ?, 
		red_youtube = ?, 
		red_tiktok = ?, 
		red_whatsapp = ?, 
		red_telegram = ?, 
		red_snapchat = ?, 
		red_pinterest = ?, 
		profile_image = ? 
		where id = ?;";
		$values = [
			$this->user_id,
			$this->user_type,
			$this->user_nombres,
			$this->user_nombre_2,
			$this->user_apellidos,
			$this->user_apellido_2,
			$this->user_nationality,
			$this->user_has_document,
			$this->user_dni,
			$this->parent_dni,
			$this->child_number,
			$this->parent_ref,
			$this->user_correo,
			$this->user_telefono,
			$this->user_genero,
			$this->user_etnia,
			$this->disability_type,
			$this->user_f_nacimiento,
			$this->user_edad,
			$this->user_nivel_academ,
			$this->user_profesion,
			$this->user_ocupacion,
			$this->user_empleado,
			$this->user_institucion,
			$this->user_pertenece_organizacion,
			$this->user_organizacion,
			$this->estado_name,
			$this->municipio_name,
			$this->user_direccion,
			$this->red_x,
			$this->red_facebook,
			$this->red_instagram,
			$this->red_linkedin,
			$this->red_youtube,
			$this->red_tiktok,
			$this->red_whatsapp,
			$this->red_telegram,
			$this->red_snapchat,
			$this->red_pinterest,
			$this->profile_image,
			$this->id
		];
		ExecutorPg::update($sql, $values);
	}



	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new FinalUsersData());
	}


	public static function getByIdActivity($id){
		$sql = "select * from ".self::$tablename." where id_activity=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new FinalUsersData());
	}

	
	
	public static function getAll(){
		$sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new FinalUsersData());

	}

	public static function getBySQL($sql){
		$query = Executor::doit($sql);
		return Model::many($query[0],new FinalUsersData());
	}

	public static function getBySQLPg($sql)
	{
		$query = ExecutorPg::get($sql);
		return $query;
	}
	
	public static function getRepeatedDni($dni){
		$sql = "SELECT * from ".self::$tablename." where user_dni='$dni' AND user_dni!='No cedulado' ";
		$query = ExecutorPg::doit($sql);
		$array = ModelPg::one($query[0], new FinalUsersData());
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
		$array = ModelPg::one($query[0], new FinalUsersData());
		if ($array->id == "") {
			return "null";
		} else {
			return $array;
		}
	}

	public static function getRepeatedEmail($email){
		$sql = "select * from ".self::$tablename." where user_correo='$email'";
		$query = ExecutorPg::doit($sql);
		$array = ModelPg::one($query[0], new FinalUsersData());
		if ($array->id == "") {
			return "null";
		} else {
			return $array;
		}
	}

	public static function getByFinalUser($user_dni,$user_id,$user_email){
		$sql = "SELECT * from ".self::$tablename." where (user_id='$user_id') or (user_dni='$user_dni') or (user_dni='$user_dni' and user_correo='$user_email')";
		$query = ExecutorPg::doit($sql);
		$array = ModelPg::one($query[0], new FinalUsersData());
		if ($array->id == "") {
			return "null";
		} else {
			return $array;
		}
	}


	public static function getRepeatedParentRefUpdate($id,$dni){
		$sql = "SELECT * from ".self::$tablename." where id!='$id' AND parent_ref='$dni' AND user_dni='No cedulado' ";
		$query = ExecutorPg::doit($sql);
		$array = ModelPg::one($query[0], new FinalUsersData());
		if ($array->id == "") {
			return "null";
		} else {
			return $array;
		}
	}

	public static function getByUserId($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = ExecutorPg::doit($sql);
		$array = ModelPg::one($query[0], new FinalUsersData());
		if ($array->id == "") {
			return "null";
		} else {
			return $array;
		}
	}


}

?>