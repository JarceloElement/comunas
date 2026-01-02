<?php
#[AllowDynamicProperties]
class FinalUsersData
{
	public static $tablename = "final_users";

	public function __construct()
	{
		$this->id = "";
		$this->user_id = "";
		$this->user_type = "";
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
		$this->user_comunity_type = "";
		$this->user_etnia = "";
		$this->user_f_nacimiento = "";
		$this->user_edad = "";
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
		$this->profile_image = "";
		$this->user_equipo_sala_comunal = "";

	}



	public function add()
	{

		// if ($this->id_activity != null){
		// 	$activity = ReportActivityData::getById($this->id_activity);
		// 	$this->name_activity = $activity->activity_title;
		// }

		if (intval($this->user_estado) >= 1) {
			$estado_n = EstadoData::getById($this->user_estado);
			foreach ($estado_n as $p) :
				$this->estado_name = $p['estado'];
			endforeach;
		} else {
			$this->estado_name = $this->user_estado;
		}


		if (intval($this->user_municipio) >= 1) {
			$municipio_n = MunicipioData::getById($this->user_municipio);
			foreach ($municipio_n as $p) :
				$this->municipio_name = $p['municipio'];
			endforeach;
		} else {
			$this->municipio_name = $this->user_municipio;
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
		user_id, 
		user_type, 
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
		user_comunity_type, 
		user_etnia, 
		disability_type, 
		user_f_nacimiento, 
		user_edad, 
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
		profile_image,
		user_equipo_sala_comunal
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
		?,
		?
		) RETURNING id;";
		$values = [
			(int)$this->user_id,
			$this->user_type,
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
			$this->user_comunity_type,
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
			$this->user_equipo_sala_comunal
		];

		// echo implode(",",$values);
		return ExecutorPg::insert($sql, $values);
	}



	public static function delById($id)
	{
		$sql = "delete from " . self::$tablename . " where id=$id";
		Executor::doit($sql);
	}

	public function del()
	{
		$sql = "delete from " . self::$tablename . " where id=$this->id";
        return ExecutorPg::doit($sql);

	}

	public function delByIdActivity()
	{
		$sql = "delete from " . self::$tablename . " where id_activity=$this->id_activity";
		Executor::doit($sql);
	}

	// public function delByIdActivity($id){
	// 	$con = Database::getCon();
	// 	$query = "delete from ".self::$tablename." where id_activity=$id";
	// 	return $query;
	// }


	public function update()
	{

		if (intval($this->user_estado) >= 1) {
			$estado_n = EstadoData::getById($this->user_estado);
			foreach ($estado_n as $p) :
				$this->estado_name = $p['estado'];
			endforeach;
		} else {
			$this->estado_name = $this->user_estado;
		}


		if (intval($this->user_municipio) >= 1) {
			$municipio_n = MunicipioData::getById($this->user_municipio);
			foreach ($municipio_n as $p) :
				$this->municipio_name = $p['municipio'];
			endforeach;
		} else {
			$this->municipio_name = $this->user_municipio;
		}


		// if ($this->parish >= 1){
		// 	$parroquia_n = ParroquiaData::getById($this->parish);
		// 	foreach($parroquia_n as $p):
		// 		$this->parroquia_name = $p['parroquia'];
		// 	endforeach;
		// }else{$this->parroquia_name = $this->parish;}	


		$sql = "update " . self::$tablename . "
		set user_id = ?, 
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
		user_comunity_type = ?, 
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
		profile_image = ?,
		user_equipo_sala_comunal = ? 
		where id = ?;
		";
		$values = [
			(int)$this->user_id,
			$this->user_type,
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
			$this->user_comunity_type,
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
			$this->user_equipo_sala_comunal,
			(int)$this->id
		];

		// echo implode(",", $values);
		return ExecutorPg::update($sql, $values);
	}


	public static function getByIdPg($id)
	{
		$sql = "SELECT * from " . self::$tablename . " where id=".$id;
		$query = ExecutorPg::doit($sql);
		// return $query[0];
		$array = ModelPg::one($query[0][0], new FinalUsersData());
		if ($array->id == ""){
			return "null";
		}else{
			return $array;
		}
	}


	public static function getById($id)
	{
		$sql = "SELECT * from " . self::$tablename . " where id=$id";
		$query = ExecutorPg::doit($sql);
		$array = ModelPg::one($query[0][0], new FinalUsersData());
		if ($array->id == ""){
			return "null";
		}else{
			return $array;
		}
	}

	public static function getByUserId($id)
	{
		$sql = "SELECT * from " . self::$tablename . " where user_id=$id";
		$query = ExecutorPg::doit($sql);
		$array = ModelPg::one($query[0][0], new FinalUsersData());
		if ($array->id == ""){
			return "null";
		}else{
			return $array;
		}
	}


	public static function getRepeatedDni($dni){
		$sql = "SELECT * from ".self::$tablename." where user_dni='$dni' AND user_dni!='No cedulado' ";
		$query = ExecutorPg::doit($sql);
		$array = ModelPg::one($query[0][0], new FinalUsersData());
		if ($array->id == "") {
			return "null";
		} else {
			return $array;
		}
	}
	

	public static function getByIdActivity($id)
	{
		$sql = "SELECT * from " . self::$tablename . " where id_activity=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0], new FinalUsersData());
	}


	public static function getNameById($id)
	{
		$con = Database::getCon();
		$query = $con->query("select * from " . self::$tablename . " where id=$id");

		while ($res = mysqli_fetch_array($query)) {
			$resul[] = $res;
		}

		// foreach($resul as $p):
		// 	$html.= "<option value='".$p['id_municipio']."'>".$p['municipio']."</option>";
		// endforeach;

		// return $html;
		return $resul;
	}

	public static function getAll()
	{
		$sql = "SELECT * from " . self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0], new FinalUsersData());
	}

	public static function getLike($q)
	{
		$sql = "SELECT * from " . self::$tablename . " where name like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0], new FinalUsersData());
	}

	public static function getBySQL($sql)
	{
		$query = ExecutorPg::get($sql);
		return $query;
	}

	public static function getBySQLPg($sql)
	{
		$query = ExecutorPg::get($sql);
		return $query;
	}

	public static function getRepeated($document_number)
	{
		$sql = "SELECT * from " . self::$tablename . " where user_dni!='No cedulado' AND user_dni=\"$document_number\"";
		$query = Executor::doit($sql);
		return Model::one($query[0], new FinalUsersData());
	}

	public static function getByFinalUser($document_number, $user_id)
	{
		$sql = "SELECT * from " . self::$tablename . " where (user_dni!='No cedulado' AND user_dni=\"$document_number\") OR (user_id=\"$user_id\")";
		$query = Executor::doit($sql);
		return Model::one($query[0], new FinalUsersData());
	}

	public static function getRepeatedEmail($email)
	{
		$sql = "SELECT * from " . self::$tablename . " where user_correo!='' AND user_correo=\"$email\"";
		$query = Executor::doit($sql);
		return Model::one($query[0], new FinalUsersData());
	}



	// from services

	public static function getRepeatedFromServices($document_number, $user_f_id)
	{
		$sql = "SELECT * from " . self::$tablename . " where user_dni!='No cedulado' AND user_dni='$document_number' AND id!='$user_f_id' ";
		$query = ExecutorPg::doit($sql);
		// return $query;
		// return $sql;
		$array = ModelPg::one($query[0][0], new FinalUsersData());
		if ($array->id == ""){
			return "null";
		}else{
			return $array;
		}

	}


	public static function getRepeatedEmailFromServices($email, $user_f_id)
	{
		$sql = "SELECT * from " . self::$tablename . " where user_correo!='' AND user_correo='$email' AND id!='$user_f_id' ";
		// $query = Executor::doit($sql);

		// $conn = DatabasePg::connectPg();
		// $row_table = $conn->prepare($sql);
		// $row_table->execute();
		// $query = $row_table->fetchAll(PDO::FETCH_ASSOC);
		$query = ExecutorPg::doit($sql);
		// return $query;

		$array = ModelPg::one($query[0][0], new FinalUsersData());
		if ($array->id == ""){
			return "null";
		}else{
			return $array;
		}
	}

	public static function getRepeatedFromAjax($document_id, $parent_ref, $id_final_user, $user_nombres, $user_apellidos, $user_has_document, $user_f_nacimiento)
	{

		if ($id_final_user != "" && $id_final_user != "0") {
			$sql = "SELECT * from " . self::$tablename . " where id='$id_final_user'";
		} else if ($document_id != "" && $document_id != "No cedulado") {
			$sql = "SELECT * from " . self::$tablename . " where (user_dni='$document_id')";
		} else if ($parent_ref != "" && $parent_ref != "No aplica" && $parent_ref != "Falta") {
			$sql = "SELECT * from " . self::$tablename . " where (parent_ref='$parent_ref' and parent_ref!='' and parent_ref!='0' and parent_ref!='No aplica'and parent_ref!='Falta')";
		} else {
			$sql = "SELECT * from " . self::$tablename . " where (user_nombres='$user_nombres' and user_apellidos='$user_apellidos' and user_has_document='$user_has_document' and user_f_nacimiento='$user_f_nacimiento')";
		}

		$query = ExecutorPg::getAjax($sql)[0];
		return $query;
	}

	public static function getRepeatedFromUpdatePart($user_dni, $id_user_final, $parent_ref)
	{
		if ($id_user_final != "") {
			$sql = "SELECT * from " . self::$tablename . " where id='$id_user_final'";
		} else if ($user_dni != "") {
			$sql = "SELECT * from " . self::$tablename . " where user_dni='$user_dni'";
		} else {
			$sql = "SELECT * from " . self::$tablename . " where (parent_ref='$parent_ref' and parent_ref!='' and parent_ref!='0' and parent_ref!='No aplica')";
		}
		$query = ExecutorPg::get($sql);
		return $query[0][0];
	}






}
