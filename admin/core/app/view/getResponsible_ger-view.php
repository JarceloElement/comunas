<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$search = $_POST['search'];
$info_cod = trim(strtoupper($_POST['info_cod']));
$estado = $_POST['estado'];

require('../../../core/controller/DatabasePg_admin.php');
$conn = DatabasePg::connectPg();
$sql = "SELECT * FROM gerencias where ( f_name like '%$search%' or f_lastname like '%$search%' or CAST(REPLACE(document_number,'.','') AS varchar) = '$search') ";
$stmt = $conn->prepare($sql);
$stmt->execute();
$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
// print_r($res);


if (count($res) > 0) {
    foreach ($res as $row) {
        if ($row['f_name'] != "") {
            $array = array(
                "nombre"  => $row['f_name'] . " " . $row['f_lastname'],
                // "telefono"  => str_replace("-","",$row['phone_number']),
                "telefono"  => $row['phone_number'],
                // "dni"  => str_replace(".","",str_replace("V-","",$row['document_number']) ),
                "dni"  => $row['document_number'],
                "email"  => $row['email'],
                "personal_type"  => $row['personal_type'],

            );
        } else {
            $array = array(
                "error" => "true",
                "message"  => "No hay datos",
            );
        }
    }
} else {
    $array = array(
        "error" => "true",
        "message"  => "La gerencia no se encuentra vinculada con un código de infocentro, por favor consulta con la gerencia de Políticas públicas para crearlo.",
    );
}

echo json_encode($array);
