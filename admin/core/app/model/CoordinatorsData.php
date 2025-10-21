<?php
#[AllowDynamicProperties]
class CoordinatorsData
{
	public static $tablename = "coordinators";

	public $id;
	public $f_state;
	public $f_name;
	public $f_lastname;
	public $document_number;
	public $phone_number;
	public $gender;
	public $email;
	public $info_cod;
	public $coordination;
	public $status_nom;
	public $personal_type;
	public $birthdate;
	public $date_admission;
	public $estate;
	public $municipality;
	public $parish;
	public $gerencia_tipo;
	public $pcta;
	public $fecha_tentativa;
	public $cargo;
	public $nivel_academico;
	public $prima_profesional;
	public $estatus;
	public $observations;
	public $date_update;
	public $coord_name;
	public $estado_name;
	public $municipio_name;
	public $parroquia_name;


	public function __construct()
	{
		$this->id = "";
		$this->f_state = "";
		$this->f_name = "";
		$this->f_lastname = "";
		$this->document_number = "";
		$this->phone_number = "";
		$this->gender = "";
		$this->email = "";
		$this->info_cod = "";
		$this->coordination = "";
		$this->status_nom = "";
		$this->personal_type = "";
		$this->birthdate = "";
		$this->date_admission = "";
		$this->estate = null;
		$this->municipality = null;
		$this->parish = null;
		$this->gerencia_tipo = null;
		$this->pcta = null;
		$this->fecha_tentativa = null;
		$this->cargo = null;
		$this->nivel_academico = null;
		$this->prima_profesional = null;
		$this->estatus = null;
		$this->observations = null;
		$this->date_update = null;
	}


	public function add()
	{


		if ($this->coordination != null) {
			$coord = CoordTypeData::getNameById($this->coordination);
			foreach ($coord as $p):
				$this->coord_name = $p['name'];
			endforeach;
		}

		if ($this->estate != null) {
			$estado_n = EstadoData::getById($this->estate);
			foreach ($estado_n as $p):
				$this->estado_name = $p['estado'];
			endforeach;
		}

		if ($this->municipality != null) {
			$municipio_n = MunicipioData::getById($this->municipality);
			foreach ($municipio_n as $p):
				$this->municipio_name = $p['municipio'];
			endforeach;
		}

		if ($this->parish != null) {
			$parroquia_n = ParroquiaData::getById($this->parish);
			foreach ($parroquia_n as $p):
				$this->parroquia_name = $p['parroquia'];
			endforeach;
		}

		// if ($this->ciudad != null){
		// 	$ciudad_n = CiudadData::getById($this->ciudad);
		// 	foreach($ciudad_n as $p):
		// 		$this->ciudad_name = $p['ciudad'];
		// 	endforeach;
		// }



		$sql = "insert into coordinators
         (name,
         lastname,
         document_number,
         phone_number,
         gender,
         email,
         coordination,
         status_nom,
         personal_type,
         birthdate,
         date_admission,
         estate,
         municipality,
         parish,
         observations ) ";
		$sql .= "value (
			\"$this->f_name\",
			\"$this->f_lastname\",
            \"$this->document_number\",
            \"$this->phone_number\",
            \"$this->gender\",
            \"$this->email\",
            \"$this->coord_name\",
            \"$this->status_nom\",
            \"$this->personal_type\",
            \"$this->birthdate\",
            \"$this->date_admission\",
            \"$this->estado_name\",
            \"$this->municipio_name\",
            \"$this->parroquia_name\",
            \"$this->observations\" )";
		return Executor::doit($sql);
	}



	public function addPg()
	{

		if ($this->f_state != null) {
			$estado_n = EstadoData::getById($this->f_state);
			foreach ($estado_n as $p):
				$this->estado_name = $p['estado'];
			endforeach;
		}

		if ($this->municipality != null) {
			$municipio_n = MunicipioData::getById($this->municipality);
			foreach ($municipio_n as $p):
				$this->municipio_name = $p['municipio'];
			endforeach;
		}

		if ($this->parish != null) {
			$parroquia_n = ParroquiaData::getById($this->parish);
			foreach ($parroquia_n as $p):
				$this->parroquia_name = $p['parroquia'];
			endforeach;
		}



		$sql = "INSERT into coordinators (
			f_name,
			f_lastname,
			document_number,
			phone_number,
			gender,
			email,
			info_cod,
			coordination,
			status_nom,
			personal_type,
			birthdate,
			date_admission,
			f_state,
			municipality,
			parish,
			gerencia_tipo,
			pcta,
			fecha_tentativa,
			cargo,
			nivel_academico,
			prima_profesional,
			estatus,
			observations,
			date_update
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
			?
			);";
		$values = [
			$this->f_name,
			$this->f_lastname,
			$this->document_number,
			$this->phone_number,
			$this->gender,
			$this->email,
			$this->info_cod,
			$this->coordination,
			$this->status_nom,
			$this->personal_type,
			$this->birthdate,
			$this->date_admission,
			$this->estado_name,
			$this->municipio_name,
			$this->parroquia_name,
			$this->gerencia_tipo,
			$this->pcta,
			$this->fecha_tentativa,
			$this->cargo,
			$this->nivel_academico,
			$this->prima_profesional,
			$this->estatus,
			$this->observations,
			$this->date_update
		];

		$resul = ExecutorPg::insert($sql, $values);
		return $resul;
	}



	public static function delById($id)
	{
		$sql = "delete from " . self::$tablename . " where id=$id";
		Executor::doit($sql);
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


	public function del()
	{
		$sql = "delete from " . self::$tablename . " where id=$this->id";
		return ExecutorPg::setSql($sql);
	}


	public function update()
	{

		if ($this->estate >= 1 and $this->estate <= 100) {
			$estado_n = EstadoData::getById($this->estate);
			foreach ($estado_n as $p):
				$this->estado_name = $p['estado'];
			endforeach;
		} else {
			$this->estado_name = $this->estate;
		}


		if ($this->municipality >= 1 and $this->municipality <= 1000) {
			$municipio_n = MunicipioData::getById($this->municipality);
			foreach ($municipio_n as $p):
				$this->municipio_name = $p['municipio'];
			endforeach;
		} else {
			$this->municipio_name = $this->municipality;
		}


		if ($this->parish >= 1 and $this->parish <= 1000) {
			$parroquia_n = ParroquiaData::getById($this->parish);
			foreach ($parroquia_n as $p):
				$this->parroquia_name = $p['parroquia'];
			endforeach;
		} else {
			$this->parroquia_name = $this->parish;
		}


		if ($this->coordination >= 1 and $this->coordination <= 100) {
			$coord = CoordTypeData::getNameById($this->coordination);
			foreach ($coord as $p):
				$this->coord_name = $p['name'];
			endforeach;
		} else {
			$this->coord_name = $this->coordination;
		}

		$sql = "update coordinators set 
		f_name=\"$this->f_name\", 
		f_lastname=\"$this->f_lastname\",
		document_number=\"$this->document_number\",
		phone_number=\"$this->phone_number\",
		gender=\"$this->gender\",
		email=\"$this->email\",
		info_cod=\"$this->info_cod\",
		coordination=\"$this->coordination\",
		status_nom=\"$this->status_nom\",
		personal_type=\"$this->personal_type\",
		birthdate=\"$this->birthdate\",
		date_admission=\"$this->date_admission\",
		estado_name=\"$this->estado_name\",
		municipio_name=\"$this->municipio_name\",
		parroquia_name=\"$this->parroquia_name\",
		gerencia_tipo=\"$this->gerencia_tipo\",
		pcta=\"$this->pcta\",
		fecha_tentativa=\"$this->fecha_tentativa\",
		cargo=\"$this->cargo\",
		nivel_academico=\"$this->nivel_academico\",
		prima_profesional=\"$this->prima_profesional\",
		estatus=\"$this->estatus\",
		observations=\"$this->observations\",
		date_update=\"$this->date_update\",
		where id=$this->id";

		return Executor::doit($sql);
	}




	public function updatePg()
	{

		// if (is_string($this->f_state)){

		if ((int)$this->f_state >= 1){
			$estado_n = EstadoData::getById($this->f_state);
			foreach($estado_n as $p):
				$this->estado_name = $p['estado'];
			endforeach;
		}else{$this->estado_name = $this->f_state;}	


		if ((int)$this->municipality >= 1){
			$municipio_n = MunicipioData::getById($this->municipality);
			foreach($municipio_n as $p):
				$this->municipio_name = $p['municipio'];
			endforeach;
		}else{$this->municipio_name = $this->municipality;}	


		if ((int)$this->parish >= 1){
			$parroquia_n = ParroquiaData::getById($this->parish);
			foreach($parroquia_n as $p):
				$this->parroquia_name = $p['parroquia'];
			endforeach;
		}else{$this->parroquia_name = $this->parish;}


		$sql = "update " . self::$tablename . " set 
		f_state = ?,
		municipality = ?,
		parish = ?,
		info_cod = ?,
		document_number = ?,
		f_name = ?,
		f_lastname = ?,
		gender = ?,
		phone_number = ?,
		email = ?,
		birthdate = ?,
		date_admission = ?,
		coordination = ?,
		status_nom = ?,
		personal_type = ?,
		gerencia_tipo = ?,
		pcta = ?,
		fecha_tentativa = ?,
		cargo = ?,
		nivel_academico = ?,
		prima_profesional = ?,
		estatus = ?,
		observations = ?,
		date_update  = ?
		where id = ?;
		";
		$values = [
			$this->estado_name,
			$this->municipio_name,
			$this->parroquia_name,
			$this->info_cod,
			$this->document_number,
			$this->f_name,
			$this->f_lastname,
			$this->gender,
			$this->phone_number,
			$this->email,
			$this->birthdate,
			$this->date_admission,
			$this->coordination,
			$this->status_nom,
			$this->personal_type,
			$this->gerencia_tipo,
			$this->pcta,
			$this->fecha_tentativa,
			$this->cargo,
			$this->nivel_academico,
			$this->prima_profesional,
			$this->estatus,
			$this->observations,
			$this->date_update,
			(int)$this->id
		];

		// return $sql;
		return ExecutorPg::update($sql, $values);
	}




	public function updatePgXLSX()
	{

		$sql = "update " . self::$tablename . " set 
		f_state = ?,
		municipality = ?,
		parish = ?,
		info_cod = ?,
		document_number = ?,
		f_name = ?,
		f_lastname = ?,
		gender = ?,
		phone_number = ?,
		email = ?,
		birthdate = ?,
		date_admission = ?,
		coordination = ?,
		status_nom = ?,
		personal_type = ?,
		gerencia_tipo = ?,
		pcta = ?,
		fecha_tentativa = ?,
		cargo = ?,
		nivel_academico = ?,
		prima_profesional = ?,
		estatus = ?,
		observations = ?,
		date_update  = ?
		where id = ?;
		";
		$values = [
			$this->f_state,
			$this->municipality,
			$this->parish,
			$this->info_cod,
			$this->document_number,
			$this->f_name,
			$this->f_lastname,
			$this->gender,
			$this->phone_number,
			$this->email,
			$this->birthdate,
			$this->date_admission,
			$this->coordination,
			$this->status_nom,
			$this->personal_type,
			$this->gerencia_tipo,
			$this->pcta,
			$this->fecha_tentativa,
			$this->cargo,
			$this->nivel_academico,
			$this->prima_profesional,
			$this->estatus,
			$this->observations,
			$this->date_update,
			(int)$this->id
		];

		// return $sql;
		return ExecutorPg::update($sql, $values);
	}





	public static function getById($id)
	{
		$sql = "select * from " . self::$tablename . " where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0], new CoordinatorsData());
	}


	public static function getByIdPg($id)
	{
		$sql = "select * from " . self::$tablename . " where id=$id";
		$query = ExecutorPg::doit($sql);
		$array = ModelPg::one($query[0][0], new CoordinatorsData());
		if ($array->id == "") {
			return "null";
		} else {
			return $array;
		}
	}

	public static function getAll()
	{
		$sql = "select * from " . self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0], new CoordinatorsData());
	}


	public static function getAllPg($sql)
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


	public static function getLike($q)
	{
		$sql = "select * from " . self::$tablename . " where name like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0], new CoordinatorsData());
	}

	public static function getBySQL($sql)
	{
		$query = Executor::doit($sql);
		return Model::many($query[0], new CoordinatorsData());
	}


	public static function getRepeated($document_number)
	{
		$sql = "select * from " . self::$tablename . " where document_number=\"$document_number\"";
		$query = Executor::doit($sql);
		return Model::one($query[0], new CoordinatorsData());
	}


	public static function getRepeatedPg($document_number)
	{
		$sql = "select * from " . self::$tablename . " where document_number='$document_number'";
		$query = ExecutorPg::doit($sql);
		$array = ModelPg::one($query[0][0], new CoordinatorsData());
		if ($array->id == "") {
			return "null";
		} else {
			return $array;
		}
	}


	public static function getByDniPg($dni)
	{
		$sql = "select * from " . self::$tablename . " where document_number='$dni' ";
		$query = ExecutorPg::doit($sql);
		// return $query;
		// return $sql;
		$array = ModelPg::one($query[0][0], new CoordinatorsData());
		if ($array->id == "") {
			return "null";
		} else {
			return $array;
		}
	}

}
