<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$estado = EstadoData::getAll();
$action_line = ActionsLineData::getAll();

$location = "index.php?view=report";

date_default_timezone_set('UTC');
date_default_timezone_set("America/La_Paz");

// $notific = new NotificData();
// $notific->url = "http://infoapp2.infocentro.gob.ve";
// $notific->message = "La planificación de la actividad:\n <b>Hola</b>";
// $notific->sendTelegram();

?>

<!-- MODAL IMAGE POPUP -->
<script language="javascript">
    function del_item(url) {
        Swal.fire({
            title: "\n¿Desea eliminar?",
            text: "¡Esto es irreversible! Eliminará también participantes y productos cargados en ésta actividad",
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



    <?php
    // limitar texto de la tarjeta
    function charlimit_title($string, $limit)
    {
        $overflow = (strlen($string) > $limit ? true : false);
        return substr($string, 0, $limit) . ($overflow === true ? "..." : '');
    }
    ?>


    $(document).ready(function() {
        var now = new Date();
        var dateObj = new Date(Date.parse("2022-09-01 12:26:22"));
        // var today = now.format("isoDateTime");

        // alert(dateObj);

        var Name_OS = "Unknown OS";
        // OS NAME
        if (navigator.userAgent.indexOf("Win") != -1) Name_OS = "Windows";
        if (navigator.userAgent.indexOf("Mac") != -1) Name_OS = "Macintosh";
        if (navigator.userAgent.indexOf("Linux") != -1) Name_OS = "Linux";
        if (navigator.userAgent.indexOf("Android") != -1) Name_OS = "Android";
        if (navigator.userAgent.indexOf("like Mac") != -1) Name_OS = "iOS";
        // console.log(Name_OS);



        // // AVISO
        // if (Name_OS != "Android"){
        // 	Swal.fire({
        // 	// position: 'top-center',
        // 	icon: 'warning',
        // 	title: 'Recomendación',
        // 	text: 'Antes de reportar las actividades podrías cambiar la línea de acción y vincular la actividad con las nuevas dimensiones que son mas específicas.',
        // 	showConfirmButton: true,
        //     confirmButtonColor: "#00bcd4",
        // 	// timer: 1000
        // 	})
        // }else{
        // 	alert('Antes de reportar las actividades podrías cambiar la línea de acción y vincular la actividad con las nuevas dimensiones que son mas específicas.');
        // }



        // mensaje al cambiar el estatus de la actividad
        <?php if (isset($_SESSION['alert']) && $_SESSION['alert'] != "") : ?>
            if (getOS() != "Android") {
                Swal.fire({
                    icon: 'success',
                    title: '¡Listo!',
                    text: '<?php echo $_SESSION['alert']; ?>',
                    showConfirmButton: true,
                    timer: 50000

                })
            } else {
                alert("<?php echo $_SESSION['alert']; ?>");
            }

            <?php $_SESSION['alert'] = ""; ?>
        <?php endif; ?>






        function sendMessage(event, param, url) {
            event.preventDefault();

            $.ajax({
                    type: "POST",
                    url: "./?action=ajax",
                    // headers: {
                    //     "X-CSRFToken": getCookie("csrftoken")
                    // },
                    data: {
                        function: "send_notific",
                        message: param,
                        url: url,
                    }
                })
                .done(function(msg) {
                    if (getOS() == "Android") {
                        alert("Registro actualizado");
                    } else {
                        toastify('Registro actualizado', true, 1000, "dashboard");
                    }
                    // console.log(msg);
                    location.reload();

                })
                .fail(function(err) {
                    if (getOS() == "Android") {
                        alert("Ocurrió un error al guardar, intenta nuevamente");
                    } else {
                        toastify('Ocurrió un error al guardar, intenta nuevamente', true, 5000, "warning");
                    }

                    $('#cover-spin').hide(0);
                });
            // .always(function() {
            //     toastify('Finished',true,1000,"warning");
            // });
        };




        // <!-- MODAL SWEET ALERT -->
        $(function() {
            <?php if (isset($_GET['swal']) && $_GET['swal'] != "") : ?>
                if (getOS() != "Android") {
                    Swal.fire({
                        // position: 'top-center',
                        icon: 'success',
                        title: '<?php echo $_GET['swal']; ?>',
                        <?php if (isset($_GET['ConfirmButton']) && $_GET['ConfirmButton'] == "true") : ?>
                            showConfirmButton: true,
                        <?php endif; ?>
                        <?php if (!isset($_GET['ConfirmButton']) || $_GET['ConfirmButton'] == "false") : ?>
                            showConfirmButton: false,
                            timer: 1000
                        <?php endif; ?>

                    })
                } else {

                    alert("<?php echo $_GET['swal']; ?>");
                }

                // cambiar el parametro de alert
                const url = new URL(window.location);
                url.searchParams.set('swal', '');
                window.history.pushState({}, '', url);

            <?php endif; ?>









            // // redimenciona textarea cuando tiene salto de lineas
            // const tx = document.getElementsByTagName("textarea");
            // $("textarea").each(function () {

            // }).on("input", function () {

            //     for (let i = 0; i < tx.length; i++) {
            //         var text = tx[i].value;   
            //         var lines = text.split(/\r|\r\n|\n/);
            //         count = lines.length;
            //         // tx[i].setAttribute("style", "height:" + (tx[i].scrollHeight) + "px;");
            //         tx[i].addEventListener("input", OnInput, false);
            //         tx[i].rows = count;
            //     }


            //     function OnInput() {
            //         this.style.height = 0;
            //         this.style.height = (this.scrollHeight) + "px";
            //     }
            // });



        });













        // limpiar notific
        $('#submit_notific').click(function(event) {
            event.preventDefault();

            $('#cover-spin').show(0);
            document.getElementById("notific_status").value = "";

            $.ajax({
                    type: "POST",
                    url: "./?action=ajax",
                    // headers: {
                    //     "X-CSRFToken": getCookie("csrftoken")
                    // },
                    data: {
                        function: "update_notific",
                        id: $("#id_notific").val(),
                        status_activity: 0,
                        notific_status: $("#notific_status").val()
                    }
                })
                .done(function(msg) {
                    if (getOS() == "Android") {
                        alert("Registro guardado");
                    } else {
                        toastify('Registro guardado', true, 1000, "dashboard");
                    }
                    // window.document.location=msg;
                    location.reload();

                    // $('#content').reload('#content');
                    // $('#update_planning').modal('hide');
                    // $('#cover-spin').hide(0);

                })
                .fail(function(err) {
                    // console.log(err);
                    if (getOS() == "Android") {
                        alert("Ocurrió un error al guardar, intenta nuevamente");
                    } else {
                        toastify('Ocurrió un error al guardar, intenta nuevamente', true, 5000, "warning");
                    }

                    $('#cover-spin').hide(0);
                });
            // .always(function() {
            //     toastify('Finished',true,1000,"warning");
            // });





        });





















        $(function() {

            var line_action = "";
            var admin_edit_v = 0;
            var activity_title = "";
            var code_info = "";
            var notificacion = "";
            var user_id = "";
            var responsible_name = "";
            var responsible_type = "";
            var estado = "";
            var user_username = "";
            var status_activity = "";
            var notific_data = "";

            // al abrir el modal de estatus rellena los datos del form
            $(document).on('click', 'a[type="update_planning"]', function(event) {
                let id = this.id;


                user_id = document.getElementsByClassName("user_id").item(id).id;
                var id_activity = document.getElementsByClassName("id_activity").item(id).id;
                var planning_line_action = document.getElementsByClassName("planning_line_action").item(id).id;
                var contenido_des = document.getElementsByClassName("contenido_des").item(id).id;
                var modalidad_formacion = document.getElementsByClassName("modalidad_formacion").item(id).id;
                var duracion_dias = document.getElementsByClassName("duracion_dias").item(id).id;
                var duracion_horas = document.getElementsByClassName("duracion_horas").item(id).id;
                status_activity = document.getElementsByClassName("status_activity").item(id).id;
                activity_title = document.getElementsByClassName("activity_title").item(id).id;
                var date_pub_end = document.getElementsByClassName("date_pub_end").item(id).id;
                var admin_edit = document.getElementsByClassName("admin_edit").item(id).id;
                var dimensiones = document.getElementsByClassName("data_dimensiones").item(id).id;
                var responsible_dni = document.getElementsByClassName("responsible_dni").item(id).id;
                notific_data = document.getElementsByClassName("notific_var").item(id).id;

                code_info = document.getElementsByClassName("code_info").item(id).id;
                dimensiones = dimensiones.replace(/%/g, '<font color="black">/</font>');

                responsible_name = document.getElementsByClassName("responsible_name").item(id).id;
                responsible_type = document.getElementsByClassName("responsible_type").item(id).id;
                estado = document.getElementsByClassName("user_state").item(id).id;
                user_username = '<?php echo $_SESSION['user_username']; ?>';



                line_action = planning_line_action;
                admin_edit_v = admin_edit;

                // console.log(activity_title);
                // console.log(admin_edit);

                if (activity_title === "") {
                    if (getOS() == "Android") {
                        alert("Por favor actualiza la página nuevamente, los datos no cargaron correctamente");
                    } else {
                        toastify('Por favor actualiza la página nuevamente, los datos no cargaron correctamente', true, 10000, "warning");
                    }
                    return;
                }

                if (admin_edit == 0) {
                    $("#status_activity_col").hide();
                } else {
                    $("#status_activity_col").show();
                }

                // if (planning_line_action === "Formación a la medida"){
                if ((planning_line_action == "Formación a la medida" || planning_line_action == "Comunidades de aprendizaje" || planning_line_action == "Comunas en Red Digital") && admin_edit == 1) {
                    $("#contenido").show();
                    $("#modalidad").show();
                    $("#div_duracion_dias").show();
                    $("#div_duracion_horas").show();
                    // $("#contenido_des").prop("required", true);

                } else {
                    $("#contenido").hide();
                    $("#modalidad").hide();
                    $("#div_duracion_dias").hide();
                    $("#div_duracion_horas").hide();
                }

                document.getElementById("user_id").value = user_id;
                document.getElementById("responsible_dni").value = responsible_dni;
                document.getElementById("id_status").value = id_activity;
                document.getElementById("date_pub").value = date_pub_end;
                document.getElementById("act_title").innerHTML = activity_title;
                document.getElementById("act_dimensiones").innerHTML = dimensiones;
                $("#option_modality").val(modalidad_formacion);
                $("#option_modality").text(modalidad_formacion);
                $("#contenido_des").val(contenido_des);
                $("#duracion_dias").val(duracion_dias);
                $("#duracion_horas").val(duracion_horas);

                document.getElementById("notific").value = notific_data;
            })



            // update_planning | validar estatus
            $('#submit_status').click(function(event) {
                event.preventDefault();
                var data = $("#date_pub").val() + " 00:00:00";
                var today = new Date();
                var dateObject = new Date(Date.parse(data));

                notific = document.getElementById("notific").value;
                if (notific_data != notific) {
                    document.getElementById("notific").value = notific;
                }


                if (admin_edit_v == 1) {
                    // pueden actualizar observaciones sin pedir campos obligatorios
                    <?php if ($_SESSION["user_type"] != 4 && $_SESSION["user_type"] != 5 && $_SESSION["user_type"] != 6 && $_SESSION["user_type"] != 7 && $_SESSION["user_type"] != 8) : ?>

                        // if (line_action === "Formación a la medida"){
                        if (line_action === "Formación a la medida" || line_action == "Comunidades de aprendizaje") {

                            if (document.getElementById("contenido_des").value === "") {
                                document.getElementById("contenido_des").focus();
                                return;
                            } else if (document.getElementById("modalidad_formacion").value === "") {
                                document.getElementById("modalidad_formacion").focus();
                                if (getOS() == "Android") {
                                    alert("Por favor elige la modalidad de formación");
                                } else {
                                    toastify('Por favor elige la modalidad de formación', true, 10000, "warning");
                                }
                                return;
                            } else if (document.getElementById("duracion_dias").value === "") {
                                document.getElementById("duracion_dias").focus();
                                return;
                            } else if (document.getElementById("duracion_horas").value === "") {
                                document.getElementById("duracion_horas").focus();
                                return;
                            }

                        }

                    <?php endif; ?>
                }


                if (status_activity === '1' && dateObject > today) {
                    if (getOS() == "Android") {
                        alert("La fecha de la actividad no se ha cumplido para cambiar de estatus");
                    } else {
                        toastify('La fecha de la actividad no se ha cumplido para cambiar de estatus', true, 10000, "warning");
                    }
                    return;
                }


                var user_id = $("#user_id").val();
                var id_status = $("#id_status").val();
                // let id = document.getElementById("id_status").value;
                // let status_activity = document.getElementById("status_activity").value;
                // let contenido_des = document.getElementById("contenido_des").value;
                // let modalidad_formacion = document.getElementById("modalidad_formacion").value;
                // let duracion_dias = document.getElementById("duracion_dias").value;
                // let duracion_horas = document.getElementById("duracion_horas").value;

                // console.log($("#notific").val());
                // console.log($("#modalidad_formacion").val());

                $('#cover-spin').show(0);

                $.ajax({
                        type: "POST",
                        url: "./?action=ajax",
                        // headers: {
                        //     "X-CSRFToken": getCookie("csrftoken")
                        // },
                        data: {
                            function: "update_planning",
                            id: $("#id_status").val(),
                            user_id: $("#user_id").val(),
                            contenido_des: $("#contenido_des").val(),
                            modalidad_formacion: $("#modalidad_formacion").val(),
                            duracion_dias: $("#duracion_dias").val(),
                            duracion_horas: $("#duracion_horas").val(),
                            status_activity: $("#status_activity").val(),
                            notific: $("#notific").val(),
                            location: "planning",
                            user_dni: $("#responsible_dni").val(),
                            code_info: code_info,
                            estado: estado,
                            activity_title: activity_title,
                        }
                    })
                    .done(function(msg) {
                        if (getOS() == "Android") {
                            alert("Registro guardado");
                        } else {
                            toastify('Registro guardado', true, 1000, "dashboard");
                        }
                        // enviar notificacion con ajax
                        if (notific != '' && notific_data != notific) {
                            url = "http://infoapp2.infocentro.gob.ve/admin/index.php?view=editplanning&user_id=" + user_id + "&id=" + id_status + "&code_info=" + code_info + "&estado=" + estado + "&participantes=&start_at=&finish_at=&pag=1";
                            message = "🔥 REVISIÓN INFOAPP PARA: <b>" + code_info + "</b>\n\n<b>Región:</b> " + estado + "\n<b>Nombre:</b> " + responsible_name + "\n<b>UID:</b> " + user_id + "\n<b>Rol:</b> " + responsible_type + "\n<b>Revisado por:</b> " + user_username + "\n\n<b>Actividad PLANIFICADA:</b>\n\n -" + activity_title + "\n\n<b>Observación:</b>\n\n" + notific + "\n\nPor favor revisar las observaciones.";
                            sendMessage(event, message, url);
                        } else {
                            location.reload();
                        }
                        // window.document.location=msg;
                        // location.reload();
                        // console.log(msg);
                        // $('#content').reload('#content');
                        // $('#update_planning').modal('hide');
                        // $('#cover-spin').hide(0);

                    })
                    .fail(function(err) {
                        if (getOS() == "Android") {
                            alert("Ocurrió un error al guardar, intenta nuevamente");
                        } else {
                            toastify('Ocurrió un error al guardar, intenta nuevamente', true, 5000, "warning");
                        }

                        $('#cover-spin').hide(0);
                    });
                // .always(function() {
                //     toastify('Finished',true,1000,"warning");
                // });





            });



            // al abrir el modal user notific
            $(document).on('click', 'a[type="show_notific"]', function(event) {
                let id = this.id;

                var id_activity = document.getElementsByClassName("id_activity").item(id).id;
                var notific = document.getElementsByClassName("notific_var").item(id).id;
                document.getElementById("notific_status").value = notific;
                document.getElementById("id_notific").value = id_activity;

                // // escala el textarea
                // const tx = document.getElementsByTagName("textarea");
                // $("textarea").each(function () {
                //     for (let i = 0; i < tx.length; i++) {
                //         var text = tx[i].value;   
                //         var lines = text.split(/\r|\r\n|\n/);
                //         count = lines.length;
                //         tx[i].rows = count;
                //     }
                // })

            })

            // valor menor a cero
            $(document).on('click', 'input[type="number"]', function(event) {
                let value = this.value;
                if (value < 1) {
                    if (getOS() == "Android") {
                        alert("El valor no puede ser menor a uno");
                        this.value = 1;
                    } else {
                        toastify('El valor no puede ser menor a uno', true, 5000, "error");
                        this.value = 1;
                    }
                }
            })


        });


    });
</script>

<div id="cover-spin"></div>



<!-- Modal -->
<div class="modal" id="update_planning" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">


            <div class="modal-header">
                <h4 class="title_preview">Cambiar estatus de actividad</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="col-lg-12">
                <div class="form-group">
                    <label for="status_activity" style="text-align:center;color:#c50082;" class=" control-label" id="act_title"> Título</label>
                </div>
            </div>

            <div class="col-lg-12">
                <h6 class="title_preview" style="text-align:center;">Dimensiones</h6>
                <div class="form-group">
                    <label for="dimensiones" style="text-align:center;color:#9c9c9c;" class=" control-label" id="act_dimensiones"> Dimensiones</label>
                </div>
            </div>

            <div class="modal-body fullscreen" id="modal-body">

                <!-- FORM -->
                <form name="form" id="form" accept-charset="UTF-8" class="form-horizontal">
                    <input type="hidden" id="user_id" value="">
                    <input type="hidden" id="id_status" value="">
                    <input type="hidden" id="date_pub" value="">
                    <input type="hidden" id="responsible_dni" value="">

                    <fieldset>

                        <!-- estatus -->
                        <div class="col-lg-12" id="status_activity_col">
                            <div class="form-group">
                                <label for="status_activity" class=" control-label"><i><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24">
                                            <path fill="currentColor" d="M12 2A10 10 0 0 0 2 12a10 10 0 0 0 10 10a10 10 0 0 0 10-10A10 10 0 0 0 12 2m4.2 14.2L11 13V7h1.5v5.2l4.5 2.7z" />
                                        </svg></i> Estatus</label>
                                <select name="status_activity" class="form-control" id="status_activity">
                                    <option value="0"> Planificada </option>
                                    <option value="1"> Ejecutada </option>
                                </select>
                            </div>
                        </div>

                        <br>


                        <!-- contenido desarrollado -->
                        <div class="col-md-12">
                            <div style="display: none" class="form-group" id="contenido">
                                <label for="contenido_des" class=" control-label"><i><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24">
                                            <path fill="currentColor" d="M6 22a3 3 0 0 1-3-3c0-.6.18-1.16.5-1.63L9 7.81V6a1 1 0 0 1-1-1V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v1a1 1 0 0 1-1 1v1.81l5.5 9.56c.32.47.5 1.03.5 1.63a3 3 0 0 1-3 3zm-1-3a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1c0-.21-.07-.41-.18-.57l-2.29-3.96L14 17l-5.07-5.07l-3.75 6.5c-.11.16-.18.36-.18.57m8-9a1 1 0 0 0-1 1a1 1 0 0 0 1 1a1 1 0 0 0 1-1a1 1 0 0 0-1-1" />
                                        </svg></i> Contenido desarrollado</label>
                                <br>
                                <textarea rows="1" class="form-control" name="contenido_des" placeholder="Descripción" id="contenido_des" required></textarea>
                            </div>
                        </div>


                        <!-- modalida formacion -->
                        <div class="col-lg-12">
                            <div style="display: none" class="form-group" id="modalidad">
                                <label for="modalidad_formacion" class=" control-label"><i><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                                            <path fill="currentColor" d="M12 5.5A3.5 3.5 0 0 1 15.5 9a3.5 3.5 0 0 1-3.5 3.5A3.5 3.5 0 0 1 8.5 9A3.5 3.5 0 0 1 12 5.5M5 8c.56 0 1.08.15 1.53.42c-.15 1.43.27 2.85 1.13 3.96C7.16 13.34 6.16 14 5 14a3 3 0 0 1-3-3a3 3 0 0 1 3-3m14 0a3 3 0 0 1 3 3a3 3 0 0 1-3 3c-1.16 0-2.16-.66-2.66-1.62a5.54 5.54 0 0 0 1.13-3.96c.45-.27.97-.42 1.53-.42M5.5 18.25c0-2.07 2.91-3.75 6.5-3.75s6.5 1.68 6.5 3.75V20h-13zM0 20v-1.5c0-1.39 1.89-2.56 4.45-2.9c-.59.68-.95 1.62-.95 2.65V20zm24 0h-3.5v-1.75c0-1.03-.36-1.97-.95-2.65c2.56.34 4.45 1.51 4.45 2.9z" />
                                        </svg></i> Modalidad formación</label>
                                <select name="modalidad_formacion" class="form-control" id="modalidad_formacion" required>
                                    <option value="" id="option_modality"></option>
                                    <option value="Presencial"> Presencial </option>
                                    <option value="Distancia"> Distancia </option>
                                    <option value="Ambas"> Ambas </option>
                                </select>
                            </div>
                        </div>


                        <!-- duracion act -->
                        <div class="col-md-12">
                            <div style="display: none" class="form-group" id="div_duracion_dias">
                                <label for="duracion_dias" class=" control-label"><i><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                                            <path fill="currentColor" d="M8 20h8v-3q0-1.65-1.175-2.825T12 13t-2.825 1.175T8 17zm-4 2v-2h2v-3q0-1.525.713-2.863T8.7 12q-1.275-.8-1.987-2.137T6 7V4H4V2h16v2h-2v3q0 1.525-.712 2.863T15.3 12q1.275.8 1.988 2.138T18 17v3h2v2z" />
                                        </svg></i> Duración días</label>
                                <input type="number" class="form-control" value="" name="duracion_dias" placeholder="Días" id="duracion_dias">
                                <p class="help-block" style="color:gray;">Días impartiendo formación</p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div style="display: none" class="form-group" id="div_duracion_horas">
                                <label for="duracion_horas" class=" control-label"><i><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                                            <path fill="currentColor" d="M8 20h8v-3q0-1.65-1.175-2.825T12 13t-2.825 1.175T8 17zm-4 2v-2h2v-3q0-1.525.713-2.863T8.7 12q-1.275-.8-1.987-2.137T6 7V4H4V2h16v2h-2v3q0 1.525-.712 2.863T15.3 12q1.275.8 1.988 2.138T18 17v3h2v2z" />
                                        </svg></i> Duración horas</label>
                                <input type="number" class="form-control" value="" name="duracion_horas" placeholder="Horas" id="duracion_horas">
                                <p class="help-block" style="color:gray;">Horas académicas certificadas</p>
                            </div>
                        </div>

                        <?php if ($_SESSION["user_type"] == 3 || $_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 8) : ?>

                            <!-- notificaciones -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="notific" class=" control-label"><i><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24">
                                                <path fill="currentColor" d="M13 14h-2V9h2m0 9h-2v-2h2M1 21h22L12 2z" />
                                            </svg></i> Observaciones al usuario (Enviará una notificación al usuario)</label>
                                    <br>
                                    <textarea style="background: #ecffb1;" rows="4" class="form-control" name="notific" placeholder="Descripción" id="notific"></textarea>
                                </div>
                            </div>
                        <?php else : ?>
                            <textarea style="display:none;" rows="4" class="form-control" name="notific" placeholder="Descripción" id="notific"></textarea>
                        <?php endif ?>


                        <div class="col-md-12">
                            <div class="form-group">
                                <button id="submit_status" class="btn btn-primary btn-block"> Actualizar actividad</button>
                            </div>
                        </div>



                    </fieldset>
                </form name="form">

            </div>
        </div>
    </div>
</div>


<!-- Modal notific-->
<div class="modal" id="show_notific" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">


            <div class="modal-header">
                <h4 class="title_preview">Observaciones técnicas</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>



            <div class="modal-body fullscreen" id="modal-body">

                <!-- FORM -->
                <form name="form" id="form" accept-charset="UTF-8" class="form-horizontal">
                    <input type="hidden" id="id_notific" value="">

                    <fieldset>

                        <!-- notificaciones -->
                        <div class="col-md-12">
                            <div class="form-group" id="contenido">
                                <label for="notific_status" class=" control-label"><i><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                                            <path fill="currentColor" d="M13 14h-2V9h2m0 9h-2v-2h2M1 21h22L12 2z" />
                                        </svg></i> Observaciones al usuario</label>
                                <br>
                                <textarea rows="8" class="form-control" name="notific_status" placeholder="..." id="notific_status"></textarea>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <button id="submit_notific" class="btn btn-primary btn-block"> Marcar como listo</button>
                            </div>
                        </div>



                    </fieldset>
                </form name="form">

            </div>

        </div>
    </div>
</div>





<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Filtrar planificación</h4>
                    </div>

                    <div class="form-group">

                        <div class="card-body">
                            <form class="form-horizontal" role="form">
                                <input type="hidden" name="view" value="planning">

                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                            <path fill="currentColor" d="m19.6 21l-6.3-6.3q-.75.6-1.725.95T9.5 16q-2.725 0-4.612-1.888T3 9.5t1.888-4.612T9.5 3t4.613 1.888T16 9.5q0 1.1-.35 2.075T14.7 13.3l6.3 6.3zM9.5 14q1.875 0 3.188-1.312T14 9.5t-1.312-3.187T9.5 5T6.313 6.313T5 9.5t1.313 3.188T9.5 14" />
                                                        </svg></i></span>
                                            </div>
                                            <label class="bmd-label-floating floating_icon">Palabra clave</label>
                                            <input type="text" name="q" value="<?php if (isset($_GET["q"]) && $_GET["q"] != "") {
                                                                                    echo $_GET["q"];
                                                                                } ?>" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <div class="input-group">
                                            <span class="input-group-text">UID</span>
                                            <input type="text" name="uid" value="<?php if (isset($_GET["uid"]) && $_GET["uid"] != "") {
                                                                                        echo $_GET["uid"];
                                                                                    } ?>" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <div class="input-group">
                                            <span class="input-group-text">Código info</span>
                                            <input type="text" name="info_id" value="<?php if (isset($_GET["info_id"]) && $_GET["info_id"] != "") {
                                                                                            echo $_GET["info_id"];
                                                                                        } ?>" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                    <?php if ($_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 9 || $_SESSION["user_type"] == 10) { ?>

                                        <div class="col-md-12">
                                            <div class="form-group ">
                                                <span class="input-group-addon"><i><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                                                            <path fill="currentColor" d="m15 21l-6-2.1l-4.65 1.8q-.5.2-.925-.112T3 19.75v-14q0-.325.188-.575T3.7 4.8L9 3l6 2.1l4.65-1.8q.5-.2.925.113T21 4.25v14q0 .325-.187.575t-.513.375zm-1-2.45V6.85l-4-1.4v11.7z" />
                                                        </svg></i> Estado</span>
                                                <select name="estado" class="form-control">
                                                    <option value="">ESTADO</option>
                                                    <?php foreach ($estado as $p) : ?>
                                                        <option value="<?php echo $p->estado; ?>"><?php echo $p->estado ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    <?php } else { ?>
                                        <input type="hidden" name="estado" value="">
                                    <?php } ?>

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <span class="input-group-addon"><i><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                                                        <path fill="currentColor" d="M15.9 18.45c1.35 0 2.45-1.1 2.45-2.45s-1.1-2.45-2.45-2.45c-1.36 0-2.45 1.1-2.45 2.45s1.09 2.45 2.45 2.45m5.2-1.77l1.48 1.16c.13.11.17.29.08.45l-1.4 2.42a.35.35 0 0 1-.43.15l-1.74-.7c-.36.28-.76.51-1.18.69l-.27 1.85c-.02.17-.17.3-.34.3h-2.8c-.18 0-.32-.13-.35-.3l-.26-1.85c-.43-.18-.82-.41-1.18-.69l-1.75.7c-.15.06-.34 0-.42-.15l-1.4-2.42a.35.35 0 0 1 .08-.45l1.48-1.16l-.05-.68l.05-.69l-1.48-1.15a.35.35 0 0 1-.08-.45l1.4-2.42c.08-.16.27-.22.42-.16l1.75.71c.36-.28.75-.52 1.18-.69l.26-1.86c.03-.16.17-.29.35-.29h2.8c.17 0 .32.13.34.29l.27 1.86c.42.17.82.41 1.18.69l1.74-.71c.17-.06.34 0 .43.16l1.4 2.42c.09.15.05.34-.08.45l-1.48 1.15l.05.69zM6.69 8.07c.87 0 1.57-.7 1.57-1.57s-.7-1.58-1.57-1.58A1.58 1.58 0 0 0 5.11 6.5c0 .87.71 1.57 1.58 1.57m3.34-1.13l.97.74c.07.07.09.19.03.29l-.9 1.56c-.05.1-.17.14-.27.1l-1.12-.45l-.74.44l-.19 1.19c-.02.11-.11.19-.22.19h-1.8c-.12 0-.21-.08-.23-.19L5.4 9.62l-.76-.44l-1.14.45c-.09.04-.2 0-.26-.1l-.9-1.56c-.06-.1-.03-.22.05-.29l.95-.74l-.03-.44l.03-.44l-.95-.74a.23.23 0 0 1-.05-.29l.9-1.56c.06-.1.17-.14.26-.1l1.13.45l.77-.44l.16-1.19c.02-.11.11-.19.23-.19h1.8c.11 0 .2.08.22.19L8 3.38l.74.44l1.12-.45c.1-.04.22 0 .27.1l.9 1.56c.06.1.04.22-.03.29l-.97.74l.03.44z" />
                                                    </svg></i> Linea de acción</span>
                                            <select name="linea_accion" class="form-control" id="linea_accion">
                                                <option value="">-- LINEA DE ACCIÓN --</option>
                                                <?php foreach ($action_line as $p) : ?>
                                                    <option value="<?php echo $p->line_name; ?>"> <?php echo $p->line_name; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>

                                </div>



                                <div class="form-group ">
                                    <div class="row">

                                        <div class="col">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                            <path fill="currentColor" d="M8 14q-.425 0-.712-.288T7 13t.288-.712T8 12t.713.288T9 13t-.288.713T8 14m4 0q-.425 0-.712-.288T11 13t.288-.712T12 12t.713.288T13 13t-.288.713T12 14m4 0q-.425 0-.712-.288T15 13t.288-.712T16 12t.713.288T17 13t-.288.713T16 14M5 22q-.825 0-1.412-.587T3 20V6q0-.825.588-1.412T5 4h1V2h2v2h8V2h2v2h1q.825 0 1.413.588T21 6v14q0 .825-.587 1.413T19 22zm0-2h14V10H5z" />
                                                        </svg></i> </span> Desde
                                            </div>
                                            <input type="date" name="start_at" value="<?php if (isset($_GET["start_at"]) && $_GET["start_at"] != "") {
                                                                                            echo $_GET["start_at"];
                                                                                        } ?>" class="form-control">
                                        </div>


                                        <div class="col">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                            <path fill="currentColor" d="M8 14q-.425 0-.712-.288T7 13t.288-.712T8 12t.713.288T9 13t-.288.713T8 14m4 0q-.425 0-.712-.288T11 13t.288-.712T12 12t.713.288T13 13t-.288.713T12 14m4 0q-.425 0-.712-.288T15 13t.288-.712T16 12t.713.288T17 13t-.288.713T16 14M5 22q-.825 0-1.412-.587T3 20V6q0-.825.588-1.412T5 4h1V2h2v2h8V2h2v2h1q.825 0 1.413.588T21 6v14q0 .825-.587 1.413T19 22zm0-2h14V10H5z" />
                                                        </svg></i> </span> Hasta
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
$start_at_q = isset($_GET["start_at"]) ? $_GET["start_at"] : "";
$finish_at_q = isset($_GET["finish_at"]) ? $_GET["finish_at"] : "";
$linea_accion_q = isset($_GET["linea_accion"]) ? $_GET["linea_accion"] : "";
$q = isset($_GET["q"]) ? $_GET["q"] : "";
$uid_q = isset($_GET["uid"]) ? $_GET["uid"] : "";
$estado_q = isset($_GET["estado"]) ? $_GET["estado"] : "";
$pag = isset($_GET["pag"]) ? $_GET["pag"] : "";
$code_info = isset($_GET["info_id"]) ? $_GET["info_id"] : "";
$info_id = "";


if ($code_info != "") {
    $code_info = trim(strtoupper($code_info));
    $conn = DatabasePg::connectPg();
    $row = $conn->prepare("SELECT * FROM infocentros WHERE upper(cod)='$code_info'");
    $row->execute();
    $data = $row->fetchAll(PDO::FETCH_ASSOC)[0];
    $info_id = isset($data["id"]) ? $data["id"] : "0";
}


$CantidadMostrar = 30;
$url_pag_atras = "";
$url_pag_adelante = "";

// Validado  la variable GET
$compag = (int)(!isset($_GET['pag']) || $_GET['pag'] == "") ? 1 : $_GET['pag'];

$user_region = $_SESSION['user_region'];
$user_id = $_SESSION['user_id'];

$date_ini = date_create($start_at_q);
$date_end = date_create($finish_at_q);
$start_at = $date_ini->format('Y-m-d');
$finish_at = $date_end->format('Y-m-d');

// $start_at = $_GET["start_at"];
// $finish_at = $_GET["finish_at"];

// echo $start_at ;
// echo $finish_at ;
// echo $_GET["start_at"] ;

$users = array();
if ((isset($_GET["q"]) || isset($_GET["estado"]) || isset($_GET["start_at"]) || isset($_GET["finish_at"]) || isset($_GET["uid"]) || isset($_GET["linea_accion"]) || isset($_GET["info_id"])) &&  ($q != "" || $_GET["estado"] != "" || $_GET["start_at"] != "" || $_GET["finish_at"] != "" || $uid_q != "" || $linea_accion_q != "" || $_GET["info_id"] != "")) {


    $sql = "SELECT * from reports where is_active='1' AND status_activity='0' AND ";
    $sql_dow = "SELECT * from reports where is_active='1' AND status_activity='0' AND ";


    if ($q != "") {
        $sql .= " (report_type like '%$q%' or activity_title like '%$q%' or line_action like '%$q%' or estate like '%$q%' or code_info='$q' or responsible_dni='$q') ";
        $sql_dow .= " (report_type like '%$q%' or activity_title like '%$q%' or line_action like '%$q%' or estate like '%$q%' or code_info='$q' or responsible_dni='$q') ";
    }

    if ($uid_q != "") {
        if ($q != "") {
            $sql .= ' and ';
            $sql_dow .= ' and ';
        }
        $sql .= " user_id='" . $uid_q . "'";
        $sql_dow .= " user_id='" . $uid_q . "'";
    }

    if ($code_info != "") {
        if ($_GET["q"] != "" || $_GET["uid"] != "") {
            $sql .= ' and ';
            $sql_dow .= ' and ';
        }
        $sql .= " reports.info_id='" . $info_id . "'";
        $sql_dow .= " reports.info_id='" . $info_id . "'";
    }

    if ($linea_accion_q != "") {
        if ($q != "" or $uid_q != "" or $code_info != "") {
            $sql .= ' and ';
            $sql_dow .= ' and ';
        }

        if ($_GET["linea_accion"] == "Participación digital" || $_GET["linea_accion"] == "Comunidades de participación digital") {
            $sql .= " (reports.line_action='Medios digitales' or reports.line_action='Tejiendo redes' or reports.line_action='Infocentro adentro' or reports.line_action='Sistematización de Experiencias' or reports.line_action='" . $_GET["linea_accion"] . "')";
            $sql_dow .= " (reports.line_action='Medios digitales' or reports.line_action='Tejiendo redes' or reports.line_action='Infocentro adentro' or reports.line_action='Sistematización de Experiencias' or reports.line_action='" . $_GET["linea_accion"] . "')";
        } else
        if ($_GET["linea_accion"] == "Comunidades de aprendizaje") {
            $sql .= " (reports.line_action='Formación a la medida' or reports.line_action='" . $_GET["linea_accion"] . "')";
            $sql_dow .= " (reports.line_action='Formación a la medida' or reports.line_action='" . $_GET["linea_accion"] . "')";
        } else
        if ($_GET["linea_accion"] == "Medios digitales") {
            $sql .= " (reports.line_action='Tejiendo redes' or reports.line_action='" . $_GET["linea_accion"] . "')";
            $sql_dow .= " (reports.line_action='Tejiendo redes' or reports.line_action='" . $_GET["linea_accion"] . "')";
        } else
        if ($_GET["linea_accion"] == "Acceso abierto") {
            $sql .= " (reports.line_action='Unidades socio-productivas' or reports.line_action='" . $_GET["linea_accion"] . "')";
            $sql_dow .= " (reports.line_action='Unidades socio-productivas' or reports.line_action='" . $_GET["linea_accion"] . "')";
        } else {
            $sql .= " (reports.line_action='" . $_GET["linea_accion"] . "')";
            $sql_dow .= " (reports.line_action='" . $_GET["linea_accion"] . "')";
        }

        // $sql .= " line_action='".$linea_accion_q."'";
        // $sql_dow .= " line_action='".$linea_accion_q."'";
    }

    if ($estado_q != "") {
        if ($_GET["q"] != "" or $uid_q != "" or $linea_accion_q != "" or $code_info != "") {
            $sql .= ' and ';
            $sql_dow .= ' and ';
        }
        $sql .= " estate='" . $estado_q . "'";
        $sql_dow .= " estate='" . $estado_q . "'";
    }




    if ($_GET["start_at"] != "" and $_GET["finish_at"] != "") {
        if ($_GET["q"] != "" or $linea_accion_q != "" or $_GET["estado"] != "" or $_GET["uid"] != "" or $code_info != "") {
            $sql .= " and ";
            $sql_dow .= " and ";
        }
        // $sql .= " date_ini >= TO_DATE('" . $start_at . "', 'DD-MM-YYYY') and date_ini <= TO_DATE('" . $finish_at . "', 'DD-MM-YYYY')";
        // $sql_dow .= " date_ini >= TO_DATE('" . $start_at . "', 'DD-MM-YYYY') and date_ini <= TO_DATE('" . $finish_at . "', 'DD-MM-YYYY')";
        $sql .= " date_ini BETWEEN '" . $start_at . "' and '" . $finish_at . "'";
        $sql_dow .= " date_ini BETWEEN '" . $start_at . "' and '" . $finish_at . "'";
    }

    if ($_GET["start_at"] != "" and $_GET["finish_at"] == "") {
        if ($_GET["q"] != "" or $linea_accion_q != "" or $_GET["estado"] != "" or $_GET["uid"] != "" or $code_info != "") {
            $sql .= ' and ';
            $sql_dow .= ' and ';
        }
        // $sql .= " date_ini >= TO_DATE('" . $start_at . "', 'DD-MM-YYYY')";
        // $sql_dow .= " date_ini >= TO_DATE('" . $start_at . "', 'DD-MM-YYYY')";
        $sql .= " date_ini >= '" . $start_at . "'";
        $sql_dow .= " date_ini >= '" . $start_at . "'";
    }



    if ($_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 9 || $_SESSION["user_type"] == 10) {
        $param = $sql;
    } else if ($_SESSION["user_type"] == 3 || $_SESSION["user_type"] == 8) {
        $param = $sql . " and estate='" . $user_region . "' ";
        $sql_dow = $sql_dow . " and estate='" . $user_region . "' ";
    } else {
        $param = $sql . " and user_id='" . $user_id . "' ";
        $sql_dow = $sql_dow . " and user_id='" . $user_id . "' ";
    }


    $conn = DatabasePg::connectPg();

    // $sql .= " AND";
    // $sql .= " reports.is_active='1' AND reports.status_activity='1' AND reports.estate!=''";
    // $sql .= " AND reports.date_ini between '2024-01-01' and '2024-12-31'";
    // $sql .= " group by " . $fields;
    // $sql .= " order by reports.datetime desc";
    // $sql_dw .= $sql;

    $stmt = $conn->prepare($param);
    $stmt->execute();
    $TotalReg = $stmt->rowCount();

    $param .= " order by date_ini desc LIMIT " . $CantidadMostrar . " OFFSET " . (($compag - 1) * $CantidadMostrar);
    $sql_dow .= " order by date_ini desc";

    $stmt = $conn->prepare($param);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $users = $data;




    // $total = ReportActivityData::getBySQL($param);
    // $TotalReg = count($total);

    // $users = ReportActivityData::getBySQL($param . " order by date_pub asc LIMIT " . (($compag - 1) * $CantidadMostrar) . " , " . $CantidadMostrar);

    // Asigna url de paginacion
    $url_pag = "<a href=\"?view=planning&linea_accion=" . $linea_accion_q . "&q=" . $q . "&info_id=" . $code_info . "&uid=" . $uid_q . "&estado=" . $estado_q . "&start_at=" . $start_at_q . "&finish_at=" . $finish_at_q . "&pag=";
    $url_edit = "linea_accion=" . $linea_accion_q . "&q=" . $q . "&info_id=" . $code_info . "&uid=" . $uid_q . "&estado=" . $estado_q . "&start_at=" . $start_at_q . "&finish_at=" . $finish_at_q;
    $_SESSION["location"] = "view=planning&" . $url_edit;

    // echo "XX".$sql;
    // echo $sql_dow;

    $param_csv = $param;
    $param_xlsx = $sql_dow;
    $param_sql = "true";
} else {
    // $users = InfoData::getAll();

    if ($_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 9 || $_SESSION["user_type"] == 10) {
        $sql = "SELECT * from reports WHERE is_active='1' and status_activity='0' order by datetime desc";
        $sql_dow = "SELECT * from reports WHERE is_active='1' and status_activity='0' order by datetime desc";
        // $sql_dow = "SELECT * from reports WHERE is_active='1' and status_activity='0'";
    } else if ($_SESSION["user_type"] == 3 || $_SESSION["user_type"] == 8) {
        $sql = "SELECT * from reports WHERE is_active='1' and status_activity='0' and estate='" . $user_region . "' order by datetime desc";
        $sql_dow = "SELECT * from reports WHERE is_active='1' and status_activity='0' and estate='" . $user_region . "' order by datetime desc";
        // $sql_dow = "SELECT * from reports WHERE is_active=1 and status_activity='0' and estate='" . $user_region . "' ";
    } else {
        $sql = "SELECT * from reports WHERE is_active='1' and status_activity='0' and user_id='" . $user_id . "' order by datetime desc";
        $sql_dow = "SELECT * from reports WHERE is_active='1' and status_activity='0' and user_id='" . $user_id . "' order by datetime desc";
        // $sql_dow = "SELECT * from reports WHERE is_active=1 and status_activity='0' and user_id='" . $user_id . "' ";
    }



    $conn = DatabasePg::connectPg();
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $TotalReg = $stmt->rowCount();

    $sql .= " LIMIT " . $CantidadMostrar . " OFFSET " . (($compag - 1) * $CantidadMostrar);

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $users = $data;


    // $users = ReportActivityData::getBySQL($sql);
    // $TotalReg = 0;

    $url_pag = "<a href=\"?view=planning&linea_accion=" . $linea_accion_q . "&q=" . $q . "&info_id=" . $code_info . "&uid=" . $uid_q . "&estado=" . $estado_q . "&start_at=" . $start_at_q . "&finish_at=" . $finish_at_q . "&pag=";
    $url_edit = "linea_accion=" . $linea_accion_q . "&q=" . $q . "&info_id=" . $code_info . "&uid=" . $uid_q . "&estado=" . $estado_q . "&start_at=" . $start_at_q . "&finish_at=" . $finish_at_q;
    $_SESSION["location"] = "view=planning&" . $url_edit;

    // echo $sql_dow;
    $param_csv = $sql_dow;
    $param_xlsx = $sql_dow;
    $param_sql = "true";
}


//Se divide la cantidad de registro de la BD con la cantidad a mostrar 
if ($TotalReg > 0) {
    $TotalRegistro  = ceil($TotalReg / $CantidadMostrar);
}
$DB_name = "reporte_planif";

// echo $param_csv;
?>


<?php if (count($users) == 0) { ?>
    <div class="col-md-12">
        <a href="./index.php?view=newplanning" class="btn btn-info"><i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M12 21q-1.875 0-3.512-.712t-2.85-1.925t-1.925-2.85T3 12t.713-3.512t1.924-2.85t2.85-1.925T12 3q2.05 0 3.888.875T19 6.35V4h2v6h-6V8h2.75q-1.025-1.4-2.525-2.2T12 5Q9.075 5 7.038 7.038T5 12t2.038 4.963T12 19q2.625 0 4.588-1.7T18.9 13h2.05q-.375 3.425-2.937 5.713T12 21m2.8-4.8L11 12.4V7h2v4.6l3.2 3.2z" />
                </svg></i> Programar actividad</a>

        <br>
        <br>
    </div>
<?php } ?>


<?php if (count($users) > 0) { ?>
    <!-- si hay usuarios -->

    <div class="col-md-12">
        <a href="./index.php?view=newplanning" class="btn btn-info">
            <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M12 21q-1.875 0-3.512-.712t-2.85-1.925t-1.925-2.85T3 12t.713-3.512t1.924-2.85t2.85-1.925T12 3q2.05 0 3.888.875T19 6.35V4h2v6h-6V8h2.75q-1.025-1.4-2.525-2.2T12 5Q9.075 5 7.038 7.038T5 12t2.038 4.963T12 19q2.625 0 4.588-1.7T18.9 13h2.05q-.375 3.425-2.937 5.713T12 21m2.8-4.8L11 12.4V7h2v4.6l3.2 3.2z" />
                </svg></i> Programar actividad</a>

        <a href="./pdf/csv_pdo.php?param_csv=<?php echo $param_csv . '&param_sql=' . $param_sql . '&DB_name=' . $DB_name; ?>" name="Descargar" class=" btn btn-success "><i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8zm1.8 18H14l-2-3.4l-2 3.4H8.2l2.9-4.5L8.2 11H10l2 3.4l2-3.4h1.8l-2.9 4.5zM13 9V3.5L18.5 9z" />
                </svg></i> CSV</a>
        <a target="_blank" class="btn btn-success" href="../core/app/view/exportxlsx_2.php?param=<?php echo $param_xlsx . '&param_sql=true&filename=' . $DB_name; ?>" name="Descargar"><i class="mt-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8zm1.8 18H14l-2-3.4l-2 3.4H8.2l2.9-4.5L8.2 11H10l2 3.4l2-3.4h1.8l-2.9 4.5zM13 9V3.5L18.5 9z" />
                </svg></i> XLSX</a>

        <?php if ($TotalReg > 0) { ?>
            <div class="form-group text_label">
                <?php echo "<span class='text_label'> <i><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24'><path fill='currentColor' d='M12 8H4a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h1v4a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-4h3l5 4V4zm9.5 4c0 1.71-.96 3.26-2.5 4V8c1.53.75 2.5 2.3 2.5 4'/></svg></i> <b> Hay " . $TotalReg . " Registros </b>. La cantidad se dividió a " . $TotalRegistro . " páginas para mostrar de " . $CantidadMostrar . " en " . $CantidadMostrar . "</span>" . "<br><br>"; ?>
            </div>
        <?php } ?>

    </div>



    <div class="col-md-12">

        <div class="card">
            <div class="card-content table-responsive">
                <div class="card-body">

                    <table class="table table-hover">


                        <!-- INONOS -->
                        <thead>
                            <th class="text_label priority_1"> <i class="icon_table"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M19 19H5V8h14m-3-7v2H8V1H6v2H5c-1.11 0-2 .89-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2h-1V1" />
                                    </svg></i></th>
                            <th class="text_label priority_2"> <i class="icon_table"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M10 20v-6h4v6h5v-8h3L12 3L2 12h3v8z" />
                                    </svg></i></th>
                            <th class="text_label priority_3"> <i class="icon_table"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="m15 19l-6-2.11V5l6 2.11M20.5 3h-.16L15 5.1L9 3L3.36 4.9c-.21.07-.36.25-.36.48V20.5a.5.5 0 0 0 .5.5c.05 0 .11 0 .16-.03L9 18.9l6 2.1l5.64-1.9c.21-.1.36-.25.36-.48V3.5a.5.5 0 0 0-.5-.5" />
                                    </svg></i></th>
                            <th class="text_label priority_2"> <i class="icon_table"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M15.9 18.45c1.35 0 2.45-1.1 2.45-2.45s-1.1-2.45-2.45-2.45c-1.36 0-2.45 1.1-2.45 2.45s1.09 2.45 2.45 2.45m5.2-1.77l1.48 1.16c.13.11.17.29.08.45l-1.4 2.42a.35.35 0 0 1-.43.15l-1.74-.7c-.36.28-.76.51-1.18.69l-.27 1.85c-.02.17-.17.3-.34.3h-2.8c-.18 0-.32-.13-.35-.3l-.26-1.85c-.43-.18-.82-.41-1.18-.69l-1.75.7c-.15.06-.34 0-.42-.15l-1.4-2.42a.35.35 0 0 1 .08-.45l1.48-1.16l-.05-.68l.05-.69l-1.48-1.15a.35.35 0 0 1-.08-.45l1.4-2.42c.08-.16.27-.22.42-.16l1.75.71c.36-.28.75-.52 1.18-.69l.26-1.86c.03-.16.17-.29.35-.29h2.8c.17 0 .32.13.34.29l.27 1.86c.42.17.82.41 1.18.69l1.74-.71c.17-.06.34 0 .43.16l1.4 2.42c.09.15.05.34-.08.45l-1.48 1.15l.05.69zM6.69 8.07c.87 0 1.57-.7 1.57-1.57s-.7-1.58-1.57-1.58A1.58 1.58 0 0 0 5.11 6.5c0 .87.71 1.57 1.58 1.57m3.34-1.13l.97.74c.07.07.09.19.03.29l-.9 1.56c-.05.1-.17.14-.27.1l-1.12-.45l-.74.44l-.19 1.19c-.02.11-.11.19-.22.19h-1.8c-.12 0-.21-.08-.23-.19L5.4 9.62l-.76-.44l-1.14.45c-.09.04-.2 0-.26-.1l-.9-1.56c-.06-.1-.03-.22.05-.29l.95-.74l-.03-.44l.03-.44l-.95-.74a.23.23 0 0 1-.05-.29l.9-1.56c.06-.1.17-.14.26-.1l1.13.45l.77-.44l.16-1.19c.02-.11.11-.19.23-.19h1.8c.11 0 .2.08.22.19L8 3.38l.74.44l1.12-.45c.1-.04.22 0 .27.1l.9 1.56c.06.1.04.22-.03.29l-.97.74l.03.44z" />
                                    </svg></i></th>
                            <th class="text_label priority_2" style="width: 200px;"> <i class="icon_table"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M20 3H4c-1.11 0-2 .89-2 2v14c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V5c0-1.11-.89-2-2-2M5 7h5v6H5zm14 10H5v-2h14zm0-4h-7v-2h7zm0-4h-7V7h7z" />
                                    </svg></i></th>
                            <th class="text_label"> <i class="icon_table"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M12 15.5A3.5 3.5 0 0 1 8.5 12A3.5 3.5 0 0 1 12 8.5a3.5 3.5 0 0 1 3.5 3.5a3.5 3.5 0 0 1-3.5 3.5m7.43-2.53c.04-.32.07-.64.07-.97s-.03-.66-.07-1l2.11-1.63c.19-.15.24-.42.12-.64l-2-3.46c-.12-.22-.39-.31-.61-.22l-2.49 1c-.52-.39-1.06-.73-1.69-.98l-.37-2.65A.506.506 0 0 0 14 2h-4c-.25 0-.46.18-.5.42l-.37 2.65c-.63.25-1.17.59-1.69.98l-2.49-1c-.22-.09-.49 0-.61.22l-2 3.46c-.13.22-.07.49.12.64L4.57 11c-.04.34-.07.67-.07 1s.03.65.07.97l-2.11 1.66c-.19.15-.25.42-.12.64l2 3.46c.12.22.39.3.61.22l2.49-1.01c.52.4 1.06.74 1.69.99l.37 2.65c.04.24.25.42.5.42h4c.25 0 .46-.18.5-.42l.37-2.65c.63-.26 1.17-.59 1.69-.99l2.49 1.01c.22.08.49 0 .61-.22l2-3.46c.12-.22.07-.49-.12-.64z" />
                                    </svg></i></th>
                        </thead>


                        <!-- TITULOS -->
                        <thead>
                            <th class="priority_1"> Fecha de actividad</th>
                            <th class="priority_2"> Infocentro</th>
                            <th class="priority_3"> Estado</th>
                            <th class="priority_2"> Línea de acción</th>
                            <th class="priority_2"> Título de la actividad</th>
                            <th>Acciones</th>
                        </thead>


                        <?php
                        $planning_line_action = "";
                        $ID = 0;

                        $imagen_p = "";
                        $titulo_p = "";
                        $code_info_p = "";
                        $admin_edit = 0;

                        foreach ($users as $user) {
                            $planning_line_action  = $user["line_action"];
                            $type = ($user["report_type"] != '') ? $user["report_type"] : '<font color="red">SELECCIONE</font>';
                            $specific = ($user["specific_action"] != '') ? $user["specific_action"] : '<font color="red">SELECCIONE</font>';
                            $training = ($user["training_type"] != '') ? $user["training_type"] : '<font color="red">-</font>';
                            $taller = ($user["tipo_taller"] != '') ? $user["tipo_taller"] : '<font color="red">Tipo de taller</font>';
                            if ($user["specific_action"] == "Formación en habilidades digitales") {
                                $data_activity = $planning_line_action . " % " . $type . " % " . $specific . " % " . $training . " % " . $taller;
                            } else {
                                $data_activity = $planning_line_action . " % " . $type . " % " . $specific . " % " . $training;
                            }

                            // admin_edit a otros
                            if ($_SESSION["user_id"] == $user["user_id"]) {
                                $admin_edit  = 1;
                            } else if ($_SESSION["user_id"] != $user["user_id"] && ($_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7 || $_SESSION["user_type"] == 8 || $_SESSION["user_type"] == 9)) {
                                $admin_edit  = 1;
                            } else {
                                $admin_edit  = 0;
                            }


                            // sacamos la fecha de inicio
                            $date_pub_end = explode("/", $user["date_pub"]);
                            if (count($date_pub_end) > 1) {
                                $date_pub = date("d/m/Y", strtotime($date_pub_end[0])) . " - " . date("d/m/Y", strtotime($date_pub_end[1]));
                            } else {
                                $date_pub = date("d/m/Y", strtotime($user["date_pub"]));
                            }


                        ?>



                            <tr>

                                <td class="priority_1 date_font"><?php echo $date_pub; ?></td>
                                <?php if ($user["user_id"] == $_SESSION["user_id"]) { ?>
                                    <td class="priority_2"><b style="color:deepskyblue;">PERSONAL</b><br><?php echo $user["code_info"] . " | " . $user["responsible_name"] . " | UID-" . $user["user_id"]; ?></td>
                                <?php } else { ?>
                                    <td class="priority_2"><?php echo $user["code_info"] . " | " . $user["responsible_name"] . " | UID-" . $user["user_id"]; ?></td>
                                <?php } ?>

                                <td class="priority_3"><?php echo $user["estate"]; ?></td>

                                <?php if ($user["line_action"] == "Infocentro adentro" || $user["line_action"] == "Participación digital" || $user["line_action"] == "Comunidades de participación digital") {
                                    echo '<td class="priority_2" style="color:#f75e05;">'; ?>
                                <?php } else if ($user["line_action"] == "Formación a la medida" || $user["line_action"] == "Comunidades de aprendizaje") {
                                    echo '<td class="priority_2" style="color:#f72acb;">'; ?>
                                <?php } else if ($user["line_action"] == "Tejiendo redes" || $user["line_action"] == "Medios digitales") {
                                    echo '<td class="priority_2" style="color:#005af5;">'; ?>
                                <?php } else if ($user["line_action"] == "Unidades socio-productivas" || $user["line_action"] == "Acceso abierto") {
                                    echo '<td class="priority_2" style="color:#02782f;">'; ?>
                                <?php } else if ($user["line_action"] == "Sistematización de Experiencias") {
                                    echo '<td class="priority_2" style="color:#bf0442;">'; ?>
                                <?php } else if ($user["line_action"] == "Comunas en Red Digital") {
                                    echo '<td class="priority_2" style="color:#866849FF;">'; ?>
                                <?php } else {
                                    echo '<td class="priority_2">';
                                } ?>

                                <?php if ($user["specific_action"] == "Formación en habilidades digitales") { ?>
                                    <?php echo $planning_line_action . " | " . $specific . " | " . $training . " <i><svg xmlns='http://www.w3.org/2000/svg' width='18' height='18' viewBox='0 0 24 24'><path fill='currentColor' d='M12 3L1 9l11 6l9-4.91V17h2V9M5 13.18v4L12 21l7-3.82v-4L12 17z'/></svg></i> > " . $taller; ?>
                                <?php } else if ($user["line_action"] == "Comunas en Red Digital") { ?>
                                    <?php echo $planning_line_action . " | " . $training . " <i><svg xmlns='http://www.w3.org/2000/svg' width='18' height='18' viewBox='0 0 24 24'><path fill='currentColor' d='M12 3L1 9l11 6l9-4.91V17h2V9M5 13.18v4L12 21l7-3.82v-4L12 17z'/></svg></i> > " . $taller; ?>
                                <?php } else { ?>
                                    <?php echo $planning_line_action . " | " . $specific; ?>
                                <?php } ?>

                                </td>

                                <td class="priority_2"><?php echo charlimit_title($user["activity_title"], 70); ?></td>

                                <td>

                                    <?php if ($_SESSION["user_type"] != 10) { ?>


                                        <?php if ($_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7) { ?>
                                            <a href="index.php?view=editplanning&user_id=<?php echo $user["user_id"]; ?>&id=<?php echo $user["id"]; ?>&code_info=<?php echo $user["code_info"]; ?>&estado=<?php echo $user["estate"]; ?>&participantes=<?php if (isset($_GET["participantes"])) {
                                                                                                                                                                                                                                                            echo $_GET["participantes"];
                                                                                                                                                                                                                                                        } ?>&start_at=<?php if (isset($_GET["start_at"])) {
                                                                                                                                                                                                                                                                            echo $_GET["start_at"];
                                                                                                                                                                                                                                                                        } ?>&finish_at=<?php if (isset($_GET["finish_at"])) {
                                                                                                                                                                                                                                                                                            echo $_GET["finish_at"];
                                                                                                                                                                                                                                                                                        } ?>&pag=<?php if (isset($_GET["pag"])) {
                                                                                                                                                                                                                                                                                                        echo $_GET["pag"];
                                                                                                                                                                                                                                                                                                    } ?>" type="button" rel="tooltip" class="btn btn-warning btn-sm"><i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                        <path fill="currentColor" d="M3 21v-4.25L16.2 3.575q.3-.275.663-.425t.762-.15t.775.15t.65.45L20.425 5q.3.275.438.65T21 6.4q0 .4-.137.763t-.438.662L7.25 21zM17.6 7.8L19 6.4L17.6 5l-1.4 1.4z" />
                                                    </svg></i></a>
                                            <?php $URL = "index.php?action=delplanning&id=" . $user["id"] . "&estado=" . $user["estate"] . "&start_at=" . $start_at_q . "&finish_at=" . $finish_at_q . "&pag=" . $pag . "&info_id=" . $info_id; ?>
                                            <button type="button" onclick="del_item('<?php echo $URL; ?>')" title="Eliminar" class="btn btn-danger btn-sm"><i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                        <path fill="currentColor" d="M19 4h-3.5l-1-1h-5l-1 1H5v2h14M6 19a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V7H6z" />
                                                    </svg></i></button></a>

                                            <a href="#" type="update_planning" id="<?php echo $ID; ?>" data-toggle="modal" data-target="#update_planning" class="btn btn-info btn-sm"><i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                        <path fill="currentColor" d="M12 21q-1.875 0-3.512-.712t-2.85-1.925t-1.925-2.85T3 12t.713-3.512t1.924-2.85t2.85-1.925T12 3q2.05 0 3.888.875T19 6.35V4h2v6h-6V8h2.75q-1.025-1.4-2.525-2.2T12 5Q9.075 5 7.038 7.038T5 12t2.038 4.963T12 19q2.625 0 4.588-1.7T18.9 13h2.05q-.375 3.425-2.937 5.713T12 21m2.8-4.8L11 12.4V7h2v4.6l3.2 3.2z" />
                                                    </svg></i></a>
                                            <?php if ($user["notific"] != "") { ?>
                                                <a href="#" type="show_notific" id="<?php echo $ID; ?>" data-toggle="modal" data-target="#show_notific" class="btn btn-success btn-sm"><i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                            <path fill="currentColor" d="M4 19v-2h2v-7q0-2.075 1.25-3.687T10.5 4.2v-.7q0-.625.438-1.062T12 2t1.063.438T13.5 3.5v.7q2 .5 3.25 2.113T18 10v7h2v2zm8 3q-.825 0-1.412-.587T10 20h4q0 .825-.587 1.413T12 22" />
                                                        </svg></i></a>
                                            <?php } ?>

                                        <?php } else if ($_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 5) { ?>
                                            <a href="index.php?view=editplanning&user_id=<?php echo $user["user_id"]; ?>&id=<?php echo $user["id"]; ?>&code_info=<?php echo $user["code_info"]; ?>&estado=<?php echo $user["estate"]; ?>&participantes=<?php if (isset($_GET["participantes"])) {
                                                                                                                                                                                                                                                            echo $_GET["participantes"];
                                                                                                                                                                                                                                                        } ?>&start_at=<?php if (isset($_GET["start_at"])) {
                                                                                                                                                                                                                                                                            echo $_GET["start_at"];
                                                                                                                                                                                                                                                                        } ?>&finish_at=<?php if (isset($_GET["finish_at"])) {
                                                                                                                                                                                                                                                                                            echo $_GET["finish_at"];
                                                                                                                                                                                                                                                                                        } ?>&pag=<?php if (isset($_GET["pag"])) {
                                                                                                                                                                                                                                                                                                        echo $_GET["pag"];
                                                                                                                                                                                                                                                                                                    } ?>" type="button" rel="tooltip" class="btn btn-warning btn-sm"><i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                        <path fill="currentColor" d="M3 21v-4.25L16.2 3.575q.3-.275.663-.425t.762-.15t.775.15t.65.45L20.425 5q.3.275.438.65T21 6.4q0 .4-.137.763t-.438.662L7.25 21zM17.6 7.8L19 6.4L17.6 5l-1.4 1.4z" />
                                                    </svg></i></a>
                                            <a href="#" type="update_planning" id="<?php echo $ID; ?>" data-toggle="modal" data-target="#update_planning" class="btn btn-info btn-sm"><i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                        <path fill="currentColor" d="M12 21q-1.875 0-3.512-.712t-2.85-1.925t-1.925-2.85T3 12t.713-3.512t1.924-2.85t2.85-1.925T12 3q2.05 0 3.888.875T19 6.35V4h2v6h-6V8h2.75q-1.025-1.4-2.525-2.2T12 5Q9.075 5 7.038 7.038T5 12t2.038 4.963T12 19q2.625 0 4.588-1.7T18.9 13h2.05q-.375 3.425-2.937 5.713T12 21m2.8-4.8L11 12.4V7h2v4.6l3.2 3.2z" />
                                                    </svg></i></a>
                                            <?php if ($user["notific"] != "") { ?>
                                                <a href="#" type="show_notific" id="<?php echo $ID; ?>" data-toggle="modal" data-target="#show_notific" class="btn btn-success btn-sm"><i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                            <path fill="currentColor" d="M4 19v-2h2v-7q0-2.075 1.25-3.687T10.5 4.2v-.7q0-.625.438-1.062T12 2t1.063.438T13.5 3.5v.7q2 .5 3.25 2.113T18 10v7h2v2zm8 3q-.825 0-1.412-.587T10 20h4q0 .825-.587 1.413T12 22" />
                                                        </svg></i></a>
                                            <?php } ?>
                                            <?php if ($user["user_id"] == $_SESSION["user_id"]) { ?>
                                                <?php $URL = "index.php?action=delplanning&id=" . $user["id"] . "&estado=" . $user["estate"] . "&participantes=" . "&start_at=" . $start_at_q . "&finish_at=" . $finish_at_q . "&pag=" . $pag . "&info_id=" . $info_id; ?>
                                                <button type="button" onclick="del_item('<?php echo $URL; ?>')" title="Eliminar" class="btn btn-danger btn-sm"><i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                            <path fill="currentColor" d="M6.4 19L5 17.6l5.6-5.6L5 6.4L6.4 5l5.6 5.6L17.6 5L19 6.4L13.4 12l5.6 5.6l-1.4 1.4l-5.6-5.6z" />
                                                        </svg></i></button></a>
                                            <?php } ?>


                                            <?php } else {
                                            if ($_SESSION["user_type"] == 8 && strtoupper($_SESSION["user_region"]) == strtoupper($user["estate"])) {
                                            ?>
                                                <a href="index.php?view=editplanning&user_id=<?php echo $user["user_id"]; ?>&id=<?php echo $user["id"]; ?>&code_info=<?php echo $user["code_info"]; ?>&estado=<?php echo $user["estate"]; ?>&participantes=<?php if (isset($_GET["participantes"])) {
                                                                                                                                                                                                                                                                echo $_GET["participantes"];
                                                                                                                                                                                                                                                            } ?>&start_at=<?php if (isset($_GET["start_at"])) {
                                                                                                                                                                                                                                                                                echo $_GET["start_at"];
                                                                                                                                                                                                                                                                            } ?>&finish_at=<?php if (isset($_GET["finish_at"])) {
                                                                                                                                                                                                                                                                                                echo $_GET["finish_at"];
                                                                                                                                                                                                                                                                                            } ?>&pag=<?php if (isset($_GET["pag"])) {
                                                                                                                                                                                                                                                                                                            echo $_GET["pag"];
                                                                                                                                                                                                                                                                                                        } ?>" type="button" rel="tooltip" class="btn btn-warning btn-sm"><i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                            <path fill="currentColor" d="M3 21v-4.25L16.2 3.575q.3-.275.663-.425t.762-.15t.775.15t.65.45L20.425 5q.3.275.438.65T21 6.4q0 .4-.137.763t-.438.662L7.25 21zM17.6 7.8L19 6.4L17.6 5l-1.4 1.4z" />
                                                        </svg></i></a>
                                                <?php $URL = "index.php?action=delplanning&id=" . $user["id"] . "&estado=" . $user["estate"] . "&participantes=" . "&start_at=" . $start_at_q . "&finish_at=" . $finish_at_q . "&pag=" . $pag . "&info_id=" . $info_id; ?>
                                                <button type="button" onclick="del_item('<?php echo $URL; ?>')" title="Eliminar" class="btn btn-danger btn-sm"><i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                            <path fill="currentColor" d="M6.4 19L5 17.6l5.6-5.6L5 6.4L6.4 5l5.6 5.6L17.6 5L19 6.4L13.4 12l5.6 5.6l-1.4 1.4l-5.6-5.6z" />
                                                        </svg></i></button></a>

                                                <a href="#" type="update_planning" id="<?php echo $ID; ?>" data-toggle="modal" data-target="#update_planning" class="btn btn-info btn-sm"><i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                            <path fill="currentColor" d="M12 21q-1.875 0-3.512-.712t-2.85-1.925t-1.925-2.85T3 12t.713-3.512t1.924-2.85t2.85-1.925T12 3q2.05 0 3.888.875T19 6.35V4h2v6h-6V8h2.75q-1.025-1.4-2.525-2.2T12 5Q9.075 5 7.038 7.038T5 12t2.038 4.963T12 19q2.625 0 4.588-1.7T18.9 13h2.05q-.375 3.425-2.937 5.713T12 21m2.8-4.8L11 12.4V7h2v4.6l3.2 3.2z" />
                                                        </svg></i></a>

                                                <?php if ($user["notific"] != "") { ?>
                                                    <a href="#" type="show_notific" id="<?php echo $ID; ?>" data-toggle="modal" data-target="#show_notific" class="btn btn-success btn-sm"><i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                                <path fill="currentColor" d="M4 19v-2h2v-7q0-2.075 1.25-3.687T10.5 4.2v-.7q0-.625.438-1.062T12 2t1.063.438T13.5 3.5v.7q2 .5 3.25 2.113T18 10v7h2v2zm8 3q-.825 0-1.412-.587T10 20h4q0 .825-.587 1.413T12 22" />
                                                            </svg></i></a>
                                                <?php } ?>

                                                <!-- edita monitor -->
                                            <?php } else if ($_SESSION["user_type"] == 3 && $_SESSION['user_rol'] == "Políticas públicas" && strtoupper($_SESSION["user_region"]) == strtoupper($user["estate"])) { ?>
                                                <a href="index.php?view=editplanning&user_id=<?php echo $user["user_id"]; ?>&id=<?php echo $user["id"]; ?>&code_info=<?php echo $user["code_info"]; ?>&estado=<?php echo $user["estate"]; ?>&participantes=<?php if (isset($_GET["participantes"])) {
                                                                                                                                                                                                                                                                echo $_GET["participantes"];
                                                                                                                                                                                                                                                            } ?>&start_at=<?php if (isset($_GET["start_at"])) {
                                                                                                                                                                                                                                                                                echo $_GET["start_at"];
                                                                                                                                                                                                                                                                            } ?>&finish_at=<?php if (isset($_GET["finish_at"])) {
                                                                                                                                                                                                                                                                                                echo $_GET["finish_at"];
                                                                                                                                                                                                                                                                                            } ?>&pag=<?php if (isset($_GET["pag"])) {
                                                                                                                                                                                                                                                                                                            echo $_GET["pag"];
                                                                                                                                                                                                                                                                                                        } ?>" type="button" rel="tooltip" class="btn btn-warning btn-sm"><i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                            <path fill="currentColor" d="M3 21v-4.25L16.2 3.575q.3-.275.663-.425t.762-.15t.775.15t.65.45L20.425 5q.3.275.438.65T21 6.4q0 .4-.137.763t-.438.662L7.25 21zM17.6 7.8L19 6.4L17.6 5l-1.4 1.4z" />
                                                        </svg></i></a>
                                                <?php $URL = "index.php?action=delplanning&id=" . $user["id"] . "&estado=" . $user["estate"] . "&participantes=" . "&start_at=" . $start_at_q . "&finish_at=" . $finish_at_q . "&pag=" . $pag . "&info_id=" . $info_id; ?>
                                                <button type="button" onclick="del_item('<?php echo $URL; ?>')" title="Eliminar" class="btn btn-danger btn-sm"><i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                            <path fill="currentColor" d="M6.4 19L5 17.6l5.6-5.6L5 6.4L6.4 5l5.6 5.6L17.6 5L19 6.4L13.4 12l5.6 5.6l-1.4 1.4l-5.6-5.6z" />
                                                        </svg></i></button></a>

                                                <a href="#" type="update_planning" id="<?php echo $ID; ?>" data-toggle="modal" data-target="#update_planning" class="btn btn-info btn-sm"><i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                            <path fill="currentColor" d="M12 21q-1.875 0-3.512-.712t-2.85-1.925t-1.925-2.85T3 12t.713-3.512t1.924-2.85t2.85-1.925T12 3q2.05 0 3.888.875T19 6.35V4h2v6h-6V8h2.75q-1.025-1.4-2.525-2.2T12 5Q9.075 5 7.038 7.038T5 12t2.038 4.963T12 19q2.625 0 4.588-1.7T18.9 13h2.05q-.375 3.425-2.937 5.713T12 21m2.8-4.8L11 12.4V7h2v4.6l3.2 3.2z" />
                                                        </svg></i></a>

                                                <?php if ($user["notific"] != "") { ?>
                                                    <a href="#" type="show_notific" id="<?php echo $ID; ?>" data-toggle="modal" data-target="#show_notific" class="btn btn-success btn-sm"><i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                                <path fill="currentColor" d="M4 19v-2h2v-7q0-2.075 1.25-3.687T10.5 4.2v-.7q0-.625.438-1.062T12 2t1.063.438T13.5 3.5v.7q2 .5 3.25 2.113T18 10v7h2v2zm8 3q-.825 0-1.412-.587T10 20h4q0 .825-.587 1.413T12 22" />
                                                            </svg></i></a>
                                                <?php } ?>


                                            <?php } else if ($_SESSION["user_id"] == $user["user_id"]) { ?>
                                                <a href="index.php?view=editplanning&user_id=<?php echo $user["user_id"]; ?>&id=<?php echo $user["id"]; ?>&code_info=<?php echo $user["code_info"]; ?>&estado=<?php echo $user["estate"]; ?>&participantes=<?php if (isset($_GET["participantes"])) {
                                                                                                                                                                                                                                                                echo $_GET["participantes"];
                                                                                                                                                                                                                                                            } ?>&start_at=<?php if (isset($_GET["start_at"])) {
                                                                                                                                                                                                                                                                                echo $_GET["start_at"];
                                                                                                                                                                                                                                                                            } ?>&finish_at=<?php if (isset($_GET["finish_at"])) {
                                                                                                                                                                                                                                                                                                echo $_GET["finish_at"];
                                                                                                                                                                                                                                                                                            } ?>&pag=<?php if (isset($_GET["pag"])) {
                                                                                                                                                                                                                                                                                                            echo $_GET["pag"];
                                                                                                                                                                                                                                                                                                        } ?>" type="button" rel="tooltip" class="btn btn-warning btn-sm"><i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                            <path fill="currentColor" d="M3 21v-4.25L16.2 3.575q.3-.275.663-.425t.762-.15t.775.15t.65.45L20.425 5q.3.275.438.65T21 6.4q0 .4-.137.763t-.438.662L7.25 21zM17.6 7.8L19 6.4L17.6 5l-1.4 1.4z" />
                                                        </svg></i></a>
                                                <?php $URL = "index.php?action=delplanning&id=" . $user["id"] . "&estado=" . $user["estate"] . "&participantes=" . "&start_at=" . $start_at_q . "&finish_at=" . $finish_at_q . "&pag=" . $pag . "&info_id=" . $info_id; ?>
                                                <button type="button" onclick="del_item('<?php echo $URL; ?>')" title="Eliminar" class="btn btn-danger btn-sm"><i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                            <path fill="currentColor" d="M6.4 19L5 17.6l5.6-5.6L5 6.4L6.4 5l5.6 5.6L17.6 5L19 6.4L13.4 12l5.6 5.6l-1.4 1.4l-5.6-5.6z" />
                                                        </svg></i></button></a>

                                                <a href="#" type="update_planning" id="<?php echo $ID; ?>" data-toggle="modal" data-target="#update_planning" class="btn btn-info btn-sm"><i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                            <path fill="currentColor" d="M12 21q-1.875 0-3.512-.712t-2.85-1.925t-1.925-2.85T3 12t.713-3.512t1.924-2.85t2.85-1.925T12 3q2.05 0 3.888.875T19 6.35V4h2v6h-6V8h2.75q-1.025-1.4-2.525-2.2T12 5Q9.075 5 7.038 7.038T5 12t2.038 4.963T12 19q2.625 0 4.588-1.7T18.9 13h2.05q-.375 3.425-2.937 5.713T12 21m2.8-4.8L11 12.4V7h2v4.6l3.2 3.2z" />
                                                        </svg></i></a>

                                                <?php if ($user["notific"] != "") { ?>
                                                    <a href="#" type="show_notific" id="<?php echo $ID; ?>" data-toggle="modal" data-target="#show_notific" class="btn btn-success btn-sm"><i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                                <path fill="currentColor" d="M4 19v-2h2v-7q0-2.075 1.25-3.687T10.5 4.2v-.7q0-.625.438-1.062T12 2t1.063.438T13.5 3.5v.7q2 .5 3.25 2.113T18 10v7h2v2zm8 3q-.825 0-1.412-.587T10 20h4q0 .825-.587 1.413T12 22" />
                                                            </svg></i></a>
                                                <?php } ?>

                                            <?php } ?>

                                        <?php } ?>
                                    <?php } ?>
                                </td>

                            </tr>


                            <!-- data preview -->
                            <p class="data" id="get_data">
                            <p class="admin_edit" id='<?php echo $admin_edit; ?>'></p>
                            <p class="user_id" id='<?php echo $user["user_id"]; ?>'></p>
                            <p class="id_activity" id='<?php echo $user["id"]; ?>'></p>
                            <p class="notific_var" id='<?php echo $user["notific"]; ?>'></p>
                            <p class="planning_line_action" id='<?php echo $planning_line_action; ?>'></p>
                            <p class="data_dimensiones" id='<?php echo $data_activity; ?>'></p>
                            <p class="contenido_des" id='<?php echo $user["developed_content"]; ?>'></p>
                            <p class="modalidad_formacion" id='<?php echo $user["training_modality"]; ?>'></p>
                            <p class="duracion_dias" id='<?php echo $user["duration_days"]; ?>'></p>
                            <p class="duracion_horas" id='<?php echo $user["duration_hour"]; ?>'></p>
                            <p class="status_activity" id='<?php echo $user["status_activity"]; ?>'></p>
                            <p class="activity_title" id='<?php echo $user["activity_title"]; ?>'></p>
                            <p class="date_pub_end" id='<?php echo date("Y-m-d", strtotime($date_pub_end[0])); ?>'></p>
                            <p class="responsible_dni" id='<?php echo $user["responsible_dni"]; ?>'></p>
                            <p class="code_info" id='<?php echo $user["code_info"]; ?>'></p>

                            <p class="responsible_name" id='<?php echo $user["responsible_name"]; ?>'></p>
                            <p class="user_state" id='<?php echo $user["estate"]; ?>'></p>
                            <p class="responsible_type" id='<?php echo $user["responsible_type"]; ?>'></p>
                            </p>



                        <?php
                            $ID += 1;
                        }
                        ?>


                    </table>


                <?php
            } else {
                echo "<p class='alert alert-danger'>No hay reportes</p>";

                $total_fem = 0;
                $total_mas = 0;
            }
                ?>

                </div>
            </div class="card-content table-responsive">
        </div>
    </div>



























    <?php if ($TotalReg > 0) { ?>


        <center>

            <?php

            /*Sector de Paginacion */

            //Operacion matematica para boton siguiente y atras 
            $IncrimentNum = (($compag + 1) <= $TotalRegistro) ? ($compag + 1) : 1;
            $DecrementNum = (($compag - 1)) < 1 ? 1 : ($compag - 1);

            echo $url_pag . $DecrementNum . "\" class=\"btn btn-info btn-sm\"> <i><svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' viewBox='0 0 24 24'><path fill='currentColor' d='M20 10v4h-9l3.5 3.5l-2.42 2.42L4.16 12l7.92-7.92L14.5 6.5L11 10z'/></svg></i> </a>";

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
            echo $url_pag . $IncrimentNum . "\" class=\"btn btn-info btn-sm\"> <i><svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' viewBox='0 0 24 24'><path fill='currentColor' d='M4 15V9h8V4.16L19.84 12L12 19.84V15z'/></svg></i> </a>";


            ?>

        </center>

    <?php } ?>








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

        .btn_preview {
            color: #FFFFFF;
            background: #ffffff00;
            box-shadow: none;
            padding: 0px 0px;
            margin: 0px 0px;
            border: none;
            opacity: 1;
        }


        .date_font {
            font-size: 14pt;
            /* font-family: 'fantasy'; */
            font-family: 'Poppins', sans-serif;
            line-height: 120%;
            color: ##585858;


            /* background: #000000;
    background: linear-gradient(to top, #000000 19%, #000000 55%, #8F8F8F 12%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent; */

        }








        .fullscreen-swal {
            z-index: 9999 !important;
            width: 100vw !important;
            height: 90vh !important;
        }

        .modal-header {
            background-color: rgb(237 237 237 / 90%);
        }




        @media screen and (max-width: 1225px) and (min-width: 1045px) {
            .priority_6 {
                display: none;
            }

            .priority_5 {
                display: none;
            }
        }

        @media screen and (max-width: 1044px) and (min-width: 835px) {
            .priority_6 {
                display: none;
            }

            .priority_5 {
                display: none;
            }

            .priority_4 {
                display: none;
            }

        }

        @media screen and (max-width: 834px) and (min-width: 300px) {

            .priority_6 {
                display: none;
            }

            .priority_5 {
                display: none;
            }

            .priority_4 {
                display: none;
            }

            .priority_3 {
                display: none;
            }
        }

        @media screen and (max-width: 299px) {
            .priority_6 {
                display: none;
            }

            .priority_5 {
                display: none;
            }

            .priority_4 {
                display: none;
            }

            .priority_3 {
                display: none;
            }

            .priority_2 {
                display: none;
            }

        }


        .swal2-popup {
            font-size: 1.0rem !important;
            font-family: Georgia, serif;
        }
    </style>