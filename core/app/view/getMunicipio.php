<?php
	ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

	require ('../../controller/Database.php');
	$base = new Database();
	$db = $base->connectPDO();

	$id_estado = $_POST['id_estado'];

    $statement_1 = $db->query("SELECT id_municipio, municipio FROM municipios WHERE id_estado = '$id_estado' ORDER BY municipio");
	$res = $statement_1->fetchAll();
	
	$html= "<option value=''>- SELECCIONAR MUNICIPIO -</option>";

	if(isset($res)){
		foreach ($res as $row){
			$html.= "<option value='".$row['id_municipio']."'>".$row['municipio']."</option>";
			
		}
	}
	echo $html;

	
?>


