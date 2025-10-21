
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// require('../../../core/controller/Database_admin.php');
// $db = Database::connectPDO();

$line_acc = $_POST['line_acc'];
$code_info = strtoupper($_POST['code_info']);

// $statement_1 = $db->query("SELECT * FROM strategic_action WHERE line_action = '$line_acc' ORDER BY name_action");
// $res = $statement_1->fetchAll();


require('../../../core/controller/DatabasePg_admin.php');
$sql = "SELECT * FROM strategic_action WHERE line_action = '$line_acc' ORDER BY name_action";
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


if (count($res) > 1) {
	$html = "<option value=''>- TIPO DE ACCIÓN -</option>";
}


if (count($res) > 0) {
	if (count($res[0]) > 0) {
		foreach ($res[0] as $row) {
			if (!in_array($code_info, explode(",", str_replace(" ", "", $row->permisos))) && $row->permisos != "" && $row->permisos != "TODOS" && $row->permisos != "Todos") {
				$html .= "<option value='" . $row->name_action . "' style='display:none' >" . $row->name_action . "</option>";
			} else {
				$html .= "<option value='" . $row->name_action . "'>" . $row->name_action . "</option>";
			}
		}
		$array = array(
			"html"  => $html,
			"total" => count($res),
		);
	}
}
echo json_encode($array, JSON_FORCE_OBJECT);

?>


