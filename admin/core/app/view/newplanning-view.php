<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// 
$action_line = ActionsLineData::getAll();
$estado = EstadoData::getAll();
$municipio = MunicipioData::getAll();
$ciudad = CiudadData::getAll();
$parroquia = ParroquiaData::getAll();
$responsible_type = ResponsibleTypeData::getAll();


// $lineas = ActionsLineData::getNameById(5);
// foreach($lineas as $p):
//     echo($linea_name = $p['line_name']);
//     // echo($p->line_name);

// endforeach;

$location = "index.php?view=planning&q=&estado=&participantes=&start_at=&finish_at=";

// $con = Database::getCon();
// $query = $con->query("select * from report_date_limit");
// $res = mysqli_fetch_array($query);
// $fecha_ini = $res['date_limit_ini'];
// $fecha_end = $res['date_limit_end'];

$fecha_ini = "2025-01-01";
$fecha_end = "2025-01-01";

// $code_info = trim(strtoupper('ama05'));
// $sql = "SELECT * FROM infocentros WHERE cod='$code_info'";
// $data = ExecutorPg::get($sql)[0][0];
// echo count($data);

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

        $("#area_formativa_f").hide();
        $("#nivel_formacion_f").hide();




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


    })


    // $("#bloquear").on('copy', function(e){
    //     e.preventDefault();
    //     alert('Esta acción está prohibida');
    // })



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
                    <?php if (!isset($_GET['ConfirmButton']) || $_GET['ConfirmButton'] == "false"): ?>
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


    $(function() {
        $('input[name="fecha"]').daterangepicker({
            // opens: 'center',
            startDate: moment(),
            // "endDate": "06/30/2023",
            // minDate: moment().add(10, 'days').calendar(),
            // maxDate: moment().add(60, 'days').calendar(),
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
            // console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
            // var data = start+" 00:00:00";
            // var today = new Date();
            // var dateObject = new Date(Date.parse(data));

            // if (today.getMonth()+1 > start.format('MM')){
            //     if (getOS() == "Android"){
            //         alert("Aviso: No es posible planificar actividades de meses pasados");
            //     }else {
            //         toastify('Aviso: No es posible planificar actividades de meses pasados',true,15000,"error");
            //         //change the selected date range of that picker
            //         // $('#fecha').data('daterangepicker').setStartDate('11/22/2023');
            //         // $('#fecha').data('daterangepicker').setEndDate('11/22/2023');

            //     }
            //     return;
            // }

        });
    });






    // comparar horas
    $(function() {


        const startTime = document.getElementById("hour_activity_ini");
        const endTime = document.getElementById("hour_activity_end");

        endTime.addEventListener("input", () => {
                comparaHoras(startTime.value, endTime.value);
            },
            false,
        );


    });








    // VALIDAR FORMULARIO
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("activity").addEventListener('submit', validarFormulario);
    });


    function validarFormulario(evento) {
        evento.preventDefault();
        mensaje = document.getElementById("nombre_act").value;
        fecha = document.getElementById("fecha").value;
        estado = document.getElementById("estados_1").value;
        direccion = document.getElementById("direccion").value;


        if (direccion === "") {
            toastify("AVISO: La institución seleccionada no tiene dirección. Por favor ingresa al (Mapa Social) y edita la institución. \nSi no puedes editar el Mapa social solicita a un facilitador que lo haga.", true, 10000, "warning");
            return;
        }

        if (fecha === "") {
            alert("La fecha es requerida");
            document.getElementById("fecha").focus();
            return;
        }

        if (estado === "") {
            alert("No se cargó el estado, vuelve a escribir el código");
            // document.getElementById("fecha").focus();
            return;
        }

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




        $('#cover-spin').show(0);
        this.submit();
    }
</script>


<div id="cover-spin"></div>



<!-- Modal-->
<div class="modal" id="modal_line" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">


            <div class="modal-header">
                <h4 class="title_preview">Nuevas dimensiones</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>


            <div class="modal-body fullscreen" id="modal-body">

                <?php
                $sql = "SELECT * from strategic_action order by line_action desc";
				$param = StrategicActionData::getObj($sql);
                ?>

                <div class="card-content table-responsive">
                    <div class="card-body">

                        <?php if (count($param) > 0) { ?>
                            <!-- si hay usuarios -->

                            <table class="table table-bordered table-hover">
                                <thead>
                                    <th><b>Línea de acción</b></th>
                                    <th><b>Acción estratégica</b></th>
                                </thead>

                                <?php foreach ($param as $user) { ?>
                                    <tr>

                                        </td>
                                        <?php if ($user->line_action == "Infocentro adentro" || $user->line_action == "Participación digital" || $user->line_action == "Comunidades de participación digital") {
                                            echo '<td class="priority_5" style="color:#f75e05;">'; ?>
                                        <?php } else if ($user->line_action == "Formación a la medida" || $user->line_action == "Comunidades de aprendizaje") {
                                            echo '<td class="priority_5" style="color:#f72acb;">'; ?>
                                        <?php } else if ($user->line_action == "Tejiendo redes" || $user->line_action == "Medios digitales") {
                                            echo '<td class="priority_5" style="color:#005af5;">'; ?>
                                        <?php } else if ($user->line_action == "Unidades socio-productivas" || $user->line_action == "Acceso abierto") {
                                            echo '<td class="priority_5" style="color:#02782f;">'; ?>
                                        <?php } else {
                                            echo '<td class="priority_5">';
                                        } ?>
                                        <?php echo $user->line_action; ?></td>

                                        <td><?php echo $user->name_action; ?></td>
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

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
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
                        <h4 class="title">Programar actividad</h4>
                        <!-- <p class="card-category">Complete your profile</p> -->
                    </div>


                    <br>
                    <div class="card-body">

                        <div class="col-md-6">
                            <a href="#" data-toggle="modal" data-target="#modal_line" class="btn btn-info btn-round"><i><svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="m18.525 9l-1.1-2.4l-2.4-1.1l2.4-1.1l1.1-2.4l1.1 2.4l2.4 1.1l-2.4 1.1l-1.1 2.4Zm2 7l-.8-1.7l-1.7-.8l1.7-.8l.8-1.7l.8 1.7l1.7.8l-1.7.8l-.8 1.7Zm-13 6l-.3-2.35q-.2-.075-.387-.2t-.313-.25l-2.2.95l-2.5-4.35l1.9-1.4v-.8l-1.9-1.4l2.5-4.35l2.2.95q.125-.125.313-.25t.387-.2l.3-2.35h5l.3 2.35q.2.075.388.2t.312.25l2.2-.95l2.5 4.35l-1.9 1.4v.8l1.9 1.4l-2.5 4.35l-2.2-.95q-.125.125-.312.25t-.388.2l-.3 2.35h-5Zm2.5-5q1.25 0 2.125-.875T13.025 14q0-1.25-.875-2.125T10.025 11q-1.25 0-2.125.875T7.025 14q0 1.25.875 2.125t2.125.875Z" />
                                    </svg></i>Ver líneas de acción</a>
                        </div>
                        <br>


                        <h5 class="title"> <i class='fa fa-bullhorn icon_label'></i> NOTA: Toda la información debe ser cargada respetando la ortografía, eso incluye el uso de mayúsculas.</h5>


                        <br>
                        <!-- <form class="form-horizontal" role="form" method="post" action="./?action=addreport" enctype="multipart/form-data"> -->
                        <form id="activity" class="form-horizontal" role="form" method="post" action="./?action=addplanning&location=<?php echo $location ?>" enctype="multipart/form-data">
                            <input type="hidden" name="name_os" id="name_os" value="">
                            <input type="hidden" name="info_id" id="info_id" value="">
                            <input type="hidden" name="estado" id="estados_1" value="AAAA">
                            <input type="hidden" name="municipio" id="municipios_1" value="">
                            <input type="hidden" name="parroquia" id="parroquias_1" value="">
                            <input type="hidden" name="ciudad" id="ciudades" value="">
                            <input type="hidden" name="personal_type" id="personal_type" value="">
                            <input type="hidden" name="fecha_limite_inicio" id="fecha_limite_inicio" value="<?php echo $fecha_ini ?>">
                            <input type="hidden" name="fecha_limite_final" id="fecha_limite_final" value="<?php echo $fecha_end ?>">

                            <input type="hidden" name="contenido_des" id="contenido_des" value="No aplica">
                            <input type="hidden" name="modalidad_formacion" id="modalidad_formacion" value="No aplica">
                            <input type="hidden" name="duracion_dias" id="duracion_dias" value="">
                            <input type="hidden" name="duracion_horas" id="duracion_horas" value="">
                            <input type="hidden" name="nivel_formacion" id="nivel_formacion" value="No aplica">
                            <input type="hidden" name="id_institucion" id="id_institucion" value="No aplica">
                            <input type="hidden" name="isnt_type" id="isnt_type" value="No aplica">




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
                                        <textarea style="text-transform: uppercase; font-size: 24px;background-color: aliceblue; border-radius: 5px; padding-left: 10px; line-height:1.0 !important; padding-top: 25px; padding-bottom: 0px;" class="form-control" name="code_info" placeholder="" id="code_info" oninput="javascript:this.value=this.value.replace(/ /g,'');" required></textarea>
                                        <!-- <input name="estate" id="estate" value=""> -->
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="linea_accion" class=" control-label"><i class="fa fa-cogs"></i> Linea de acción</label>
                                        <select name="linea_accion" class="form-control" id="linea_accion" required>
                                            <option value="">-- LINEA DE ACCIÓN --</option>
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
                                            <option value="">-- ACCIÓN ESTRATEGICA --</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="accion_especifica" class=" control-label"><i class="fa fa-reorder"></i> Acción específica</label>
                                        <select name="accion_especifica" class="form-control" id="accion_especifica" required>
                                            <option value="">-- ACCIÓN ESPECIFICA --</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6" id="area_formativa_f" style="display: none;">
                                    <div class="form-group">
                                        <label for="area_formativa" class=" control-label"><i class="fa fa-graduation-cap"></i> Área formativa</label>
                                        <select name="area_formativa" class="form-control" id="area_formativa">
                                            <option value="">-- AREA FORMATIVA --</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6" id="tipo_taller_f" style="display: none;">
                                    <div class="form-group">
                                        <label for="tipo_taller" class=" control-label"><i class="fa fa-graduation-cap"></i> Tipo de taller</label>
                                        <select name="tipo_taller" class="form-control" id="tipo_taller">
                                            <option value="">-- TALLER --</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-12" id="institucion_formacion_v" style="display: none;">
                                    <div class="form-group">
                                        <label for="institucion_formacion" class=" control-label"><i class="fa fa-building"></i> Institución vinculada a la formación (Se cargan en el Mapa Social)</label>
                                        <select name="institucion_formacion" class="form-control" id="institucion_formacion">
                                            <option value="No aplica">-- INSTITUCIONES --</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-12" id="circuito_comunal_v" style="display: none;">
                                    <div class="form-group">
                                        <label for="circuito_comunal" class=" control-label"><i class="fa fa-users"></i> Circuito comunal (Se cargan en el Mapa Social)</label>
                                        <select name="circuito_comunal" class="form-control" id="circuito_comunal">
                                            <option value="No aplica">-- INSTITUCIONES --</option>
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






                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="direccion" class=" control-label"><i class="fa fa-map-marker"></i> Dirección de la actividad</label>
                                        <br>
                                        <textarea style="border-radius: 5px; padding-left: 10px;" class="form-control bg-light" name="direccion" placeholder="" id="direccion" required readonly></textarea>
                                        <span><label style="color:blueviolet;">Se carga automáticamente del infocentro o de la institución cargada en el Mapa social.</label></span>
                                    </div>
                                    <br>
                                </div>


                                <!-- nombre de la actividad -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="nombre_act" class=" control-label"><i class="fa fa-newspaper-o"></i> Descripción de la actividad</label>
                                        <br>
                                        <textarea style="border-radius: 5px; padding-left: 10px;" class="form-control bg-light" name="nombre_act" placeholder="" id="nombre_act" maxlength="200" required readonly></textarea>
                                        <span id="descripcion_act" style="display: none;"><label style="color:blueviolet;">Se carga automáticamente de la línea de acción. Si está vacío contacte a soporte InfoApp.</label></span>
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
                                        <input type="text" name="fecha" required class="form-control" id="fecha" placeholder="Fecha">
                                    </div>
                                </div>



                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="hour_activity_ini" class=" control-label"><i class="fa fa-clock-o"></i> Hora de inicio</label>
                                        <input type="time" min="05:00" max="24:00" step="600" value="08:00" name="hour_activity_ini" required class="form-control" id="hour_activity_ini" placeholder="Hora">
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="hour_activity_end" class=" control-label"><i class="fa fa-clock-o"></i> Hora de culminación</label>
                                        <input type="time" min="05:00" max="24:00" step="600" value="09:00" name="hour_activity_end" required class="form-control" id="hour_activity_end" placeholder="Hora">
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
                                        <label for="organized_by_info" class=" control-label"><i class="fa fa-user-plus"></i> Actividad organizada por infocentro</label>
                                        <select name="organized_by_info" class="form-control" id="organized_by_info" required>
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
                                            <!-- <option value="">-- TIPO --</option> -->
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
                                    <br>
                                    <div class="form-group">
                                        <label for="responsable_name" class=" control-label"><i class="fa fa-user"></i> Nombre del responsable</label>
                                        <input type="text" class="form-control" name="responsable_name" placeholder="Nombre" id="responsable_name" required></input>
                                    </div>
                                </div>




                                <!-- dni -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="responsible_dni" class=" control-label"><i class="fa fa-address-card"></i> Cédula del responsable</label>
                                        <input type="text" class="form-control" name="responsible_dni" placeholder="Número" id="responsible_dni" required minlength="6" maxlength="8" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);if (this.value < 0) this.value = '',alert('El DNI no es válido');">
                                    </div>
                                </div>



                                <!-- tel_responsable -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="responsable_tel" class=" control-label"><i class="fa fa-phone"></i> Teléfono del Responsable</label>
                                        <input type="tel" class="form-control" name="responsable_tel" id="responsable_tel" placeholder="0416-1234567" required maxlength="12" list="list_code" pattern="[0-9]{4}-[0-9]{7}">
                                    </div>
                                </div>


                                <!-- correo_responsable -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="responsible_email" class=" control-label"><i class="fa fa-envelope"></i> Correo del Responsable</label>
                                        <input type="email" class="form-control" name="responsible_email" placeholder="Correo" id="responsible_email" value="demo@gmail.com" required>
                                    </div>
                                    <br>
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
                                        <label for="instituciones" class=" control-label"><i class="fa fa-building"></i> Organización Comunitaria presente (Agregue separados con comas)</label>
                                        <input type="text" class="form-control" name="instituciones" placeholder="Nombres" id="instituciones" value="Infocentro" required></input>
                                    </div>
                                </div>




                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="observacion" class=" control-label"><i class="fa fa-warning"></i> Observación</label>
                                        <textarea class="form-control" name="observacion" placeholder="Nota" id="observacion"></textarea>
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
                                        <button type="submit" id="add_activity" class="btn btn-default"><i class="fa fa-check"></i> Agregar actividad</button>
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
    var maxLength = 200;

    $(document).ready(function() {
        // limite de fecha para crear reportes
        // $("#fecha").change(function () {
        //     var date_pub_end = document.getElementById("fecha").value;
        //     var data = date_pub_end+" 00:00:00";
        //     var today = new Date();
        //     var dateObject = new Date(Date.parse(data));

        //     console.log(today,"---",dateObject);
        // })



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




        // ASIGNA EL SISTEMA
        $("#name_os").val(get_Name);


    });



    // carga nuevas dimensiones
    $(document).ready(function() {

        $("#linea_accion").change(function() {
            $('#tipo_reporte').find('option').remove().end().append('<option value=""></option>').val('0');
            $('#accion_especifica').find('option').remove().end().append('<option value=""></option>').val('0');
            $('#area_formativa').find('option').remove().end().append('<option value=""></option>').val('0');
            $('#tipo_taller').find('option').remove().end().append('<option value=""></option>').val('0');
            $('#institucion_formacion').find('option').remove().end().append('<option value=""></option>').val('0');

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
                        $("#circuito_comunal_v").hide();
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
                    $("#circuito_comunal_v").hide();
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
                // console.log(categoria);

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
                    // console.log('Data: ',data);
                    var array = JSON.parse(data);
                    // console.log(array["total"]);
                    $("#tipo_taller").html(array["html"]);
                    $('#cover-spin').hide(0);

                });

                // instituciones
                // asigna como institución al infocentro que planifica
                if (set_institucion == "1") {
                    var estado_info = document.getElementById("estados_1").value;
                    $.post("core/app/view/get_info_region.php", {
                        estado_info: estado_info,
                    }, function(data) {
                        // console.log('Region:',data);
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
                        // console.log(data);
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
                    // console.log(data);
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






        // recargar cuando hay una sola opcion
        // function tipo_taller() {
        //     $.post("core/app/view/get_tipo_taller.php", {
        //         categoria: categoria,
        //         code_info: code_info
        //     }, function(data) {
        //         var array = JSON.parse(data);
        //         $("#tipo_taller").html(array["html"]);
        //         $('#cover-spin').hide(0);
        //     });
        // }



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
            controladorTiempo = setTimeout(codigoAJAX, 1600);
        });
    });

    function codigoAJAX() {
        code = document.getElementById("code_info").value;
        que = document.getElementById("b_responsable").value;
        estado = document.getElementById("estados_1").value;
        // que = que.replace(/\./g,''); reemplaza puntos por nada

        responsable_tipo = document.getElementById("responsable_tipo").value;

        if (code == "") {
            alert("Debes asignar el código del infocentro primero");
            return;
        }

        // alert(responsable_tipo);
        if (responsable_tipo === "Facilitador") {
            console.log("Buscar facilitador");
            $.post("core/app/view/getResponsible-view.php", {
                search: que,
                info_cod: code,
                estado: estado
            }, function(data) {
                // console.log(data);
                var array = JSON.parse(data);
                // alert(array["nombre"]);
                if (array["error"] === "true") {
                    alert(array["message"]);
                    return;
                } else {
                    toastify(array["nombre"], true, 10000, "dashboard");
                }
                $("#responsable_name").val(array["nombre"]);
                $("#responsable_tel").val(array["telefono"]);
                $("#responsible_dni").val(array["dni"]);
                $("#responsible_email").val(array["email"]);
                $("#personal_type").val(array["personal_type"]);
                // $("#parroquias_1").val(array["parroquia"]);

            });
        }
        if (responsable_tipo === "Coordinador" || responsable_tipo === "Jefe de Estado") {
            console.log("Buscar coord. o Jefe de estado");
            $.post("core/app/view/getResponsible_coord-view.php", {
                search: que,
                info_cod: code,
                estado: estado
            }, function(data) {
                // console.log(data);
                var array = JSON.parse(data);
                // alert(array["nombre"]);
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

            });
        }
        if (responsable_tipo != "Facilitador" && responsable_tipo != "Coordinador" && responsable_tipo != "Jefe de Estado") {
            console.log("Buscar gerente");
            $.post("core/app/view/getResponsible_ger-view.php", {
                search: que,
                info_cod: code,
                estado: estado
            }, function(data) {
                console.log(data);
                var array = JSON.parse(data);
                // alert(array["telefono"]);
                if (array["error"] === "true") {
                    alert(array["message"]);
                    return;
                }
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
                // console.log(data);
                var array = JSON.parse(data);

                if (array["error"] == "true") {
                    document.getElementById("code_info").value = "";
                    alert("No existe el código: " + code + ". Por favor consulta a tu soporte InfoApp para registrar tu código");

                } else {
                    // $("#estate").val(array["estado"]);
                    // alert(array["estado"]);
                    $("#info_id").val(array["info_id"]);
                    $("#estados_1").val(array["estado"]);
                    $("#municipios_1").val(array["municipio"]);
                    $("#parroquias_1").val(array["parroquia"]);
                    $("#ciudades").val(array["ciudad"]);
                    $("#direccion").val(array["direccion"]);

                    toastify("Se ha cargado el código ( " + code.toUpperCase() + " ) correctamente", true, 5000, "dashboard");

                    // if (getOS() == "Android") {
                    //     alert("Se ha cargado la dirección registrada en el infocentro, por favor verifica que sea correcta al igual que la ortografía");
                    // } else {
                    //     toastify('Se ha cargado la dirección registrada en el infocentro, por favor verifica que sea correcta al igual que la ortografía', true, 15000, "warning");
                    // }

                }
            });

            $('#tipo_reporte').find('option').remove().end().append('<option value=""></option>').val('0');
            $('#accion_especifica').find('option').remove().end().append('<option value=""></option>').val('0');
            $('#area_formativa').find('option').remove().end().append('<option value=""></option>').val('0');
            $('#tipo_taller').find('option').remove().end().append('<option value=""></option>').val('0');
            $('#institucion_formacion').find('option').remove().end().append('<option value=""></option>').val('0');
            $('#circuito_comunal').find('option').remove().end().append('<option value=""></option>').val('0');

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




    });







    // FECHA LIMITE DE LA ACTIVIDAD
    $(function() {
        fecha_limite_inicio = document.getElementById("fecha_limite_inicio").value;
        fecha_limite_final = document.getElementById("fecha_limite_final").value;
        // const f = new Date("2018/01/30");
        // alert(f);

        $('#fecha').change(function() {
            var value = $(this).val();
            // alert(value);

            if (Date.parse(value) < Date.parse(fecha_limite_inicio) || Date.parse(value) > Date.parse(fecha_limite_final)) {
                Swal.fire({
                    // position: 'top-center',
                    icon: 'warning',
                    title: 'La fecha límite de reportes es del: \n' + fecha_limite_inicio + " al " + fecha_limite_final,
                    showConfirmButton: true,
                    // timer: 1500
                })

                document.getElementById("fecha").value = "";
            } else {

            }
        });
    })










    // oculta o muestra motivo de cierre al iniciar
    $(function() {
        var $contenido = $('#contenido');
        var $modalidad = $('#modalidad');
        var $duracion = $('#duracion');

        var value = $('#linea_accion').val();

        if (value == 'Formación a la medida') {
            $($contenido).show();
            $($modalidad).show();
            $($duracion).show();
            // $('option:not(.' + value + ')', $tabla).hide();
        } else {
            // Se ha seleccionado All
            $($contenido).hide();
            $($modalidad).hide();
            $($duracion).hide();
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
            // document.getElementById("nombre_act").focus();
        } else {
            // console.log('El mensaje no incluye letras');
        }
    });

    function checkType(mensaje) {
        mensaje = mensaje.replace(/[&\/\\#,+()$~%.'":*?<>{}]/g, '')
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






    function comparaHoras(vInicio, vFinal) {

        if (!vInicio || !vFinal) {
            return;
        }

        const tIni = new Date();
        const pInicio = vInicio.split(":");

        tIni.setHours(pInicio[0], pInicio[1]);

        const tFin = new Date();
        const pFin = vFinal.split(":");

        tFin.setHours(pFin[0], pFin[1]);


        if (tFin.getTime() > tIni.getTime()) {
            console.log("final mayor a inicio");
        }

        if (tFin.getTime() < tIni.getTime()) {
            if (getOS() == "Android") {
                alert("La hora final de la actividad es anterior a la de inicio, debería ser igual o mayor a la de inicio");
            } else {
                toastify("La hora final de la actividad es anterior a la de inicio, debería ser igual o mayor a la de inicio", true, 20000, "error");
            }
        }

        if (tFin.getTime() === tIni.getTime()) {
            console.log("Iguales");
        }


    }
</script>




<style>
    /* .form-group input[type=file] {
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
} */
</style>