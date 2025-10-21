<?php
if (Session::getUID() == "") {
    print "<script>window.location='index.php';</script>";
}
$estado = EstadoData::getAll();
// $municipio = MunicipioData::getAll();
// $ciudad = CiudadData::getAll();
// $parroquia = ParroquiaData::getAll();
// $personal_type = PersonalTypeData::getAll();
// echo "_SESSION_id -".$_SESSION['user_id'];



$con = Database::getCon();
$etnias = $con->query("SELECT * from etnia_type");
$discapacidad = $con->query("SELECT * from disability_type");
$professions = $con->query("SELECT * from professions order by p_name");
$occupations = $con->query("SELECT * from occupations order by p_name");

$is_new = "0";
if (isset($_GET['new'])) {
    $is_new = $_GET["new"];
}
?>

<?php if (isset($_GET['swal']) && $_GET['swal'] != ""): ?>
    <!-- <!?php Core::toast("warning",$_GET['swal'],'true'); ?>
	<!?php Core::toast_down("warning",$_GET['swal'],'true'); ?>
	<!?php Core::alert_layout("warning",$_GET['swal'],'true'); ?>
	<!?php Core::alert_layout("warning",$_SESSION["alert"],'false'); ?> -->

<?php endif; ?>
<!-- <!?php Core::toast("warning",$_SESSION["user_id"],'false'); ?> -->

<script>
    $(document).ready(function() {


        // alertjs("El nombre de usuario debe contener únicamente letras, numeros y guión bajo",true); // [message, autohide]
        // toastjs("No se pudo validar el recaptcha.\nPor favor intenta nuevamente",false); // [message, autohide]
        // toastify("El nombre de usuario debe contener únicamente letras, numeros y guión bajo",true,10000,"#ff8d00", "#ffbc00"); // [message, autohide]
        // setTimeout('window.location.href = "index.php?view=signup&swal="; ',5000);

        var mobile = (/iphone|ipad|ipod|android|blackberry|mini|windows\sce|palm/i.test(navigator.userAgent.toLowerCase()));

        // alertas
        <?php if (isset($_GET['swal']) && isset($_SESSION["alert"]) && $_GET['swal'] != ""): ?>
            if (mobile) {
                toastify('<?php echo $_SESSION["alert"]; ?>', true, 20000, "warning");
            } else {
                toastify('<?php echo $_SESSION["alert"]; ?>', true, 20000, "warning");
            }
        <?php endif; ?>
        <?php $_SESSION["alert"] = ""; ?>

        // cambiar el parametro de alert
        const url = new URL(window.location);
        url.searchParams.set('swal', '');
        window.history.pushState({}, '', url);



        // ajustar titulo flotante del campo cuando no esta vacio
        $('.floating-label .custom-select, .floating-label .form-control').floatinglabel();

        // verifica si tiene cedula y formatea el campo
        // var user_has_document = document.getElementById("user_dni").value;
        // if (user_has_document == "No cedulado"){
        //     document.getElementById("user_dni").type="text";
        //     document.getElementById("user_dni").setAttribute('maxlength',11);
        //     document.getElementById("user_dni").value = "No cedulado";
        //     document.getElementById("user_dni").readOnly = true;
        //     document.getElementById("user_dni").classList.remove("is-invalid");
        //     compareDni(' is-valid');
        //     document.getElementById("user_has_document")[0].innerHTML = "No";
        // }else{
        //     document.getElementById("user_dni").type="number";
        //     document.getElementById("user_dni").setAttribute('maxlength',8);
        //     // document.getElementById("user_dni").value = "";
        //     document.getElementById("user_dni").readOnly = false;
        //     document.getElementById("user_dni").classList.remove("is-valid");
        //     compareDni(' is-invalid');
        //     document.getElementById("user_has_document")[0].innerHTML = "Si";
        // }







    })




    // ======= CAPTURA DE IMAGEN DESDE WEBCAM ========

    function webcam() {

        // $.post("core/app/view/webcam.php", {}, function(data) {
        // $("#modal-body").html(data);
        let html = "";
        html = `
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="row justify-content-center">
                    <div class="form-group">
                        <div class="row justify-content-center">
                            <video id="videoElement" width="500" height="400" autoplay></video>
                        </div>
                        <div class="row justify-content-center">
                            <button class="btn btn-primary" id="captureButton">Capturar</button>
                        </div>
                        <br>
                        <canvas id="canvasElement" style="display:none;"></canvas>
                        <div class="row justify-content-center">
                            <img id="photoElement" style="display:none;max-width:300px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        `;

        var body = document.getElementById("modal-body");
        var newDiv = document.createElement("div");
        newDiv.setAttribute("class", "webcam_class");
        newDiv.innerHTML += html;

        // elimina el div agregado
        $('#webcam .webcam_class').empty();

        // agrega el nuevo div en el modal-body
        body.appendChild(newDiv);
        $('#webcam').modal("show")

        // vista miniatura del profile_image
        const avatar = document.getElementById('avatar');
        // input file del form
        const profile_image = document.getElementById('profile_image');

        const videoElement = document.getElementById('videoElement');
        const canvasElement = document.getElementById('canvasElement');
        const photoElement = document.getElementById('photoElement');
        const captureButton = document.getElementById('captureButton');
        let stream;
        captureButton.addEventListener('click', capturePhoto);
        startWebcam();

        // });


    };

    async function startWebcam() {
        try {
            stream = await navigator.mediaDevices.getUserMedia({
                video: true
            });
            videoElement.srcObject = stream;
            captureButton.disabled = false;
        } catch (error) {
            console.error('Error accessing webcam:', error);
        }
    }

    function capturePhoto() {
        canvasElement.width = videoElement.videoWidth / (4 / 3);
        canvasElement.height = videoElement.videoHeight;
        canvasElement.getContext('2d').drawImage(videoElement, -100, 0);
        const photoDataUrl = canvasElement.toDataURL('image/jpeg');

        // convert to Blob (async)
        canvasElement.toBlob((blob) => {
            const file = new File([blob], "mycanvas.png", {
                type: 'image/png'
            });

            const dT = new DataTransfer();
            dT.items.add(file);
            profile_image.files = dT.files;

            // console.log(profile_image.files[0]);
            avatar.src = photoDataUrl;
            photoElement.src = photoDataUrl;
            photoElement.style.display = 'block';

        }, 'image/png');
    }

    // ========================================================








    // VALIDAR FORMULARIO
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("userdata").addEventListener('submit', validarFormulario);
    });


    function validarFormulario(evento) {
        evento.preventDefault();
        // var user_f_nacimiento = document.getElementById('user_f_nacimiento').value;
        // alert(user_f_nacimiento);
        var formObj = document.getElementById('userdata');
        var user_id = document.getElementById('user_id').value;
        var dni = document.getElementById('user_dni').value;
        var parent_dni = document.getElementById('parent_dni').value;
        var child_number = document.getElementById('child_number').value;
        var email = document.getElementById('user_correo').value;
        var user_has_document = document.getElementById("user_has_document").value;

        var parent_ref = parent_dni + child_number;
        document.getElementById('parent_ref').value = parent_ref;

        // valida longitud del dni
        if ((dni.length < 6 || dni.length > 8) && user_has_document == 'Si') {
            if (mobile) {
                alert("El documento de identidad debe tener al menos 6 números");
                $("#user_dni").focus();
                $("#user_dni")[0].scrollIntoView();
            } else {
                toastify("El documento de identidad debe tener al menos 6 números", true, 20000, "warning"); // [message, autohide]
                $("#user_dni").focus();
                $("#user_dni")[0].scrollIntoView();
            }
            return;
        }
        // valida longitud del dni del padre
        if ((parent_dni.length < 6 || parent_dni.length > 8) && user_has_document != 'Si') {
            if (mobile) {
                alert("El documento de identidad debe tener al menos 6 números");
                $("#parent_dni").focus();
                $("#parent_dni")[0].scrollIntoView();
            } else {
                toastify("El documento de identidad debe tener al menos 6 números", true, 20000, "warning"); // [message, autohide]
                $("#parent_dni").focus();
                $("#parent_dni")[0].scrollIntoView();
            }
            return;
        }
        // valida que el numero de hijo no sea cero
        if (child_number == 0 && user_has_document != 'Si') {
            if (mobile) {
                alert("Por favor indica que número de hijo, no puede ser cero");
                $("#child_number").focus();
                $("#child_number")[0].scrollIntoView();
            } else {
                toastify("Por favor indica que número de hijo, no puede ser cero", true, 20000, "warning"); // [message, autohide]
                $("#child_number").focus();
                $("#child_number")[0].scrollIntoView();
            }
            return;
        }

        var whatsapp = document.getElementById('phone').value;
        var telegram = document.getElementById('phone_t').value;

        // var valida_w = /^\d{10}$/;
        var valida_w = /^\d{3}-\d{7}$/;
        if (whatsapp.length > 0) {
            if (!whatsapp.match(valida_w)) {
                alert("Por favor corrige los datos del WhatsApp");
                $("#phone").focus();
                $("#phone")[0].scrollIntoView();
                return;
            }
        }
        if (telegram.length > 0) {
            if (!telegram.match(valida_w)) {
                alert("Por favor corrige los datos del Telegram");
                $("#phone_t").focus();
                $("#phone_t")[0].scrollIntoView();
                return;
            }
        }

        $('#cover-spin').show(0);
        // this.submit()
        formObj.submit()


    }












    var phoneNumber = "";
</script>


<style>
    .avatar {
        vertical-align: middle;
        width: 100px;
        height: 100px;
        border-radius: 50%;
        border: 3px solid #5DC3FFFF;
        object-fit: cover;
    }

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

    .iti {
        position: relative;
        display: block;
    }
</style>



<div id="cover-spin"></div>




<!-- modal webcam -->
<div class="modal fade " id="webcam" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="row justify-content-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 16 16">
                    <rect width="16" height="16" fill="none" />
                    <g fill="#969696">
                        <path d="M0 6a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2H9.269c.144.162.33.324.531.475a7 7 0 0 0 .907.57l.014.006l.003.002A.5.5 0 0 1 10.5 13h-5a.5.5 0 0 1-.224-.947l.003-.002l.014-.007a5 5 0 0 0 .268-.148a7 7 0 0 0 .639-.421c.2-.15.387-.313.531-.475H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V6a1 1 0 0 0-1-1z" />
                        <path d="M8 6.5a1 1 0 1 0 0 2a1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0a2 2 0 0 1-4 0m7 0a.5.5 0 1 1-1 0a.5.5 0 0 1 1 0" />
                    </g>
                </svg>
            </div>

            <div class="modal-body" id="modal-body">
                <!-- el body se envia desde el JS -->
            </div>

        </div>
    </div>
</div>
<!-- fin modal form -->









<!-- FORM -->
<div class="container">
    <br><br>
    <div class="row justify-content-center">

        <div class="col-md-12">

            <div class="row justify-content-center"><span class="material-icons">&#xE87C;</span></div>
            <!-- saludo al iniciar sesion -->
            <?php if ($is_new != "1") { ?>
                <div class="row justify-content-center">
                    <h4 class="title">Un paso más <?php echo $_SESSION['user_name']; ?></h4>
                </div>
                <div class="row justify-content-center"> Por favor registra los datos de perfil, se usarán para tu record académico y gestión de indicadores</div>
                <br>
                <!-- saludo desde crear nuevo usuario -->
            <?php } else { ?>
                <div class="row justify-content-center">
                    <h4 class="title"><?php echo "Registro de nuevo usuario" ?></h4>
                </div>
            <?php } ?>



            <div class="card p-4">
                <div class="mui-container-fluid">


                    <!-- webcam -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="row justify-content-center">
                                <span class="navbar">
                                    <div class="row justify-content-center">
                                        <button class="btn" onclick="webcam();" title="Abrir cámara" data-toggle="tooltip">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                <rect width="24" height="24" fill="none" />
                                                <g fill="none" stroke="#5b5b5b" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                                    <circle cx="12" cy="10" r="8" />
                                                    <circle cx="12" cy="10" r="3" />
                                                    <path d="M7 22h10m-5 0v-4" />
                                                </g>
                                            </svg>
                                        </button>
                                    </div>
                                </span>
                            </div>
                        </div>
                    </div>


                    <?php if ($is_new == "1") {  ?>
                        <!-- agregado por un tercero -->
                        <form id="userdata" class="form-horizontal" accept-charset="UTF-8" method="post" action="index.php?action=finaluser&function=add_new" role="form" enctype="multipart/form-data">
                        <?php } else { ?>
                            <!-- auto-registro -->
                            <form id="userdata" class="form-horizontal" accept-charset="UTF-8" method="post" action="index.php?action=finaluser&function=add" role="form" enctype="multipart/form-data">
                            <?php } ?>

                            <input type="hidden" class="form-control" type="text" id="user_id" name="user_id" value="<?php echo $_SESSION['user_id']; ?>"></input>
                            <input type="hidden" class="form-control" type="text" id="parent_ref" name="parent_ref" value=""></input>
                            <input type="hidden" name="profile" value="" id="profile">

                            <!-- profile -->
                            <div class="row justify-content-center">
                                <div class="col-md-12" style="background-color:#E3F4FFFF;">
                                    <!-- <div class="col-md-4"> -->
                                    <div class="row justify-content-center">
                                        <div class="form-group">
                                            <!-- <td><input type="file" name="image" id="image" accept="image/*" capture="camera" > <i class="fa fa-image icon_label"></i></td> -->
                                            <input type="file" name="profile_image" id="profile_image" accept="image/*" max-file-size="10000000" title="Clic para editar la imagen" data-toggle="tooltip">

                                            <div class="form-group" id="uploadForm" title="Editar imagen" data-toggle="tooltip"></div>
                                            <img src="<?php echo "uploads/profile/profile.png"; ?>" alt="Foto" id="avatar" class="avatar"></img>

                                            <div class="row justify-content-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                    <path fill="#fff" d="M3 4V1h2v3h3v2H5v3H3V6H0V4zm3 6V7h3V4h7l1.83 2H21c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H5c-1.1 0-2-.9-2-2V10zm7 9c2.76 0 5-2.24 5-5s-2.24-5-5-5s-5 2.24-5 5s2.24 5 5 5m-3.2-5c0 1.77 1.43 3.2 3.2 3.2s3.2-1.43 3.2-3.2s-1.43-3.2-3.2-3.2s-3.2 1.43-3.2 3.2" />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>

                            <div class="form-row">

                                <!-- DATOS DEL FACILITADOR -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <nav class="navbar navbar-light bg-light">
                                            <span class="navbar-brand mb-0 h1"><span class="badge badge-secondary">Usuario</span>Datos de perfil</span>
                                            <!-- <input id="phone" type="tel" name="phone"> -->
                                        </nav>
                                    </div>
                                </div>


                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="user_nationality" class="control-label is-required"><i class="fa fa-user"></i> Nacionalidad</label>
                                        <select name="user_nationality" class="form-control" id="user_nationality" required>
                                            <option value="<?php echo "V"; ?>"><?php echo "V"; ?></option>
                                            <option value="<?php echo "E"; ?>"><?php echo "E"; ?></option>

                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="user_has_document" class="control-label is-required"><i class="fa fa-user"></i> ¿Está cedulado?</label>
                                        <select name="user_has_document" class="form-control" id="user_has_document" required>
                                            <option value="">-Elige-</option>
                                            <option value="<?php echo "Si"; ?>">Si</option>
                                            <option value="<?php echo "No/Sin partida de nacimiento"; ?>">No/Sin partida de nacimiento</option>
                                            <option value="<?php echo "No/Menor de edad"; ?>">No/Menor de edad</option>
                                            <option value="<?php echo "No/Problemas en documentos"; ?>">No/Problemas en documentos</option>
                                            <option value="<?php echo "No/Pueblo originario"; ?>">No/Pueblo originario</option>

                                        </select>
                                    </div>
                                </div>



                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="user_dni" class="control-label is-required"><i class="fa fa-user"></i> N° documento</label>
                                        <input type="number" class="form-control" name="user_dni" id="user_dni" minlength="6" maxlength="8" placeholder="N° documento" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);if (this.value < 0) this.value = '',alert('El DNI no es válido');" required>
                                    </div>
                                </div>

                                <!-- datos del padre para no cedulados -->
                                <div class="col-md-6" id="parent_dni_div" style="display:none">
                                    <div class="form-group">
                                        <label for="parent_dni" class=" control-label" style="color:red;"><i class="fa fa-user"></i> DNI del representante (Solo no cedulados)</label>
                                        <input type="number" class="form-control" name="parent_dni" id="parent_dni" minlength="6" maxlength="8" placeholder="C.I del padre o madre" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);if (this.value < 0) this.value = '',alert('El DNI no es válido');" required>
                                    </div>
                                </div>

                                <div class="col-md-6" id="child_number_div" style="display:none">
                                    <div class="form-group">
                                        <label for="child_number" class=" control-label" style="color:red;"><i class="fa fa-user"></i> ¿Que posición de hijo tiene? (Ejemplo: el 1, 2, 3)</label>
                                        <input type="number" class="form-control" name="child_number" id="child_number" minlength="6" maxlength="8" placeholder="1" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);if (this.value < 0) this.value = 0;" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="user_nombre_1" class=" control-label is-required"><i class="fa fa-user"></i> Primer nombre</label>
                                        <input type="text" class="form-control" name="user_nombres" id="user_nombres" placeholder="Nombre" required></input>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="user_nombre_2" class=" control-label"><i class="fa fa-user"></i> Segundo nombre</label>
                                        <input type="text" class="form-control" name="user_nombre_2" placeholder="Nombre"></input>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="user_apellido_1" class=" control-label is-required"><i class="fa fa-user"></i> Primer apellido</label>
                                        <input type="text" class="form-control" name="user_apellidos" placeholder="Apellido" required></input>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="user_apellido_2" class=" control-label"><i class="fa fa-user"></i> Segundo apellido</label>
                                        <input type="text" class="form-control" name="user_apellido_2" placeholder="Apellido"></input>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="user_telefono" class=" control-label"><i class="fa fa-user"></i> N° teléfono</label>
                                        <input type="tel" class="form-control" name="user_telefono" id="user_telefono" maxlength="12" list="list_code" placeholder="N° teléfono" pattern="[0-9]{4}-[0-9]{7}"></input>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="user_correo" class=" control-label"><i class="fa fa-user"></i> Correo (Obligatorio para No cedulados)</label>
                                        <input type="email" class="form-control" name="user_correo" id="user_correo" placeholder="mi@correo.com"></input>
                                        <!-- <small class="form-text text-muted">Obligatorio para No cedulados</small> -->
                                    </div>
                                </div>





                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="user_genero" class=" control-label is-required"><i class="fa fa-user"></i> Género</label>
                                        <select name="user_genero" class="form-control" id="user_genero" required>
                                            <option value="">-GÉNERO-</option>
                                            <option value="<?php echo "Hombre"; ?>"><?php echo "Hombre"; ?></option>
                                            <option value="<?php echo "Mujer"; ?>"><?php echo "Mujer"; ?></option>

                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="user_f_nacimiento" class=" control-label is-required"><i class="fa fa-calendar"></i> Fecha nacimiento</label>
                                        <input type="date" name="user_f_nacimiento" required class="form-control" id="user_f_nacimiento" placeholder="Fecha de nacimiento" min="1928-01-01" max="2021-12-31"></input>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="user_comunity_type" class=" control-label is-required"><i class="fa fa-user"></i> Comunidad a la que pertenece</label>
                                        <select name="user_comunity_type" class="form-control" id="user_comunity_type" required>
                                            <option value="<?php echo "" ?>"> <?php echo "-SELECCIONE-" ?></option>
                                            <option value="<?php echo "Indígena" ?>"> <?php echo "Indígena" ?></option>
                                            <option value="<?php echo "Campesina" ?>"> <?php echo "Campesina" ?></option>
                                            <option value="<?php echo "Afrodescendiente" ?>"> <?php echo "Afrodescendiente" ?></option>
                                            <option value="<?php echo "Privado de Libertad" ?>"> <?php echo "Privado de Libertad" ?></option>
                                            <option value="<?php echo "No aplica" ?>"> <?php echo "No aplica" ?></option>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="user_etnia" class=" control-label is-required"><i class="fa fa-user"></i> Pueblo indígena</label>
                                        <select name="user_etnia" class="form-control" id="user_etnia" required>
                                            <option value="">-- ETNIA --</option>
                                            <?php foreach ($etnias as $name): ?>
                                                <option value="<?php echo $name["name"]; ?>"> <?php echo $name["name"]; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>





                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="disability_type" class=" control-label is-required"><i class="fa fa-user"></i> Posee alguna discapacidad</label>
                                        <select name="disability_type" class="form-control" id="disability_type" required>
                                            <option value="">-- DISCAPACIDAD --</option>
                                            <?php foreach ($discapacidad as $name): ?>
                                                <option value="<?php echo $name["disability"]; ?>"> <?php echo $name["disability"]; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="user_pertenece_organizacion" class=" control-label is-required"><i class="fa fa-user"></i> Pertenece a Organización social</label>
                                        <select name="user_pertenece_organizacion" class="form-control" required>
                                            <option value=""><?php echo "-SELECCIONE-" ?></option>
                                            <option value="<?php echo "No aplica" ?>"><?php echo "No aplica" ?></option>
                                            <option value="<?php echo "Consejo Comunal" ?>"><?php echo "Consejo Comunal" ?></option>
                                            <option value="<?php echo "Comuna" ?>"><?php echo "Comuna" ?></option>
                                            <option value="<?php echo "UBCH" ?>"><?php echo "UBCH" ?></option>
                                            <option value="<?php echo "Clap" ?>"><?php echo "Clap" ?></option>
                                            <option value="<?php echo "Comité" ?>"><?php echo "Comité" ?></option>
                                            <option value="<?php echo "Movimiento" ?>"><?php echo "Movimiento" ?></option>
                                            <option value="<?php echo "Colectivo" ?>"><?php echo "Colectivo" ?></option>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="user_organizacion" class=" control-label"><i class="fa fa-user"></i> Nombre de la Organización social</label>
                                        <input type="text" class="form-control" name="user_organizacion" value="" placeholder='Consejo comunal "Patria Grande" '></input>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="user_estado" class=" control-label is-required"><i class="fa fa-map"></i> Estado</label>
                                        <select name="user_estado" class="form-control" id="estados" required>
                                            <option value="">-ESTADO-</option>
                                            <?php foreach ($estado as $p): ?>
                                                <option value="<?php echo $p->id_estado; ?>"> <?php echo $p->estado; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group" id='recargar_munic'>
                                        <label for="user_municipio" class=" control-label is-required"><i class="fa fa-map"></i> Municipio</label>
                                        <select name="user_municipio" class="form-control" id="municipios_1" required>
                                            <option value="0">-MUNICIPIOS-</option>

                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="user_direccion" class=" control-label is-required is-required"><i class="fa fa-user"></i> Dirección</label>
                                        <input class="form-control" name="user_direccion" placeholder="Dirección" required></input>
                                    </div>
                                </div>


                                <!-- Datos academicos -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <nav class="navbar navbar-light bg-light">
                                            <span class="navbar-brand mb-0 h1"><span class="badge badge-secondary">Usuario</span>Datos académicos</span>
                                        </nav>
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="user_nivel_academ" class=" control-label is-required"><i class="fa fa-user"></i> Nivel académico</label>
                                        <select name="user_nivel_academ" class="form-control" id="user_nivel_academ" required>
                                            <option value=""><?php echo "-SELECCIONE-"; ?></option>
                                            <option value="<?php echo "Sin escolarización"; ?>"><?php echo "Sin escolarización"; ?></option>
                                            <option value="<?php echo "Educación preescolar"; ?>"><?php echo "Educación preescolar"; ?></option>
                                            <option value="<?php echo "Educación primaria"; ?>"><?php echo "Educación primaria"; ?></option>
                                            <option value="<?php echo "Primer ciclo de secundaria"; ?>"><?php echo "Primer ciclo de secundaria"; ?></option>
                                            <option value="<?php echo "Segundo ciclo de secundaria"; ?>"><?php echo "Segundo ciclo de secundaria"; ?></option>
                                            <option value="<?php echo "Tecnico medio"; ?>"><?php echo "Técnico medio"; ?></option>
                                            <option value="<?php echo "Técnico Superior Universitario"; ?>"><?php echo "Técnico Superior Universitario"; ?></option>
                                            <option value="<?php echo "Licenciatura universitaria"; ?>"><?php echo "Licenciatura universitaria"; ?></option>
                                            <option value="<?php echo "Estudios de cuarto nivel"; ?>"><?php echo "Estudios de cuarto nivel"; ?></option>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="user_profesion" class=" control-label is-required"><i class="fa fa-user"></i> Profesión</label>
                                        <select name="user_profesion" class="form-control" id="user_profesion" required>
                                            <option value=""><?php echo '-SELECCIONE-' ?></option>
                                            <option value="<?php echo 'Otra' ?>"><?php echo 'Otra' ?></option>
                                            <option value="<?php echo 'Sin títulos universitarios' ?>"><?php echo 'Sin títulos universitarios' ?></option>
                                            <?php foreach ($professions as $name): ?>
                                                <option value="<?php echo $name["p_name"]; ?>"> <?php echo $name["p_name"]; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="user_profesion" class=" control-label is-required"><i class="fa fa-user"></i> Ocupación</label>
                                        <select name="user_ocupacion" class="form-control" id="user_ocupacion" required>
                                            <option value=""><?php echo '-SELECCIONE-' ?></option>
                                            <option value="<?php echo 'Otra' ?>"><?php echo 'Otra' ?></option>
                                            <option value="<?php echo 'Desempleado' ?>"><?php echo 'Desempleado' ?></option>
                                            <option value="<?php echo 'Estudiante' ?>"><?php echo 'Estudiante' ?></option>
                                            <option value="<?php echo 'Formador/a en TIC' ?>"><?php echo 'Formador/a en TIC' ?></option>
                                            <?php foreach ($occupations as $name): ?>
                                                <option value="<?php echo $name["p_name"]; ?>"> <?php echo $name["p_name"]; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>



                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="user_empleado" class=" control-label is-required"><i class="fa fa-user"></i> Situación laboral</label>
                                        <select name="user_empleado" class="form-control" id="user_empleado" required>
                                            <option value="">-SELECCIONE-</option>
                                            <option value="<?php echo "Empleado"; ?>"><?php echo "Empleado"; ?></option>
                                            <option value="<?php echo "Jubilado"; ?>"><?php echo "Jubilado"; ?></option>
                                            <option value="<?php echo "Trabajo del hogar"; ?>"><?php echo "Trabajo del hogar"; ?></option>
                                            <option value="<?php echo "Trabajo independiente"; ?>"><?php echo "Trabajo independiente"; ?></option>
                                            <option value="<?php echo "No trabaja"; ?>"><?php echo "No trabaja"; ?></option>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="user_institucion" class=" control-label"><i class="fa fa-user"></i> Lugar dónde trabaja</label>
                                        <input type="text" class="form-control" name="user_institucion" placeholder="Institución de trabajo"></input>
                                    </div>
                                </div>





                                <!--  RRSS -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <nav class="navbar navbar-light bg-light">
                                            <span class="navbar-brand mb-0 h1"><span class="badge badge-secondary">RRSS</span>Redes sociales</span>(Si son varias redes separar con comas)
                                        </nav>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="red_x" class=" control-label"><i class="fa-brands fa-twitter"></i> Red X (Twitter)</label>
                                        <input class="form-control" name="red_x" placeholder="https://twitter.com/nombre_user"></input>
                                        <small class="form-text text-muted">Si son varias redes separar con comas.</small>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="red_facebook" class=" control-label"><i class="fa-brands fa-facebook"></i> Faceboock</label>
                                        <input class="form-control" name="red_facebook" placeholder="https://www.facebook/nombre_user"></input>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="red_instagram" class=" control-label"><i class="fa-brands fa-instagram"></i> Instagram</label>
                                        <input class="form-control" name="red_instagram" placeholder="https://www.instagram.com/nombre_user"></input>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="red_linkedin" class=" control-label"><i class="fa-brands fa-linkedin"></i> Linkedin</label>
                                        <input class="form-control" name="red_linkedin" placeholder="https://www.linkedin/in/nombre_user"></input>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="red_youtube" class=" control-label"><i class="fa-brands fa-youtube"></i> Youtube</label>
                                        <input class="form-control" name="red_youtube" placeholder="https://www.youtube.com/nombre_user"></input>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="red_tiktok" class=" control-label"><i class="fa-brands fa-tiktok"></i> Tiktok</label>
                                        <input class="form-control" name="red_tiktok" placeholder="https://www.tiktok/nombre_user"></input>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="red_whatsapp" class=" control-label"><i class="fa-brands fa-whatsapp"></i> Whatsapp</label>
                                        <input type="phone" class="form-control" name="phone" id="phone" placeholder="4261234567" maxlength="11"></input>
                                        <input type="hidden" class="form-control" name="red_whatsapp" id="red_whatsapp" placeholder="4261234567" maxlength="10"></input>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="red_telegram" class=" control-label"><i class="fa-brands fa-telegram"></i> Telegram</label>
                                        <input type="phone" class="form-control" name="phone_t" id="phone_t" placeholder="4261234567" maxlength="11"></input>
                                        <input type="hidden" class="form-control" name="red_telegram" id="red_telegram" placeholder="584261234567"></input>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="red_snapchat" class=" control-label"><i class="fa-brands fa-snapchat"></i> Snapchat</label>
                                        <input class="form-control" name="red_snapchat" placeholder="nombre_user"></input>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="red_pinterest" class=" control-label"><i class="fa-brands fa-pinterest"></i> Pinterest</label>
                                        <input class="form-control" name="red_pinterest" placeholder="https://www.pinterest.com/nombre_user"></input>
                                    </div>
                                </div>


                                <div class="col-md-12 ">
                                    <div class="form-group">
                                        <!-- <button type="submit" name="submit" class="btn btn-primary "> Guardar datos</button> -->
                                        <input class="btn btn-primary" type="submit" value="Guardar datos">
                                    </div>
                                </div>

                            </div>

                            </form>

                            <datalist id="list_code">
                                <option value="0412">
                                <option value="0414">
                                <option value="0416">
                                <option value="0424">
                                <option value="0426">
                            </datalist>


                </div>

            </div>
        </div>
    </div>

    <br><br>



    <script language="javascript">
        var controladorTiempo = "";
        var timer = "";


        $(document).ready(function() {

            var phone_w = "";
            var phone_t = "";
            $("#estados").change(function() {

                $('#municipios_1').find('option').remove().end().append('<option value=""></option>').val('0');
                // $('#ciudades').find('option').remove().end().append('<option value=""></option>').val('0');

                $("#estados option:selected").each(function() {
                    id_estado = $(this).val();

                    // alert(id_estado);
                    // alert($("#municipios").val());

                    $.post("core/app/view/getMunicipio.php", {
                        id_estado: id_estado
                    }, function(data) {
                        $("#municipios_1").html(data);
                    });

                    // $.post("core/app/view/getCiudad.php", { id_estado: id_estado }, function(data){
                    // $("#ciudades").html(data);
                    // });          
                });
            })


            // $("#municipios").change(function () {
            //     $("#municipios option:selected").each(function () {
            //         id_municipio = $(this).val();
            //     // alert(id_municipio);

            //         $.post("core/app/view/getParroquia.php", { id_municipio: id_municipio }, function(data){
            //             $("#parroquias").html(data);
            //         });            
            //     });
            // })



            // verificar si es cedulado
            $("#user_has_document").change(function() {
                var cedulado = $(this).val();
                if (cedulado != 'Si') {
                    document.getElementById("user_dni").type = "text";
                    document.getElementById("user_dni").setAttribute('maxlength', 11);
                    document.getElementById("user_dni").value = "No cedulado";
                    document.getElementById("user_dni").readOnly = true;
                    document.getElementById("user_dni").classList.remove("is-invalid");
                    document.getElementById("parent_dni_div").style.display = "block";
                    document.getElementById("child_number_div").style.display = "block";
                    document.getElementById("parent_dni").type = "number";
                    document.getElementById("parent_dni").required = true;
                    document.getElementById("child_number").required = true;
                    compareDni(' is-valid');
                    if (mobile) {
                        alert('¡AVISO! si el usuario no está cedulado requiere el Nº de documento de un representante');
                    } else {
                        toastify('¡AVISO! si el usuario no está cedulado requiere el Nº de documento de un representante', true, 10000, "warning");
                    }
                } else {
                    document.getElementById("user_dni").type = "number";
                    document.getElementById("user_dni").setAttribute('maxlength', 8);
                    document.getElementById("user_dni").value = "";
                    document.getElementById("user_dni").readOnly = false;
                    document.getElementById("user_dni").classList.remove("is-valid");
                    document.getElementById("parent_dni_div").style.display = "none";
                    document.getElementById("child_number_div").style.display = "none";
                    document.getElementById("parent_dni").required = false;
                    document.getElementById("child_number").required = false;
                    document.getElementById("parent_dni").type = "text";
                    document.getElementById("parent_dni").value = "No aplica";
                    document.getElementById("child_number").value = 0;
                    compareDni(' is-invalid');
                }


            })



            // retardo entre caracteres
            $(function() {
                $("#parent_dni").change(function() {
                    if ($("#parent_dni").val() != "" && $("#child_number").val() != "") {
                        clearTimeout(timer);
                        timer = setTimeout(getAjax, 800);
                    }
                });
            });
            $(function() {
                $("#child_number").change(function() {
                    if ($("#parent_dni").val() != "" && $("#child_number").val() != "") {
                        clearTimeout(timer);
                        timer = setTimeout(getAjax, 800);
                    }
                });
            });
            $(function() {
                $("#user_nombres").change(function() {
                    if ($("#parent_dni").val() != "" && $("#child_number").val() != "") {
                        clearTimeout(timer);
                        timer = setTimeout(getAjax, 800);
                    }
                });
            });

            function getAjax() {
                var parent_dni = document.getElementById("parent_dni").value;
                var child_number = document.getElementById("child_number").value;
                var parent_ref = parent_dni + child_number;
                $("#loading").show();
                $.ajax({
                        type: "POST",
                        url: "index.php?action=finaluser&function=getbyparent_ref",
                        data: {
                            parent_ref: parent_ref,
                            child_number: child_number
                        }
                    })
                    .done(function(msg) {
                        $("#loading").hide();
                        var array = JSON.parse(msg);
                        if (array["err"] == "null") {
                            if (mobile) {
                                alert(array["text"]);
                            } else {
                                toastify(array["text"], true, 20000, "warning");
                            }
                        }
                        if (array['param'] == 'parent_ref') {
                            $("#child_number").focus();
                            $("#child_number").val('0');
                        }
                    })
                    .fail(function(err) {
                        console.log("err ", err);
                    });
            }



            $(function() {
                $("#user_dni").change(function() {
                    clearTimeout(timer);
                    timer = setTimeout(get_dni, 800);
                });
            });

            function get_dni() {
                var user_dni = document.getElementById("user_dni").value;
                $.ajax({
                        type: "POST",
                        url: "index.php?action=finaluser&function=getbydni",
                        data: {
                            user_dni: user_dni
                        }
                    })
                    .done(function(msg) {
                        console.log(msg);
                        var array = JSON.parse(msg);
                        if (array["err"] == "null") {
                            if (mobile) {
                                alert(array["text"]);
                            } else {
                                toastify(array["text"], true, 20000, "warning");
                            }
                        }
                        if (array['param'] == 'dni') {
                            $("#user_dni").focus();
                            $("#user_dni").val("");
                        }
                    })
                    .fail(function(err) {
                        console.log("err ", err);
                    });
            }


            $(function() {
                $("#user_correo").change(function() {
                    clearTimeout(timer);
                    timer = setTimeout(get_email, 800);
                });
            });

            function get_email() {
                var user_correo = document.getElementById("user_correo").value;
                $.ajax({
                        type: "POST",
                        url: "index.php?action=finaluser&function=getbyemail",
                        data: {
                            user_correo: user_correo
                        }
                    })
                    .done(function(msg) {
                        console.log(msg);
                        var array = JSON.parse(msg);
                        if (array["err"] == "null") {
                            if (mobile) {
                                alert(array["text"]);
                            } else {
                                toastify(array["text"], true, 20000, "warning");
                            }
                        }
                        if (array['param'] == 'email') {
                            $("#user_correo").focus();
                            $("#user_correo").val("");
                            console.log(msg);
                        }
                    })
                    .fail(function(err) {
                        console.log("err ", err);
                    });
            }



            $("#user_dni").on("keyup", function() {
                user_dni = $(this).val();
                var user_has_document = document.getElementById("user_has_document").value;
                clearTimeout(controladorTiempo);

                if (user_has_document == 'Si') {
                    if (user_dni.length < 6 || user_dni.length > 8) {
                        // retardo entre caracteres
                        controladorTiempo = setTimeout(compareDni(' is-invalid'), 800);
                    } else {
                        document.getElementById("user_dni").classList.remove("is-invalid");
                        controladorTiempo = setTimeout(compareDni(' is-valid'), 800);
                    }
                }
            });

            $("#parent_dni").on("keyup", function() {
                user_dni = $(this).val();
                var user_has_document = document.getElementById("user_has_document").value;
                clearTimeout(controladorTiempo);

                if (user_has_document != 'Si') {
                    if (user_dni.length < 6 || user_dni.length > 8) {
                        // retardo entre caracteres
                        controladorTiempo = setTimeout(compareDniParent(' is-invalid'), 800);
                    } else {
                        document.getElementById("parent_dni").classList.remove("is-invalid");
                        controladorTiempo = setTimeout(compareDniParent(' is-valid'), 800);
                    }
                }
            });


            // validar telefono
            var numbers = /^[0-9_-]+$/;
            var valida = /^\d{4}-\d{7}$/;
            $("#user_telefono").on("keyup", function() {
                var tel = $(this).val();
                var element = document.getElementById("user_telefono");

                if (tel.length > 0) {
                    if (tel.match(valida)) {
                        element.classList.remove("is-invalid");
                        element.className += ' is-valid';
                    } else {
                        element.classList.remove("is-valid");
                        element.className += ' is-invalid';
                    }

                    // solo numeros y guiones
                    if (tel.match(numbers)) {
                        // 
                    } else {
                        alert("¡En el campo teléfono solo se aceptan números!");
                        document.getElementById("user_telefono").focus();
                        document.getElementById("user_telefono").value = tel.substring(0, tel.length - 1);
                    }
                    // colocar y quitar guion
                    if (tel.length > 4 && !tel.includes("-")) {
                        document.getElementById("user_telefono").value = tel.slice(0, 4) + "-" + (tel).slice(4);
                    } else if (tel.length == 5) {
                        document.getElementById("user_telefono").value = tel.replace("-", "");
                    }

                    // if (tel.length == 11) {
                    //     controladorTiempo = setTimeout(validaTele, 200);
                    // }
                } else {
                    document.getElementById("user_telefono").value = ""
                    element.classList.remove("is-invalid");
                    element.className += ' is-valid';
                }


            });

            // var telef = new RegExp("^(\\+34|0034|34)?[6789]\\d{8}$");


            // validar red_whatsapp
            var numbers_w = /^[0-9_+_-]+$/;
            // var valida_w = /^\d{10}$/;
            var valida_w = /^\d{3}-\d{7}$/;
            $("#phone").on("keyup", function() {
                var tel = $(this).val();
                var element = document.getElementById("phone");

                // console.log(phone_w);

                // const phoneNumber = phoneInput.getNumber();
                // console.log(phoneNumber);
                // console.log(tel);

                if (tel.length > 0) {
                    if (tel.match(valida_w)) {
                        element.classList.remove("is-invalid");
                        element.className += ' is-valid';
                    } else {
                        element.classList.remove("is-valid");
                        element.className += ' is-invalid';
                    }
                    // solo numeros y guiones
                    if (tel.match(numbers_w)) {
                        // 
                    } else {
                        alert("¡En el campo teléfono solo se aceptan números!");
                        document.getElementById("phone").focus();
                        document.getElementById("phone").value = tel.substring(0, tel.length - 1);
                    }
                    // quitar el cero
                    if (tel.length == 2 && tel.includes("0")) {
                        document.getElementById("phone").value = tel.replace("0", "");
                    }

                    if (tel.length > 3 && !tel.includes("-")) {
                        document.getElementById("phone").value = tel.slice(0, 3) + "-" + (tel).slice(3);
                    } else if (tel.length == 4) {
                        document.getElementById("phone").value = tel.replace("-", "");
                    }

                    document.getElementById("red_whatsapp").value = phone_w + document.getElementById("phone").value;
                    // console.log(document.getElementById("red_whatsapp").value);

                    // if (tel.length == 11) {
                    //     controladorTiempo = setTimeout(validaTele, 200);
                    // }
                } else {
                    document.getElementById("red_whatsapp").value = ""
                    element.classList.remove("is-invalid");
                    element.className += ' is-valid';
                }


            });

            // validar red_telegram
            var numbers_t = /^[0-9_+_-]+$/;
            // var valida_t = /^\d{10}$/;
            var valida_t = /^\d{3}-\d{7}$/;
            $("#phone_t").on("keyup", function() {
                var tel = $(this).val();
                var element = document.getElementById("phone_t");

                // const phoneNumber = phoneInput.getNumber();
                // console.log(phoneNumber);
                // console.log(tel);


                if (tel.length > 0) {
                    if (tel.match(valida_t)) {
                        element.classList.remove("is-invalid");
                        element.className += ' is-valid';
                    } else {
                        element.classList.remove("is-valid");
                        element.className += ' is-invalid';
                    }

                    // solo numeros y guiones
                    if (tel.match(numbers_t)) {
                        // 
                    } else {
                        alert("¡En el campo teléfono solo se aceptan números!");
                        document.getElementById("phone_t").focus();
                        document.getElementById("phone_t").value = tel.substring(0, tel.length - 1);
                    }
                    // quitar el cero
                    if (tel.length == 2 && tel.includes("0")) {
                        document.getElementById("phone_t").value = tel.replace("0", "");
                    }

                    if (tel.length > 3 && !tel.includes("-")) {
                        document.getElementById("phone_t").value = tel.slice(0, 3) + "-" + (tel).slice(3);
                    } else if (tel.length == 4) {
                        document.getElementById("phone_t").value = tel.replace("-", "");
                    }

                    document.getElementById("red_telegram").value = phone_t + document.getElementById("phone_t").value;
                    // console.log(document.getElementById("red_telegram").value);

                    // if (tel.length == 11) {
                    //     controladorTiempo = setTimeout(validaTele, 200);
                    // }
                } else {
                    document.getElementById("red_whatsapp").value = ""
                    element.classList.remove("is-invalid");
                    element.className += ' is-valid';
                }


            });






            var input_w = document.getElementById("phone");
            var phoneInput_w = window.intlTelInput(input_w, {
                preferredCountries: ["ve", "co", "us", "bz"],
                separateDialCode: true,
                // hiddenInput: "full_number",
                initialCountry: "ve",
                // geoIpLookup: function(callback) {
                //     $.get("http://ip-api.com/json/?fields=status,message,country", function() {}, "jsonp").always(function(resp) {
                //         var countryCode = (resp && resp.country) ? resp.country : "";
                //         callback(countryCode);
                //         console.log(countryCode);
                //     });
                // },

                // utilsScript: "assets/js/intl-tel-input-utils.js",
            });
            // window.phoneInput = phoneInput;
            input_w.addEventListener("countrychange", function() {
                phone_w = "+" + phoneInput_w.getSelectedCountryData().dialCode;
                document.getElementById("red_whatsapp").value = phone_w + input_w.value;
                // console.log(phone_w);
                // console.log(document.getElementById("red_whatsapp").value);
            });
            phone_w = "+" + phoneInput_w.getSelectedCountryData().dialCode;
            // phoneInput_w.destroy();


            var input = document.getElementById("phone_t");
            var phoneInput = window.intlTelInput(input, {
                preferredCountries: ["ve", "co", "us", "bz"],
                separateDialCode: true,
                initialCountry: "ve",
            });
            // window.phoneInput = phoneInput;
            input.addEventListener("countrychange", function() {
                phone_t = "+" + phoneInput.getSelectedCountryData().dialCode;
                document.getElementById("red_telegram").value = phone_t + input.value;
                // console.log(phone_t);
            });
            phone_t = "+" + phoneInput.getSelectedCountryData().dialCode;
            // phoneInput.destroy();





        });


        // preview uploaded image
        $("#profile_image").change(function() {
            filePreview(this);
        });

        function filePreview(input) {
            console.log(input.files[0]);
            // TAMANYO DE LA IMAGEN
            if (input.files[0].size > 10000000) {
                toastify('La imagen:\n ' + '"' + input.files[0].name + '"' + ' \nNo debe exceder 10MB de peso', true, 10000, "error");
                return;
            }

            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.readAsDataURL(input.files[0]);
                reader.onload = function(e) {
                    // $('#uploadForm + img').remove();
                    $('.avatar').remove();
                    $('#uploadForm').after('<img src="' + e.target.result + '" alt="Avatar" class="avatar"/>');
                }
            }
        }



        function compareDni(setclass) {
            var element = document.getElementById("user_dni");
            element.className += setclass;
        }

        function compareDniParent(setclass) {
            var element = document.getElementById("parent_dni");
            element.className += setclass;
        }


        function validaTele() {
            var tel = document.getElementById("user_telefono").value;
            if (tel.length == 4) {
                document.getElementById("user_telefono").value = tel + '-';
            }
        }
    </script>


    <style>
        .iti--allow-dropdown input,
        .iti--allow-dropdown input[type=text],
        .iti--allow-dropdown input[type=tel],
        .iti--separate-dial-code input,
        .iti--separate-dial-code input[type=text],
        .iti--separate-dial-code input[type=tel] {
            padding-right: 180px;
        }

        .is-required:after {
            content: '*';
            margin-left: 3px;
            color: red;
            font-weight: bold;
        }
    </style>