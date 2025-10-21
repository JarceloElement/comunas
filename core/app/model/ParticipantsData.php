<?php
class ParticipantsData {
	public static $tablename = "participants_list";

	public function __construct(){
		$this->id_activity = "";
		$this->name_activity = "";
		$this->date_activity = "";
		$this->estate = "";
		$this->code_info = "";
		$this->name = "";
		$this->document_id = "";
		$this->age = "";
		$this->gender = "";
		$this->phone = "";
		$this->email = "";
	}

	
	public function add(){

		if ($this->id_activity != null){
			$activity = ReportActivityData::getById($this->id_activity);
			$this->name_activity = $activity->activity_title;
		}


		$sql = "insert into participants_list (id_activity, name_activity, date_activity, estate, code_info, name, document_id, age, gender, phone, email) ";
		$sql .= "value (\"$this->id_activity\",\"$this->name_activity\",\"$this->date_activity\",\"$this->estate\",\"$this->code_info\",\"$this->name\",\"$this->document_id\",\"$this->age\",\"$this->gender\",\"$this->phone\",\"$this->email\")";
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
		$sql = "update ".self::$tablename." set 
		name=\"$this->name\",
		document_id=\"$this->document_id\",
		age=\"$this->age\",
		gender=\"$this->gender\",
		phone=\"$this->phone\",
		estate=\"$this->estate\",
		date_activity=\"$this->date_activity\"
		where id=$this->id";
		Executor::doit($sql);
	}

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new ParticipantsData());
	}


	public static function getByIdActivity($id){
		$sql = "select * from ".self::$tablename." where id_activity=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new ParticipantsData());
	}

	
	public static function getNameById($id){
		$con = Database::getCon();
		$query = $con->query("select * from ".self::$tablename." where id=$id");
		
		while($res = mysqli_fetch_array($query)){
			$resul[] = $res;
		  }
	
		// foreach($resul as $p):
		// 	$html.= "<option value='".$p['id_municipio']."'>".$p['municipio']."</option>";
		// endforeach;
	
		// return $html;
		return $resul;
	}
	
	public static function getAll(){
		$sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new ParticipantsData());

	}
	
	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where name like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ParticipantsData());
	}

	public static function getBySQL($sql){
		$query = Executor::doit($sql);
		return Model::many($query[0],new ParticipantsData());
	}

}

?>