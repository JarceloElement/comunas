<?php

/**
 * InfoApp
 * @author Jarcelo
 **/
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$func_post = "";
$func_get = "";

if (isset($_POST['function'])) {
    $func_post = $_POST["function"];
}
if (isset($_GET['function'])) {
    $func_get = $_GET["function"];
}




if ($func_get == "add") {

    $fecha_actual = date("Y", time());
    $edad = $fecha_actual - date("Y", strtotime($_POST["user_f_nacimiento"]));
    $fecha_servicio = date("Y,m,d", strtotime($_POST["user_fecha_servicio"]));

    $code_info = isset($_POST["user_info_cod"]) ? $_POST["user_info_cod"] : "";
    $code_info = trim(strtoupper($code_info));
    if ($code_info != "") {
        $sql = "SELECT id from infocentros where upper(cod)='$code_info';";
        $res = ExecutorPg::get($sql)[0][0];
        $info_id = isset($res["id"]) ? $res["id"] : "0";
    }


    // Verifica que no haya usuario final con ese DNI y actualiza los datos
    $final_user = FinalUsersData::getRepeatedFromServices($_POST["document_id"], $_POST["user_f_id"]);

    if ($final_user != "") {
        $user_f_id = $_POST["user_f_id"];
        $user = FinalUsersData::getByIdPg($user_f_id);

        $user->user_has_document = $_POST["user_has_document"];
        $user->user_dni = $_POST["document_id"];
        $user->user_etnia = $_POST["user_etnia"];
        $user->disability_type = $_POST["user_disability_type"];
        $user->user_profesion = $_POST["user_profesion"];
        $user->user_ocupacion = $_POST["user_ocupacion"];
        $user->update();
    }

    // si no existe un correo igual lo actualiza
    $new_email = $_POST["user_correo"];
    $user_email = FinalUsersData::getRepeatedEmailFromServices($_POST["user_correo_update"], $_POST["user_f_id"]);

    if ($user_email == "null" || $_POST["user_correo_update"] == "") {
        $obj = FinalUsersData::getByIdPg($_POST["user_f_id"]);
        $obj->user_correo = $_POST["user_correo_update"];
        $obj->update();
        $new_email = $_POST["user_correo_update"];
    }


    $r = new ServicesUsersData();
    $r->user_id = $_POST["user_id"];
    $r->user_f_id = $_POST["user_f_id"];
    $r->user_info_id = $info_id;
    $r->user_info_cod = $_POST["user_info_cod"];
    $r->user_nombres = $_POST["user_nombres"];
    $r->user_apellidos = $_POST["user_apellidos"];
    $r->user_dni = $_POST["document_id"];
    $r->user_correo = $new_email;
    $r->user_genero = $_POST["user_genero"];
    $r->user_comunity_type = $_POST["user_comunity_type"];
    $r->user_pertenece_organizacion = $_POST["user_pertenece_organizacion"];
    $r->user_disability_type = $_POST["user_disability_type"];
    $r->user_etnia = $_POST["user_etnia"];
    $r->user_telefono = $_POST["user_telefono"];
    $r->user_f_nacimiento = $_POST["user_f_nacimiento"];
    $r->user_edad = $edad;
    $r->user_nivel_academ = $_POST["user_nivel_academ"];
    $r->user_profesion = $_POST["user_profesion"];
    $r->user_ocupacion = $_POST["user_ocupacion"];
    $r->user_empleado = $_POST["user_empleado"];
    $r->user_institucion = $_POST["user_institucion"];
    $r->user_estado = $_POST["user_estado"];
    $r->user_municipio = $_POST["user_municipio"];
    $r->user_direccion = $_POST["user_direccion"];
    $r->user_tipo_servicio = $_POST["user_tipo_servicio"];
    $r->user_fecha_servicio = $fecha_servicio;
    $r->user_name_os = $_POST["user_name_os"];
    $r->add();

    Core::redir("./index.php?view=services&swal=Registro creado / Datos actualizados");
}



// update participant
if ($func_get == "update") {
    if (count($_POST) > 0) {

        $r = ServicesUsersData::getByIdPg($_POST["id"]);
        $r->id = $_POST["id"];
        $r->user_id = $_POST["user_id"];
        $r->user_info_cod = $_POST["user_info_cod"];
        $r->user_nombres = $_POST["user_nombres"];
        $r->user_apellidos = $_POST["user_apellidos"];
        $r->user_dni = $_POST["user_dni"];
        $r->user_correo = $_POST["user_correo"];
        $r->user_genero = $_POST["user_genero"];
        $r->user_comunity_type = $_POST["user_comunity_type"];
        $r->user_pertenece_organizacion = $_POST["user_pertenece_organizacion"];
        $r->user_disability_type = $_POST["user_disability_type"];
        $r->user_etnia = $_POST["user_etnia"];
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
    } else {
        Core::alert("No hay parámetros enviados para actualizar");
    }
    Core::redir("./index.php?view=final_users&swal=Registro actualizado");
}



if ($func_get == "delete") {
    if (!isset($_GET['id'])) {
        Core::alert("Error: Falta el id a eliminar");
        return;
    }

    if (isset($_GET["pag"]) && $_GET["pag"] == "") {
        $pag = "1";
    } else {
        $pag = $_GET["pag"];
    }

    $estado = $_GET["user_estado"];
    $start_at = $_GET["start_at"];
    $finish_at = $_GET["finish_at"];
    $info_id = $_GET["info_id"];
    $uid = $_GET["uid"];
    $q = $_GET["q"];

    $param = ServicesUsersData::getByIdPg($_GET["id"]);
    $param->del();

    print "<script>window.location='index.php?view=services&swal=Eliminado&user_estado=&start_at=" . $start_at . "&finish_at=" . $finish_at . "&pag=" . $pag . "&info_id=" . $info_id . "&uid=" . $uid . "&q=" . $q . "';</script>";
}

// validar que no hay otro usuario con el mismo correo
if ($func_post == "get_repeated_email") {
    $id = $_POST["id"];
    $email = $_POST["email"];
    $user_email = FinalUsersData::getRepeatedEmailFromServices($email, $id);
    // print_r($user_email->user_correo);
    $array = array(
        "param"  => $user_email,
    );
    echo json_encode($array);
}
