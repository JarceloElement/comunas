<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
session_start();

require('../../../core/controller/Database_admin.php');
$db = Database::connectPDO();

$html = "<option value=''>- SELECCIONE -</option>";

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

	$statement_1 = $db->query("SELECT info_social_map_educations.school_name as e_name, info_social_map_educations.id as id_escuela, info_social_map_educations.school_address as e_address, info_social_map_educations.isnt_type as isnt_type FROM info_social_map_educations where info_social_map_educations.school_name != '' and info_social_map_educations.school_name != 'null' and info_social_map_educations.s_state='$user_region' GROUP BY info_social_map_educations.school_name, info_social_map_educations.id, info_social_map_educations.school_address, info_social_map_educations.isnt_type ORDER BY info_social_map_educations.school_name");
	$res = $statement_1->fetchAll(PDO::FETCH_ASSOC);
	$statement_2 = $db->query("SELECT info_social_map_organizations.organization_name as e_name, info_social_map_organizations.id as id_institucion, info_social_map_organizations.organization_address as e_address, info_social_map_organizations.organization_type as isnt_type FROM info_social_map_organizations where info_social_map_organizations.organization_name != '' and info_social_map_organizations.organization_name != 'null' and info_social_map_organizations.o_state='$user_region' GROUP BY info_social_map_organizations.organization_name, info_social_map_organizations.id, info_social_map_organizations.organization_address, info_social_map_organizations.isnt_type ORDER BY info_social_map_organizations.organization_name");
	$res_2 = $statement_2->fetchAll(PDO::FETCH_ASSOC);

	// no facilitadores reportando con su mismo codigo busca instituciones vinculadas a su region
} else if ($user_type != 2 && strtoupper($user_code_info) == strtoupper($code_info)) {
	$statement_1 = $db->query("SELECT info_social_map_educations.school_name as e_name, info_social_map_educations.id as id_escuela, info_social_map_educations.school_address as e_address, info_social_map_educations.isnt_type as isnt_type FROM info_social_map_educations where info_social_map_educations.school_name != '' and info_social_map_educations.school_name != 'null' and info_social_map_educations.s_state='$user_region' GROUP BY info_social_map_educations.school_name, info_social_map_educations.id, info_social_map_educations.school_address, info_social_map_educations.isnt_type ORDER BY info_social_map_educations.school_name");
	$res = $statement_1->fetchAll(PDO::FETCH_ASSOC);
	$statement_2 = $db->query("SELECT info_social_map_organizations.organization_name as e_name, info_social_map_organizations.id as id_institucion, info_social_map_organizations.organization_address as e_address, info_social_map_organizations.organization_type as isnt_type FROM info_social_map_organizations where info_social_map_organizations.organization_name != '' and info_social_map_organizations.organization_name != 'null' and info_social_map_organizations.o_state='$user_region' GROUP BY info_social_map_organizations.organization_name, info_social_map_organizations.id, info_social_map_organizations.organization_address, info_social_map_organizations.isnt_type ORDER BY info_social_map_organizations.organization_name");
	$res_2 = $statement_2->fetchAll(PDO::FETCH_ASSOC);

	// no facilitadores reportando con otro codigo busca instituciones vinculadas a ese infocentro
} else if ($user_type != 2 && strtoupper($user_code_info) != strtoupper($code_info)) {
	$statement_1 = $db->query("SELECT info_social_map_educations.school_name as e_name, info_social_map_educations.id as id_escuela, info_social_map_educations.school_address as e_address, info_social_map_educations.isnt_type as isnt_type FROM info_social_map_educations where info_social_map_educations.school_name != '' and info_social_map_educations.school_name != 'null' and info_social_map_educations.code_info='$code_info' GROUP BY info_social_map_educations.school_name, info_social_map_educations.id, info_social_map_educations.school_address, info_social_map_educations.isnt_type ORDER BY info_social_map_educations.school_name");
	$res = $statement_1->fetchAll(PDO::FETCH_ASSOC);
	$statement_2 = $db->query("SELECT info_social_map_organizations.organization_name as e_name, info_social_map_organizations.id as id_institucion, info_social_map_organizations.organization_address as e_address, info_social_map_organizations.organization_type as isnt_type FROM info_social_map_organizations where info_social_map_organizations.organization_name != '' and info_social_map_organizations.organization_name != 'null' and info_social_map_organizations.code_info='$code_info' GROUP BY info_social_map_organizations.organization_name, info_social_map_organizations.id, info_social_map_organizations.organization_address, info_social_map_organizations.isnt_type ORDER BY info_social_map_organizations.organization_name");
	$res_2 = $statement_2->fetchAll(PDO::FETCH_ASSOC);
}



if (count($res) > 1) {
	$html = "<option value=''>- SELECCIONE -</option>";
}
// esc
if (isset($res)) {
	$html .= "<option value='' disabled>----INSTITUCIONES EDUCATIVAS----</option>";

	foreach ($res as $row) {
		$html .= "<option data-isnt_type='" . $row['isnt_type'] . "' data-e_address='" . $row['e_address'] . "' data-id_institucion='" . $row['id_escuela'] . "' value='" . $row['e_name'] . "'>" . $row['e_name'] . " </option>";
	}
	$array = array(
		"html"  => $html,
	);
}
// inst
if (isset($res_2)) {
	$html .= "<option style='background-color: lightblue;' value='' disabled>----ORGANIZACIONES----</option>";

	foreach ($res_2 as $row) {
		$html .= "<option data-isnt_type='" . $row['isnt_type'] . "' data-e_address='" . $row['e_address'] . "' data-id_institucion='" . $row['id_institucion'] . "' value='" . $row['e_name'] . "'>" . $row['e_name'] . " </option>";
	}
	$array = array(
		"html"  => $html,
	);
}


echo json_encode($array, JSON_FORCE_OBJECT);
