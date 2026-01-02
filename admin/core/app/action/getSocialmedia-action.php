<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$conn = DatabasePg::connectPg();
$sql = "SELECT * FROM social_medias order by nombre asc";
$stmt = $conn->prepare($sql);
$stmt->execute();
$res = $stmt->fetchAll(PDO::FETCH_ASSOC);

$array = array(
    "array"  => 'null',
    "message"  => 'null',
);

if (count($res) > 0) {
    $array = array(
        "array"  => $res,
        "message"  => "True",
    );
} else {
    $array = array(
        "array"  => "null",
        "message"  => "No hay registros",
    );
}
echo json_encode($array);
