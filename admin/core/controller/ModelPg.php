<?php
#[AllowDynamicProperties]
class ModelPg
{

	public static function exists($modelname)
	{
		$fullpath = self::getFullpath($modelname);
		$found = false;
		if (file_exists($fullpath)) {
			$found = true;
		}
		return $found;
	}

	public static function getFullpath($modelname)
	{
		return Core::$root . "core/app/model/" . $modelname . ".php";
	}

	public static function many($stmt)
	{
		$array = array();
		while ($r = $stmt->fetchAll(PDO::FETCH_OBJ)) {
			$array[] = $r;
		}
		return $array;
	}
	//////////////////////////////////
	public static function one($query, $aclass)
	{
		$found = null;
		$data = new $aclass;
		foreach ($query as $key => $v) {
			$data->$key = $v;
		}
		$found = $data;
		return $found;
	}
}

