<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require('../../../core/controller/DatabasePg_admin.php');


$line_acc = $_POST['line_acc'];


$sql = "SELECT * FROM specific_action WHERE name_strategic = '$line_acc' ORDER BY name_specific_action";

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

if (count($res[0]) == 0) {
	$html = "Sin resultados";
}
if (count($res[0]) > 1) {
	$html = "<option value=''>- SELECCIONE -</option>";
}


if (count($res) > 0) {
	if (count($res[0]) > 0) {
		foreach ($res[0] as $row) {
			$html .= "<option data-formation='" . $row->has_formation . "' data-description='" . $row->activity_description . "' value='" . $row->name_specific_action . "," . $row->id . "'>" . $row->name_specific_action . "</option>";
		}
	}
}


// $statement_1 = $db->query("SELECT * FROM specific_action WHERE name_strategic = '$line_acc' ORDER BY name_specific_action");
// $res = $statement_1->fetchAll();


// if (count($res) > 1) {
// 	$html = "<option value=''>- SELECCIONE -</option>";
// }

// if (isset($res)) {
// 	foreach ($res as $row) {
// 		$html .= "<option data-formation='" . $row['has_formation'] . "' data-description='" . $row['activity_description'] . "' value='" . $row['name_specific_action'] . "'>" . $row['name_specific_action'] . "</option>";
// 	}
// 	$array = array(
// 		"html"  => $html,
// 		"total" => count($res),
// 	);
// }
echo $html;

// echo json_encode($array, JSON_FORCE_OBJECT);
