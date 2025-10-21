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
                    function: "edit_tipo_taller", // funcion que llama
                    id: $("#id").val(),
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
                toastify('Guardado', true, 1000, "dashboard");
                document.location='index.php?view=tipo_taller_view';
                // $('#content').reload('#content');

            })
            .fail(function() {
                toastify('Hubo un error al guardar', true, 5000, "warning");
            });
        // .always(function() {
        //     toastify('Finished',true,1000,"warning");
        // });

    };
</script>


<?php
$id = $_GET["id"];
$training_type = TrainingTypeData::getAll();
$data = TipoTallerData::getByIdPg($id);
?>



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
                                    <span class='text_label'> <i class='fa fa-cogs icon_label'></i> <b> Editar taller </b> </span>
                                </a>
                            </h4>
                        </div>

                        <br>

                        <form method="post" id="add_tipo_taller" role="form">
                            <input type="hidden" name="id" id="id" value="<?php echo $data->id; ?>"></input>


                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="line_action" class=" control-label"><i class="fa fa-cogs"></i> Categoría de formación</label>
                                        <select name="line_action" class="form-control" id="line_action" required>
                                            <option value="<?php echo $data->name_training_type; ?>"><?php echo $data->name_training_type; ?></option>
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
                                            <option value="<?php echo $data->nivel; ?>"><?php echo $data->nivel; ?></option>
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
                                            <option value="<?php echo $data->modalidad; ?>"><?php echo $data->modalidad; ?></option>
                                            <option value="Presencial">Presencial</option>
                                            <option value="En línea">En línea</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="nombre_taller" class="control-label"><i class="fa fa-cogs"></i> Nombre del taller</label>
                                        <input type="text" name="nombre_taller" id="nombre_taller" value="<?php echo $data->nombre_taller; ?>" class="form-control" placeholder="AMA01, AMA02"></input>
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="descripcion_taller" class="control-label"><i class="fa fa-cogs"></i> Descripción del taller</label>
                                        <input type="text" name="descripcion_taller" id="descripcion_taller"  value="<?php echo $data->descripcion_taller; ?>" class="form-control" placeholder="Descripción"></input>
                                        <span><label style="color:blueviolet;"> Si se deja vacío se tomará la descripción del curso</label></span>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="duracion_horas" class="control-label"><i class="fa fa-cogs"></i> Duración (Horas)</label>
                                        <input type="number" name="duracion_horas" id="duracion_horas" value="<?php echo $data->duracion_horas; ?>" class="form-control" placeholder="AMA01, AMA02"></input>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="permisos" class="control-label"><i class="fa fa-cogs"></i> Habilitar solo a los infocentros marcados</label>
                                        <input type="text" name="permisos" id="permisos" value="<?php echo $data->permisos; ?>" class="form-control" placeholder="AMA01, AMA02"></input>
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