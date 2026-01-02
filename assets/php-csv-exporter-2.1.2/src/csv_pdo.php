<?php

use Sujan\Exporter\Exporter;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// require ('ExportFromPDOStatement.php');
require_once('Exporter.php');
require('../../../core/controller/DatabasePg.php');
$conn = DatabasePg::connectPg();

$param_csv = $_GET["param_csv"];
$param_sql = $_GET["param_sql"];
$DB_name = $_GET["DB_name"];


// Create the headers.
$header_args = array('ID', 'Name', 'Email');

// Prepare the content to write it to CSV file.
$data = array(
    array('1', 'Test 1', 'test1@test.com'),
    array('2', 'Test 2', 'test2@test.com'),
    array('3', 'Test 3', 'test3@test.com'),
);

$exporter = new Exporter;
$exporter->build($data, $header_args, 'users.csv');
$exporter->export();




return;

try {
    // $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // $stmt = $conn->prepare("SELECT id, name, email FROM users");
    // $stmt->execute();

    // // set the resulting array to associative
    // $stmt->setFetchMode(PDO::FETCH_ASSOC);

    // $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo $param_csv;
    $stmt = $conn->prepare($param_csv);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);


    $exporter = new Exporter();
    $exporter->build($stmt, $columns, 'users.csv')->export();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
