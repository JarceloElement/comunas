<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

$search = $_POST['search'];
$info_cod = trim(strtoupper($_POST['info_cod']));

require('../../../core/controller/DatabasePg.php');
$conn = DatabasePg::connectPg();
$sql = "SELECT * FROM coordinators where ( f_name like '%$search%' or f_lastname like '%$search%' or CAST(REPLACE(document_number,'.','') AS varchar) = '$search') ";
$stmt = $conn->prepare($sql);
$stmt->execute();
$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
// print_r($res);


$array = array(
    "nombre"  => "El Coordinador no está registrado",
);

if (count($res) > 0) {
    foreach ($res as $row) {
        if ($row['f_name'] != "") {
            $array = array(
                "nombre"  => $row['f_name'],
                "apellido"  => $row['f_lastname'],
                "telefono"  => $row['phone_number'],
                "dni"  => $row['document_number'],
                "email"  => $row['email'],
                "personal_type"  => $row['personal_type'],

            );
        } else {
            $array = array(
                "nombre"  => "El Coordinador no está registrado",
            );
        }
    }
} else {
    $array = array(
        "nombre"  => "El Coordinador no está registrado",
    );
}

echo json_encode($array);


