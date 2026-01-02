<br>
<br>
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

        var bar = document.querySelector(".progress-bar");
        bar.innerText = prog.toString() + '%';
        document.getElementById('progressbar').style.width = prog.toString() + '%';

    }
</script>




<?php

use PhpOffice\PhpSpreadsheet\Calculation\TextData\Replace;
use Shuchkin\SimpleXLSX;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

date_default_timezone_set('UTC');
date_default_timezone_set("America/La_Paz");


require_once '../assets/simplexlsx-master/src/SimpleXLSX.php';
$conn = DatabasePg::connectPg();

$code_info = "";

// insertar
$stmt_insert = $conn->prepare("INSERT INTO facilitators (
    f_state, 
    municipality, 
    parish, 
    f_name, 
    f_lastname, 
    document_number, 
    phone_number, 
    email, 
    gender, 
    birthdate, 
    date_admission, 
    info_cod, 
    status_nom, 
    personal_type, 
    observations 
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
// ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ON CONFLICT (info_cod) DO NOTHING");



if (isset($_FILES['dataCliente'])) {

    if ($xlsx = SimpleXLSX::parse($_FILES['dataCliente']['tmp_name'])) {


        $array_fields_name = array();

        foreach ($xlsx->rows() as $k => $fields) {
            if ($k == 0) {
                $array_fields_name = $fields;
                continue; // skip first row
            }

            // param where | dni
            $param = (isset($fields[6]) ? $fields[6] : '');
            $dim = $xlsx->dimension();
            // resta la ultima columna del documento
            $cols = $dim[0] - 1;
            $array_fields = array();
            $total_xlsx = $dim[1];


            if (!empty($param)) {

                $r = FacilitatorsData::getByDniPg($param);
                // echo $param;
                // print_r($r);
                // return;

                // verificar si el infocentro existe para evitar errores de llave foranea
                $code_info = trim(strtoupper($fields[12]));
                $rx = InfoData::getByCode($code_info);

                if ($r == 'null') {



                    if (isset($rx->cod) && $rx->cod == $code_info) {
                        // el infocentro existe

                        for ($i = 0; $i < $cols - 1; $i++) {
                            $array_fields[] = (isset($fields[$i + 1]) ? $fields[$i + 1] : "");
                            // echo ($i+1)."-- ".$array_fields[$i]."<br>";
                        }
                        // print_r($fields);
                        // echo "<br>ITEM NEW: " . $k . "-<br>";
                        $stmt_insert->bindParam(1, $array_fields[0], PDO::PARAM_STR);
                        $stmt_insert->bindParam(2, $array_fields[1], PDO::PARAM_STR);
                        $stmt_insert->bindParam(3, $array_fields[2], PDO::PARAM_STR);
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

                        $result = $stmt_insert->execute();
                        // echo $result;

                        echo $stmt_insert->errorInfo()[2];
                        echo "<span style='color:blue;'>NUEVO: " . $k . "</span>: " . $array_fields[5] . "--" . $fields[12] . "<br>";
                        echo "<script>setProgress($total_xlsx,$k);</script>";
                    } else {
                        echo "<span style='color:orange;'>¡AVISO! El código de infocentro: " . $fields[12] . " que intentas asignar no existe, por favor asegúrate que primero haya sido creado en Infocentros antes de asignarlo a un usuario.<br></span>";
                    }
                } else {

                    $pass = 0;

                    for ($i = 0; $i < $cols - 1; $i++) {
                        $val_field = (isset($fields[$i + 1]) ? $fields[$i + 1] : "");
                        $val_field = str_replace("'", "", $val_field);

                        $data_field = $array_fields_name[$i + 1];
                        // echo "-".$val_field."- / -".$r->$data_field."-<br>";


                        // actualiza el campo si es diferente
                        if ($val_field != $r->$data_field) {
                            // echo "-".$val_field."- / -".$r->$data_field."-<br>";

                            $data_q = $r->$data_field;


                            if ($data_field != "") {

                                if ($data_field == "info_cod") {

                                    $r->$data_field = trim(strtoupper($val_field));

                                    if (isset($rx->cod) && $rx->cod == trim(strtoupper($val_field))) {
                                        $pass = 1;
                                        continue;
                                    } else {
                                        echo "<span style='color:orange;'>¡AVISO! El código de infocentro: " . $val_field . " que intentas asignar no existe en Infocentros.<br></span>";
                                        // echo $rx->cod, "--", trim(strtoupper($val_field));
                                        $pass = 0;
                                    }
                                }
                            }

                            if ($pass == 1) {
                                echo "<span style='color:green;'>Actualizado:" . $k . " </span> $param > $data_field : " . $data_q . " -|POR|- $val_field <br>";
                                $r->$data_field = $val_field;
                            }
                        }
                    }
                    if ($pass == 1 || $data_field != "info_cod") {
                        $r->updatePgXLSX();
                    }

                    echo "<script>setProgress($total_xlsx,$k);</script>";
                }
            }
        }
        ExecutorPg::doit('ALTER SEQUENCE public.info_facilitators_id_seq RESTART WITH 1;');
    } else {
        echo SimpleXLSX::parseError();
    }
}



?>