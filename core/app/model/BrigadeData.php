<?php
#[AllowDynamicProperties]

class BrigadeData
{
	public static $tablename = "brigades";

	public function __construct()
	{
		$this->id = "";
		$this->nombre = "";
		$this->estado = "";
		$this->info_id = "";
		$this->info_cod = "";
		$this->datetime = "";
	}


	public function add()
	{

		$sql = "INSERT into brigades (
		nombre, 
		estado,
        info_id, 
		info_cod
			)";
		$sql .= " VALUES (
			?,
			?,
			?,
			?
			) RETURNING id;";
		$values = [
			$this->nombre,
			$this->estado,
			$this->info_id,
			$this->info_cod,
		];

		return ExecutorPg::insert($sql, $values);
	}


	public static function getByIdPg($id)
	{
		$sql = "SELECT * from " . self::$tablename . " where id=" . $id;
		$query = ExecutorPg::doit($sql);
		// return $query[0];
		$array = ModelPg::one($query[0][0], new ServicesUsersData());
		if ($array->id == "") {
			return "null";
		} else {
			return $array;
		}
	}


	public static function delById($id)
	{
		$sql = "delete from " . self::$tablename . " where id=$id";
		Executor::doit($sql);
	}
	
	public function del()
	{
		$sql = "delete from " . self::$tablename . " where id=$this->id";

		ExecutorPg::doit($sql);
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

		// if ($this->user_estado >= 1){
		// 	$estado_n = EstadoData::getById($this->user_estado);
		// 	foreach($estado_n as $p):
		// 		$this->estado_name = $p['estado'];
		// 	endforeach;
		// }else{$this->estado_name = $this->user_estado;}	


		// if ($this->user_municipio >= 1){
		// 	$municipio_n = MunicipioData::getById($this->user_municipio);
		// 	foreach($municipio_n as $p):
		// 		$this->municipio_name = $p['municipio'];
		// 	endforeach;
		// }else{$this->municipio_name = $this->user_municipio;}	


		// if ($this->parish >= 1){
		// 	$parroquia_n = ParroquiaData::getById($this->parish);
		// 	foreach($parroquia_n as $p):
		// 		$this->parroquia_name = $p['parroquia'];
		// 	endforeach;
		// }else{$this->parroquia_name = $this->parish;}	


		$sql = "update " . self::$tablename . " set 
		user_id=\"$this->user_id\",
		user_info_cod=\"$this->user_info_cod\",
		user_nombres=\"$this->user_nombres\",
		user_apellidos=\"$this->user_apellidos\",
		user_dni=\"$this->user_dni\",
		user_correo=\"$this->user_correo\",
		user_telefono=\"$this->user_telefono\",
		user_genero=\"$this->user_genero\",
		user_comunity_type='$this->user_comunity_type',
		user_pertenece_organizacion='$this->user_pertenece_organizacion',
		disability_type=\"$this->user_disability_type\",
		user_f_nacimiento=\"$this->user_f_nacimiento\",
		user_edad=\"$this->user_edad\",
		user_nivel_academ=\"$this->user_nivel_academ\",
		user_profesion=\"$this->user_profesion\",
		user_ocupacion=\"$this->user_ocupacion\",
		user_empleado=\"$this->user_empleado\",
		user_institucion=\"$this->user_institucion\",
		user_estado=\"$this->user_estado\",
		user_municipio=\"$this->user_municipio\",
		user_direccion=\"$this->user_direccion\",
		user_tipo_servicio=\"$this->user_tipo_servicio\",
		user_fecha_servicio=\"$this->user_fecha_servicio\",
		user_name_os=\"$this->user_name_os\"
		where id=$this->id";
		Executor::doit($sql);
	}

	public static function getById($id)
	{
		$sql = "select * from " . self::$tablename . " where id=$id";
		$query = ExecutorPg::doit($sql);
		return ModelPg::one($query[0][0], new BrigadeData());
	}


	public static function getByIdActivity($id)
	{
		$sql = "select * from " . self::$tablename . " where id_activity=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0], new ServicesUsersData());
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
		return Model::many($query[0], new ServicesUsersData());
	}

	public static function getLike($q)
	{
		$sql = "select * from " . self::$tablename . " where name like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0], new ServicesUsersData());
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

	public static function getBySQLPg($sql)
	{
		$query = ExecutorPg::get($sql);
		return $query;
	}


	public static function getRepeated($document_number)
	{
		$sql = "select * from " . self::$tablename . " where user_dni=\"$document_number\"";
		$query = Executor::doit($sql);
		return Model::one($query[0], new ServicesUsersData());
	}
}
