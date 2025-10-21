<?php

require ('../../controller/Database.php');
$db = Database::connectPDO();





// $query = $_POS['param'];
$filename = $_POST['filename'];
$fields[] = explode(",",$_POST['fields']);
// $fields = explode(",",$_GET['fields']);

// $query = "SELECT * from info_social_map WHERE user_type = 2 ";
// $result = $db->query($query);
// $res = $result->fetchAll(PDO::FETCH_ASSOC);

// query con prepare
$query = $db->prepare("SELECT * from info_social_map WHERE user_type = 2 ");
$query->execute();
$res = $query->fetchAll(PDO::FETCH_ASSOC);







$data = [];
$count = 0;
foreach($res as $row){
  $myArray = json_decode(json_encode($row), true);

  if ($count == 0){
    $array_keys = array_keys($myArray);
    // array_unshift($data , $array_keys);
  }

array_unshift($data , $fields);
$data[] = $row;

  $count++;
}


use Shuchkin\SimpleXLSXGen;

require_once '../../../assets/simplexlsx-master/src/SimpleXLSXGen.php';

$xlsx = SimpleXLSXGen::fromArray( $data );
$xlsx->downloadAs($filename.'.xlsx'); // or downloadAs('books.xlsx') or $xlsx_content = (string) $xlsx 

?>









