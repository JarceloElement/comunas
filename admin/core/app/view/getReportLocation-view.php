		


<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);


$code_info = trim(strtoupper($_POST['code_info']));

// include('../../controller/DatabasePg.php');
require_once('../../controller/DatabasePg_admin.php');
$conn = DatabasePg::connectPg();

$row = $conn->prepare("SELECT * FROM infocentros WHERE cod='$code_info'");
$row->execute();
$data = $row->fetch(PDO::FETCH_ASSOC);

if ($data["id"] == "") {
    $array = array(
        "error" => "true",
        "param"  => "Aviso",
        "name"  => "No se encontró el infocentro",
    );
    echo json_encode($array);
    return;
}

if ($data["id"] != "") {
    $array = array(
        "error" => "false",
        "info_id"  => $data['id'],
        "nombre"  => $data['nombre'],
        "estado"  => $data['estado'],
        "municipio"  => $data['municipio'],
        "parroquia"  => $data['parroquia'],
        "ciudad"  => $data['ciudad'],
        "direccion"  => $data['direccion'],
    );
    echo json_encode($array);
}

?>


