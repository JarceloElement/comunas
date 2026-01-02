<?php
#[AllowDynamicProperties]
class TrainingLevelData {
	public static $tablename = "level_training";


	public function __construct(){
		$this->line_id = "";
		$this->line_action = "";
		$this->name_action = "";
	}

	public function add(){
		$sql = "INSERT into level_training (line_id, line_action, name_action, ) ";
		$sql .= "value ('$this->line_id','$this->line_action','$this->name_action')";
		return Executor::doit($sql);
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
		return Model::one($query[0],new TrainingLevelData());
	}

	public static function getAll(){
		$sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new TrainingLevelData());

	}
	
	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where line_action like '%$q%' or strategic_action like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new TrainingLevelData());
	}

	public static function getBySQL($sql){
		$query = Executor::doit($sql);
		return Model::many($query[0],new TrainingLevelData());
	}
}

?>