<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require ('../../controller/DatabasePg.php');
// $base = new Database();
// $db = $base->connectPDO();

$db = DatabasePg::connectPg();

// $query = $_POS['param'];
// $filename = $_POST['filename'];
// $fields[] = explode(",",$_POST['fields']);

// $set_query = "SELECT facilitators.info_cod, facilitators.estate, facilitators.status_nom, facilitators.personal_type, facilitators.name, facilitators.lastname, facilitators.document_number, facilitators.phone_number, facilitators.gender, facilitators.email, final_users.red_x, final_users.red_facebook, final_users.red_instagram, final_users.red_linkedin, final_users.red_youtube, final_users.red_tiktok, final_users.red_whatsapp, final_users.red_telegram, final_users.red_snapchat, final_users.red_pinterest from facilitators INNER JOIN final_users ON (REGEXP_SUBSTR(final_users.user_dni,'[0-9]+') = REGEXP_SUBSTR(facilitators.document_number,'[0-9]+')) WHERE facilitators.estate='Amazonas' AND (final_users.red_x!='' or final_users.red_facebook!='' or final_users.red_instagram!='' or final_users.red_linkedin!='' or final_users.red_youtube!='' or final_users.red_tiktok!='' or final_users.red_whatsapp!='' or final_users.red_telegram!='' or final_users.red_snapchat!='') GROUP BY facilitators.document_number order by facilitators.estate desc";
$set_query = $_GET['param'];
$filename = $_GET['filename'];
$param_sql = $_GET['param_sql'];
// $fields[] = explode(",",$_GET['fields']);
// echo $set_query;
// return;

// $query = "SELECT * from info_social_map WHERE user_type = 2 ";
// $result = $db->query($query);
// $res = $result->fetchAll(PDO::FETCH_ASSOC);

// query con prepare
// $query = $db->prepare("SELECT * from info_social_map WHERE user_type = 2 ");
// query to get data from database
if ($param_sql == "true"){
  $query = $db->prepare($set_query);
}else{
  $query = $db->prepare("SELECT * FROM ".$set_query);
}

$query->execute();
$res = $query->fetchAll(PDO::FETCH_ASSOC);
// print_r($res[0]);

// agregar los nombres de los campos al inicio
$fields_name = json_decode(json_encode($res[0]), true);
$fields = array_keys($fields_name);
array_unshift($res, $fields);

use Shuchkin\SimpleXLSXGen;

require_once '../../../assets/simplexlsx-master/src/SimpleXLSXGen.php';

$xlsx = SimpleXLSXGen::fromArray( $res );
$xlsx->downloadAs($filename.'.xlsx'); // or downloadAs('books.xlsx') or $xlsx_content = (string) $xlsx 

?>









