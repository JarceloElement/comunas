<?php
class LogDelete {
	public static $tablename = "del_log";


	public function __construct(){
		$this->user_id = "";
		$this->user_code_info = "";
		$this->id_deleted = "";
		$this->code_deleted = "";
		$this->state_deleted = "";
		$this->type_deleted = "";
		$this->activity_title = "";
		$this->line_action = "";
		$this->t_hombres = "";
		$this->t_mujeres = "";
	}

	public function add(){
		$sql = "INSERT into del_log (
            user_id,
            user_code_info,
            id_deleted,
            code_deleted,
            state_deleted,
            type_deleted,
			activity_title,
            line_action,
            t_hombres,
            t_mujeres
            )";
            $sql .= "value(
            \"$this->user_id\",
            \"$this->user_code_info\",
            \"$this->id_deleted\",
            \"$this->code_deleted\",
            \"$this->state_deleted\",
            \"$this->type_deleted\",
            \"$this->activity_title\",
            \"$this->line_action\",
            \"$this->t_hombres\",
            \"$this->t_mujeres\")";
		return Executor::doit($sql);
	}



	public static function getNameById($id){
		$html = "";
		$con = Database::getCon();
		$query = $con->query("select * from ".self::$tablename." where line_id=$id");
		
		while($res = mysqli_fetch_array($query)){
			$resul[] = $res;
		  }

		// foreach($resul as $p):
		// 	$html.= "<option value='".$p['id_municipio']."'>".$p['municipio']."</option>";
        // endforeach;

		// return $html;
		return $resul;

	}
	

	public static function delById($id){
		$sql = "delete from ".self::$tablename." where line_id=$id";
		Executor::doit($sql);
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where line_id=$this->line_id";
		Executor::doit($sql);
	}

	public function update(){
		$sql = "update ".self::$tablename." set line_name=\"$this->line_name\" where line_id=$this->line_id";
		Executor::doit($sql);
	}

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where line_id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new LogDelete());
	}

	public static function getAll(){
		$sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new LogDelete());

	}
	
	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where name like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new LogDelete());
	}

	public static function getBySQL($sql){
		$query = Executor::doit($sql);
		return Model::many($query[0],new LogDelete());
	}
}

?>