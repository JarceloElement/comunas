<?php
#[AllowDynamicProperties]

class ProductsData
{
	public static $tablename = "products_list";

	public function __construct()
	{
		$this->id_activity = "";
		$this->estate = "";
		$this->info_id = "";
		$this->code_info = "";
		$this->activity_title = "";
		$this->name_product = "";
		$this->action_performed = "";
		$this->date_activity = "";
		$this->format = "";
		$this->format_detail = "";
		$this->quantity_created = "";
		$this->quantity_published = "";
		$this->doc_name = "";
		$this->web_link = "";
	}



	public function add()
	{

		if ($this->id_activity != null) {
			$activity = ReportActivityData::getById($this->id_activity);
			$this->activity_title = $activity->activity_title;
		}


		$sql = "insert into products_list (
        id_activity,
        estate,
        info_id,
        code_info,
        activity_title,
        action_performed,
        date,
        format,
        format_detail,
        quantity_created,
        quantity_published,
        web_link) ";
		$sql .= "value (
        '$this->id_activity',
        '$this->estate',
        '$this->info_id',
        '$this->code_info',
        '$this->activity_title',
        '$this->action_performed',
        '$this->date_activity',
        '$this->format',
        '$this->format_detail',
        '$this->quantity_created',
        '$this->quantity_published',
        '$this->web_link')";
		return Executor::doit($sql);
	}




	public function add_Pg()
	{

		if ($this->id_activity != null) {
			$activity = ReportActivityData::getByIdPg((int)$this->id_activity);
			$this->activity_title = $activity["activity_title"];
		}

		$sql = "INSERT into products_list (
		id_activity,
        estate,
        info_id,
        code_info,
        activity_title,
        action_performed,
        date,
        format,
        format_detail,
        quantity_created,
        quantity_published,
        doc_name,
        web_link
			)";
		$sql .= " VALUES (
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?
			) RETURNING id;";
		$values = [
			(int)$this->id_activity,
			$this->estate,
			(int)$this->info_id,
			$this->code_info,
			$this->activity_title,
			$this->action_performed,
			$this->date_activity,
			$this->format,
			$this->format_detail,
			(int)$this->quantity_created,
			(int)$this->quantity_published,
			$this->doc_name,
			$this->web_link
		];

		// echo implode(",",$values);
		$resul = ExecutorPg::insert($sql, $values)[0]["id"];
		// return $resul[2]->lastInsertId('participants_list'.'_id_seq');
		return $resul;
	}



	public static function delByIdPg($id)
	{
		$sql = "delete from " . self::$tablename . " where id= ?;";
		return ExecutorPg::del($sql, $id);
	}


	public static function delById($id)
	{
		$sql = "delete from " . self::$tablename . " where id=$id";
		Executor::doit($sql);
	}
	public function del()
	{
		$sql = "delete from " . self::$tablename . " where id=$this->id";
		Executor::doit($sql);
	}

	public function delByIdActivity()
	{
		// $sql = "delete from " . self::$tablename . " where id_activity=$this->id_activity";
		// Executor::doit($sql);

		$sql = "delete from " . self::$tablename . " where id= ?;";
        return ExecutorPg::del($sql,(int)$this->id_activity);
	}

	public function update()
	{
		// $sql = "update " . self::$tablename . " set 
		// action_performed='$this->action_performed',
		// format='$this->format',
		// format_detail='$this->format_detail',
		// quantity_created='$this->quantity_created',
		// quantity_published='$this->quantity_published',
		// web_link='$this->web_link'
		// where id=$this->id";
		// Executor::doit($sql);
		$sql = "UPDATE " . self::$tablename . " set 
		action_performed = ?, 
		format = ?, 
		format_detail = ?, 
		quantity_created = ?, 
		quantity_published = ?, 
		web_link = ? 
		where id = ?;";
		$values = [
			$this->action_performed,
			$this->format,
			$this->format_detail,
			$this->quantity_created,
			$this->quantity_published,
			$this->web_link,
			$this->id
		];
		ExecutorPg::update($sql, $values);
	}


	public function update_product_created()
	{

		if ($this->update_type = "add") {
			$con = Database::getCon();
			$query = $con->query("select quantity_created from " . self::$tablename . " where id=$this->id_activity");
			$res = mysqli_fetch_array($query);
			$sql = "update reports set person_fe='$this->total_person' where id=$this->id_activity ";
		}
		return Executor::doit($sql);
	}


	public static function getById($id)
	{
		// $sql = "select * from " . self::$tablename . " where id=$id";
		// $query = Executor::doit($sql);
		// return Model::one($query[0], new ProductsData());

		$sql = "SELECT * from " . self::$tablename . " where id=".(int)$id.";";
        return ExecutorPg::get($sql)[0][0];
	}



	public static function getByIdActivity($id)
	{
		$sql = "select * from " . self::$tablename . " where id_activity=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0], new ProductsData());
	}



	public static function getNameById($id)
	{
		$con = Database::getCon();
		$query = $con->query("select * from " . self::$tablename . " where id=$id");

		while ($res = mysqli_fetch_array($query)) {
			$resul[] = $res;
		}

		// foreach($resul as $p):
		// 	$html.= "<option value='".$p['id_municipio']."'>".$p['municipio']."</option>";
		// endforeach;

		// return $html;
		return $resul;
	}

	public static function getAll()
	{
		$sql = "select * from " . self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0], new ProductsData());
	}

	public static function getLike($q)
	{
		$sql = "select * from " . self::$tablename . " where name like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0], new ProductsData());
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

		// $query = Executor::doit($sql);
		// return Model::many($query[0],new ProductsData());
	}
}
