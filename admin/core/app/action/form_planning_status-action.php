<?php
/**
* infocentro
* @author jarcelo
**/


// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);


// se asigna en cpanel
ini_set('max_execution_time', '3000');
set_time_limit(600);

date_default_timezone_set('UTC');
date_default_timezone_set("America/La_Paz");



if(count($_POST)>0){
    
    $param = PlanningActivityData::getById($_POST["id"]);

    $param->developed_content = $_POST["contenido_des"];
    $param->training_modality = $_POST["modalidad_formacion"];
    $param->duration_days = $_POST["duracion_dias"];
    $param->duration_hour = $_POST["duracion_horas"];
    $param->status_activity = $_POST["status_activity"];

    $param->update();

    echo "Actividad actualizada";

}

// print "<script>window.location='index.php?view=planning&swal=Actividad actualizada"."&estado=&participantes=".$participantes."&start_at=".$start_at."&finish_at=".$finish_at."&pag=".$pag."';</script>";

?>
