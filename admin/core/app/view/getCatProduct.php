
<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	require ('../../../core/controller/Database_admin.php');
    $db = Database::connectPDO();
	
	$categoria = $_POST['categoria'];
	
	$statement_1 = $db->query("SELECT * FROM products_type WHERE tipo_categoria = '$categoria' ORDER BY tipo_categoria");
	$res = $statement_1->fetchAll();

	if(count($res)>1){
		$html= "<option value=''>-TIPO DE PRODUCTO-</option>";
	}
	if(isset($res)){
		foreach ($res as $row){
			$html.= "<option value='".$row['name']."'>".$row['name']."</option>";
			
		}
	}
	echo $html;

	
?>


