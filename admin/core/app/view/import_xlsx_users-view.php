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

require_once '../assets/simplexlsx-master/src/SimpleXLSX.php';
// require_once __DIR__.'/assets/simplexlsx-master/src/SimpleXLSX.php';


$conn = DatabasePg::connectPg();

$code_info = "";


// insertar
$stmt_insert = $conn->prepare("INSERT INTO users (
    id,
    username, 
    name, 
    lastname, 
    user_dni, 
    email, 
    password, 
    is_active, 
    user_type, 
    gender, 
    code_info, 
    is_organization, 
    organization_name, 
    region, 
    rol 
    ) VALUES (?, ?,?,?,?,?,?,?,?,?,?,?,?,?, ?)");

// ON CONFLICT(email) DO UPDATE SET name = EXCLUDED.name, surname = EXCLUDED.surname

if (isset($_FILES['dataCliente'])) {

    if ($xlsx = SimpleXLSX::parse($_FILES['dataCliente']['tmp_name'])) {

        $array_fields_name = array();

        foreach ($xlsx->rows() as $k => $fields) {
            if ($k == 0) {
                $array_fields_name = $fields;
                continue; // skip first row
            }

            // param where | dni
            $param = (isset($fields[4]) ? $fields[4] : '');
            $param = str_replace(["\r\n", "\n", "\r"], '', $param);
            $param = strtoupper($param);
            // echo '-'.$param .'-<br>';
            $dim = $xlsx->dimension();
            $cols = $dim[0];
            $array_fields = array();
            $total_xlsx = $dim[1] - 1;
            $pass = 1;
            // echo $fields[1];
            // return;

            if (!empty($param)) {

                // saber si existe el inventario
                $r = UserData::getByDniPg($param);


                if ($r == 'null') {

                    // saber si existe el infocentro    
                    // $info = InfoData::getById($fields[1]);


                    for ($i = 0; $i < $cols - 1; $i++) {

                        $data_field = $array_fields_name[$i];
                        $data_var = (isset($fields[$i]) ? $fields[$i] : "");

                        if ($data_field == "is_active" || $data_field == "is_organization") {
                            if ($data_var == 'NULL') {
                                $data_var = '0';
                            }
                        }

                        if ($data_field == "code_info") {
                            // if ($info != 'null' && $info->cod == $param) {
                            //     $pass = 1;
                            // }
                            
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

                    if ($pass == 1) {
                        $stmt_insert->execute();
                        echo "<span style='color:blue;'>NUEVO REGISTRO:</span>: " . $array_fields[1] . "<br>";
                    } else {
                        echo "No existe un infocentro: " . $param . " o su campo (k_info) no es el mismo. Por favor verifica que el campo (k_info) sea igual al que tiene el infocentro. <br>";
                    }

                    // echo $stmt_insert->queryString."<br>";

                } else {

                    for ($i = 0; $i < $cols - 1; $i++) {
                        $array_fields[] = (isset($fields[$i]) ? $fields[$i] : "");
                        $val_field = (isset($fields[$i]) ? $fields[$i] : "");
                        $val_field = str_replace("'", "", $val_field);
                        $data_field = $array_fields_name[$i];

                        if ($data_field != "") {
                            if ($val_field != $r->$data_field) {

                                // if ($data_field != "id" && $data_field != "k_info") {
                                    if ($data_field == "code_info") {
                                        // quitamos saltos de linea y espacios
                                        $val_field = str_replace(["\r\n", "\n", "\r"], '', $fields[$i]);
                                        $val_field = strtoupper($val_field);
                                    }

                                    $data_q = $r->$data_field;

                                    echo "<span style='color:green;'>Actualizado:</span><span style='color:blue;'>$param</span> > $data_field : ($data_q) -POR- ($val_field) <br>";
                                    $r->$data_field = $val_field;
                                // }
                            }
                        }
                    }

                    $result = $r->updatePgXLSX();
                }
            }
            echo "<script>setProgress($total_xlsx,$k);</script>";
        }
        ExecutorPg::doit("SELECT setval(pg_get_serial_sequence('users', 'id'),COALESCE((SELECT MAX(id) FROM users), 1));");
    } else {
        echo SimpleXLSX::parseError();
    }
}


?>