

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$image = $_POST["image"];
$images_string = $_POST["images_string"];

// $image_name = explode("_",$image);
// if ($image_name[0] == "origin_1"){
//     $preview_1 = str_replace("origin_1", "preview_1", $image);
// }




// eliminar imagenes
$imagePath  = "uploads/images/reports/";

$preview_1 = str_replace("origin", "preview", $image);
$preview_1 = str_replace("jpg", "webp", $preview_1);
// echo $imagePath.$i;



$image_array = explode(", ", $images_string);
if (in_array($image, $image_array)) {
    // buscar el field en el array y lo borramos
    if (($pos = array_search($image, $image_array)) !== false) {
        unset($image_array[$pos]);
    }
}
if (in_array($preview_1, $image_array)) {
    // buscar el field en el array y lo borramos
    if (($pos = array_search($preview_1, $image_array)) !== false) {
        unset($image_array[$pos]);
    }
}


// convertir array en cadena
$images_string = implode(", ", $image_array);




if (is_writable($imagePath . $image)) {
    $outPut = unlink($imagePath . $image);
} else {
    $outPut = "No se pudo eliminar la imagen";
}

if (file_exists($imagePath . $preview_1)) {
    unlink($imagePath . $preview_1);
}
# Prueba

// $param = ReportActivityData::getById($_POST["id"]);
// $param->image = $images_string;
// $param->update();

$sql = "UPDATE reports	set image = ? where id = ?;";
$values = [$images_string, (int)$_POST["id"]];
ExecutorPg::update($sql, $values);

// var_dump($image); 
echo $outPut;

?>