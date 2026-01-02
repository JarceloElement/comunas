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





    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("nueva_formación").addEventListener('submit', validarFormulario);
    });

    function validarFormulario(event) {
        event.preventDefault();

        // console.log($("#habilitar_descripcion").val());

        $('#cover-spin').show(0);

        var tipo_reporte = $("#tipo_reporte").val().split(",");
        var line_action = $("#line_action").val().split(",");
        var accion_especifica = $("#accion_especifica").val().split(",");
        if ($("#nombre_curso").val() != "" && $("#accion_especifica").val() != "") {

            $.ajax({
                    type: "POST",
                    url: "./?action=ajax",
                    // headers: {
                    //     "X-CSRFToken": getCookie("csrftoken")
                    // },
                    data: {
                        function: "update_tipo_formacion", // funcion que llama
                        id: $("#id").val(),
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
                    console.log(msg);
                    // toastify('Guardado', true, 1000, "dashboard");
                    document.location = 'index.php?view=training_type';
                    // $('#content').reload('#content');

                })
                .fail(function() {
                    toastify('Hubo un error al guardar', true, 5000, "warning");
                });
            // .always(function() {
            //     toastify('Finished',true,1000,"warning");
            // });




        };

    };
</script>


<?php
$id = $_GET["id"];
$action_line = ActionsLineData::getAll();
$data = TrainingTypeData::getByIdPg($id);
// print_r($data);
?>


<div id="cover-spin"></div>


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
                                    <span class='text_label'> <i class='fa fa-cogs icon_label'></i> <b> Editar categoría de formación </b> </span>
                                </a>
                            </h4>
                        </div>

                        <br>

                        <form method="post" id="nueva_formación" role="form">
                            <input type="hidden" name="id" id="id" value="<?php echo $data->id; ?>"></input>

                            <div class="row">

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="line_action" class=" control-label"><i class="fa fa-reorder"></i> Linea de acción</label>
                                        <select name="line_action" class="form-control" id="line_action" required>
                                            <option value="<?php echo $data->name_line_action; ?>"><?php echo $data->name_line_action; ?></option>
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
                                            <option value="<?php echo $data->name_strategic_action; ?>"><?php echo $data->name_strategic_action; ?></option>
                                        </select>
                                    </div>
                                    <br>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="accion_especifica" class=" control-label"><i class="fa fa-reorder"></i> Acción específica</label>
                                        <select name="accion_especifica" class="form-control" id="accion_especifica" required>
                                            <option value="<?php echo $data->name_specific_action; ?>"><?php echo $data->name_specific_action; ?></option>
                                        </select>
                                    </div>
                                    <br>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="nivel_curso" class=" control-label"><i class="fa fa-reorder"></i> Nivel del curso</label>
                                        <select name="nivel_curso" class="form-control" id="nivel_curso" required>
                                            <option value="<?php echo $data->nivel_curso; ?>"><?php echo $data->nivel_curso; ?></option>
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
                                            <option value="<?php echo $data->modalidad_curso; ?>"><?php echo $data->modalidad_curso; ?></option>
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
                                            <option value="<?php echo $data->ejes_actuacion; ?>"><?php echo $data->ejes_actuacion; ?></option>
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
                                            <option value="<?php echo $data->tipo_certificacion; ?>"><?php echo $data->tipo_certificacion; ?></option>
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
                                        <input type="text" name="codigo_curso" id="codigo_curso" value="<?php echo $data->codigo_curso; ?>" class="form-control" placeholder=""></input>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="duracion_horas" class="control-label"><i class="fa fa-cogs"></i> Duración del curso</label>
                                        <input type="number" name="duracion_horas" id="duracion_horas" value="<?php echo $data->duracion_horas; ?>" required class="form-control" placeholder=""></input>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="nombre_curso" class="control-label"><i class="fa fa-cogs"></i> Nombre del curso</label>
                                        <input type="text" name="nombre_curso" id="nombre_curso" value="<?php echo $data->name_training_type; ?>" required class="form-control" placeholder=""></input>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="contenido_curso" class="control-label"><i class="fa fa-cogs"></i> Contenido del curso (URL)</label>
                                        <input type="text" name="contenido_curso" id="contenido_curso" value="<?php echo $data->contenido_curso; ?>" required class="form-control" placeholder=""></input>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="descripcion_actividad" class="control-label"><i class="fa fa-cogs"></i> Descripción de la actividad planificada</label>
                                        <input type="text" name="descripcion_actividad" id="descripcion_actividad" value="<?php echo $data->descripcion_actividad; ?>" required class="form-control" placeholder=""></input>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="col-md-12 form-check" id="has_descripcion">
                                        <label class="form-check-label">
                                            <input type="checkbox" id="habilitar_descripcion" name="habilitar_descripcion" class="form-check-input" value="<?php echo $data->habilitar_descripcion; ?>" <?php if ($data->habilitar_descripcion == 1) {
                                                                                                                                                                                                            echo "checked";
                                                                                                                                                                                                        } ?>>
                                            <label for="habilitar_descripcion" style="color:blueviolet;">Habilitar la edición manual de la descripción (Durante la planificación)</label>
                                            <span class="form-check-sign">
                                                <span class="check"></span>
                                            </span>
                                        </label>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="col-md-12 form-check" id="has_institucion">
                                        <label class="form-check-label">
                                            <input type="checkbox" id="habilitar_institucion" name="habilitar_institucion" class="form-check-input" value="<?php echo $data->habilitar_institucion; ?>" <?php if ($data->habilitar_institucion == 1) {
                                                                                                                                                                                                            echo "checked";
                                                                                                                                                                                                        } ?>>
                                            <label for="habilitar_institucion" style="color:blueviolet;">Asignar el infocentro como la institución predeterminada (Durante la planificación)</label>
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
                                        <input type="text" name="restringir_categoria" id="restringir_categoria" value="<?php echo $data->restringir_categoria; ?>" class="form-control" placeholder="Todos"></input>
                                        <span><label style="color:blueviolet;"> Ésta categoría solo será visible a éstos códigos. Escriba los códigos separarados por comas. (En blanco se muestra a todos)</label></span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block">Guardar</button>
                                    </div>
                                </div>
                            </div>
                        </form>

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
                    console.log($("#tipo_reporte").val());
                    $.post("core/app/view/get_strategic_action.php", {
                        line: line
                    }, function(data) {
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
                    $.post("core/app/view/get_specific_action_datos.php", {
                        line_acc: line_acc_n[0]
                    }, function(data) {
                        $("#accion_especifica").html(data);
                        // console.log(data);
                    });

                });
            })


        });
    </script>