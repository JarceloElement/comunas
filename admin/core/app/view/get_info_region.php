<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

require('../../../core/controller/DatabasePg_admin.php');

$estado_info = $_POST['estado_info'];
$conn = DatabasePg::connectPg();
$sql = "SELECT * FROM infocentros WHERE estado='$estado_info' and cod_gerencia='0' order by cod asc";
$row_table = $conn->prepare($sql);
$row_table->execute();
$res = $row_table->fetchAll(PDO::FETCH_ASSOC);



if (count($res) > 0) {
	$html = "<option value=''>- SELECCIONE -</option>";
} else {
	$html = "<option value='No aplica'>No aplica</option>";
}

if (isset($res)) {
	foreach ($res as $row) {
		$html .= "<option data-isnt_type='Infocentro' data-e_address='" . $row['direccion'] . "' data-id_institucion='" . $row['id'] . "' value='" . $row['cod'] . "-" . $row['nombre'] . "'>" . $row['cod'] . "-" . $row['nombre'] . " </option>";
	}
	$array = array(
		"html"  => $html,
	);
}
echo json_encode($array, JSON_FORCE_OBJECT);
