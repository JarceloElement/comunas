<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// require('../../../core/controller/Database_admin.php');
// $db = Database::connectPDO();


$categoria = $_POST['categoria'];
$code_info = strtoupper($_POST['code_info']);

// $statement_1 = $db->query("SELECT tipo_taller.nombre_taller,tipo_taller.descripcion_taller,tipo_taller.nivel,tipo_taller.modalidad,tipo_taller.duracion_horas,tipo_taller.permisos,training_type.contenido_curso FROM tipo_taller INNER JOIN training_type ON (tipo_taller.name_training_type = training_type.name_training_type) where tipo_taller.name_training_type='$categoria' GROUP BY tipo_taller.nombre_taller,tipo_taller.nivel,tipo_taller.modalidad,tipo_taller.duracion_horas,tipo_taller.nivel,training_type.contenido_curso,tipo_taller.id ORDER BY tipo_taller.id");
// $res = $statement_1->fetchAll(PDO::FETCH_ASSOC);

require('../../../core/controller/DatabasePg_admin.php');
$sql = "SELECT tipo_taller.nombre_taller,tipo_taller.descripcion_taller,tipo_taller.nivel,tipo_taller.modalidad,tipo_taller.duracion_horas,tipo_taller.permisos,training_type.contenido_curso FROM tipo_taller INNER JOIN training_type ON (tipo_taller.name_training_type = training_type.name_training_type) where tipo_taller.name_training_type='$categoria' GROUP BY tipo_taller.nombre_taller,tipo_taller.nivel,tipo_taller.modalidad,tipo_taller.duracion_horas,tipo_taller.nivel,training_type.contenido_curso,tipo_taller.id ORDER BY tipo_taller.id";
$conn = DatabasePg::connectPg();
$stmt = $conn->prepare($sql);
$stmt->execute();

$res = array();
if ($stmt->rowCount() == 0) {
	$res = array();
} else {
	while ($r = $stmt->fetchAll(PDO::FETCH_OBJ)) {
		$res[] = $r;
	}
}
// print_r($res);

if (count($res) >= 1) {
	$html = "<option value=''>- SELECCIONE -</option>";
}


if (count($res) > 0) {
	if (count($res[0]) > 0) {
		foreach ($res[0] as $row) {
			if (!in_array($code_info, explode(",", str_replace(" ", "", $row->permisos))) && $row->permisos != "" && $row->permisos != "TODOS" && $row->permisos != "Todos") {
				$html .= "<option data-descripcion_taller='" . $row->descripcion_taller . "' value='" . $row->nombre_taller . "' style='display:none' >" . $row->nombre_taller . " </option>";
			} else {
				$html .= "<option data-descripcion_taller='" . $row->descripcion_taller . "' value='" . $row->nombre_taller . "'>" . $row->nombre_taller . " </option>";
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