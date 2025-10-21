<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$estados = EstadoData::getAll();

?>


<script language="javascript">
    $(document).ready(function () {

        <?php if (isset($_GET['swal']) && $_GET['swal'] != ""): ?>
            toastify('<?php echo $_GET["swal"]; ?>', true, 10000, "dashboard");
        <?php endif; ?>

        // cambiar el parametro de alert
        const url = new URL(window.location);
        url.searchParams.set('swal', '');
        window.history.pushState({}, '', url);

    });



    function uploadXLSX() {
        $('#cover-spin').show(0);
    }
</script>


<div id="cover-spin"></div>



<!-- Modal -->
<div class="modal" id="image_preview" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="title_preview" id="codigo_info">Registro de servicios</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>

            <div class="modal-body fullscreen" id="modal-body">
                <?php include "core/app/view/form_services_modal.php"; ?>
            </div>

            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div> -->
        </div>
    </div>
</div>





<?php if ($_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 9) { ?>

    <center>
        <div class="row">
            <div class="col-md-12">

                <!-- ACTUALIZAR REGISTROS POR LOTES -->
                <!-- <div class="col-md-4">
                    <form action="index.php?view=import_xlsx_services" method="POST" enctype="multipart/form-data" />
                    <span class="btn btn-raised btn-round btn-default btn-file">
                        <span class="fileinput-new"></span>
                        <span class="fileinput-exists"></span>
                        <input type="file" name="info_process" id="file-input" class="file-input__input" accept=".xlsx" />
                        <input type="hidden" name="os" id="os" value="" />
                    </span>
                    <button type="submit" name="subir" onclick="uploadXLSX()" class="btn btn-info btn-block"><i class="far fa-file"></i> Subir Archivo XLSX</button>
                    </form>
                </div> -->

            </div>
        </div>
    </center>


<?php } ?>

<div class="card text-center">
    <div class="card-header card-header-rose">
        <h4 class="title text-left">Brigadas</h4>
    </div>
    <div class="card-body">
        <a href="./../index.php?view=brigadas_new&new=1" class="btn btn-primary">Nueva brigada</a>
    </div>
</div>



<!-- <!?php include "core/app/view/form_services.php"; ?> -->



<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header card-header-primary">
                        <h4 class="title text-left">Buscar brigadas</h4>
                        <!-- <p class="card-category">Complete your profile</p> -->
                    </div>

                    <div class="form-group">

                        <div class="card-body">
                            <form class="form-horizontal" role="form">
                                <input type="hidden" name="view" value="brigadas">

                                <div class="row">

                                    <div class="col">
                                        <div class="form-group col-mg-4">
                                            <div class="col-md-12 mui-textfield mui-textfield--float-label">
                                                <input type="text" name="q" value="<?php if (isset($_GET["q"]) && $_GET["q"] != "") {
                                                    echo $_GET["q"];
                                                } ?>">
                                                <label><i class="fa fa-search"></i> Palabra clave</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group col-mg-4">
                                            <div class="col-md-12 mui-textfield mui-textfield--float-label">
                                                <input type="text" name="info_id" value="<?php if (isset($_GET["info_id"]) && $_GET["info_id"] != "") {
                                                    echo $_GET["info_id"];
                                                } ?>">
                                                <label><i class="fa fa-search"></i> Código info</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group col-mg-4">
                                            <div class="col-md-12 mui-textfield mui-textfield--float-label">
                                                <input type="text" name="uid" value="<?php if (isset($_GET["uid"]) && $_GET["uid"] != "") {
                                                    echo $_GET["uid"];
                                                } ?>">
                                                <label><i class="fa fa-search"></i> UID</label>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="form-group ">
                                            <span class="input-group-addon"><i class="fa fa-map"></i> Estado</span>
                                            <select name="estado" class="form-control">
                                                <option value="">ESTADO</option>
                                                <?php foreach ($estados as $p): ?>
                                                    <option value="<?php echo $p->estado; ?>"><?php echo $p->estado ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>



                                </div>



                                <div class="form-group ">
                                    <div class="row">

                                        <div class="col">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="material-icons">date_range</i>
                                                </span> Desde
                                            </div>
                                            <input type="date" name="start_at" value="<?php if (isset($_GET["start_at"]) && $_GET["start_at"] != "") {
                                                echo $_GET["start_at"];
                                            } ?>" class="form-control">
                                        </div>


                                        <div class="col">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="material-icons">date_range</i>
                                                </span> Hasta
                                            </div>
                                            <input type="date" name="finish_at" value="<?php if (isset($_GET["finish_at"]) && $_GET["finish_at"] != "") {
                                                echo $_GET["finish_at"];
                                            } ?>" class="form-control">
                                        </div>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary float-right">Buscar</button>
                                </div>

                            </form>



                        </div>
                    </div>


                </div>
            </div>
        </div>

    </div>
</div>






<?php


$CantidadMostrar = 30;
$url_pag_atras = "";
$url_pag_adelante = "";

$start_at_q = isset($_GET["start_at"]) ? $_GET["start_at"] : "";
$finish_at_q = isset($_GET["finish_at"]) ? $_GET["finish_at"] : "";
$q = isset($_GET["q"]) ? $_GET["q"] : "";
$uid_q = isset($_GET["uid"]) ? $_GET["uid"] : "";
$estado_q = isset($_GET["estado"]) ? $_GET["estado"] : "";
$pag = isset($_GET["pag"]) ? $_GET["pag"] : "";
$code_info = isset($_GET["info_id"]) ? $_GET["info_id"] : "";
$info_id = "";
$TotalReg = 0;



if ($code_info != "") {
    $code_info = trim(strtoupper($code_info));
    $conn = DatabasePg::connectPg();
    $row = $conn->prepare("SELECT * FROM infocentros WHERE cod='$code_info'");
    $row->execute();
    $data = $row->fetchAll(PDO::FETCH_ASSOC)[0];
    $info_id = isset($data["id"]) ? $data["id"] : "0";
}

// $date=date_create("2013-03-15 23:40:00",timezone_open("Europe/Oslo"));
// echo date_format($date,"Y/m/d H:iP");

// $date_ini = date_create($start_at_q." 00:00:00");
// $date_end = date_create($finish_at_q." 23:59:59");
// $start_at = $date_ini->format('Y-m-d H:i:s');
// $finish_at = $date_end->format('Y-m-d H:i:s');

$date_ini = date_create($start_at_q);
$date_end = date_create($finish_at_q);
$start_at = $date_ini->format('Y-m-d');
$finish_at = $date_end->format('Y-m-d');
$uid = isset($_GET['uid']) ? $_GET["uid"] : "";

// Validado  la variable GET
$compag = (int) (!isset($_GET['pag'])) ? 1 : $_GET['pag'];

$brigades = array();
if ((isset($_GET["q"]) || isset($_GET["start_at"]) || isset($_GET["finish_at"]) || isset($_GET["uid"]) || isset($_GET["estado"]) || isset($_GET["info_id"])) && ($q != "" || $_GET["start_at"] != "" || $_GET["finish_at"] != "" || $uid_q != "" || $_GET["estado"] != "" || $_GET["info_id"] != "" || $_GET["uid"] != "")) {

    $sql = "SELECT * from brigades where info_cod != '' and";

    if ($_GET["q"] != "") {
        $sql .= " (nombre like '%$_GET[q]%') ";
    }

    if ($_GET["uid"] != "") {
        if ($_GET["q"] != "") {
            $sql .= ' and ';
        }
        $sql .= " user_id ='" . $_GET["uid"] . "'";
    }

    if ($info_id != "") {
        if ($_GET["q"] != "" || $_GET["uid"] != "") {
            $sql .= ' and ';
        }
        $sql .= " info_cod='" . $info_id . "'";
    }


    // solo admin visualiza la data nacional
    if ($_GET["estado"] != "" && ($_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7)) {
        if ($_GET["q"] != "" or $_GET["uid"] != "" or $info_id != "") {
            $sql .= ' and ';
        }
        $sql .= " estado ='" . $_GET["estado"] . "'";
    } else if ($_GET["estado"] != "" && ($_SESSION["user_type"] != 4 && $_SESSION["user_type"] != 5 && $_SESSION["user_type"] != 6 && $_SESSION["user_type"] != 7)) {
        if ($_GET["q"] != "" or $_GET["uid"] != "" or $info_id != "") {
            $sql .= ' and ';
        }
        $sql .= " estado ='" . $_SESSION["user_region"] . "'";
    } else if ($_GET["estado"] == "" && ($_SESSION["user_type"] != 4 && $_SESSION["user_type"] != 5 && $_SESSION["user_type"] != 6 && $_SESSION["user_type"] != 7)) {
        if ($_GET["q"] != "" or $_GET["uid"] != "" or $info_id != "") {
            $sql .= ' and ';
        }
        $sql .= " estado ='" . $_SESSION["user_region"] . "'";
    }


    if ($_GET["start_at"] != "" and $_GET["finish_at"] != "") {
        if (($_SESSION["user_type"] != 4 && $_SESSION["user_type"] != 5 && $_SESSION["user_type"] != 6 && $_SESSION["user_type"] != 7) || $_GET["q"] != "" or $_GET["estado"] != "" or $_GET["uid"] != "" or $info_id != "") {
            $sql .= ' and ';
        }
        // $sql .= " ( user_fecha_servicio >= STR_TO_DATE('" . $start_at . "', '%Y-%m-%d') and user_fecha_servicio <= STR_TO_DATE('" . $finish_at . "', '%Y-%m-%d') ) ";
        // $sql .= " ( user_fecha_reg >= STR_TO_DATE('".$start_at."', '%Y-%m-%d %H:%i:%s') and user_fecha_reg <= STR_TO_DATE('".$finish_at."', '%Y-%m-%d %H:%i:%s') ) ";
        $sql .= " datetime BETWEEN '" . $start_at . "' and '" . $finish_at . "'";
    }

    if ($_GET["start_at"] != "" and $_GET["finish_at"] == "") {
        if (($_SESSION["user_type"] != 4 && $_SESSION["user_type"] != 5 && $_SESSION["user_type"] != 6 && $_SESSION["user_type"] != 7) || $_GET["q"] != "" or $_GET["estado"] != "" or $_GET["uid"] != "" or $info_id != "") {
            $sql .= ' and ';
        }
        // $sql .= " ( user_fecha_servicio >= STR_TO_DATE('" . $start_at . "', '%Y-%m-%d') )";
        // $sql .= " ( user_fecha_reg >= STR_TO_DATE('".$start_at."', '%Y-%m-%d %H:%i:%s') )";
        $sql .= " datetime >= '" . $start_at . "'";
    }

    $sql .= " ORDER BY datetime desc";
    $param_csv = $sql;
    // echo $sql;

    // Busca el total de registros segun parametros de consulta
    $total = BrigadeData::getBySQL($sql);
    $TotalReg = $total[1];

    $sql .= " LIMIT " . $CantidadMostrar . " OFFSET " . (($compag - 1) * $CantidadMostrar);
    $brigades = BrigadeData::getBySQL($sql)[0];

    // Asigna url de paginacion
    $url_pag = "<a href=\"?view=brigadas&q=" . $q . "&estado=" . $_GET["estado"] . "&start_at=" . $_GET["start_at"] . "&finish_at=" . $_GET["finish_at"] . "&info_id=" . $_GET["info_id"] . "&uid=" . $_GET["uid"] . "&pag=";
    // echo $sql;
    $param_sql = "true";
} else {

    // solo admin visualiza la data nacional
    if ($_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7) {
        // $sql_t = "SELECT  * from services_users where user_info_cod != '' and user_fecha_servicio>='2024-01-01'";
        $sql = "SELECT  * from brigades where info_cod != ''";
    } else {
        // $sql_t = "SELECT  * from services_users where user_info_cod != '' and user_fecha_servicio>='2024-01-01' and user_estado ='".$_SESSION["user_region"]."'";
        $sql = "SELECT  * from brigades where info_cod !='' and estado ='" . $_SESSION["user_region"] . "'";
    }

    $conn = DatabasePg::connectPg();

    // $sql .= " AND user_fecha_servicio between '2024-01-01' and '2025-12-31'";
    // $sql .= " order by user_fecha_reg desc";
    $sql .= " LIMIT " . $CantidadMostrar . " OFFSET " . (($compag - 1) * $CantidadMostrar);
    echo $sql;
    
    $stmt = $conn->prepare(query: $sql);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $brigades = $data;

    print_r($data);
    return;

    if ($_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7) {
        // total aproximado con pg_class
        $row_table = $conn->prepare("SELECT reltuples::integer FROM pg_class WHERE relname = 'brigades'");

        $row_table->execute();
        $total_data = $row_table->fetchAll(PDO::FETCH_ASSOC);
        $TotalReg = $total_data[0]["reltuples"];
        // $TotalReg = 1000;
    } else {
        $TotalReg = $stmt->rowCount();
    }


    $url_pag = "<a href=\"?view=brigadas&q=" . $q . "&estado=" . $estado_q . "&info_id=" . $info_id . "&uid=" . $uid . "&start_at=&finish_at&pag=";

    $param_csv = "brigades";
    $param_sql = "false";
}

//Se divide la cantidad de registro de la BD con la cantidad a mostrar 
$TotalRegistro = 0;
if ($TotalReg > 0) {
    $TotalRegistro = ceil($TotalReg / $CantidadMostrar);
}
$DB_name = "brigades";
?>


<!-- si hay registros -->
<?php if (count($brigades) > 0) { ?>

    <div class="col-md-12">

        <!-- aviso cantidad de registros -->
        <div class="form-group text_label">
            <?php echo "<span class='text_label'> <i class='fa fa-bullhorn icon_label' ></i> <b> Hay " . $TotalReg . " Registros </b>. La cantidad se dividió a " . $TotalRegistro . " páginas para mostrar de " . $CantidadMostrar . " en " . $CantidadMostrar . " </span>" . "<br><br>"; ?>
        </div>


        <!-- botones de descarga de reportes -->
        <div class="col-md-12">
            <div class="input-group">
                <a href="./pdf/csv_pdo.php?param_csv=<?php echo $param_csv . '&param_sql=' . $param_sql . '&DB_name=' . $DB_name; ?>"
                    name="Descargar" class=" btn btn-success "><i class="fa fa-file-excel-o"></i> CSV</a>
                <a target="_blank" class="btn btn-success"
                    href="../core/app/view/exportxlsx_2.php?param=<?php echo $param_csv . '&param_sql=true&filename=' . $DB_name; ?>"
                    name="Descargar"><i class="fa fa-file-excel-o"></i> XLSX</a>

            </div>

            <br>
        </div>
    </div>


    <div class="col-md-12">
        <div class="card">

            <div class="card-content table-responsive">
                <div class="card-body">

                    <!-- <table class="table"> -->
                    <table class="table table-bordered table-hover">

                        <!-- INONOS -->
                        <thead>
                            <th class="text_label "> <i class="fa fa-gear icon_table"></i></th>
                            <th class="text_label "> <i class="fa fa-calendar icon_table"></i></th>
                            <th class="text_label "> <i class="fa fa-map icon_table"></i></th>
                            <th class="text_label "> <i class="fa fa-building icon_table"></i></th>
                            <th class="text_label "> <i class="fa fa-building icon_table"></i></th>
                            <!-- <th class="text_label " style="width: 200px;"> <i class="fa fa-newspaper-o icon_table" ></i></th> -->
                            <th class="text_label "> <i class="fa fa-cog icon_table"></i></th>
                        </thead>

                        <!-- TITULOS -->
                        <thead>
                            <th> ID</th>
                            <th> Fecha de creacion</th>
                            <th> Estado</th>
                            <th> Infocentro</th>
                            <th> Nombre</th>
                            <th> Herramientas</th>

                        </thead>


                        <?php
                        $ID = 0;

                        $imagen_p = "";
                        $titulo_p = "";
                        $code_info_p = "";

                        foreach ($brigades as $brigade) { ?>
                            <tr>
                                <td><?php echo $brigade["id"]; ?></td>
                                <td><?php echo date("d/m/Y", timestamp: strtotime($brigade["datetime"])); ?></td>
                                <td><?php echo $brigade["estado"]; ?></td>
                                <td><?php echo $brigade["info_cod"]; ?></td>
                                <td><?php echo $brigade["nombre"]; ?></td>
                            
                                <td>
                                    <?php if ($_SESSION["user_type"] != 10) { ?>
                                        <?php if ($_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7) { ?>
                                            <a href="index.php?action=brigade&function=delete&id=<?php echo $brigade["id"]; ?>&uid=<?php echo $uid_q; ?>&q=<?php echo $q; ?>&estado=<?php echo $brigade["estado"]; ?>&start_at=<?php echo $start_at_q; ?>&finish_at=<?php echo $finish_at_q; ?>&pag=<?php echo $pag; ?>&info_id=<?php echo $info_id; ?>"
                                                class="btn btn-danger btn-sm"><i class="material-icons">close</i></a>

                                        <?php } elseif (($_SESSION["user_type"] == 2 || $_SESSION["user_type"] == 3 || $_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 8 || $_SESSION["user_type"] == 9) && (strtoupper($_SESSION["user_code_info"]) == $brigade["info_cod"])) { ?>
                                            <a href="index.php?action=brigade&function=delete&id=<?php echo $brigade["id"]; ?>&uid=<?php echo $uid_q; ?>&q=<?php echo $q; ?>&estado=<?php echo $brigade["estado"]; ?>&start_at=<?php echo $start_at_q; ?>&finish_at=<?php echo $finish_at_q; ?>&pag=<?php echo $pag; ?>&info_id=<?php echo $info_id; ?>"
                                                class="btn btn-danger btn-sm"><i class="material-icons">close</i></a>
                                        <?php } ?>
                                    <?php } ?>

                                </td>

                            </tr>
                            <?php
                            $ID += 1;
                        }
                        ?>


                    </table>


                    <?php
} else {
    echo "<p class='alert alert-danger'>No hay brigadas registradas</p>";
}
?>

            </div class="card-content table-responsive">

        </div>
    </div>
</div>

<center>

    <?php

    /*Sector de Paginacion */

    //Operacion matematica para boton siguiente y atras 
    $IncrimentNum = (($compag + 1) <= $TotalRegistro) ? ($compag + 1) : 1;
    $DecrementNum = (($compag - 1)) < 1 ? 1 : ($compag - 1);

    echo $url_pag . $DecrementNum . "\" class=\"btn btn-info btn-sm\"> <i class=\"fa fa-arrow-left\"></i> </a>";

    //Se resta y suma con el numero de pag actual con el cantidad de 
    //numeros  a mostrar
    $Desde = $compag - (ceil($CantidadMostrar / 2) - 1);
    $Hasta = $compag + (ceil($CantidadMostrar / 2) - 1);

    //Se valida
    $Desde = ($Desde < 1) ? 1 : $Desde;
    $Hasta = ($Hasta < $CantidadMostrar) ? $CantidadMostrar : $Hasta;
    //Se muestra los numeros de paginas
    for ($i = $Desde; $i <= $Hasta; $i++) {
        //Se valida la paginacion total
        //de registros
        if ($i <= $TotalRegistro) {
            //Validamos la pag activo
            if ($i == $compag) {
                echo $url_pag . $i . "\" class=\"btn btn-primary btn-sm\"active\">" . $i . "  </a>";
            } else {
                echo $url_pag . $i . "\" class=\"btn btn-info btn-sm\">" . $i . "  </a>";
            }
        }
    }

    // echo "<a href=\"?view=tickets&pag=".$IncrimentNum."\" class=\"btn btn-info btn-xs\"> <i class=\"fa fa-arrow-right\"></i> </a>";
    echo $url_pag . $IncrimentNum . "\" class=\"btn btn-info btn-sm\"> <i class=\"fa fa-arrow-right\"></i> </a>";


    ?>

</center>









<style>
    .title {
        margin-top: 0;
        margin-bottom: 5px;
        margin-left: 10px;
        margin-right: -20px;
    }

    /* .card {
    font-size: 14px;
    margin: 15px 0;
}

h5, .h5 {
    font-size: 1.0em;
    line-height: 1.0em;
    margin-bottom: 15px;
} */

    .icon_table {
        font-size: 24px;
        color: #585858;
        margin-right: 10px;
    }

    /* .btn_preview {
    color: #FFFFFF;
    background: #8a8a8a;
    box-shadow: none;
    padding: 0px 0px;
    margin: 0px 0px;
    border: none;
    opacity: 1;
} */


    .fullscreen-swal {
        z-index: 9999 !important;
        width: 100vw !important;
        height: 90vh !important;
    }
</style>