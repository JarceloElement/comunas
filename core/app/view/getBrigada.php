<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$user_estado = $_POST['user_estado'];
// $code_info = "AMA16";


// info con postgres
include('../../controller/DatabasePg.php');
$conn = DatabasePg::connectPg();
$row_table = $conn->prepare("SELECT * from brigades where estado = '$user_estado' ");
$row_table->execute();
$brigadas = $row_table->fetchAll(PDO::FETCH_ASSOC);

if (count($brigadas) > 0) {
    foreach ($brigadas as $row) {
        if ($row['nombre'] != "") {
            $array = array(
                "id"  => $row['nombre'],
                "nombre"  => $row['estado'],
            );
        } 
    }
} else {
    $array = array(
        "nombre"  => "No se encontro brigadas en el estado: '$user_estado'",
    );
}
echo json_encode($array);


