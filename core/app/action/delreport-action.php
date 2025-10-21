<?php
/**
* InfoApp
* @author Jarcelo
**/
$pag = $_GET["pag"];
if ($pag == ""){
    $pag = "1";
}

$id_activity = $_GET["id"];
$estado = $_GET["estado"];
$participantes = $_GET["participantes"];
$start_at = $_GET["start_at"];
$finish_at = $_GET["finish_at"];

$del_participant = new ParticipantsData();
$del_participant->id_activity = $id_activity;
$del_participant->delByIdActivity();

$del_product = new ProductsData();
$del_product->id_activity = $id_activity;
$del_product->delByIdActivity();

$report = ReportActivityData::getById($id_activity);
$images_to_del = explode(", ",$report->image);
$report->del();


// eliminar imagenes
$imagePath  = "uploads/images/reports/";
foreach ($images_to_del as $i){
    $preview_1 = str_replace("origin_1", "preview_1", $i);
    // echo $imagePath.$i;

    if ( is_writable($imagePath.$i) ) { 
        $outPut = unlink($imagePath.$i); 
    } else { 
        $outPut ="No se pudo eliminar la imagen"; 
    }

    if (file_exists($imagePath.$preview_1)) {
        unlink($imagePath.$preview_1);
    }
    # Prueba
    // var_dump($outPut); 
}


print "<script>window.location='index.php?view=report&swal=Eliminado"."&estado=".$estado."&participantes=".$participantes."&start_at=".$start_at."&finish_at=".$finish_at."&pag=".$pag."';</script>";


?>