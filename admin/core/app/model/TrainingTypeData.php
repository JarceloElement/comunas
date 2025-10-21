<?php
#[AllowDynamicProperties]
class TrainingTypeData {
	public static $tablename = "training_type";

	public $line_id;
	public $line_action;
	public $name_action;
	public $id;
	public $name_line_action;
	public $name_strategic_action;
	public $name_specific_action;
	public $name_training_type;
	public $duracion_horas;
	public $nivel_curso;
	public $modalidad_curso;
	public $ejes_actuacion;
	public $tipo_certificacion;
	public $contenido_curso;
	public $descripcion_actividad;
	public $habilitar_descripcion;
	public $habilitar_institucion;
	public $codigo_curso;
	public $restringir_categoria;


	public function __construct(){
		$this->line_id = "";
		$this->line_action = "";
		$this->name_action = "";
		$this->id = "";
		$this->name_line_action = "";
		$this->name_strategic_action = "";
		$this->name_specific_action = "";
		$this->name_training_type = "";
		$this->duracion_horas = "";
		$this->nivel_curso = "";
		$this->modalidad_curso = "";
		$this->ejes_actuacion = "";
		$this->tipo_certificacion = "";
		$this->contenido_curso = "";
		$this->descripcion_actividad = "";
		$this->habilitar_descripcion = "";
		$this->habilitar_institucion = "";
		$this->codigo_curso = "";
		$this->restringir_categoria = "";


	}

	public function add(){
		$sql = "INSERT into strategic_action (line_id, line_action, name_action) ";
		$sql .= "value ('$this->line_id','$this->line_action','$this->name_action')";
		return Executor::doit($sql);
	}



	public function update(){
		$sql = "update ".self::$tablename." set 
		name_line_action='$this->name_line_action', 
		name_strategic_action='$this->name_strategic_action', 
		name_specific_action='$this->name_specific_action', 
		name_training_type='$this->name_training_type', 
		duracion_horas='$this->duracion_horas', 
		nivel_curso='$this->nivel_curso', 
		modalidad_curso='$this->modalidad_curso', 
		ejes_actuacion='$this->ejes_actuacion', 
		tipo_certificacion='$this->tipo_certificacion', 
		contenido_curso='$this->contenido_curso', 
		descripcion_actividad='$this->descripcion_actividad', 
		habilitar_descripcion='$this->habilitar_descripcion', 
		habilitar_institucion='$this->habilitar_institucion', 
		codigo_curso='$this->codigo_curso', 
		restringir_categoria='$this->restringir_categoria' 
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

	public static function getByName($param)
	{
		$sql = "select * from " . self::$tablename . " where name_training_type='$param'";
		$query = ExecutorPg::doit($sql);
		$array = ModelPg::one($query[0][0], new TrainingTypeData());
		if ($array->id == "") {
			return "null";
		} else {
			return $array;
		}
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
		return Model::one($query[0],new TrainingTypeData());
	}

	public static function getByIdPg($id)
	{
		$sql = "select * from " . self::$tablename . " where id=$id";
		$query = ExecutorPg::doit($sql);
		$array = ModelPg::one($query[0][0], new TrainingTypeData());
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


	public static function getObj($sql){
		$conn = DatabasePg::connectPg();
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		if ($stmt->rowCount() == 0) {
			return Array();
		} else {
			return ModelPg::many($stmt)[0];
		}
		
	}

	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where line_action like '%$q%' or strategic_action like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new TrainingTypeData());
	}

	public static function getBySQL($sql){
		$query = Executor::doit($sql);
		return Model::many($query[0],new TrainingTypeData());
	}

	public function updatePgXLSX()
	{

		$sql = "UPDATE " . self::$tablename . " SET
			name_line_action=?,
			name_strategic_action=?,
			name_specific_action=?,
			name_training_type=?,
			duracion_horas=?,
			nivel_curso=?,
			modalidad_curso=?,
			ejes_actuacion=?,
			tipo_certificacion=?,
			contenido_curso=?,
			descripcion_actividad=?,
			habilitar_descripcion=?,
			habilitar_institucion=?,
			codigo_curso=?,
			restringir_categoria=?
			WHERE id=?";
		$values = [
			$this->name_line_action,
			$this->name_strategic_action,
			$this->name_specific_action,
			$this->name_training_type,
			$this->duracion_horas,
			$this->nivel_curso,
			$this->modalidad_curso,
			$this->ejes_actuacion,
			$this->tipo_certificacion,
			$this->contenido_curso,
			$this->descripcion_actividad,
			$this->habilitar_descripcion,
			$this->habilitar_institucion,
			$this->codigo_curso,
			$this->restringir_categoria,
			(int)$this->id
		];
		// echo($this->line_id);
		ExecutorPg::update($sql, $values);
	}


}

?>