<?php
#[AllowDynamicProperties]
class ActionsLineData
{
	public static $tablename = "actions_line";

	public $line_id;
	public $line_name;
	public $permisos;

	public function __construct()
	{
		$this->line_id = null;
		$this->line_name = "";
		$this->permisos = "";
	}

	public function add()
	{
		$sql = "insert into actions_line (line_name,permisos) ";
		$sql .= "value (\"$this->line_name\",\"$this->permisos\")";
		return Executor::doit($sql);
	}

	public function addPg()
	{
		$sql = "INSERT into actions_line (
			line_name,
			permisos
			)";
		$sql .= " VALUES (
			?,
			?
			);";
		$values = [
			$this->line_name,
			$this->permisos
		];

		$result = ExecutorPg::insert($sql, $values);
		return $result;
	}


	public static function getNameById($id)
	{
		$html = "";
		$con = Database::getCon();
		$query = $con->query("select * from " . self::$tablename . " where line_id=$id");

		while ($res = mysqli_fetch_array($query)) {
			$resul[] = $res;
		}

		// foreach($resul as $p):
		// 	$html.= "<option value='".$p['id_municipio']."'>".$p['municipio']."</option>";
		// endforeach;

		// return $html;
		return $resul;
	}


	public static function delById($id)
	{
		$sql = "delete from " . self::$tablename . " where line_id=$id";
		Executor::doit($sql);
	}
	public function del()
	{
		$sql = "delete from " . self::$tablename . " where line_id=$this->line_id";
		Executor::doit($sql);
	}

	public function delPg()
	{
		$sql = "delete from " . self::$tablename . " where line_id=$this->line_id";
		ExecutorPg::doit($sql);
	}


	public function update()
	{
		$sql = "update " . self::$tablename . " set line_name=\"$this->line_name\" where line_id=$this->line_id";
		Executor::doit($sql);
	}


	public static function getById($id)
	{
		$sql = "select * from " . self::$tablename . " where line_id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0], new ActionsLineData());
	}

	public static function getByIdPg($id)
	{
		$sql = "select * from " . self::$tablename . " where line_id=$id";
		$query = ExecutorPg::doit($sql);
		$array = ModelPg::one($query[0][0], new ActionsLineData());
		if ($array->line_id == "") {
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


	public static function getBySQL($sql)
	{
		$query = Executor::doit($sql);
		return Model::many($query[0], new FacilitatorsData());
	}
	

	public static function getLike($q)
	{
		$sql = "select * from " . self::$tablename . " where name like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0], new ActionsLineData());
	}

	public static function getObj($sql){
		$conn = DatabasePg::connectPg();
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		return ModelPg::many($stmt)[0];
	}

	public static function getBySQLPg($sql)
	{
		$query = ExecutorPg::doit($sql);
		$array = ModelPg::one($query[0][0], new ActionsLineData());
		if ($array->line_id == "") {
			return "null";
		} else {
			return $array;
		}
	}

	public static function getByName($param)
	{
		$sql = "select * from ".self::$tablename." where line_name='$param'";
		$query = ExecutorPg::doit($sql);
		$array = ModelPg::one($query[0][0], new ActionsLineData());
		if ($array->line_id == "") {
			return "null";
		} else {
			return $array;
		}
	}


	public function updatePgXLSX()
	{
		$sql = "UPDATE ".self::$tablename." SET
		line_name = ?, 
		permisos = ? 
		where line_id = ?";
		$values = [
			$this->line_name, 
			$this->permisos,
			(int)$this->line_id
		];
		// echo($this->line_id);
		ExecutorPg::update($sql, $values);
	}

}
