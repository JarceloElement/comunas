<?php
#[AllowDynamicProperties]


// 10 de Octubre del 2014
// Model.php
// @brief agrego la clase Model para reducir las lineas de los modelos

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

	public static function many($query, $aclass)
	{
		$cnt = 0;
		$array = array();
		while ($r = $query->fetch_array()) {
			$array[$cnt] = new $aclass;
			$cnt2 = 1;
			foreach ($r as $key => $v) {
				if ($cnt2 > 0 && $cnt2 % 2 == 0) {
					$array[$cnt]->$key = $v;
				}
				$cnt2++;
			}
			$cnt++;
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

