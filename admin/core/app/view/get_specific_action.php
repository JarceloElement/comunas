<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// require('../../../core/controller/Database_admin.php');
// $db = Database::connectPDO();

$line_acc = $_POST['line_acc'];
$code_info = strtoupper($_POST['code_info']);

// $statement_1 = $db->query("SELECT * FROM specific_action WHERE name_strategic = '$line_acc' ORDER BY name_specific_action");
// $res = $statement_1->fetchAll();


require('../../../core/controller/DatabasePg_admin.php');
$sql = "SELECT * FROM specific_action WHERE name_strategic = '$line_acc' ORDER BY name_specific_action";
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
$array = array(
	"html"  => $html,
	"total" => "0",
);

if (isset($res) && $stmt->rowCount() != 0) {

	if (count($res) > 0) {
		if (count($res[0]) > 0) {
			foreach ($res[0] as $row) {
				if (!in_array($code_info, explode(",", str_replace(" ", "", $row->permisos))) && $row->permisos != "" && $row->permisos != "TODOS" && $row->permisos != "Todos") {
					$html .= "<option data-etapa='" . $row->name_strategic . "' data-formation='" . $row->has_formation . "' data-description='" . $row->activity_description . "' value='" . $row->name_specific_action . "' style='display:none' >" . $row->name_specific_action . "</option>";
				} else {
					$html .= "<option data-etapa='" . $row->name_strategic . "' data-formation='" . $row->has_formation . "' data-description='" . $row->activity_description . "' value='" . $row->name_specific_action . "'>" . $row->name_specific_action . "</option>";
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
}
echo json_encode($array, JSON_FORCE_OBJECT);
