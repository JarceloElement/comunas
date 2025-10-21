<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// require('../../../core/controller/Database_admin.php');
// $db = Database::connectPDO();

$area_formativa = $_POST['area_formativa'];
$tipo_taller = $_POST['tipo_taller'];

// $statement_1 = $db->query("SELECT tipo_taller.nombre_taller,tipo_taller.nivel,tipo_taller.modalidad,tipo_taller.duracion_horas,training_type.contenido_curso FROM tipo_taller INNER JOIN training_type ON (tipo_taller.name_training_type = training_type.name_training_type) where training_type.name_training_type='$area_formativa' and tipo_taller.nombre_taller='$tipo_taller' ORDER BY tipo_taller.id");
// $res = $statement_1->fetchAll();

require('../../../core/controller/DatabasePg_admin.php');
$sql = "SELECT tipo_taller.nombre_taller,tipo_taller.nivel,tipo_taller.modalidad,tipo_taller.duracion_horas,training_type.contenido_curso FROM tipo_taller INNER JOIN training_type ON (tipo_taller.name_training_type = training_type.name_training_type) where training_type.name_training_type='$area_formativa' and tipo_taller.nombre_taller='$tipo_taller' ORDER BY tipo_taller.id";
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

if (count($res) > 0) {
	if (count($res[0]) > 0) {
		foreach ($res[0] as $row) {
			$array = array(
				"nivel"  => $row->nivel,
				"modalidad"  => $row->modalidad,
				"duracion"  => $row->duracion_horas,
				"contenido"  => $row->contenido_curso,
			);
		}
	}
}
echo json_encode($array, JSON_FORCE_OBJECT);


?>