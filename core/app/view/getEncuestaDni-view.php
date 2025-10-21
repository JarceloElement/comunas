<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require('../../../core/controller/DatabasePg.php');
$search = $_POST['search'];

$sql = "SELECT * from encuesta_capacidades_tecnologicas where user_dni='$search' ";
$conn = DatabasePg::connectPg();
$stmt = $conn->prepare($sql);
$stmt->execute();
$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
// print_r($res);

$array = array(
    "message"  => 'null',
);

if (count($res) > 0) {
    if (count($res[0]) > 0) {
        foreach ($res as $row) {
            // echo $row['user_nombres'];
            if ($row['user_dni'] != "") {

                $message = "El usuario ya está encuestado";
                $array = array(
                    "message"  => $message,
                );
            } else {
                $array = array(
                    "message"  => 'null',
                );
            }
        }
    }
}
echo json_encode($array);
