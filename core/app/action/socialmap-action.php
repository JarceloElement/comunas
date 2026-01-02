<?php
/**
* InfoApp
* @author Jarcelo
**/




$pag = $_GET["pag"];
if ($pag == ""){
    $pag = "1";
}

$func_post = "";
$func_get = "";

// if (isset($_POST['function'])){$func_post = $_POST["function"]; }
if (isset($_GET['function'])){$func_get = $_GET["function"]; }

$fecha_actual = date("Y",time());
$edad = $fecha_actual-date("Y", strtotime($_POST["user_f_nacimiento"]));
$fecha_servicio = date("Y,m,d", strtotime($_POST["user_fecha_servicio"]));



if($func_get == "add"){
    // $rx = ServicesUsersData::getRepeated($_POST["user_dni"]);
    // if($rx==null){
    $r = new SocialMapData();
    $r->user_id = $_POST["user_id"];
    $r->user_type = $_POST["user_type"];
    $r->info_state = $_SESSION["user_region"];
    $r->code_info = $_POST["code_info"];
    $r->responsability_email = $_POST["user_email"];
    $r->user_name_os = $_POST["user_name_os"];
    $r->progress = "10";
    $r->progress_percent = 0;
    $r->add();

    Core::redir("./index.php?view=socialmap");
    $message = "Mapa creado";
	$_SESSION["alert"] = $message;
    // return $message;

}



if($func_get == "update"){
    if(count($_POST)>0){

        

        $r = SocialMapData::getById($_POST["id"]);
        $r->id = $_POST["id"];
        $r->user_id = $_POST["user_id"];
        $r->user_info_cod = $_POST["user_info_cod"];
        $r->user_nombres = $_POST["user_nombres"];
        $r->user_apellidos = $_POST["user_apellidos"];
        $r->user_dni = $_POST["user_dni"];
        $r->user_correo = $_POST["user_correo"];
        $r->user_genero = $_POST["user_genero"];
        $r->user_telefono = $_POST["user_telefono"];
        $r->user_f_nacimiento = $_POST["user_f_nacimiento"];
        $r->user_edad = $edad;
        $r->user_nivel_academ = $_POST["user_nivel_academ"];
        $r->user_profesion = $_POST["user_profesion"];
        $r->user_empleado = $_POST["user_empleado"];
        $r->user_institucion = $_POST["user_institucion"];
        $r->user_estado = $_POST["user_estado"];
        $r->user_municipio = $_POST["user_municipio"];
        $r->user_direccion = $_POST["user_direccion"];
        $r->user_tipo_servicio = $_POST["user_tipo_servicio"];
        $r->user_fecha_servicio = $fecha_servicio;
        $r->user_name_os = $_POST["user_name_os"];
        $r->update();
    
    }else {
        Core::alert("No hay parámetros enviados para actualizar");
        
    }
    Core::redir("./index.php?view=final_users&swal=Registro actualizado");

}




if($func_get == "delete"){
    if (!isset( $_GET['id'])) {
        Core::alert("Error: Falta el id a eliminar");
        return;
    }
    $estado = $_GET["user_estado"];
    $start_at = $_GET["start_at"];
    $finish_at = $_GET["finish_at"];

    $param = SocialMapData::getById($_GET["id"]);
    $param->del();

    // Core::alert("Eliminado exitosamente!");
    // Core::redir("./index.php?view=final_users&swal=Registro borrado");
    // print "<script>window.location='index.php?view=facilitators';</script>";
    print "<script>window.location='index.php?view=services&swal=Eliminado&user_estado=&start_at=".$start_at."&finish_at=".$finish_at."&pag=".$pag."';</script>";

}



?>
