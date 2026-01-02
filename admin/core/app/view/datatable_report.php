<?php

require ('../../../core/controller/Database_admin.php');
$db = Database::connectPDO();

$query = $_GET['sql'];
// $sql = "SELECT date_pub,code_info,line_action,activity_title,estate from reports ";

$statement_1 = $db->query($query);
$res = $statement_1->fetchAll();
$count = count($res);

// if(isset($res)){
// 	foreach ($res as $row){
// 		$array = array(
// 			"date_pub"  => $row['date_pub'],
// 			"code_info"  => $row['code_info'],
// 			"line_action"  => $row['line_action'],
// 			"estate"  => $row['estate'],
// 		);
// 	}
// }

$data = array(
	'draw'=>1, 
	'recordsTotal'=>intval($count), 
	'recordsFiltered'=>intval($count), 
	'data'=>$res,
  );
  //send data as json format
  echo json_encode($data);





?>  







