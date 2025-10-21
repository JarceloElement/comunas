<?php
#[AllowDynamicProperties]

class ParticipantsData
{
	public static $tablename = "participants_list";

	public function __construct()
	{
		$this->id = "";
		$this->id_user_final = "";
		$this->id_activity = "";
		$this->uid_fac = "";
		$this->name_activity = "";
		$this->date_activity = "";
		$this->estate = "";
		$this->info_id = "";
		$this->code_info = "";
		$this->name = "";
		$this->name_2 = "";
		$this->lastname = "";
		$this->lastname_2 = "";
		$this->user_nationality = "";
		$this->user_has_document = "";
		$this->document_id = "";
		$this->parent_dni = "";
		$this->child_number = "";
		$this->parent_ref = "";
		$this->user_f_nacimiento = "";
		$this->age = "";
		$this->gender = "";
		$this->user_comunity_type = "";
		$this->user_pertenece_organizacion = "";
		$this->phone = "";
		$this->email = "";
		$this->etnia = "";
		$this->line_action = "";
		$this->report_type = "";
		$this->disability_type = "";
		$this->equipo_sala_comunal = "";
	}


	public function add()
	{

		if ($this->id_activity != null) {
			$activity = ReportActivityData::getById($this->id_activity);
			$this->name_activity = $activity["activity_title"];
		}


		$sql = "INSERT into participants_list (
			id_user_final, 
			id_activity, 
			uid_fac, 
			line_action, 
			report_type, 
			name_activity, 
			date_activity, 
			estate, 
			info_id, 
			code_info, 
			name, 
			name_2, 
			lastname, 
			lastname_2, 
			user_nationality, 
			user_has_document, 
			document_id, 
			parent_dni, 
			child_number, 
			parent_ref, 
			user_f_nacimiento, 
			age, 
			gender, 
			user_comunity_type, 
			user_pertenece_organizacion, 
			phone, 
			email, 
			etnia, 
			disability_type,
			equipo_sala_comunal
			) ";
		$sql .= "value (
			'$this->id_user_final',
			'$this->id_activity',
			'$this->uid_fac',
			'$this->line_action',
			'$this->report_type',
			'$this->name_activity',
			'$this->date_activity',
			'$this->estate',
			'$this->info_id',
			'$this->code_info',
			'$this->name',
			'$this->name_2',
			'$this->lastname',
			'$this->lastname_2',
			'$this->user_nationality',
			'$this->user_has_document',
			'$this->document_id',
			'$this->parent_dni',
			'$this->child_number',
			'$this->parent_ref',
			'$this->user_f_nacimiento',
			'$this->age',
			'$this->gender',
			'$this->user_comunity_type',
			'$this->user_pertenece_organizacion',
			'$this->phone',
			'$this->email',
			'$this->etnia',
			'$this->disability_type',
			'$this->equipo_sala_comunal'
			)";
		return Executor::doit($sql);
	}





	public function add_Pg()
	{

		if ($this->id_activity != null) {
			$activity = ReportActivityData::getByIdPg((int)$this->id_activity);
			$this->name_activity = $activity["activity_title"];
		}


		$sql = "INSERT into participants_list (
			id_user_final, 
			id_activity, 
			uid_fac, 
			line_action, 
			report_type, 
			name_activity, 
			date_activity, 
			estate, 
			info_id, 
			code_info, 
			name, 
			name_2, 
			lastname, 
			lastname_2, 
			user_nationality, 
			user_has_document, 
			document_id, 
			parent_dni, 
			child_number, 
			parent_ref, 
			user_f_nacimiento, 
			age, 
			gender, 
			user_comunity_type, 
			user_pertenece_organizacion, 
			phone, 
			email, 
			etnia, 
			disability_type,
			equipo_sala_comunal
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
			?
			);";
		$values = [
			$this->id_user_final,
			(int)$this->id_activity,
			$this->uid_fac,
			$this->line_action,
			$this->report_type,
			$this->name_activity,
			$this->date_activity,
			$this->estate,
			(int)$this->info_id,
			$this->code_info,
			$this->name,
			$this->name_2,
			$this->lastname,
			$this->lastname_2,
			$this->user_nationality,
			$this->user_has_document,
			$this->document_id,
			$this->parent_dni,
			(int)$this->child_number,
			$this->parent_ref,
			$this->user_f_nacimiento,
			$this->age,
			$this->gender,
			$this->user_comunity_type,
			$this->user_pertenece_organizacion,
			$this->phone,
			$this->email,
			$this->etnia,
			$this->disability_type,
			$this->equipo_sala_comunal
		];

		// echo implode(",",$values);
		$resul = ExecutorPg::insert($sql, $values);
		// return $resul[2]->lastInsertId('participants_list'.'_id_seq');
		return $resul;
	}




	public static function delByIdPg($id)
	{
		$sql = "delete from " . self::$tablename . " where id= ?;";
        return ExecutorPg::del($sql,$id);
	}


	public function del()
	{
		$sql = "delete from " . self::$tablename . " where id=$this->id";
		Executor::doit($sql);
	}

	public function delByIdActivity()
	{
		// $sql = "delete from " . self::$tablename . " where id_activity=$this->id_activity";
		// Executor::doit($sql);

		$sql = "delete from " . self::$tablename . " where id= ?;";
        return ExecutorPg::del($sql,(int)$this->id_activity);
	}

	// public function delByIdActivity($id){
	// 	$con = Database::getCon();
	// 	$query = "delete from ".self::$tablename." where id_activity=$id";
	// 	return $query;
	// }



	public function update()
	{
		$sql = "update " . self::$tablename . " set 
		id_user_final = ?, 
		name = ?, 
		name_2 = ?, 
		lastname = ?, 
		lastname_2 = ?, 
		user_nationality = ?, 
		user_has_document = ?, 
		document_id = ?, 
		parent_dni = ?, 
		child_number = ?, 
		parent_ref = ?, 
		user_f_nacimiento = ?, 
		age = ?, 
		email = ?, 
		gender = ?, 
		user_comunity_type = ?, 
		user_pertenece_organizacion = ?, 
		phone = ?, 
		estate = ?, 
		etnia = ?, 
		date_activity = ?, 
		disability_type = ?,
		equipo_sala_comunal = ? 
		where id = ?;
		";
		$values = [
			$this->id_user_final,
			$this->name,
			$this->name_2,
			$this->lastname,
			$this->lastname_2,
			$this->user_nationality,
			$this->user_has_document,
			$this->document_id,
			$this->parent_dni,
			(int)$this->child_number,
			$this->parent_ref,
			$this->user_f_nacimiento,
			(int)$this->age,
			$this->email,
			$this->gender,
			$this->user_comunity_type,
			$this->user_pertenece_organizacion,
			$this->phone,
			$this->estate,
			$this->etnia,
			$this->date_activity,
			$this->disability_type,
			$this->equipo_sala_comunal,
			(int)$this->id
		];

		// echo implode(",", $values);
		return ExecutorPg::update($sql, $values);



	}

	public static function getById($id)
	{
		$sql = "select * from " . self::$tablename . " where id=$id";
		// $query = Executor::doit($sql);
		// return Model::one($query[0], new ParticipantsData());
        return ExecutorPg::get($sql);

	}

	public static function getByIdInner($id)
	{

		$sql = "SELECT 
		participants_list.id_activity, 
		participants_list.id_user_final, 
		participants_list.date_activity, 
		participants_list.name, 
		participants_list.name_2, 
		participants_list.lastname, 
		participants_list.lastname_2, 
		participants_list.user_nationality, 
		participants_list.user_has_document, 
		participants_list.document_id, 
		participants_list.parent_dni, 
		participants_list.child_number, 
		participants_list.parent_ref, 
		participants_list.user_f_nacimiento, 
		participants_list.gender, 
		participants_list.user_comunity_type, 
		participants_list.user_pertenece_organizacion, 
		participants_list.phone, 
		participants_list.email, 
		participants_list.etnia, 
		participants_list.estate, 
		participants_list.disability_type, 
		participants_list.equipo_sala_comunal, 
		final_users.user_profesion, 
		final_users.user_ocupacion, 
		final_users.user_estado 
		from participants_list 
		LEFT JOIN final_users on (participants_list.id_user_final)::int  = final_users.id 
		where participants_list.id=".(int)$id;
		return ExecutorPg::get($sql)[0][0];

	}


	public static function getByIdActivity($id)
	{
		$sql = "select * from " . self::$tablename . " where id_activity=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0], new ParticipantsData());
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
		$sql = "select * from " . self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0], new ParticipantsData());
	}

	public static function getLike($q)
	{
		$sql = "select * from " . self::$tablename . " where name like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0], new ParticipantsData());
	}

	public static function getBySQL($sql)
	{

		$conn = DatabasePg::connectPg();

		if (Core::$debug_sql) {
			print "<pre>" . $sql . "</pre>";
		}
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$TotalReg = $stmt->rowCount();
		return array($data, $TotalReg);
	}

	public static function getRepeated($id)
	{
		$sql = "select * from " . self::$tablename . " where id=\"$id\"";
		$query = Executor::doit($sql);
		return Model::one($query[0], new ParticipantsData());
	}
}
