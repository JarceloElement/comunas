
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// require('../../../core/controller/Database_admin.php');
// $db = Database::connectPDO();

$code_info = strtoupper($_POST['code_info']);

// $statement_1 = $db->query("SELECT * FROM actions_line ORDER BY line_name");
// $res = $statement_1->fetchAll();

require('../../../core/controller/DatabasePg_admin.php');
$sql = "SELECT * FROM actions_line ORDER BY line_name";
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
$html = "<option value=''>- LÍNEA DE ACCIÓN -</option>";

if (count($res) > 0) {
	if (count($res[0]) > 0) {
		foreach ($res[0] as $row) {
			if (!in_array($code_info, explode(",", str_replace(" ", "", $row->permisos))) && $row->permisos != "" && $row->permisos != "TODOS" && $row->permisos != "Todos") {
				$html .= "<option value='" . $row->line_name . "' style='display:none' >" . $row->line_name . "</option>";
			} else {
				$html .= "<option value='" . $row->line_name . "'>" . $row->line_name . "</option>";
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


