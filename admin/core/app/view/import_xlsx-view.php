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

$conn = DatabasePg::connectPg();

$code_info = "";

// insertar
$stmt_insert = $conn->prepare("INSERT INTO infocentros (
    id, 
    region_tipo, 
    cod, 
    nombre, 
    estatus, 
    abierto_en_pandemia,
    motivo_cierre,
    motivo_cierre_def,
    direccion,
    ciudad,
    estado,
    municipio,
    parroquia,
    n_circuito,
    tecno_internet,
    proveedor,
    perso_contacto,
    telef_contacto,
    f_instalacion,
    f_inauguracion,
    creacion_year,
    estatus_op,
    estatus_falla,
    n_reporte,
    pc_wifi,
    router_wifi,
    antena_wifi,
    ancho_banda_bajada,
    ancho_banda_subida,
    mac_pc,
    rango_ip,
    facili_s_coord,
    obs_facilitador,
    transferido,
    central_dlci,
    migrado,
    fact_aba,
    estatus_migracion,
    fecha_migracion,
    espacio_inst,
    ofensiva_fase_i,
    ofensiva_fase_ii,
    ofensiva_fase_iii,
    ofensiva_fase_iv,
    ofensiva_fase_v,
    avance_ofensiva,
    financiamiento_ofensiva,
    grupos_etnicos,
    tipo_zona,
    municipio_fronterizo,
    limite_fronterizo,
    latitud,
    longitud,
    observacion,
    observacion_tecnica,
    cod_gerencia
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ON CONFLICT (cod) DO NOTHING RETURNING id");


// sin ID
$stmt_insert_noID = $conn->prepare("INSERT INTO infocentros (
    region_tipo, 
    cod, 
    nombre, 
    estatus, 
    abierto_en_pandemia,
    motivo_cierre,
    motivo_cierre_def,
    direccion,
    ciudad,
    estado,
    municipio,
    parroquia,
    n_circuito,
    tecno_internet,
    proveedor,
    perso_contacto,
    telef_contacto,
    f_instalacion,
    f_inauguracion,
    creacion_year,
    estatus_op,
    estatus_falla,
    n_reporte,
    pc_wifi,
    router_wifi,
    antena_wifi,
    ancho_banda_bajada,
    ancho_banda_subida,
    mac_pc,
    rango_ip,
    facili_s_coord,
    obs_facilitador,
    transferido,
    central_dlci,
    migrado,
    fact_aba,
    estatus_migracion,
    fecha_migracion,
    espacio_inst,
    ofensiva_fase_i,
    ofensiva_fase_ii,
    ofensiva_fase_iii,
    ofensiva_fase_iv,
    ofensiva_fase_v,
    avance_ofensiva,
    financiamiento_ofensiva,
    grupos_etnicos,
    tipo_zona,
    municipio_fronterizo,
    limite_fronterizo,
    latitud,
    longitud,
    observacion,
    observacion_tecnica,
    cod_gerencia
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ON CONFLICT (cod) DO NOTHING RETURNING id");






if (isset($_FILES['dataCliente'])) {

    if ($xlsx = SimpleXLSX::parse($_FILES['dataCliente']['tmp_name'])) {


        $array_fields_name = array();

        foreach ($xlsx->rows() as $k => $fields) {
            if ($k == 0) {
                $array_fields_name = $fields;
                continue; // skip first row
            }

            // param where | cod
            $param = (isset($fields[2]) ? $fields[2] : '');
            $param = str_replace(["\r\n", "\n", "\r"], '', $param);
            $param = strtoupper($param);
            // echo '-'.$param .'-<br>';
            $dim = $xlsx->dimension();
            $cols = $dim[0];
            $array_fields = array();
            $total_xlsx = $dim[1];

            if (!empty($param)) {

                $r = InfoData::getByCode($param);
                // print_r($r);
                // return;

                if ($r == 'null') {

                    // crea una lista con el objeto
                    for ($i = 0; $i < $cols - 1; $i++) {

                        $data_field = $array_fields_name[$i];

                        $data_var = (isset($fields[$i]) ? $fields[$i] : "");

                        if ($data_field == "region_tipo") {
                            if ($data_var == 'NULL') {
                                $data_var = '0';
                            }
                        }
                        if ($data_field == "cod") {
                            $data_var = str_replace(["\r\n", "\n", "\r"], '', $data_var);
                            $data_var = strtoupper($data_var);
                        }


                        $array_fields[] = $data_var;
                        // echo ($i+1)."-- ".$array_fields[$i]." --".$code."<br>";
                    }



                    // saber si existe un infocentro diferente con el mismo ID  
                    $info = InfoData::getById($array_fields[0]);

                    if ($info == 'null') {

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

                        $stmt_insert->execute();
                        $id = $stmt_insert->fetchAll(PDO::FETCH_ASSOC)[0]['id'];
                        echo "<span style='color:blue;'>NUEVO REGISTRO:</span>: " . $array_fields[2] . " - ID: " . $id . "<br>";

                        // si no es codigo de gerencia
                        if ($array_fields[55] == 0) {
                            // inserta los datos en las tablas foraneas
                            $info_inventory = $conn->prepare("INSERT INTO info_inventory (k_info, estado, code_info ) VALUES (?, ?, ?) ON CONFLICT (k_info, code_info) DO NOTHING");
                            $info_inventory->bindParam(1, $id);
                            $info_inventory->bindParam(2, $array_fields[10]);
                            $info_inventory->bindParam(3, $array_fields[2]);
                            $info_inventory->execute();

                            $info_process = $conn->prepare("INSERT INTO info_process (k_info, estado, code_info ) VALUES (?, ?, ?) ON CONFLICT (k_info, code_info) DO NOTHING");
                            $info_process->bindParam(1, $id);
                            $info_process->bindParam(2, $array_fields[10]);
                            $info_process->bindParam(3, $array_fields[2]);
                            $info_process->execute();
                        }


                        echo "<script>setProgress($total_xlsx,$k);</script>";

                        // Si ID ya existe el sistema genera uno nuevo
                    } else if ($info->cod != $param) {

                        // $stmt_insert->bindParam(1, $array_fields[0]);
                        $stmt_insert_noID->bindParam(1, $array_fields[1]);
                        $stmt_insert_noID->bindParam(2, $array_fields[2]);
                        $stmt_insert_noID->bindParam(3, $array_fields[3]);
                        $stmt_insert_noID->bindParam(4, $array_fields[4]);
                        $stmt_insert_noID->bindParam(5, $array_fields[5]);
                        $stmt_insert_noID->bindParam(6, $array_fields[6]);
                        $stmt_insert_noID->bindParam(7, $array_fields[7]);
                        $stmt_insert_noID->bindParam(8, $array_fields[8]);
                        $stmt_insert_noID->bindParam(9, $array_fields[9]);
                        $stmt_insert_noID->bindParam(10, $array_fields[10]);
                        $stmt_insert_noID->bindParam(11, $array_fields[11]);
                        $stmt_insert_noID->bindParam(12, $array_fields[12]);
                        $stmt_insert_noID->bindParam(13, $array_fields[13]);
                        $stmt_insert_noID->bindParam(14, $array_fields[14]);
                        $stmt_insert_noID->bindParam(15, $array_fields[15]);
                        $stmt_insert_noID->bindParam(16, $array_fields[16]);
                        $stmt_insert_noID->bindParam(17, $array_fields[17]);
                        $stmt_insert_noID->bindParam(18, $array_fields[18]);
                        $stmt_insert_noID->bindParam(19, $array_fields[19]);
                        $stmt_insert_noID->bindParam(20, $array_fields[20]);
                        $stmt_insert_noID->bindParam(21, $array_fields[21]);
                        $stmt_insert_noID->bindParam(22, $array_fields[22]);
                        $stmt_insert_noID->bindParam(23, $array_fields[23]);
                        $stmt_insert_noID->bindParam(24, $array_fields[24]);
                        $stmt_insert_noID->bindParam(25, $array_fields[25]);
                        $stmt_insert_noID->bindParam(26, $array_fields[26]);
                        $stmt_insert_noID->bindParam(27, $array_fields[27]);
                        $stmt_insert_noID->bindParam(28, $array_fields[28]);
                        $stmt_insert_noID->bindParam(29, $array_fields[29]);
                        $stmt_insert_noID->bindParam(30, $array_fields[30]);
                        $stmt_insert_noID->bindParam(31, $array_fields[31]);
                        $stmt_insert_noID->bindParam(32, $array_fields[32]);
                        $stmt_insert_noID->bindParam(33, $array_fields[33]);
                        $stmt_insert_noID->bindParam(34, $array_fields[34]);
                        $stmt_insert_noID->bindParam(35, $array_fields[35]);
                        $stmt_insert_noID->bindParam(36, $array_fields[36]);
                        $stmt_insert_noID->bindParam(37, $array_fields[37]);
                        $stmt_insert_noID->bindParam(38, $array_fields[38]);
                        $stmt_insert_noID->bindParam(39, $array_fields[39]);
                        $stmt_insert_noID->bindParam(40, $array_fields[40]);
                        $stmt_insert_noID->bindParam(41, $array_fields[41]);
                        $stmt_insert_noID->bindParam(42, $array_fields[42]);
                        $stmt_insert_noID->bindParam(43, $array_fields[43]);
                        $stmt_insert_noID->bindParam(44, $array_fields[44]);
                        $stmt_insert_noID->bindParam(45, $array_fields[45]);
                        $stmt_insert_noID->bindParam(46, $array_fields[46]);
                        $stmt_insert_noID->bindParam(47, $array_fields[47]);
                        $stmt_insert_noID->bindParam(48, $array_fields[48]);
                        $stmt_insert_noID->bindParam(49, $array_fields[49]);
                        $stmt_insert_noID->bindParam(50, $array_fields[50]);
                        $stmt_insert_noID->bindParam(51, $array_fields[51]);
                        $stmt_insert_noID->bindParam(52, $array_fields[52]);
                        $stmt_insert_noID->bindParam(53, $array_fields[53]);
                        $stmt_insert_noID->bindParam(54, $array_fields[54]);
                        $stmt_insert_noID->bindParam(55, $array_fields[55]);

                        $stmt_insert_noID->execute();
                        $id = $stmt_insert_noID->fetchAll(PDO::FETCH_ASSOC)[0]['id'];
                        echo "<span style='color:blue;'>NUEVO REGISTRO:</span>: " . $array_fields[2] . " - ID: " . $id . "<br>";

                        // si no es codigo de gerencia
                        if ($array_fields[55] == 0) {
                            // inserta los datos en las tablas foraneas
                            $info_inventory = $conn->prepare("INSERT INTO info_inventory (k_info, estado, code_info ) VALUES (?, ?, ?) ON CONFLICT (k_info, code_info) DO NOTHING");
                            $info_inventory->bindParam(1, $id);
                            $info_inventory->bindParam(2, $array_fields[10]);
                            $info_inventory->bindParam(3, $array_fields[2]);
                            $info_inventory->execute();

                            $info_process = $conn->prepare("INSERT INTO info_process (k_info, estado, code_info ) VALUES (?, ?, ?) ON CONFLICT (k_info, code_info) DO NOTHING");
                            $info_process->bindParam(1, $id);
                            $info_process->bindParam(2, $array_fields[10]);
                            $info_process->bindParam(3, $array_fields[2]);
                            $info_process->execute();
                        }


                        echo "<script>setProgress($total_xlsx,$k);</script>";
                    }
                    // ===

                } else {

                    // $query_fields = array();

                    for ($i = 0; $i < $cols - 1; $i++) {
                        $array_fields[] = (isset($fields[$i]) ? $fields[$i] : "");
                        $val_field = (isset($fields[$i]) ? $fields[$i] : "");
                        $val_field = str_replace("'", "", $val_field);

                        $data_field = $array_fields_name[$i];

                        $pass = 1;


                        if ($data_field != "" && $data_field != "f_registro") {

                            if ($val_field != "" && $val_field != $r->$data_field) {
                                // $query_fields[] = $data_field;
                                $data_q = $r->$data_field;

                                if ($data_field == "id") {
                                    // saber si existe un infocentro diferente con el mismo ID  
                                    $info = InfoData::getById($val_field);
                                    if ($info == 'null') {
                                        $pass = 1;
                                    } else if ($info->cod != $param) {
                                        echo "<span style='color:orange;'>Ya existe un ID igual en: </span><span style='color:blue;'> $param</span> > (" . $r->$data_field . ")  -POR- ($val_field) <br>";
                                        $pass = 0;
                                    }
                                }

                                if ($data_field == "region_tipo") {
                                    if ($val_field == 'NULL') {
                                        $val_field = '0';
                                    }
                                }
                                if ($data_field == "cod") {
                                    $val_field = str_replace(["\r\n", "\n", "\r"], '', $fields[$i]);
                                }
                                // if ($data_field == "id") {
                                //     echo "<span style='color:green;'>Actualizado:</span><span style='color:blue;'>$param</span> > $data_field : ($data_q)  -POR- ($val_field) <br>";
                                // }

                                if ($pass == 1) {
                                    echo "<span style='color:green;'>Actualizado:</span><span style='color:blue;'>$param</span> > $data_field : ($data_q)  -POR- ($val_field) <br>";
                                    $r->$data_field = $val_field;
                                }
                            }
                        }
                    }
                    $result = $r->updatePgXLSX();

                }
            }
            echo "<script>setProgress($total_xlsx,$k);</script>";
        }

        // actualiza el sequence del ID para que continue desde el maximo
        ExecutorPg::doit("SELECT setval(pg_get_serial_sequence('infocentros', 'id'),COALESCE((SELECT MAX(id) FROM infocentros), 1));");
    } else {
        echo SimpleXLSX::parseError();
    }
}


?>