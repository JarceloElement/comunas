<?php
#[AllowDynamicProperties]

class BrigadeData
{
	public static $tablename = "brigades";

	public function __construct()
	{
		$this->id = "";
		$this->nombre = "";
		$this->estado = "";
		$this->info_id = "";
		$this->info_cod = "";
		$this->datetime = "";
	}


	public function add()
	{

		$sql = "INSERT into brigades (
		nombre, 
		estado,
        info_id, 
		info_cod
			)";
		$sql .= " VALUES (
			?,
			?,
			?,
			?
			) RETURNING id;";
		$values = [
			$this->nombre,
			$this->estado,
			$this->info_id,
			$this->info_cod,
		];

		return ExecutorPg::insert($sql, $values);
	}


	public static function getByIdPg($id)
	{
		$sql = "SELECT * from " . self::$tablename . " where id=" . $id;
		$query = ExecutorPg::doit($sql);
		// return $query[0];
		$array = ModelPg::one($query[0][0], new ServicesUsersData());
		if ($array->id == "") {
			return "null";
		} else {
			return $array;
		}
	}

	public function del()
	{
		$sql = "delete from " . self::$tablename . " where id=$this->id";

		ExecutorPg::doit($sql);
	}

	public function update()
	{

		$sql = "update " . self::$tablename . " set 
		nombre='$this->nombre',
		estado='$this->estado',
		info_id='$this->info_id',
		info_cod='$this->info_cod'
		where id=$this->id";
		ExecutorPg::doit($sql);
	}

	public static function getById($id)
	{
		$sql = "select * from " . self::$tablename . " where id=$id";
		$query = ExecutorPg::doit($sql);
		return ModelPg::one($query[0][0], new BrigadeData());
	}

	public static function getByIdXlsx($id)
	{
		$sql = "select * from " . self::$tablename . " where id=$id";
		$query = ExecutorPg::doit($sql);
		$array = ModelPg::one($query[0][0], new BrigadeData());
		if ($array->id == "") {
			return "null";
		} else {
			return $array;
		}
	}

	public static function getByname($param)
	{
		$sql = "select * from " . self::$tablename . " where nombre='$param' ";
		$query = ExecutorPg::doit($sql);
		$array = ModelPg::one($query[0][0], new BrigadeData());
		if ($array->id == "") {
			return "null";
		} else {
			return $array;
		}
	}

	public static function getBySQL($sql)
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

	public static function getBySQLPg($sql)
	{
		$query = ExecutorPg::get($sql);
		return $query;
	}


	public function updatePgXLSX()
	{
		$sql = "UPDATE " . self::$tablename . " SET
		nombre = ?, 
		estado = ?
		where id = ?";
		$values = [
			$this->nombre,
			$this->estado,
			$this->id
		];
		//echo($this->id);
		ExecutorPg::update($sql, $values);
	}
}
