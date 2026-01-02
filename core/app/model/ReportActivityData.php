<?php
#[AllowDynamicProperties]

class ReportActivityData
{
	public static $tablename = "reports";


	public function __construct()
	{
		$this->location = "";
		$this->id = "";
		$this->status_activity = 1;
		$this->code_info = null;
		$this->user_id = null;

		$this->line_action = "";
		$this->report_type = "";
		$this->specific_action = "";
		$this->training_type = "";
		$this->training_level = "";

		$this->activity_title = "";
		$this->address = "";
		$this->responsible_name = "";
		$this->responsible_phone = "";
		$this->responsible_type = "";
		$this->responsible_dni = "";
		$this->responsible_email = "";
		$this->personal_type = "";
		$this->date_pub = "";

		$this->developed_content = "";
		$this->training_modality = "";
		$this->duration_days = "";
		$this->duration_hour = "";

		$this->person_fe = "";
		$this->person_ma = "";
		$this->institutions = "";
		$this->observations = "";
		$this->name_os = "";

		$this->estate = null;
		$this->city = null;
		$this->municipality = null;
		$this->parish = null;
		$this->image = "";
		$this->file_name = "";


		$this->linea_name = null;
		$this->estado_name = null;
		$this->municipio_name = null;
		$this->parroquia_name = null;
		$this->ciudad_name = null;

		$this->total_person = null;
		$this->update_type = null;
		$this->perso_gender = null;
		$this->id_activity = null;
		$this->notific = null;
	}




	public function add()
	{

		if ($this->code_info == null || $this->code_info == "") {
			return Core::redir($_GET['location'] . "&swal=Debes colocar un código válido para crear el registro.");
		}
		// if ($this->line_action != null){
		// 	$lineas = ActionsLineData::getNameById($this->line_action);
		// 	foreach($lineas as $p):
		// 		$this->linea_name = $p['line_name'];
		// 	endforeach;
		// }	

		// if ($this->estate != null){
		// 	$estado_n = EstadoData::getById($this->estate);
		// 	foreach($estado_n as $p):
		// 		$this->estado_name = $p['estado'];
		// 	endforeach;
		// }	

		// if ($this->municipality != null){
		// 	$municipio_n = MunicipioData::getById($this->municipality);
		// 	foreach($municipio_n as $p):
		// 		$this->municipio_name = $p['municipio'];
		// 	endforeach;
		// }

		// if ($this->parish != null){
		// 	$parroquia_n = ParroquiaData::getById($this->parish);
		// 	foreach($parroquia_n as $p):
		// 		$this->parroquia_name = $p['parroquia'];
		// 	endforeach;
		// }

		// if ($this->city != null){
		// 	$ciudad_n = CiudadData::getById($this->city);
		// 	foreach($ciudad_n as $p):
		// 		$this->ciudad_name = $p['ciudad'];
		// 	endforeach;
		// }


		$sql = "insert into reports
		 (code_info,
		 user_id,
		 line_action,
		 report_type,
		 specific_action,
		 training_type,
         activity_title,
         responsible_name,
         responsible_phone,
         responsible_type,
		 responsible_dni,
		 responsible_email,
		 personal_type,
		 date_pub,
         developed_content,
         training_modality,
         duration_days,
		 duration_hour,
         person_fe,
         person_ma,
         institutions,
         name_os,
         observations,
         notific,
         estate,
         municipality,
         parish,
         city,
         address,
		 image,
		 file ) ";
		$sql .= "value (
            '$this->code_info',
            '$this->user_id',
            '$this->line_action',
            '$this->report_type',
            '$this->specific_action',
            '$this->training_type',
            '$this->training_level',
            '$this->activity_title',
            '$this->responsible_name',
            '$this->responsible_phone',
            '$this->responsible_type',
            '$this->responsible_dni',
            '$this->responsible_email',
            '$this->personal_type',
			'$this->date_pub',
			'$this->developed_content',
			'$this->training_modality',
			'$this->duration_days',
			'$this->duration_hour',
            '$this->person_fe',
            '$this->person_ma',
            '$this->institutions',
            '$this->name_os',
            '$this->observations',
            '$this->notific',
            '$this->estate',
            '$this->municipality',
            '$this->parish',
            '$this->city',
            '$this->address',
            '$this->image',
            '$this->file_name' )";
		return Executor::doit($sql);
	}


	public static function delById($id)
	{
		$sql = "delete from " . self::$tablename . " where id=$id";
		Executor::doit($sql);
	}
	public function del()
	{
		$sql = "delete from " . self::$tablename . " where id=$this->id";
		Executor::doit($sql);
	}

	public function update()
	{

		// if ($this->line_action >= 1 and $this->line_action <= 100){
		// 	$lineas = ActionsLineData::getNameById($this->line_action);
		// 	foreach($lineas as $p):
		// 		$this->linea_name = $p['line_name'];
		// 	endforeach;
		// }else{$this->linea_name = $this->line_action;}	


		if ($this->estate >= 1 and $this->estate <= 100) {
			$estado_n = EstadoData::getById($this->estate);
			foreach ($estado_n as $p) :
				$this->estado_name = $p['estado'];
			endforeach;
		} else {
			$this->estado_name = $this->estate;
		}


		if ($this->municipality >= 1 and $this->municipality <= 1000) {
			$municipio_n = MunicipioData::getById($this->municipality);
			foreach ($municipio_n as $p) :
				$this->municipio_name = $p['municipio'];
			endforeach;
		} else {
			$this->municipio_name = $this->municipality;
		}


		if ($this->parish >= 1 and $this->parish <= 1000) {
			$parroquia_n = ParroquiaData::getById($this->parish);
			foreach ($parroquia_n as $p) :
				$this->parroquia_name = $p['parroquia'];
			endforeach;
		} else {
			$this->parroquia_name = $this->parish;
		}


		if ($this->city >= 1 and $this->city <= 1000) {
			$ciudad_n = CiudadData::getById($this->city);
			foreach ($ciudad_n as $p) :
				$this->ciudad_name = $p['ciudad'];
			endforeach;
		} else {
			$this->ciudad_name = $this->city;
		}



		$sql = "UPDATE reports set 
		 status_activity='$this->status_activity', 
		 code_info='$this->code_info', 
		 user_id='$this->user_id', 
		 line_action='$this->line_action', 
		 report_type='$this->report_type', 
		 specific_action='$this->specific_action', 
		 training_type='$this->training_type', 
		 training_level='$this->training_level', 
         activity_title='$this->activity_title', 
         responsible_name='$this->responsible_name', 
         responsible_phone='$this->responsible_phone', 
         responsible_type='$this->responsible_type', 
         responsible_dni='$this->responsible_dni', 
         responsible_email='$this->responsible_email', 
         personal_type='$this->personal_type', 
         date_pub='$this->date_pub', 
         developed_content='$this->developed_content', 
         training_modality='$this->training_modality', 
         duration_days='$this->duration_days', 
         duration_hour='$this->duration_hour', 
         institutions='$this->institutions', 
         name_os='$this->name_os', 
         observations='$this->observations', 
         notific='$this->notific', 
         estate='$this->estado_name', 
         municipality='$this->municipio_name', 
         parish='$this->parroquia_name', 
         city='$this->ciudad_name',
         address='$this->address',
         image='$this->image', 
         file='$this->file_name' 
		 where id=$this->id ";


		return Executor::doit($sql);
	}



	public function update_participant_fe_add()
	{

		$conn = DatabasePg::connectPg();
		$row = $conn->prepare("SELECT COUNT(*) as total from participants_list where gender='Mujer' and id_activity='".$this->id_activity."'");
		$row->execute();
		$total_data = $row->fetchAll(PDO::FETCH_ASSOC);
		$total_person = $total_data[0]["total"];

		$sql = "update " . self::$tablename . "	set person_fe = ? where id = ?;";
		$values = [(int)$total_person, (int)$this->id_activity];
		return ExecutorPg::update($sql, $values);

	}

	public function update_participant_fe_del()
	{

		// $con = Database::getCon();
		// $query = $con->query("select person_fe from ".self::$tablename." where id=\"$this->id_activity\" ");
		// $res = mysqli_fetch_array($query);

		// if($res['person_fe'] != 0){
		// 	$this->total_person = $res['person_fe']-1;
		// }

		$con = Database::getCon();
		$query = $con->query("SELECT COUNT(*) as total from participants_list where gender='Mujer' and id_activity=\"$this->id_activity\" ");
		$res = mysqli_fetch_array($query);
		$total_person = $res["total"];

		$sql = "update reports set person_fe=\"$total_person\" where id=\"$this->id_activity\" ";
		return Executor::doit($sql);
	}

	public function update_participant_ma_add()
	{
		$conn = DatabasePg::connectPg();
		$row = $conn->prepare("SELECT COUNT(*) as total from participants_list where gender='Hombre' and id_activity='$this->id_activity'");
		$row->execute();
		$total_data = $row->fetchAll(PDO::FETCH_ASSOC);
		$total_person = $total_data[0]["total"];

		$sql = "update " . self::$tablename . "	set person_ma = ? where id = ?;";
		$values = [(int)$total_person, (int)$this->id_activity];
		return ExecutorPg::update($sql, $values);
	}


	public function update_participant_ma_del()
	{

		// $con = Database::getCon();
		// $query = $con->query("select person_ma from ".self::$tablename." where id=\"$this->id_activity\"");
		// $res = mysqli_fetch_array($query);

		// if($res['person_ma'] != 0){
		// 	$this->total_person = $res['person_ma']-1;
		// }

		$con = Database::getCon();
		$query = $con->query("SELECT COUNT(*) as total from participants_list where gender='Hombre' and id_activity=\"$this->id_activity\" ");
		$res = mysqli_fetch_array($query);
		$total_person = $res["total"];

		$sql = "update reports set person_ma=\"$total_person\" where id=\"$this->id_activity\" ";

		return Executor::doit($sql);
	}


	public static function getById($id)
	{
		$sql = "SELECT * from " . self::$tablename . " where id=\"$id\"";
		$query = Executor::doit($sql);
		return Model::one($query[0], new ReportActivityData());
		// return Model::many($query[0],new ReportActivityData());
	}


	public static function get_image($id)
	{
		$con = Database::getCon();
		$query = $con->query("select * from " . self::$tablename . " where id=$id");

		while ($res = mysqli_fetch_array($query)) {
			$resul[] = $res;
		}

		return $resul;
	}






	public static function getAll()
	{
		$sql = "SELECT * from " . self::$tablename . " WHERE is_active=1";
		$query = Executor::doit($sql);
		return Model::many($query[0], new ReportActivityData());
	}

	public static function getLike($q)
	{
		$sql = "select * from " . self::$tablename . " where is_active=1 and name like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0], new ReportActivityData());
	}

	public static function getBySQL($sql)
	{
		$query = Executor::doit($sql);
		return Model::many($query[0], new ReportActivityData());
		
	}

	public static function getProducts()
	{
		// DATEADD(day, 1, CampoFecha)
		// DATEADD(Month,2,CampoFecha)
		// DATEADD(year,3, CampoFecha)

		// $sql = "select * from ".self::$tablename." where date(date_pub)>(DATE_SUB(NOW(),INTERVAL 1 MONTH)) order by date_pub desc limit 30";
		// ultimos 30 del mes actual
		$sql = "select * from " . self::$tablename . " where month(date_pub)=month(NOW()) order by date_pub desc limit 12";
		$query = Executor::doit($sql);
		return Model::many($query[0], new ReportActivityData());
	}
}
