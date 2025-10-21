<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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
$estados = $con->query("SELECT * from estados order by estado");


$brigade_id = $_GET["id"];

$sql = "SELECT * FROM brigades WHERE id = $brigade_id";

$base = new DatabasePg();
$conn = $base->connectPg();

$brigade = BrigadeData::getBySQLPg($sql)[0];
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

    $(function() {
        $("#code_info").change(function() {
            code = $(this).val();
            // alert(code);
            $.post("admin/core/app/view/getReportLocation-view.php", {
                code_info: code
            }, function(data) {
                // console.log(data);
                var array = JSON.parse(data);

                if (array["error"] == "true") {
                    document.getElementById("code_info").value = "";
                    alert("No existe el código: " + code + ". Por favor consulta a tu soporte InfoApp para registrar tu código");

                } else {

                    if (getOS() == "Android") {
                        alert("Se ha cargado la dirección registrada en el infocentro, por favor verifica que sea correcta al igual que la ortografía");
                    } else {
                        toastify('Se ha cargado la dirección registrada en el infocentro, por favor verifica que sea correcta al igual que la ortografía', true, 15000, "warning");
                    }

                }
            });
        });
    });
    
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

<!-- FORM -->
<div class="container">
    <br><br>
    <div class="row justify-content-center">

        <div class="col-md-12">

            <div class="row justify-content-center"><span class="material-icons">&#xE87C;</span></div>
            <!-- saludo al iniciar sesion -->
            <?php if ($is_new != "1") { ?>
                <div class="row justify-content-center">
                    <h4 class="title">Editar brigada</h4>
                </div>
                <!-- <div class="row justify-content-center"> Por favor registra los datos de perfil, se usarán para tu record académico y gestión de indicadores</div> -->
                <br>
                <!-- saludo desde crear nuevo usuario -->   
            <?php } else { ?>
                <div class="row justify-content-center">
                    <h4 class="title">Registro de nueva brigada</h4>
                </div>
            <?php } ?>

                    <form id="userdata" class="form-horizontal" accept-charset="UTF-8" method="post" action="admin/index.php?action=brigade&function=update" role="form" enctype="multipart/form-data">
                        <input type="hidden" class="form-control" name="id" id="id" value="<?php echo($brigade['id'])?>" required></input>

                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <nav class="navbar navbar-light bg-light">
                                            <span class="navbar-brand mb-0 h1"><span class="badge badge-secondary">Brigada</span>Datos</span>
                                        </nav>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="nombre" class=" control-label is-required"><i class="fa fa-user"></i> Nombre de la brigada</label>
                                        <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" value="<?php echo($brigade['nombre'])?>" required></input>
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="info_cod" class=" control-label is-required"><i class="fa fa-user"></i> Codigo del infocentro</label>
                                        <?php if($_SESSION["user_type"] == 4 || $_SESSION["user_type"] == 5 || $_SESSION["user_type"] == 6 || $_SESSION["user_type"] == 7):?>
                                            <input id="code_info" type="text" class="form-control" name="info_cod" placeholder="Codigo" value="<?php echo($brigade['info_cod'])?>" required></input>
                                        <?php elseif($_SESSION["user_type"] == 1 || $_SESSION["user_type"] == 2 || $_SESSION["user_type"] == 3 || $_SESSION["user_type"] == 8 ): ?>
                                                <input id="code_info" disabled type="text" class="form-control" name="info_cod" placeholder="Codigo" value="<?php echo($brigade['info_cod'])?>" required></input>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="col-md-12 ">
                                    <div class="form-group">
                                        <!-- <button type="submit" name="submit" class="btn btn-primary "> Guardar datos</button> -->
                                        <input class="btn btn-primary" type="submit" value="Guardar datos">
                                    </div>
                                </div>
                            </form>
                </div>
            </div>
        </div>
    </div>



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