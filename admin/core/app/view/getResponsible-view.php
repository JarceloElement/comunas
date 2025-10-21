<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// $search = 14133014;
// $info_cod = 'ANZ08';
$search = $_POST['search'];
$info_cod = $_POST['info_cod'];


if ($info_cod != "") {

    require('../../../core/controller/DatabasePg_admin.php');
    $sql = "SELECT * FROM facilitators where (f_name like '%$search%' or CAST(REPLACE(document_number,'.','') AS varchar) = '$search') ";
    $conn = DatabasePg::connectPg();
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($res) > 0) {
        foreach ($res as $row) {

            if (strtoupper($row['info_cod']) != strtoupper($info_cod)) {
                $array = array(
                    "error" => "true",
                    "message"  => "ATENCIÓN - El código de infocentro colocado no coincide con el que tienes registrado. Tu código de facilitador registrado es: (" . $row['info_cod'] . "). Por favor solicita a tu gerencia estadal para que revise tus datos de usuario.",
                );
                echo json_encode($array);
                return;
            } else if ($row['f_name'] == "") {
                $array = array(
                    "error" => "true",
                    "message"  => "No se encontraron los datos del responsable",
                );
                echo json_encode($array);
                return;
            } else if ($row['f_name'] != "") {
                $array = array(
                    "nombre"  => $row['f_name'] . " " . $row['f_lastname'],
                    "telefono"  => $row['phone_number'],
                    "dni"  => $row['document_number'],
                    "email"  => $row['email'],
                    "personal_type"  => $row['personal_type'],
                    "message"  => $row['f_name'] . " " . $row['f_lastname'],
                );
            } else {
                $array = array(
                    "error" => "true",
                    "message"  => "El responsable no está en ese infocentro o no es facilitador",
                );
            }
        }
    } else {
        $array = array(
            "error" => "true",
            "message"  => "El responsable no está en ese infocentro o no es facilitador",
        );
    }

    echo json_encode($array);
} else {
    $array = array(
        "error" => "true",
        "message"  => "Debes asignar el código del infocentro primero",
    );
    echo json_encode($array);
}
