<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();


require('../../../core/controller/DatabasePg_admin.php');
$conn = DatabasePg::connectPg();

$code_info = strtoupper($_POST['code_info']);
$user_type = $_SESSION['user_type'];
$user_code_info = $_SESSION['user_code_info'];
$user_region = $_POST['estado_info'];


// facilitadores busca instituciones vinculadas a ese infocentro
if ($user_type == 2) {
	// $statement_1 = $db->query("SELECT info_social_map_educations.school_name as e_name, info_social_map_educations.id as id_escuela, info_social_map_educations.school_address as e_address, info_social_map_educations.isnt_type as isnt_type FROM info_social_map_educations where info_social_map_educations.school_name != '' and info_social_map_educations.school_name != 'null' and info_social_map_educations.code_info='$code_info' GROUP BY info_social_map_educations.school_name, info_social_map_educations.id, info_social_map_educations.school_address, info_social_map_educations.isnt_type ORDER BY info_social_map_educations.school_name");
	// $res = $statement_1->fetchAll(PDO::FETCH_ASSOC);
	// $statement_2 = $db->query("SELECT info_social_map_organizations.organization_name as e_name, info_social_map_organizations.id as id_institucion, info_social_map_organizations.organization_address as e_address, info_social_map_organizations.organization_type as isnt_type FROM info_social_map_organizations where info_social_map_organizations.organization_name != '' and info_social_map_organizations.organization_name != 'null' and info_social_map_organizations.code_info='$code_info' GROUP BY info_social_map_organizations.organization_name, info_social_map_organizations.id, info_social_map_organizations.organization_address ORDER BY info_social_map_organizations.organization_name");
	// $res_2 = $statement_2->fetchAll(PDO::FETCH_ASSOC);
	$sql = "SELECT * FROM organizaciones WHERE UPPER(code_info)='$code_info' AND estado_organizacion='$user_region' ORDER BY nombre_organizacion";
	$stmt = $conn->prepare($sql);
	$stmt->execute();

	// no facilitadores reportando con su mismo codigo busca instituciones vinculadas a su region
} else if ($user_type != 2 && strtoupper($user_code_info) == strtoupper($code_info)) {
	$sql = "SELECT * FROM organizaciones WHERE estado_organizacion='$user_region' ORDER BY nombre_organizacion";
	$stmt = $conn->prepare($sql);
	$stmt->execute();

	// no facilitadores reportando con otro codigo busca instituciones vinculadas a ese infocentro
} else if ($user_type != 2 && strtoupper($user_code_info) != strtoupper($code_info)) {
	$sql = "SELECT * FROM organizaciones WHERE UPPER(code_info)='$code_info' ORDER BY nombre_organizacion";
	$stmt = $conn->prepare($sql);
	$stmt->execute();
}



$html = "<option value=''>- SELECCIONE -</option>";



$res = array();
if ($stmt->rowCount() == 0) {
	$res = array();
} else {
	while ($r = $stmt->fetchAll(PDO::FETCH_OBJ)) {
		$res[] = $r;
	}
}
// print_r($res[0]);

if (count($res) >= 1) {
	$html = "<option value=''>- SELECCIONE -</option>";
}
$html .= "<option value='' disabled>----ORGANIZACIONES----</option>";


if (count($res) > 0) {
	if (count($res[0]) > 0) {
		foreach ($res[0] as $row) {
			$html .= "<option data-e_address='" . $row->direccion . "' data-id_institucion='" . $row->id . "' value='" . $row->nombre_organizacion . "'>" . $row->code_info . "-" . $row->nombre_organizacion . " </option>";
		}
		$array = array(
			"html"  => $html,
			"total" => count($res[0]),
		);
	}
}


echo json_encode($array, JSON_FORCE_OBJECT);
