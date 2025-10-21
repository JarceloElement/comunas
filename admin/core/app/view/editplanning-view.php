<?php


if ($_SESSION['user_id'] == $_GET["user_id"] || ($_SESSION['user_region'] == $_GET['estado'] && $_SESSION['user_type'] == 8) || ($_SESSION['user_type'] == 5 || $_SESSION['user_type'] == 6 || $_SESSION['user_type'] == 7)) {


    $action_line = ActionsLineData::getAll();
    $estado = EstadoData::getAll();
    $municipio = MunicipioData::getAll();
    $ciudad = CiudadData::getAll();
    $parroquia = ParroquiaData::getAll();

    // $activity = PlanningActivityData::getById($_GET["id"]);
    $activity = ReportActivityData::getByIdPg($_GET["id"]);
    $responsible_type = ResponsibleTypeData::getAll();
    // $info = InfoData::getById($_GET["id"]);
    $info = InfoData::getByCode($_GET["code_info"]);
    // echo $info["estado"];
    // print_r($info);

    // $con = Database::getCon();
    // $query = $con->query("select * from report_date_limit");
    // $res = mysqli_fetch_array($query);
    // $fecha_ini = $res['date_limit_ini'];
    // $fecha_end = $res['date_limit_end'];

    if ($activity["image"] != "") {
        $image = explode(", ", $activity["image"]);
    }

?>

    <script>
        $(document).ready(function() {

            // toastify("¡Hola " + '<!?php echo $_SESSION['user_name']; ?>' + "! Te mostraré algunos cambios que se hicieron. \n\n 1. La edición de la (descripción y la dirección) de la actividad ahora se cargan automáticamente.\n 2. Se ha colocado un campo nuevo para cargar la (institución) con la que se generó la formación. \n 3. Debes cargar las instituciones en el (Mapa social). \n 4. La dirección que coloques en (cada institución del mapa) es la que se carga automáticamente en la actividad formativa. \n 5. Cuándo la gerencia habilite la edición en alguna actividad se te mostrará un aviso mientras editas los datos.\n\n Cerrar", true, 300000, "dashboard");

            // las func estan en demo.js
            if (getOS() == "Android") {
                get_Name = getOS() + "|" + getBrowser();
            } else {
                get_Name = getOS() + "|" + getBrowser();
            }



            // contar caracteres restantes
            var maxLength = 200;

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
            var tipo_taller = $("#tipo_taller").val();
            var institucion_formacion_v = $("#institucion_formacion").val();
            var circuito_comunal_v = $("#circuito_comunal").val();

            if (area != "") {
                $("#area_formativa_f").show();
            }
            if (tipo_taller != "") {
                $("#tipo_taller_f").show();
            }
            if (institucion_formacion_v != "") {
                $("#institucion_formacion_v").show();
            }
            if (circuito_comunal_v != "") {
                $("#circuito_comunal_v").show();
            }


            // restringir copy paste
            $("#nombre_act").on('paste', function(e) {
                e.preventDefault();
                if (getOS() != "Android") {
                    toastify("La opción pegar fue restringida para evitar los errores ortográficos", true, 20000, "warning");
                } else {
                    alert("La opción pegar fue restringida para evitar los errores ortográficos");
                }
            })
            $("#direccion").on('paste', function(e) {
                e.preventDefault();
                if (getOS() != "Android") {
                    toastify("La opción pegar fue restringida para evitar los errores ortográficos", true, 20000, "warning");
                } else {
                    alert("La opción pegar fue restringida para evitar los errores ortográficos");
                }
            })









            // alertas JS
            // alertjs("El nombre de usuario debe contener únicamente letras, numeros y guión bajo",true); // [message, autohide]
            // toastjs("No se pudo validar el recaptcha.\nPor favor intenta nuevamente",false); // [message, autohide]
            // toastify("El nombre de usuario debe contener únicamente letras, numeros y guión bajo",true,10000,"warning"); // [message, autohide]
            // setTimeout('window.location.href = "index.php?view=signup&swal="; ',5000);



            // cambiar el parametro de alert
            // const url = new URL(window.location);
            // url.searchParams.set('swal', '');
            // window.history.pushState({}, '', url);

        })




        // <!-- MODAL SWEET ALERT -->
        $(function() {
            <?php if (isset($_GET['swal']) && $_GET['swal'] != ""): ?>
                if (getOS() != "Android") {
                    Swal.fire({
                        // position: 'top-center',
                        icon: 'success',
                        title: '<?php echo $_GET['swal']; ?>',
                        <?php if (isset($_GET['ConfirmButton']) && $_GET['ConfirmButton'] == "true"): ?>
                            showConfirmButton: true,
                        <?php endif; ?>
                        <?php if (isset($_GET['ConfirmButton']) && $_GET['ConfirmButton'] == "false"): ?>
                            showConfirmButton: false,
                            timer: 1000
                        <?php endif; ?>

                    })
                } else {

                    alert("<?php echo $_GET['swal']; ?>");
                }
            <?php endif; ?>
        });


        // $(function() {


        // $('#duracion_horas').change(function(){
        //     alert(document.getElementById("duracion_horas").value);
        // });


        // });




        // VALIDAR FORMULARIO
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("activity").addEventListener('submit', validarFormulario);
        });

        function validarFormulario(evento) {
            evento.preventDefault();

            // check la fecha de cumplimiento de la actividad
            var data = $("#fecha").val().split("/")[0];
            const [date, month, year] = data.split('-');
            const isoStr = Date.parse(`${year}-${month}-${date}`);
            var dateObject = new Date(isoStr).toISOString().slice(0, 10);
            var today = new Date().toISOString().slice(0, 10);
            var status = $("#status_activity").val();

            if (status === '1' && dateObject > today) {
                if (getOS() == "Android") {
                    alert("La fecha de la actividad no se ha cumplido para cambiar de estatus");
                } else {
                    toastify('La fecha de la actividad no se ha cumplido para cambiar de estatus', true, 10000, "warning");
                }
                return;
            }


            mensaje = document.getElementById("nombre_act").value;
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
                return;
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
                return;
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





            // if (mobile) {
            // 	alert("El recaptcha es requerido");              
            // } else {
            // 	toastify("El recaptcha es requerido",true,10000,"warning"); // [message, autohide]
            // }
            // return;


            $('#cover-spin').show(0);
            this.submit();

        }




        $(function() {
            $('input[name="fecha"]').daterangepicker({
                opens: 'center',
                // startDate: moment(),
                // "endDate": "06/30/2023",
                minDate: moment().startOf('month'),
                locale: {
                    format: 'DD-MM-Y',
                    // format: 'Y-MM-DD',
                    separator: '/',
                    applyLabel: 'Aplicar',
                    cancelLabel: 'Cancelar',
                    fromLabel: 'Desde',
                    toLabel: 'hasta',
                    customRangeLabel: 'Custom',
                    daysOfWeek: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
                    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septimbre', 'Octubre', 'Noviembre', 'Diciembre'],
                    firstDay: 1
                }
            }, function(start, end, label) {
                console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
            });
        });
    </script>





    <div id="cover-spin"></div>






    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">

                        <div class="card-header card-header-primary">
                            <h4 class="title">Editar planificación</h4>
                            <!-- <p class="card-category">Complete your profile</p> -->
                        </div>


                        <br>
                        <div class="card-body">

                            <!-- <h5 class="title"> <i class='fa fa-bullhorn icon_label'></i> NOTA: Toda la información debe ser cargada respetando la ortografía, eso incluye el uso de mayúsculas.</h5> -->
                            <br>
                            <!-- <form class="form-horizontal" role="form" method="post" action="./?action=addreport" enctype="multipart/form-data"> -->
                            <form id="activity" class="form-horizontal" role="form" method="post" action="./?action=updateplanning&pag=<?php echo $_GET["pag"] ?>" enctype="multipart/form-data">
                                <input class="form-control" style="display:none" name="id" value="<?php echo $activity["id"]; ?>"></input>
                                <input type="hidden" name="user_id" id="user_id" value="<?php echo $_GET["user_id"]; ?>">
                                <input type="hidden" name="estado" id="estados_1" value="<?php echo $info->estado; ?>">
                                <input type="hidden" name="municipio" id="municipios_1" value="<?php echo $info->municipio; ?>">
                                <input type="hidden" name="parroquia" id="parroquias_1" value="<?php echo $info->parroquia; ?>">
                                <input type="hidden" name="ciudad" id="ciudades" value="<?php echo $info->ciudad; ?>">
                                <!-- <input type="hidden" name="fecha_limite_inicio" id="fecha_limite_inicio" value="<!?php echo $fecha_ini ?>"> -->
                                <!-- <input type="hidden" name="fecha_limite_final" id="fecha_limite_final" value="<!?php echo $fecha_end ?>"> -->
                                <input type="hidden" name="contenido_des" id="contenido_des" value="No aplica">
                                <input type="hidden" name="modalidad_formacion" id="modalidad_formacion" value="No aplica">
                                <input type="hidden" name="duracion_horas" id="duracion_horas" value="">
                                <input type="hidden" name="nivel_formacion" id="nivel_formacion" value="No aplica">
                                <input type="hidden" name="id_institucion" id="id_institucion" value="<?php echo $activity["id_institucion"]; ?>">
                                <input type="hidden" name="isnt_type" id="isnt_type" value="<?php echo $activity["isnt_type"]; ?>">


                                <div class="form-row">


                                    <!-- breadcrumb -->
                                    <div class="col-lg-12">
                                        <ol class="breadcrumb bg-dark text-white">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24">
                                                    <rect width="24" height="24" fill="none" />
                                                    <path fill="#fff" d="M15 20a1 1 0 0 0-1-1h-1v-2h4a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h4v2h-1a1 1 0 0 0-1 1H2v2h7a1 1 0 0 0 1 1h4a1 1 0 0 0 1-1h7v-2zm-6.75-9.92l1.16-1.16L11 10.5l3.59-3.58l1.16 1.41L11 13.08z" />
                                                </svg>
                                            </span>

                                            <li class="breadcrumb-item active" aria-current="page" style="font-size: 20px; padding-top:10px; color:#fff; padding-top: 10px;">Dimensiones</li>
                                        </ol>
                                        <br>
                                    </div>


                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="code_info" class=" control-label"><i class="fa fa-building"></i> Código infocentro</label>
                                            <br>
                                            <textarea style="text-transform: uppercase; font-size: 24px;background-color: aliceblue; border-radius: 5px; padding-left: 10px; line-height:1.0 !important; padding-top: 25px; padding-bottom: 0px;" class="form-control" name="code_info" placeholder="" id="code_info" oninput="javascript:this.value=this.value.replace(/ /g,'');" required><?php echo $activity["code_info"]; ?></textarea>
                                            <!-- <input name="estate" id="estate" value=""> -->
                                        </div>
                                    </div>




                                    <div class="col-lg-6">
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

                                    <div class="col-lg-6">
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


                                    <div class="col-lg-12" id="institucion_formacion_v" style="display: none;">
                                        <div class="form-group">
                                            <label for="institucion_formacion" class=" control-label"><i class="fa fa-building"></i> Institución vinculada a la formación (Se cargan en el Mapa Social)</label>
                                            <select name="institucion_formacion" class="form-control" id="institucion_formacion">
                                                <option value="<?php echo $activity["institucion_formacion"]; ?>"><?php echo $activity["institucion_formacion"]; ?></option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-12" id="circuito_comunal_v" style="display: none;">
                                        <div class="form-group">
                                            <label for="circuito_comunal" class=" control-label"><i class="fa fa-users"></i> Circuito comunal (Se cargan en el Mapa Social)</label>
                                            <select name="circuito_comunal" class="form-control" id="circuito_comunal">
                                                <option value="<?php echo $activity["circuito_comunal"]; ?>"><?php echo $activity["circuito_comunal"]; ?></option>
                                            </select>
                                        </div>
                                    </div>


                                    <!-- breadcrumb -->
                                    <div class="col-lg-12">
                                        <br>
                                        <ol class="breadcrumb bg-dark text-white">
                                            <span class="text-primary mr-1" style="font-size: 22px;">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24">
                                                    <rect width="24" height="24" fill="none" />
                                                    <path fill="#fff" d="M4 2h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2h-4l-4 4l-4-4H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2m1 3v2h14V5zm0 4v2h10V9zm0 4v2h12v-2z" />
                                                </svg>
                                            </span>
                                            <li class="breadcrumb-item active" aria-current="page" style="font-size: 20px; padding-top:10px; color:#fff; padding-top: 10px;">Descripción de la actividad</li>
                                        </ol>
                                        <br>
                                    </div>


                                    <!-- estatus -->
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="status_activity" class=" control-label"><i class="fa fa-exclamation-circle"></i> Estatus</label>
                                            <select name="status_activity" class="form-control" id="status_activity">
                                                <option value="<?php echo $activity["status_activity"]; ?>"><?php echo $activity["status_activity"] == 0 ? "Planificada" : ($activity["status_activity"] == 1 ? "Ejecutada" : "No ejecutada"); ?></option>
                                                <option value="0"> Planificada </option>
                                                <option value="1"> Ejecutada </option>
                                                <!-- <option value="2"> No ejecutada </option> -->
                                            </select>
                                        </div>
                                    </div>





                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="direccion" class=" control-label"><i class="fa fa-map-marker"></i> Dirección de la actividad</label>
                                            <br>
                                            <textarea type="text" style="border-radius: 5px; padding-left: 10px;" class="form-control bg-light" name="direccion" placeholder="Dirección" id="direccion" readonly required><?php echo $activity["address"]; ?></textarea>
                                            <span><label style="color:blueviolet;">Se carga automáticamente del infocentro o de la institución cargada en el Mapa social.</label></span>
                                        </div>
                                    </div>

                                    <!-- nombre de la actividad -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="nombre_act" class=" control-label"><i class="fa fa-newspaper-o"></i> Descripción de la actividad</label>
                                            <br>
                                            <textarea type="text" style="border-radius: 5px; padding-left: 10px;" class="form-control bg-light" name="nombre_act" placeholder="Nombre" id="nombre_act" maxlength="200" readonly required><?php echo $activity["activity_title"]; ?></textarea>
                                            <span id="descripcion_act" style="display: none;"><label style="color:blueviolet;" id="textLength">Se carga automáticamente de la línea de acción. Si está vacío contacte a soporte InfoApp.</label></span>
                                            <span id="descripcion_act_1" style="display: none;"><label style="color:blueviolet;" id="textLength">Describa de manera resumida solo la descripción. Max 200 carácteres.</label></span>
                                        </div>
                                    </div>





                                    <!-- breadcrumb -->
                                    <div class="col-lg-12">
                                        <br>
                                        <ol class="breadcrumb bg-dark text-white">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24">
                                                    <rect width="24" height="24" fill="none" />
                                                    <path fill="#fff" d="M22.86 17.74c-.09.11-.21.17-.33.2l-1.87.36l1.29 2.84c.16.29.02.65-.28.79l-2.14 1.01c-.09.06-.17.06-.26.06c-.22 0-.43-.12-.53-.34l-1.29-2.83l-1.49 1.21a.593.593 0 0 1-.96-.47V11.6c0-.33.26-.6.59-.6c.15 0 .29.05.41.13l6.77 5.76c.27.23.3.61.09.85M12 15v-5H7v5zm7-12h-1V1h-2v2H8V1H6v2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h8v-2H5V8h14v3.06l2 1.7V5c0-1.1-.9-2-2-2" />
                                                </svg>
                                            </span>
                                            <li class="breadcrumb-item active" aria-current="page" style="font-size: 20px; padding-top:10px; color:#fff; padding-top: 10px;">Fecha de la actividad</li>
                                        </ol>
                                        <br>
                                    </div>



                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="fecha" class=" control-label"><i class="fa fa-calendar"></i> Fecha de la actividad</label>
                                            <input type="text" name="fecha" value="<?php echo $activity["date_pub"]; ?>" required class="form-control" id="fecha" placeholder="Fecha">
                                        </div>
                                    </div>



                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="hour_activity_ini" class=" control-label"><i class="fa fa-clock-o"></i> Hora de inicio</label>
                                            <input type="time" name="hour_activity_ini" value="<?php echo explode("/", $activity["hour_activity"])[0]; ?>" required class="form-control" id="hour_activity_ini" placeholder="Hora">
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="hour_activity_end" class=" control-label"><i class="fa fa-clock-o"></i> Hora de culminación</label>
                                            <input type="time" name="hour_activity_end" value="<?php echo explode("/", $activity["hour_activity"])[1]; ?>" required class="form-control" id="hour_activity_end" placeholder="Hora">
                                        </div>
                                    </div>



                                    <!-- duracion act -->
                                    <div class="col-md-12">
                                        <div style="display: none" class="form-group" id="div_duracion_dias">
                                            <label for="duracion_dias" class=" control-label"><i class="fa fa-hourglass-half"></i> Duración días</label>
                                            <input type="number" class="form-control" value="<?php echo $activity["duration_days"]; ?>" name="duracion_dias" placeholder="Días" id="duracion_dias">
                                            <p class="help-block" style="color:gray;">Días impartiendo formación</p>
                                        </div>
                                    </div>



                                    <!-- breadcrumb -->
                                    <div class="col-lg-12">
                                        <br>
                                        <ol class="breadcrumb bg-dark text-white">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24">
                                                    <rect width="24" height="24" fill="none" />
                                                    <path fill="#fff" d="M20 2H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h4l4 4l4-4h4a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2m-8 2.3c1.5 0 2.7 1.2 2.7 2.7S13.5 9.7 12 9.7S9.3 8.5 9.3 7s1.2-2.7 2.7-2.7M18 15H6v-.9c0-2 4-3.1 6-3.1s6 1.1 6 3.1z" />
                                                </svg>
                                            </span>
                                            <li class="breadcrumb-item active" aria-current="page" style="font-size: 20px; padding-top:10px; color:#fff; padding-top: 10px;">Responsable de la actividad</li>
                                        </ol>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="organized_by_info" class=" control-label"><i class="fa fa-building"></i> Actividad organizada por infocentro</label>
                                            <select name="organized_by_info" class="form-control" id="organized_by_info" required>
                                                <option value="<?php echo $activity["organized_by_info"]; ?>"><?php echo $activity["organized_by_info"]; ?></option>
                                                <option value="SI">SI</option>
                                                <option value="NO">NO</option>
                                            </select>
                                        </div>
                                    </div>


                                    <!-- responsible_type -->
                                    <div class="col-md-8">
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




                                    <div class="col-md-4">
                                        <br>
                                        <div class="form-group">
                                            <label for="responsable_name" class=" control-label"><i class="fa fa-user"></i> Buscar Responsable</label>

                                            <div class="input-group">
                                                <input type="text" class="form-control" name="buscar_responsable" placeholder="Nombre o cédula" id="b_responsable">
                                                <span class="input-group-btn">
                                                    <button type="button" onclick="codigoAJAX()" class="btn btn-fab btn-round btn-primary">
                                                        <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                                <path fill="currentColor" d="m19.6 21l-6.3-6.3q-.75.6-1.725.95T9.5 16q-2.725 0-4.612-1.888T3 9.5t1.888-4.612T9.5 3t4.613 1.888T16 9.5q0 1.1-.35 2.075T14.7 13.3l6.3 6.3zM9.5 14q1.875 0 3.188-1.312T14 9.5t-1.312-3.187T9.5 5T6.313 6.313T5 9.5t1.313 3.188T9.5 14" />
                                                            </svg></i>
                                                    </button>
                                                </span>
                                            </div>
                                        </div>

                                    </div>

                                    <!-- name_responsable -->
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="responsable_name" class=" control-label"><i class="fa fa-user"></i> Responsable de actividad</label>
                                            <input type="text" class="form-control" value="<?php echo $activity["responsible_name"]; ?>" name="responsable_name" placeholder="Nombre" id="responsable_name" required></input>
                                        </div>
                                    </div>




                                    <!-- dni -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="responsible_dni" class=" control-label"><i class="fa fa-credit-card"></i> Cédula del responsable</label>
                                            <input type="text" class="form-control" value="<?php echo $activity["responsible_dni"]; ?>" name="responsible_dni" placeholder="Número" id="responsible_dni" required minlength="6" maxlength="8" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);if (this.value < 0) this.value = '',alert('El DNI no es válido');">
                                        </div>
                                    </div>



                                    <!-- tel_responsable -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="responsable_tel" class=" control-label"><i class="fa fa-phone"></i> Teléfono del Responsable</label>
                                            <input type="tel" class="form-control" value="<?php echo $activity["responsible_phone"]; ?>" name="responsable_tel" id="responsable_tel" placeholder="0416-1234567" required maxlength="12" list="list_code" pattern="[0-9]{4}-[0-9]{7}">
                                        </div>
                                    </div>


                                    <!-- correo_responsable -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="responsible_email" class=" control-label"><i class="fa fa-envelope"></i> Correo del Responsable</label>
                                            <input type="email" class="form-control" value="<?php echo $activity["responsible_email"]; ?>" name="responsible_email" placeholder="Correo" id="responsible_email" value="demo@gmail.com" required>
                                        </div>
                                    </div>




                                    <!-- breadcrumb -->
                                    <div class="col-lg-12">
                                        <br>
                                        <ol class="breadcrumb bg-dark text-white">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24">
                                                    <rect width="24" height="24" fill="none" />
                                                    <path fill="#fff" d="M16 13a.26.26 0 0 0-.26.21l-.19 1.32c-.3.13-.59.29-.85.47l-1.24-.5c-.11 0-.24 0-.31.13l-1 1.73c-.06.11-.04.24.06.32l1.06.82a4.2 4.2 0 0 0 0 1l-1.06.82a.26.26 0 0 0-.06.32l1 1.73c.06.13.19.13.31.13l1.24-.5c.26.18.54.35.85.47l.19 1.32c.02.12.12.21.26.21h2c.11 0 .22-.09.24-.21l.19-1.32c.3-.13.57-.29.84-.47l1.23.5c.13 0 .26 0 .33-.13l1-1.73a.26.26 0 0 0-.06-.32l-1.07-.82c.02-.17.04-.33.04-.5s-.01-.33-.04-.5l1.06-.82a.26.26 0 0 0 .06-.32l-1-1.73c-.06-.13-.19-.13-.32-.13l-1.23.5c-.27-.18-.54-.35-.85-.47l-.19-1.32A.236.236 0 0 0 18 13zm1 3.5c.83 0 1.5.67 1.5 1.5s-.67 1.5-1.5 1.5c-.84 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5m-1-5.42V3H2v18h6v-3.5h2.03c.23-3.3 2.74-5.96 5.97-6.42M6 19H4v-2h2zm0-4H4v-2h2zm0-4H4V9h2zm0-4H4V5h2zm6-2h2v2h-2zm0 4h2v2h-2zm-2 6H8v-2h2zm0-4H8V9h2zM8 7V5h2v2z" />
                                                </svg>
                                            </span>
                                            <li class="breadcrumb-item active" aria-current="page" style="font-size: 20px; padding-top:10px; color:#fff; padding-top: 10px;">Datos de vinculación</li>
                                        </ol>
                                        <br>
                                    </div>


                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="instituciones" class=" control-label"><i class="fa fa-building"></i> Organización Comunitaria presente</label>
                                            <input type="text" class="form-control" value="<?php echo $activity["institutions"]; ?>" name="instituciones" placeholder="Nombres" id="instituciones" value="Infocentro" required></input>
                                        </div>
                                    </div>




                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="observacion" class=" control-label"><i class="fa fa-warning"></i> Observación</label>
                                            <input class="form-control" value="<?php echo $activity["observations"]; ?>" name="observacion" placeholder="Nota" id="observacion"></input>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <button type="submit" id="add_activity" class="btn btn-default"><i class="fa fa-check"></i> Guardar cambios</button>
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





    <!-- <?php
            $a = "Hola Mundo!";
            ?>

<script type="text/javascript"> alert( "<!?php echo $a; ?>" ); </script>
 -->




    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.0/jquery.min.js"></script> -->

    <!-- <script src="../../../assets/js/jquery.min.js"></script> -->
    <script language="javascript">
        var maxLength = 200;

        $(document).ready(function() {
            // ASIGNA EL SISTEMA
            $("#name_os").val(get_Name);


            // contar caracteres restantes
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
                $('#accion_especifica').find('option').remove().end().append('<option value=""></option>').val('0');
                $('#area_formativa').find('option').remove().end().append('<option value=""></option>').val('0');
                $('#tipo_taller').find('option').remove().end().append('<option value=""></option>').val('0');
                $('#institucion_formacion').find('option').remove().end().append('<option value=""></option>').val('0');
                $('#circuito_comunal').find('option').remove().end().append('<option value=""></option>').val('0');

                $("#linea_accion option:selected").each(function() {
                    $('#cover-spin').show(0);
                    line_acc = $(this).val();
                    code_info = document.getElementById("code_info").value;
                    // console.log(line_acc);
                    $.post("core/app/view/getDimention.php", {
                        line_acc: line_acc,
                        code_info: code_info
                    }, function(data) {
                        // console.log(data);
                        var array = JSON.parse(data);
                        $("#tipo_reporte").html(array["html"]);

                        if (array["total"] == 1) {
                            $("#tipo_reporte").trigger("change");
                        }
                        $('#cover-spin').hide(0);
                    });

                });
            })

            // recargar
            $("#tipo_reporte").change(function() {
                $('#accion_especifica').find('option').remove().end().append('<option value=""></option>').val('0');
                $("#tipo_reporte option:selected").each(function() {
                    $('#cover-spin').show(0);
                    line_acc = $(this).val();
                    code_info = document.getElementById("code_info").value;
                    // console.log($("#accion_especifica").val());
                    $.post("core/app/view/get_specific_action.php", {
                        line_acc: line_acc,
                        code_info: code_info
                    }, function(data) {
                        var array = JSON.parse(data);
                        $("#accion_especifica").html(array["html"]);
                        // console.log(data);

                        if (array["total"] == 1) {
                            $("#accion_especifica").trigger("change");
                        }

                        $('#cover-spin').hide(0);
                    });

                });
            })



            $("#accion_especifica").change(function() {
                $("#accion_especifica option:selected").each(function() {
                    line_acc = $(this).val();
                    has_formation = $(this).data('formation');
                    activity_description = $(this).data('description');
                    document.getElementById("nombre_act").value = activity_description;
                    // console.log(activity_description);


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
                            // console.log(data);
                            var array = JSON.parse(data);
                            // console.log(array["name_training_type"]);
                            $("#area_formativa").html(array["html"]);
                            $("#tipo_taller").find('option').remove();
                            $("#tipo_taller_f").hide();

                            $("#institucion_formacion_v").hide();
                            $("#institucion_formacion").find('option').remove();

                            $('#cover-spin').hide(0);

                            if (array["total"] == 1) {
                                $("#area_formativa").trigger("change");
                            }

                        });

                    } else {
                        $("#area_formativa_f").hide();
                        document.getElementById("area_formativa").required = false;
                        document.getElementsByName('area_formativa')[0].options[0].value = "No aplica";

                        $("#tipo_taller_f").hide();
                        document.getElementById("tipo_taller").required = false;
                        document.getElementsByName('tipo_taller')[0].options[0].value = "No aplica";

                        $("#institucion_formacion_v").hide();
                        document.getElementById("institucion_formacion").required = false;
                        document.getElementsByName('institucion_formacion')[0].options[0].value = "No aplica";


                        // console.log(document.getElementsByName('nivel_formacion')[0].options[0]);
                        // console.log(line_acc);

                        return;
                    }

                    // console.log($("#area_formativa").val());
                    // console.log(line_acc);


                });
            })


            $("#area_formativa").change(function() {
                var estado_info = document.getElementById("estados_1").value;
                var code_info = document.getElementById("code_info").value;

                if (code_info == "") {
                    alert("Debes asignar el código del infocentro primero");
                    return;
                }

                $("#tipo_taller_f").show();
                document.getElementById("tipo_taller").required = true;
                document.getElementById("institucion_formacion").required = true;

                $('#tipo_taller').find('option').remove().end().append('<option value=""></option>').val('0');
                $("#area_formativa option:selected").each(function() {
                    $('#cover-spin').show(0);
                    categoria = $(this).val();
                    dat_description = $(this).data('description');
                    var code_info = document.getElementById("code_info").value;

                    // carga la descripcion de la actividad
                    set_description = $(this).data('set_description');
                    set_institucion = $(this).data('set_institucion');
                    // console.log(set_institucion);

                    if (set_description == "1" || dat_description == "") {

                        document.getElementById("nombre_act").readOnly = false;
                        document.getElementById("nombre_act").value = "";
                        // las func estan en demo.js
                        if (getOS() == "Android") {
                            toastify("Se ha habilitado la descripción de la actividad para ésta área formativa", true, 10000, "warning");
                            // alert("Se ha habilitado la descripción de la actividad para ésta área formativa");
                        } else {
                            toastify("Se ha habilitado la descripción de la actividad para ésta área formativa", true, 10000, "warning");
                        }
                        document.getElementById('textLength').innerHTML = 'Describa de manera resumida solo la descripción. Restan ' + maxLength + ' carácteres.';
                        $("#descripcion_act_1").show();
                        $("#descripcion_act").hide();

                    } else {
                        document.getElementById("nombre_act").readOnly = true;
                        activity_description = $(this).data('description');
                        document.getElementById("nombre_act").value = activity_description;
                        $("#descripcion_act_1").hide();
                        $("#descripcion_act").show();
                    }


                    // tipo de taller
                    $.post("core/app/view/get_tipo_taller.php", {
                        categoria: categoria,
                        code_info: code_info
                    }, function(data) {
                        var array = JSON.parse(data);
                        // console.log(array["total"]);
                        $("#tipo_taller").html(array["html"]);
                        $('#cover-spin').hide(0);

                    });

                    // instituciones
                    // carga los infocentros de la region
                    if (set_institucion == "1") {
                        var estado_info = document.getElementById("estados_1").value;
                        $.post("core/app/view/get_info_region.php", {
                            estado_info: estado_info,
                        }, function(data) {
                            var array = JSON.parse(data);
                            $("#institucion_formacion").html(array["html"]);
                            $("#circuito_comunal").html(array["html"]);
                            $('#cover-spin').hide(0);
                            $("#institucion_formacion_v").show();

                            if ($("#linea_accion").val() == "Comunas en Red Digital") {
                                $("#circuito_comunal_v").show();
                                document.getElementById("circuito_comunal").required = true;
                            } else {
                                document.getElementById("circuito_comunal").required = false;
                            }
                        });
                    }
                    // carga las instituciones del mapa social
                    if (set_institucion == "0") {
                        var estado_info = document.getElementById("estados_1").value;
                        $.post("core/app/view/get_instituciones.php", {
                            code_info: code_info,
                            estado_info: estado_info
                        }, function(data) {
                            var array = JSON.parse(data);
                            $("#institucion_formacion").html(array["html"]);
                            $("#circuito_comunal").html(array["html"]);
                            $('#cover-spin').hide(0);
                            $("#institucion_formacion_v").show();

                            if ($("#linea_accion").val() == "Comunas en Red Digital") {
                                $("#circuito_comunal_v").show();
                                document.getElementById("circuito_comunal").required = true;
                            } else {
                                document.getElementById("circuito_comunal").required = false;
                            }
                        });
                    }


                });
            })


            $("#tipo_taller").change(function() {
                // $('#nivel_formacion').find('option').remove().end().append('<option value=""></option>').val('0');
                $("#tipo_taller option:selected").each(function() {
                    area_formativa = $("#area_formativa").val();
                    tipo_taller = $(this).val();
                    descripcion_taller = $(this).data('descripcion_taller');
                    // console.log(tipo_taller);

                    if (descripcion_taller != "") {
                        document.getElementById("nombre_act").value = descripcion_taller;
                        toastify("Se ha asignado la descripción del taller seleccionado", true, 10000, "dashboard");
                    }

                    // datos del taller
                    $.post("core/app/view/get_datos_taller.php", {
                        area_formativa: area_formativa,
                        tipo_taller: tipo_taller

                    }, function(data) {
                        var array = JSON.parse(data);
                        // console.log(array);
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


            $("#institucion_formacion").change(function() {
                // $('#nivel_formacion').find('option').remove().end().append('<option value=""></option>').val('0');
                $("#institucion_formacion option:selected").each(function() {
                    institucion = $(this).val();
                    if (institucion == "" || institucion == "null" || institucion == null) {
                        toastify("Debes ingresar una institución válida. Por favor ingresa al mapa social y registra la institución.", true, 10000, "warning");
                        $("#institucion_formacion").value = "";
                        return;
                    }
                    direccion = $(this).data("e_address");
                    id_institucion = $(this).data("id_institucion");
                    isnt_type = $(this).data("isnt_type");
                    // console.log(id_institucion);
                    if (direccion == "" || direccion == "null" || direccion == null) {
                        toastify("AVISO: La institución seleccionada no tiene dirección. Por favor ingresa al (Mapa Social) y edita la institución. \nSi no puedes editar el Mapa social solicita a un facilitador que lo haga.", true, 10000, "warning");
                        $("#direccion").val("");
                        $("#id_institucion").val(id_institucion);
                        $("#isnt_type").val(isnt_type);
                        document.getElementById("direccion").required = true;
                    } else {
                        toastify("Se ha asignado la dirección de la institución seleccionada", true, 5000, "dashboard");
                        $("#direccion").val(direccion);
                        $("#id_institucion").val(id_institucion);
                        $("#isnt_type").val(isnt_type);
                        document.getElementById("direccion").readOnly = true;
                    }
                });
            })




            // validar telefono
            var numbers = /^[0-9_-]+$/;
            var valida = /^\d{4}-\d{7}$/;
            $("#responsable_tel").on("keyup", function() {
                var tel = $(this).val();

                if (tel.length > 0) {

                    // solo numeros y guiones
                    if (tel.match(numbers)) {
                        // 
                    } else {
                        alert("¡En el campo teléfono solo se aceptan números!");
                        document.getElementById("responsable_tel").focus();
                        document.getElementById("responsable_tel").value = tel.substring(0, tel.length - 1);
                    }
                    // colocar y quitar guion
                    if (tel.length > 4 && !tel.includes("-")) {
                        document.getElementById("responsable_tel").value = tel.slice(0, 4) + "-" + (tel).slice(4);
                    } else if (tel.length == 5) {
                        document.getElementById("responsable_tel").value = tel.replace("-", "");
                    }

                } else {
                    document.getElementById("responsable_tel").value = ""
                }
            });


        });



        // CARGA DATOS DEL RESPONSABLE CON AJAX Y RETARDO AL ESCRIBIR
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
            estado = document.getElementById("estados_1").value;
            que = document.getElementById("b_responsable").value;
            // que = que.replace(/\./g,''); reemplaza puntos por nada
            // console.log(code)
            ;
            responsable_tipo = document.getElementById("responsable_tipo").value;

            if (code == "") {
                alert("Debes asignar el código del infocentro primero");
                return;
            }

            // alert(responsable_tipo);
            if (responsable_tipo === "Facilitador") {
                $.post("core/app/view/getResponsible-view.php", {
                    search: que,
                    info_cod: code,
                    estado: estado
                }, function(data) {
                    // console.log(data);
                    var array = JSON.parse(data);
                    if (array["error"] === "true") {
                        alert(array["message"]);
                        return;
                    }
                    toastify(array["message"], true, 20000, "warning");
                    $("#responsable_name").val(array["nombre"]);
                    $("#responsable_tel").val(array["telefono"]);
                    $("#responsible_dni").val(array["dni"]);
                    $("#responsible_email").val(array["email"]);
                    $("#personal_type").val(array["personal_type"]);
                    // $("#parroquias_1").val(array["parroquia"]);
                    // alert(array["responsible_dni"]);

                });
            }
            if (responsable_tipo === "Coordinador" || responsable_tipo === "Jefe de Estado") {
                $.post("core/app/view/getResponsible_coord-view.php", {
                    search: que,
                    info_cod: code,
                    estado: estado
                }, function(data) {
                    // console.log(data);
                    var array = JSON.parse(data);
                    // alert(array["nombre"]);
                    toastify(array["message"], true, 20000, "warning");
                    $("#responsable_name").val(array["nombre"]);
                    $("#responsable_tel").val(array["telefono"]);
                    $("#responsible_dni").val(array["dni"]);
                    $("#responsible_email").val(array["email"]);
                    $("#personal_type").val(array["personal_type"]);
                    // $("#parroquias_1").val(array["parroquia"]);

                });
            }
            if (responsable_tipo != "Facilitador" && responsable_tipo != "Coordinador" && responsable_tipo != "Jefe de Estado") {
                $.post("core/app/view/getResponsible_ger-view.php", {
                    search: que,
                    info_cod: code,
                    estado: estado
                }, function(data) {
                    var array = JSON.parse(data);
                    // alert(array["telefono"]);
                    $("#responsable_name").val(array["nombre"]);
                    $("#responsable_tel").val(array["telefono"]);
                    $("#responsible_dni").val(array["dni"]);
                    $("#responsible_email").val(array["email"]);
                    $("#personal_type").val(array["personal_type"]);
                    // $("#parroquias_1").val(array["parroquia"]);

                });
            }

        }
        // =======================




        // CARGA DATOS DEL INFOCENTRO CON AJAX
        $(function() {
            $("#code_info").change(function() {
                code = $(this).val();
                // alert(code);
                $('#cover-spin').show(0);
                $.post("core/app/view/getReportLocation-view.php", {
                    code_info: code
                }, function(data) {
                    var array = JSON.parse(data);
                    if (array === null) {
                        document.getElementById("code_info").value = "";
                        alert("No existe un infocentro con el código: " + code);

                    } else {
                        // $("#estate").val(array["estado"]);
                        // alert(array["estado"]);
                        $("#estados_1").val(array["estado"]);
                        $("#municipios_1").val(array["municipio"]);
                        $("#parroquias_1").val(array["parroquia"]);
                        $("#ciudades").val(array["ciudad"]);

                        toastify("Se ha cargado el código ( " + code.toUpperCase() + " ) correctamente", true, 5000, "dashboard");

                    }
                });

                $('#tipo_reporte').find('option').remove().end().append('<option value=""></option>').val('0');
                $('#accion_especifica').find('option').remove().end().append('<option value=""></option>').val('0');
                $('#area_formativa').find('option').remove().end().append('<option value=""></option>').val('0');
                $('#tipo_taller').find('option').remove().end().append('<option value=""></option>').val('0');
                $('#institucion_formacion').find('option').remove().end().append('<option value=""></option>').val('0');

                $('#cover-spin').show(0);
                $.post("core/app/view/getActionLine.php", {
                    code_info: code
                }, function(data) {
                    // console.log(data);
                    var array = JSON.parse(data);
                    $("#linea_accion").html(array["html"]);
                    $('#cover-spin').hide(0);
                });

            });
        });







        // FECHA LIMITE DE LA ACTIVIDAD
        $(function() {
            // fecha_limite_inicio = document.getElementById("fecha_limite_inicio").value;
            // fecha_limite_final = document.getElementById("fecha_limite_final").value;
            // const f = new Date("2018/01/30");
            // alert(f);

            // $('#fecha').change(function(){
            //     var value = $(this).val();
            //         // alert(value);

            //     if (Date.parse(value)<Date.parse(fecha_limite_inicio) || Date.parse(value)>Date.parse(fecha_limite_final)){
            //         Swal.fire({
            //         // position: 'top-center',
            //         icon: 'warning',
            //         title: 'La fecha límite de reportes es del: \n'+fecha_limite_inicio+" al "+fecha_limite_final,
            //         showConfirmButton: true,
            //         // timer: 1500
            //         })

            //         document.getElementById("fecha").value = "";
            //     }
            //     else{

            //     }
            // });
        })








        // $(function(){

        //     $('#linea_accion').change(function(){
        //         var value = $(this).val();
        //         // alert(value);

        //         // limpiar el select
        //         const $select = document.querySelector("#tipo_reporte");
        //         for (let i = $select.options.length; i >= 0; i--) {
        //             $select.remove(i);
        //         }

        //         if (value=='Infocentro adentro'){
        //             $('#tipo_reporte').append($('<option>').val('Jorna de atención social').text('Jornada de atención social'));
        //             $('#tipo_reporte').append($('<option>').val('Comunal').text('Comunal'));
        //             $('#tipo_reporte').append($('<option>').val('Político').text('Político'));
        //             $('#tipo_reporte').append($('<option>').val('Infocentro como plataforma de apoyo').text('Infocentro como plataforma de apoyo'));
        //             $('#tipo_reporte').append($('<option>').val('Organización interna de infocentro').text('Organización interna de infocentro'));
        //             $('#tipo_reporte').append($('<option>').val('Mantenimiento').text('Mantenimiento'));
        //             $('#tipo_reporte').append($('<option>').val('Movilización').text('Movilización'));
        //             $('#tipo_reporte').append($('<option>').val('Jornada de limpieza voluntaria al infocentro').text('Jornada de limpieza voluntaria al infocentro'));
        //             $('#tipo_reporte').append($('<option>').val('Soporte').text('Soporte'));
        //             $('#tipo_reporte').append($('<option>').val('Vinculación').text('Vinculación'));
        //         }

        //         if (value=='Formación a la medida'){
        //             $('#tipo_reporte').append($('<option>').val('Formación').text('Formación'));
        //         }

        //         if (value=='Tejiendo redes'){
        //             $('#tipo_reporte').append($('<option>').val('Prácticas de comunicación popular').text('Prácticas de comunicación popular'));
        //         }

        //         if (value=='Unidades socio-productivas'){
        //             $('#tipo_reporte').append($('<option>').val('Producción sustentable').text('Producción sustentable'));
        //         }

        //         if (value=='Sistematización de Experiencias'){
        //             $('#tipo_reporte').append($('<option>').val('Experiencias significativas').text('Experiencias significativas'));
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




        // preview uploaded image

        $("#image").change(function() {
            filePreview(this);
        });

        function filePreview(input) {

            // TAMANYO DE LA IMAGEN
            if (input.files[0].size > 10000000) {
                Swal.fire({
                    // position: 'top-center',
                    icon: 'warning',
                    title: 'La imagen:\n ' + '"' + input.files[0].name + '"' + ' \nNo debe exceder 10MB de peso',
                    showConfirmButton: true,
                    // timer: 1500
                })
            }

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

            // TAMANYO DE LA IMAGEN
            if (input.files[0].size > 10000000) {
                Swal.fire({
                    icon: 'warning',
                    title: 'La imagen:\n ' + '"' + input.files[0].name + '"' + ' \nNo debe exceder 10MB de peso',
                    showConfirmButton: true,
                    // timer: 1500
                })
            }

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

            // TAMANYO DE LA IMAGEN
            if (input.files[0].size > 10000000) {
                Swal.fire({
                    icon: 'warning',
                    title: 'La imagen:\n ' + '"' + input.files[0].name + '"' + ' \nNo debe exceder 10MB de peso',
                    showConfirmButton: true,
                    // timer: 1500
                })
            }

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
                document.getElementById("direccion").focus();
            } else if (result == '1') {
                // todo minusculas
                if (getOS() == "Android") {
                    alert("ERROR: Por favor revisa la ortografía, no debe estar todo en minúscula.");
                } else {
                    toastify("ERROR: Por favor revisa la ortografía, no debe estar todo en minúscula.", true, 20000, "error"); // [message, autohide]
                }
                document.getElementById("direccion").focus();
            } else if (result == '2') {
                // mayusculas
                if (getOS() == "Android") {
                    alert("ERROR: Por favor revisa la ortografía, no debe estar todo en mayúsculas.");
                } else {
                    toastify("ERROR: Por favor revisa la ortografía, no debe estar todo en mayúsculas.", true, 20000, "error"); // [message, autohide]
                }
                document.getElementById("direccion").focus();
            } else if (result == '3') {
                // mayusculas y minusculas
                if (getOS() == "Android") {
                    alert("AVISO: Tienes textos en mayusculas, asegúrate que su uso sea correcto antes de enviar.");
                } else {
                    toastify("AVISO: Tienes textos en mayusculas, asegúrate que su uso sea correcto antes de enviar.", true, 20000, "warning"); // [message, autohide]
                }
                // document.getElementById("direccion").focus();
            } else {
                // console.log('El mensaje no incluye letras');
            }
        });


        // $("#direccion").click(function() {
        //     if (getOS() == "Android") {
        //         toastify('¡AVISO! Aquí se describe la (ubicación) de la actividad, por favor no lo coloque en el campo (Descripción de la actividad).', true, 150000, "warning");
        //     } else {
        //         toastify('¡AVISO! Aquí se describe la (ubicación) de la actividad, por favor no lo coloque en el campo (Descripción de la actividad).', true, 150000, "warning");
        //     }
        // });


        // $("#nombre_act").click(function() {
        //     if (getOS() == "Android") {
        //         toastify('¡AVISO! En este campo se coloca solo la descripción de la actividad, la (ubicación) se coloca en el campo (Dirección de la actividad).', true, 150000, "warning");
        //     } else {
        //         toastify('¡AVISO! En este campo se coloca solo la descripción de la actividad, la (ubicación) se coloca en el campo (Dirección de la actividad).', true, 150000, "warning");
        //     }
        // });




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



<?php

} else {
    print "<script>window.location='../index.php';</script>";
    exit;
}

?>