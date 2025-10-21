<?php
$id = $_GET['id'];
$action_line = ActionsLineData::getAll();
$action = SpecificActionData::getByIdPg($id);

?>

<script language="javascript">
    $(document).ready(function() {
        $('#add_submit').click(function(event) {
            event.preventDefault();

            if ($("#tipo_reporte").val() != "" && $("#accion_especifica").val() != "") { // valida la informacion

                var line = $("#line_action").val().split(",");
                var tipo_reporte = $("#tipo_reporte").val().split(",");

                $.ajax({
                        type: "POST",
                        url: "./?action=ajax",
                        data: {
                            id: "<?php echo $id; ?>", // funcion que llama
                            function: "edit_accion_especifica", // funcion que llama
                            line_action: line[0],
                            tipo_reporte: tipo_reporte[0],
                            strategic_action_id: tipo_reporte[1],
                            accion_especifica: $("#accion_especifica").val(),
                            descripcion_actividad: $("#descripcion_actividad").val(),
                            has_formation: $("#has_formation").val(),
                            permisos: $("#permisos").val()
                        }
                    })
                    .done(function(msg) {
                        console.log(msg);
                        toastify('Guardado con éxito', true, 2000, "dashboard");
                        // location.reload();
                        // $('#content').reload('#content');

                    })
                    .fail(function() {
                        toastify('Hubo un error al guardar', true, 5000, "warning");
                    });
                // .always(function() {
                //     toastify('Finished',true,1000,"warning");
                // });




            };

        });



    });
</script>






<div class="content" id="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">

                        <div class="panel-heading">
                            <h4 class="title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                                    <span class='text_label'> <i class='fa fa-cogs icon_label'></i> <b> Acciones específicas de las líneas de acción </b> </span>
                                </a>
                            </h4>
                        </div>

                        <br>

                        <form method="post" id="add_strategic" role="form">
                            <input type="hidden" name="k_strategic" id="k_strategic" value="<?php echo $action->k_strategic; ?>"></input>


                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="line_action" class=" control-label"><i class="fa fa-cogs"></i> Linea de acción</label>
                                        <select name="line_action" class="form-control" id="line_action" required>
                                            <option value="<?php echo $action->name_line_action; ?>"><?php echo $action->name_line_action; ?></option>
                                            <?php foreach ($action_line as $p): ?>
                                                <option value="<?php echo $p->line_name . ',' . $p->line_id; ?>"> <?php echo $p->line_name; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="tipo_reporte" class=" control-label"><i class="fa fa-reorder"></i> Acción estratégica</label>
                                        <select name="tipo_reporte" class="form-control" id="tipo_reporte" required>
                                            <option value="<?php echo $action->name_strategic.','.$action->k_strategic; ?>"><?php echo $action->name_strategic; ?></option>
                                        </select>
                                    </div>
                                    <br>
                                </div>



                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="has_formation" class=" control-label"><i class="fa fa-reorder"></i> ¿Tiene formaciones?</label>
                                        <select name="has_formation" class="form-control" id="has_formation" required>
                                            <option value="<?php echo $action->has_formation; ?>"><?php echo $action->has_formation; ?></option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    <br>
                                </div>


                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="descripcion_actividad" class=" control-label"><i class="fa fa-reorder"></i> Descripción de actividad planificada</label>
                                        <input type="text" name="descripcion_actividad" value="<?php echo $action->activity_description; ?>" id="descripcion_actividad" required class="form-control" placeholder="Descripción"></input>
                                        <span><label style="color:blueviolet;"> La descripción no aplica para Formación en TIC (Dejar vacío)</label></span>
                                    </div>
                                    <br>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="accion_especifica" class="control-label"><i class="fa fa-cogs"></i> Nombre de acción específica</label>
                                        <input type="text" name="accion_especifica" value="<?php echo $action->name_specific_action; ?>" id="accion_especifica" required class="form-control" placeholder="Descripción"></input>
                                    </div>
                                    <br>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="permisos" class="control-label"><i class="fa fa-cogs"></i> Habilitar solo a los infocentros marcados</label>
                                        <input type="text" name="permisos" id="permisos" value="<?php echo $action->permisos; ?>" class="form-control" placeholder="AMA01, AMA02"></input>
                                        <span><label style="color:blueviolet;"> Ésta categoría solo será visible a éstos códigos. Escriba los códigos separarados por comas. (En blanco se muestra a todos)</label></span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <button type="button" onclick="history.back()" class="btn btn-default btn-block">Volver</button>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <button type="submitx" name="" id="add_submit" class="btn btn-primary btn-block">Guardar</button>
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





<script language="javascript">
    // carga nuevas dimensiones
    $(document).ready(function() {

        $("#line_action").change(function() {
            $('#tipo_reporte').find('option').remove().end().append('<option value=""></option>').val('0');
            $("#line_action option:selected").each(function() {
                line = $(this).val();
                line = $("#line_action").val().split(",")[0];
                // console.log($("#tipo_reporte").val());
                $.post("core/app/view/get_strategic_action.php", {
                    line: line
                }, function(data) {
                    // console.log(data);
                    $("#tipo_reporte").html(data);
                });

            });
        })

    });
</script>