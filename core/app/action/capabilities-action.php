<?php

/**
 * InfoApp
 * @author Jarcelo
 **/




$pag = isset($_GET["pag"]) ? $_GET["pag"] : 1;
if ($pag == "") {
    $pag = "1";
}

$func_post = "";
$func_get = "";

// if (isset($_POST['function'])){$func_post = $_POST["function"]; }
if (isset($_GET['function'])) {
    $func_get = $_GET["function"];
}

$fecha_actual = date("Y", time());
// $edad = $fecha_actual-date("Y", strtotime($_POST["user_f_nacimiento"]));
// $fecha_servicio = date("Y,m,d", strtotime($_POST["user_fecha_servicio"]));
$Now = new DateTime('now', new DateTimeZone("America/La_Paz"));
$datetime = $Now->format('Y-m-d H:i:s');


if ($func_get == "add") {

    $r = PersonalCapabilitiesData::getRepeatedPg($_POST["user_dni"]);
    // print_r($r->user_dni);

    if ($_POST["user_dni"] == "")  {
        $message = "No pudimos procesar los datos, poor favor intenta nuevamente";
        $_SESSION["alert"] = $message;
        Core::redir("./index.php?view=form_technological_capabilities");
        echo $message;
        return;
    }elseif (isset($r->user_dni) && $r->user_dni == $_POST["user_dni"]) {
        $message = "El usuario con el DNI: " . $_POST["user_dni"] . " ya está encuestado";
        $_SESSION["alert"] = $message;
        Core::redir("./index.php?view=form_technological_capabilities");
        echo $message;
        return;
    }


    if (is_array($_POST["user_potential_contribution_for_PNI_infocentro"])) {
        $data_1 = implode(",", $_POST['user_potential_contribution_for_PNI_infocentro']);
    } else {
        $data_1 = $_POST["user_potential_contribution_for_PNI_infocentro"];
    }

    if (is_array($_POST["user_potential_contribution_for_areas_PNCT"])) {
        $data_2 = implode(",", $_POST['user_potential_contribution_for_areas_PNCT']);
    } else {
        $data_2 = $_POST["user_potential_contribution_for_areas_PNCT"];
    }

    if (is_array($_POST["user_training_needs"])) {
        $data_3 = implode(",", $_POST['user_training_needs']);
    } else {
        $data_3 = $_POST["user_training_needs"];
    }

    // echo "No existe";
    $r = new PersonalCapabilitiesData();
    $r->user_id = $_POST["user_id"];
    $r->user_type = $_POST["user_type"];
    $r->personal_type = $_POST["personal_type"];
    $r->user_email = $_POST["user_email"];
    $r->user_dni = $_POST["user_dni"];
    $r->user_name = $_POST["user_name"];
    $r->user_lastname = $_POST["user_lastname"];
    $r->user_phone = $_POST["user_phone"];
    $r->code_info = $_POST["code_info"];
    $r->info_name = $_POST["info_name"];
    $r->user_state = $_POST["user_state"];
    $r->user_municipality = $_POST["user_municipality"];
    $r->user_parish = $_POST["user_parish"];
    $r->user_zone_type = $_POST["user_zone_type"];
    $r->user_blender_user_skills = $_POST["user_blender_user_skills"];
    $r->user_stop_motion_skills = $_POST["user_stop_motion_skills"];
    $r->user_python_user_skills = $_POST["user_python_user_skills"];
    $r->user_web_design_skills = $_POST["user_web_design_skills"];
    $r->user_wordpress_skills = $_POST["user_wordpress_skills"];
    $r->user_html_skills = $_POST["user_html_skills"];
    $r->user_PHP_skills = $_POST["user_PHP_skills"];
    $r->user_blog_design_skills = $_POST["user_blog_design_skills"];
    $r->user_digital_magazine_skills = $_POST["user_digital_magazine_skills"];
    $r->user_digital_economy_skills = $_POST["user_digital_economy_skills"];
    $r->user_crypto_assets_skills = $_POST["user_crypto_assets_skills"];
    $r->user_e_bank_patria_skills = $_POST["user_e_bank_patria_skills"];
    $r->user_e_commerce_skills = $_POST["user_e_commerce_skills"];
    $r->user_use_movile_devices_skills = $_POST["user_use_movile_devices_skills"];
    $r->user_technical_support_computers_devices_skills = $_POST["user_technical_support_computers_devices_skills"];
    $r->user_technical_support_movile_devices_skills = $_POST["user_technical_support_movile_devices_skills"];
    $r->user_network_technical_support_skills = $_POST["user_network_technical_support_skills"];
    $r->user_social_media_management_skills = $_POST["user_social_media_management_skills"];
    $r->user_social_media_security_skills = $_POST["user_social_media_security_skills"];
    $r->user_imagen_design_skills = $_POST["user_imagen_design_skills"];
    $r->user_mobile_video_editing_skills = $_POST["user_mobile_video_editing_skills"];
    $r->user_remote_communication_skills = $_POST["user_remote_communication_skills"];
    $r->user_libre_office_applications_skills = $_POST["user_libre_office_applications_skills"];
    $r->user_meme_creations_skills = $_POST["user_meme_creations_skills"];
    $r->user_presentations_creations_skills = $_POST["user_presentations_creations_skills"];
    $r->user_accounting_books_skills = $_POST["user_accounting_books_skills"];
    $r->user_budget_cration_skills = $_POST["user_budget_cration_skills"];
    $r->user_strategic_planning_skills = $_POST["user_strategic_planning_skills"];
    $r->user_project_elaboration_skills = $_POST["user_project_elaboration_skills"];
    $r->user_collective_diagnosis_skills = $_POST["user_collective_diagnosis_skills"];
    $r->user_situational_analysis_tecniques_skills = $_POST["user_situational_analysis_tecniques_skills"];
    $r->user_systematization_community_experiences_skills = $_POST["user_systematization_community_experiences_skills"];
    $r->user_content_assertive_organizational_communication_skills = $_POST["user_content_assertive_organizational_communication_skills"];
    $r->user_robotics_skills = $_POST["user_robotics_skills"];
    $r->user_artificial_intelligence_skills = $_POST["user_artificial_intelligence_skills"];
    $r->user_programming_skills = $_POST["user_programming_skills"];
    $r->user_application_creation_skills = $_POST["user_application_creation_skills"];
    $r->user_greater_technological_skill = $_POST["user_greater_technological_skill"];
    $r->user_greater_technological_skill_level = $_POST["user_greater_technological_skill_level"];
    $r->user_training_needs = $data_3;
    $r->user_other_training_needs = $_POST["user_other_training_needs"];
    $r->user_know_PNCT_MincCYT = $_POST["user_know_PNCT_MincCYT"];
    $r->user_potential_contribution_for_areas_PNCT = $data_2;
    $r->user_know_PNI_infocentro = $_POST["user_know_PNI_infocentro"];
    $r->user_potential_contribution_for_PNI_infocentro = $data_1;
    $r->knowledge_remote_learning = $_POST["knowledge_remote_learning"];
    $r->participation_virtual_training = $_POST["participation_virtual_training"];
    $r->experience_online_training = $_POST["experience_online_training"];
    $r->know_platform_aprendiendo_juntos = $_POST["know_platform_aprendiendo_juntos"];
    $r->training_received_aprendiendo_juntos = $_POST["training_received_aprendiendo_juntos"];
    $r->interest_to_training_on_aprendiendo_juntos = $_POST["interest_to_training_on_aprendiendo_juntos"];
    $r->know_benefits_online_training = $_POST["know_benefits_online_training"];
    $r->suggestions_provided = $_POST["suggestions_provided"];

    $r->user_name_os = $_POST["user_name_os"];
    $r->date_update = $datetime;

    $result = $r->addPg();

    Core::redir("./index.php?view=edit_form_technological_capabilities");
    $message = "Registro creado con éxito, allí puedes ver los datos guardados y los puedes editar cúando desees";
    $_SESSION["alert"] = $message;
    // return $message;

}



if ($func_get == "update") {
    if (count($_POST) > 0) {


        if (is_array($_POST["user_potential_contribution_for_PNI_infocentro"])) {
            $data_1 = implode(",", $_POST['user_potential_contribution_for_PNI_infocentro']);
        } else {
            $data_1 = $_POST["user_potential_contribution_for_PNI_infocentro"];
        }

        if (is_array($_POST["user_potential_contribution_for_areas_PNCT"])) {
            $data_2 = implode(",", $_POST['user_potential_contribution_for_areas_PNCT']);
        } else {
            $data_2 = $_POST["user_potential_contribution_for_areas_PNCT"];
        }

        if (is_array($_POST["user_training_needs"])) {
            $data_3 = implode(",", $_POST['user_training_needs']);
        } else {
            $data_3 = $_POST["user_training_needs"];
        }


        $r = PersonalCapabilitiesData::getRepeatedPg($_POST["user_dni"]);
        $r->user_id = $_POST["user_id"];
        $r->user_type = $_POST["user_type"];
        $r->personal_type = $_POST["personal_type"];
        $r->user_email = $_POST["user_email"];
        $r->user_dni = $_POST["user_dni"];
        $r->user_name = $_POST["user_name"];
        $r->user_lastname = $_POST["user_lastname"];
        $r->user_phone = $_POST["user_phone"];
        $r->code_info = $_POST["code_info"];
        $r->info_name = $_POST["info_name"];
        $r->user_state = $_POST["user_state"];
        $r->user_municipality = $_POST["user_municipality"];
        $r->user_parish = $_POST["user_parish"];
        $r->user_zone_type = $_POST["user_zone_type"];
        $r->user_blender_user_skills = $_POST["user_blender_user_skills"];
        $r->user_stop_motion_skills = $_POST["user_stop_motion_skills"];
        $r->user_python_user_skills = $_POST["user_python_user_skills"];
        $r->user_web_design_skills = $_POST["user_web_design_skills"];
        $r->user_wordpress_skills = $_POST["user_wordpress_skills"];
        $r->user_html_skills = $_POST["user_html_skills"];
        $r->user_PHP_skills = $_POST["user_PHP_skills"];
        $r->user_blog_design_skills = $_POST["user_blog_design_skills"];
        $r->user_digital_magazine_skills = $_POST["user_digital_magazine_skills"];
        $r->user_digital_economy_skills = $_POST["user_digital_economy_skills"];
        $r->user_crypto_assets_skills = $_POST["user_crypto_assets_skills"];
        $r->user_e_bank_patria_skills = $_POST["user_e_bank_patria_skills"];
        $r->user_e_commerce_skills = $_POST["user_e_commerce_skills"];
        $r->user_use_movile_devices_skills = $_POST["user_use_movile_devices_skills"];
        $r->user_technical_support_computers_devices_skills = $_POST["user_technical_support_computers_devices_skills"];
        $r->user_technical_support_movile_devices_skills = $_POST["user_technical_support_movile_devices_skills"];
        $r->user_network_technical_support_skills = $_POST["user_network_technical_support_skills"];
        $r->user_social_media_management_skills = $_POST["user_social_media_management_skills"];
        $r->user_social_media_security_skills = $_POST["user_social_media_security_skills"];
        $r->user_imagen_design_skills = $_POST["user_imagen_design_skills"];
        $r->user_mobile_video_editing_skills = $_POST["user_mobile_video_editing_skills"];
        $r->user_remote_communication_skills = $_POST["user_remote_communication_skills"];
        $r->user_libre_office_applications_skills = $_POST["user_libre_office_applications_skills"];
        $r->user_meme_creations_skills = $_POST["user_meme_creations_skills"];
        $r->user_presentations_creations_skills = $_POST["user_presentations_creations_skills"];
        $r->user_accounting_books_skills = $_POST["user_accounting_books_skills"];
        $r->user_budget_cration_skills = $_POST["user_budget_cration_skills"];
        $r->user_strategic_planning_skills = $_POST["user_strategic_planning_skills"];
        $r->user_project_elaboration_skills = $_POST["user_project_elaboration_skills"];
        $r->user_collective_diagnosis_skills = $_POST["user_collective_diagnosis_skills"];
        $r->user_situational_analysis_tecniques_skills = $_POST["user_situational_analysis_tecniques_skills"];
        $r->user_systematization_community_experiences_skills = $_POST["user_systematization_community_experiences_skills"];
        $r->user_content_assertive_organizational_communication_skills = $_POST["user_content_assertive_organizational_communication_skills"];
        $r->user_robotics_skills = $_POST["user_robotics_skills"];
        $r->user_artificial_intelligence_skills = $_POST["user_artificial_intelligence_skills"];
        $r->user_programming_skills = $_POST["user_programming_skills"];
        $r->user_application_creation_skills = $_POST["user_application_creation_skills"];
        $r->user_greater_technological_skill = $_POST["user_greater_technological_skill"];
        $r->user_greater_technological_skill_level = $_POST["user_greater_technological_skill_level"];
        $r->user_training_needs = $data_3;
        $r->user_other_training_needs = $_POST["user_other_training_needs"];
        $r->user_know_PNCT_MincCYT = $_POST["user_know_PNCT_MincCYT"];
        $r->user_potential_contribution_for_areas_PNCT = $data_2;
        $r->user_know_PNI_infocentro = $_POST["user_know_PNI_infocentro"];
        $r->user_potential_contribution_for_PNI_infocentro = $data_1;
        $r->knowledge_remote_learning = $_POST["knowledge_remote_learning"];
        $r->participation_virtual_training = $_POST["participation_virtual_training"];
        $r->experience_online_training = $_POST["experience_online_training"];
        $r->know_platform_aprendiendo_juntos = $_POST["know_platform_aprendiendo_juntos"];
        $r->training_received_aprendiendo_juntos = $_POST["training_received_aprendiendo_juntos"];
        $r->interest_to_training_on_aprendiendo_juntos = $_POST["interest_to_training_on_aprendiendo_juntos"];
        $r->know_benefits_online_training = $_POST["know_benefits_online_training"];
        $r->suggestions_provided = $_POST["suggestions_provided"];

        $r->user_name_os = $_POST["user_name_os"];
        $r->date_update = $datetime;

        $r->updatePg();
        $message = "Encuesta actualizada con éxito";
        $_SESSION["alert"] = $message;
        Core::redir("./index.php?view=edit_form_technological_capabilities");
    } else {
        $message = "No hay datos para actualizar";
        $_SESSION["alert"] = $message;
        Core::redir("./index.php?view=edit_form_technological_capabilities");
    }
}



// 
if ($func_get == "updatefield") {
    if (count($_POST) > 0) {
        $field = $_POST["field"];

        echo '--' . $_POST["field"];


        if (is_array($_POST["data"])) {
            $data = implode(",", $_POST['data']);
        } else {
            $data = $_POST["data"];
        }

        $r = PersonalCapabilitiesData::getById($_POST["id"]);

        $progress = $r->progress;
        // si no hay datos en progress hace un array | de lo contrario crea un array desde el string
        if ($progress == "") {
            $progress = array();
        } else {
            $progress = explode(",", $progress);
        };



        $campos_listos = count($progress);

        // si el campo no esta en el array de progress lo agrega | luego convierte el array en cadena
        if (!in_array($field, $progress) && $data != "") {
            array_unshift($progress, $field);
            // cuenta el total de campos listos luego de agregar el nuevo antes de convertirlo en cadena
            $campos_listos = count($progress);
            $progress = implode(",", $progress);
        } else {
            // si el campo esta vacio lo buscamos en la lista del progreso y lo borramos
            if (in_array($field, $progress) && $data == "") {
                // buscar el field en el array
                if (($clave = array_search($field, $progress)) !== false) {
                    unset($progress[$clave]);
                }
            }
            $campos_listos = count($progress);
            $progress = implode(",", $progress);
        }

        // FALTA OBTENER EL TOTAL DE FIELD EN $r PARA CALCULAR EL %
        $progress_total = round($campos_listos * 100 / 59);

        $r->id = $_POST["id"];
        $r->progress = $progress;
        $r->progress_percent = $progress_total;
        $r->$field = $data;
        $r->update();
        return $error = "Guardado";
    } else {
        Core::alert("No hay parámetros enviados para actualizar");
    }
}




if ($func_get == "delete") {
    if (!isset($_GET['id'])) {
        Core::alert("Error: Falta el id a eliminar");
        return;
    }
    $estado = $_GET["user_estado"];
    $start_at = $_GET["start_at"];
    $finish_at = $_GET["finish_at"];

    $param = PersonalCapabilitiesData::getById($_GET["id"]);
    $param->del();

    // Core::alert("Eliminado exitosamente!");
    // Core::redir("./index.php?view=final_users&swal=Registro borrado");
    // print "<script>window.location='index.php?view=facilitators';</script>";
    print "<script>window.location='index.php?view=services&swal=Eliminado&user_estado=&start_at=" . $start_at . "&finish_at=" . $finish_at . "&pag=" . $pag . "';</script>";
}
