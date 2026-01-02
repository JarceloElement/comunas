<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// require('../../../core/controller/Database_admin.php');
// $base = new Database();
// $db = $base->connectPDO();

$line_acc = $_POST['line_acc'];
$name_strategic = $_POST['name_strategic'];
$code_info = strtoupper($_POST['code_info']);

// $sql = "SELECT * FROM training_type WHERE name_specific_action = '$line_acc' ORDER BY name_training_type";
// $statement_1 = $db->query($sql);
// $res = $statement_1->fetchAll();



require('../../../core/controller/DatabasePg_admin.php');
$sql = "SELECT * FROM training_type WHERE name_strategic_action = '$name_strategic' ORDER BY name_training_type";
$conn = DatabasePg::connectPg();
$stmt = $conn->prepare($sql);
$stmt->execute();


$html = "";

$total = 0;
$res = array();
if ($stmt->rowCount() == 0) {
	$res = array();
} else {
	while ($r = $stmt->fetchAll(PDO::FETCH_OBJ)) {
		$res[] = $r;
	}
}
// print_r($res);
if (isset($res) && $stmt->rowCount() != 0) {

	if (count($res[0]) == 0) {
		$html = "<option value='No aplica'>No aplica</option>";
	}
}


if (count($res) > 0 && $stmt->rowCount() != 0) {
	if (count($res[0]) > 0) {
		foreach ($res[0] as $row) {
			if (!in_array($code_info, explode(",", str_replace(" ", "", $row->restringir_categoria))) && $row->restringir_categoria != "" && $row->restringir_categoria != "TODOS" && $row->restringir_categoria != "Todos") {
				$html .= "<option data-etapa='" . $row->name_strategic_action . "' data-set_institucion='" . $row->habilitar_institucion . "' data-set_description='" . $row->habilitar_descripcion . "' data-description='" . $row->descripcion_actividad . "' data-cod_curso='" . $row->codigo_curso . "' value='" . $row->name_training_type . "' style='display:none' >" . $row->name_training_type . "</option>";
			} else {
				$html .= "<option data-etapa='" . $row->name_strategic_action . "' data-set_institucion='" . $row->habilitar_institucion . "' data-set_description='" . $row->habilitar_descripcion . "' data-description='" . $row->descripcion_actividad . "' data-cod_curso='" . $row->codigo_curso . "' value='" . $row->name_training_type . "'>" . $row->name_training_type . "</option>";
				$total++;
			}
		}
		if ($total > 1) {
			$html = "<option value=''>- SELECCIONE -</option>" . $html;
		}
		$array = array(
			"html"  => $html,
			"total" => $total,
		);
	}
}
echo json_encode($array, JSON_FORCE_OBJECT);
