<?php

$action_line = ActionsLineData::getAll();
$estado = EstadoData::getAll();
$municipio = MunicipioData::getAll();
$ciudad = CiudadData::getAll();
$parroquia = ParroquiaData::getAll();

// $activity = ReportActivityData::getById($_GET["id"]);
$activity = ReportActivityData::getByIdPg($_GET["id"]);
$responsible_type = ResponsibleTypeData::getAll();
// $info = InfoData::getById($_GET["id"]);
$info = InfoData::getByCode($_GET["code_info"]);


// $con = Database::getCon();
// $query = $con->query("select * from report_date_limit");
// $res = mysqli_fetch_array($query);


// $fecha_ini = $res['date_limit_ini'];
// $fecha_end = $res['date_limit_end'];

if ($activity["image"] != "") {
    $image = explode(", ", $activity["image"]);
}

?>



<!-- MODAL SWEET ALERT -->
<script>
    $(function() {
        <?php if (isset($_GET['swal']) && $_GET['swal'] != ""): ?>
            Swal.fire({
                // position: 'top-center',
                icon: 'warning',
                title: '<?php echo $_GET['swal']; ?>',
                showConfirmButton: true,
                // timer: 1500
            })
        <?php endif; ?>

    });


    $(document).ready(function() {



        // contar caracteres restantes
        var maxLength = 80;

        function textLength(value) {
            var total = value.length;
            var restante = maxLength - total;
            document.getElementById('textLength').innerHTML = 'Describa de manera resumida solo la descripción. Restan ' + restante + ' carácteres.';

            if (value.length > maxLength) return false;
            return true;
        }

        document.getElementById('nombre_act').onkeyup = function() {
            if (!textLength(this.value))
                toastify('Has llegado al límite de carácteres', true, 1500, "warning");

        }

        
        var area = $("#area_formativa").val();
        var tipo_taller_f = $("#tipo_taller").val();

        if (area != "") {
            $("#area_formativa_f").show();
        }
        if (tipo_taller_f != "") {
            $("#tipo_taller_f").show();
        }

    })


    // VALIDAR FORMULARIO
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("activity").addEventListener('submit', validarFormulario);
    });

    function validarFormulario(evento) {
        evento.preventDefault();
        mensaje = document.getElementById("nombre_act").value;
        var result = checkType(mensaje);

        if (result == '0') {
            // primera minusculas
            if (getOS() == "Android") {
                alert("ERROR: Por favor revisa la ortografía, la primera letra debe estar en mayúscula.");
            } else {
                toastify("ERROR: Por favor revisa la ortografía, la primera letra debe estar en mayúscula.", true, 20000, "error"); // [message, autohide]
            }
            document.getElementById("nombre_act").focus();
            return;
        } else if (result == '1') {
            // todo minusculas
            if (getOS() == "Android") {
                alert("ERROR: Por favor revisa la ortografía, no debe estar todo en minúscula.");
            } else {
                toastify("ERROR: Por favor revisa la ortografía, no debe estar todo en minúscula.", true, 20000, "error"); // [message, autohide]
            }
            document.getElementById("nombre_act").focus();
            return;
        } else if (result == '2') {
            // mayusculas
            if (getOS() == "Android") {
                alert("ERROR: Por favor revisa la ortografía, no debe estar todo en mayúsculas.");
            } else {
                toastify("ERROR: Por favor revisa la ortografía, no debe estar todo en mayúsculas.", true, 20000, "error"); // [message, autohide]
            }
            document.getElementById("nombre_act").focus();
            return;

        } else {
            // console.log('El mensaje no incluye letras');
        }


        // if (mobile) {
        // 	alert("El recaptcha es requerido");              
        // } else {
        // 	toastify("El recaptcha es requerido",true,10000,"warning"); // [message, autohide]
        // }
        // return;
        $('#cover-spin').show(0);

        this.submit();

    }
</script>


<div id="cover-spin"></div>



<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header card-header-primary">
                        <h4 class="title">Editar actividad</h4>
                    </div>
                    <!-- <!?php echo $_SESSION["location"]; ?> -->

                    <br>
                    <div class="card-body">
                        <h5 class="title"> <i class='fa fa-bullhorn icon_label'></i> NOTA: Toda la información debe ser cargada respetando la ortografía, eso incluye el uso de mayúsculas.</h5>
                        <br>

                        <form id="activity" class="form-horizontal" role="form" method="post" action="./?action=updatereport&pag=<?php echo $_GET["pag"] ?>" enctype="multipart/form-data">
                            <input class="form-control" style="display:none" name="id" value="<?php echo $activity["id"]; ?>"></input>
                            <input type="hidden" name="user_id" id="user_id" value="<?php echo $_GET["user_id"]; ?>">
                            <input type="hidden" name="id_act" id="id_act" value="<?php echo $_GET["id_act"]; ?>">
                            <input type="hidden" name="estado" id="estados_1" value="<?php echo $info->estado; ?>">
                            <input type="hidden" name="municipio" id="municipios_1" value="<?php echo $info->municipio; ?>">
                            <input type="hidden" name="parroquia" id="parroquias_1" value="<?php echo $info->parroquia; ?>">
                            <input type="hidden" name="ciudad" id="ciudades" value="<?php echo $info->ciudad; ?>">
                            <input type="hidden" name="responsible_dni" id="responsible_dni" value="<?php echo $activity["responsible_dni"]; ?>">
                            <!-- <input type="hidden" name="fecha_limite_inicio" id="fecha_limite_inicio" value="<!?php echo $fecha_ini ?>"> -->
                            <!-- <input type="hidden" name="fecha_limite_final" id="fecha_limite_final" value="<!?php echo $fecha_end ?>"> -->
                            <input type="hidden" name="contenido_des" id="contenido_des" value="No aplica">
                            <input type="hidden" name="modalidad_formacion" id="modalidad_formacion" value="No aplica">
                            <input type="hidden" name="duracion_horas" id="duracion_horas" value="">
                            <input type="hidden" name="nivel_formacion" id="nivel_formacion" value="No aplica">


                            <div class="form-row">
                                <!-- breadcrumb -->
                                <div class="col-lg-12">
                                    <ol class="breadcrumb">
                                        <span class="text-primary mr-1" style="font-size: 22px;"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M4 20q-.825 0-1.412-.587T2 18V6q0-.825.588-1.412T4 4h16q.825 0 1.413.588T22 6v12q0 .825-.587 1.413T20 20zm2-4h8v-2H6zm10 0h2v-2h-2zM6 12h2v-2H6zm4 0h8v-2h-8z"/></svg></span>
                                        <li class="breadcrumb-item active" aria-current="page" style="font-size: 20px;">Descripción de la actividad</li>
                                    </ol>
                                </div>

                                <!-- estatus -->
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="status_activity" class=" control-label"><i class="fa fa-warning"></i> Estatus</label>
                                        <select name="status_activity" class="form-control" id="status_activity">
                                            <option value="<?php echo $activity["status_activity"]; ?>"><?php echo $activity["status_activity"] == 0 ? "Planificada" : ($activity["status_activity"] == 1 ? "Ejecutada" : "No ejecutada"); ?></option>
                                            <option value="0"> Planificada </option>
                                            <option value="1"> Ejecutada </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="code_info" class=" control-label"><i class="fa fa-building"></i> Código infocentro</label>
                                        <textarea type="text" class="form-control" name="code_info" placeholder="Nombre" id="code_info" required><?php echo $activity["code_info"]; ?></textarea>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="direccion" class=" control-label"><i class="fa fa-map-marker"></i> Dirección de la actividad</label>
                                        <textarea type="text" class="form-control" name="direccion" placeholder="Dirección" id="direccion" required><?php echo $activity["address"]; ?></textarea>
                                        <span><label style="color:blueviolet;">Aquí se describe la ubicación de la actividad (Si aplica).</label></span>
                                        </div>
                                </div>

                                <!-- nombre de la actividad -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="nombre_act" class=" control-label"><i class="fa fa-newspaper-o"></i> Descripción de la actividad</label>
                                        <textarea type="text" class="form-control" name="nombre_act" placeholder="Nombre" id="nombre_act" maxlength="80" required><?php echo $activity["activity_title"]; ?></textarea>
                                        <span><label style="color:blueviolet;" id="textLength">Describa de manera resumida solo la descripción. Max 80 carácteres.</label></span>
                                        </div>
                                </div>


                                <!-- breadcrumb -->
                                <div class="col-lg-12">
                                    <ol class="breadcrumb">
                                        <span class="material-symbols-outlined text-primary mr-1" style="font-size: 22px;">settings_b_roll</span>
                                        <li class="breadcrumb-item active" aria-current="page" style="font-size: 20px;">Dimensiones</li>
                                    </ol>
                                </div>


                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="linea_accion" class=" control-label"><i class="fa fa-cogs"></i> Linea de acción</label>
                                        <select name="linea_accion" class="form-control" id="linea_accion" required>
                                            <option value="<?php echo $activity["line_action"]; ?>"><?php echo $activity["line_action"]; ?></option>
                                            <?php foreach ($action_line as $p): ?>
                                                <option value="<?php echo $p->line_name; ?>"> <?php echo $p->line_name; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="tipo_reporte" class=" control-label"><i class="fa fa-reorder"></i> Acción estratégica</label>
                                        <select name="tipo_reporte" class="form-control" id="tipo_reporte" required>
                                            <option value="<?php echo $activity["report_type"]; ?>"><?php echo $activity["report_type"]; ?></option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="accion_especifica" class=" control-label"><i class="fa fa-reorder"></i> Acción específica</label>
                                        <select name="accion_especifica" class="form-control" id="accion_especifica" required>
                                            <option value="<?php echo $activity["specific_action"]; ?>"><?php echo $activity["specific_action"]; ?></option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6" id="area_formativa_f" style="display: none;">
                                    <div class="form-group">
                                        <label for="area_formativa" class=" control-label"><i class="fa fa-graduation-cap"></i> Área formativa</label>
                                        <select name="area_formativa" class="form-control" id="area_formativa">
                                            <option value="<?php echo $activity["training_type"]; ?>"><?php echo $activity["training_type"]; ?></option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6" id="tipo_taller_f" style="display: none;">
                                    <div class="form-group">
                                        <label for="tipo_taller" class=" control-label"><i class="fa fa-graduation-cap"></i> Tipo de taller</label>
                                        <select name="tipo_taller" class="form-control" id="tipo_taller">
                                            <option value="<?php echo $activity["tipo_taller"]; ?>"><?php echo $activity["tipo_taller"]; ?></option>
                                        </select>
                                    </div>
                                </div>

                                <!-- <div class="col-lg-6" id="nivel_formacion_f" style="display: none;">
                                    <div class="form-group">
                                    <label for="nivel_formacion" class=" control-label"><i class="fa fa-graduation-cap"></i> Nivel formativo</label>
                                    <select name="nivel_formacion" class="form-control" id="nivel_formacion">
                                        <option value="<!?php echo $activity["training_level"];?>"><?php echo $activity["training_level"]; ?></option>
                                    </select>
                                    </div>
                                <br>
                                </div> -->


                                <!-- <div class="col-lg-4">
                                    <div class="form-group">
                                    <label for="fecha" class=" control-label"><i class="fa fa-calendar"></i> Fecha</label>
                                    <input type="date" name="fecha" value="<!?php echo $activity->date_pub;?>" class="form-control" id="fecha" placeholder="Fecha">
                                    </div>
                                </div> -->




                                <!-- FORMACION A LA MEDIDA -->
                                <!-- contenido desarrollado -->
                                <!-- <div class="col-md-12">
                                    <div style="display: none" class="form-group" id="contenido">
                                        <label for="contenido_des" class=" control-label"><i class="fa fa-flask"></i> Contenido desarrollado</label>
                                        <textarea name="contenido_des" class="form-control" id="fecha" placeholder=""><?php echo $activity["developed_content"]; ?></textarea>
                                    </div>
                                </div> -->


                                <!-- modalida formacion -->
                                <!-- <div class="col-lg-4">
                                    <div style="display: none" class="form-group" id="modalidad">
                                        <label for="modalidad_formacion" class=" control-label"><i class="fa fa-slides"></i> Modalidad formación</label>
                                        <select name="modalidad_formacion" class="form-control" id="modalidad_formacion" >
                                            <option value="<!?php echo $activity["training_modality"];?>"><!?php echo $activity["training_modality"];?></option>
                                            <option value="Presencial"> Presencial </option>
                                            <option value="Distancia"> Distancia </option>
                                        </select>
                                    </div>
                                </div> -->


                                <!-- duracion act -->
                                <div class="col-md-12">
                                    <div style="display: none" class="form-group" id="div_duracion_dias">
                                        <label for="duracion_dias" class=" control-label"><i class="fa fa-hourglass-half"></i> Duración días</label>
                                        <input type="number" class="form-control" value="<?php echo $activity["duration_days"]; ?>" name="duracion_dias" placeholder="Días" id="duracion_dias">
                                        <p class="help-block" style="color:gray;">Días impartiendo formación</p>
                                    </div>
                                </div>
                                <!-- <div class="col-md-4">
                                    <div style="display: none" class="form-group" id="div_duracion_horas">
                                        <label for="duracion_horas" class=" control-label"><i class="fa fa-hourglass-half"></i> Duración horas</label>
                                        <input type="number" class="form-control" value="<!?php echo $activity["duration_hour"];?>" name="duracion_horas" placeholder="Horas" id="duracion_horas">
                                        <p class="help-block" style="color:gray;">Horas académicas certificadas</p>
                                    </div>
                                </div> -->



                                <!-- breadcrumb -->
                                <div class="col-lg-12">
                                    <ol class="breadcrumb">
                                        <span class="material-symbols-outlined text-primary mr-1" style="font-size: 24px;">data_loss_prevention</span>
                                        <li class="breadcrumb-item active" aria-current="page" style="font-size:20px;">Responsable de la actividad</li>
                                    </ol>
                                </div>

                                <!-- responsible_type -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="responsable_tipo" class=" control-label"><i class="fa fa-user-plus"></i> Tipo responsable</label>
                                        <select name="responsable_tipo" class="form-control" id="responsable_tipo" required>
                                            <option value="<?php echo $activity["responsible_type"]; ?>"><?php echo $activity["responsible_type"]; ?></option>
                                            <?php foreach ($responsible_type as $p): ?>
                                                <option value="<?php echo $p->name; ?>"> <?php echo $p->name; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>



                                <!-- <div class="col-md-3" id="buscar_responsable">
                                    <div class="form-group" id="buscar_responsable">
                                        <label for="buscar_responsable" class=" control-label"><i class="fa fa-search"></i> Buscar responsable</label>
                                        <input class="form-control" name="buscar_responsable" placeholder="Nombre o cédula" id="b_responsable"></input>
                                    </div>
                                </div> -->


                                <div class="col-md-4">
                                    <br>
                                    <div class="form-group">
                                        <label for="responsable_name" class=" control-label"><i class="fa fa-user"></i> Buscar Responsable</label>

                                    <div class="input-group">
                                        <input type="text" class="form-control" name="buscar_responsable" placeholder="Nombre o cédula" id="b_responsable">
                                        <span class="input-group-btn">
                                            <button type="button" onclick="codigoAJAX()" class="btn btn-fab btn-round btn-primary">
                                            <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="m19.6 21l-6.3-6.3q-.75.6-1.725.95T9.5 16q-2.725 0-4.612-1.888T3 9.5t1.888-4.612T9.5 3t4.613 1.888T16 9.5q0 1.1-.35 2.075T14.7 13.3l6.3 6.3zM9.5 14q1.875 0 3.188-1.312T14 9.5t-1.312-3.187T9.5 5T6.313 6.313T5 9.5t1.313 3.188T9.5 14"/></svg></i>
                                            </button>
                                        </span>
                                    </div>
                                    </div>

                                </div>

                                <!-- name_responsable -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="responsable_name" class=" control-label"><i class="fa fa-user"></i> Responsable</label>
                                        <input class="form-control" name="responsable_name" placeholder="Nombre" id="responsable_name" value="<?php echo $activity["responsible_name"]; ?>" required></input>
                                    </div>
                                </div>


                                <!-- tel_responsable -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="responsable_tel" class=" control-label"><i class="fa fa-phone"></i> Teléfono</label>
                                        <input type="tel" class="form-control" name="responsable_tel" value="<?php echo $activity["responsible_phone"]; ?>" placeholder="Teléfono" id="responsable_tel" required></input>
                                    </div>
                                </div>


                                <!-- correo_responsable -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="responsible_email" class=" control-label"><i class="fa fa-envelope"></i> Correo</label>
                                        <input type="email" class="form-control" name="responsible_email" value="<?php echo $activity["responsible_email"]; ?>" placeholder="Correo" id="responsible_email" required>
                                    </div>
                                </div>






                                <!-- <div class="col-lg-6">
                                    <div class="form-group">
                                    <label for="mujeres" class=" control-label"><i class="fa fa-female"></i> Participantes mujeres</label>
                                    <input type="number" class="form-control" name="mujeres" value="<?php echo $activity["person_fe"]; ?>" placeholder="N° mujeres" id="mujeres" required></input>
                                    </div>
                                </div> -->


                                <!-- <div class="col-lg-6">
                                    <div class="form-group">
                                    <label for="hombres" class=" control-label"><i class="fa fa-male"></i> Participantes hombres</label>
                                    <input type="number" class="form-control" name="hombres" value="<?php echo $activity["person_ma"]; ?>" placeholder="N° hombres" id="hombres" required></input>
                                    </div>
                                </div> -->


                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="instituciones" class=" control-label"><i class="fa fa-building"></i> Instituciones presentes</label>
                                        <input class="form-control" name="instituciones" value="<?php echo $activity["institutions"]; ?>" placeholder="Nombres" id="instituciones" required></input>
                                    </div>
                                </div>




                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="observacion" class=" control-label"><i class="fa fa-warning"></i> Observación</label>
                                        <input class="form-control" name="observacion" value="<?php echo $activity["observations"]; ?>" placeholder="Nota" id="observacion"></input>
                                    </div>
                                </div>



                                <!-- FILE lista de participantes -->
                                <!-- <div class="col-lg-11">
                                    <div class="row">
                                        <div class="form-group">
                                        <i class="fa fa-file icon_label"></i> <td>Archivo adjunto</td>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group">
                                            <td><input type="file" name="file" id="file" accept="file/*"></td>
                                            <div class="form-group" id="uploadForm_file" > 
                                            </div>
                                        </div>
                                    </div>
                                    <br><br>
                                </div> -->



                                <div class="col-md-6">
                                    <div class="form-group">
                                        <button type="submit" id="add_activity" class="btn btn-default"><i class="fa fa-check"></i> Guardar actividad</button>
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
    $(document).ready(function() {
        $("#estados_1").change(function() {

            $('#municipios_1').find('option').remove().end().append('<option value=""></option>').val('0');
            $('#ciudades').find('option').remove().end().append('<option value=""></option>').val('0');

            $("#estados_1 option:selected").each(function() {
                id_estado = $(this).val();

                // alert(id_estado);
                // alert($("#municipios").val());

                $.post("core/app/view/getMunicipio.php", {
                    id_estado: id_estado
                }, function(data) {
                    $("#municipios_1").html(data);
                });

                $.post("core/app/view/getCiudad.php", {
                    id_estado: id_estado
                }, function(data) {
                    $("#ciudades").html(data);
                });
            });
        })
    });


    $(document).ready(function() {
        $("#municipios_1").change(function() {
            $("#municipios_1 option:selected").each(function() {
                id_municipio = $(this).val();
                // alert(id_municipio);

                $.post("core/app/view/getParroquia.php", {
                    id_municipio: id_municipio
                }, function(data) {
                    $("#parroquias_1").html(data);
                });
            });
        })
    });




    // carga nuevas dimensiones
    $(document).ready(function() {

        $("#linea_accion").change(function() {
            $('#tipo_reporte').find('option').remove().end().append('<option value=""></option>').val('0');
            $("#linea_accion option:selected").each(function() {
                $('#cover-spin').show(0);
                line_acc = $(this).val();
                // console.log(line_acc);
                $.post("core/app/view/getDimention.php", {
                    line_acc: line_acc
                }, function(data) {
                    // console.log(data);
                    $("#tipo_reporte").html(data);
                    $('#cover-spin').hide(0);
                });

            });
        })

        $("#tipo_reporte").change(function() {
            $('#accion_especifica').find('option').remove().end().append('<option value=""></option>').val('0');
            $("#tipo_reporte option:selected").each(function() {
                $('#cover-spin').show(0);
                line_acc = $(this).val();
                // console.log(line_acc);
                if (line_acc != "Formación en TIC") {
                    $("#area_formativa_f").hide();
                    document.getElementById("area_formativa").required = false;
                    document.getElementsByName('area_formativa')[0].options[0].value = "No aplica";

                    $("#tipo_taller_f").hide();
                    document.getElementById("tipo_taller").required = false;
                    document.getElementsByName('tipo_taller')[0].options[0].value = "No aplica";
                }

                $.post("core/app/view/get_specific_action.php", {
                    line_acc: line_acc
                }, function(data) {
                    $("#accion_especifica").html(data);
                    // console.log(data);
                    $('#cover-spin').hide(0);
                });

            });
        })

        $("#accion_especifica").change(function() {
            $("#accion_especifica option:selected").each(function() {
                line_acc = $(this).val();
                has_formation = $(this).data('formation');
                code_info = document.getElementById("code_info").value;

                // mostrar el area formativa
                if (has_formation == "Si") {
                    $("#area_formativa_f").show();
                    document.getElementById("area_formativa").required = true;
                    $('#cover-spin').show(0);

                    $('#area_formativa').find('option').remove().end().append('<option value=""></option>').val('0');

                    $.post("core/app/view/get_training_type.php", {
                        line_acc: line_acc,
                        code_info: code_info
                    }, function(data) {
                        var array = JSON.parse(data);
                        // console.log(array["name_training_type"]);
                        $("#area_formativa").html(array["html"]);
                        $("#tipo_taller").find('option').remove();
                        $("#tipo_taller_f").hide();
                        $('#cover-spin').hide(0);
                    });

                } else {
                    $("#area_formativa_f").hide();
                    document.getElementById("area_formativa").required = false;
                    document.getElementsByName('area_formativa')[0].options[0].value = "No aplica";

                    $("#tipo_taller_f").hide();
                    document.getElementById("tipo_taller").required = false;
                    document.getElementsByName('tipo_taller')[0].options[0].value = "No aplica";

                    // console.log(document.getElementsByName('nivel_formacion')[0].options[0]);
                    // console.log(line_acc);

                    return;
                }

                // console.log($("#area_formativa").val());
                // console.log(line_acc);


            });
        })



        $("#area_formativa").change(function() {
            $("#tipo_taller_f").show();
            document.getElementById("tipo_taller").required = true;

            $('#tipo_taller').find('option').remove().end().append('<option value=""></option>').val('0');
            $("#area_formativa option:selected").each(function() {
                $('#cover-spin').show(0);
                categoria = $(this).val();
                // console.log(categoria);
                $.post("core/app/view/get_tipo_taller.php", {
                    categoria: categoria
                }, function(data) {
                    var array = JSON.parse(data);
                    // console.log(array);
                    $("#tipo_taller").html(array["html"]);
                    // console.log(data);
                    $('#cover-spin').hide(0);
                });

            });
        })

        $("#tipo_taller").change(function() {
            // $('#nivel_formacion').find('option').remove().end().append('<option value=""></option>').val('0');
            $("#tipo_taller option:selected").each(function() {
                area_formativa = $("#area_formativa").val();
                tipo_taller = $(this).val();
                // console.log(area_formativa);
                // console.log(tipo_taller);

                // datos del taller
                $.post("core/app/view/get_datos_taller.php", {
                    area_formativa: area_formativa,
                    tipo_taller: tipo_taller

                }, function(data) {
                    var array = JSON.parse(data);
                    // console.log(array);
                    console.log(array["nivel"]);
                    console.log(array["modalidad"]);
                    console.log(array["duracion"]);
                    console.log(array["contenido"]);

                    $("#contenido_des").val(array["contenido"]);
                    $("#modalidad_formacion").val(array["modalidad"]);
                    $("#duracion_horas").val(array["duracion"]);
                    $("#nivel_formacion").val(array["nivel"]);

                });

                // // nivel de formacion
                // $.post("core/app/view/get_level_training.php", {
                //     tipo_taller: tipo_taller
                // }, function(data) {
                //     $("#nivel_formacion").html(data);
                //     // console.log(data);
                // });

            });
        })




    });




    $(function() {
        var $tabla = $('#motivo_cierre');

        $('#estatus').change(function() {
            var value = $(this).val();
            // alert(value);

            if (value == 'Cerrado') {
                $($tabla).show();
                // $('option:not(.' + value + ')', $tabla).hide();
            } else {
                // Se ha seleccionado All
                $($tabla).hide();
                // $('option', $tabla).show();
            }
        });
    })


    // oculta o muestra motivo de cierre al iniciar
    $(function() {
        var $tabla = $('#motivo_cierre');

        var value = $('#estatus').val();
        // alert(value);

        if (value == 'Cerrado') {
            $($tabla).show();
            // $('option:not(.' + value + ')', $tabla).hide();
        } else {
            // Se ha seleccionado All
            $($tabla).hide();
            // $('option', $tabla).show();
        }
    })



    // $(function(){

    //     $('#linea_accion').change(function(){
    //         var value = $(this).val();
    //         // alert(value);

    //         // limpiar el select
    //         const $select = document.querySelector("#report_type");
    //         for (let i = $select.options.length; i >= 0; i--) {
    //             $select.remove(i);
    //         }

    //         if (value=='Infocentro adentro'){
    //             $('#report_type').append($('<option>').val('Jorna de atención social').text('Jornada de atención social'));
    //             $('#report_type').append($('<option>').val('Comunal').text('Comunal'));
    //             $('#report_type').append($('<option>').val('Político').text('Político'));
    //             $('#report_type').append($('<option>').val('Infocentro como plataforma de apoyo').text('Infocentro como plataforma de apoyo'));
    //             $('#report_type').append($('<option>').val('Organización interna de infocentro').text('Organización interna de infocentro'));
    //             $('#report_type').append($('<option>').val('Mantenimiento').text('Mantenimiento'));
    //             $('#report_type').append($('<option>').val('Movilización').text('Movilización'));
    //             $('#report_type').append($('<option>').val('Jornada de limpieza voluntaria al infocentro').text('Jornada de limpieza voluntaria al infocentro'));
    //             $('#report_type').append($('<option>').val('Soporte').text('Soporte'));
    //             $('#report_type').append($('<option>').val('Vinculación').text('Vinculación'));
    //         }

    //         if (value=='Formación a la medida'){
    //             $('#report_type').append($('<option>').val('Formación').text('Formación'));
    //         }

    //         if (value=='Tejiendo redes'){
    //             $('#report_type').append($('<option>').val('Prácticas de comunicación popular').text('Prácticas de comunicación popular'));
    //         }

    //         if (value=='Unidades socio-productivas'){
    //             $('#report_type').append($('<option>').val('Producción sustentable').text('Producción sustentable'));
    //         }

    //         if (value=='Sistematización de Experiencias'){
    //             $('#report_type').append($('<option>').val('Experiencias significativas').text('Experiencias significativas'));
    //         }


    //         var $contenido = $('#contenido');
    //         var $modalidad = $('#modalidad');
    //         var $duracion_dias = $('#div_duracion_dias');
    //         var $duracion_horas = $('#div_duracion_horas');

    //         if (value=='Formación a la medida'){
    //             $($contenido).show();
    //             $($modalidad).show();
    //             $($duracion_dias).show();
    //             $($duracion_horas).show();
    //             // $('option:not(.' + value + ')', $tabla).hide();
    //         }
    //         else{
    //             // Se ha seleccionado All
    //             $($contenido).hide();
    //             $("#contenido_des").val('');
    //             $($modalidad).hide();
    //             $("#modalidad_formacion").val('');
    //             $($duracion_dias).hide();
    //             $("#duracion_dias").val("");
    //             $($duracion_horas).hide();
    //             $("#duracion_horas").val("");
    //             // $('option', $tabla).show();
    //         }


    //     });
    // })


    // oculta o muestra motivo de cierre al iniciar
    $(function() {
        var $contenido = $('#contenido');
        var $modalidad = $('#modalidad');
        var $duracion_dias = $('#div_duracion_dias');
        var $duracion_horas = $('#div_duracion_horas');

        var value = $('#linea_accion').val();

        if (value == 'Formación a la medida') {
            $($contenido).show();
            $($modalidad).show();
            $($duracion_dias).show();
            $($duracion_horas).show();
            // $('option:not(.' + value + ')', $tabla).hide();
        } else {
            // Se ha seleccionado All
            $($contenido).hide();
            $($modalidad).hide();
            $($duracion_dias).hide();
            $($duracion_horas).hide();
            // $('option', $tabla).show();
        }
    })








    // CARGA DATOS DEL INFOCENTRO CON AJAX Y RETARDO AL ESCRIBIR
    var controladorTiempo = "";

    // retardo entre caracteres
    $(function() {

        $("#buscar_responsable").on("keyup", function() {
            clearTimeout(controladorTiempo);
            controladorTiempo = setTimeout(codigoAJAX, 800);
        });
    });

    function codigoAJAX() {
        code = document.getElementById("code_info").value;
        que = document.getElementById("b_responsable").value;
        responsable_tipo = document.getElementById("responsable_tipo").value;

        if (code == "") {
            alert("Debes asignar el código del infocentro primero");
            return;
        }

        // alert(responsable_tipo);
        if (responsable_tipo === "Facilitador") {
            $.post("core/app/view/getResponsible-view.php", {
                search: que,
                info_cod: code
            }, function(data) {
                var array = JSON.parse(data);
                // alert(array["telefono"]+"-"+array["dni"]);
                if (array["error"] === "true") {
                    alert(array["message"]);
                    return;
                }
                toastify(array["message"], true, 20000, "warning");

                $("#responsable_name").val(array["nombre"]);
                $("#responsable_tel").val(array["telefono"]);
                $("#responsible_dni").val(array["dni"]);
                $("#responsible_email").val(array["email"]);
                // $("#parroquias_1").val(array["parroquia"]);

            });
        }
        if (responsable_tipo === "Coordinador" || responsable_tipo === "Jefe de Estado") {
            $.post("core/app/view/getResponsible_coord-view.php", {
                search: que,
                info_cod: code
            }, function(data) {
                // console.log(data);
                var array = JSON.parse(data);
                // alert(array["nombre"]);
                toastify(array["message"], true, 20000, "warning");
                $("#responsable_name").val(array["nombre"]);
                $("#responsable_tel").val(array["telefono"]);
                $("#responsible_dni").val(array["dni"]);
                $("#responsible_email").val(array["email"]);
                // $("#parroquias_1").val(array["parroquia"]);

            });
        }
        if (responsable_tipo != "Facilitador" && responsable_tipo != "Coordinador" && responsable_tipo != "Jefe de Estado") {
            $.post("core/app/view/getResponsible_ger-view.php", {
                search: que,
                info_cod: code
            }, function(data) {
                var array = JSON.parse(data);
                // alert(array["nombre"]);
                $("#responsable_name").val(array["nombre"]);
                $("#responsable_tel").val(array["telefono"]);
                $("#responsible_dni").val(array["dni"]);
                $("#responsible_email").val(array["email"]);
                // $("#parroquias_1").val(array["parroquia"]);

            });
        }

    }
    // =======================



    $(function() {
        var $buscar_responsable = $('#buscar_responsable');

        // var value = document.getElementById$('#responsable_tipo');
        var value = $('#responsable_tipo').val();

        if (value == '') {
            $($buscar_responsable).hide();
        }


        $('#responsable_tipo').change(function() {
            var value = $(this).val();
            // alert(value);

            if (value != 'Otro') {
                $($buscar_responsable).show();
            } else {
                // Se ha seleccionado All
                $($buscar_responsable).hide();
            }
        });
    })



    // CARGA DATOS DEL INFOCENTRO CON AJAX
    $(function() {
        $("#code_info").change(function() {
            code = $(this).val();
            // alert(code);
            $.post("core/app/view/getReportLocation-view.php", {
                code_info: code
            }, function(data) {
                // console.log(data);
                var array = JSON.parse(data);
                // console.log(array);
                if (array["error"] == "true") {
                    document.getElementById("code_info").value = "";
                    alert("No existe el código: " + code + ". Por favor consulta a tu soporte InfoApp para registrar tu código");

                } else {
                    // $("#estate").val(array["estado"]);
                    // alert(array["info_id"]);
                    $("#info_id").val(array["info_id"]);
                    $("#estados_1").val(array["estado"]);
                    $("#municipios_1").val(array["municipio"]);
                    $("#parroquias_1").val(array["parroquia"]);
                    $("#ciudades").val(array["ciudad"]);
                    $("#direccion").val(array["direccion"]);

                    if (getOS() == "Android") {
                        alert("Se ha cargado la dirección registrada en el infocentro, por favor verifica que sea correcta al igual que la ortografía");
                    } else {
                        toastify('Se ha cargado la dirección registrada en el infocentro, por favor verifica que sea correcta al igual que la ortografía', true, 15000, "warning");
                    }

                }
            });
        });
    });


    // FECHA LIMITE DE LA ACTIVIDAD
    // $(function(){
    //     fecha_limite_inicio = document.getElementById("fecha_limite_inicio").value;
    //     fecha_limite_final = document.getElementById("fecha_limite_final").value;
    //     // const f = new Date("2018/01/30");
    //     // alert(f);

    //     $('#fecha').change(function(){
    //         var value = $(this).val();
    //             // alert(value);

    //         if (Date.parse(value)<Date.parse(fecha_limite_inicio) || Date.parse(value)>Date.parse(fecha_limite_final)){
    //             Swal.fire({
    //             // position: 'top-center',
    //             icon: 'warning',
    //             title: 'La fecha límite de reportes es del: \n'+fecha_limite_inicio+" al "+fecha_limite_final,
    //             showConfirmButton: true,
    //             // timer: 1500
    //             })

    //             document.getElementById("fecha").value = "";
    //         }
    //         else{

    //         }
    //     });
    // })




    function filePreview(input) {

        if (input.files && input.files[0]) {

            var reader = new FileReader();

            reader.readAsDataURL(input.files[0]);

            reader.onload = function(e) {

                $('#uploadForm + img').remove();

                $('#uploadForm').after('<img src="' + e.target.result + '" width="160" height="120"/>');
            }
        }
    }




    // preview uploaded image

    $("#image").change(function() {
        filePreview(this);
    });

    function filePreview(input) {

        if (input.files && input.files[0]) {

            var reader = new FileReader();

            reader.readAsDataURL(input.files[0]);

            reader.onload = function(e) {

                $('#uploadForm + img').remove();

                $('#uploadForm').after('<img src="' + e.target.result + '" width="160" height="120"/>');
            }
        }
    }

    // preview uploaded image 2

    $("#image2").change(function() {
        filePreview2(this);
    });

    function filePreview2(input) {

        if (input.files && input.files[0]) {

            var reader = new FileReader();

            reader.readAsDataURL(input.files[0]);

            reader.onload = function(e) {

                $('#uploadForm2 + img').remove();

                $('#uploadForm2').after('<img src="' + e.target.result + '" width="160" height="120"/>');
            }
        }
    }



    // preview uploaded image 3

    $("#image3").change(function() {
        filePreview3(this);
    });

    function filePreview3(input) {

        if (input.files && input.files[0]) {

            var reader = new FileReader();

            reader.readAsDataURL(input.files[0]);

            reader.onload = function(e) {

                $('#uploadForm3 + img').remove();

                $('#uploadForm3').after('<img src="' + e.target.result + '" width="160" height="120"/>');
            }
        }
    }








    // VALIDA QUE EL TEXTO NO ESTE EN MAYUSCULAS
    $("#nombre_act").change(function() {
        mensaje = $(this).val();
        var result = checkType(mensaje);
        if (result == '0') {
            // primera minusculas
            if (getOS() == "Android") {
                alert("ERROR: Por favor revisa la ortografía, la primera letra debe estar en mayúscula.");
            } else {
                toastify("ERROR: Por favor revisa la ortografía, la primera letra debe estar en mayúscula.", true, 20000, "error"); // [message, autohide]
            }
            document.getElementById("nombre_act").focus();
        } else if (result == '1') {
            // todo minusculas
            if (getOS() == "Android") {
                alert("ERROR: Por favor revisa la ortografía, no debe estar todo en minúscula.");
            } else {
                toastify("ERROR: Por favor revisa la ortografía, no debe estar todo en minúscula.", true, 20000, "error"); // [message, autohide]
            }
            document.getElementById("nombre_act").focus();
        } else if (result == '2') {
            // mayusculas
            if (getOS() == "Android") {
                alert("ERROR: Por favor revisa la ortografía, no debe estar todo en mayúsculas.");
            } else {
                toastify("ERROR: Por favor revisa la ortografía, no debe estar todo en mayúsculas.", true, 20000, "error"); // [message, autohide]
            }
            document.getElementById("nombre_act").focus();
        } else if (result == '3') {
            // mayusculas y minusculas
            if (getOS() == "Android") {
                alert("AVISO: Tienes textos en mayusculas, asegúrate que su uso sea correcto antes de enviar.");
            } else {
                toastify("AVISO: Tienes textos en mayusculas, asegúrate que su uso sea correcto antes de enviar.", true, 20000, "warning"); // [message, autohide]
            }
            // document.getElementById("nombre_act").focus();
        } else {
            // console.log('El mensaje no incluye letras');
        }
    });

    $("#direccion").change(function() {
        mensaje = $(this).val();
        var result = checkType(mensaje);
        // alert(result);
        if (result == '0') {
            // primera minusculas
            if (getOS() == "Android") {
                alert("ERROR: Por favor revisa la ortografía, la primera letra debe estar en mayúscula.");
            } else {
                toastify("ERROR: Por favor revisa la ortografía, la primera letra debe estar en mayúscula.", true, 20000, "error"); // [message, autohide]
            }
            document.getElementById("nombre_act").focus();
        } else if (result == '1') {
            // todo minusculas
            if (getOS() == "Android") {
                alert("ERROR: Por favor revisa la ortografía, no debe estar todo en minúscula.");
            } else {
                toastify("ERROR: Por favor revisa la ortografía, no debe estar todo en minúscula.", true, 20000, "error"); // [message, autohide]
            }
            document.getElementById("nombre_act").focus();
        } else if (result == '2') {
            // mayusculas
            if (getOS() == "Android") {
                alert("ERROR: Por favor revisa la ortografía, no debe estar todo en mayúsculas.");
            } else {
                toastify("ERROR: Por favor revisa la ortografía, no debe estar todo en mayúsculas.", true, 20000, "error"); // [message, autohide]
            }
            document.getElementById("nombre_act").focus();
        } else if (result == '3') {
            // mayusculas y minusculas
            if (getOS() == "Android") {
                alert("AVISO: Tienes textos en mayusculas, asegúrate que su uso sea correcto antes de enviar.");
            } else {
                toastify("AVISO: Tienes textos en mayusculas, asegúrate que su uso sea correcto antes de enviar.", true, 20000, "warning"); // [message, autohide]
            }
            // document.getElementById("nombre_act").focus();
        } else {
            // console.log('El mensaje no incluye letras');
        }
    });


    $("#direccion").click(function() {
        if (getOS() == "Android") {
            toastify('¡AVISO! Aquí se describe la (ubicación) de la actividad, por favor no lo coloque en el campo (Descripción de la actividad).', true, 150000, "warning");
        } else {
            toastify('¡AVISO! Aquí se describe la (ubicación) de la actividad, por favor no lo coloque en el campo (Descripción de la actividad).', true, 150000, "warning");
        }
    });


    $("#nombre_act").click(function() {
        if (getOS() == "Android") {
            toastify('¡AVISO! En este campo se coloca solo la descripción de la actividad, la (ubicación) se coloca en el campo (Dirección de la actividad).', true, 150000, "warning");
        } else {
            toastify('¡AVISO! En este campo se coloca solo la descripción de la actividad, la (ubicación) se coloca en el campo (Dirección de la actividad).', true, 150000, "warning");
        }
    });


    function checkType(mensaje) {
        mensaje = mensaje.replace(/[&\/\\#,+()$~%.'":*?<>{}áéíóú]/g, '')
        mensaje = String(mensaje).trim();
        var primerCaracter = mensaje.charAt(0);
        var primera_minuscula = primerCaracter === primerCaracter.toLowerCase();
        // alert(mensaje);
        const regxs = {
            "lower": /^[a-z0-9 ]+$/,
            "upper": /^[A-Z0-9 ]+$/,
            "upperLower": /^[A-Za-z0-9 ]+$/
        };
        if (primera_minuscula === true) {
            return '0';
        }
        if (regxs.lower.test(mensaje)) {
            return '1';
        }
        if (regxs.upper.test(mensaje)) {
            return '2';
        }
        if (regxs.upperLower.test(mensaje)) {
            return '3';
        }
        return -1;
    }
</script>






<style>
    .form-group input[type=file] {
        opacity: 0;
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 100;
    }


    .form-group input[name=file] {
        opacity: 1;
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 100;
    }
</style>
