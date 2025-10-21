<?php
	ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

	require ('../../../core/controller/Database_admin.php');
	$base = new Database();
	$db = $base->connectPDO();
	
	$id_municipio = $_POST['id_municipio'];
	
	$statement_1 = $db->query("SELECT id_parroquia, parroquia FROM parroquias WHERE id_municipio = '$id_municipio' ORDER BY parroquia");
	$res = $statement_1->fetchAll();

	$html= "<option value='0'>- SELECCIONAR PARROQUIA -</option>";
	
	if(isset($res)){
		foreach ($res as $row){
			$html.= "<option value='".$row['id_parroquia']."'>".$row['parroquia']."</option>";
			
		}
	}
	echo $html;

	Database::disconnect();
	
?>