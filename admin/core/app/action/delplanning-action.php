<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/**
 * InfoApp
 * @author Jarcelo
 **/
$pag = $_GET["pag"];
if ($pag == "") {
    $pag = "1";
}
$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];
$user_code_info = $_SESSION['user_code_info'];

$id_activity = $_GET["id"];
$estado = $_GET["estado"];
$start_at = $_GET["start_at"];
$finish_at = $_GET["finish_at"];
$info_id = $_GET["info_id"];


$sql = "delete from participants_list where id_activity= ?;";
ExecutorPg::del($sql,(int)$id_activity);

$sql = "delete from products_list where id_activity= ?;";
ExecutorPg::del($sql,(int)$id_activity);

$report = ReportActivityData::getByIdPg((int)$id_activity);
// $total_part_f = count(ParticipantsData::getBySQL("SELECT * from participants_list where id_activity=$id_activity AND gender='Mujer' ")[0]);
// $total_part_m = count(ParticipantsData::getBySQL("SELECT * from participants_list where id_activity=$id_activity AND gender='Hombre' ")[0]);

$sql = "SELECT * from participants_list where id_activity='$id_activity' AND gender='Mujer';";
$result_f = ExecutorPg::get($sql)[1];

$sql = "SELECT * from participants_list where id_activity='$id_activity' AND gender='Hombre';";
$result_m = ExecutorPg::get($sql)[1];

// set log
$log = new LogDelete();
$log->user_id = $user_id . "| " . $user_name;
$log->user_code_info = $user_code_info;
$log->id_deleted = $id_activity;
$log->code_deleted = $report["code_info"];
$log->state_deleted = $report["estate"];
$log->type_deleted = "Planificada";
$log->activity_title = $report["activity_title"];
$log->line_action = $report["line_action"];
$log->t_hombres = $result_f;
$log->t_mujeres = $result_m;
$log->add();
// end set log

$images_to_del = explode(", ", $report["image"]);

$sql = "delete from reports where id= ?;";
ExecutorPg::del($sql,(int)$id_activity);



// eliminar imagenes
$imagePath  = "uploads/images/reports/";
foreach ($images_to_del as $i) {
    $preview_1 = str_replace("origin_1", "preview_1", $i);
    // echo $imagePath.$i;

    if (is_writable($imagePath . $i)) {
        $outPut = unlink($imagePath . $i);
    } else {
        $outPut = "No se pudo eliminar la imagen";
    }

    if (file_exists($imagePath . $preview_1)) {
        unlink($imagePath . $preview_1);
    }
    # Prueba
    // var_dump($outPut); 
}

if ($_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7) {
    print "<script>window.location='index.php?view=planning&swal=Eliminado" . "&estado=&participantes=" . $participantes . "&start_at=" . $start_at . "&finish_at=" . $finish_at . "&pag=" . $pag . "&info_id=" . $info_id . "&q=" ."';</script>";
} else {
    print "<script>window.location='index.php?view=planning&swal=Eliminado" . "&estado=" . $estado . "&participantes=" . $participantes . "&start_at=" . $start_at . "&finish_at=" . $finish_at . "&pag=" . $pag . "&info_id=" . $info_id . "&q=" ."';</script>";
}
