<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$input = file_get_contents('php://input');
$data = json_decode($input, true);


$id = $data["product_id"];
$rx = LinksData::getLinksByProductId($id);

echo json_encode($rx);

