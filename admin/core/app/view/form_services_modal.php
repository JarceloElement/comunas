<?php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// form_services
// require_once('../../controller/DatabasePg_admin.php');
// require('../../controller/Database_admin.php');

date_default_timezone_set('UTC');
date_default_timezone_set("America/La_Paz");

$con = Database::getCon();
$etnias = $con->query("SELECT * from etnia_type");
$discapacidad = $con->query("SELECT * from disability_type");
$professions = $con->query("SELECT * from professions order by p_name");
$occupations = $con->query("SELECT * from occupations order by p_name");
$services_type = $con->query("SELECT * from services_type order by services_name");




$Name_OS = "";
$user_id = $_SESSION['user_id'];
$cod_info = $_SESSION['user_code_info'];

$estado = "";
$municipio = "";
$direccion = "";



if ($_SESSION['user_code_info'] == "777") {
    $info = InfoData::getByCode("AMA05");
    if ($info != 'null') {
        $estado = $info->estado;
        $municipio = $info->municipio;
        $direccion = $info->direccion;
    }
} else {
    $info = InfoData::getByCode($_SESSION['user_code_info']);
    if ($info != 'null') {
        $estado = $info->estado;
        $municipio = $info->municipio;
        $direccion = $info->direccion;
    }
}



?>



<script language="javascript">
    $(document).ready(function() {
        $("#disability").hide();
        $("#etnia").hide();
        $("#loading").hide();
        // $("#profesion").hide();
    })

    var Name_OS = "Unknown OS";
    // OS NAME
    if (navigator.userAgent.indexOf("Win") != -1) Name_OS = "Windows";
    if (navigator.userAgent.indexOf("Mac") != -1) Name_OS = "Macintosh";
    if (navigator.userAgent.indexOf("Linux") != -1) Name_OS = "Linux";
    if (navigator.userAgent.indexOf("Android") != -1) Name_OS = "Android";
    if (navigator.userAgent.indexOf("like Mac") != -1) Name_OS = "iOS";

    // navegador web en escritorio
    var sBrowser, sUsrAg = navigator.userAgent;

    if (sUsrAg.indexOf("Chrome") > -1) {
        sBrowser = "Chrome";
    } else if (sUsrAg.indexOf("Safari") > -1) {
        sBrowser = "Safari";
    } else if (sUsrAg.indexOf("Opera") > -1) {
        sBrowser = "Opera";
    } else if (sUsrAg.indexOf("Firefox") > -1) {
        sBrowser = "Firefox";
    } else if (sUsrAg.indexOf("MSIE") > -1) {
        sBrowser = "Internet Explorer";
    }


    $(document).ready(function() {

        if (Name_OS == "Android") {
            get_Name = Name_OS + "|" + sBrowser;
            // get_Name = Name_OS + "|" + md.userAgent() + "|" + md.mobile() + "|" + md.versionStr('Build');
            $("#user_name_os").val(get_Name);
        } else {
            get_Name = Name_OS + "|" + sBrowser;
            $("#user_name_os").val(get_Name);
        }

    })



    // VALIDAR FORMULARIO
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("form").addEventListener('submit', validarFormulario);
    });

    function validarFormulario(evento) {
        evento.preventDefault();

        <?php if ($estado == "") { ?>
            alert("No tienes código de infocentro asociado en tus datos de usuario.\nPor favor reporta la incidencia al jefe de estado");
            event.preventDefault();
            return;
        <?php } ?>

        evento.preventDefault();

        // validar dni
        var form = document.getElementById('form');
        var user_f_id = document.getElementById('user_f_id').value;
        var user_id = document.getElementById('user_id').value;
        var document_id = document.getElementById('document_id').value;
        var name = document.getElementById('name').value;
        var name_param = document.getElementById('name_param').value;
        var user_has_document = document.getElementById("user_has_document").value;
        var user_email = document.getElementById("user_correo_update").value;
        var validar_post = false;
        // valida longitud de la contraseña
        if ((document_id.length < 6 || document_id.length > 8) && user_has_document == 'Si') {
            alert("El documento de identidad debe tener al menos 6 números");
            $("#document_id").focus();
            $("#document_id")[0].scrollIntoView();
            return;
        }
        // 

        if (!user_id) {
            alert("No user_id");
            return;
        }
        if (!document_id || !name || name_param == "No existe este usuario") {
            document.getElementById('q_participante').focus();
            if (getOS() == "Android") {
                alert("Primero busca el usuario, si no existe se debe crear en el botón NUEVO USUARIO, luego si podrás registrar el servicio");
            } else {
                toastify('Primero busca el usuario, si no existe se debe crear en el botón NUEVO USUARIO, luego si podrás registrar el servicio', true, 10000, "warning");
            }

            return;
        }

        $.ajax({
                type: "POST",
                url: "./?action=services_users",
                data: {
                    function: "get_repeated_email",
                    id: user_f_id,
                    email: user_email
                }
            })
            .done(function(msg) {
                // console.log(msg);
                // return;
                var array = JSON.parse(msg);
                // console.log(array['param']);

                if (array['param'] != "null") {
                    if (getOS() == "Android") {
                        alert("Ya existe otro usuario con el mismo correo, ingresa en editar usuarios, búscale por el CORREO y verifica que sea la misma persona");
                    } else {
                        toastify('Ya existe otro usuario con el mismo correo, ingresa en editar usuarios, búscale por el CORREO y verifica que sea la misma persona', true, 10000, "warning");
                    }
                    return;
                } else {
                    // console.log(array['param']);
                    // console.log(document.getElementById("user_has_document").value);
                    // return;

                    validar_post = true;
                    if (validar_post == true || user_email == "") {
                        $('#cover-spin').show(0);
                        form.submit();
                    }

                }

            })
            .fail(function(err) {
                // console.log(err);
                if (getOS() == "Android") {
                    alert("Ocurrió un error al guardar, intenta nuevamente");
                } else {
                    toastify('Ocurrió un error al guardar, intenta nuevamente', true, 10000, "warning");
                }
                $('#cover-spin').hide(0);
            });


    }
</script>


<div id="cover-spin"></div>



<!-- FORM -->
<form name="form" id="form" accept-charset="UTF-8" class="form-horizontal" method="post" action="index.php?action=services_users&function=add&&pag=" role="form">
    <input type="hidden" name="user_f_id" id="user_f_id" value="">
    <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>">
    <input type="hidden" name="user_info_cod" id="user_info_cod" value="<?php echo strtoupper(strtolower($cod_info)); ?>">
    <input type="hidden" name="user_nombres" id="user_nombres" value="">
    <input type="hidden" name="user_apellidos" id="user_apellidos" value="">
    <input type="hidden" name="user_dni" id="user_dni" value="">
    <input type="hidden" name="user_correo" id="user_correo" value="">
    <input type="hidden" name="user_telefono" id="user_telefono" value="">
    <input type="hidden" name="user_genero" id="user_genero" value="">
    <input type="hidden" name="user_comunity_type" id="user_comunity_type" value="">
    <input type="hidden" name="user_pertenece_organizacion" id="user_pertenece_organizacion" value="">
    <!-- <input type="hidden" name="user_etnia" id="user_etnia" value=""> -->
    <input type="hidden" name="user_f_nacimiento" id="user_f_nacimiento" value="">
    <input type="hidden" name="user_edad" id="user_edad" value="">
    <input type="hidden" name="user_nivel_academ" id="user_nivel_academ" value="">
    <!-- <input type="hidden" name="user_profesion" id="user_profesion" value=""> -->
    <input type="hidden" name="user_empleado" id="user_empleado" value="">
    <input type="hidden" name="user_institucion" id="user_institucion" value="">
    <input type="hidden" name="user_estado" id="user_estado" value="<?php echo $estado ?>">
    <input type="hidden" name="user_municipio" id="user_municipio" value="<?php echo $municipio ?>">
    <input type="hidden" name="user_direccion" id="user_direccion" value="<?php echo $direccion ?>">
    <input type="hidden" name="user_tipo_servicio" id="user_tipo_servicio" value="">
    <input type="hidden" name="user_name_os" id="user_name_os" value="">
    <input type="hidden" name="name_param" id="name_param" value="">

    <fieldset>

        <div class="col-md-12">
            <label style="color:orange;">AVISO: Buscar los usuarios por C.I, Nombre, Apellido ó Correo. Los "No cedulados" se buscan también por ID y Ref. padre. (Los ID se pueden ver en Gestión Humana/Usuarios)</label>
        </div>
        <br>

        <div class="loading text-center" id="loading">
            <img src="uploads/loader.gif" alt="Buscando..." />
        </div>
        <!-- <div class="col-md-12 mui-textfield mui-textfield--float-label">
            <input type="text" name="buscar_participante" id="q_participante" value="">
            <label><i class="fa fa-user"></i> Buscar DNI, nombre o correo</label>
        </div> -->

        <div class="col-md-12 mui-select">
            <label for="user_has_document" class=" control-label"><i class="fa fa-user"></i> ¿Está cedulado?</label>
            <select name="user_has_document" class="form-control" id="user_has_document" required>
                <option value="">-SELECCIONE-</option>
                <option value="<?php echo "Si"; ?>">Si</option>
                <option value="<?php echo "No/Sin partida de nacimiento"; ?>">No/Sin partida de nacimiento</option>
                <option value="<?php echo "No/Menor de edad"; ?>">No/Menor de edad</option>
                <option value="<?php echo "No/Problemas en documentos"; ?>">No/Problemas en documentos</option>
                <option value="<?php echo "No/Pueblo originario"; ?>">No/Pueblo originario</option>
            </select>
        </div>


        <div class="col-md-12">
            <br>
            <div class="form-group">
                <label for="responsable_name" class=" control-label"><i class="fa fa-user"></i> Buscar Responsable</label>

                <div class="input-group">
                    <input type="text" class="form-control" name="buscar_participante" placeholder="Nombre, cédula o correo" id="q_participante">
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

        <div class="col-md-12 mui-textfield mui-textfield--float-label" id="div_name" style="display: none;">
            <div class="form-group">
                <input type="text" name="name" id="name" required class="form-control" placeholder="Nombre y apellido" disabled>
            </div>
        </div>



        <div class="col-md-12 mui-textfield mui-textfield--float-label" id="dni" style="display: none;">
            <div class="form-group">
                <label><i class="fa fa-user"></i> Nº de documento</label>
                <input type="text" name="document_id" id="document_id" required class="form-control" min="0" max="90000000" minlength="7" maxlength="8" placeholder="N° documento" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
            </div>
        </div>

        <div class="col-md-12" id="correo" style="display: none;">
            <div class="form-group">
                <label for="user_correo_update" class=" control-label"><i class="fa fa-envelope"></i> Correo</label>
                <input type="email" class="form-control" name="user_correo_update" id="user_correo_update" placeholder="mi@correo.com"></input>
                <small class="form-text text-muted">Correo obligatorio para adultos no cedulados</small>
            </div>
        </div>

        <div class="col-md-12 mui-select" id="disability" style="display: none;">
            <label for="user_disability_type" class=" control-label"><i class="fa fa-user"></i> Posee alguna discapacidad</label>
            <select name="user_disability_type" class="form-control" id="user_disability_type">
                <option value="">-DISCAPACIDAD-</option>
                <?php foreach ($discapacidad as $name) : ?>
                    <option value="<?php echo $name["disability"]; ?>"> <?php echo $name["disability"]; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col-md-12 mui-select" id="etnia" style="display: none;">
            <label for="user_etnia" class=" control-label"><i class="fa fa-user"></i> Pueblo indígena</label>
            <select name="user_etnia" class="form-control" id="user_etnia">
                <option value="">-ETNIA-</option>
                <?php foreach ($etnias as $name) : ?>
                    <option value="<?php echo $name["name"]; ?>"> <?php echo $name["name"]; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col-md-12 mui-select" id="profesion" style="display: none;">
            <label for="user_profesion" class=" control-label"><i class="fa fa-user"></i> Profesión</label>
            <select name="user_profesion" class="form-control" id="user_profesion" required>
                <option value="">-SELECCIONE-</option>
                <option value="Otra">Otra</option>
                <option value="Estudiante">Estudiante</option>
                <option value="Trabajo del hogar">Trabajo del hogar</option>
                <?php foreach ($professions as $name) : ?>
                    <option value="<?php echo $name["p_name"]; ?>"> <?php echo $name["p_name"]; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col-md-12 mui-select" id="ocupacion" style="display: none;">
            <label for="user_ocupacion" class=" control-label"><i class="fa fa-user"></i> Ocupación</label>
            <select name="user_ocupacion" class="form-control" id="user_ocupacion" required>
                <option value="">-SELECCIONE-</option>
                <option value="Otra">Otra</option>
                <option value="Estudiante">Estudiante</option>
                <option value="Trabajo del hogar">Trabajo del hogar</option>
                <?php foreach ($occupations as $name) : ?>
                    <option value="<?php echo $name["p_name"]; ?>"> <?php echo $name["p_name"]; ?></option>
                <?php endforeach; ?>
            </select>
        </div>


        <div class="col-md-12 mui-select">
            <select name="tipo_servicio" id="tipo_servicio" required>
                <option value=""> -SERVICIO PRESTADO- </option>
                <?php foreach ($services_type as $name) : ?>
                    <option value="<?php echo $name["services_name"]; ?>"> <?php echo $name["services_name"]; ?></option>
                <?php endforeach; ?>
            </select>
            <label><i class="fa fa-user"></i> Tipo de servicio prestado*</label>
        </div>


        <div class="col-md-12 mui-textfield mui-textfield--float-label">
            <input type="text" name="user_fecha_servicio" required id="user_fecha_servicio" value="<?php echo date("Y/m/d", time()); ?>" placeholder="" onfocus="(this.type='date')">
            <label><i class="fa fa-calendar"></i> Fecha del servicio*</label>
        </div>




        <div class="col-md-12">
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block"> Registrar servicio</button>
            </div>
        </div>



    </fieldset>
</form name="form">







<script language="javascript">
    document.addEventListener("DOMContentLoaded", function() {

        // CARGA DATOS DEL RESPONSABLE CON AJAX Y RETARDO AL ESCRIBIR
        var controladorTiempo = "";

        // retardo entre caracteres
        $(function() {

            // $("#q_participante").on("keyup", function() {
            //     if ($("#q_participante").val() != "") {
            //         clearTimeout(controladorTiempo);
            //         controladorTiempo = setTimeout(codigoAJAX, 1200);
            //     }
            // });
        });



        // =======================


        $(function() {
            $("#tipo_servicio").change(function() {
                value = $(this).val();
                $("#user_tipo_servicio").val(value);

            });

        });


    });


    function codigoAJAX() {
        que = document.getElementById("q_participante").value;
        cedulado = document.getElementById("user_has_document").value;
        if (cedulado == "") {
            toastify('Por favor seleccióna la opción si está cedulado primero', true, 20000, "warning");
            return;
        }       
        if (que == "") {
            toastify('Por favor escribe el dato que quieres buscar', true, 20000, "warning");
            return;
        }

        $("#loading").show();
        $.ajax({
                type: "POST",
                url: "core/app/view/getFinalUser-view.php",
                data: {
                    search: que,
                    cedulado: cedulado
                }
            })
            .done(function(msg) {
                $("#loading").hide();

                console.log("done ",msg);
                // var array = JSON.stringify(msg);
                var array = JSON.parse(msg);
                // console.log(array["user_apellido_2"]);

                if (array["aviso"] == "No existe este usuario") {
                    if (getOS() == "Android") {
                        alert("¡El usuario no existe! se debe crear primero en el botón NUEVO USUARIO y luego podrás registrar el servicio");
                    } else {
                        toastify('¡El usuario no existe! se debe crear primero en el botón NUEVO USUARIO y luego podrás registrar el servicio', true, 20000, "warning");
                    }

                    return;
                } else {
                    if (getOS() == "Android") {
                        alert(array["aviso"]);
                    } else {
                        toastify(array["aviso"], true, 20000, "dashboard");
                    }
                }

                // alert(array["user_has_document"]);
                $("#name_param").val(array["user_nombres"]); // preview
                $("#name").val(array["user_nombres"] + " " + array["user_apellidos"] + " | FN: " + array["user_f_nacimiento"]); // preview
                $("#user_f_id").val(array["user_f_id"]); // preview
                $("#user_nombres").val(array["user_nombres"]);
                $("#user_apellidos").val(array["user_apellidos"]);
                $("#user_has_document").val(array["user_has_document"]);

                $("#correo").show();
                $("#dni").show();
                $("#div_name").show();
                $("#disability").show();
                $("#etnia").show();
                $("#profesion").show();
                $("#ocupacion").show();

                if ($("#user_has_document").val() != 'Si') {
                    document.getElementById("document_id").type = "text";
                    document.getElementById("document_id").setAttribute('maxlength', 11);
                    document.getElementById("document_id").value = "No cedulado";
                    document.getElementById("document_id").readOnly = true;
                    document.getElementById("document_id").classList.remove("is-invalid");

                    if ($("#user_has_document").val() != 'No/Menor de edad') {
                        document.getElementById("user_correo").required = true;
                        document.getElementById("user_correo_update").required = true;
                    } else {
                        document.getElementById("user_correo").required = false;
                        document.getElementById("user_correo_update").required = false;
                    }

                    compareDni(' is-valid');

                } else {
                    document.getElementById("document_id").type = "number";
                    document.getElementById("document_id").setAttribute('maxlength', 8);
                    document.getElementById("document_id").value = "";
                    document.getElementById("document_id").readOnly = false;
                    document.getElementById("document_id").classList.remove("is-valid");
                    document.getElementById("user_correo").required = false;
                    document.getElementById("user_correo_update").required = false;
                    compareDni(' is-invalid');
                }

                if ($("#user_has_document").val() == "Si") {
                    $("#user_dni").val(array["user_dni"]);
                    $("#document_id").val(array["user_dni"]); // preview
                }
                $("#user_correo").val(array["user_correo"]);
                $("#user_correo_update").val(array["user_correo"]);
                $("#user_telefono").val(array["user_telefono"]);
                $("#user_genero").val(array["user_genero"]);
                $("#user_comunity_type").val(array["user_comunity_type"]);
                $("#user_pertenece_organizacion").val(array["user_pertenece_organizacion"]);
                $("#user_disability_type").val(array["user_disability_type"]);
                $("#user_etnia").val(array["user_etnia"]);
                $("#user_f_nacimiento").val(array["user_f_nacimiento"]);
                $("#user_edad").val(array["user_edad"]);
                $("#user_nivel_academ").val(array["user_nivel_academ"]);
                $("#user_profesion").val(array["user_profesion"]);
                $("#user_ocupacion").val(array["user_ocupacion"]);
                $("#user_empleado").val(array["user_empleado"]);
                $("#user_institucion").val(array["user_institucion"]);

                // alert(array["user_etnia"]);
                if (array["user_etnia"] == null || array["user_etnia"] == "null" || array["user_etnia"] == "") {
                    $("#etnia").show();
                    document.getElementById("user_etnia").required = true;
                } else {
                    $("#etnia").hide();
                    document.getElementById("user_etnia").required = false;
                }

                if (array["user_disability_type"] == null || array["user_disability_type"] == "NULL" || array["user_disability_type"] == "") {
                    $("#disability").show();
                    document.getElementById("user_disability_type").required = true;
                } else {
                    $("#disability").hide();
                    document.getElementById("user_disability_type").required = false;
                }
                if (array["user_profesion"] == null || array["user_profesion"] == "NULL" || array["user_profesion"] == "") {
                    $("#profesion").show();
                }

                if (array["user_ocupacion"] == null || array["user_ocupacion"] == "NULL" || array["user_ocupacion"] == "") {
                    $("#ocupacion").show();
                }


            })
            .fail(function(err) {
                console.log("fail ", err);
            });


    }


    $("#document_id").on("keyup", function() {
        var controladorTiempo = "";
        user_dni = $(this).val();
        var user_has_document = document.getElementById("user_has_document").value;
        clearTimeout(controladorTiempo);

        if (user_dni == 0) {
            toastify('El número de documento no es válido, debe ser mayor a cero', true, 8000, "error");
            document.getElementById("document_id").value = "";
        }

        if ((user_dni.length < 6 || user_dni.length > 8) && user_has_document == 'Si') {
            // retardo entre caracteres
            controladorTiempo = setTimeout(compareDni(' is-invalid'), 800);
        } else {
            document.getElementById("document_id").classList.remove("is-invalid");
            controladorTiempo = setTimeout(compareDni(' is-valid'), 800);
        }
    });







    // verificar si es cedulado
    $("#user_has_document").change(function() {
        var cedulado = $(this).val();
        if (cedulado != 'Si') {
            document.getElementById("document_id").type = "text";
            document.getElementById("document_id").setAttribute('maxlength', 11);
            document.getElementById("document_id").value = "No cedulado";
            document.getElementById("document_id").readOnly = true;
            document.getElementById("document_id").classList.remove("is-invalid");

            if (cedulado != 'No/Menor de edad') {
                document.getElementById("user_correo").required = true;
                document.getElementById("user_correo_update").required = true;
                compareDni(' is-valid');
                if (Name_OS == "Android") {
                    alert('¡AVISO! si el usuario no está cedulado requiere de un correo electrónico para ser registrado');
                } else {
                    toastify('¡AVISO! si el usuario no está cedulado requiere de un correo electrónico para ser registrado', true, 10000, "warning");
                }
            }

            if (cedulado == 'No/Menor de edad') {
                document.getElementById("user_correo_update").required = false;
                $("#correo").hide();
                // $("#dni").hide();
            } else {
                $("#correo").show();
                // $("#dni").show();
            }

        } else {
            document.getElementById("document_id").type = "number";
            document.getElementById("document_id").setAttribute('maxlength', 8);
            document.getElementById("document_id").value = "";
            document.getElementById("document_id").readOnly = false;
            document.getElementById("document_id").classList.remove("is-valid");
            document.getElementById("user_correo").required = false;
            document.getElementById("user_correo_update").required = false;
            document.getElementById("document_id").focus();
            compareDni(' is-invalid');

            // $("#correo").show();
            // $("#dni").show();
        }


    })


    // $("#user_correo").on("keyup", function(event) {
    //     email = $(this).val();
    //     console.log(event.key);
    //     if (event.key == " "){
    //         $("#user_correo").val(email.trim());
    //         // $("#user_correo").val(email.substring(0, email.length - 1));
    //     }

    // });



    function compareDni(setclass) {
        var element = document.getElementById("user_dni");
        element.className += setclass;
    }
</script>

<script src="assets/js/jquery.min.js" type="text/javascript"></script>