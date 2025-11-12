<?php
#[AllowDynamicProperties]
class OrganizacionesData
{
	public static $tablename = "organizaciones";

	public $id;
	public $code_info;
	public $codigo_organizacion;
    public $nombre_organizacion;
    public $dni_responsable;
    public $email_responsable;
    public $nombre_responsable;
    public $apellido_responsable;
    public $genero_responsable;
    public $telefono_responsable;
    public $rol_responsable;
    public $estado_organizacion;
    public $municipio_organizacion;
    public $parroquia_organizacion;
    public $update_by;
    public $created_at;
    public $update_at;
	public $n_registro;
	public $direccion;
	public $n_participantes;
	public $nombre_infocentro;




	public function __construct()
	{
		$this->id = null;
        $this->code_info = "";
        $this->codigo_organizacion = "";
        $this->nombre_organizacion = "";
        $this->dni_responsable = "";
        $this->email_responsable = "";
        $this->nombre_responsable = "";
        $this->apellido_responsable = "";
        $this->genero_responsable = "";
        $this->telefono_responsable = "";
        $this->rol_responsable = "";
        $this->estado_organizacion = "";
        $this->municipio_organizacion = "";
        $this->parroquia_organizacion = "";
        $this->update_by = "";
        $this->created_at = "";
        $this->update_at = "";
		$this->n_registro = "";
		$this->direccion = "";
		$this->n_participantes = "";
		$this->nombre_infocentro = "";

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
		$sql = "delete from " . self::$tablename . " where id=$this->id";
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
		return Model::one($query[0], new OrganizacionesData());
	}

	public static function getByIdPg($id)
	{
		$sql = "select * from " . self::$tablename . " where id=$id";
		$query = ExecutorPg::doit($sql);
		$array = ModelPg::one($query[0][0], new OrganizacionesData());
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


	public static function getBySQL($sql)
	{
		$query = Executor::doit($sql);
		return Model::many($query[0], new OrganizacionesData());
	}
	

	public static function getLike($q)
	{
		$sql = "select * from " . self::$tablename . " where name like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0], new OrganizacionesData());
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
		$array = ModelPg::one($query[0][0], new OrganizacionesData());
		if ($array->line_id == "") {
			return "null";
		} else {
			return $array;
		}
	}

	public static function codigo_organizacion($param)
	{
		$sql = "select * from ".self::$tablename." where codigo_organizacion='$param'";
		$query = ExecutorPg::doit($sql);
		$array = ModelPg::one($query[0][0], new OrganizacionesData());
		if ($array->codigo_organizacion == "") {
			return "null";
		} else {
			return $array;
		}
	}


	public function updatePgXLSX()
	{
		$sql = "UPDATE ".self::$tablename." SET
		code_info = ?, 
		nombre_organizacion = ?,
		dni_responsable = ?,
		email_responsable = ?,
		nombre_responsable = ?,
		apellido_responsable = ?,
		genero_responsable = ?,
		telefono_responsable = ?,
		rol_responsable = ?,
		estado_organizacion = ?,
		municipio_organizacion = ?,
		parroquia_organizacion = ?,
		update_by = ?,
		created_at = ?,
		update_at = ?,
		n_registro = ?,
		direccion = ?,
		n_participantes = ?,
		nombre_infocentro = ?
		WHERE codigo_organizacion = ?;"; 
		$values = [
			$this->code_info, 
			$this->nombre_organizacion, 
			$this->dni_responsable, 
			$this->email_responsable, 
			$this->nombre_responsable, 
			$this->apellido_responsable, 
			$this->genero_responsable, 
			$this->telefono_responsable, 
			$this->rol_responsable, 
			$this->estado_organizacion, 
			$this->municipio_organizacion, 
			$this->parroquia_organizacion, 
			$this->update_by, 
			$this->created_at, 
			$this->update_at,
			$this->n_registro,
			$this->direccion,
			$this->n_participantes,
			$this->nombre_infocentro,
			$this->codigo_organizacion
		];
		// echo($this->line_id);
		ExecutorPg::update($sql, $values);
	}

}
