<?php

/**
 * InfoApp
 * @author Jarcelo
 **/

date_default_timezone_set('UTC');
date_default_timezone_set("America/La_Paz");

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, x-requested-with");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE");
header("Allow: POST, GET, OPTIONS, DELETE");



// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(0);
header('Content-Type: application/json');

$func_post = "";
$func_get = "";

if (isset($_POST['function'])) {
    $func_post = $_POST["function"];
}
if (isset($_GET['function'])) {
    $func_get = $_GET["function"];
}


// POST FUNCTIONS

// add internet type
if ($func_post == "add") {
    if (!isset( # valido los parametros recibidos
        $_POST['name']
    )) {
        Core::alert("Error: Los datos enviados no son válidos");
        return;
    }
    $param = new InternetTypeData();
    $param->type = $_POST["name"];
    $param->add();
    // Core::alert("Creado exitosamente!");
    echo "¡Creado exitosamente!";
}

// add operative type data
if ($func_post == "add_operative_type") {
    if (!isset( # valido los parametros recibidos
        $_POST['name']
    )) {
        Core::alert("Error: Los datos enviados no son válidos");
        return;
    }
    $param = new OperativeInfoData();
    $param->operative_type = $_POST["name"];
    $param->add();
    // Core::alert("Creado exitosamente!");
    echo "¡Creado exitosamente!";
}

// add_action_line
if ($func_post == "add_action_line") {
    if (!isset( # valido los parametros recibidos
        $_POST['name']
    )) {
        Core::alert("Error: Los datos enviados no son válidos");
        return;
    }
    $param = new ActionsLineData();
    $param->line_name = $_POST["name"];
    $param->permisos = $_POST["permisos"];

    try {
        $result = $param->addPg();
        $_SESSION['alert'] = '¡Creado exitosamente!';
        $array = array(
            "error"  => "false",
            "data"  => "ID: " . $result,
            "alert" => "Registro creado con éxito.",
            "alert_type" => "dashboard"
        );
    } catch (Exception $e) {
        $array = array(
            "error"  => "true",
            "data"  => "",
            "alert" => "¡Error: " . $e->getMessage() . "!",
            "alert_type" => "error"
        );
    }
    echo json_encode($array);
    return;
}


// edit_action_line
if ($func_post == "edit_action_line") {
    if (!isset( # valido los parametros recibidos
        $_POST['line_id']
    )) {
        Core::alert("Error: Los datos enviados no son válidos");
        return;
    }

    $permisos = $_POST["permisos"] = "" ? "TODOS" : $_POST["permisos"];
    $permisos = strtoupper($permisos);

    $line_id = $_POST["line_id"];
    $line_name = $_POST["name"];

    $sql = "UPDATE actions_line set line_name='$line_name', permisos='$permisos' where line_id=$line_id";
    ExecutorPg::doit($sql);

    // $sql = "UPDATE reports	set person_ma = ? where id = ?;";
    // $values = [(int)$total_person, (int)$id_activity];
    // ExecutorPg::update($sql, $values);


    $_SESSION['alert'] = 'Actualizado con éxito!';
    echo "Actualizado con éxito!";
}


// edit_organizacion
if ($func_post == "edit_organizacion") {
    if (!isset( # valido los parametros recibidos
        $_POST['id']
    )) {
        Core::alert("Error: Los datos enviados no son válidos");
        return;
    }

    $id = $_POST["id"];
    $code_info = strtoupper($_POST["code_info"]);
    $codigo_organizacion = strtoupper($_POST["codigo_organizacion"]);
    $nombre_organizacion = $_POST["nombre_organizacion"];

    $sql = "UPDATE organizaciones set code_info='$code_info', codigo_organizacion='$codigo_organizacion', nombre_organizacion='$nombre_organizacion' where id=$id";

    try {
        $result = ExecutorPg::doit($sql);
        $_SESSION['alert'] = '¡Actualizado con éxito!';
        $array = array(
            "error"  => "false",
            "data"  => "Result: " . $result,
            "alert" => "¡Actualizado con éxito",
            "alert_type" => "dashboard"
        );
    } catch (Exception $e) {
        $array = array(
            "error"  => "true",
            "data"  => "",
            "alert" => "¡Error: " . $e->getMessage() . "!",
            "alert_type" => "error"
        );
    }
    echo json_encode($array);
    return;
}



// add_strategic_action
if ($func_post == "add_strategic_action") {
    $permisos = $_POST["permisos"] = "" ? "Todos" : $_POST["permisos"];
    $permisos = strtoupper($permisos);

    $param = new StrategicActionData();
    $param->line_id = $_POST["line_id"];
    $param->line_action = $_POST["line_action"];
    $param->name_action = $_POST["name_action"];
    $param->permisos = $permisos;

    try {
        $result = $param->addPg();
        $_SESSION['alert'] = '¡Creado con éxito!';
        $array = array(
            "error"  => "false",
            "data"  => "Result: " . $result,
            "alert" => "Creado con éxito",
            "alert_type" => "dashboard"
        );
    } catch (Exception $e) {
        $array = array(
            "error"  => "true",
            "data"  => "",
            "alert" => "¡Error: " . $e->getMessage() . "!",
            "alert_type" => "error"
        );
    }
    echo json_encode($array);
    return;
}




// add_accion_especifica
if ($func_post == "add_accion_especifica") {

    $permisos = $_POST["permisos"] = "" ? "Todos" : $_POST["permisos"];
    $permisos = strtoupper($permisos);

    $param = new SpecificActionData();
    $param->k_strategic = $_POST["strategic_action_id"];
    $param->name_line_action = $_POST["line_action"];
    $param->name_strategic = $_POST["tipo_reporte"];
    $param->name_specific_action = $_POST["accion_especifica"];
    $param->activity_description = $_POST["descripcion_actividad"];
    $param->has_formation = $_POST["has_formation"];
    $param->permisos = $permisos;
    $param->addPg();
    // Core::alert("Creado exitosamente!");
    $array = array(
        "error"  => $_POST["line_action"]
    );
    $res = json_encode($array);
    echo $res;
}


// edit_accion_especifica
if ($func_post == "edit_accion_especifica") {
    $id = $_POST["id"];
    $line_action = $_POST["line_action"];
    $tipo_reporte = $_POST["tipo_reporte"];
    $strategic_action_id = $_POST["strategic_action_id"];
    $accion_especifica = $_POST["accion_especifica"];
    $descripcion_actividad = $_POST["descripcion_actividad"];
    $has_formation = $_POST["has_formation"];
    $permisos = $_POST["permisos"] = "" ? "Todos" : $_POST["permisos"];
    $permisos = strtoupper($permisos);

    $sql = "UPDATE specific_action set k_strategic='$strategic_action_id', name_line_action='$line_action', name_strategic='$tipo_reporte', name_specific_action='$accion_especifica', activity_description='$descripcion_actividad', has_formation='$has_formation', permisos='$permisos' where id=$id";
    ExecutorPg::doit($sql);
    $array = array(
        "error"  => $_POST["tipo_reporte"]
    );
    $res = json_encode($array);
    echo $res;
}

// edit_strategic_action
if ($func_post == "edit_strategic_action") {

    $id = $_POST["id"];
    $line_id = $_POST["line_id"];
    $line_action = $_POST["line_action"];
    $name_action = $_POST["name_action"];
    $permisos = $_POST["permisos"] = "" ? "Todos" : $_POST["permisos"];
    $permisos = strtoupper($permisos);

    $sql = "UPDATE strategic_action set line_id='$line_id', line_action='$line_action', name_action='$name_action', permisos='$permisos' where id=$id";

    try {
        $result = ExecutorPg::doit($sql);
        $_SESSION['alert'] = '¡Actualizado con éxito!';
        $array = array(
            "error"  => "false",
            "data"  => "Result: " . $result,
            "alert" => "Actualizado con éxito",
            "alert_type" => "dashboard"
        );
    } catch (Exception $e) {
        $array = array(
            "error"  => "true",
            "data"  => "",
            "alert" => "¡Error: " . $e->getMessage() . "!",
            "alert_type" => "error"
        );
    }
    echo json_encode($array);
    return;
}


// edit_tipo_taller
if ($func_post == "edit_tipo_taller") {

    $id = $_POST["id"];
    $line_action = $_POST["line_action"];
    $nivel = $_POST["nivel"];
    $modalidad = $_POST["modalidad"];
    $nombre_taller = $_POST["nombre_taller"];
    $descripcion_taller = $_POST["descripcion_taller"];
    $duracion_horas = $_POST["duracion_horas"];
    $orden_taller = $_POST["orden_taller"];
    $codigo_taller = $_POST["codigo_taller"];
    $permisos = $_POST["permisos"] = "" ? "Todos" : $_POST["permisos"];
    $permisos = strtoupper($permisos);

    $sql = "UPDATE tipo_taller set name_training_type='$line_action', nombre_taller='$nombre_taller', descripcion_taller='$descripcion_taller', duracion_horas='$duracion_horas', nivel='$nivel', modalidad='$modalidad', permisos='$permisos', orden_taller='$orden_taller', codigo_taller='$codigo_taller' where id=$id";
    try {
        $result = ExecutorPg::doit($sql);
        $_SESSION['alert'] = '¡Actualizado con éxito!';
        $array = array(
            "error"  => "false",
            "data"  => "Result: " . $result,
            "alert" => "Actualizado con éxito",
            "alert_type" => "dashboard"
        );
    } catch (Exception $e) {
        $array = array(
            "error"  => "true",
            "data"  => "",
            "alert" => "¡Error: " . $e->getMessage() . "!",
            "alert_type" => "error"
        );
    }
    echo json_encode($array);
    return;
}


// add_tipo_formacion
if ($func_post == "add_tipo_formacion") {
    $line_action = $_POST["line_action"];
    $tipo_reporte = $_POST["tipo_reporte"];
    $accion_especifica = $_POST["accion_especifica"];
    $nombre_curso = $_POST["nombre_curso"];

    $duracion_horas = $_POST["duracion_horas"];
    $nivel_curso = $_POST["nivel_curso"];
    $modalidad_curso = $_POST["modalidad_curso"];
    $ejes_actuacion = $_POST["ejes_actuacion"];
    $tipo_certificacion = $_POST["tipo_certificacion"];
    $contenido_curso = $_POST["contenido_curso"];
    $descripcion_actividad = $_POST["descripcion_actividad"];
    $habilitar_descripcion = $_POST["habilitar_descripcion"];
    $habilitar_institucion = $_POST["habilitar_institucion"];
    $codigo_curso = $_POST["codigo_curso"];

    $restringir_categoria = $_POST["restringir_categoria"] = "" ? "Todos" : $_POST["restringir_categoria"];
    $restringir_categoria = strtoupper($restringir_categoria);


    $sql = "INSERT into training_type (name_line_action, name_strategic_action, name_specific_action, name_training_type,duracion_horas,nivel_curso,modalidad_curso,ejes_actuacion,tipo_certificacion,contenido_curso,descripcion_actividad,habilitar_descripcion,habilitar_institucion,codigo_curso,restringir_categoria) 
    VALUES ('$line_action','$tipo_reporte','$accion_especifica', '$nombre_curso', '$duracion_horas', '$nivel_curso', '$modalidad_curso', '$ejes_actuacion', '$tipo_certificacion', '$contenido_curso', '$descripcion_actividad',$habilitar_descripcion,'$habilitar_institucion','$codigo_curso', '$restringir_categoria')";

    ExecutorPg::doit($sql);
    $_SESSION['alert'] = "Registro creado";

    $array = array(
        "error"  => $_POST["nombre_curso"]
    );
    $res = json_encode($array);
    echo $res;
}



// add_tipo_taller
if ($func_post == "add_tipo_taller") {
    $permisos = $_POST["permisos"] = "" ? "Todos" : $_POST["permisos"];
    $permisos = strtoupper($permisos);

    $line_action = $_POST["line_action"];
    $nombre_taller = $_POST["nombre_taller"];
    $descripcion_taller = $_POST["descripcion_taller"];
    $descripcion_taller = $_POST["descripcion_taller"];
    $duracion_horas = $_POST["duracion_horas"];
    $nivel = $_POST["nivel"];
    $modalidad = $_POST["modalidad"];
    $permisos = $permisos;
    $orden_taller = $_POST["orden_taller"];
    $codigo_taller = $_POST["codigo_taller"];

    $sql = "INSERT into tipo_taller (name_training_type, nombre_taller, descripcion_taller, duracion_horas, nivel, modalidad, permisos, orden_taller, codigo_taller) 
    VALUES ('$line_action','$nombre_taller','$descripcion_taller','$duracion_horas', '$nivel', '$modalidad', '$permisos', '$orden_taller', '$codigo_taller')";

    try {
        $result = ExecutorPg::doit($sql);
        $_SESSION['alert'] = 'Agregado con éxito';
        $array = array(
            "error" => "false",
            "data"  => "ID: " . $result,
            "alert" => "Registro creado con éxito.",
            "alert_type" => "dashboard"
        );
    } catch (Exception $e) {
        $array = array(
            "error" => "true",
            "data"  => "",
            "alert" => "¡Error: " . $e->getMessage() . "!",
            "alert_type" => "error"
        );
    }
    echo json_encode($array);
    return;
}



// add_tipo_nivel
if ($func_post == "add_tipo_nivel") {
    $tipo_nivel = $_POST["tipo_nivel"];

    $sql = "INSERT into level_training (name_level_training) VALUE ('$tipo_nivel')";
    Executor::doit($sql);
    $array = array(
        "error"  => $_POST["name_level_training"]
    );
    $res = json_encode($array);
    echo $res;
}


// add_status_type
if ($func_post == "add_status_type") {
    if (!isset( # valido los parametros recibidos
        $_POST['param']
    )) {
        Core::alert("Error: Los datos enviados no son válidos");
        return;
    }
    $param = new StatusInfocentroData();
    $param->status = $_POST["param"];
    $param->add();
    // Core::alert("Creado exitosamente!");
    echo "¡Creado exitosamente!";
}



// add_coord
if ($func_post == "add_coord") {
    if (!isset( # valido los parametros recibidos
        $_POST['param']
    )) {
        Core::alert("Error: Los datos enviados no son válidos");
        return;
    }
    $param = new CoordTypeData();
    // Asegúrate de que la clase CoordTypeData tenga una propiedad pública 'nombre'
    // Si la clase no tiene la propiedad, agrégala en la definición de la clase CoordTypeData
    $param->name = $_POST["param"];
    $param->add();
    // Core::alert("Creado exitosamente!");
    echo "¡Creado exitosamente!";
}


// add_responsible_type
if ($func_post == "add_responsible_type") {
    if (!isset( # valido los parametros recibidos
        $_POST['param']
    )) {
        Core::alert("Error: Los datos enviados no son válidos");
        return;
    }
    $param = new ResponsibleTypeData();
    $param->name = $_POST["param"];
    $param->add();
    // Core::alert("Creado exitosamente!");
    echo "¡Creado exitosamente!";
}


// add_user_type
if ($func_post == "add_user_type") {
    if (!isset($_POST['user_type_name'])) # valido los parametros recibidos
    {
        Core::alert("Error: Los datos enviados no son válidos");
        return;
    }
    $param = new UserTypeData();
    $param->user_type = $_POST["user_type"];
    $param->user_type_name = $_POST["user_type_name"];

    try {
        $result = $param->add();

        $_SESSION['alert'] = "¡Creado exitosamente!";

        $array = array(
            "error" => "false",
            "data"  => "ID: " . $result,
            "alert" => "Registro creado con éxito.",
            "alert_type" => "dashboard"
        );
    } catch (Exception $e) {
        $array = array(
            "data"  => "",
            "alert" => "¡Error: " . $e->getMessage() . "!",
            "alert_type" => "error"
        );
    }
    echo json_encode($array);
    return;
}


// add_product_cat
if ($func_post == "add_product_cat") {

    if (!isset($_POST['name'])) # valido los parametros recibidos
    {
        Core::alert("Error: Los datos enviados no son válidos");
        return;
    }

    $param = new ProductsType();
    $param->nombre_categoria = $_POST["name"];
    $param->cod_categoria = $_POST["codigo"];



    try {
        $result = $param->addCat();

        $_SESSION['alert'] = "¡Creado exitosamente!";

        $array = array(
            "error" => "false",
            "data"  => "ID: " . $result,
            "alert" => "Registro creado con éxito.",
            "alert_type" => "dashboard"
        );
    } catch (Exception $e) {
        $array = array(
            "data"  => "",
            "alert" => "¡Error: " . $e->getMessage() . "!",
            "alert_type" => "error"
        );
    }
    echo json_encode($array);
    return;
}



// add_product_type
if ($func_post == "add_product_type") {

    if (!isset($_POST['categoria'])) # valido los parametros recibidos
    {
        Core::alert("Error: Los datos enviados no son válidos");
        return;
    }

    $param = new ProductsType();
    $param->tipo_categoria = $_POST["categoria"];
    $param->name = $_POST["tipo"];
    $param->cod_producto = $_POST["codigo"];
    // $param->addProd();
    $_SESSION['alert'] = "¡Creado exitosamente!";

    try {
        $result = $param->addProd();
        // if ($product_id !== true && $product_id !== "ok") {
        //     throw new Exception(is_string($product_id) ? $product_id : "Error desconocido en la actualización.");
        // }
        $array = array(
            "data"  => "ID: " . $result,
            "alert" => "Registro creado con éxito.",
            "alert_type" => "dashboard"
        );
    } catch (Exception $e) {
        $array = array(
            "data"  => "",
            "alert" => "¡Error: " . $e->getMessage() . "!",
            "alert_type" => "error"
        );
    }
    echo json_encode($array);
    return;
}


// add_participant
if ($func_post == "add_participant") {
    if (!isset($_POST['id_activity'])) {
        Core::alert("Error: Los datos enviados no son válidos");
        return false;
    }

    $fecha_actual = date("Y", time());
    $age = $fecha_actual - date("Y", strtotime($_POST["user_f_nacimiento"]));

    $code_info = isset($_POST["code_info"]) ? trim(strtoupper($_POST["code_info"])) : "";
    if ($code_info != "") {
        $sql = "SELECT id from infocentros where cod='$code_info';";
        $res = ExecutorPg::get($sql)[0][0];
        $info_id = isset($res["id"]) ? $res["id"] : "0";
    }


    $parent_ref = "";
    $document_id = "";

    $user_correo = "";
    $user_telefono = "";
    $id_user_final = "0";
    $parent_dni = "";


    if (($_POST["document_id"] != "" || $_POST["document_id"] != "0") && $_POST["user_has_document"] == "Si") {
        $document_id = $_POST["document_id"];
    } else if ($_POST["user_has_document"] != "Si") {
        $document_id = "No cedulado";
    }

    // crea un nuevo usuario final cuando no existe
    // if($_POST["is_new"] == "true"){
    $rx = 0;
    $id_uf = "";
    $rx = FinalUsersData::getRepeatedFromAjax($_POST["document_id"], $_POST["parent_ref"], $_POST["id_final_user"], $_POST["name"], $_POST["lastname"], $_POST["user_has_document"], $_POST["user_f_nacimiento"]);

    // echo isset($rx[0]["id"]);
    // print_r($rx);
    // return;
    if (count($rx) < 1) {
        // if (!isset($rx[0]["id"])) {

        $r = new FinalUsersData();
        $r->user_id = null;
        $r->user_nombres = ucwords(mb_strtolower($_POST["name"]));
        $r->user_nombre_2 = ucwords(mb_strtolower($_POST["name_2"]));
        $r->user_apellidos = ucwords(mb_strtolower($_POST["lastname"]));
        $r->user_apellido_2 = ucwords(mb_strtolower($_POST["lastname_2"]));
        $r->user_nationality = $_POST["user_nationality"];
        $r->user_has_document = $_POST["user_has_document"];
        $r->user_dni = $document_id;
        $r->parent_dni = $_POST["parent_dni"];
        $r->child_number = $_POST["child_number"];
        $r->parent_ref = $_POST["parent_ref"];
        $r->user_correo = $_POST["email"];
        $r->user_genero = $_POST["gender"];
        $r->user_comunity_type = $_POST["user_comunity_type"];
        $r->user_etnia = $_POST["etnia"];
        $r->disability_type = $_POST["disability_type"];
        $r->user_telefono = $_POST["phone"];
        $r->user_f_nacimiento = $_POST["user_f_nacimiento"];
        $r->user_edad = $age;
        $r->user_pertenece_organizacion = $_POST["user_pertenece_organizacion"];
        $r->user_estado = $_POST["estate"];
        $r->user_profesion = $_POST["user_profesion"];
        $r->user_ocupacion = $_POST["user_ocupacion"];
        $r->user_equipo_sala_comunal = $_POST["equipo_sala_comunal"];
        $id_user_final = $r->add()[0]["id"];
        // return $id_user_final;
        // echo $last_id;
        echo "Nuevo usuario:";
        // print_r($last_id);
    } else if (count($rx[0]) > 0 && isset($rx[0]["id"])) {
        // actualiza el usuario final

        $user_correo = $_POST["email"] != "" ? $_POST["email"] : (isset($rx[0]["user_correo"]) ? $rx[0]["user_correo"] : "");
        $user_telefono = $_POST["phone"] != "" ? $_POST["phone"] : (isset($rx[0]["user_telefono"]) ? $rx[0]["user_telefono"] : "");
        $parent_dni = $_POST["parent_dni"] != "Falta" ? $_POST["parent_dni"] : (($rx[0]["parent_dni"] != "") ? $rx[0]["parent_dni"] : "");
        $parent_ref = $_POST["parent_ref"] != "Falta" ? $_POST["parent_ref"] : $rx[0]["id"];
        $user_id = $rx[0]["id"];

        $r = FinalUsersData::getByIdPg($user_id);
        // $r = new FinalUsersData();
        // $r->id = $rx[0]["id"];
        $r->user_nombres = ucwords(mb_strtolower($_POST["name"]));
        $r->user_nombre_2 = ucwords(mb_strtolower($_POST["name_2"]));
        $r->user_apellidos = ucwords(mb_strtolower($_POST["lastname"]));
        $r->user_apellido_2 = ucwords(mb_strtolower($_POST["lastname_2"]));
        $r->user_nationality = $_POST["user_nationality"];
        $r->user_has_document = $_POST["user_has_document"];
        $r->user_dni = $document_id;
        $r->parent_dni = $parent_dni;
        $r->child_number = $_POST["child_number"];
        $r->parent_ref = $parent_ref;
        $r->user_correo = $user_correo;
        $r->user_genero = $_POST["gender"];
        $r->user_comunity_type = $_POST["user_comunity_type"];
        $r->user_etnia = $_POST["etnia"];
        $r->disability_type = $_POST["disability_type"];
        $r->user_telefono = $user_telefono;
        $r->user_f_nacimiento = $_POST["user_f_nacimiento"];
        $r->user_edad = $age;
        $r->user_pertenece_organizacion = $_POST["user_pertenece_organizacion"];
        $r->user_estado = $_POST["estate"];
        $r->user_profesion = $_POST["user_profesion"];
        $r->user_ocupacion = $_POST["user_ocupacion"];
        $r->user_equipo_sala_comunal = $_POST["equipo_sala_comunal"];
        $r->update();
        $id_user_final = $rx[0]["id"];
        echo "Usuario actualizado";
    }


    if ($_POST["parent_ref"] != "Falta") {
        $parent_ref = $_POST["parent_ref"];
    } else {
        $parent_ref = $id_user_final;
    }


    // registro el participante
    $param = new ParticipantsData();
    $param->id_user_final = $id_user_final;
    $param->id_activity = $_POST["id_activity"];
    $param->date_activity = $_POST["date_activity"];
    $param->estate = $_POST["estate"];
    $param->info_id = $info_id;
    $param->code_info = $_POST["code_info"];
    $param->name = ucwords(mb_strtolower($_POST["name"]));
    $param->name_2 = ucwords(mb_strtolower($_POST["name_2"]));
    $param->lastname = ucwords(mb_strtolower($_POST["lastname"]));
    $param->lastname_2 = ucwords(mb_strtolower($_POST["lastname_2"]));
    $param->user_nationality = $_POST["user_nationality"];
    $param->user_has_document = $_POST["user_has_document"];
    $param->document_id = $document_id;
    $param->parent_dni = $parent_dni;
    $param->child_number = $_POST["child_number"];
    $param->parent_ref = $parent_ref;
    $param->user_f_nacimiento = $_POST["user_f_nacimiento"];
    $param->age = $age;
    $param->gender = $_POST["gender"];
    $param->user_comunity_type = $_POST["user_comunity_type"];
    $param->user_pertenece_organizacion = $_POST["user_pertenece_organizacion"];
    $param->phone = $user_telefono;
    $param->email = $user_correo;
    $param->etnia = $_POST["etnia"];
    $param->line_action = $_POST["line_action"];
    $param->report_type = $_POST["report_type"];
    $param->disability_type = $_POST["disability_type"];
    $param->uid_fac = $_POST["uid_fac"];
    $param->equipo_sala_comunal = $_POST["equipo_sala_comunal"];
    $resul = $param->add_Pg();
    // print_r($resul[0]);


    // actualiza el total de participantes en los reportes
    $conn = DatabasePg::connectPg();
    $update_person = new ReportActivityData();
    $update_person->perso_gender = $_POST["gender"];
    $update_person->id_activity = $_POST["id_activity"];
    $id_activity = $_POST["id_activity"];

    if ($_POST["gender"] == "Hombre" || $_POST["gender"] == "M" || $_POST["gender"] == "m") {
        // print_r($update_person->update_participant_ma_add());
        $row = $conn->prepare("SELECT COUNT(*) as total from participants_list where gender='Hombre' and id_activity='$id_activity'");
        $row->execute();
        $total_data = $row->fetchAll(PDO::FETCH_ASSOC);
        $total_person = $total_data[0]["total"];
        echo $total_person;

        $sql = "UPDATE reports	set person_ma = ? where id = ?;";
        $values = [(int)$total_person, (int)$id_activity];
        ExecutorPg::update($sql, $values);
    }
    if ($_POST["gender"] == "Mujer" || $_POST["gender"] == "F" || $_POST["gender"] == "f") {
        $row = $conn->prepare("SELECT COUNT(*) as total from participants_list where gender='Mujer' and id_activity='$id_activity'");
        $row->execute();
        $total_data = $row->fetchAll(PDO::FETCH_ASSOC);
        $total_person = $total_data[0]["total"];
        echo $total_person;

        $sql = "UPDATE reports set person_fe = ? where id = ?;";
        $values = [(int)$total_person, (int)$id_activity];
        ExecutorPg::update($sql, $values);
    }




    echo "id_user_final- " . $id_user_final;
    echo "¡Agregado!";
    $PHP_SELFx = "index.php?view=participants_list&swal=Agregado correctamente&id_activity=" . $_POST["id_activity"] . "&activity=" . $_POST["activity"] . "&code_info=" . $_POST['code_info'] . "&estate=" . $_POST['estate'] . "&date_activity=" . $_POST['date_activity'] . "&line_action=" . $_POST['line_action'] . "&report_type=" . $_POST['report_type'];
    echo $PHP_SELFx;
}






// add_report_limit
if ($func_post == "add_report_limit") {
    if (!isset($_POST['fecha_final'])) # valido los parametros recibidos
    {
        Core::alert("Error: Los datos enviados no son válidos");
        return;
    }

    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_final = $_POST['fecha_final'];
    $sql = "UPDATE report_date_limit set date_limit_ini=\"$fecha_inicio\", date_limit_end=\"$fecha_final\" ";
    Executor::doit($sql);

    // echo "¡Creado exitosamente!";
    echo $fecha_inicio . " | " . $fecha_final;
}

// add_services_type
if ($func_post == "add_services_type") {
    if (!isset($_POST['services_name'])) # valido los parametros recibidos
    {
        Core::alert("Error: Los datos enviados no son válidos");
        return;
    }

    $services_name = $_POST['services_name'];
    $sql = "INSERT into services_type (services_name) VALUE ('$services_name')";
    Executor::doit($sql);
    $array = array(
        "error"  => $_POST["services_name"]
    );
    $res = json_encode($array);
    echo $res;
}



// update_info por lotes
if ($func_get == "update_info") {
    if (!isset($_POST['operatividad'])) # valido los parametros recibidos
    {
        Core::alert("Error: Los datos enviados no son válidos");
        return;
    }


    if (isset($_POST['pagination'])) {
        $pagination = $_POST["pagination"];
    } else {
        $pagination = "";
    }

    $location = $_GET['location'];
    $operatividad = $_POST['operatividad'];
    $internet = $_POST['internet'];
    $estatus = $_POST['estatus'];
    $data_id = $_POST['data_id'];
    $array_id = explode(',', $data_id);

    // si no hay ID para modificar
    if ($data_id == "") {
        Core::alert("Debes seleccionar algún elemento para modificar");
        if ($pagination != "") {
            print "<script>window.location='" . $location . "&pag=" . $pagination . "';</script>";
        } else {
            print "<script>window.location='" . $location . "';</script>";
        }
        return;
    }

    $sql = "UPDATE infocentros ";

    if ($operatividad != "") {
        $sql .= "SET estatus_op = CASE id ";
        foreach ($array_id as $id) {
            $sql .= sprintf("WHEN %d THEN %s ", $id, "'" . $operatividad . "'");
        }
    }
    if ($internet != "") {
        if ($operatividad != "") {
            $sql .= "END, tecno_internet = CASE id ";
        } else {
            $sql .= "SET tecno_internet = CASE id ";
        }
        foreach ($array_id as $id) {
            $sql .= sprintf("WHEN %d THEN %s ", $id, "'" . $internet . "'");
        }
    }
    if ($estatus != "") {
        if ($operatividad != "" || $internet != "") {
            $sql .= "END, estatus = CASE id ";
        } else {
            $sql .= "SET estatus = CASE id ";
        }
        foreach ($array_id as $id) {
            $sql .= sprintf("WHEN %d THEN %s ", $id, "'" . $estatus . "'");
        }
    }
    $sql .= "END WHERE id IN ($data_id)";
    // echo $pagination;
    // Core::alert($sql);
    // $sql = "UPDATE report_date_limit set date_limit_ini=\"$fecha_inicio\", date_limit_end=\"$fecha_final\" ";
    Executor::doit($sql);
    if ($pagination != "") {
        print "<script>window.location='" . $location . "&pag=" . $pagination . "';</script>";
    } else {
        print "<script>window.location='" . $location . "';</script>";
    }
}




// update_tipo_formacion
if ($func_post == "update_tipo_formacion") {
    if (!isset( # valido los parametros recibidos
        $_POST['id']
    )) {
        Core::alert("Error: Los datos enviados no son válidos");
        return false;
    }


    $restringir_categoria = $_POST["restringir_categoria"] = "" ? "Todos" : $_POST["restringir_categoria"];
    $restringir_categoria = strtoupper($restringir_categoria);

    // $param = TrainingTypeData::getById($_POST["id"]);

    // $param->id = $_POST["id"];
    // $param->name_line_action = $_POST["line_action"];
    // $param->name_strategic_action = $_POST["tipo_reporte"];
    // $param->name_specific_action = $_POST["accion_especifica"];
    // $param->name_training_type = $_POST["nombre_curso"];
    // $param->duracion_horas = $_POST["duracion_horas"];
    // $param->nivel_curso = $_POST["nivel_curso"];
    // $param->modalidad_curso = $_POST["modalidad_curso"];
    // $param->ejes_actuacion = $_POST["ejes_actuacion"];
    // $param->tipo_certificacion = $_POST["tipo_certificacion"];
    // $param->contenido_curso = $_POST["contenido_curso"];
    // $param->descripcion_actividad = $_POST["descripcion_actividad"];
    // $param->habilitar_descripcion = $_POST["habilitar_descripcion"];
    // $param->habilitar_institucion = $_POST["habilitar_institucion"];
    // $param->codigo_curso = $_POST["codigo_curso"];
    // $param->restringir_categoria = $restringir_categoria;
    // $param->update();

    $sql = "UPDATE training_type set 
    name_line_action = ?, 
    name_strategic_action = ?, 
    name_specific_action = ?, 
    name_training_type = ?, 
    duracion_horas = ?, 
    nivel_curso = ?, 
    modalidad_curso = ?, 
    ejes_actuacion = ?, 
    tipo_certificacion = ?, 
    contenido_curso = ?, 
    descripcion_actividad = ?, 
    habilitar_descripcion = ?, 
    habilitar_institucion = ?, 
    codigo_curso = ?, 
    restringir_categoria = ? 
    where id = ?;";
    $values = [
        $_POST["line_action"],
        $_POST["tipo_reporte"],
        $_POST["accion_especifica"],
        $_POST["nombre_curso"],
        $_POST["duracion_horas"],
        $_POST["nivel_curso"],
        $_POST["modalidad_curso"],
        $_POST["ejes_actuacion"],
        $_POST["tipo_certificacion"],
        $_POST["contenido_curso"],
        $_POST["descripcion_actividad"],
        $_POST["habilitar_descripcion"],
        $_POST["habilitar_institucion"],
        $_POST["codigo_curso"],
        $restringir_categoria,
        (int)$_POST["id"]
    ];
    ExecutorPg::update($sql, $values);

    $array = array(
        "error"  => $_POST["nombre_curso"]
    );
    $res = json_encode($array);
    echo $res;

    $_SESSION['alert'] = "Actualizado";
    echo "Guardado exitosamente!";
    // print "<script>window.location='index.php?view=training_type';</script>";
}





// update_part
if ($func_post == "update_part") {
    if (!isset( # valido los parametros recibidos
        $_POST['id']
    )) {
        Core::alert("Error: Los datos enviados no son válidos");
        return false;
    }

    $param = ParticipantsData::getById($_POST["id"]);

    $param->id = $_POST["id"];
    $param->name = $_POST["name"];
    $param->document_id = $_POST["document_id"];
    $param->age = $_POST["age"];
    $param->gender = $_POST["gender"];
    $param->phone = $_POST["phone"];
    $param->update();
    // Core::alert("Creado exitosamente!");
    echo "Guardado exitosamente!";
    print "<script>window.location='index.php?view=users';</script>";
}




// add_product
if ($func_post == "add_product") {

    if (!isset( # valido los parametros recibidos
        $_POST['id_activity']
    )) {
        Core::alert("Error: Los datos enviados no son válidos");
        return false;
    }



    // ---------- FILE UPLOAD ----------
    $file = "";
    $uploaddir = "uploads/files/";

    if (isset($_FILES['userfile']) && $_FILES["userfile"]["size"] > 0) {

        $code_info = $_POST["code_info"];
        $uploadfile = basename($_FILES['userfile']['name']);
        $fileName = explode(".", str_replace("(", "_", str_replace(")", "", $uploadfile)));
        $finalimage_prev = $code_info . "_" . $_POST["format"] . "_" . str_replace(" ", "_", $fileName[0]) . "_" . date('Y-m-d-H-i-s');
        $extension = pathinfo($uploadfile, PATHINFO_EXTENSION);


        $handle = new Upload($_FILES['userfile']);


        if ($handle->uploaded) {

            // $handle->allowed = array('xlsx');

            $handle->allowed = array(
                // Documentos de LibreOffice / OpenOffice
                'application/vnd.oasis.opendocument.text',        // .odt
                'application/vnd.oasis.opendocument.spreadsheet', // .ods

                // Documento PDF
                'application/pdf',                                // .pdf

                // Documentos de Microsoft Office
                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', // .xlsx
                'application/msword',                                                 // .doc
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document' // .docx
            );

            // $handle->image_resize            = true;
            // $handle->image_ratio_y           = true;
            // $handle->image_x                 = 420;
            $handle->file_new_name_body      = normalizarNombreArchivo($finalimage_prev);
            // $handle->image_convert           = 'pdf';
            // $handle->file_overwrite = true;
            // $handle->jpeg_quality = 40;     // Calidad JPEG (si es una imagen)

            $file = normalizarNombreArchivo($finalimage_prev) . '.' . $extension;


            $handle->process($uploaddir);



            // we check if everything went OK
            if ($handle->processed) {
                // echo 'Archivo cargado y procesado con éxito.';
                $handle->clean(); // Elimina el archivo temporal
            } else {
                // echo 'Error al procesar el archivo: ' . $handle->error;
                $array = array(
                    "data"  => "",
                    "alert" => "¡Error: " . $handle->error . "!",
                    "alert_type" => "error"
                );
            }
        } else {
            // echo 'Error al subir el archivo: ' . $handle->error;
            $array = array(
                "data"  => "",
                "alert" => "¡Error: " . $handle->error . "!",
                "alert_type" => "error"
            );
        }
    } else {
        // echo "Sin archivo";
        $array = array(
            "data"  => "",
            "alert" => "¡Error: Sin archivo seleccionado!",
            "alert_type" => "error"
        );
    }


    // ---------- FILE UPLOAD ----------
    $userfile_imagen = "";
    $uploaddir = "uploads/files/";

    if (isset($_FILES['userfile_imagen']) && $_FILES["userfile_imagen"]["size"] > 0) {

        $code_info = $_POST["code_info"];
        $uploadfile = basename($_FILES['userfile_imagen']['name']);
        $fileName = explode(".", str_replace("(", "_", str_replace(")", "", $uploadfile)));
        $finalimage_prev = $code_info . "_" . $_POST["format"] . "_" . str_replace(" ", "_", $fileName[0]) . "_" . date('Y-m-d-H-i-s');
        $extension = pathinfo($uploadfile, PATHINFO_EXTENSION);


        $handle = new Upload($_FILES['userfile_imagen']);


        if ($handle->uploaded) {

            $handle->image_resize            = true;
            $handle->image_ratio_y           = true;
            $handle->image_x                 = 420;
            $handle->file_new_name_body      = normalizarNombreArchivo($finalimage_prev);
            // $handle->image_convert           = 'pdf';
            // $handle->file_overwrite = true;
            $handle->jpeg_quality = 40;     // Calidad JPEG (si es una imagen)

            $file = normalizarNombreArchivo($finalimage_prev) . '.' . $extension;


            $handle->process($uploaddir);



            // we check if everything went OK
            if ($handle->processed) {
                // echo 'Archivo cargado y procesado con éxito.';
                $handle->clean(); // Elimina el archivo temporal
            } else {
                // echo 'Error al procesar el archivo: ' . $handle->error;
                $array = array(
                    "data"  => "",
                    "alert" => "¡Error: " . $handle->error . "!",
                    "alert_type" => "error"
                );
            }
        } else {
            // echo 'Error al subir el archivo: ' . $handle->error;
            $array = array(
                "data"  => "",
                "alert" => "¡Error: " . $handle->error . "!",
                "alert_type" => "error"
            );
        }
    } else {
        // echo "Sin archivo";
        $array = array(
            "data"  => "",
            "alert" => "¡Error: Sin archivo seleccionado!",
            "alert_type" => "error"
        );
    }









    $code_info = isset($_POST["code_info"]) ? $_POST["code_info"] : "";
    if ($code_info != "") {
        $sql = "SELECT id from infocentros where cod='$code_info';";
        $res = ExecutorPg::get($sql)[0][0];
        $info_id = isset($res["id"]) ? $res["id"] : "0";
    }

    // $param = new ProductsData();
    // $param->id_activity = $_POST["id_activity"];
    // $param->date_activity = $_POST["date_activity"];
    // $param->estate = $_POST["estate"];
    // $param->info_id = $info_id;
    // $param->code_info = $_POST["code_info"];
    // $param->action_performed = $_POST["action_performed"];
    // $param->format = $_POST["format"];
    // $param->format_detail = $_POST["format_detail"];
    // $param->quantity_created = $_POST["quantity_created"];
    // $param->quantity_published = $_POST["quantity_published"];
    // $param->doc_name = $file;
    // $param->doc_tipo = $extension;
    // $product_id = $param->add_Pg();








    $sql = "INSERT into products_list (
		id_activity,
        estate,
        info_id,
        code_info,
        activity_title,
        action_performed,
        date,
        format,
        format_detail,
        quantity_created,
        quantity_published,
        doc_name,
        doc_tipo,
        web_link,
        red_creada,
        formulario_url
			)";
    $sql .= " VALUES (
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?
			) RETURNING id;";
    $values = [
        (int)$_POST["id_activity"],
        $_POST["estate"],
        (int)$info_id,
        $_POST["code_info"],
        $_POST["activity_title"],
        $_POST["format"],
        $_POST["date_activity"],
        $_POST["action_performed"],
        $_POST["format_detail"],
        (int)$_POST["quantity_created"],
        (int)$_POST["quantity_published"],
        $file,
        $extension,
        $_POST["web_link"],
        $_POST["red_creada"],
        $_POST["formulario_url"]
    ];


    try {
        $product_id = ExecutorPg::insert($sql, $values)[0]["id"];
        // if ($product_id !== true && $product_id !== "ok") {
        //     throw new Exception(is_string($product_id) ? $product_id : "Error desconocido en la actualización.");
        // }
        $array = array(
            "err"  => "false",
            "data"  => "ID: " . $product_id,
            "alert" => "Producto creado con éxito.",
            "alert_type" => "dashboard"
        );
    } catch (Exception $e) {
        $array = array(
            "err"  => "true",
            "data"  => "",
            "alert" => "¡Error: " . $e->getMessage() . "!",
            "alert_type" => "error"
        );
    }






    // $jsonString = $_POST['web_link'];
    // $links = json_decode($jsonString, true);


    // foreach ($links as $link) {
    //     $social_media = SocialMediasData::getByNombre($link["nombre"])->{0};

    //     $link_instance = new LinksData();
    //     $link_instance->products_list_id = $product_id;
    //     $link_instance->activity_id = $param->id_activity;

    //     $link_instance->social_medias_id = $social_media->id;
    //     $link_instance->link = $link["valor"];

    //     $link_instance = $link_instance->add_Pg();
    // }

    // cambiar el total en reportes
    $id_activity = $_POST["id_activity"];
    $conn = DatabasePg::connectPg();

    $row = $conn->prepare("SELECT COUNT(*) as total from products_list where id_activity='" . (int)$id_activity . "'");
    $row->execute();
    $total_data = $row->fetchAll(PDO::FETCH_ASSOC);
    $total = $total_data[0]["total"];
    // echo $total;

    $sql = "UPDATE reports	set total_products = ? where id = ?;";
    $values = [(int)$total, (int)$id_activity];
    ExecutorPg::update($sql, $values);

    $_SESSION['alert'] = "¡Agregado!";

    echo json_encode($array);
    return;
}





// update_prod
if ($func_post == "update_prod") {
    if (!isset( # valido los parametros recibidos
        $_POST['id']
    )) {
        Core::alert("Error: Los datos enviados no son válidos");
        return false;
    }

    $product_id = $_POST["id"];


    $sql = "UPDATE products_list set 
		action_performed = ?, 
		estate = ?, 
		code_info = ?, 
		format_detail = ?
		where id = ?;";
    $values = [
        $_POST["action_performed"],
        $_POST["estate"],
        $_POST["code_info"],
        $_POST["format_detail"],
        $_POST["id"]
    ];


    // $param = new ProductsData();
    // $param->id = $product_id;
    // $param->action_performed = $_POST["action_performed"];
    // $param->date_activity = $_POST["date_activity"];
    // $param->estate = $_POST["estate"];
    // $param->code_info = $_POST["code_info"];
    // $param->format = $_POST["format"];
    // $param->format_detail = $_POST["format_detail"];
    // $param->quantity_created = $_POST["quantity_created"];
    // $param->quantity_published = $_POST["quantity_published"];


    try {
        $result = ExecutorPg::update($sql, $values);
        // $result = $param->update();
        // Si tu función retorna algo, puedes verificarlo aquí
        // if ($result !== true && $result !== "ok") {
        //     throw new Exception(is_string($result) ? $result : "Error desconocido en la actualización.");
        // }

        // $result = $r->update();

        $array = array(
            "data"  => "",
            "alert" => "Producto actualizado con éxito.",
            "alert_type" => "dashboard"
        );
    } catch (Exception $e) {
        $array = array(
            "data"  => "",
            "alert" => "¡Error: " . $e->getMessage() . "!",
            "alert_type" => "error"
        );
    }
    echo json_encode($array);
    return;


    // $product = ProductsData::getById($product_id);

    // $links = $_POST["web_link"];
    // foreach ($links as $link) {
    //     $social_media = SocialMediasData::getByNombre($link["nombre"])->{0};

    //     $link_instance = new LinksData();

    //     $link_instance->products_list_id = $product_id;

    //     $link_instance->activity_id = $product["id_activity"];

    //     $link_instance->social_medias_id = $social_media->id;
    //     $link_instance->link = $link["valor"];

    //     if ($link["id"] != "") {

    //         if ($link["valor"] == "") {
    //             LinksData::delByIdPg($link["id"]);
    //         } else {
    //             $link_instance->id = $link["id"];
    //             $link_instance = $link_instance->update();
    //         }
    //     } else if ($link["valor"] != "") {

    //         $link_instance = $link_instance->add_Pg();
    //     }
    // }

    // Core::alert("Creado exitosamente!");
    // echo "Producto actualizado";
}

if ($func_post == "verify_links") {

    $enlacesRepetidos = [];

    $links = isset($_POST["web_link"]) ? $_POST["web_link"] : [];

    if (count($links) < 1) {
        $array = array(
            "err"  => 'false',
            "text"  => '¡AVISO! No hay enlaces para verificar.'
        );
        $res = json_encode($array);
        echo $res;
        return;
    }


    foreach ($links as $link) {
        $repeated_link = LinksData::getByLink($link["valor"]);

        // print_r($repeated_link);
        // return;

        if (isset($repeated_link["social_medias_id"])) {
            $social_media = SocialMediasData::getById($repeated_link["social_medias_id"])->{0};

            $enlacesRepetidos[] = $social_media->nombre;
        }
    }

    if (count($enlacesRepetidos) > 0) {
        $repetidos = implode(',', $enlacesRepetidos);
        $array = array(
            "err"  => 'true',
            "param"  => "Red social: " . $repetidos,
            "text"  => '¡AVISO! ya existe el mismo enlace en un campo de "' . $repetidos . '" en otro producto y/o reporte. Por favor verifica que no sea repetido.'
        );
        $res = json_encode($array);
        echo $res;
    } else {
        $array = array(
            "err"  => 'false',
            "text"  => '¡OK! No hay enlaces repetidos.'
        );
        $res = json_encode($array);
        echo $res;
        return;
    }
}

if ($func_post == "update_planning") {
    $Now = new DateTime('now', new DateTimeZone("America/La_Paz"));
    $datetime = $Now->format('Y-m-d H:i:s');

    if (!isset( # valido los parametros recibidos
        $_POST['id']
    )) {
        Core::alert("Error: Los datos enviados no son válidos");
        return false;
    }

    $usuario_final = FinalUsersData::getByUserId($_POST["user_id"]);
    if ($usuario_final != "null") {
        $profile_image = $usuario_final->profile_image;
        $user_nombres = $usuario_final->user_nombres;
        $user_apellidos = $usuario_final->user_apellidos;
        $user_type = $usuario_final->user_type;
    } else {
        $profile_image = "";
    }

    $param = PlanningActivityData::getById($_POST["id"]);
    // print_r($param); 

    $date_ini = date('Y-m-d', strtotime(explode('/', $param["date_pub"])[0]));
    $date_end = date('Y-m-d', strtotime(explode('/', $param["date_pub"])[1]));
    // echo $date_ini;

    $sql = "UPDATE reports set 
		developed_content = ?, 
		training_modality = ?, 
		duration_days = ?, 
		duration_hour = ?, 
		status_activity = ?, 
		notific = ?, 
		datetime = ?, 
		date_ini = ?, 
		date_end = ?, 
		profile_image = ? 
		where id = ?;";
    $values = [
        $_POST["contenido_des"],
        $_POST["modalidad_formacion"],
        $_POST["duracion_dias"],
        $_POST["duracion_horas"],
        $_POST["status_activity"],
        $_POST["notific"],
        $datetime,
        $date_ini,
        $date_end,
        $profile_image,
        $_POST["id"]
    ];



    try {
        $result = ExecutorPg::update($sql, $values);

        if ($_POST["status_activity"] == "1" && $_POST["location"] == "planning") {
            $_SESSION['alert'] = "La planificación fue enviada a (Reportes / Actividades), desde allí se cargan las imágenes, los participantes y productos.";
        } else if ($_POST["status_activity"] != "1" && $_POST["location"] == "planning") {
            $_SESSION['alert'] = "Estatus actualizado" . $code_info;
        }

        $array = array(
            "error" => "false",
            "data"  => "ID: " . $result,
            "alert" => "Registro creado con éxito.",
            "alert_type" => "dashboard"
        );
    } catch (Exception $e) {
        $array = array(
            "data"  => "",
            "alert" => "¡Error: " . $e->getMessage() . "!",
            "alert_type" => "error"
        );
    }
    echo json_encode($array);
    return;



    // notificar la corrección de la planificación por Telegeram
    $url = "http://infoapp2.infocentro.gob.ve/admin/index.php?view=editplanning&user_id=" . $_POST["user_id"] . "&id=" . $_POST["id"] . "&code_info=" . $_POST["code_info"] . "&estado=" . $_POST["estado"] . "&participantes=&start_at=&finish_at=&pag=1";
    $code_info = $_POST["code_info"];
    $user_username = $_SESSION['user_username'];

    if ($_POST["status_activity"] == "0" && $_POST["notific"] != "") {
        // $notific = new NotificData();
        // $notific->url = $url;
        // $notific->message = "🔥 REVICIÓN INFOAPP PARA: <b>" . $code_info . "</b>\n\n<b>Nombre:</b> " . $user_nombres . " " . $user_apellidos . "\n<b>UID:</b> " . $_POST["user_id"] . "\n<b>Rol:</b> " . $user_type . "\n<b>Revisado por:</b> " . $user_username . "\n\n<b>Actividad PLANIFICADA:</b>\n\n -" . $_POST["activity_title"] . "\n\n<b>Observación:</b>\n\n" . $_POST["notific"] . "\n\nPor favor revisar las observaciones.";
        // $notific->sendTelegram();
    }
}








if ($func_post == "update_status") {

    if (!isset( # valido los parametros recibidos
        $_POST['id']
    )) {
        Core::alert("Error: Los datos enviados no son válidos");
        return false;
    }

    $usuario_final = FinalUsersData::getByUserId($_POST["user_id"]);
    if ($usuario_final != "null") {
        $profile_image = $usuario_final->profile_image;
        $user_nombres = $usuario_final->user_nombres;
        $user_apellidos = $usuario_final->user_apellidos;
        $user_type = $usuario_final->user_type;
    } else {
        $profile_image = "";
    }

    $sql = "UPDATE reports set 
		status_activity = ?, 
		notific = ?, 
		profile_image = ? 
		where id = ?;";
    $values = [
        $_POST["status_activity"],
        $_POST["notific"],
        $profile_image,
        (int)$_POST["id"]
    ];




    try {
        $result = ExecutorPg::update($sql, $values);

        if ($_POST["status_activity"] == "1" && $_POST["location"] == "planning") {
            $_SESSION['alert'] = "La planificación fue enviada a (Reportes / Actividades), desde allí se cargan las imágenes, los participantes y productos.";
        } else if ($_POST["status_activity"] == "1" && $_POST["location"] == "report") {
            $_SESSION['alert'] = "Estatus actualizado";
        }

        $array = array(
            "error" => "false",
            "data"  => "ID: " . $result,
            "alert" => "Registro creado con éxito.",
            "alert_type" => "dashboard"
        );
    } catch (Exception $e) {
        $array = array(
            "data"  => "",
            "alert" => "¡Error: " . $e->getMessage() . "!",
            "alert_type" => "error"
        );
    }
    echo json_encode($array);
    return;



    // notificar la corrección del reporte por Telegeram
    $url = "http://infoapp2.infocentro.gob.ve/admin/index.php?view=editplanning&user_id=" . $_POST["user_id"] . "&id=" . $_POST["id"] . "&code_info=" . $_POST["code_info"] . "&estado=" . $_POST["code_info"] . "&participantes=&start_at=&finish_at=&pag=1";
    $code_info = $_POST["code_info"];
    $user_username = $_SESSION['user_username'];

    if ($_POST["status_activity"] == "1" && $_POST["notific"] != "") {
        // $notific = new NotificData();
        // $notific->url = $url;
        // $notific->message = "🔥 REVICIÓN INFOAPP PARA: <b>" . $code_info . "</b>\n\n<b>Nombre:</b> " . $user_nombres . " " . $user_apellidos . "\n<b>UID:</b> " . $_POST["user_id"] . "\n<b>Rol:</b> " . $user_type . "\n<b>Revisado por:</b> " . $user_username . "\n\n<b>Actividad REPORTADA:</b>\n\n -" . $_POST["activity_title"] . "\n\n<b>Observación:</b>\n\n" . $_POST["notific"] . "\n\nPor favor revisar las observaciones.";
        // $result = $notific->sendTelegram2();
        // echo $result;
        // print '<script>console.log("Hola");</script>';
    }
}


if ($func_post == "send_notific") {
    $notific = new NotificData();
    $notific->url = $_POST["url"];
    $notific->message = $_POST["message"];
    $result = $notific->sendTelegram();
    echo $result;
    // print '<script>console.log("Hola");</script>';
}


// update_notific
if ($func_post == "update_notific") {
    if (!isset($_POST['id'])) {
        Core::alert("Error: Los datos enviados no son válidos");
        return "Error: Los datos enviados no son válidos";
    }
    // $param = PlanningActivityData::getById($_POST["id"]);

    // $param->notific = $_POST["notific_status"];
    // $param->status_activity = $_POST["status_activity"];
    // $param->update();


    $sql = "UPDATE reports set 
		status_activity = ?, 
		notific = ? 
		where id = ?;";
    $values = [
        $_POST["status_activity"],
        $_POST["notific_status"],
        (int)$_POST["id"]
    ];
    ExecutorPg::update($sql, $values);

    // Core::alert("Creado exitosamente!");
    $_SESSION['alert'] = "¡Guardado con éxito!";
}




// update_date planning
if ($func_post == "update_date") {
    if (!isset( # valido los parametros recibidos
        $_POST['id']
    )) {
        Core::alert("Error: Los datos enviados no son válidos");
        return "Error: Los datos enviados no son válidos";
    }
    $param = PlanningActivityData::getById($_POST["id"]);

    $param->date_pub = $_POST["start"] . "/" . $_POST["end"];
    $param->hour_activity = $_POST["hour_ini"] . "/" . $_POST["hour_end"];
    $param->update();
    // Core::alert("Creado exitosamente!");
    echo "Guardado exitosamente!";
}










// GET FUNCTIONS

// delet internet_type
if ($func_get == "del_internet_type") {
    if (!isset( # valido los parametros recibidos
        $_GET['id']
    )) {
        Core::alert("Error: Falta el id a eliminar");
        return;
    }
    $param = InternetTypeData::getById($_GET["id"]);
    $param->del();
    // Core::alert("Eliminado exitosamente!");

    $PHP_SELFx = "index.php?view=data&swal=Eliminado&type=" . $_GET["type"];
    echo "<script language=\"JavaScript\">
	<!-- 
	document.location=\"$PHP_SELFx\";
	//-->
    </script>";
}


// delet operative type
if ($func_get == "del_operatve_type") {
    if (!isset( # valido los parametros recibidos
        $_GET['id']
    )) {
        Core::alert("Error: Falta el id a eliminar");
        return;
    }
    $param = OperativeInfoData::getById($_GET["id"]);
    $param->del();
    // Core::alert("Eliminado exitosamente!");

    $PHP_SELFx = "index.php?view=data&swal=Eliminado&type=" . $_GET["type"];
    echo "<script language=\"JavaScript\">
	<!-- 
	document.location=\"$PHP_SELFx\";
	//-->
	</script>";
}


// delet action_line
if ($func_get == "del_action_line") {
    if (!isset( # valido los parametros recibidos
        $_GET['id']
    )) {
        Core::alert("Error: Falta el id a eliminar");
        return;
    }
    $param = ActionsLineData::getByIdPg($_GET["id"]);
    $param->delPg();
    // Core::alert("Eliminado exitosamente!");
    $_SESSION['alert'] = 'Eliminado exitosamente!';

    $array = array(
        "err"  => 'false',
        "alert_type"  => "dashboard",
        "alert"  => '¡Eliminado!'
    );
    $res = json_encode($array);
    echo $res;
    exit;
}

// del_organizacion
if ($func_get == "del_organizacion") {
    if (!isset( # valido los parametros recibidos
        $_GET['id']
    )) {
        Core::alert("Error: Falta el id a eliminar");
        return;
    }
    $param = OrganizacionesData::getByIdPg($_GET["id"]);
    $param->delPg();
    $_SESSION['alert'] = 'Eliminado exitosamente!';

    $array = array(
        "err"  => 'false',
        "alert_type"  => "dashboard",
        "alert"  => '¡Eliminado!'
    );
    $res = json_encode($array);
    echo $res;
    exit;
}


// delet del_strategic_action
if ($func_get == "del_strategic_action") {
    if (!isset( # valido los parametros recibidos
        $_GET['id']
    )) {
        Core::alert("Error: Falta el id a eliminar");
        return;
    }
    $param = StrategicActionData::getByIdPg($_GET["id"]);
    try {
        $result = $param->delPg();
        $_SESSION['alert'] = '¡Eliminado!';
        $array = array(
            "error"  => "false",
            "data"  => "Result: " . $result,
            "alert" => "¡Eliminado con éxito!",
            "alert_type" => "dashboard"
        );
    } catch (Exception $e) {
        $array = array(
            "error"  => "true",
            "data"  => "",
            "alert" => "¡Error: " . $e->getMessage() . "!",
            "alert_type" => "error"
        );
    }
    echo json_encode($array);
    return;
}





// del_status_type
if ($func_get == "del_status_type") {
    if (!isset( # valido los parametros recibidos
        $_GET['id']
    )) {
        Core::alert("Error: Falta el id a eliminar");
        return;
    }
    $param = StatusInfocentroData::getById($_GET["id"]);
    $param->del();
    // Core::alert("Eliminado exitosamente!");

    $PHP_SELFx = "index.php?view=data&swal=Eliminado&type=" . $_GET["type"];
    echo "<script language=\"JavaScript\">
	<!-- 
	document.location=\"$PHP_SELFx\";
	//-->
    </script>";
}





// del_coord
if ($func_get == "del_coord") {
    if (!isset( # valido los parametros recibidos
        $_GET['id']
    )) {
        Core::alert("Error: Falta el id a eliminar");
        return;
    }
    $param = CoordTypeData::getById($_GET["id"]);
    $param->del();
    // Core::alert("Eliminado exitosamente!");


    $PHP_SELFx = "index.php?view=data&swal=Eliminado&type=" . $_GET["type"];
    echo "<script language=\"JavaScript\">
        <!-- 
        document.location=\"$PHP_SELFx\";
        //-->
        </script>";
}




// del_responsible_type
if ($func_get == "del_responsible_type") {
    if (!isset( # valido los parametros recibidos
        $_GET['id']
    )) {
        Core::alert("Error: Falta el id a eliminar");
        return;
    }
    $param = ResponsibleTypeData::getById($_GET["id"]);
    $param->del();
    // Core::alert("Eliminado exitosamente!");


    $PHP_SELFx = "index.php?view=data&swal=Eliminado&type=" . $_GET["type"];
    echo "<script language=\"JavaScript\">
        <!-- 
        document.location=\"$PHP_SELFx\";
        //-->
        </script>";
}


// del_user_type
if ($func_get == "del_user_type") {
    if (!isset( # valido los parametros recibidos
        $_GET['id']
    )) {
        Core::alert("Error: Falta el id a eliminar");
        return;
    }
    $param = UserTypeData::getById($_GET["id"]);
    try {
        $result = $param->del();
        $_SESSION['alert'] = '¡Eliminado!';
        $array = array(
            "error"  => "false",
            "data"  => "Result: " . $result,
            "alert" => "¡Eliminado con éxito!",
            "alert_type" => "dashboard"
        );
    } catch (Exception $e) {
        $array = array(
            "error"  => "true",
            "data"  => "",
            "alert" => "¡Error: " . $e->getMessage() . "!",
            "alert_type" => "error"
        );
    }
    echo json_encode($array);
    return;
}

// del_user
if ($func_get == "del_user") {
    if (!isset( # valido los parametros recibidos
        $_GET['id']
    )) {
        Core::alert("Error: Falta el id a eliminar");
        return;
    }
    $param = UserData::getById($_GET["id"]);

    try {
        $result = $param->del();
        $_SESSION['alert'] = '¡Eliminado con éxito!';
        $array = array(
            "error"  => "false",
            "data"  => "Result: " . $result,
            "alert" => "Eliminado con éxito",
            "alert_type" => "dashboard"
        );
    } catch (Exception $e) {
        $array = array(
            "error"  => "true",
            "data"  => "",
            "alert" => "¡Error: " . $e->getMessage() . "!",
            "alert_type" => "error"
        );
    }
    echo json_encode($array);
    return;
}

// del_participant
if ($func_get == "del_participant") {
    if (!isset( # valido los parametros recibidos
        $_GET['id']
    )) {
        Core::alert("Error: Falta el id a eliminar");
        return;
    }
    $param = ParticipantsData::delByIdPg($_GET["id"]);

    $conn = DatabasePg::connectPg();
    $update_person = new ReportActivityData();
    $update_person->update_type = "del";
    $update_person->perso_gender = $_GET["gender"];
    $update_person->id_activity = $_GET["id_activity"];
    $id_activity = $_GET["id_activity"];

    if ($_GET["gender"] == "Hombre" || $_GET["gender"] == "M" || $_GET["gender"] == "m") {
        // print_r($update_person->update_participant_ma_add());
        $row = $conn->prepare("SELECT COUNT(*) as total from participants_list where gender='Hombre' and id_activity='$id_activity'");
        $row->execute();
        $total_data = $row->fetchAll(PDO::FETCH_ASSOC);
        $total_person = $total_data[0]["total"];
        echo $total_person;

        $sql = "UPDATE reports	set person_ma = ? where id = ?;";
        $values = [(int)$total_person, (int)$id_activity];
        ExecutorPg::update($sql, $values);
    }
    if ($_GET["gender"] == "Mujer" || $_GET["gender"] == "F" || $_GET["gender"] == "f") {
        $row = $conn->prepare("SELECT COUNT(*) as total from participants_list where gender='Mujer' and id_activity='$id_activity'");
        $row->execute();
        $total_data = $row->fetchAll(PDO::FETCH_ASSOC);
        $total_person = $total_data[0]["total"];
        echo $total_person;

        $sql = "UPDATE reports set person_fe = ? where id = ?;";
        $values = [(int)$total_person, (int)$id_activity];
        ExecutorPg::update($sql, $values);
    }


    $PHP_SELFx = "index.php?view=participants_list&swal=Eliminado&id_activity=" . $_GET["id_activity"] . "&activity=" . $_GET["activity"] . "&code_info=" . $_GET['code_info'] . "&date_activity=" . $_GET['date_activity'] . "&estate=" . $_GET['estate'] . "&line_action=" . $_GET['line_action'] . "&report_type=" . $_GET['report_type'] . "&user_id=" . $_GET['user_id'];
    echo "<script language=\"JavaScript\">
        <!-- 
        document.location=\"$PHP_SELFx\";
        //-->
        </script>";
}




// del_products
if ($func_get == "del_products") {
    if (!isset( # valido los parametros recibidos
        $_GET['id']
    )) {
        Core::alert("Error: Falta el id a eliminar");
        return;
    }

    $product = ProductsData::getById($_GET['id']);
    $param = ProductsData::delByIdPg($_GET["id"]);

    $id_activity = $_GET["id_activity"];
    $conn = DatabasePg::connectPg();

    $row = $conn->prepare("SELECT COUNT(*) as total from products_list where id_activity='$id_activity'");
    $row->execute();
    $total_data = $row->fetchAll(PDO::FETCH_ASSOC);
    $total = $total_data[0]["total"];
    // echo $total;

    $sql = "UPDATE reports	set total_products = ? where id = ?;";
    $values = [(int)$total, (int)$id_activity];
    ExecutorPg::update($sql, $values);

    // eliminar archivo
    $filePath  = "uploads/files/";
    $file = $product["doc_name"];
    if (file_exists($filePath . $file) && $file != "") {
        unlink($filePath . $file);
    }

    $_SESSION['alert'] = "¡Eliminado!";
    $PHP_SELFx = "index.php?view=products_list&id_activity=" . $_GET["id_activity"] . "&activity_title=" . $_GET["activity_title"] . "&user_id=" . $_GET['user_id'] . "&date_activity=" . $_GET['date_activity'] . "&estate=" . $_GET['estate'] . "&code_info=" . $_GET['code_info'];

    $array = array(
        "err"  => 'false',
        "alert_type"  => "dashboard",
        "alert"  => '¡Eliminado!',
        "redirect"  => $PHP_SELFx
    );
    $res = json_encode($array);
    echo $res;
    exit;


    // echo "<script language=\"JavaScript\">
    //     <!-- 
    //     document.location=\"$PHP_SELFx\";
    //     //-->
    //     </script>";
}





// del_product_cat
if ($func_get == "del_product_cat") {
    if (!isset( # valido los parametros recibidos
        $_GET['id']
    )) {
        Core::alert("Error: Falta el id a eliminar");
        return;
    }
    $id = $_GET["id"];
    $sql = "DELETE from categoria_productos where id=$id";
    Executor::doit($sql);
    $_SESSION['alert'] = "¡Eliminado!";

    $array = array(
        "err"  => 'false',
        "alert_type"  => "dashboard",
        "alert"  => '¡Eliminado!'
    );
    $res = json_encode($array);
    echo $res;
    exit;
}

// del_product_type
if ($func_get == "del_product_type") {

    if (!isset( # valido los parametros recibidos
        $_GET['id']
    )) {
        $array = array(
            "err"  => 'true',
            "alert_type"  => "warning",
            "alert"  => 'Falta el ID a eliminar!'
        );
        $res = json_encode($array);
        echo $res;
        return;
    }
    $id = $_GET["id"];
    $sql = "DELETE from products_type where id=$id";
    Executor::doit($sql);
    $_SESSION['alert'] = "¡Eliminado!";

    $array = array(
        "err"  => 'false',
        "alert_type"  => "dashboard",
        "alert"  => '¡Eliminado!'
    );
    $res = json_encode($array);
    echo $res;
    exit;
}


// del_specific_action
if ($func_get == "del_specific_action") {
    $id = $_GET['id'];
    if (!isset($id)) {
        Core::alert("Error: Falta el id a eliminar");
        return;
    }
    $param = SpecificActionData::getByIdPg($_GET["id"]);
    try {
        $result = $param->delPg();
        $_SESSION['alert'] = '¡Eliminado!';
        $array = array(
            "error"  => "false",
            "data"  => "Result: " . $result,
            "alert" => "¡Eliminado con éxito!",
            "alert_type" => "dashboard"
        );
    } catch (Exception $e) {
        $array = array(
            "error"  => "true",
            "data"  => "",
            "alert" => "¡Error: " . $e->getMessage() . "!",
            "alert_type" => "error"
        );
    }
    echo json_encode($array);
    return;
}

// del_specific_action
if ($func_get == "del_training_type") {
    $id = $_GET['id'];
    if (!isset($id)) {
        Core::alert("Error: Falta el id a eliminar");
        return;
    }
    $sql = "DELETE from training_type where id=$id";

    try {
        $result = ExecutorPg::doit($sql);
        $_SESSION['alert'] = '¡Eliminado!';
        $array = array(
            "error"  => "false",
            "data"  => "Result: " . $result,
            "alert" => "¡Eliminado con éxito!",
            "alert_type" => "dashboard"
        );
    } catch (Exception $e) {
        $array = array(
            "error"  => "true",
            "data"  => "",
            "alert" => "¡Error: " . $e->getMessage() . "!",
            "alert_type" => "error"
        );
    }
    echo json_encode($array);
    return;
}


// del_tipo_taller
if ($func_get == "del_tipo_taller") {
    $id = $_GET['id'];
    if (!isset($id)) {
        Core::alert("Error: Falta el id a eliminar");
        return;
    }
    $sql = "DELETE from tipo_taller where id=$id";
    try {
        $result = ExecutorPg::doit($sql);
        $_SESSION['alert'] = '¡Eliminado!';
        $array = array(
            "error"  => "false",
            "data"  => "Result: " . $result,
            "alert" => "¡Eliminado con éxito!",
            "alert_type" => "dashboard"
        );
    } catch (Exception $e) {
        $array = array(
            "error"  => "true",
            "data"  => "",
            "alert" => "¡Error: " . $e->getMessage() . "!",
            "alert_type" => "error"
        );
    }
    echo json_encode($array);
    return;
}

// del_tipo_nivel
if ($func_get == "del_tipo_nivel") {
    $id = $_GET['id'];
    if (!isset($id)) {
        Core::alert("Error: Falta el id a eliminar");
        return;
    }
    $sql = "DELETE from level_training where id=$id";
    Executor::doit($sql);

    $PHP_SELFx = "index.php?view=level_training&swal=Eliminado";
    echo "<script language=\"JavaScript\">
        <!-- 
        document.location=\"$PHP_SELFx\";
        //-->
        </script>";
}

// del_tipo_nivel
if ($func_get == "del_services_type") {
    $id = $_GET['id'];
    if (!isset($id)) {
        Core::alert("Error: Falta el id a eliminar");
        return;
    }
    $sql = "DELETE from services_type where id=$id";
    Executor::doit($sql);

    $PHP_SELFx = "index.php?view=services_type&swal=Eliminado";
    echo "<script language=\"JavaScript\">
        <!-- 
        document.location=\"$PHP_SELFx\";
        //-->
        </script>";
}








// delet_reports | por lotes
if ($func_get == "active_report") {
    if (!isset($_POST['participantes'])) # valido los parametros recibidos
    {
        Core::alert("Error: Debes seleccionar los parámetros para borrar");
        print "<script>window.location=view=report;</script>";
        return;
    }

    $participantes = $_POST['participantes'];
    // Enviar notificación al usuario
    if ($participantes == "0") {
        $sql = "UPDATE reports SET notific='Se debe cargar al menos un participante, puede ser el responsable de la actividad.\nSi es una formación cargar la data de participantes' WHERE person_fe =0 and person_ma=0 and is_active=1 and status_activity=1 and notific=''";
        // Notificar al usuario y enviar a planificadas
    } else if ($participantes == "1") {
        $sql = "UPDATE reports SET status_activity = 0, notific='Se debe cargar al menos un participante, puede ser el responsable de la actividad.\nSi es una formación cargar la data de participantes' WHERE person_fe =0 and person_ma=0 and is_active=1 and status_activity=1 and notific=''";
        // Ocultar actividades sin participantes
    } else if ($participantes == "2") {
        $sql = "UPDATE reports SET is_active=0 WHERE person_fe =0 and person_ma=0 and is_active=1 and status_activity=1";
        // Visualizar actividades sin participantes
    } else if ($participantes == "3") {
        $sql = "UPDATE reports SET is_active=1 WHERE person_fe =0 and person_ma=0 and is_active=0 and status_activity=1";
        // Limpiar notificaciones
    } else if ($participantes == "4") {
        $sql = "UPDATE reports SET notific='' WHERE person_fe =0 and person_ma=0 and is_active=1 and status_activity=1 and notific!=''";
    }
    Executor::doit($sql);
    print "<script>window.location='index.php?view=report';</script>";
}





// $statement_1 = $db->query("SELECT id_municipio, municipio FROM municipios WHERE id_estado = '$id_estado' ORDER BY municipio");
// $res = $statement_1->fetchAll();

// $html= "<option value=''>- SELECCIONAR MUNICIPIO -</option>";

// if(isset($res)){
// 	foreach ($res as $row){
// 		$html.= "<option value='".$row['id_municipio']."'>".$row['municipio']."</option>";

// 	}
// }
// echo $html;

// Database::disconnect();



// getrepeatededit
if ($func_post == "get_repeateduser") {

    // $r_username = UserData::getRepeatedUser($_POST["username"]);
    // $rx_email = UserData::getRepeatedEmail($_POST["email"]);
    // $rx_dni = UserData::getRepeatedDni($_POST["dni"]);

    try {
        $r_username = UserData::getRepeatedUser($_POST["username"]);
        $rx_email = UserData::getRepeatedEmail($_POST["email"]);
        $rx_dni = UserData::getRepeatedDni($_POST["dni"]);
    } catch (Exception $e) {
        $array = array(
            "err"  => "true",
            "data"  => "",
            "alert" => "¡Error: " . $e->getMessage() . "!",
            "alert_type" => "error"
        );
        echo json_encode($array);
        return;
    }



    if (isset($r_username->username)) {
        $username = $r_username->username != "" ? $r_username->username : "null";
    } else {
        $username = 'null';
    }
    if (isset($rx_dni->user_dni)) {
        $dni = $rx_dni->user_dni != "" ? $rx_dni->user_dni : "null";
    } else {
        $dni = 'null';
    }
    if (isset($rx_email->email)) {
        $email = $rx_email->email != "" ? $rx_email->email : "null";
    } else {
        $email = 'null';
    }




    if ($username != "null") {
        $array = array(
            "err"  => 'true',
            "param"  => "User: " . $username . " / DNI: " . $dni . " / E: " . $email,
            "text"  => '¡AVISO! ya existe un nombre de usuario igual. Por favor, intenta con otro o busca el usuario para modificarlo'
        );
        $res = json_encode($array);
        echo $res;
    } else if ($dni != "null") {
        $array = array(
            "err"  => 'true',
            "param"  => "User: " . $username . " / DNI: " . $dni . " / E: " . $email,
            "text"  => '¡AVISO! ya existe un número de documento igual. Por favor, intenta con otro o busca el usuario por su DNI para modificarlo'
        );
        $res = json_encode($array);
        echo $res;
        return;
    } else if ($email != "null") {
        $array = array(
            "err"  => 'true',
            "param"  => "User: " . $username . " / DNI: " . $dni . " / E: " . $email,
            "text"  => '¡AVISO! el correo ya se encuentra asignado a un usuario. Por favor, intenta con otro o busca el usuario por su correo para modificarlo'
        );
        $res = json_encode($array);
        echo $res;
    } else {
        $array = array(
            "err"  => 'null',
            "param"  => "User: " . $username . " / DNI: " . $dni . " / E: " . $email,
            "text"  => 'Los datos son válidos para registrar'
        );
        $res = json_encode($array);
        echo $res;
    }
}



// get_repeated_info
if ($func_post == "get_repeated_info") {


    $code = 'null';

    try {
        $rx = InfoData::getByCode($_POST["cod"]);

        if (isset($rx->cod)) {
            $code = $rx->cod != "" ? $rx->cod : "null";
        } else {
            $code = 'null';
        }


        if ($code != "null") {
            $array = array(
                "error"  => 'true',
                "param"  => "Código: " . $code,
                "text"  => '¡AVISO! ya existe un infocentro con el mismo código. Por favor, búscalo y verifica que sea el mismo'
            );
            $res = json_encode($array);
            echo $res;
        } else {
            $array = array(
                "error"  => 'false',
                "param"  => "Código: " . $code,
                "text"  => '¡AVISO! '
            );
            $res = json_encode($array);
            echo $res;
        }


        // $_SESSION['alert'] = '¡Eliminado con éxito!';
        // $array = array(
        //     "error"  => "false",
        //     "data"  => "Result: " . $result,
        //     "alert" => "Eliminado con éxito",
        //     "alert_type" => "dashboard"
        // );
    } catch (Exception $e) {
        $array = array(
            "error"  => "true",
            "data"  => "",
            "alert" => "¡Error: " . $e->getMessage() . "!",
            "alert_type" => "error"
        );
        echo json_encode($array);
        return;
    }
}


if ($func_post == "add_social_media") {

    $param = new SocialMediasData();
    $param->nombre = $_POST["nombre"];
    $param->add();

    // Core::alert("Creado exitosamente!");
    $array = array(
        "error"  => $_POST["nombre"]
    );
    $res = json_encode($array);
    echo $res;

    // echo "¡Creado exitosamente!";
}

if ($func_post == "edit_social_media") {

    $id = $_POST["id"];
    $nombre = $_POST["nombre"];

    $sql = "UPDATE social_medias set nombre='$nombre' WHERE id=$id";
    ExecutorPG::doit($sql);
    $array = array(
        "error"  => $_POST["nombre"]
    );
    $res = json_encode($array);
    echo $res;
}

if ($func_get == "del_social_media") {
    if (!isset( # valido los parametros recibidos
        $_GET['id']
    )) {
        Core::alert("Error: Falta el id a eliminar");
        return;
    }
    SocialMediasData::del($_GET["id"]);

    $PHP_SELFx = "index.php?view=social_medias&swal=Eliminado&type=" . $_GET["type"];
    echo "<script language=\"JavaScript\">
	<!-- 
	document.location=\"$PHP_SELFx\";
	//-->
    </script>";
}



function normalizarNombreArchivo($nombre)
{
    // Eliminar tildes y diacríticos
    $nombre = iconv('UTF-8', 'ASCII//TRANSLIT', $nombre);

    // Reemplazar espacios por guiones bajos
    $nombre = preg_replace('/\s+/', '_', $nombre);

    // Eliminar caracteres no deseados (conserva letras, números, puntos y guiones bajos)
    $nombre = preg_replace('/[^A-Za-z0-9\._-]/', '', $nombre);

    // Asegurar que no haya múltiples guiones bajos consecutivos
    $nombre = preg_replace('/_+/', '_', $nombre);

    // Convertir a minúsculas
    $nombre = strtolower($nombre);

    return $nombre;
}
