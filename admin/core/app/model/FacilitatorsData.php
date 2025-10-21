<?php
#[AllowDynamicProperties]
class FacilitatorsData
{
	public $id;
	public static $tablename = "facilitators";


	public $f_name;
	public $f_lastname;
	public $document_number;
	public $phone_number;
	public $gender;
	public $email;
	public $info_cod;
	public $status_nom;
	public $personal_type;
	public $birthdate;
	public $date_admission;
	public $f_state;
	public $municipality;
	public $parish;
	public $observations;

	public function __construct()
	{
		$this->id = "";
		$this->f_name = "";
		$this->f_lastname = "";
		$this->document_number = "";
		$this->phone_number = "";
		$this->gender = "";
		$this->email = "";
		$this->info_cod = "";
		$this->status_nom = "";
		$this->personal_type = "";
		$this->birthdate = "";
		$this->date_admission = "";
		$this->f_state = null;
		$this->municipality = null;
		$this->parish = null;
		$this->observations = null;
	}

	public function add()
	{


		// if ($this->linea_accion != null){
		// 	$lineas = ActionsLineData::getNameById($this->linea_accion);
		// 	foreach($lineas as $p):
		// 		$this->linea_name = $p['line_name'];
		// 	endforeach;
		// }	

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

		// if ($this->ciudad != null){
		// 	$ciudad_n = CiudadData::getById($this->ciudad);
		// 	foreach($ciudad_n as $p):
		// 		$this->ciudad_name = $p['ciudad'];
		// 	endforeach;
		// }



		$sql = "insert into facilitators
         (f_name,
         f_lastname,
         document_number,
         phone_number,
         gender,
         email,
         info_cod,
         status_nom,
         personal_type,
         birthdate,
         date_admission,
         f_state,
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
            \"$this->info_cod\",
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


		$sql = "INSERT into facilitators (
		f_name,
		f_lastname,
		document_number,
		phone_number,
		gender,
		email,
		info_cod,
		status_nom,
		personal_type,
		birthdate,
		date_admission,
		f_state,
		municipality,
		parish,
		observations
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
			$this->status_nom,
			$this->personal_type,
			$this->birthdate,
			$this->date_admission,
			$this->estado_name,
			$this->municipio_name,
			$this->parroquia_name,
			$this->observations
		];

		$resul = ExecutorPg::insert($sql, $values);
		// return $resul[2]->lastInsertId('participants_list'.'_id_seq');
		return $resul;
	}




	public static function delById($id)
	{
		$sql = "delete from " . self::$tablename . " where id=$id";
		Executor::doit($sql);
	}

	
	public function del()
	{
		$sql = "delete from " . self::$tablename . " where id=$this->id";
		return ExecutorPg::setSql($sql);
	}

	public function update()
	{

		// if ($this->estate >= 1){
		// 	$estado_n = EstadoData::getById($this->estate);
		// 	foreach($estado_n as $p):
		// 		$this->estado_name = $p['estado'];
		// 	endforeach;
		// }else{$this->estado_name = $this->estate;}	


		// if ($this->municipality >= 1){
		// 	$municipio_n = MunicipioData::getById($this->municipality);
		// 	foreach($municipio_n as $p):
		// 		$this->municipio_name = $p['municipio'];
		// 	endforeach;
		// }else{$this->municipio_name = $this->municipality;}	


		// if ($this->parish >= 1){
		// 	$parroquia_n = ParroquiaData::getById($this->parish);
		// 	foreach($parroquia_n as $p):
		// 		$this->parroquia_name = $p['parroquia'];
		// 	endforeach;
		// }else{$this->parroquia_name = $this->parish;}	


		$sql = "update facilitators set 
		f_name=\"$this->f_name\", 
		f_lastname=\"$this->f_lastname\", 
		document_number=\"$this->document_number\", 
		phone_number=\"$this->phone_number\", 
		gender=\"$this->gender\", 
		email=\"$this->email\", 
		info_cod=\"$this->info_cod\", 
		status_nom=\"$this->status_nom\", 
		personal_type=\"$this->personal_type\", 
		birthdate=\"$this->birthdate\", 
		date_admission=\"$this->date_admission\", 
		f_state=\"$this->f_state\", 
		municipality=\"$this->municipality\", 
		parish=\"$this->parish\", 
		observations=\"$this->observations\" 
		
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
		f_name = ?, 
		f_lastname = ?, 
		document_number = ?, 
		phone_number = ?, 
		gender = ?, 
		email = ?, 
		info_cod = ?, 
		status_nom = ?, 
		personal_type = ?, 
		birthdate = ?, 
		date_admission = ?, 
		f_state = ?, 
		municipality = ?, 
		parish = ?, 
		observations = ? 
		where id = ?;
		";
		$values = [
			$this->f_name,
			$this->f_lastname,
			$this->document_number,
			$this->phone_number,
			$this->gender,
			$this->email,
			$this->info_cod,
			$this->status_nom,
			$this->personal_type,
			$this->birthdate,
			$this->date_admission,
			$this->estado_name,
			$this->municipio_name,
			$this->parroquia_name,
			$this->observations,
			(int)$this->id
		];

		// return $sql;
		return ExecutorPg::update($sql, $values);
	}





	public function updatePgXLSX()
	{

		$sql = "update " . self::$tablename . " set 
		f_name = ?, 
		f_lastname = ?, 
		document_number = ?, 
		phone_number = ?, 
		gender = ?, 
		email = ?, 
		info_cod = ?, 
		status_nom = ?, 
		personal_type = ?, 
		birthdate = ?, 
		date_admission = ?, 
		f_state = ?, 
		municipality = ?, 
		parish = ?, 
		observations = ? 
		where id = ?;
		";
		$values = [
			$this->f_name,
			$this->f_lastname,
			$this->document_number,
			$this->phone_number,
			$this->gender,
			$this->email,
			$this->info_cod,
			$this->status_nom,
			$this->personal_type,
			$this->birthdate,
			$this->date_admission,
			$this->f_state,
			$this->municipality,
			$this->parish,
			$this->observations,
			(int)$this->id
		];

		// return $sql;
		return ExecutorPg::update($sql, $values);
	}




	public static function getById($id)
	{
		$sql = "select * from " . self::$tablename . " where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0], new FacilitatorsData());
	}

	public static function getByIdPg($id)
	{
		$sql = "select * from " . self::$tablename . " where id=$id";
		$query = ExecutorPg::doit($sql);
		// return $query;
		// return $sql;
		$array = ModelPg::one($query[0][0], new FacilitatorsData());
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
		return Model::many($query[0], new FacilitatorsData());
	}

	public static function getLike($q)
	{
		$sql = "select * from " . self::$tablename . " where f_name like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0], new FacilitatorsData());
	}

	public static function getBySQL($sql)
	{
		$query = Executor::doit($sql);
		return Model::many($query[0], new FacilitatorsData());
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

	public static function getRepeated($document_number)
	{
		$sql = "select * from " . self::$tablename . " where document_number=\"$document_number\"";
		$query = Executor::doit($sql);
		return Model::one($query[0], new FacilitatorsData());
	}


	public static function getRepeatedPg($document_number)
	{
		$sql = "select * from " . self::$tablename . " where document_number='$document_number'";
		$query = ExecutorPg::doit($sql);
		// return $query;
		// return $sql;
		$array = ModelPg::one($query[0][0], new FacilitatorsData());
		if ($array->id == "") {
			return "null";
		} else {
			return $array;
		}
	}

	public static function getByDni($dni)
	{
		$sql = "select * from " . self::$tablename . " where document_number=\"$dni\"";
		$query = Executor::doit($sql);
		return Model::one($query[0], new FacilitatorsData());
	}

	public static function getByDniPg($dni)
	{
		$sql = "select * from " . self::$tablename . " where document_number='$dni' ";
		$query = ExecutorPg::doit($sql);
		// return $query;
		// return $sql;
		$array = ModelPg::one($query[0][0], new FacilitatorsData());
		if ($array->id == "") {
			return "null";
		} else {
			return $array;
		}
	}
}
