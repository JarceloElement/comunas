<?php
#[AllowDynamicProperties]

class LinksData
{
	public static $tablename = "links";

	public function __construct()
	{
		$this->products_list_id = "";
		$this->social_medias_id = "";
		$this->activity_id = "";
		$this->link = "";


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

		$sql = "INSERT into links (
		products_list_id,
		social_medias_id,
		activity_id,
		link
		)";
		$sql .= " VALUES (
			?,
			?,
			?,
			?
			);";
		$values = [
			(int)$this->products_list_id,
			(int)$this->social_medias_id,
			(int)$this->activity_id,
			$this->link,

		];

		// echo implode(",",$values);
		$resul = ExecutorPg::insert($sql, $values);
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
		products_list_id = ?, 
		social_medias_id = ?, 
		activity_id = ?, 
		link = ?
		where id = ?;";
		$values = [
			$this->products_list_id,
			$this->social_medias_id,
			$this->activity_id,
			$this->link,
			$this->id
		];
		ExecutorPg::update($sql, $values);
	}



	public static function getByLink($link)
	{

		$sql = "SELECT * from " . self::$tablename . " where link='".$link."';";
        return ExecutorPg::get($sql)[0][0];
	}

	public static function getById($id)
	{
		// $sql = "select * from " . self::$tablename . " where id=$id";
		// $query = Executor::doit($sql);
		// return Model::one($query[0], new ProductsData());

		$sql = "SELECT * from " . self::$tablename . " where id=".(int)$id.";";
        return ExecutorPg::get($sql)[0][0];
	}

	public static function getLinksByProductId($id){

		
		$sql = "SELECT * from " . self::$tablename . " where products_list_id=".(int)$id.";";
        return ExecutorPg::get($sql)[0];

	}



	public static function getByIdActivity($id)
	{
		$sql = "select * from " . self::$tablename . " where id_activity=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0], new ProductsData());
	}

	public static function getByProductId($id)
	{
		$sql = "select * from " . self::$tablename . "WHERE products_list_id=$id";
		$query = ExecutorPg::doit($sql);
		
		return ModelPg::many($query[0], new LinksData());
	}

	public static function getAll()
	{
		$sql = "select * from " . self::$tablename;
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
