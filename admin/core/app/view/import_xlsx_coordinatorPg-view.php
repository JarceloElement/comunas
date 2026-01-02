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

        var bar = document.querySelector(".progress-bar");
        bar.innerText = prog.toString() + '%';
        document.getElementById('progressbar').style.width = prog.toString() + '%';

    }
</script>




<?php

use Shuchkin\SimpleXLSX;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

date_default_timezone_set('UTC');
date_default_timezone_set("America/La_Paz");

$Now = new DateTime('now', new DateTimeZone("America/La_Paz"));
$date_now = $Now->format('Y-m-d H:i:s');

require_once '../assets/simplexlsx-master/src/SimpleXLSX.php';
$conn = DatabasePg::connectPg();

$code_info = "";

// insertar
$stmt_insert = $conn->prepare("INSERT INTO coordinators (
    f_state,
    municipality,
    parish,
    info_cod,
    document_number,
    f_name,
    f_lastname,
    gender,
    phone_number,
    email,
    birthdate,
    date_admission,
    coordination,
    status_nom,
    personal_type,
    gerencia_tipo,
    pcta,
    fecha_tentativa,
    cargo,
    nivel_academico,
    prima_profesional,
    estatus,
    observations,
    date_reg,
    date_update 
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");



if (isset($_FILES['dataCliente'])) {

    if ($xlsx = SimpleXLSX::parse($_FILES['dataCliente']['tmp_name'])) {


        $array_fields_name = array();

        foreach ($xlsx->rows() as $k => $fields) {
            if ($k == 0) {
                $array_fields_name = $fields;
                continue; // skip first row
            }

            // param where | dni
            $param = (isset($fields[5]) ? $fields[5] : '');
            $dim = $xlsx->dimension();
            // resta la ultima columna del documento
            $cols = $dim[0] - 1;
            $array_fields = array();
            $total_xlsx = $dim[1]-1; // menos la cabecera

            // print_r($param);
            // echo "<br>";
            // echo "Hola";
            // return;

            if (!empty($param)) {

                $r = CoordinatorsData::getByDniPg($param);
                // print_r($r);
                // return;

                if ($r == 'null') {

                    for ($i = 0; $i < $cols - 1; $i++) {
                        $array_fields[] = (isset($fields[$i + 1]) ? $fields[$i + 1] : "");
                        // echo ($i+1)."-- ".$array_fields[$i]."<br>";
                    }
                    // print_r($fields);
                    // echo "<br>ITEM NEW: " . $k . "-<br>";
                    $stmt_insert->bindParam(1, $array_fields[0]);
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
                    $stmt_insert->bindParam(16, $array_fields[15]);
                    $stmt_insert->bindParam(17, $array_fields[16]);
                    $stmt_insert->bindParam(18, $array_fields[17]);
                    $stmt_insert->bindParam(19, $array_fields[18]);
                    $stmt_insert->bindParam(20, $array_fields[19]);
                    $stmt_insert->bindParam(21, $array_fields[20]);
                    $stmt_insert->bindParam(22, $array_fields[21]);
                    $stmt_insert->bindParam(23, $array_fields[22]);
                    $stmt_insert->bindParam(24, $array_fields[23]);
                    $stmt_insert->bindParam(25, $date_now);

               
                    $stmt_insert->execute();
                    echo "<span style='color:blue;'>NUEVO: " . $k . "</span>: " . $array_fields[5] . "<br>";
                    echo "<script>setProgress($total_xlsx,$k);</script>";
                } else {



                    for ($i = 0; $i < $cols - 1; $i++) {
                        $val_field = (isset($fields[$i + 1]) ? $fields[$i + 1] : "");
                        $val_field = str_replace("'", "", $val_field);

                        $data_field = $array_fields_name[$i + 1];
                        // echo "-".$val_field."- / -".$r->$data_field."-<br>";

                        // print_r($data_field);
                        // echo "ITEM: " . $k . "-<br>";

                        if ($data_field != "date_reg") {
                            // actualiza el campo si es diferente
                            if ($val_field != $r->$data_field) {
                                // echo "-".$val_field."- / -".$r->$data_field."-<br>";

                                $data_q = $r->$data_field;
                                echo "<span style='color:green;'>Actualizado:" . $k . " </span> $param > $data_field : " . $data_q . " -|POR|- $val_field <br>";
                                $r->$data_field = $val_field;

                                // if ($data_field != "") {
                                //     if ($data_field == "f_name") {
                                //         echo "<span style='color:green;'>Actualizado:</span> $param > $data_field : " . $data_q . " -|POR|- $val_field <br>";
                                //         $r->$data_field = $val_field;
                                //     }
                                // }
                            }
                        }
                    }

                    $r->updatePgXLSX();
                    echo "<script>setProgress($total_xlsx,$k);</script>";
                }
            }
        }
    } else {
        echo SimpleXLSX::parseError();
    }
}


?>