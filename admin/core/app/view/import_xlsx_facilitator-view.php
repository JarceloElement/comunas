<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

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
        var prog = Math.round(progress * 100 / total + 2);
        // document.getElementById("file").value = prog;
        // console.log(prog);

        var bar = document.querySelector(".progress-bar");
        bar.innerText = prog.toString() + '%';
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

date_default_timezone_set('UTC');
date_default_timezone_set("America/La_Paz");


require_once '../assets/simplexlsx-master/src/SimpleXLSX.php';
// require_once '../../../../assets/simplexlsx-master/src/SimpleXLSX.php';
// require_once __DIR__.'/assets/simplexlsx-master/src/SimpleXLSX.php';

$conn = Database::connectPDO();

$code_info = "";

// insertar
$stmt_insert = $conn->prepare("INSERT INTO facilitators (
    estate, 
    municipality, 
    parish, 
    name, 
    lastname, 
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
            $cols = $dim[0];
            $array_fields = array();
            $total_xlsx = $dim[1];


            // for ($i = 0; $i < $cols-1; $i ++) {
            // $array_fields[] = ( isset($fields[ $i+1 ]) ? $fields[ $i+1 ] : '' );
            // $stmt_insert->bindParam( $i+1, $array_fields[$i], $array_fields[0]);
            // echo ($i+1)."--".$array_fields[$i]."--".$param."<br>";
            // }

            if (!empty($param)) {

                $r = FacilitatorsData::getByDni($param);

                if (isset($r) != 1) {

                    for ($i = 0; $i < $cols - 1; $i++) {
                        $array_fields[] = (isset($fields[$i + 1]) ? $fields[$i + 1] : "");
                        // echo ($i+1)."-- ".$array_fields[$i]." --".$code."<br>";
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
                    $stmt_insert->bindParam(15, $array_fields[15]);

                    $stmt_insert->execute();
                    echo "<span style='color:blue;'>NUEVO:</span>: " . $array_fields[5] . "<br>";
                    // $id = $conn->lastInsertId();
                    // echo "ID: ".$id;
                    echo "<script>setProgress($total_xlsx,$k);</script>";
                } else {

                    // $query_fields = array();

                    for ($i = 0; $i < $cols - 1; $i++) {
                        // $array_fields[] = ( isset($fields[ $i+1 ]) ? $fields[ $i+1 ] : "" );
                        $val_field = (isset($fields[$i + 1]) ? $fields[$i + 1] : "");
                        $val_field = str_replace("'", "", $val_field);

                        $data_field = $array_fields_name[$i + 1];


                        // if ( isset($fields[ $i+1 ]) && $fields[ $i+1 ]!= "" && $fields[ $i+1 ] != $r->$data_field ){
                        if ($val_field != $r->$data_field) {
                            // $query_fields[] = $data_field;
                            // echo "<span style='color:green;'>Actualizado:</span> $param > $data_field | ".$r->$data_field." -|POR|- $val_field <br>";

                            if ($data_field == "estate") {
                                echo "<span style='color:green;'>Actualizado:</span> $param > $data_field : " . $r->$data_field . " -|POR|- $val_field <br>";
                                $r->$data_field = $val_field;
                            }
                            if ($data_field == "municipality") {
                                echo "<span style='color:green;'>Actualizado:</span> $param > $data_field : " . $r->$data_field . " -|POR|- $val_field <br>";
                                $r->$data_field = $val_field;
                            }
                            if ($data_field == "parish") {
                                echo "<span style='color:green;'>Actualizado:</span> $param > $data_field : " . $r->$data_field . " -|POR|- $val_field <br>";
                                $r->$data_field = $val_field;
                            }
                            if ($data_field == "name") {
                                echo "<span style='color:green;'>Actualizado:</span> $param > $data_field : " . $r->$r->$data_field . " -|POR|- $val_field <br>";
                                $r->$data_field = $val_field;
                            }
                            if ($data_field == "lastname") {
                                echo "<span style='color:green;'>Actualizado:</span> $param > $data_field : " . $r->$data_field . " -|POR|- $val_field <br>";
                                $r->$data_field = $val_field;
                            }
                            if ($data_field == "document_number") {
                                echo "<span style='color:green;'>Actualizado:</span> $param > $data_field : " . $r->$data_field . " -|POR|- $val_field <br>";
                                $r->$data_field = $val_field;
                            }
                            if ($data_field == "phone_number") {
                                echo "<span style='color:green;'>Actualizado:</span> $param > $data_field : " . $r->$data_field . " -|POR|- $val_field <br>";
                                $r->$data_field = $val_field;
                            }
                            if ($data_field == "email") {
                                echo "<span style='color:green;'>Actualizado:</span> $param > $data_field : " . $r->$data_field . " -|POR|- $val_field <br>";
                                $r->$data_field = $val_field;
                            }
                            if ($data_field == "gender") {
                                echo "<span style='color:green;'>Actualizado:</span> $param > $data_field : " . $r->$data_field . " -|POR|- $val_field <br>";
                                $r->$data_field = $val_field;
                            }
                            if ($data_field == "birthdate") {
                                echo "<span style='color:green;'>Actualizado:</span> $param > $data_field : " . $r->$data_field . " -|POR|- $val_field <br>";
                                $r->$data_field = $val_field;
                            }
                            if ($data_field == "date_admission") {
                                echo "<span style='color:green;'>Actualizado:</span> $param > $data_field : " . $r->$data_field . " -|POR|- $val_field <br>";
                                $r->$data_field = $val_field;
                            }
                            if ($data_field == "info_cod") {
                                echo "<span style='color:green;'>Actualizado:</span> $param > $data_field : " . $r->$data_field . " -|POR|- $val_field <br>";
                                $r->$data_field = $val_field;
                            }
                            if ($data_field == "status_nom") {
                                echo "<span style='color:green;'>Actualizado:</span> $param > $data_field : " . $r->$data_field . " -|POR|- $val_field <br>";
                                $r->$data_field = $val_field;
                            }
                            if ($data_field == "personal_type") {
                                echo "<span style='color:green;'>Actualizado:</span> $param > $data_field : " . $r->$data_field . " -|POR|- $val_field <br>";
                                $r->$data_field = $val_field;
                            }
                            if ($data_field == "observations") {
                                echo "<span style='color:green;'>Actualizado:</span> $param > $data_field : " . $r->$data_field . " -|POR|- $val_field <br>";
                                $r->$data_field = $val_field;
                            }
                        }
                    }
                    $r->update();


                    // $sql = "UPDATE infocentros SET ".implode(", ",$query_fields)." WHERE id=?";
                    // $stmt_update = $conn->prepare($sql);


                    // $types = str_repeat('s', count($array_fields)) . 'i';
                    // echo implode(",",$array_fields)."<br>";

                    // foreach ($array_fields as $field){
                    //     echo $field."--<br>";
                    // }

                    // echo "Update - ".$param."<br>";
                    echo "<script>setProgress($total_xlsx,$k);</script>";
                }
            }
        }
    } else {
        echo SimpleXLSX::parseError();
    }
}


?>