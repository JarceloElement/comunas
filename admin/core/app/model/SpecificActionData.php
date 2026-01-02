<?php
#[AllowDynamicProperties]
class SpecificActionData
{
	public static $tablename = "specific_action";
	public $id;
	public $k_strategic;
	public $name_line_action;
	public $name_strategic;
	public $name_specific_action;
	public $activity_description;
	public $has_formation;
	public $permisos;


	public function __construct()
	{
		$this->id = "";
		$this->k_strategic = "";
		$this->name_line_action = "";
		$this->name_strategic = "";
		$this->name_specific_action = "";
		$this->activity_description = "";
		$this->has_formation = "";
		$this->permisos = "";
	}

	public function addPg()
	{
		$sql = "INSERT into specific_action (
			k_strategic,
			name_line_action,
			name_strategic,
			name_specific_action,
			activity_description,
			has_formation,
			permisos
			)";
		$sql .= " VALUES (
			?,
			?,
			?,
			?,
			?,
			?,
			?
			);";
		$values = [
			$this->k_strategic,
			$this->name_line_action,
			$this->name_strategic,
			$this->name_specific_action,
			$this->activity_description,
			$this->has_formation,
			$this->permisos
		];

		$result = ExecutorPg::insert($sql, $values);
		return $result;
	}



	public static function getNameByLine($line_action)
	{
		$html = "";
		$con = Database::getCon();
		$query = $con->query("select * from " . self::$tablename . " where line_action=$line_action");

		while ($res = mysqli_fetch_array($query)) {
			$resul[] = $res["name_action"];
		}

		// foreach($resul as $p):
		// 	$html.= "<option value='".$p['id_municipio']."'>".$p['municipio']."</option>";
		// endforeach;

		// return $html;
		return $resul;
	}

	public static function delById($id)
	{
		$sql = "delete from " . self::$tablename . " where id=$id";
		Executor::doit($sql);
	}
	public static function del($id)
	{
		$sql = "delete from " . self::$tablename . " where id=$id";
		Executor::doit($sql);
	}

	public function delPg()
	{
		$sql = "delete from " . self::$tablename . " where id=$this->id";
		ExecutorPg::doit($sql);
	}


	public static function getById($id)
	{
		$sql = "select * from " . self::$tablename . " where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0], new SpecificActionData());
	}


	public static function getByIdPg($id)
	{
		$sql = "select * from " . self::$tablename . " where id=$id";
		$query = ExecutorPg::doit($sql);
		$array = ModelPg::one($query[0][0], new SpecificActionData());
		if ($array->id == "") {
			return "null";
		} else {
			return $array;
		}
	}


	public static function getAll()
	{
		$sql = "select * from " . self::$tablename;
		$conn = DatabasePg::connectPg();
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		return ModelPg::many($stmt)[0];
	}

	public static function getObj($sql)
	{
		$conn = DatabasePg::connectPg();
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		if ($stmt->rowCount() == 0) {
			return array();
		} else {
			return ModelPg::many($stmt)[0];
		}
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
		return Model::many($query[0], new SpecificActionData());
	}



	public static function getByName($param)
	{
		$sql = "select * from " . self::$tablename . " where name_specific_action='$param'";
		$query = ExecutorPg::doit($sql);
		$array = ModelPg::one($query[0][0], new SpecificActionData());
		if ($array->id == "") {
			return "null";
		} else {
			return $array;
		}
	}


	public static function specificActionById($sql)
	{
		$query = Executor::doit($sql);
		return Model::one($query[0], new SpecificActionData());
	}


	public function updatePgXLSX()
	{
		$sql = "UPDATE " . self::$tablename . " SET
			k_strategic=?,
			name_line_action=?,
			name_strategic=?,
			name_specific_action=?,
			activity_description=?,
			has_formation=?,
			permisos=?
			WHERE id=?";
		$values = [
			$this->k_strategic,
			$this->name_line_action,
			$this->name_strategic,
			$this->name_specific_action,
			$this->activity_description,
			$this->has_formation,
			$this->permisos,
			(int)$this->id
		];
		// echo($this->line_id);
		ExecutorPg::update($sql, $values);
	}
}
