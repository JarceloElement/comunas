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

if (isset($_GET['function'])) {
    $func_get = $_GET["function"];
}


if ($func_get == "add") {

    $code_info = trim(strtoupper($_POST["info_cod"]));
    // verificar si el infocentro existe para evitar errores de llave foranea
    $rx = InfoData::getByCode($code_info);

    if (isset($rx->cod)) {
        $array = array(
            "data"  => "",
            "alert" => "El infocentro existe",
            "alert_type" => "warning"

        );
    } else {
        $array = array(
            "data"  => "",
            "alert" => "¡AVISO! El código de infocentro que intentas asignar no existe, por favor asegúrate que primero haya sido creado en Infocentros antes de asignarlo a un usuario.",
            "alert_type" => "warning"

        );
        $res = json_encode($array);
        echo $res;
        return;
    }


    $rx = FacilitatorsData::getRepeatedPg($_POST["document_number"]);
    if ($rx == 'null') {
        $r = new FacilitatorsData();
        $r->f_name = $_POST["name"];
        $r->f_lastname = $_POST["lastname"];
        $r->document_number = $_POST["document_number"];
        $r->phone_number = $_POST["phone_number"];
        $r->gender = $_POST["genero"];
        $r->email = $_POST["email"];
        $r->info_cod = $code_info;
        $r->status_nom = $_POST["status_nom"];
        $r->personal_type = $_POST["personal_type"];
        $r->birthdate = $_POST["birthdate"];
        $r->date_admission = $_POST["date_admission"];
        $r->f_state = $_POST["estado"];
        $r->municipality = $_POST["municipio"];
        $r->parish = $_POST["parroquia"];
        $r->observations = $_POST["observations"];

        $r->addPg();

        $array = array(
            "data"  => $r,
            "alert" => "Registro creado con éxito",
            "alert_type" => "dashboard"
        );
    } else {
        $array = array(
            "data"  => "",
            "alert" => "¡AVISO! Ya existe la cédula que intentas guardar, puedes buscar el usuario por su C.I y editar sus datos.",
            "alert_type" => "warning"

        );
    }

    $res = json_encode($array);
    echo $res;
}



// update_facilitator
if ($func_get == "update") {
    if (count($_POST) > 0) {

        // verificar si el infocentro existe para evitar errores de llave foranea

        $rx = InfoData::getByCode($_POST["info_cod"]);

        if (isset($rx->cod)) {
            // el infocentro existe, continuar
            echo "El infocentro existe, continuar";
        } else {

            $_SESSION['alert'] = "¡AVISO! El código de infocentro que intentas asignar no existe, por favor asegúrate que primero haya sido creado en Infocentros antes de asignarlo a un usuario.";
            Core::redir("./index.php?view=facilitators&swal=");
            return;
        }


        $r = FacilitatorsData::getByIdPg($_POST["id"]);
        $r->id = $_POST["id"];
        $r->f_name = $_POST["f_name"];
        $r->f_lastname = $_POST["f_lastname"];
        $r->document_number = $_POST["document_number"];
        $r->phone_number = $_POST["phone_number"];
        $r->gender = $_POST["genero"];
        $r->email = $_POST["email"];
        $r->info_cod = $_POST["info_cod"];
        $r->status_nom = $_POST["status_nom"];
        $r->personal_type = $_POST["personal_type"];
        $r->birthdate = $_POST["birthdate"];
        $r->date_admission = $_POST["date_admission"];
        $r->f_state = $_POST["f_state"];
        $r->municipality = $_POST["municipio"];
        $r->parish = $_POST["parroquia"];
        $r->observations = $_POST["observations"];
        $r->updatePg();

        $_SESSION['alert'] = "Registro actualizado con éxito";

        Core::redir("./index.php?view=facilitators&swal=Registro actualizado");
    } else {
        Core::alert("No hay parámetros enviados para actualizar");
    }
}



// del_facilitator
if ($func_get == "delete") {
    if (!isset( # valido los parametros recibidos
        $_GET['id']
    )) {
        Core::alert("Error: Falta el id a eliminar");
        return;
    }
    $param = FacilitatorsData::getByIdPg($_GET["id"]);
    $param->del();
    Core::redir("./index.php?view=facilitators&swal=Registro borrado");
}
