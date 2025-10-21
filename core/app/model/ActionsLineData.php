<?php
class ActionsLineData {
	public static $tablename = "actions_line";


	public function __construct(){
		$this->line_name = "";
	}

	public function add(){
		$sql = "insert into actions_line (line_name) ";
		$sql .= "value (\"$this->line_name\")";
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
		return Model::one($query[0],new ActionsLineData());
	}

	public static function getAll(){
		$sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new ActionsLineData());

	}
	
	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where name like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ActionsLineData());
	}

	public static function getBySQL($sql){
		$query = Executor::doit($sql);
		return Model::many($query[0],new ActionsLineData());
	}
}

?>