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

        var formObj = document.getElementById('userdata');
        // var user_id = document.getElementById('user_id').value;
        var dni = document.getElementById('user_dni').value;
        var user_has_document = document.getElementById("user_has_document").value;

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
            <div class="row justify-content-center">
                <h4 class="title">Registro de nuevo brigadista</h4>
            </div>
            <div class="row justify-content-center"> Ingresa la cedula o correo del usuario para anexarlo como brigadista</div>
            <br>
            
            <div class="row justify-content-center">
                <div class="col-6 text-center">
                    <a href="./admin/index.php?view=brigadas" class="btn btn-primary">Ir a brigadas</a>
                    <a href="./admin/index.php?view=brigadistas" class="btn btn-secondary">Ir a brigadistas</a>
                </div>
            </div>

            <br>



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


                    <!-- auto-registro -->
                    <form id="userdata" class="form-horizontal" accept-charset="UTF-8" method="post" action="index.php?action=brigade&function=add_new" role="form" enctype="multipart/form-data">

                        <input type="hidden" class="form-control" type="text" id="parent_ref" name="parent_ref" value=""></input>
                        <input type="hidden" name="profile" value="" id="profile">
                        <input type="hidden" name="user_f_nacimiento" value="" id="user_f_nacimiento">
                        <input type="hidden" name="id" value="" id="id">
                        <input type="hidden" name="user_municipio" value="" id="municipios_1">
                        <input type="hidden" name="info_cod" value="<?php echo $_SESSION['user_code_info'];?>" id="info_cod">


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

                            <div class="col-md-6" data-verify="true">
                                <div class="form-group" data-verify="true">
                                    <label for="user_has_document" class="control-label is-required"><i class="fa fa-user"></i> ¿Está cedulado?</label>
                                    <select name="user_has_document" class="form-control" id="user_has_document" required>
                                        <option value="">-Elige-</option>
                                        <option value="<?php echo "Si"; ?>" selected>Si</option>
                                        <option value="<?php echo "No"; ?>">No</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6" data-verify="true">
                                <div class="form-group" data-verify="true">
                                    <label for="user_dni" class="control-label is-required"><i class="fa fa-user"></i> N° documento (Para verificar si el usuario existe)</label>
                                    <input type="number" class="form-control" name="user_dni" id="user_dni" minlength="6" maxlength="8" placeholder="N° documento" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);if (this.value < 1) this.value = '',alert('El DNI no es válido');" required>
                                </div>
                            </div>
                            <div class="offset-md-9 col-md-3 col-9 offset-lg-10 mb-2" data-verify="true">
                                <a href="index.php?view=userform_new&new=1&swal=" class="btn btn-secondary" id="create_user_button" style="display:none">Crear usuario</a>
                            </div>
                            
                            <div class="col-md-6" id="user_id_div" style="display:none;" data-verify="true">
                                <div class="form-group" data-verify="true">
                                    <label for="user_id" class="control-label is-required"><i class="fa fa-user"></i> Id del usuario</label>
                                    <input type="number" class="form-control" name="user_id" id="user_id" placeholder="Id del usuario (UID)" >
                                </div>
                            </div>
                            
                            <div id="data_inputs" class="form-row">
                                <div class="col-md-6" data-verify="false">
                                    <div class="form-group">
                                        <label for="user_nombre_1" class=" control-label is-required"><i class="fa fa-user"></i> Primer nombre</label>
                                        <div class="input_wrap" style='cursor:not-allowed'>
                                            <input type="text" class="form-control" name="user_nombres" id="user_nombres" placeholder="Nombre" required disabled></input>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6" data-verify="false">
                                    <div class="form-group">
                                        <label for="user_nombre_2" class=" control-label"><i class="fa fa-user"></i> Segundo nombre</label>
                                        <input type="text" class="form-control" name="user_nombre_2" id="user_nombre_2" placeholder="Nombre" disabled></input>
                                    </div>
                                </div>


                                <div class="col-md-6" data-verify="false">
                                    <div class="form-group">
                                        <label for="user_apellido_1" class=" control-label is-required"><i class="fa fa-user"></i> Primer apellido</label>
                                        <input type="text" class="form-control" name="user_apellidos" id="user_apellidos" placeholder="Apellido" required disabled></input>
                                    </div>
                                </div>

                                <div class="col-md-6" data-verify="false">
                                    <div class="form-group">
                                        <label for="user_apellido_2" class=" control-label"><i class="fa fa-user"></i> Segundo apellido</label>
                                        <input type="text" class="form-control" name="user_apellido_2" id="user_apellido_2" placeholder="Apellido" disabled></input>
                                    </div>
                                </div>


                                <div class="col-md-6" data-verify="false">
                                    <div class="form-group">
                                        <label for="user_parroquia" class=" control-label is-required"><i class="fa fa-map"></i> Parroquia</label>
                                        <select name="user_parroquia" class="form-control" id="parroquias_1" required>
                                            <option value="0">-PARROQUIA-</option>

                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-6" data-verify="false">
                                    <div class="form-group" id='recargar_munic'>
                                        <label for="user_ciudad" class=" control-label is-required"><i class="fa fa-map"></i> Ciudad</label>
                                        <select name="user_ciudad" class="form-control" id="ciudades" required>
                                            <option value="0">-CIUDAD-</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6" data-verify="false">
                                    <div class="form-group">
                                        <label for="user_comunidad" class=" control-label is-required is-required"><i class="fa fa-user"></i> Comunidad</label>
                                        <input class="form-control" name="user_comunidad" id="user_comunidad" placeholder="Comunidad" required></input>
                                    </div>
                                </div>

                                <!--  RRSS -->
                                <div class="col-md-12" data-verify="false">
                                    <div class="form-group">
                                        <nav class="navbar navbar-light bg-light">
                                            <span class="navbar-brand mb-0 h1"><span class="badge badge-secondary">RRSS</span>Redes sociales</span>(Si son varias redes separar con comas)
                                        </nav>
                                    </div>
                                </div>

                                <div class="col-md-6" data-verify="false">
                                    <div class="form-group">
                                        <label for="red_x" class=" control-label"><i class="fa-brands fa-twitter"></i> Red X (Twitter)</label>
                                        <input class="form-control" name="red_x" id="red_x" placeholder="https://twitter.com/nombre_user"></input>
                                        <small class="form-text text-muted">Si son varias redes separar con comas.</small>
                                    </div>
                                </div>

                                <div class="col-md-6" data-verify="false">
                                    <div class="form-group">
                                        <label for="red_facebook" class=" control-label"><i class="fa-brands fa-facebook"></i> Faceboock</label>
                                        <input class="form-control" name="red_facebook" id="red_facebook" placeholder="https://www.facebook/nombre_user"></input>
                                    </div>
                                </div>

                                <div class="col-md-6" data-verify="false">
                                    <div class="form-group">
                                        <label for="red_instagram" class=" control-label"><i class="fa-brands fa-instagram"></i> Instagram</label>
                                        <input class="form-control" name="red_instagram" id="red_instagram" placeholder="https://www.instagram.com/nombre_user"></input>
                                    </div>
                                </div>

                                <div class="col-md-6" data-verify="false">
                                    <div class="form-group">
                                        <label for="red_linkedin" class=" control-label"><i class="fa-brands fa-linkedin"></i> Linkedin</label>
                                        <input class="form-control" name="red_linkedin" id="red_linkedin" placeholder="https://www.linkedin/in/nombre_user"></input>
                                    </div>
                                </div>

                                <div class="col-md-6" data-verify="false">
                                    <div class="form-group">
                                        <label for="red_youtube" class=" control-label"><i class="fa-brands fa-youtube"></i> Youtube</label>
                                        <input class="form-control" name="red_youtube" id="red_youtube" placeholder="https://www.youtube.com/nombre_user"></input>
                                    </div>
                                </div>

                                <div class="col-md-6" data-verify="false">
                                    <div class="form-group">
                                        <label for="red_tiktok" class=" control-label"><i class="fa-brands fa-tiktok"></i> Tiktok</label>
                                        <input class="form-control" name="red_tiktok" id="red_tiktok" placeholder="https://www.tiktok/nombre_user"></input>
                                    </div>
                                </div>

                                <div class="col-md-6" data-verify="false">
                                    <div class="form-group">
                                        <label for="red_whatsapp" class=" control-label"><i class="fa-brands fa-whatsapp"></i> Whatsapp</label>
                                        <input type="phone" class="form-control" name="phone" id="phone" placeholder="4261234567" maxlength="11"></input>
                                        <input type="hidden" class="form-control" name="red_whatsapp" id="red_whatsapp" placeholder="4261234567" maxlength="10"></input>
                                    </div>
                                </div>

                                <div class="col-md-6" data-verify="false">
                                    <div class="form-group">
                                        <label for="red_telegram" class=" control-label"><i class="fa-brands fa-telegram"></i> Telegram</label>
                                        <input type="phone" class="form-control" name="phone_t" id="phone_t" placeholder="4261234567" maxlength="11"></input>
                                        <input type="hidden" class="form-control" name="red_telegram" id="red_telegram" placeholder="584261234567"></input>
                                    </div>
                                </div>

                                <div class="col-md-6" data-verify="false">
                                    <div class="form-group">
                                        <label for="red_snapchat" class=" control-label"><i class="fa-brands fa-snapchat"></i> Snapchat</label>
                                        <input class="form-control" name="red_snapchat" id="red_snapchat" placeholder="nombre_user"></input>
                                    </div>
                                </div>

                                <div class="col-md-6" data-verify="false">
                                    <div class="form-group">
                                        <label for="red_pinterest" class=" control-label"><i class="fa-brands fa-pinterest"></i> Pinterest</label>
                                        <input class="form-control" name="red_pinterest" id="red_pinterest" placeholder="https://www.pinterest.com/nombre_user"></input>
                                    </div>
                                </div>

                                <div class="col-md-12" data-verify="false">
                                    <div class="form-group">
                                        <nav class="navbar navbar-light bg-light">
                                            <span class="navbar-brand mb-0 h1">Brigada</span>
                                        </nav>
                                    </div>
                                </div>
                                <div class="col-md-6" data-verify="false">
                                    <div class="form-group">
                                        <label for="user_brigada" class=" control-label"><i class="fa-brands fa-pinterest"></i> Brigada</label>
                                        <select name="user_brigada" class="form-control" id="brigada" required>
                                            <option value="0">-BRIGADAS-</option>

                                        </select>
                                    </div>
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

                    $.post("core/app/view/getCiudad.php", {
                        id_estado: id_estado
                    }, function(data) {
                        $("#ciudades").html(data);
                    });

                    $.post("core/app/view/getBrigadas.php", {
                        id_estado: id_estado
                    }, function(data) {
                        $("#brigada").html(data);
                    });


                    // $.post("core/app/view/getCiudad.php", { id_estado: id_estado }, function(data){
                    // $("#ciudades").html(data);
                    // });          
                });
            })

            $("#municipios_1").change(function() {

                $("#municipios_1 option:selected").each(function() {
                    id_municipio = $(this).val();

                    $.post("core/app/view/getParroquia.php", {
                        id_municipio: id_municipio
                    }, function(data) {
                        $("#parroquias_1").html(data);
                    });

                });
            })

            // $("#municipios").change(function () {
            //     $("#municipios option:selected").each(function () {
            //         id_municipio = $(this).val();
            //     // alert(id_municipio);

            //         $.post("core/app/view/getParroquia.php", { id_municipio: id_municipio }, function(data){
            //             $("#parroquias_1").html(data);
            //         });            
            //     });
            // })

            function hideAll() {
                $("#data_inputs").css("display", "none");
            }

            hideAll();


            // verificar si es cedulado
            $("#user_has_document").change(function() {
                var cedulado = $(this).val();
                if (cedulado != 'Si') {
                    document.getElementById("user_dni").type = "text";
                    document.getElementById("user_dni").setAttribute('maxlength', 11);
                    document.getElementById("user_dni").value = "No cedulado";
                    document.getElementById("user_dni").readOnly = true;
                    document.getElementById("user_dni").classList.remove("is-invalid");
                    document.getElementById("user_id").disabled = false;

                    document.getElementById("user_id_div").style.display = "block";
                    $("#user_id").change(function() {
                        console.log("user_id");
                        clearTimeout(timer);
                        timer = setTimeout(get_uid, 800);
                    });

                    compareDni(' is-valid');
                    if (mobile) {
                        alert('¡AVISO! si el usuario no está cedulado requiere su correo electronico');
                    } else {
                        toastify('¡AVISO! si el usuario no está cedulado requiere su correo electronico', true, 10000, "warning");
                    }
                } else {
                    document.getElementById("user_dni").type = "number";
                    document.getElementById("user_dni").setAttribute('maxlength', 8);
                    document.getElementById("user_dni").value = "";
                    document.getElementById("user_dni").readOnly = false;
                    document.getElementById("user_dni").classList.remove("is-valid");
                    document.getElementById("user_id").disabled = true;

                    document.getElementById("user_id_div").style.display = "none";

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

            async function get_dni() {
                var user_dni = document.getElementById("user_dni").value;
                var brigadier_exists = false;
                await $.ajax({
                        type: "POST",
                        url: "index.php?action=brigade&function=getBrigadierByDni",
                        data: {
                            user_dni: user_dni
                        }
                    })
                    .done(function(msg) {
                        var array = JSON.parse(msg);
                        if (array["success"] == "true") {
                            if (mobile) {
                                alert("El brigadista ya esta registrado");
                            } else {
                                toastify("El brigadista ya esta registrado", true, 20000, "warning");
                            }
                            brigadier_exists = true;
                            hideAll();
                        } else {
                            brigadier_exists = false;
                        }

                    })
                    .fail(function(err) {
                        console.log("err ", err);
                    });

                if (!brigadier_exists) {
                    $.ajax({
                            type: "POST",
                            url: "index.php?action=brigade&function=getUserDataByDni",
                            data: {
                                user_dni: user_dni
                            }
                        })
                        .done(function(msg) {
                            var array = JSON.parse(msg);
                            if (array["success"] == "true") {
                                if (mobile) {
                                    alert(array["text"]);
                                } else {
                                    toastify(array["text"], true, 20000, "dashboard");
                                }
                                hiddenCreateUserButton();
                                fillForm(array["data"]);
                            } else {
                                toastify(array["text"], true, 20000, "warning");
                                showCreateUserButton();
                                hideAll();

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
            }


            function showCreateUserButton() {
                document.getElementById("create_user_button").style.display = "inline-flex";
            }

            function hiddenCreateUserButton() {
                document.getElementById("create_user_button").style.display = "none";
            }
            $(function() {
                $("#user_id").change(function() {
                    clearTimeout(timer);
                    timer = setTimeout(get_uid, 800);
                });
            });

            async function get_uid() {
                var user_id = document.getElementById("user_id").value;
                let brigadier_exists;
                console.log(user_id);
                await $.ajax({
                        type: "POST",
                        url: "index.php?action=brigade&function=getBrigadierByUID",
                        data: {
                            user_id: user_id
                        }
                    })
                    .done(function(msg) {
                        var array = JSON.parse(msg);
                        if (array["success"] == "true") {
                            if (mobile) {
                                alert("El brigadista ya esta registrado");
                            } else {
                                toastify("El brigadista ya esta registrado", true, 20000, "warning");
                            }
                            hideAll();
                            hiddenCreateUserButton();

                            brigadier_exists = true;
                        } else {
                            brigadier_exists = false;
                        }

                    })
                    .fail(function(err) {
                        console.log("err ", err);
                    });

                console.log(brigadier_exists);
                if (!brigadier_exists) {
                    $.ajax({
                            type: "POST",
                            url: "index.php?action=brigade&function=getUserDataById",
                            data: {
                                user_id: user_id
                            }
                        })
                        .done(function(msg) {
                            var array = JSON.parse(msg);
                            if (array["success"] == "true") {
                                if (mobile) {
                                    alert(array["text"]);
                                } else {
                                    toastify(array["text"], true, 20000, "dashboard");
                                }
                                hiddenCreateUserButton();

                                fillForm(array["data"]);

                            } else {
                                toastify(array["text"], true, 20000, "warning");
                                showCreateUserButton();
                                hideAll();

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

            }


            function fillForm(data) {
                console.log(data);
                $("#data_inputs").css("display", "flex");

                $("#id").val(data["id"]);

                $("#user_nombres").val(data["user_nombres"]);
                $("#user_nombre_2").val(data["user_nombre_2"]);

                $("#user_apellidos").val(data["user_apellidos"]);
                $("#user_apellido_2").val(data["user_apellido_2"]);

                $("#user_dni").val(data["user_dni"]);
                $("#user_correo").val(data["user_correo"]);
                $("#user_telefono").val(data["user_telefono"]);
                $("#user_genero").val(data["user_genero"]);
                $("#user_f_nacimiento").val(data["user_f_nacimiento"]);
                $("#user_edad").val(data["user_edad"]);

                $("#estados").val(data["user_estado"]);



                $.post("core/app/view/getMunicipio.php", {
                    id_estado: data["user_estado"]
                }, function(municipios) {
                    $("#municipios_1").html(municipios);
                    $("#municipios_1").val(data["user_municipio"]);
                });

                $.post("core/app/view/getParroquia.php", {
                    id_municipio: data["user_municipio"]
                }, function(parroquias_1) {
                    $("#parroquias_1").html(parroquias_1);
                });

                $.post("core/app/view/getCiudad.php", {
                    id_estado: data["user_estado"]
                }, function(ciudades) {
                    $("#ciudades").html(ciudades);
                });

                $("#user_pertenece_organizacion").val(data["user_pertenece_organizacion"]);
                $("#disability_type").val(data["disability_type"]);
                $("#user_organizacion").val(data["user_organizacion"]);
                $("#user_comunity_type").val(data["user_comunity_type"]);
                $("#user_etnia").val(data["user_etnia"]);
                $("#user_direccion").val(data["user_direccion"]);

                $("#user_nivel_academ").val(data["user_nivel_academ"]);
                $("#user_profesion").val(data["user_profesion"]);
                $("#user_ocupacion").val(data["user_ocupacion"]);
                $("#user_empleado").val(data["user_empleado"]);
                $("#user_institucion").val(data["user_institucion"]);

                $("#red_x").val(data["red_x"]);
                $("#red_facebook").val(data["red_facebook"]);
                $("#red_instagram").val(data["red_instagram"]);
                $("#red_linkedin").val(data["red_linkedin"]);
                $("#red_youtube").val(data["red_youtube"]);
                $("#red_tiktok").val(data["red_tiktok"]);
                $("#red_whatsapp").val(data["red_whatsapp"]);
                $("#red_telegram").val(data["red_telegram"]);
                $("#red_snapchat").val(data["red_snapchat"]);
                $("#red_pinterest").val(data["red_pinterest"]);

                $("#red_pinterest").val(data["red_pinterest"]);

                $.post("core/app/view/getBrigadas.php", {
                    id_estado: data["user_estado"]
                }, function(municipios) {
                    $("#brigada").html(municipios);
                    $("#brigada").val(data["user_brigada"]);
                });

                // $("#user_estado").val(data["user_estado"]);
                // $("#user_municipio").val(data["user_municipio"]);
                // $("#user_direccion").val(data["user_direccion"]);
                // $("#parroquias_1").val(data["parroquia"]);
            }

            function openForm() {

                $("#data_inputs").css("display", "flex");

                $("#user_correo").val($("#email_user").val());

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