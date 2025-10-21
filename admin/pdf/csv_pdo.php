<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require('../../core/controller/DatabasePg.php');
$conn = DatabasePg::connectPg();

$param_csv = $_GET["param_csv"];
$param_sql = $_GET["param_sql"];
$DB_name = $_GET["DB_name"];

// Start the output buffer.
ob_start();

// Set PHP headers for CSV output.
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=csv_export.csv');

$stmt = $conn->prepare($param_csv);
$stmt->execute();

// Create the headers.
// $fields_data = $stmt->setFetchMode(PDO::FETCH_ASSOC);

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
// $fields = array_keys($stmt->fetch(PDO::FETCH_ASSOC));

// print_r($result);
// return;

// Clean up output buffer before writing anything to CSV file.
ob_end_clean();

// Create a file pointer with PHP.
$output = fopen('php://output', 'w');

// agregar los nombres de los campos al inicio
$fields_name = json_decode(json_encode($result[0]), true);
$fields = array_keys($fields_name);
array_unshift($result, $fields);


foreach ($result as $data_item) {
    fputcsv($output, $data_item, $separator = "|", $enclosure = "'");
}

fclose($output);
exit;
