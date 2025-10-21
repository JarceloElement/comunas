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
$stmt_insert = $conn->prepare("INSERT INTO user_brigades (
    fk_id_brigade, 
    parroquia, 
    ciudad,
    comunidad,
    fk_id_user,
    info_cod
    ) VALUES (?, ?, ?, ?, ?, ?)");

// ON CONFLICT(email) DO UPDATE SET name = EXCLUDED.name, surname = EXCLUDED.surname

if (isset($_FILES['dataCliente'])) {

    if ($xlsx = SimpleXLSX::parse($_FILES['dataCliente']['tmp_name'])) {

        $array_fields_name = array();

        foreach ($xlsx->rows() as $k => $fields) {
            if ($k == 0) {
                $array_fields_name = $fields;
                continue; // skip first row
            }

            // param where | fk_id_brigade
            $param = (isset($fields[0]) ? $fields[0] : '0');
            $param = str_replace(["\r\n", "\n", "\r"], '', $param);
            $param = strtoupper($param);
            // echo '-'.$param .'-<br>';
            $dim = $xlsx->dimension();
            $cols = $dim[0];
            $array_fields = array();
            $total_xlsx = $dim[1] - 1;
            $pass = 0;
            $pass_2 = 0;
            // echo $fields[0];
            // return;
            if ($param != "") {

                // saber si existe en brigadistas
                $r = UserBrigadesData::getByIdUser($param);
                // print_r($r);
                // echo "XXX<br>";


                if ($r == 'null') {

                    // saber si existe la brigada
                    if ($fields[0] != "") {
                        $brigada = BrigadeData::getByIdXlsx($fields[1]);
                    } else {
                        $brigada = 'null';
                    }
                    // saber si existe el usuario final
                    if ($fields[2] != "") {
                        $user = FinalUsersData::getById($fields[2]);
                        // print_r($user);
                        // echo "<br>";
                    } else {
                        $user = 'null';
                    }


                    for ($i = 0; $i < $cols - 1; $i++) {

                        $data_field = $array_fields_name[$i];
                        $data_var = (isset($fields[$i]) ? $fields[$i] : "");
                        // empty($data_var) ? $data_var = "NULL" : $data_var;


                        // ==== comentar para subir sin constraint ====
                        if ($data_field == "fk_id_brigade") {
                            // echo "fk_id_brigade: ",$data_var."<br>";
                            if ($brigada != 'null' && $brigada->id == $data_var) {
                                $pass = 1;
                            }
                        }

                        if ($data_field == "fk_id_user") {
                            // echo "fk_id_user: ",$data_var."<br>";
                            if ($user != 'null' && $user->id == $data_var) {
                                $pass_2 = 1;
                            }
                        }
                        // ================================

                        $array_fields[] = $data_var;
                        // echo ($i+1)."--".$data_var."--<br>";
                    }

                    $stmt_insert->bindParam(1, $array_fields[1]);
                    $stmt_insert->bindParam(2, $array_fields[5]);
                    $stmt_insert->bindParam(3, $array_fields[6]);
                    $stmt_insert->bindParam(4, $array_fields[7]);
                    $stmt_insert->bindParam(5, $array_fields[2], PDO::PARAM_INT);
                    $stmt_insert->bindParam(6, $array_fields[8]);



                    // si existe la brigada y el usuario final
                    if ($pass == 1 && $pass_2 == 1) {
                        $stmt_insert->execute();
                        echo "<span style='color:blue;'>NUEVO REGISTRO:</span>: " . $array_fields[3] . "<br>";
                    } else if ($pass == 0) {
                        echo "No existe una brigada con ID: " . $array_fields[1] . ". <br>";
                    }

                    // si existe el usuario
                    if ($pass_2 == 0) {
                        echo "No existe un usuario final con ID: " . $array_fields[2] . ". <br>";
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

                                if ($data_field != "fk_id_user" && $data_field != "fk_id_brigade") {

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
        ExecutorPg::doit('UPDATE public.user_brigades SET municipio = final_users.user_municipio FROM final_users WHERE user_brigades.fk_id_user = final_users.id;');
        ExecutorPg::doit('UPDATE public.user_brigades SET parroquia = infocentros.parroquia FROM infocentros WHERE user_brigades.info_cod = infocentros.cod;');
        ExecutorPg::doit('UPDATE public.user_brigades SET ciudad = infocentros.ciudad FROM infocentros WHERE user_brigades.info_cod = infocentros.cod;');
        ExecutorPg::doit('UPDATE public.user_brigades SET comunidad = infocentros.direccion FROM infocentros WHERE user_brigades.info_cod = infocentros.cod;');
        ExecutorPg::doit('UPDATE public.user_brigades SET fk_id_brigade = brigades.id FROM brigades WHERE brigades.info_cod = user_brigades.info_cod;');
    } else {
        echo SimpleXLSX::parseError();
    }
}


?>