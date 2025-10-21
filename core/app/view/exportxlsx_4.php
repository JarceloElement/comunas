<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// Include XLSX generator library 
require_once '../../../assets/PhpXlsxGenerator/PhpXlsxGenerator.php';
require('../../controller/DatabasePg.php');
$db = DatabasePg::connectPg();

// $set_query = "SELECT facilitators.info_cod, facilitators.estate, facilitators.status_nom, facilitators.personal_type, facilitators.name, facilitators.lastname, facilitators.document_number, facilitators.phone_number, facilitators.gender, facilitators.email, final_users.red_x, final_users.red_facebook, final_users.red_instagram, final_users.red_linkedin, final_users.red_youtube, final_users.red_tiktok, final_users.red_whatsapp, final_users.red_telegram, final_users.red_snapchat, final_users.red_pinterest from facilitators INNER JOIN final_users ON (REGEXP_SUBSTR(final_users.user_dni,'[0-9]+') = REGEXP_SUBSTR(facilitators.document_number,'[0-9]+')) WHERE facilitators.estate='Amazonas' AND (final_users.red_x!='' or final_users.red_facebook!='' or final_users.red_instagram!='' or final_users.red_linkedin!='' or final_users.red_youtube!='' or final_users.red_tiktok!='' or final_users.red_whatsapp!='' or final_users.red_telegram!='' or final_users.red_snapchat!='') GROUP BY facilitators.document_number order by facilitators.estate desc";

$set_query = $_GET['param'];
$filename = $_GET['filename'];
$param_sql = $_GET['param_sql'];

if ($param_sql == "true") {
  $query = $db->prepare($set_query);
} else {
  $query = $db->prepare("SELECT * FROM " . $set_query);
}

$query->execute();
$TotalReg = $query->rowCount();
$result = $query->fetchAll(PDO::FETCH_ASSOC);

$fields_name = json_decode(json_encode($result[0]), true);
$fields = array_keys($fields_name);
// array_unshift($result, $fields);

require_once '../../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

$documento = new Spreadsheet();
$documento
  ->getProperties()
  ->setCreator("Nestor Tapia")
  ->setLastModifiedBy('BaulPHP')
  ->setTitle('Archivo generado desde MySQL')
  ->setDescription('Productos y proveedores exportados desde MySQL');

$hojaDeProductos = $documento->getActiveSheet();
$hojaDeProductos->setTitle("Productos");

# Encabezado de los productos en la fila 1
$hojaDeProductos->fromArray($fields, null, 'A1');

# Comenzamos en la fila 2
$numeroDeFila = 2;

if ($TotalReg > 0) {
  foreach ($result as $row) {
    $row_data = implode("}",$row);
    $data = explode("}",$row_data);

    $hojaDeProductos->setCellValue([1, $numeroDeFila], $data[0]);
    $hojaDeProductos->setCellValue([2, $numeroDeFila], $data[1]);
    $hojaDeProductos->setCellValue([3, $numeroDeFila], $data[2]);
    $hojaDeProductos->setCellValue([4, $numeroDeFila], $data[3]);
    $hojaDeProductos->setCellValue([5, $numeroDeFila], $data[4]);
    $hojaDeProductos->setCellValue([6, $numeroDeFila], $data[5]);
    $hojaDeProductos->setCellValue([7, $numeroDeFila], $data[6]);
    $hojaDeProductos->setCellValue([8, $numeroDeFila], $data[7]);
    $hojaDeProductos->setCellValue([9, $numeroDeFila], $data[8]);
    $hojaDeProductos->setCellValue([10, $numeroDeFila], $data[9]);
    $hojaDeProductos->setCellValue([11, $numeroDeFila], $data[10]);
    $hojaDeProductos->setCellValue([12, $numeroDeFila], $data[11]);
    $hojaDeProductos->setCellValue([13, $numeroDeFila], $data[12]);
    $hojaDeProductos->setCellValue([14, $numeroDeFila], $data[13]);
    $hojaDeProductos->setCellValue([15, $numeroDeFila], $data[14]);
    $hojaDeProductos->setCellValue([16, $numeroDeFila], $data[15]);
    $hojaDeProductos->setCellValue([17, $numeroDeFila], $data[16]);
    $hojaDeProductos->setCellValue([18, $numeroDeFila], $data[17]);
    $hojaDeProductos->setCellValue([19, $numeroDeFila], $data[18]);
    $hojaDeProductos->setCellValue([20, $numeroDeFila], $data[19]);
    $hojaDeProductos->setCellValue([21, $numeroDeFila], $data[20]);
    $hojaDeProductos->setCellValue([22, $numeroDeFila], $data[21]);
    $hojaDeProductos->setCellValue([23, $numeroDeFila], $data[22]);
    $hojaDeProductos->setCellValue([24, $numeroDeFila], $data[23]);
    $hojaDeProductos->setCellValue([25, $numeroDeFila], $data[24]);
    $hojaDeProductos->setCellValue([26, $numeroDeFila], $data[26]);
    $hojaDeProductos->setCellValue([27, $numeroDeFila], $data[26]);
    $hojaDeProductos->setCellValue([28, $numeroDeFila], $data[27]);
    $hojaDeProductos->setCellValue([29, $numeroDeFila], $data[28]);
    $hojaDeProductos->setCellValue([30, $numeroDeFila], $data[29]);
    $hojaDeProductos->setCellValue([31, $numeroDeFila], $data[30]);
    $hojaDeProductos->setCellValue([32, $numeroDeFila], $data[31]);
    $hojaDeProductos->setCellValue([33, $numeroDeFila], $data[32]);

    $numeroDeFila++;
  }
}


// # Ahora creamos la hoja "proveedores"
// $hojaDeProveedores = $documento->createSheet();
// $hojaDeProveedores->setTitle("Proveedores");

// # Declaramos el encabezado
// $encabezado = ["Nombres", "Dirección Email ", "Empresa", "Pais residencia"];
// $hojaDeProveedores->fromArray($encabezado, null, 'A1');



# Crear un "escritor"
$writer = new Xlsx($documento);
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="' . urlencode($fileName.".xlsx") . '"');
$writer->save('php://output');

// $writer = IOFactory::createWriter($documento,'Xlsx');
// header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
// header('Content-Disposition: attachment; filename="'. urlencode($fileName).'"');
// $writer->save('php://output');