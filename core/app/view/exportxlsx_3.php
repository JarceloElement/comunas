<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include XLSX generator library 
require_once '../../../assets/PhpXlsxGenerator/PhpXlsxGenerator.php';
// require __DIR__ . '/assets/PhpXlsxGenerator/PhpXlsxGenerator.php';
require('../../controller/DatabasePg.php');
$db = DatabasePg::connectPg();

// $set_query = "SELECT facilitators.info_cod, facilitators.estate, facilitators.status_nom, facilitators.personal_type, facilitators.name, facilitators.lastname, facilitators.document_number, facilitators.phone_number, facilitators.gender, facilitators.email, final_users.red_x, final_users.red_facebook, final_users.red_instagram, final_users.red_linkedin, final_users.red_youtube, final_users.red_tiktok, final_users.red_whatsapp, final_users.red_telegram, final_users.red_snapchat, final_users.red_pinterest from facilitators INNER JOIN final_users ON (REGEXP_SUBSTR(final_users.user_dni,'[0-9]+') = REGEXP_SUBSTR(facilitators.document_number,'[0-9]+')) WHERE facilitators.estate='Amazonas' AND (final_users.red_x!='' or final_users.red_facebook!='' or final_users.red_instagram!='' or final_users.red_linkedin!='' or final_users.red_youtube!='' or final_users.red_tiktok!='' or final_users.red_whatsapp!='' or final_users.red_telegram!='' or final_users.red_snapchat!='') GROUP BY facilitators.document_number order by facilitators.estate desc";

$set_query = $_GET['param'];
$filename = $_GET['filename'];
$param_sql = $_GET['param_sql'];

if ($param_sql == "true"){
  $query = $db->prepare($set_query);
}else{
  $query = $db->prepare("SELECT * FROM ".$set_query);
}

$query->execute();
$TotalReg = $query->rowCount();
$result = $query->fetchAll(PDO::FETCH_ASSOC);

$fields_name = json_decode(json_encode($result[0]), true);
$fields = array_keys($fields_name);
// array_unshift($result, $fields);

$excelData = array();
$excelData[] = $fields;

if ($TotalReg > 0) {
  foreach ($result as $row) {
    $excelData[] = $row;
  }
}

// Export data to excel and download as xlsx file 
$xlsx = CodexWorld\PhpXlsxGenerator::fromArray( $excelData ); 
$xlsx->downloadAs($filename.".xlsx"); 


