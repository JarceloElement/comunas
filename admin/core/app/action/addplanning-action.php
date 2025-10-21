
<?php
/**
 * infocentro
 * @author jarcelo
 **/
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// se asigna en cpanel
ini_set('max_execution_time', '3000');
set_time_limit(600);

date_default_timezone_set('UTC');
date_default_timezone_set("America/La_Paz");



if ((isset($_POST["code_info"]) && isset($_POST["estado"])) && ($_POST["code_info"] == "" || $_POST["estado"] == "")) {
    return Core::redir($_GET['location'] . "&ConfirmButton=true&swal=Por favor vuelve atrás y escribe el código del infocentro.");
}

if ($_POST["estado"] == "") {
    // con psql
    $statement_1 = InfoData::getByCode($_GET["code_info"]);

    if ($statement_1 != "null") {
        $estado  = $statement_1['estado'];
        $municipio  = $statement_1['municipio'];
        $parroquia  = $statement_1['parroquia'];
        $ciudad  = $statement_1['ciudad'];
        $direccion  = $statement_1['direccion'];
    }
} else {
    $estado  = $_POST["estado"];
    $municipio  = $_POST['municipio'];
    $parroquia  = $_POST['parroquia'];
    $ciudad  = $_POST['ciudad'];
    $direccion  = $_POST['direccion'];
}



// echo $estado;
// $rx = PlanningActivityData::getRepeated($_POST["cod"],$_POST["nombre"]);
// if($rx==null){





$images = "Sin registro fotográfico";

$phone = $_POST["responsable_tel"];
$dni = $_POST["responsible_dni"];
$email = $_POST["responsible_email"];

if ($_POST["responsable_tipo"] == "Facilitador") {
    $sql = "UPDATE facilitators SET phone_number='$phone', email='$email' WHERE document_number='$dni' ";
}
if ($_POST["responsable_tipo"] == "Coordinador" || $_POST["responsable_tipo"] == "Jefe de Estado") {
    $sql = "UPDATE coordinators SET phone_number='$phone', email='$email' WHERE document_number='$dni' ";
}
if ($_POST["responsable_tipo"] != "Facilitador" && $_POST["responsable_tipo"] != "Coordinador" && $_POST["responsable_tipo"] != "Jefe de Estado") {
    $sql = "UPDATE gerencias SET phone_number='$phone', email='$email' WHERE document_number='$dni' ";
}

ExecutorPg::doit($sql);

if ($_POST["personal_type"] != ""){
    $personal_type = $_POST["personal_type"];
}else {
    $personal_type = "";
}


$param = new PlanningActivityData();
$param->location = $_GET['location'];
$param->info_id = $_POST['info_id'];
$param->code_info = trim(strtoupper($_POST["code_info"]));
$param->user_id = $_SESSION['user_id'];
$param->line_action = $_POST["linea_accion"];
$param->report_type = $_POST["tipo_reporte"];
$param->specific_action = $_POST["accion_especifica"];
$param->training_type = $_POST["area_formativa"];
$param->training_level = $_POST["nivel_formacion"];
$param->tipo_taller = $_POST["tipo_taller"];
$param->institucion_formacion = $_POST["institucion_formacion"];
$param->id_institucion = $_POST["id_institucion"];
$param->isnt_type = $_POST["isnt_type"];
$param->circuito_comunal = $_POST["circuito_comunal"];

$param->activity_title = $_POST["nombre_act"];

$param->developed_content = $_POST["contenido_des"];
$param->training_modality = $_POST["modalidad_formacion"];
$param->duration_days = $_POST["duracion_dias"];
$param->duration_hour = $_POST["duracion_horas"];
$param->status_activity = 0;
$param->hour_activity = $_POST["hour_activity_ini"] . "/" . $_POST["hour_activity_end"];

$param->responsible_name = $_POST["responsable_name"];
$param->responsible_phone = $_POST["responsable_tel"];
$param->responsible_type = $_POST["responsable_tipo"];
$param->responsible_dni = $_POST["responsible_dni"];
$param->responsible_email = $_POST["responsible_email"];
$param->personal_type = $personal_type;
$param->date_pub = $_POST["fecha"];
$param->date_ini = date('Y-m-d', strtotime(explode('/', $_POST["fecha"])[0]));
$param->date_end = date('Y-m-d', strtotime(explode('/', $_POST["fecha"])[1]));

// atencion al usuario
if ($_POST["tipo_reporte"] == "Atención al usuario") {
    $mujer = ServicesUsersData::getBySQL("SELECT * from services_users where user_id=" . $_SESSION['user_id'] . " AND user_genero='Mujer' AND DATE(user_fecha_reg)=" . "'" . $_POST["fecha"] . "'" . " order by id asc ");
    $hombre = ServicesUsersData::getBySQL("SELECT * from services_users where user_id=" . $_SESSION['user_id'] . " AND user_genero='Hombre' AND DATE(user_fecha_reg)=" . "'" . $_POST["fecha"] . "'" . " order by id asc ");
    $Total_mujeres = count($mujer);
    $Total_hombres = count($hombre);
    $param->person_fe = $Total_mujeres;
    $param->person_ma = $Total_hombres;
    // echo "Muejeres ".$Total_mujeres;
    // echo "Homabres ".$Total_hombres;

} else {
    $param->person_fe = 0;
    $param->person_ma = 0;
}


$usuario_final = FinalUsersData::getByUserId($_SESSION['user_id']);
if ($usuario_final != "null") {
    $profile_image = $usuario_final->profile_image;
}else {
    $profile_image = "";
}

$param->organized_by_info = $_POST["organized_by_info"];
$param->institutions = $_POST["instituciones"];
$param->observations = $_POST["observacion"];
$param->name_os = $_POST["name_os"];


$param->estate = $estado;
$param->municipality = $municipio;
$param->parish = $parroquia;
$param->city = $ciudad;
$param->address = $direccion;
$param->image = $images;
$param->profile_image = $profile_image;
// $param->file_name = $file_name;

if ($_POST["code_info"] != "") {
    $param->add_Pg();
    Core::redir("./index.php?view=planning&swal=Registro creado");
    // echo "En este momento estamos en manteniemiento, por favor intenta en 15 minutos.";
} else {
    return Core::alert("Error: NO code_info");
}



?>


