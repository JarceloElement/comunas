<?php
	
    include ('../../controller/Database.php');
    $db = Database::connectPDO();
	
	$id_estado = $_POST['id_estado'];
	
	$statement_1 = $db->query("SELECT id_ciudad, ciudad FROM ciudades WHERE id_estado = '$id_estado' ORDER BY ciudad");
	$res = $statement_1->fetchAll();

	$html= "<option value='0'>- SELECCIONAR CIUDAD -</option>";
	
	if(isset($res)){
		foreach ($res as $row){
			$html.= "<option value='".$row['id_ciudad']."'>".$row['ciudad']."</option>";
			
		}
	}
	echo $html;

	
?>		


