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

require_once '../assets/simplexlsx-master/src/SimpleXLSX.php';
// require_once __DIR__.'/assets/simplexlsx-master/src/SimpleXLSX.php';


$conn = DatabasePg::connectPg();

$code_info = "";


// insertar
$stmt_insert = $conn->prepare("INSERT INTO actions_line (
    line_id, 
    line_name, 
    permisos 
    ) VALUES (?, ?, ?)");
// ) VALUES (?, ?, ?) ON CONFLICT (code_info, k_info) DO NOTHING");

// solo se usa cuando se inserta la llave primaria ID en la importacion
$vacuum = $conn->prepare("SELECT setval('actions_line_id_seq', COALESCE((SELECT MAX(line_id) FROM actions_line), 1));");


if (isset($_FILES['datafile'])) {

    if ($xlsx = SimpleXLSX::parse($_FILES['datafile']['tmp_name'])) {


        $array_fields_name = array();

        foreach ($xlsx->rows() as $k => $fields) {
            // carga los nombres de los campos
            if ($k == 0) {
                $array_fields_name = $fields;
                continue; // skip first row
            }

            // param where | line_name
            $param = (isset($fields[1]) ? $fields[1] : '');
            // $param = str_replace(["\r\n", "\n", "\r"], '', $param);
            // $param = strtoupper($param);
            $dim = $xlsx->dimension();
            $cols = $dim[0];
            $array_fields = array();
            $total_xlsx = $dim[1] - 1;
            $pass = 0;


            if (!empty($param)) {

                $r = ActionsLineData::getByName($param);

                if ($r == 'null') {
                    // echo "<span style='color:orange;'>Nuevo:</span> " . $param . "<br>";

                    // $info = InfoData::getById($fields[1]);
                    // if ($info != 'null') {
                    //     $pass = 1;
                    // }


                    for ($i = 0; $i < $cols; $i++) {

                        $data_field = $array_fields_name[$i];
                        $data_var = (isset($fields[$i]) ? $fields[$i] : "");
                        empty($data_var) ? $data_var = "NULL" : $data_var;

                        // if ($data_field == "code_info") {
                        //     $data_var = str_replace(["\r\n", "\n", "\r"], '', $data_var);
                        //     $data_var = strtoupper($data_var);
                        // }

                        $array_fields[] = $data_var;
                    }

                    $stmt_insert->bindParam(1, $array_fields[0], PDO::PARAM_INT);
                    $stmt_insert->bindParam(2, $array_fields[1], PDO::PARAM_STR);
                    $stmt_insert->bindParam(3, $array_fields[2], PDO::PARAM_STR);


                    if ($pass == 0) {
                        echo "<span style='color:blue;'>NUEVO REGISTRO:</span>: " . $array_fields[1] . "<br>";
                        $stmt_insert->execute();
                    } else {
                        echo "No existe el infocentro: " . $param . " <br>";
                    }

                    // echo $stmt_insert->queryString."<br>";

                } else {
                    // echo "<span style='color:gray;'>Existe:</span> " . $param . "<br>";

                    for ($i = 0; $i < $cols; $i++) {
                        $array_fields[] = (isset($fields[$i]) ? $fields[$i] : "");
                        $val_field = (isset($fields[$i]) ? $fields[$i] : "");
                        $val_field = str_replace("'", "", $val_field);
                        $data_field = $array_fields_name[$i];


                        if ($data_field != "") {
                            // echo "Comparando: $data_field : " . $r->$data_field . " -|CON|- $val_field <br>";

                            // modificar atributos
                            if ($data_field == "permisos" && $val_field == "") {
                                $val_field = "Todos";
                            }

                            if ($val_field != $r->$data_field) {

                                // if ($data_field != "id" && $data_field != "k_info") {

                                // if ($data_field == "code_info") {
                                //     $val_field = str_replace(["\r\n", "\n", "\r"], '', $fields[$i]);
                                //     $val_field = strtoupper($val_field);
                                // }

                                $data_q = $r->$data_field;

                                // solo algunos
                                // if ($data_field == "user_info_cod"){echo "<span style='color:green;'>Actualizado:</span> $param > $data_field : ".$r->$data_field." -|POR|- $val_field <br>";$r->$data_field=$val_field;}

                                // todos
                                echo "<span style='color:green;'>Actualizado:</span><span style='color:blue;'>$param</span> > $data_field : ($data_q) -POR- ($val_field) <br>";
                                $r->$data_field = $val_field;
                                // }
                            }
                        }
                    }
                    $r->updatePgXLSX();
                }
            }
            echo "<script>setProgress($total_xlsx,$k);</script>";
        }
        // actualizar los id de la tabla
        $vacuum->execute();
    } else {
        echo SimpleXLSX::parseError();
    }
}


?>