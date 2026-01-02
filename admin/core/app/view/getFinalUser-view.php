<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// HTTP_HOST
// DOCUMENT_ROOT

$search = $_POST['search'];
$cedulado = $_POST['cedulado'];
require('../../../core/controller/DatabasePg_admin.php');

$Cadena = "";
if (is_string((int)$search)) {
    $Cadena = "Si";
} else {
    $Cadena = "No";
}


if ($cedulado == "Si") {
    if ($Cadena == "Si") {
        $sql = "SELECT * from final_users where (user_nombres='$search' or user_apellidos='$search' or user_correo='$search')";
    } else {
        $sql = "SELECT * from final_users where (user_dni= '$search' or id= '$search')";
    }
} else {
    if ($Cadena == "Si") {
        $sql = "SELECT * from final_users where (user_nombres='$search' or user_apellidos='$search' or user_correo='$search') and user_has_document!='Si'";
    } else {
        $sql = "SELECT * from final_users where (id=$search or (parent_ref='$search' and parent_ref!='') ) and user_has_document!='Si'";
    }
}

$conn = DatabasePg::connectPg();
$stmt = $conn->prepare($sql);
$stmt->execute();
$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
// print_r($res);

if (count($res) > 0) {
    if (count($res[0]) > 0) {
        foreach ($res as $row) {
            // echo $row['user_nombres'];
            if ($row['user_dni'] != "") {
                $array = array(
                    "param"  => $Cadena,
                    "aviso"  => "Usuario cargado, verifica que sea correcto",
                    "user_f_id"  => $row['id'],
                    "user_nombres"  => ucfirst(strtolower($row['user_nombres'])),
                    "user_apellidos"  => ucfirst(strtolower($row['user_apellidos'])),
                    "user_dni"  => $row['user_dni'],
                    "user_correo"  => $row['user_correo'],
                    "user_telefono"  => $row['user_telefono'],
                    "user_genero"  => $row['user_genero'],
                    "user_comunity_type"  => $row['user_comunity_type'],
                    "user_pertenece_organizacion"  => $row['user_pertenece_organizacion'],
                    "disability_type"  => $row['disability_type'],
                    "user_f_nacimiento"  => $row['user_f_nacimiento'],
                    "user_edad"  => $row['user_edad'],
                    "user_nivel_academ"  => $row['user_nivel_academ'],
                    "user_profesion"  => $row['user_profesion'],
                    "user_ocupacion"  => $row['user_ocupacion'],
                    "user_empleado"  => $row['user_empleado'],
                    "user_institucion"  => $row['user_institucion'],
                    "user_estado"  => $row['user_estado'],
                    "user_municipio"  => $row['user_municipio'],
                    "user_direccion"  => $row['user_direccion'],
                    "user_has_document"  => $row['user_has_document'],
                    "user_etnia"  => $row['user_etnia'],
                    "user_disability_type"  => $row['disability_type'],
                );
            } else {
                $array = array(
                    "aviso"  => "No existe este usuario",
                    "user_nombres"  => "No existe este usuario",
                    "user_apellidos"  => "",
                );
            }
        }
    } else {
        $array = array(
            "aviso"  => "No existe este usuario",
            "user_nombres"  => "No existe este usuario",
            "user_apellidos"  => "",
        );
    }
} else {
    $array = array(
        "aviso"  => "No existe este usuario",
        "user_nombres"  => "No existe este usuario",
        "user_apellidos"  => "",
    );
}
echo json_encode($array, JSON_FORCE_OBJECT);
// Database::disconnect();
