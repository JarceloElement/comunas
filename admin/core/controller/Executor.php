<?php

class Executor {

	public static function doit($sql){
		$con = Database::getCon();
		if(Core::$debug_sql){
			print "<pre>".$sql."</pre>";
    		// Core::alert("<pre>".$sql."</pre>");
		}
		$resul = $con->query($sql);
		$insert_id = $con->insert_id;
		$total_result = 0;
		// $total_result = $resul->num_rows;
		return array($resul,$insert_id,$total_result);
	}


}
?>