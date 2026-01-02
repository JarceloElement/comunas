<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// info con postgres
include('../../controller/DatabasePg.php');
require ('../../controller/Database.php');

$base = new Database();
$db = $base->connectPDO();

$id_estado = $_POST['id_estado'];

$statement_1 = $db->query("SELECT * FROM estados WHERE id_estado = '$id_estado'");
$res = $statement_1->fetchAll();

$nombre_estado = $res[0]["estado"];

$conn = DatabasePg::connectPg();


$row_table = $conn->prepare("SELECT * from brigades where estado = '$nombre_estado' ");
$row_table->execute();
$brigadas = $row_table->fetchAll(PDO::FETCH_ASSOC);

$html= "<option value=''>- SELECCIONAR BRIGADA -</option>";

if(isset($brigadas)){
    foreach ($brigadas as $row){
        $html.= "<option value='".$row['id']."'>".$row['nombre']."</option>";
        
    }
}
echo $html;



