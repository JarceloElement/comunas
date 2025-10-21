<?php

/**
 * infocentro
 * @author jarcelo
 **/

if (count($_POST) > 0) {

    if ($_POST["estado"] == "") {
        // con psql
        $statement_1 = InfoData::getByCode($_GET["code_info"]);

        if ($statement_1 != "null") {
            $estado  = $statement_1['estado'];
            $municipio  = $statement_1['municipio'];
            $parroquia  = $statement_1['parroquia'];
            $ciudad  = $statement_1['ciudad'];
            $direccion  = $statement_1['direccion'];
        }
    } else {
        $estado  = $_POST["estado"];
        $municipio  = $_POST['municipio'];
        $parroquia  = $_POST['parroquia'];
        $ciudad  = $_POST['ciudad'];
        $direccion  = $_POST['direccion'];
    }


    $pag = $_GET["pag"];
    if ($pag == "") {
        $pag = "1";
    }


    $usuario_final = FinalUsersData::getByUserId($_POST["user_id"]);
    if ($usuario_final != "null") {
        $profile_image = $usuario_final->profile_image;
    }else {
        $profile_image = "";
    }


    // $estado = $_POST["estado"];
    // $participantes = isset($_POST["participantes"]) ? $_POST["participantes"] : "";
    // $start_at = isset($_POST["start_at"]) ? $_POST["start_at"] : "";
    // $finish_at = isset($_POST["finish_at"]) ? $_POST["finish_at"] : "";
    $hour_activity = $_POST["hour_activity_ini"] . "/" . $_POST["hour_activity_end"];

    $sql = "UPDATE reports set 
		code_info = ?, 
		user_id = ?, 
		line_action = ?, 
		report_type = ?, 
		specific_action = ?, 
		training_type = ?, 
		training_level = ?, 
		tipo_taller = ?, 
		institucion_formacion = ?, 
		id_institucion = ?, 
		isnt_type = ?, 
		activity_title = ?, 
		developed_content = ?, 
		training_modality = ?, 
		duration_days = ?, 
		duration_hour = ?, 
		hour_activity = ?, 
		status_activity = ?, 
		responsible_name = ?, 
		responsible_phone = ?, 
		responsible_type = ?, 
		responsible_email = ?,
		responsible_dni = ?,
		personal_type = ?,
		organized_by_info = ?,
		date_pub = ?,
		date_ini = ?,
		date_end = ?,
		institutions = ?, 
		observations = ?, 
		estate = ?, 
		municipality = ?, 
		parish = ?, 
		city = ?,
		address = ?, 
		profile_image = ?, 
		circuito_comunal = ? 
		where id = ?;";
    $values = [
        strtoupper($_POST["code_info"]),
        $_POST["user_id"],
        $_POST["linea_accion"],
        $_POST["tipo_reporte"],
        $_POST["accion_especifica"],
        $_POST["area_formativa"],
        $_POST["nivel_formacion"],
        $_POST["tipo_taller"],
        $_POST["institucion_formacion"],
        $_POST["id_institucion"],
        $_POST["isnt_type"],
        $_POST["nombre_act"],
        $_POST["contenido_des"],
        $_POST["modalidad_formacion"],
        $_POST["duracion_dias"],
        $_POST["duracion_horas"],
        $hour_activity,
        (int)$_POST["status_activity"],
        $_POST["responsable_name"],
        $_POST["responsable_tel"],
        $_POST["responsable_tipo"],
        $_POST["responsible_email"],
        $_POST["responsible_dni"],
        isset($_POST["personal_type"]) ? $_POST["personal_type"] : '',
        $_POST["organized_by_info"],
        $_POST["fecha"],
        date('Y-m-d', strtotime(explode('/', $_POST["fecha"])[0])),
        date('Y-m-d', strtotime(explode('/', $_POST["fecha"])[1])),
        $_POST["instituciones"],
        $_POST["observacion"],
        $estado,
        $municipio,
        $parroquia,
        $ciudad,
        $direccion,
        $profile_image,
        $_POST["circuito_comunal"],
        (int)$_POST["id"]
    ];
    $resul = ExecutorPg::update($sql, $values);
}
$location = $_SESSION["location"];
print "<script>window.location='index.php?view=planning&swal=Actividad actualizada&" . $location . "&pag=" . $pag . "';</script>";
// print "<script>window.location='index.php?view=planning&swal=Actividad actualizada"."&estado=&participantes=".$participantes."&start_at=".$start_at."&finish_at=".$finish_at."&pag=".$pag."';</script>";
