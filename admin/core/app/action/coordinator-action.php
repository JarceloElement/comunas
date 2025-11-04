<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

/**
* InfoApp
* @author Jarcelo
**/

$func_post = "";
$func_get = "";

$Now = new DateTime('now', new DateTimeZone("America/La_Paz"));
$date_now = $Now->format('Y-m-d H:i:s');

// if (isset($_POST['function'])){$func_post = $_POST["function"]; }
if (isset($_GET['function'])){$func_get = $_GET["function"]; }





if ($func_get == "add") {

    $rx = CoordinatorsData::getRepeatedPg($_POST["document_number"]);
    if ($rx == "null") {
        $r = new CoordinatorsData();
        $r->f_name = $_POST["f_name"];
        $r->f_lastname = $_POST["f_lastname"];
        $r->document_number = $_POST["document_number"];
        $r->phone_number = $_POST["phone_number"];
        $r->gender = $_POST["genero"];
        $r->email = $_POST["email"];
        $r->info_cod = $_POST["info_cod"];
        $r->coordination = $_POST["coordination"];
        $r->status_nom = $_POST["status_nom"];
        $r->personal_type = $_POST["personal_type"];
        $r->birthdate = $_POST["birthdate"];
        $r->date_admission = $_POST["date_admission"];
        $r->f_state = $_POST["f_state"];
        $r->municipality = $_POST["municipio"];
        $r->parish = $_POST["parroquia"];
        $r->gerencia_tipo = $_POST["gerencia_tipo"];
        $r->pcta = $_POST["pcta"];
        $r->fecha_tentativa = $_POST["fecha_tentativa"];
        $r->cargo = $_POST["cargo"];
        $r->nivel_academico = $_POST["nivel_academico"];
        $r->prima_profesional = $_POST["prima_profesional"];
        $r->estatus = $_POST["estatus"];
        $r->observations = $_POST["observations"];
        $r->date_update = $date_now;

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

        $r = CoordinatorsData::getByIdPg($_POST["id"]);
        $r->id = $_POST["id"];
        $r->f_name = $_POST["f_name"];
        $r->f_lastname = $_POST["f_lastname"];
        $r->document_number = $_POST["document_number"];
        $r->phone_number = $_POST["phone_number"];
        $r->gender = $_POST["genero"];
        $r->email = $_POST["email"];
        $r->info_cod = $_POST["info_cod"];
        $r->coordination = $_POST["coordination"];
        $r->status_nom = $_POST["status_nom"];
        $r->personal_type = $_POST["personal_type"];
        $r->birthdate = $_POST["birthdate"];
        $r->date_admission = $_POST["date_admission"];
        $r->f_state = $_POST["f_state"];
        $r->municipality = $_POST["municipio"];
        $r->parish = $_POST["parroquia"];
        $r->gerencia_tipo = $_POST["gerencia_tipo"];
        $r->pcta = $_POST["pcta"];
        $r->fecha_tentativa = $_POST["fecha_tentativa"];
        $r->cargo = $_POST["cargo"];
        $r->nivel_academico = $_POST["nivel_academico"];
        $r->prima_profesional = $_POST["prima_profesional"];
        $r->estatus = $_POST["estatus"];
        $r->observations = $_POST["observations"];
        $r->date_update = $date_now;
        $result = $r->updatePg();


        $array = array(
            "data"  => $result,
            "alert" => "Registro actualizado con éxito",
            "alert_type" => "dashboard"
        );
    } else {
        $array = array(
            "data"  => "",
            "alert" => "¡AVISO! No hay datos en el formulario",
            "alert_type" => "warning"

        );
    }

    $res = json_encode($array);
    echo $res;
    // print_r($result);
}



// del_
if ($func_get == "delete") {
    if (!isset($_GET['id'])) {
        Core::alert("Error: Falta el id a eliminar");
        return;
    }
    $param = CoordinatorsData::getByIdPg($_GET["id"]);
    if ($param != "null") {
        $param->del();
        Core::redir("./index.php?view=coordinator&swal=Registro borrado");
    }
}

