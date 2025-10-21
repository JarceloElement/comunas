<?php
if (Session::getUID() == "") {
    print "<script>window.location='index.php';</script>";
}
$estado = EstadoData::getAll();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$con = Database::getCon();
$etnias = $con->query("SELECT * from etnia_type");
$discapacidad = $con->query("SELECT * from disability_type");
$professions = $con->query("SELECT * from professions order by p_name");
$occupations = $con->query("SELECT * from occupations order by p_name");

$user_brigade_id = $_GET["id"];

$sql = "SELECT 
		final_users.id as user_id, 
		user_brigades.id as user_brigade_id, 
		final_users.user_estado as estado,
		brigades.info_cod as info_cod,
		brigades.nombre as brigada,
        final_users.user_has_document as user_has_document,
        final_users.user_nationality as user_nationality,
		final_users.user_nombres as primer_nombre,
        final_users.user_nombre_2 as segundo_nombre,
		final_users.user_apellidos as primer_apellido,
        final_users.user_apellido_2 as segundo_apellido,
        final_users.user_correo as correo,
        final_users.user_estado as estado,
        final_users.user_municipio as u_municipio,
        user_brigades.parroquia as parroquia,
        user_brigades.ciudad as ciudad,
        user_brigades.comunidad as comunidad,
        user_brigades.fk_id_brigade,
        final_users.red_x as red_x,
        final_users.red_facebook as red_facebook,
        final_users.red_instagram as red_instagram,
        final_users.red_linkedin as red_linkedin,
        final_users.red_youtube as red_youtube,
        final_users.red_whatsapp as red_whatsapp,
        final_users.red_telegram as red_telegram,
        final_users.red_tiktok as red_tiktok,
        final_users.red_snapchat as red_snapchat,
        final_users.red_pinterest as red_pinterest,
		final_users.user_has_document as cedulado,
		final_users.user_dni as cedula,
		final_users.user_f_nacimiento as f_nacimiento,
		final_users.user_edad as edad,
		final_users.user_telefono as telefono,
		final_users.user_fecha_reg as fecha_reg
		FROM final_users INNER JOIN user_brigades ON final_users.id = user_brigades.fk_id_user INNER JOIN brigades ON user_brigades.fk_id_brigade = brigades.id WHERE user_brigades.id = $user_brigade_id";

$base = new DatabasePg();
$conn = $base->connectPg();

$user = FinalUsersData::getBySQLPg($sql)[0];

// var_dump(value: $user);

$nombre_estado = $user["estado"];
$municipio = $user["u_municipio"];
$parroquia = $user["parroquia"];

$estado_id = EstadoData::getByNmae("'$nombre_estado'")->id_estado;
// $sql = "select * from municipios where id_estado=$estado_id";
// $municipios = MunicipioData::getBySQL($sql);

// $nombre_municipio = $user["municipio"];
// $user_municipio_id = MunicipioData::getByName("'$nombre_municipio'")->id_municipio;

// $sql = "select * from parroquias where id_municipio=$user_municipio_id";
// $parroquias = ParroquiaData::getBySQL($sql);

// $sql = "select * from ciudades where id_estado=$estado_id";
// $ciudades = ParroquiaData::getBySQL($sql);

$row_table = $conn->prepare("SELECT * from brigades where estado = '$nombre_estado' ");
$row_table->execute();
$brigadas = $row_table->fetchAll(PDO::FETCH_ASSOC);

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
                    <h4 class="title">Editando el perfil de <?php echo $user["primer_nombre"] ?><?php echo $user["primer_apellido"] ?></h4>
                </div>
                <div class="row justify-content-center"> Modifica los datos del brigadista</div>
                <br>
                <!-- saludo desde crear nuevo usuario -->
            <?php } else { ?>
                <div class="row justify-content-center">
                    <h4 class="title"><?php echo "Registro de nuevo brigadista" ?></h4>
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


                    <!-- auto-registro -->
                    <form id="userdata" class="form-horizontal" accept-charset="UTF-8" method="post" action="index.php?action=brigade&function=update" role="form" enctype="multipart/form-data">

                        <input type="hidden" class="form-control" type="text" id="user_brigade_id" name="user_brigade_id" value="<?php echo $_GET['id']; ?>"></input>
                        <input type="hidden" name="info_cod" value="<?php echo ($user['info_cod']) ?>" id="info_cod">
                        <input type="hidden" name="user_municipio" value="<?php echo ($user['u_municipio']) ?>">
                        <input type="hidden" name="fk_id_brigade" value="<?php echo ($user['fk_id_brigade']) ?>">

                        <input type="hidden" class="form-control" type="text" id="parent_ref" name="parent_ref" value=""></input>
                        <input type="hidden" name="profile" value="" id="profile">
                        <input type="hidden" name="id" value="" id="id">
                        <input type="hidden" name="user_id" value="<?php echo ($user['user_id']) ?>" id="user_id">
                        <input type="hidden" type="text" value="<?php echo ($user['f_nacimiento']) ?>" class="form-control" name="user_f_nacimiento" id="user_f_nacimiento"></input>


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
                                        <span class="navbar-brand mb-0 h1"><span class="badge badge-secondary">Usuario</span>Datos de perfil</span><span class="badge badge-primary">Los datos completos del usuario se modifican en el modulo de usuarios</span>
                                        <!-- <input id="red_telegram" type="tel" name="red_telegram"> -->
                                    </nav>
                                </div>
                            </div>


                            <div class="col-md-3" data-verify="true">
                                <div class="form-group">
                                    <label for="user_nationality" class="control-label is-required"><i class="fa fa-user"></i> Nacionalidad</label>
                                    <select disabled name="user_nationality" class="form-control" id="user_nationality" required>
                                        <option value="<?php echo "V"; ?>" <?php echo (($user["user_nationality"] == "V") ? "selected" : ""); ?>><?php echo "V"; ?></option>
                                        <option value="<?php echo "E"; ?>" <?php echo (($user["user_nationality"] == "E") ? "selected" : ""); ?>><?php echo "E"; ?></option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3" data-verify="true">
                                <div class="form-group" data-verify="true">
                                    <label for="user_has_document" class="control-label is-required"><i class="fa fa-user"></i> ¿Está cedulado?</label>
                                    <select disabled name="user_has_document" class="form-control" id="user_has_document" required>
                                        <option value="">-Elige-</option>
                                        <option value="<?php echo "Si"; ?>" <?php echo (($user["user_has_document"] == "Si") ? "selected" : ""); ?>>Si</option>
                                        <option value="<?php echo "No"; ?>" <?php echo (($user["user_has_document"] != "Si") ? "selected" : ""); ?>>No</option>
                                    </select>
                                </div>
                            </div>



                            <div class="col-md-6" data-verify="true">
                                <div class="form-group" data-verify="true">
                                    <label for="user_dni" class="control-label is-required"><i class="fa fa-user"></i> N° documento (Para verificar si el usuario existe)</label>
                                    <input disabled type="number" value="<?php echo ($user['cedula']) ?>" class="form-control" name="user_dni" id="user_dni" minlength="6" maxlength="8" placeholder="N° documento" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);if (this.value < 1) this.value = '',alert('El DNI no es válido');" required>
                                </div>
                            </div>

                            <div class="col-md-6" id="parent_dni_div" style="display:none" data-verify="true">
                                <div class="form-group">
                                    <label for="email_user" class=" control-label" style="color:red;"><i class="fa fa-user"></i> Correo (Solo no cedulados)</label>
                                    <input disabled type="text" value="<?php echo ($user['correo']) ?>" class="form-control" name="email_user" id="email_user" minlength="6" placeholder="Correo del usuario" disabled>
                                </div>
                            </div>

                            <div id="data_inputs" class="form-row">
                                <div class="col-md-6" data-verify="false">
                                    <div class="form-group">
                                        <label for="user_nombre_1" class=" control-label is-required"><i class="fa fa-user"></i> Primer nombre</label>
                                        <div class="input_wrap" style='cursor:not-allowed'>
                                            <input disabled type="text" value="<?php echo ($user['primer_nombre']) ?>" class="form-control" name="user_nombres" id="user_nombres" placeholder="Nombre" required></input>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6" data-verify="false">
                                    <div class="form-group">
                                        <label for="user_nombre_2" class=" control-label"><i class="fa fa-user"></i> Segundo nombre</label>
                                        <input disabled type="text" value="<?php echo ($user['segundo_nombre']) ?>" class="form-control" name="user_nombre_2" id="user_nombre_2" placeholder="Nombre"></input>
                                    </div>
                                </div>


                                <div class="col-md-6" data-verify="false">
                                    <div class="form-group">
                                        <label for="user_apellido_1" class=" control-label is-required"><i class="fa fa-user"></i> Primer apellido</label>
                                        <input disabled type="text" value="<?php echo ($user['primer_apellido']) ?>" class="form-control" name="user_apellidos" id="user_apellidos" placeholder="Apellido" required></input>
                                    </div>
                                </div>

                                <div class="col-md-6" data-verify="false">
                                    <div class="form-group">
                                        <label for="user_apellido_2" class=" control-label"><i class="fa fa-user"></i> Segundo apellido</label>
                                        <input disabled type="text" value="<?php echo ($user['segundo_apellido']) ?>" class="form-control" name="user_apellido_2" id="user_apellido_2" placeholder="Apellido"></input>
                                    </div>
                                </div>


                                <div class="col-md-6" data-verify="false">
                                    <div class="form-group">
                                        
                                        <label for="user_municipios_1" class=" control-label is-required"><i class="fa fa-map"></i> Municipio</label>
                                        <select name="user_municipio" class="form-control" id="municipios_1" required>
                                            <option value="<?php echo isset($user['u_municipio'])!="" ? $user['u_municipio']: '0';?>"><?php echo $user['u_municipio'];?></option>

                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-6" data-verify="false">
                                    <div class="form-group">
                                        <label for="user_parroquia" class=" control-label is-required"><i class="fa fa-map"></i> Parroquia</label>
                                        <select name="user_parroquia" class="form-control" id="parroquias_1" required>
                                            <option value="<?php echo isset($user['parroquia'])!="" ? $user['parroquia']: '0';?>"><?php echo isset($user['parroquia'])!="" ? $user['parroquia'] : '-PARROQUIA-';?></option>

                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-6" data-verify="false">
                                    <div class="form-group" id='recargar_munic'>
                                        <label for="user_ciudad" class=" control-label is-required"><i class="fa fa-map"></i> Ciudad</label>
                                        <select name="user_ciudad" class="form-control" id="ciudades" required>
                                            <option value="<?php echo isset($user['ciudad'])!="" ? $user['ciudad']: '0';?>"><?php echo isset($user['ciudad'])!="" ? $user['ciudad'] : '-CIUDAD-';?></option>

                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6" data-verify="false">
                                    <div class="form-group">
                                        <label for="user_comunidad" class=" control-label is-required is-required"><i class="fa fa-user"></i> Comunidad</label>
                                        <input class="form-control" value="<?php echo $user["comunidad"]; ?>" name="user_comunidad" id="user_comunidad" placeholder="Comunidad" required></input>
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
                                        <input class="form-control" name="red_x" id="red_x" value="<?php echo $user["red_x"]; ?>" placeholder="https://twitter.com/nombre_user"></input>
                                        <small class="form-text text-muted">Si son varias redes separar con comas.</small>
                                    </div>
                                </div>

                                <div class="col-md-6" data-verify="false">
                                    <div class="form-group">
                                        <label for="red_facebook" class=" control-label"><i class="fa-brands fa-facebook"></i> Faceboock</label>
                                        <input class="form-control" name="red_facebook" value="<?php echo $user["red_facebook"]; ?>" id="red_facebook" placeholder="https://www.facebook/nombre_user"></input>
                                    </div>
                                </div>

                                <div class="col-md-6" data-verify="false">
                                    <div class="form-group">
                                        <label for="red_instagram" class=" control-label"><i class="fa-brands fa-instagram"></i> Instagram</label>
                                        <input class="form-control" name="red_instagram" value="<?php echo $user["red_instagram"]; ?>" id="red_instagram" placeholder="https://www.instagram.com/nombre_user"></input>
                                    </div>
                                </div>

                                <div class="col-md-6" data-verify="false">
                                    <div class="form-group">
                                        <label for="red_linkedin" class=" control-label"><i class="fa-brands fa-linkedin"></i> Linkedin</label>
                                        <input class="form-control" name="red_linkedin" value="<?php echo $user["red_linkedin"]; ?>" id="red_linkedin" placeholder="https://www.linkedin/in/nombre_user"></input>
                                    </div>
                                </div>

                                <div class="col-md-6" data-verify="false">
                                    <div class="form-group">
                                        <label for="red_youtube" class=" control-label"><i class="fa-brands fa-youtube"></i> Youtube</label>
                                        <input class="form-control" name="red_youtube" value="<?php echo $user["red_youtube"]; ?>" id="red_youtube" placeholder="https://www.youtube.com/nombre_user"></input>
                                    </div>
                                </div>

                                <div class="col-md-6" data-verify="false">
                                    <div class="form-group">
                                        <label for="red_tiktok" class=" control-label"><i class="fa-brands fa-tiktok"></i> Tiktok</label>
                                        <input class="form-control" name="red_tiktok" value="<?php echo $user["red_tiktok"]; ?>" id="red_tiktok" placeholder="https://www.tiktok/nombre_user"></input>
                                    </div>
                                </div>

                                <div class="col-md-6" data-verify="false">
                                    <div class="form-group">
                                        <label for="red_whatsapp" class=" control-label"><i class="fa-brands fa-whatsapp"></i> Whatsapp</label>
                                        <input type="phone" class="form-control" name="phone" id="phone" placeholder="4261234567" maxlength="11" value="<?php echo $user["red_whatsapp"]; ?>"></input>
                                        <input type="hidden" class="form-control" name="red_whatsapp" id="red_whatsapp" placeholder="4261234567" maxlength="10"></input>
                                    </div>
                                </div>

                                <div class="col-md-6" data-verify="false">
                                    <div class="form-group">
                                        <label for="red_telegram" class=" control-label"><i class="fa-brands fa-telegram"></i> Telegram</label>
                                        <input type="phone" class="form-control" name="phone_t" id="phone_t" placeholder="4261234567" maxlength="11" value="<?php echo $user["red_telegram"]; ?>"></input>
                                        <input type="hidden" class="form-control" name="red_telegram" id="red_telegram" placeholder="584261234567"></input>
                                    </div>
                                </div>

                                <div class="col-md-6" data-verify="false">
                                    <div class="form-group">
                                        <label for="red_snapchat" class=" control-label"><i class="fa-brands fa-snapchat"></i> Snapchat</label>
                                        <input class="form-control" name="red_snapchat" value="<?php echo $user["red_snapchat"]; ?>" id="red_snapchat" placeholder="nombre_user"></input>
                                    </div>
                                </div>

                                <div class="col-md-6" data-verify="false">
                                    <div class="form-group">
                                        <label for="red_pinterest" class=" control-label"><i class="fa-brands fa-pinterest"></i> Pinterest</label>
                                        <input class="form-control" name="red_pinterest" value="<?php echo $user["red_pinterest"]; ?>" id="red_pinterest" placeholder="https://www.pinterest.com/nombre_user"></input>
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
                                            <option value="<?php echo isset($user['fk_id_brigade'])!="" ? $user['fk_id_brigade']: '0';?>"><?php echo $user['brigada'];?></option>
                                            <option value="0">-BRIGADAS-</option>
                                            <?php foreach ($brigadas as $brigada): ?>
                                                <option value="<?php echo $brigada["id"]; ?>"> <?php echo $brigada["nombre"]; ?></option>
                                                <!-- <option value="<!?php echo $brigada["id"]; ?>" <!?php echo (($user["brigada"] == $brigada["nombre"]) ? "selected" : ""); ?>> <!?php echo $brigada["nombre"]; ?></option> -->
                                            <?php endforeach; ?>

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

    <script>
        $(document).ready(function() {

            var id_estado = '<?php echo $estado_id; ?>';

            $.post("core/app/view/getMunicipio.php", {
                id_estado: id_estado
            }, function(data) {
                console.log(data);
                $("#municipios_1").append(data);
            });

            $.post("core/app/view/getCiudad.php", {
                id_estado: id_estado
            }, function(data) {
                $("#ciudades").append(data);
            });


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

        });




        $(document).ready(function() {
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