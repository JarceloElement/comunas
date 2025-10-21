<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$search = $_POST['search'];
$info_cod = trim(strtoupper($_POST['info_cod']));
// $search = '25054122';
// $info_cod = 'AMA05';


if ($info_cod != "") {

    require('../../../core/controller/DatabasePg.php');
    $conn = DatabasePg::connectPg();
    $sql = "SELECT * FROM facilitators where ( CAST(REPLACE(document_number,'.','') AS varchar) = '$search') and UPPER(info_cod)='$info_cod' ";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // print_r($stmt);
    $array = array(
        "message"  => 'null',
    );

    if (count($res) > 0) {
        foreach ($res as $row) {
            if ($row['document_number'] != "") {

                $array = array(
                    "nombre"  => $row['f_name'],
                    "apellido"  => $row['f_lastname'],
                    "telefono"  => $row['phone_number'],
                    "dni"  => $row['document_number'],
                    "email"  => $row['email'],
                    "personal_type"  => $row['personal_type'],
                    "message"  => $row['f_name'] . " " . $row['f_lastname'],
                );
            } else {
                $array = array(
                    "nombre"  => "El responsable no está en ese infocentro",
                    "message"  => "El responsable no está en ese infocentro",
                );
            }
        }
    } else {
        $array = array(
            "nombre"  => "El responsable no está en ese infocentro",
            "message"  => "El responsable no está en ese infocentro",
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
