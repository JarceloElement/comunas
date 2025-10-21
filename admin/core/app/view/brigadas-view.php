<?php
// ini_set("error_reporting", E_ALL & ~E_NOTICE & ~E_DEPRECATED);
// ini_set("log_errors", 1);

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$estados = EstadoData::getAll();

?>


<script language="javascript">
    $(document).ready(function() {

        <?php if (isset($_GET['swal']) && $_GET['swal'] != ""): ?>
            toastify('<?php echo $_GET["swal"]; ?>', true, 10000, "dashboard");
        <?php endif; ?>

        // cambiar el parametro de alert
        const url = new URL(window.location);
        url.searchParams.set('swal', '');
        window.history.pushState({}, '', url);

        const loadInputs = () => {
            let title =
                '<h2>Crear brigada</h2>';

            let brigadeName =
                '<input type="text" name="brigade_name" class="swal2-input text-black swal-input-class" id="brigade_name" placeholder="Nombre de la brigada"/>';

            let user_type = document.getElementById("user_type").value;
            let user_code_info = document.getElementById("user_code_info").value;
            if (user_type == 4 || user_type == 5 || user_type == 6 || user_type == 7 || user_type == 9) {

                var infoCode =
                    '<input type="text" name="info_code" class="swal2-input text-black swal-input-class" id="info_code" placeholder="Codigo del infocentro">';
            } else {
                var infoCode =
                    `<input disabled type="text" name="info_code" class="swal2-input text-black swal-input-class" id="info_code" placeholder="Codigo del infocentro" value="${user_code_info}">`;
            }

            return (
                title +
                brigadeName +
                infoCode
            );
        };

        const btnCreateBrigade = document.getElementById("create-brigade-btn");

        let inputHtml = loadInputs();

        btnCreateBrigade.addEventListener("click", async () => {
            Swal.fire({
                // title: "Crear brigada",
                html: inputHtml,
                allowEscapeKey: false,
                preConfirm: async (nothing) => {
                    let brigadeName = document.getElementById("brigade_name").value;
                    let infoCode = document.getElementById("info_code").value;

                    if (!brigadeName) {
                        Swal.showValidationMessage("El nombre de la brigada es obligatorio");
                        return;
                    }
                    if (!infoCode) {
                        Swal.showValidationMessage("El codigo del infocentro es obligatorio");
                        return;
                    }

                    await $.ajax({
                            type: "POST",
                            url: "index.php?action=brigade&function=add_new",
                            data: {
                                nombre: brigadeName,
                                info_cod: infoCode
                            }
                        })
                        .done(function(msg) {
                            var array = JSON.parse(msg);
                            if (array["success"] == true) {
                                return "La brigada ha sido creada";

                            } else {
                                Swal.showValidationMessage(array["message"]);
                            }
                        })
                        .fail(function(err) {
                            Swal.showValidationMessage(err);
                        });
                },
                allowOutsideClick: () => !Swal.isLoading(), // don't exit while loading fetch
                showLoaderOnConfirm: true,
                confirmButtonText: "Crear",
                cancelButtonText: "Salir",
                showConfirmButton: true,
                showCancelButton: true,
                confirmButtonColor: "#28a745",
                cancelButtonColor: "#dc3545",
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        icon: 'success',
                        text: "La brigada ha sido creada con éxito",
                        // title: "La brigada ha sido creada",
                        preConfirm: () => {
                            window.location.reload();
                        },
                        allowOutsideClick: () => {
                            window.location.reload();
                        },
                    });
                }
            });
        });



    });



    function uploadXLSX() {
        $('#cover-spin').show(0);
    }
</script>


<div id="cover-spin"></div>





<?php if ($_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 9) { ?>

	<div class="row">
		<div class="col-md-12">
			<div class="row justify-content-center container">

				<div class="col-md-4">
					<div class="row justify-content-center container">
						<form action="index.php?view=import_xlsx_brigadas" method="POST" enctype="multipart/form-data" />
						<span class="btn btn-raised btn-round btn-default btn-file">
							<span class="fileinput-new">Select</span>
							<span class="fileinput-exists">Change</span>
							<input type="file" name="dataCliente" id="file-input" class="file-input__input" accept=".xlsx" />
						</span>

						<button type="submit" name="subir" onclick="uploadXLSX()" class="btn btn-default btn-block">
							Subir Archivo
							<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 16 16">
								<path fill="currentColor" fill-rule="evenodd" d="M14 4.5V11h-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5zM7.86 14.841a1.13 1.13 0 0 0 .401.823q.195.162.479.252q.284.091.665.091q.507 0 .858-.158q.355-.158.54-.44a1.17 1.17 0 0 0 .187-.656q0-.336-.135-.56a1 1 0 0 0-.375-.357a2 2 0 0 0-.565-.21l-.621-.144a1 1 0 0 1-.405-.176a.37.37 0 0 1-.143-.299q0-.234.184-.384q.188-.152.513-.152q.214 0 .37.068a.6.6 0 0 1 .245.181a.56.56 0 0 1 .12.258h.75a1.1 1.1 0 0 0-.199-.566a1.2 1.2 0 0 0-.5-.41a1.8 1.8 0 0 0-.78-.152q-.44 0-.777.15q-.336.149-.527.421q-.19.273-.19.639q0 .302.123.524t.351.367q.229.143.54.213l.618.144q.31.073.462.193a.39.39 0 0 1 .153.326a.5.5 0 0 1-.085.29a.56.56 0 0 1-.255.193q-.168.07-.413.07q-.176 0-.32-.04a.8.8 0 0 1-.249-.115a.58.58 0 0 1-.255-.384zm-3.726-2.909h.893l-1.274 2.007l1.254 1.992h-.908l-.85-1.415h-.035l-.853 1.415H1.5l1.24-2.016l-1.228-1.983h.931l.832 1.438h.036zm1.923 3.325h1.697v.674H5.266v-3.999h.791zm7.636-3.325h.893l-1.274 2.007l1.254 1.992h-.908l-.85-1.415h-.035l-.853 1.415h-.861l1.24-2.016l-1.228-1.983h.931l.832 1.438h.036z" />
							</svg>
						</button>
					</div>
					</form>
				</div>

			</div>
		</div>
	</div>

<?php } ?>





<div class="card text-center">
    <div class="card-header card-header-rose">
        <h4 class="title text-left">Brigadas</h4>
    </div>
    <div class="card-body">
        <a id="create-brigade-btn" class="btn btn-primary text-white">Nueva brigada</a>
    </div>
    <input type="hidden" value="<?php echo ($_SESSION["user_type"]); ?>" id="user_type">
    <input type="hidden" value="<?php echo ($_SESSION["user_code_info"]); ?>" id="user_code_info">

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

$date_ini = date_create($start_at_q)->settime(0, 0)->format('Y-m-d');
$date_end = date_create($finish_at_q)->settime(0, 0)->format('Y-m-d');
// habilitar en PHP 8.0
// $start_at = $date_ini->format('Y-m-d');
// $finish_at = $date_end->format('Y-m-d');



// Validado  la variable GET
$compag = (int)(!isset($_GET['pag'])) ? 1 : $_GET['pag'];



$brigades = array();

if ((isset($_GET["q"]) || isset($_GET["start_at"]) || isset($_GET["finish_at"]) || isset($_GET["estado"]) || isset($_GET["info_id"])) && ($q != "" || $_GET["start_at"] != "" || $_GET["finish_at"] != "" || $_GET["estado"] != "" || $_GET["info_id"] != "")) {

    $sql = "SELECT * from brigades where info_cod != '' and";

    if ($_GET["q"] != "") {

        $q = utf8_encode($_GET["q"]);

        $sql .= " (nombre like '%$q%') ";
    }

    if ($info_id != "") {
        if ($_GET["q"] != "") {
            $sql .= ' and ';
        }
        $sql .= " info_id='" . $info_id . "'";
    }


    // solo admin visualiza la data nacional
    if ($_GET["estado"] != "" && ($_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7)) {
        if ($_GET["q"] != "" or $info_id != "") {
            $sql .= ' and ';
        }
        $sql .= " estado ='" . $_GET["estado"] . "'";
    } else if ($_GET["estado"] != "" && ($_SESSION["user_type"] != 4 && $_SESSION["user_type"] != 5 && $_SESSION["user_type"] != 6 && $_SESSION["user_type"] != 7)) {
        if ($_GET["q"] != "" or $info_id != "") {
            $sql .= ' and ';
        }
        $sql .= " estado ='" . $_SESSION["user_region"] . "'";
    } else if ($_GET["estado"] == "" && ($_SESSION["user_type"] != 4 && $_SESSION["user_type"] != 5 && $_SESSION["user_type"] != 6 && $_SESSION["user_type"] != 7)) {
        if ($_GET["q"] != "" or $info_id != "") {
            $sql .= ' and ';
        }
        $sql .= " estado ='" . $_SESSION["user_region"] . "'";
    }


    if ($_GET["start_at"] != "" and $_GET["finish_at"] != "") {
        if (($_SESSION["user_type"] != 4 && $_SESSION["user_type"] != 5 && $_SESSION["user_type"] != 6 && $_SESSION["user_type"] != 7) || $_GET["q"] != "" or $_GET["estado"] != "" or $info_id != "") {
            $sql .= ' and ';
        }
        // $sql .= " ( user_fecha_servicio >= STR_TO_DATE('" . $start_at . "', '%Y-%m-%d') and user_fecha_servicio <= STR_TO_DATE('" . $finish_at . "', '%Y-%m-%d') ) ";
        // $sql .= " ( user_fecha_reg >= STR_TO_DATE('".$start_at."', '%Y-%m-%d %H:%i:%s') and user_fecha_reg <= STR_TO_DATE('".$finish_at."', '%Y-%m-%d %H:%i:%s') ) ";
        $sql .= " date(datetime) BETWEEN '" . $date_ini . "' and '" . $date_end . "'";
    }

    if ($_GET["start_at"] != "" and $_GET["finish_at"] == "") {
        if (($_SESSION["user_type"] != 4 && $_SESSION["user_type"] != 5 && $_SESSION["user_type"] != 6 && $_SESSION["user_type"] != 7) || $_GET["q"] != "" or $_GET["estado"] != "" or $info_id != "") {
            $sql .= ' and ';
        }
        // $sql .= " ( user_fecha_servicio >= STR_TO_DATE('" . $start_at . "', '%Y-%m-%d') )";
        // $sql .= " ( user_fecha_reg >= STR_TO_DATE('".$start_at."', '%Y-%m-%d %H:%i:%s') )";
        $sql .= " date(datetime) >= '" . $date_ini . "'";
    }
    $sql .= " ORDER BY id desc";
    $param_csv = $sql;
    // echo $sql;

    // Busca el total de registros segun parametros de consulta
    $total = BrigadeData::getBySQL($sql);
    $TotalReg = $total[1];

    $sql .= " LIMIT " . $CantidadMostrar . " OFFSET " . (($compag - 1) * $CantidadMostrar);
    $brigades = BrigadeData::getBySQL($sql)[0];

    // Asigna url de paginacion
    $url_pag = "<a href=\"?view=brigadas&q=" . $q . "&estado=" . $_GET["estado"] . "&start_at=" . $_GET["start_at"] . "&finish_at=" . $_GET["finish_at"] . "&info_id=" . $_GET["info_id"] . "&pag=";
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

    $param_csv = $sql;
    $param_sql = "true";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $TotalReg = $stmt->rowCount();


    $sql .= " ORDER BY id desc LIMIT " . $CantidadMostrar . " OFFSET " . (($compag - 1) * $CantidadMostrar) . " ";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $brigades = $data;


    // if ($_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7) {
    //     // total aproximado con pg_class
    //     $row_table = $conn->prepare("SELECT reltuples::integer FROM pg_class WHERE relname = 'brigades'");

    //     $row_table->execute();
    //     $total_data = $row_table->fetchAll(PDO::FETCH_ASSOC);
    //     $TotalReg = $total_data[0]["reltuples"];
    // } else {
    //     $TotalReg = $stmt->rowCount();
    // }


    // print_r($TotalReg);

    $url_pag = "<a href=\"?view=brigadas&q=" . $q . "&estado=" . $estado_q . "&info_id=" . $info_id . "&start_at=&finish_at&pag=";
}

$param_csv = mb_convert_encoding($param_csv, 'UTF-8', 'UTF-8');

//Se divide la cantidad de registro de la BD con la cantidad a mostrar 
$TotalRegistro = 0;
if ($TotalReg > 0) {
    $TotalRegistro = ceil($TotalReg / $CantidadMostrar);
}
$DB_name = "brigades";

// print_r($brigades);

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
                                <!-- <td><!?php echo date("d/m/Y", timestamp: strtotime($brigade["datetime"])); ?></td> -->
                                <td><?php echo $brigade["datetime"]; ?></td>
                                <td><?php echo $brigade["estado"]; ?></td>
                                <td><?php echo $brigade["info_cod"]; ?></td>
                                <td><?php echo $brigade["nombre"]; ?></td>

                                <td>
                                    <?php if ($_SESSION["user_type"] != 10) { ?>
                                        <?php if ($_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7) { ?>
                                            <a href="../?view=brigadas_edit&id=<?php echo $brigade["id"]; ?>" class="btn btn-info btn-sm"><i><svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24">
                                                        <path fill="currentColor" d="M3 21v-4.25L16.2 3.575q.3-.275.663-.425t.762-.15t.775.15t.65.45L20.425 5q.3.275.438.65T21 6.4q0 .4-.137.763t-.438.662L7.25 21zM17.6 7.8L19 6.4L17.6 5l-1.4 1.4z" />
                                                    </svg></i></a>
                                            <a href="index.php?action=brigade&function=delete&id=<?php echo $brigade["id"]; ?>&q=<?php echo $q; ?>&estado=<?php echo $brigade["estado"]; ?>&start_at=<?php echo $start_at_q; ?>&finish_at=<?php echo $finish_at_q; ?>&pag=<?php echo $pag; ?>&info_id=<?php echo $info_id; ?>"
                                                class="btn btn-danger btn-sm"><i class="material-icons">close</i></a>

                                        <?php } elseif (($_SESSION["user_type"] == 2 || $_SESSION["user_type"] == 3 || $_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 8 || $_SESSION["user_type"] == 9) && (strtoupper($_SESSION["user_code_info"]) == $brigade["info_cod"])) { ?>
                                            <a href="../?view=brigadas_edit&id=<?php echo $brigade["id"]; ?>" class="btn btn-info btn-sm"><i><svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24">
                                                        <path fill="currentColor" d="M3 21v-4.25L16.2 3.575q.3-.275.663-.425t.762-.15t.775.15t.65.45L20.425 5q.3.275.438.65T21 6.4q0 .4-.137.763t-.438.662L7.25 21zM17.6 7.8L19 6.4L17.6 5l-1.4 1.4z" />
                                                    </svg></i></a>
                                            <a href="index.php?action=brigade&function=delete&id=<?php echo $brigade["id"]; ?>&q=<?php echo $q; ?>&estado=<?php echo $brigade["estado"]; ?>&start_at=<?php echo $start_at_q; ?>&finish_at=<?php echo $finish_at_q; ?>&pag=<?php echo $pag; ?>&info_id=<?php echo $info_id; ?>"
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

        <?php
        if (count($brigades) > 1) {
            include "core/app/layouts/pagination.php";
        }
        ?>

    </div>




    <style>
        .swal-input-class::placeholder {
            color: #000 !important;
            opacity: 0.5 !important;
        }

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