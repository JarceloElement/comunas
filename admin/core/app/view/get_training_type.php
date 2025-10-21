<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// require('../../../core/controller/Database_admin.php');
// $base = new Database();
// $db = $base->connectPDO();

$line_acc = $_POST['line_acc'];
$code_info = strtoupper($_POST['code_info']);

// $sql = "SELECT * FROM training_type WHERE name_specific_action = '$line_acc' ORDER BY name_training_type";
// $statement_1 = $db->query($sql);
// $res = $statement_1->fetchAll();



require('../../../core/controller/DatabasePg_admin.php');
$sql = "SELECT * FROM training_type WHERE name_specific_action = '$line_acc' ORDER BY name_training_type";
$conn = DatabasePg::connectPg();
$stmt = $conn->prepare($sql);
$stmt->execute();


$html = "";


$res = array();
if ($stmt->rowCount() == 0) {
	$res = array();
} else {
	while ($r = $stmt->fetchAll(PDO::FETCH_OBJ)) {
		$res[] = $r;
	}
}
// print_r($res);

if (count($res[0]) > 1) {
	$html = "<option value=''>- SELECCIONE -</option>";
}
if (count($res[0]) == 0) {
	$html = "<option value='No aplica'>No aplica</option>";
}


if (count($res) > 0) {
	if (count($res[0]) > 0) {
		foreach ($res[0] as $row) {
			if (!in_array($code_info, explode(",", str_replace(" ", "", $row->restringir_categoria))) && $row->restringir_categoria != "" && $row->restringir_categoria != "TODOS" && $row->restringir_categoria != "Todos") {
				$html .= "<option data-set_institucion='" . $row->habilitar_institucion . "' data-set_description='" . $row->habilitar_descripcion . "' data-description='" . $row->descripcion_actividad . "' value='" . $row->name_training_type . "' style='display:none' >" . $row->name_training_type . "</option>";
			} else {
				$html .= "<option data-set_institucion='" . $row->habilitar_institucion . "' data-set_description='" . $row->habilitar_descripcion . "' data-description='" . $row->descripcion_actividad . "' value='" . $row->name_training_type . "'>" . $row->name_training_type . "</option>";
			}
		}
		$array = array(
			"html"  => $html,
			"total" => count($res[0]),
		);
	}
}
echo json_encode($array, JSON_FORCE_OBJECT);

?>