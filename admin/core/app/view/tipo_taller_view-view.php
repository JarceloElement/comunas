<script language="javascript">
    function del_item(url) {
        Swal.fire({
            title: "<br>¿Desea eliminar?",
            text: "¡Esto es irreversible!",
            // icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "¡Sí, eliminar!",
            cancelButtonText: "Cancelar",
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url
            }
        });
    };

    $(document).ready(function() {
        $('#cover-spin').hide(0);

        // <!-- MODAL SWEET ALERT -->
        $(function() {
            <?php if (isset($_SESSION['alert']) && $_SESSION['alert'] != "") : ?>
                if (getOS() != "Android") {
                    Swal.fire({
                        icon: 'success',
                        title: '<?php echo $_SESSION['alert']; ?>',
                        showConfirmButton: false,
                        timer: 1000
                    })
                } else {
                    alert("<?php echo $_SESSION['alert']; ?>");
                }

                <?php echo $_SESSION['alert'] = ""; ?>

            <?php endif; ?>
        });


    });





    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("add_tipo_taller").addEventListener('submit', validarFormulario);
    });

    function validarFormulario(event) {
        event.preventDefault();

        $('#cover-spin').show(0);

        $.ajax({
                type: "POST",
                url: "./?action=ajax",
                // headers: {
                //     "X-CSRFToken": getCookie("csrftoken")
                // },
                data: {
                    function: "add_tipo_taller", // funcion que llama
                    line_action: $("#line_action").val(),
                    nivel: $("#nivel").val(),
                    modalidad: $("#modalidad").val(),
                    nombre_taller: $("#nombre_taller").val(),
                    descripcion_taller: $("#descripcion_taller").val(),
                    duracion_horas: $("#duracion_horas").val(),
                    permisos: $("#permisos").val()
                }
            })
            .done(function(msg) {
                // toastify('Guardado', true, 1000, "dashboard");
                location.reload();
                // $('#content').reload('#content');

            })
            .fail(function() {
                toastify('Hubo un error al guardar', true, 5000, "warning");
            });
        // .always(function() {
        //     toastify('Finished',true,1000,"warning");
        // });

    };

    function uploadXLSX() {
        $('#cover-spin').show(0);
    }
</script>


<?php
$training_type = TrainingTypeData::getAll();

?>


<?php if ($_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 9) { ?>

    <div class="row">
        <div class="col-md-12">
            <div class="row justify-content-center container">

                <div class="col-md-4">
                    <div class="row justify-content-center container">
                        <form action="index.php?view=import_xlsx_tipo_taller" method="POST" enctype="multipart/form-data" />
                        <span class="btn btn-raised btn-round btn-default btn-file">
                            <span class="fileinput-new">Select</span>
                            <span class="fileinput-exists">Change</span>
                            <input type="file" name="datafile" id="file-input" class="file-input__input" accept=".xlsx" />
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



<div class="content" id="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <br>
                        <div class="panel-heading">
                            <h4 class="title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                                    <span class='text_label'> <i class='fa fa-cogs icon_label'></i> <b> Agregar tipos de talleres </b> </span>
                                </a>
                            </h4>
                        </div>

                        <br>

                        <form method="post" id="add_tipo_taller" role="form">


                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="line_action" class=" control-label"><i class="fa fa-cogs"></i> Categoría de formación</label>
                                        <select name="line_action" class="form-control" id="line_action" required>
                                            <option value="">-SELECCIONE-</option>
                                            <?php foreach ($training_type as $p): ?>
                                                <option value="<?php echo $p->name_training_type; ?>"> <?php echo $p->name_training_type; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nivel" class="control-label"><i class="fa fa-cogs"></i> Nivel del taller</label>
                                        <select name="nivel" class="form-control" id="nivel" required>
                                            <option value="">-SELECCIONE-</option>
                                            <option value="No aplica">No aplica</option>
                                            <option value="Básico">Básico</option>
                                            <option value="Medio">Medio</option>
                                            <option value="Avanzado">Avanzado</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="modalidad" class="control-label"><i class="fa fa-cogs"></i> Modalidad</label>
                                        <select name="modalidad" class="form-control" id="modalidad" required>
                                            <option value="">-SELECCIONE-</option>
                                            <option value="Presencial">Presencial</option>
                                            <option value="En línea">En línea</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="nombre_taller" class="control-label"><i class="fa fa-cogs"></i> Nombre taller</label>
                                        <input type="text" name="nombre_taller" id="nombre_taller" required class="form-control" placeholder="Descripción"></input>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="descripcion_taller" class="control-label"><i class="fa fa-cogs"></i> Descripción del taller</label>
                                        <textarea type="text" name="descripcion_taller" id="descripcion_taller" class="form-control" placeholder="Descripción"></textarea>
                                        <span><label style="color:blueviolet;"> Si se deja vacío se tomará la descripción del curso</label></span>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="duracion_horas" class="control-label"><i class="fa fa-cogs"></i> Duración (Horas)</label>
                                        <input type="number" name="duracion_horas" id="duracion_horas" required class="form-control" placeholder="Descripción"></input>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="permisos" class="control-label"><i class="fa fa-cogs"></i> Habilitar solo a los infocentros marcados</label>
                                        <textarea type="text" name="permisos" id="permisos" class="form-control" placeholder="AMA01, AMA02"></textarea>
                                        <span><label style="color:blueviolet;"> Ésta categoría solo será visible a éstos códigos. Escriba los códigos separarados por comas. (En blanco se muestra a todos)</label></span>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block">Agregar</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>

                </div>

            </div>
        </div>
    </div>
</div>



<!-- Obtengo los datos para la paginacion -->
<?php
$CantidadMostrar = 500;
$url_pag_atras = "";
$url_pag_adelante = "";

// Validado  la variable GET
$compag = (int)(!isset($_GET['pag'])) ? 1 : $_GET['pag'];


// pg
$total = TrainingTypeData::getAllPg("SELECT * from tipo_taller order by id desc");
$TotalReg = $total[1];

$sql = "SELECT * from tipo_taller order by id desc";

$param_csv = mb_convert_encoding($sql, 'UTF-8', 'UTF-8');
// $param_sql = mb_convert_encoding($sql, 'UTF-8', 'UTF-8');
$DB_name = "tipo_taller";

$sql .= " LIMIT " . $CantidadMostrar . " OFFSET " . (($compag - 1) * $CantidadMostrar);
$param = TrainingTypeData::getObj($sql);

$url_pag = "<a href=\"?view=tipo_taller&pag=";

//Se divide la cantidad de registro de la BD con la cantidad a mostrar 
$TotalRegistro  = ceil($TotalReg / $CantidadMostrar);

?>
<!-- --------------------------- -->





<div class="content" id="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">

                        <!-- creo la tabla con la consulta -->
                        <div class="card-content table-responsive">
                            <div class="card-body">

                                <?php if (count($param) > 0) { ?>
                                    <!-- si hay usuarios -->

                                    <div class="form-group text_label">
                                        <?php echo "<span class='text_label'> <i class='fa fa-bullhorn icon_label' ></i> <b> Hay " . $TotalReg . " Registros </b>. La cantidad se dividió a " . $TotalRegistro . " páginas para mostrar de " . $CantidadMostrar . " en " . $CantidadMostrar . "</span>" . "<br><br>"; ?>
                                    </div>

                                    <!-- botones de descarga de reportes -->
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <!-- <a href="./pdf/csv_pdo.php?param_csv=<!?php echo $param_csv . '&param_sql=' . $param_sql . '&DB_name=' . $DB_name; ?>"
												name="Descargar" class=" btn btn-success "><i class="fa fa-file-excel-o"></i> CSV
											</a> -->
                                            <a target="_blank" class="btn btn-success"
                                                href="../core/app/view/exportxlsx_2.php?param=<?php echo $param_csv . '&param_sql=true&filename=' . $DB_name; ?>"
                                                name="Descargar"><i class="fa fa-file-excel-o"></i> XLSX
                                            </a>

                                        </div>

                                        <br>
                                    </div>

                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <th>N°</th>
                                            <th>Categoría de formación</th>
                                            <th>Nombre del taller</th>
                                            <th>Descripción del taller</th>
                                            <th>Duración</th>
                                            <th>Nivel</th>
                                            <th>Modalidad</th>
                                            <th>Permisos</th>
                                            <th>Acciones</th>
                                        </thead>

                                        <?php
                                        $conteo = 0;
                                        foreach ($param as $user) {
                                            $conteo += 1;

                                        ?>
                                            <tr>
                                                <td><?php echo $conteo; ?></td>
                                                <td><?php echo $user->name_training_type; ?></td>
                                                <td><?php echo $user->nombre_taller; ?></td>
                                                <td><?php echo $user->descripcion_taller; ?></td>
                                                <td><?php echo $user->duracion_horas; ?></td>
                                                <td><?php echo $user->nivel; ?></td>
                                                <td><?php echo $user->modalidad; ?></td>
                                                <td><label style="font-size: 12px; width:200px; color:black;"><?php echo $user->permisos; ?></label></td>

                                                <td style="width:180px;">
                                                    <a href="./?view=edit_tipo_taller&id=<?php echo $user->id; ?>" class="btn btn-warning btn-sm"><i class="material-icons">edit</i></a>

                                                    <?php $URL = "./?action=ajax&function=del_tipo_taller&id=" . $user->id; ?>
                                                    <button type="button" onclick="del_item('<?php echo $URL; ?>')" title="Eliminar" class="btn btn-danger btn-sm"><i class="material-icons">close</i></button>

                                                </td>
                                            </tr>
                                        <?php }    ?>

                                    </table>
                                <?php
                                } else {
                                    echo "<p class='alert alert-danger'>No hay registros</p>";
                                }
                                ?>

                            </div>

                        </div class="card-content table-responsive">

                        <!-- Botones de paginacion -->
                        <?php include "core/app/layouts/pagination.php"; ?>

                    </div>


                </div>

            </div>
        </div>
    </div>
</div>




<script language="javascript">
    // carga nuevas dimensiones
    $(document).ready(function() {

        $("#line_action").change(function() {
            $('#tipo_reporte').find('option').remove().end().append('<option value=""></option>').val('0');
            $("#line_action option:selected").each(function() {
                line = $(this).val();
                console.log($("#tipo_reporte").val());
                $.post("core/app/view/get_strategic_action.php", {
                    line: line
                }, function(data) {
                    $("#tipo_reporte").html(data);
                    // console.log(data);
                });

            });
        })




    });
</script>