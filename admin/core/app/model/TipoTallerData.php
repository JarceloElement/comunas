<?php
#[AllowDynamicProperties]
class TipoTallerData {
	public static $tablename = "tipo_taller";


	public function __construct(){
		$this->id = "";
		$this->name_training_type = "";
		$this->nombre_taller = "";
		$this->duracion_horas = "";
		$this->nivel = "";
		$this->modalidad = "";
		$this->permisos = "";

	}

	public function add(){
		$sql = "INSERT into tipo_taller (name_training_type, nombre_taller, duracion_horas, nivel, modalidad, permisos) ";
		$sql .= "value ('$this->name_training_type','$this->nombre_taller','$this->duracion_horas','$this->nivel','$this->modalidad','$this->permisos')";
		return Executor::doit($sql);
	}


	public function update(){
		$sql = "update ".self::$tablename." set 
		name_training_type='$this->name_training_type',
		nombre_taller='$this->nombre_taller',
		duracion_horas='$this->duracion_horas',
		nivel='$this->nivel',
		modalidad='$this->modalidad',
		permisos='$this->permisos'
		where id=$this->id";
		Executor::doit($sql);
	}


	public static function getNameByLine($line_action){
		$html = "";
		$con = Database::getCon();
		$query = $con->query("select * from ".self::$tablename." where line_action=$line_action");
		
		while($res = mysqli_fetch_array($query)){
			$resul[] = $res["name_action"];
		  }

		// foreach($resul as $p):
		// 	$html.= "<option value='".$p['id_municipio']."'>".$p['municipio']."</option>";
        // endforeach;

		// return $html;
		return $resul;

	}
	
	public static function delById($id){
		$sql = "delete from ".self::$tablename." where id=$id";
		Executor::doit($sql);
	}
	public static function del($id){
		$sql = "delete from ".self::$tablename." where id=$id";
		Executor::doit($sql);
	}


	// public function update(){
	// 	$sql = "update ".self::$tablename." set line_action=\"$this->line_action\" where StridategicActionData=$this->StridategicActionData";
	// 	Executor::doit($sql);
	// }

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new TipoTallerData());
	}

	
	public static function getByIdPg($id)
	{
		$sql = "select * from " . self::$tablename . " where id=$id";
		$query = ExecutorPg::doit($sql);
		$array = ModelPg::one($query[0][0], new TipoTallerData());
		if ($array->id == "") {
			return "null";
		} else {
			return $array;
		}
	}

	public static function getAll()
	{
		$sql = "select * from ".self::$tablename;
		$conn = DatabasePg::connectPg();
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		return ModelPg::many($stmt)[0];
	}

	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where line_action like '%$q%' or strategic_action like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new TipoTallerData());
	}

	public static function getBySQL($sql){
		$query = Executor::doit($sql);
		return Model::many($query[0],new TipoTallerData());
	}

	public static function getByName($param)
	{
		$sql = "select * from ".self::$tablename." where nombre_taller='$param'";
		$query = ExecutorPg::doit($sql);
		$array = ModelPg::one($query[0][0], new TipoTallerData());
		if ($array->id == "") {
			return "null";
		} else {
			return $array;
		}
	}


public function updatePgXLSX()
	{

		$sql = "UPDATE " . self::$tablename . " SET
			name_training_type=?,
			nombre_taller=?,
			duracion_horas=?,
			nivel=?,
			modalidad=?,
			permisos=?
			WHERE id=?";
		$values = [
			$this->name_training_type,
			$this->nombre_taller,
			$this->duracion_horas,
			$this->nivel,
			$this->modalidad,
			$this->permisos,
			(int)$this->id
		];
		// echo($this->line_id);
		ExecutorPg::update($sql, $values);
	}



}

?>