<script language="javascript">
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


    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("nueva_formación").addEventListener('submit', validarFormulario);
    });

    function validarFormulario(event) {
        event.preventDefault();

        $('#cover-spin').show(0);

        var tipo_reporte = $("#tipo_reporte").val().split(",");
        var line_action = $("#line_action").val().split(",");
        var accion_especifica = $("#accion_especifica").val().split(",");
        if ($("#nombre_curso").val() != "" && $("#accion_especifica").val() != "") {

            $.ajax({
                    type: "POST",
                    url: "./?action=ajax",
                    data: {
                        function: "add_tipo_formacion", // funcion que llama
                        line_action: line_action[0],
                        tipo_reporte: tipo_reporte[0],
                        accion_especifica: accion_especifica[0],
                        nivel_curso: $("#nivel_curso").val(),
                        modalidad_curso: $("#modalidad_curso").val(),
                        ejes_actuacion: $("#ejes_actuacion").val(),
                        tipo_certificacion: $("#tipo_certificacion").val(),
                        codigo_curso: $("#codigo_curso").val(),
                        duracion_horas: $("#duracion_horas").val(),
                        contenido_curso: $("#contenido_curso").val(),
                        descripcion_actividad: $("#descripcion_actividad").val(),
                        habilitar_descripcion: $("#habilitar_descripcion").val(),
                        habilitar_institucion: $("#habilitar_institucion").val(),
                        nombre_curso: $("#nombre_curso").val(),
                        restringir_categoria: $("#restringir_categoria").val()
                    }
                })
                .done(function(msg) {
                    // console.log(msg);
                    location.reload();
                })
                .fail(function() {
                    toastify('Hubo un error al guardar', true, 5000, "warning");
                });
            // .always(function() {
            //     toastify('Finished',true,1000,"warning");
            // });

        };

    };

    function uploadXLSX() {
        $('#cover-spin').show(0);
    }
</script>


<?php

$action_line = ActionsLineData::getAll();

?>

<div id="cover-spin"></div>



<?php if ($_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 9) { ?>

    <div class="row">
        <div class="col-md-12">
            <div class="row justify-content-center container">

                <div class="col-md-4">
                    <div class="row justify-content-center container">
                        <form action="index.php?view=import_xlsx_training_type" method="POST" enctype="multipart/form-data" />
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
                                    <span class='text_label'> <i class='fa fa-cogs icon_label'></i> <b> Agregar categoría de formación </b> </span>
                                </a>
                            </h4>
                        </div>

                        <br>

                        <form method="post" id="nueva_formación" role="form">


                            <div class="row">

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="line_action" class=" control-label"><i class="fa fa-reorder"></i> Linea de acción</label>
                                        <select name="line_action" class="form-control" id="line_action" required>
                                            <option value="">-- LINEA DE ACCIÓN --</option>
                                            <?php foreach ($action_line as $p): ?>
                                                <option value="<?php echo $p->line_name; ?>"> <?php echo $p->line_name; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="tipo_reporte" class=" control-label"><i class="fa fa-reorder"></i> Acción estratégica</label>
                                        <select name="tipo_reporte" class="form-control" id="tipo_reporte" required>
                                            <option value="">-- ACCIÓN ESTRATEGICA --</option>
                                        </select>
                                    </div>
                                    <br>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="accion_especifica" class=" control-label"><i class="fa fa-reorder"></i> Acción específica</label>
                                        <select name="accion_especifica" class="form-control" id="accion_especifica" required>
                                            <option value="">-- ACCIÓN ESPECÍFICA --</option>
                                        </select>
                                    </div>
                                    <br>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="nivel_curso" class=" control-label"><i class="fa fa-reorder"></i> Nivel del curso</label>
                                        <select name="nivel_curso" class="form-control" id="nivel_curso" required>
                                            <option value="">-SELECCIONE-</option>
                                            <option value="No aplica">No aplica</option>
                                            <option value="Básico">Básico</option>
                                            <option value="Medio">Medio</option>
                                            <option value="Avanzado">Avanzado</option>
                                        </select>
                                    </div>
                                    <br>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="modalidad_curso" class=" control-label"><i class="fa fa-reorder"></i> Modalidad del curso</label>
                                        <select name="modalidad_curso" class="form-control" id="modalidad_curso" required>
                                            <option value="">-SELECCIONE-</option>
                                            <option value="Presencial">Presencial</option>
                                            <option value="En línea">En línea</option>
                                        </select>
                                    </div>
                                    <br>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="ejes_actuacion" class=" control-label"><i class="fa fa-reorder"></i> Ejes de actuación</label>
                                        <select name="ejes_actuacion" class="form-control" id="ejes_actuacion" required>
                                            <option value="">-SELECCIONE-</option>
                                            <option value="Todos">Todos</option>
                                            <option value="Habilidades Digitales para el Trabajo, la Empleabilidad y el Emprendimiento Productivo">Habilidades Digitales para el Trabajo, la Empleabilidad y el Emprendimiento Productivo </option>
                                            <option value="Las TIC para La Vida Cotidiana">Las TIC para La Vida Cotidiana</option>
                                            <option value="Las Tic Para Personas En Situación De Vulnerabilidad Digital">Las Tic Para Personas En Situación De Vulnerabilidad Digital</option>
                                            <option value="Mujeres En Las Tic">Mujeres En Las Tic</option>
                                            <option value="Niñas, Niños Y Adolescentes En Las Tic">Niñas, Niños Y Adolescentes En Las Tic</option>
                                        </select>
                                    </div>
                                    <br>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="tipo_certificacion" class=" control-label"><i class="fa fa-reorder"></i> Tipo de certificación</label>
                                        <select name="tipo_certificacion" class="form-control" id="tipo_certificacion" required>
                                            <option value="">-SELECCIONE-</option>
                                            <option value="No aplica">No aplica</option>
                                            <option value="Participación">Participación</option>
                                            <option value="Aprobación">Aprobación</option>
                                        </select>
                                    </div>
                                    <br>
                                </div>



                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="codigo_curso" class="control-label"><i class="fa fa-cogs"></i> Código del curso</label>
                                        <input type="text" name="codigo_curso" id="codigo_curso" required class="form-control" placeholder=""></input>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="duracion_horas" class="control-label"><i class="fa fa-cogs"></i> Duración del curso</label>
                                        <input type="number" name="duracion_horas" id="duracion_horas" required class="form-control" placeholder=""></input>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="nombre_curso" class="control-label"><i class="fa fa-cogs"></i> Nombre del curso</label>
                                        <input type="text" name="nombre_curso" id="nombre_curso" required class="form-control" placeholder=""></input>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="contenido_curso" class="control-label"><i class="fa fa-cogs"></i> Contenido del curso (URL)</label>
                                        <input type="text" name="contenido_curso" id="contenido_curso" required class="form-control" placeholder=""></input>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="descripcion_actividad" class="control-label"><i class="fa fa-cogs"></i> Descripción de la actividad planificada</label>
                                        <input type="text" name="descripcion_actividad" id="descripcion_actividad" required class="form-control" placeholder=""></input>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-check" id="has_descripcion">
                                        <label class="form-check-label">
                                            <input type="checkbox" id="habilitar_descripcion" name="habilitar_descripcion" class="form-check-input" value="0">
                                            <label style="color:blueviolet;">Habilitar la edición manual de la descripción (Durante la planificación)</label>
                                            <span class="form-check-sign">
                                                <span class="check"></span>
                                            </span>
                                        </label>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-check" id="has_institucion">
                                        <label class="form-check-label">
                                            <input type="checkbox" id="habilitar_institucion" name="habilitar_institucion" class="form-check-input" value="0">
                                            <label style="color:blueviolet;">Asignar el infocentro como la institución predeterminada (Durante la planificación)</label>
                                            <span class="form-check-sign">
                                                <span class="check"></span>
                                            </span>
                                        </label>
                                    </div>
                                    <br>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="restringir_categoria" class="control-label"><i class="fa fa-cogs"></i> Habilitar la categoría solo a los infocentros marcados</label>
                                        <input type="text" name="restringir_categoria" id="restringir_categoria" class="form-control" placeholder="Todos"></input>
                                        <span><label style="color:blueviolet;"> Ésta categoría solo será visible a éstos códigos. Escriba los códigos separarados por comas. (En blanco se muestra a todos)</label></span>
                                    </div>
                                    <br>
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




    <!-- Obtengo los datos para la paginacion -->
    <?php
    $CantidadMostrar = 50;
    $url_pag_atras = "";
    $url_pag_adelante = "";

    // Validado  la variable GET
    $compag = (int)(!isset($_GET['pag'])) ? 1 : $_GET['pag'];

    // $total = TrainingTypeData::getBySQL("SELECT * from training_type");
    // $TotalReg = count($total);

    // $sql = "SELECT * from training_type order by id desc LIMIT " . (($compag - 1) * $CantidadMostrar) . " , " . $CantidadMostrar;
    // $param = TrainingTypeData::getBySQL($sql);


    // pg
    $total = TrainingTypeData::getAllPg("SELECT * from training_type order by id desc");
    $TotalReg = $total[1];

    $sql = "SELECT * from training_type order by id desc";

    $param_csv = mb_convert_encoding($sql, 'UTF-8', 'UTF-8');
    // $param_sql = mb_convert_encoding($sql, 'UTF-8', 'UTF-8');
    $DB_name = "training_type";

    $sql .= " LIMIT " . $CantidadMostrar . " OFFSET " . (($compag - 1) * $CantidadMostrar);
    $param = TrainingTypeData::getObj($sql);

    $url_pag = "<a href=\"?view=training_type&pag=";

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
                            <br>

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
                                                <!-- <th>Línea de acción</th> -->
                                                <!-- <th>Acción estratégica</th> -->
                                                <th>Acción específica</th>
                                                <th>Categoría de formación</th>
                                                <th>Duración</th>
                                                <th>Nivel</th>
                                                <th>Modalidad</th>
                                                <th>Ejes_act</th>
                                                <th>Certificación</th>
                                                <th>Contenido</th>
                                                <th>Descripción actividad</th>
                                                <th>Habilitar descripción</th>
                                                <th>Activar infocentro como inst.</th>
                                                <th>Código</th>
                                                <th>Permisos</th>
                                                <th>Acciones</th>
                                            </thead>

                                            <?php foreach ($param as $user) { ?>
                                                <tr>
                                                    <!-- <td><!?php echo $user->name_line_action; ?></td> -->
                                                    <!-- <td><!?php echo $user->name_strategic_action; ?></td> -->
                                                    <td><?php echo $user->name_specific_action; ?></td>
                                                    <td><?php echo $user->name_training_type; ?></td>
                                                    <td><?php echo $user->duracion_horas; ?></td>
                                                    <td><?php echo $user->nivel_curso; ?></td>
                                                    <td><?php echo $user->modalidad_curso; ?></td>
                                                    <td><?php echo $user->ejes_actuacion; ?></td>
                                                    <td><?php echo $user->tipo_certificacion; ?></td>
                                                    <td><?php echo $user->contenido_curso; ?></td>
                                                    <td><?php echo $user->descripcion_actividad; ?></td>
                                                    <td><?php echo $user->habilitar_descripcion; ?></td>
                                                    <td><?php echo $user->habilitar_institucion; ?></td>
                                                    <td><?php echo $user->codigo_curso; ?></td>
                                                    <td style="font-size:10px;"><?php echo $user->restringir_categoria; ?></td>
                                                    <td style="width:180px;">
                                                        <a href="./?view=edit_training_type&id=<?php echo $user->id; ?>" class="btn btn-warning btn-sm"><i class="material-icons">edit</i></a>
                                                        <!-- <a href="./?action=ajax&function=del_training_type&id=<!?php echo $user->id; ?>" class="btn btn-danger btn-sm"><i class="material-icons">close</i></a> -->

                                                        <?php $URL = "./?action=ajax&function=del_training_type&id=" . $user->id; ?>
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

            $("#has_descripcion").change(function() {
                var checkbox = $("#habilitar_descripcion").is(":checked");
                if (checkbox == true) {
                    document.getElementById("habilitar_descripcion").value = "1";
                } else {
                    document.getElementById("habilitar_descripcion").value = "0";
                }
            });
            $("#has_institucion").change(function() {
                var checkbox = $("#habilitar_institucion").is(":checked");
                if (checkbox == true) {
                    document.getElementById("habilitar_institucion").value = "1";
                } else {
                    document.getElementById("habilitar_institucion").value = "0";
                }
            });


            $("#line_action").change(function() {
                $('#tipo_reporte').find('option').remove().end().append('<option value=""></option>').val('0');
                $("#line_action option:selected").each(function() {
                    line = $(this).val();
                    // console.log($("#tipo_reporte").val());
                    $.post("core/app/view/get_strategic_action.php", {
                        line: line
                    }, function(data) {
                        // console.log(data);
                        $("#tipo_reporte").html(data);
                        // console.log(data);
                    });

                });
            })

            $("#tipo_reporte").change(function() {
                $('#accion_especifica').find('option').remove().end().append('<option value=""></option>').val('0');
                $("#tipo_reporte option:selected").each(function() {
                    line_acc = $(this).val();
                    line_acc_n = line_acc.split(",");
                    // console.log(line_acc_n[0]);
                    // console.log($("#accion_especifica").val());
                    $.post("core/app/view/get_specific_action_datos.php", {
                        line_acc: line_acc_n[0]
                    }, function(data) {
                        // console.log(data);
                        // var array = JSON.parse(data);
                        $("#accion_especifica").html(data);
                    });

                });
            })

            // $("#accion_especifica").change(function () {
            //     $('#area_formativa').find('option').remove().end().append('<option value=""></option>').val('0');
            //     $("#accion_especifica option:selected").each(function () {
            //         line_acc = $(this).val();
            //         // console.log($("#area_formativa").val());
            //         $.post("core/app/view/get_training_type.php", { line_acc: line_acc }, function(data){
            //             $("#area_formativa").html(data);
            //             // console.log(data);
            //         });  

            //     });
            // })

            // $("#area_formativa").change(function () {
            //     $('#nivel_formacion').find('option').remove().end().append('<option value=""></option>').val('0');
            //     $("#area_formativa option:selected").each(function () {
            //         line_acc = $(this).val();
            //         // console.log($("#nivel_formacion").val());
            //         $.post("core/app/view/get_level_training.php", { line_acc: line_acc }, function(data){
            //             $("#nivel_formacion").html(data);
            //             // console.log(data);
            //         });  

            //     });
            // })



        });
    </script>