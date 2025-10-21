<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	require ('../../../core/controller/Database_admin.php');
    $db = Database::connectPDO();
	
	$line_acc = $_POST['line_acc'];
	
	$statement_1 = $db->query("SELECT * FROM level_training ORDER BY id");
	$res = $statement_1->fetchAll();

	if(count($res)>1){
        $html= "<option value=''>- SELECCIONE -</option>";
	}
	if(isset($res)){
		foreach ($res as $row){
			$html.= "<option value='".$row['name_level_training']."'>".$row['name_level_training']."</option>";
			
		}
	}
	echo $html;

	
?>


