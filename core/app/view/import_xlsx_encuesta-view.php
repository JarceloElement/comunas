<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->

<br>
<br>
<br>
<h5 for="file">AVISO: Si el mismo código se actualiza varias veces es porque se encuentra repetido en el archivo subido.</h5>
<br>

<label for="file">Progreso de la subida:</label>
<!-- <progress id="file" value="0" max="100"></progress> -->



<div class="progress">
    <div class="progress-bar" id="progressbar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function(event) {
        /* DOM is ready, so we can query for its elements */
    })

    function setProgress(total, progress) {
        var prog = Math.round(progress * 100 / total);
        // document.getElementById("file").value = prog;
        // console.log(prog);

        var bar = document.querySelector(".progress-bar");
        bar.innerText = prog.toString() + '% | ' + progress + '/' + total;
        document.getElementById('progressbar').style.width = prog.toString() + '%';

    }
</script>




<?php

use Shuchkin\SimpleXLSX;

$debug = true;
if ($debug) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

require_once 'assets/simplexlsx-master/src/SimpleXLSX.php';
// require_once __DIR__.'/assets/simplexlsx-master/src/SimpleXLSX.php';


$conn = DatabasePg::connectPg();

$code_info = "";

// insertar
$stmt_insert = $conn->prepare("INSERT INTO encuesta_capacidades_tecnologicas (
    user_id,
	user_type,
	personal_type,
	user_email,
	user_dni,
	user_name,
	user_lastname,
	user_phone,
	code_info,
	info_name,
	user_state,
	user_municipality,
	user_parish,
	user_zone_type,
	user_blender_user_skills,
	user_python_user_skills,
	user_stop_motion_skills,
	user_web_design_skills,
	user_wordpress_skills,
	user_html_skills,
	user_PHP_skills,
	user_blog_design_skills,
	user_digital_magazine_skills,
	user_digital_economy_skills,
	user_crypto_assets_skills,
	user_e_bank_patria_skills,
	user_e_commerce_skills,
	user_use_movile_devices_skills,
	user_technical_support_computers_devices_skills,
	user_technical_support_movile_devices_skills,
	user_network_technical_support_skills,
	user_social_media_management_skills,
	user_social_media_security_skills,
	user_imagen_design_skills,
	user_mobile_video_editing_skills,
	user_remote_communication_skills,
	user_libre_office_applications_skills,
	user_meme_creations_skills,
	user_presentations_creations_skills,
	user_accounting_books_skills,
	user_budget_cration_skills,
	user_strategic_planning_skills,
	user_project_elaboration_skills,
	user_collective_diagnosis_skills,
	user_situational_analysis_tecniques_skills,
	user_systematization_community_experiences_skills,
	user_content_assertive_organizational_communication_skills,
	user_robotics_skills,
	user_artificial_intelligence_skills,
	user_programming_skills,
	user_application_creation_skills,
	user_greater_technological_skill,
	user_greater_technological_skill_level,
	user_training_needs,
	user_other_training_needs,
	user_know_PNCT_MincCYT,
	user_potential_contribution_for_areas_PNCT,
	user_know_PNI_infocentro,
	user_potential_contribution_for_PNI_infocentro,
	knowledge_remote_learning,
	participation_virtual_training,
	experience_online_training,
	know_platform_aprendiendo_juntos,
	training_received_aprendiendo_juntos,
	interest_to_training_on_aprendiendo_juntos,
	know_benefits_online_training,
	suggestions_provided,
	user_name_os
    ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

// ON CONFLICT(email) DO UPDATE SET name = EXCLUDED.name, surname = EXCLUDED.surname

if (isset($_FILES['dataCliente'])) {

    if ($xlsx = SimpleXLSX::parse($_FILES['dataCliente']['tmp_name'])) {

        $array_fields_name = array();

        foreach ($xlsx->rows() as $k => $fields) {
            if ($k == 0) {
                $array_fields_name = $fields;
                continue; // skip first row
            }

            // param where | user_id
            // $param = (isset($fields[0]) ? $fields[0] : '');
            $param = (isset($fields[1]) ? $fields[1] : '');
            $param = str_replace(["\r\n", "\n", "\r"], '', $param);
            $param = strtoupper($param);
            // echo '-'.$param .'-<br>';
            $dim = $xlsx->dimension();
            $cols = $dim[0];
            $array_fields = array();
            $total_xlsx = $dim[1] - 1;
            $pass = 0;
            // echo $fields[1];
            // return;

            if (!empty($param)) {

                // saber si el registro existe
                $r = PersonalCapabilitiesData::getByIdPg($param);

                if ($r == 'null') {

                    for ($i = 0; $i < $cols - 1; $i++) {

                        $data_field = $array_fields_name[$i + 1];
                        $data_var = (isset($fields[$i + 1]) ? $fields[$i + 1] : "");
                        empty($data_var) ? $data_var = "NULL" : $data_var;


                        if ($data_field == "code_info") {
                            $data_var = str_replace(["\r\n", "\n", "\r"], '', $data_var);
                            $data_var = strtoupper($data_var);
                        }

                        $array_fields[] = $data_var;
                        // echo ($i+1)."--".$data_var."--<br>";
                    }


                    $stmt_insert->bindParam(1, $array_fields[0]);
                    $stmt_insert->bindParam(2, $array_fields[1]);
                    $stmt_insert->bindParam(3, $array_fields[2]);
                    $stmt_insert->bindParam(4, $array_fields[3]);
                    $stmt_insert->bindParam(5, $array_fields[4]);
                    $stmt_insert->bindParam(6, $array_fields[5]);
                    $stmt_insert->bindParam(7, $array_fields[6]);
                    $stmt_insert->bindParam(8, $array_fields[7]);
                    $stmt_insert->bindParam(9, $array_fields[8]);
                    $stmt_insert->bindParam(10, $array_fields[9]);
                    $stmt_insert->bindParam(11, $array_fields[10]);
                    $stmt_insert->bindParam(12, $array_fields[11]);
                    $stmt_insert->bindParam(13, $array_fields[12]);
                    $stmt_insert->bindParam(14, $array_fields[13]);
                    $stmt_insert->bindParam(15, $array_fields[14]);
                    $stmt_insert->bindParam(16, $array_fields[15]);
                    $stmt_insert->bindParam(17, $array_fields[16]);
                    $stmt_insert->bindParam(18, $array_fields[17]);
                    $stmt_insert->bindParam(19, $array_fields[18]);
                    $stmt_insert->bindParam(20, $array_fields[19]);
                    $stmt_insert->bindParam(21, $array_fields[20]);
                    $stmt_insert->bindParam(22, $array_fields[21]);
                    $stmt_insert->bindParam(23, $array_fields[22]);
                    $stmt_insert->bindParam(24, $array_fields[23]);
                    $stmt_insert->bindParam(25, $array_fields[24]);
                    $stmt_insert->bindParam(26, $array_fields[25]);
                    $stmt_insert->bindParam(27, $array_fields[26]);
                    $stmt_insert->bindParam(28, $array_fields[27]);
                    $stmt_insert->bindParam(29, $array_fields[28]);
                    $stmt_insert->bindParam(30, $array_fields[29]);
                    $stmt_insert->bindParam(31, $array_fields[30]);
                    $stmt_insert->bindParam(32, $array_fields[31]);
                    $stmt_insert->bindParam(33, $array_fields[32]);
                    $stmt_insert->bindParam(34, $array_fields[33]);
                    $stmt_insert->bindParam(35, $array_fields[34]);
                    $stmt_insert->bindParam(36, $array_fields[35]);
                    $stmt_insert->bindParam(37, $array_fields[36]);
                    $stmt_insert->bindParam(38, $array_fields[37]);
                    $stmt_insert->bindParam(39, $array_fields[38]);
                    $stmt_insert->bindParam(40, $array_fields[39]);
                    $stmt_insert->bindParam(41, $array_fields[40]);
                    $stmt_insert->bindParam(42, $array_fields[41]);
                    $stmt_insert->bindParam(43, $array_fields[42]);
                    $stmt_insert->bindParam(44, $array_fields[43]);
                    $stmt_insert->bindParam(45, $array_fields[44]);
                    $stmt_insert->bindParam(46, $array_fields[45]);
                    $stmt_insert->bindParam(47, $array_fields[46]);
                    $stmt_insert->bindParam(48, $array_fields[47]);
                    $stmt_insert->bindParam(49, $array_fields[48]);
                    $stmt_insert->bindParam(50, $array_fields[49]);
                    $stmt_insert->bindParam(51, $array_fields[50]);
                    $stmt_insert->bindParam(52, $array_fields[51]);
                    $stmt_insert->bindParam(53, $array_fields[52]);
                    $stmt_insert->bindParam(54, $array_fields[53]);
                    $stmt_insert->bindParam(55, $array_fields[54]);
                    $stmt_insert->bindParam(56, $array_fields[55]);
                    $stmt_insert->bindParam(57, $array_fields[56]);
                    $stmt_insert->bindParam(58, $array_fields[57]);
                    $stmt_insert->bindParam(59, $array_fields[58]);
                    $stmt_insert->bindParam(60, $array_fields[59]);
                    $stmt_insert->bindParam(61, $array_fields[60]);
                    $stmt_insert->bindParam(62, $array_fields[61]);
                    $stmt_insert->bindParam(63, $array_fields[62]);
                    $stmt_insert->bindParam(64, $array_fields[63]);
                    $stmt_insert->bindParam(65, $array_fields[64]);
                    $stmt_insert->bindParam(66, $array_fields[65]);
                    $stmt_insert->bindParam(67, $array_fields[66]);
                    $stmt_insert->bindParam(68, $array_fields[67]);

                    $stmt_insert->execute();
                    echo "<span style='color:blue;'>NUEVO REGISTRO:</span>: " . $array_fields[4] ."--".$array_fields[0]."<br>";

                    // echo $stmt_insert->queryString."<br>";

                } else {

                    for ($i = 0; $i < $cols - 1; $i++) {
                        $array_fields[] = (isset($fields[$i + 1]) ? $fields[$i + 1] : "");
                        $val_field = (isset($fields[$i + 1]) ? $fields[$i + 1] : "");
                        $val_field = str_replace("'", "", $val_field);
                        $data_field = $array_fields_name[$i + 1];

                        if ($data_field != "") {
                            if ($val_field != $r->$data_field) {

                                if ($data_field != "id" && $data_field != "info_id" && $data_field != "info_cod") {

                                    $data_q = $r->$data_field;

                                    $r->$data_field = $val_field;
                                    echo "<span style='color:green;'>Actualizado:</span><span style='color:blue;'>$param</span> > $data_field : ($data_q) -POR- ($val_field) <br>";
                                }
                            }
                        }
                    }

                    // $result = $r->updatePgXLSX();
                }
            }
            echo "<script>setProgress($total_xlsx,$k);</script>";
        }
    } else {
        echo SimpleXLSX::parseError();
    }
}


?>