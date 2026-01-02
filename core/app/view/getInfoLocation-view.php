<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$code_info = strtoupper($_POST['code_info']);
// $code_info = "AMA16";

if ($code_info == "SEDE" || $code_info == "sede") {
    $array = array(
        "nombre"  => "SEDE CENTRAL",
        "estado"  => "DC",
        "municipio"  => "N/A",
        "parroquia"  => "N/A",
        "ciudad"  => "N/A",
        "tipo_zona"  => "N/A",
    );
    echo json_encode($array);
    return;
}


// info con postgres
include('../../controller/DatabasePg.php');
$conn = DatabasePg::connectPg();
$row_table = $conn->prepare("SELECT * from infocentros where cod = '$code_info' ");
$row_table->execute();
$info = $row_table->fetchAll(PDO::FETCH_ASSOC);

if (count($info) > 0) {
    foreach ($info as $row) {
        if ($row['nombre'] != "") {
            $array = array(
                "nombre"  => $row['nombre'],
                "estado"  => $row['estado'],
                "municipio"  => $row['municipio'],
                "parroquia"  => $row['parroquia'],
                "ciudad"  => $row['ciudad'],
                "tipo_zona"  => $row['tipo_zona'],
            );
        } else {
            $array = array(
                "nombre"  => "El infocentro con ese código no tiene nombre en la Infoapp",
            );
        }
    }
} else {
    $array = array(
        "nombre"  => "No se encontró un infocentro con ese código",
    );
}
echo json_encode($array);
