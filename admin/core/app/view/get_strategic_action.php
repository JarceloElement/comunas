<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// require('../../../core/controller/Database_admin.php');
// $db = Database::connectPDO();

require('../../../core/controller/DatabasePg_admin.php');

$line = $_POST['line'];

// $statement_1 = $db->query("SELECT * FROM strategic_action WHERE line_action = '$line' ORDER BY line_action");
// $res = $statement_1->fetchAll();

$sql = "SELECT * FROM strategic_action WHERE line_action = '$line' ORDER BY line_action";

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
$html = "<option value=''>- SELECCIONAR ACCIÓN -</option>";

if (count($res) > 0) {
	if (count($res[0]) > 0) {
		foreach ($res[0] as $row) {
			$html .= "<option value='" . $row->name_action . "," . $row->id . "'>" . $row->name_action . "</option>";
		}
	}
}
echo $html;
