<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// HTTP_HOST
// DOCUMENT_ROOT

require_once('../../controller/DatabasePg_admin.php');

$search = $_POST['search'];
$user_nombres = $_POST['user_nombres'];
$user_nombre_2 = $_POST['user_nombre_2'];
$user_apellidos = $_POST['user_apellidos'];
$user_has_document = $_POST['user_has_document'];
$user_f_nacimiento = $_POST['user_f_nacimiento'];
$aviso = "";

// echo $user_f_nacimiento;
// TO_DATE('".$start_at."', 'DD-MM-YYYY')

$conn = DatabasePg::connectPg();
$total_data = array();

if ($search != "") {
    $row = $conn->prepare("SELECT * from final_users where id='" . (int)$search . "' or (user_nombres like '%$search%' or user_dni like '" . (int)$search . "' or user_correo='$search')");
    $row->execute();
    $total_data = $row->fetchAll(PDO::FETCH_ASSOC);
} else {
    $row = $conn->prepare("SELECT * from final_users where (user_nombres='$user_nombres' and user_nombre_2='$user_nombre_2' and user_apellidos='$user_apellidos' and user_has_document='$user_has_document' and user_f_nacimiento='$user_f_nacimiento')");
    $row->execute();
    $total_data = $row->fetchAll(PDO::FETCH_ASSOC);
    // $total_person = $total_data[0]["total"];
}



if (count($total_data) < 1) {
    $aviso = "Usuario no registrado todavía.";
    $array = array(
        "error" => "true",
        "param"  => $aviso,
        "name"  => "No result",
    );
    echo json_encode($array);
    return;
}

if (count($total_data[0]) > 0) {
    $aviso = "Se han cargado datos de un usuario, verifica su DNI y que los datos estén correctos";

    $array = array(
        "param"  => $aviso,
        "error" => "false",
        "id_final_user"  => $total_data[0]['id'],
        "document_id"  => $total_data[0]['user_dni'],
        "parent_ref"  => $total_data[0]['parent_ref'],
        "parent_dni"  => $total_data[0]['parent_dni'],
        "child_number"  => $total_data[0]['child_number'],
        "name"  => $total_data[0]['user_nombres'],
        "name_2"  => $total_data[0]['user_nombre_2'],
        "lastname"  => $total_data[0]['user_apellidos'],
        "lastname_2"  => $total_data[0]['user_apellido_2'],
        "user_f_nacimiento"  => $total_data[0]['user_f_nacimiento'],
        "age"  => $total_data[0]['user_edad'],
        "gender"  => $total_data[0]['user_genero'],
        "user_comunity_type"  => $total_data[0]['user_comunity_type'],
        "user_pertenece_organizacion"  => $total_data[0]['user_pertenece_organizacion'],
        "phone"  => $total_data[0]['user_telefono'],
        "email"  => $total_data[0]['user_correo'],
        "user_nationality"  => $total_data[0]['user_nationality'],
        "user_has_document"  => $total_data[0]['user_has_document'],
        "user_etnia"  => $total_data[0]['user_etnia'],
        "disability_type"  => $total_data[0]['disability_type'],
        "user_profesion"  => $total_data[0]['user_profesion'],
        "user_ocupacion"  => $total_data[0]['user_ocupacion'],
        "user_equipo_sala_comunal"  => $total_data[0]['user_equipo_sala_comunal'],
    );
} else {
    $array = array(
        "error" => "true",
        "param"  => "Error en ajax",
        "name"  => "No result",
    );
}

echo json_encode($array);
