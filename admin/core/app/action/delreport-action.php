<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
/**
* InfoApp
* @author Jarcelo
**/
$pag = $_GET["pag"];
if ($pag == ""){
    $pag = "1";
}

$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];
$user_code_info = $_SESSION['user_code_info'];

$id_activity = $_GET["id"];
$estado = $_GET["estado"];
$participantes = $_GET["participantes"];
$start_at = $_GET["start_at"];
$finish_at = $_GET["finish_at"];

$total_part_f = count(ParticipantsData::getBySQL("SELECT * from participants_list where id_activity=$id_activity AND gender='Mujer' ")[0] );
$total_part_m = count(ParticipantsData::getBySQL("SELECT * from participants_list where id_activity=$id_activity AND gender='Hombre' ")[0] );

$del_participant = new ParticipantsData();
$del_participant->id_activity = $id_activity;
$del_participant->delByIdActivity();

$del_product = new ProductsData();
$del_product->id_activity = $id_activity;
$del_product->delByIdActivity();

$report = ReportActivityData::getById($id_activity);
// echo "XX".$id_activity;

// set log
$log = new LogDelete();
$log->user_id = $user_id."| ".$user_name;
$log->user_code_info = $user_code_info;
$log->id_deleted = $id_activity;
$log->code_deleted = $report->code_info;
$log->state_deleted = $report->estate;
$log->type_deleted = "Ejecutada";
$log->activity_title = $report->activity_title;
$log->line_action = $report->line_action;
$log->t_hombres = $total_part_m;
$log->t_mujeres = $total_part_f;
$log->add();
// end set log

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