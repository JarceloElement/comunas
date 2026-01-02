<?php
 #[AllowDynamicProperties]

class EstadoData {
	public static $tablename = "estados";


	public function __construct(){
		$this->id_estado = "";
		$this->estado = "";
		$this->iso = "";
	}

	public function add(){
		$sql = "insert into ".self::$tablename." (estado,iso) ";
		$sql .= "value (\"$this->estado\",\"$this->iso)";
		Executor::doit($sql);
	}

	public static function delById($id){
		$sql = "delete from ".self::$tablename." where id_estado=$id";
		Executor::doit($sql);
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where id_estado=$this->id_estado";
		Executor::doit($sql);
	}

// partiendo de que ya tenemos creado un objecto EstadoData previamente utilizamos el contexto
	public function update_active(){
		$sql = "update ".self::$tablename." set last_active_at=NOW() where id_estado=$this->id_estado";
		Executor::doit($sql);
	}


	public function update(){
		$sql = "update ".self::$tablename." set id_estado=\"$this->id_estado\",estado=\"$this->estado\",iso=\"$this->iso\" where id_estado=$this->id_estado";
		Executor::doit($sql);
	}

	public static function getById2($id){
		$sql = "select * from ".self::$tablename." where id_estado=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new EstadoData());
	}

	public static function getByNmae($name){
		$sql = "select * from ".self::$tablename." where estado=$name";
		$query = Executor::doit($sql);
		return Model::one($query[0],new EstadoData());
	}


	public static function getNameById($id){
		$name = "";
		$con = Database::getCon();
		$query = $con->query("select estado from ".self::$tablename." where id_estado=$id");
		
		while($res = mysqli_fetch_array($query)){
			$resul[] = $res;
		  }
	
		foreach($resul as $p):
			$name.= $p['estado'];
		endforeach;
	
		return $name;
	}



	

	public static function getById($id){
		$con = Database::getCon();
		$query = $con->query("select * from ".self::$tablename." where id_estado=$id");
		
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
		$sql = "select * from ".self::$tablename." order by id_estado asc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new EstadoData());
	}

	
	public static function getAllActive(){
		$sql = "select * from estados,interval 3 second)";
		$query = Executor::doit($sql);
		return Model::many($query[0],new EstadoData());
	}

	public static function getAllUnActive(){
		$sql = "select * from estados ,interval 3 second)";
		$query = Executor::doit($sql);
		return Model::many($query[0],new EstadoData());
	}




	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where estado like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new EstadoData());
	}


}

?>