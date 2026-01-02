<?php




if (count($_POST) > 0) {
    if (!isset($_POST['id'])) { # valido los parametros recibidos
        Core::alert("Error: Los datos enviados no son válidos");
        return false;
    }

    $pag = $_GET["pag"];
    if ($pag == "") {
        $pag = "1";
    }

    // $estado_n = EstadoData::getById($_POST["user_estado"]);
    // foreach($estado_n as $p):
    //     $estado_name = $p['estado'];
    // endforeach;


    $id_user_final = "";
    $parent_ref = "";
    $fecha_actual = date("Y", time());
    $age = $fecha_actual - date("Y", strtotime($_POST["user_f_nacimiento"]));

    // $final_user = FinalUsersData::getRepeatedFromAjax($_POST["document_id"],$_POST["parent_ref"],$_POST["id"],$_POST["name"],$_POST["lastname"],$_POST["user_has_document"],$_POST["user_f_nacimiento"]);
    $final_user = FinalUsersData::getRepeatedFromUpdatePart($_POST["document_id"], $_POST["id_user_final"], $_POST["parent_ref"]);
    // echo "XXX:-",$final_user["id"];
    // print_r($final_user);


    $user_correo = $_POST["email"] != "" ? $_POST["email"] : (isset($final_user["user_correo"]) ? $final_user["user_correo"] : "");
    $user_telefono = $_POST["phone"] != "" ? $_POST["phone"] : (isset($final_user["user_telefono"]) ? $final_user["user_telefono"] : "");
    $id_user_final = $_POST["id_user_final"] != "" ? $_POST["id_user_final"] : (isset($final_user["id"]) ? $final_user["id"] : "0");
    $parent_dni = $_POST["parent_dni"] != "Falta" ? $_POST["parent_dni"] : (isset($final_user["parent_dni"]) ? $final_user["parent_dni"] : "");


    if (($_POST["document_id"] != "" || $_POST["document_id"] != "0") && $_POST["user_has_document"] == "Si") {
        $document_id = $_POST["document_id"];
    } else if ($_POST["user_has_document"] != "Si") {
        $document_id = "No cedulado";
    }

    if ($_POST["parent_ref"] != "" && $_POST["parent_ref"] != "0") {
        $parent_ref = $_POST["parent_ref"];
    } else {
        $parent_ref = $id_user_final;
    }

    // if (count($final_user) > 0) {
    if (isset($final_user["id"])) {

        $r = FinalUsersData::getByIdPg($id_user_final);
        // $r = new FinalUsersData();
        // $r->id = $id_user_final;
        $r->user_nombres = ucwords(mb_strtolower($_POST["name"]));
        $r->user_nombre_2 = ucwords(mb_strtolower($_POST["name_2"]));
        $r->user_apellidos = ucwords(mb_strtolower($_POST["lastname"]));
        $r->user_apellido_2 = ucwords(mb_strtolower($_POST["lastname_2"]));
        $r->user_nationality = $_POST["user_nationality"];
        $r->user_has_document = $_POST["user_has_document"];
        $r->user_dni =  $document_id;
        $r->parent_dni = $parent_dni;
        $r->child_number = $_POST["child_number"];
        $r->parent_ref = $parent_ref;
        $r->user_correo = $user_correo;
        $r->user_genero = $_POST["gender"];
        $r->user_comunity_type = $_POST["user_comunity_type"];
        $r->user_etnia = ucwords(mb_strtolower($_POST["user_etnia"]));
        $r->disability_type = $_POST["disability_type"];
        $r->user_telefono = $user_telefono;
        $r->user_f_nacimiento = $_POST["user_f_nacimiento"];
        $r->user_edad = $age;
        $r->user_pertenece_organizacion = $_POST["user_pertenece_organizacion"];
        $r->user_estado = $_POST["user_estado"];
        $r->user_profesion = $_POST["user_profesion"];
        $r->user_ocupacion = $_POST["user_ocupacion"];
        $r->user_equipo_sala_comunal = $_POST["equipo_sala_comunal"];
        $r->update();
        $id_user_final = $id_user_final;
        echo "Usuario actualizado";
    } else {

        $r = new FinalUsersData();
        $r->user_id = null;
        $r->user_nombres = ucwords(mb_strtolower($_POST["name"]));
        $r->user_nombre_2 = ucwords(mb_strtolower($_POST["name_2"]));
        $r->user_apellidos = ucwords(mb_strtolower($_POST["lastname"]));
        $r->user_apellido_2 = ucwords(mb_strtolower($_POST["lastname_2"]));
        $r->user_nationality = $_POST["user_nationality"];
        $r->user_has_document = $_POST["user_has_document"];
        $r->user_dni =  $document_id;
        $r->parent_dni = $_POST["parent_dni"];
        $r->child_number = $_POST["child_number"];
        $r->parent_ref = $_POST["parent_ref"];
        $r->user_correo = $_POST["email"];
        $r->user_genero = $_POST["gender"];
        $r->user_comunity_type = $_POST["user_comunity_type"];
        $r->user_etnia = $_POST["user_etnia"];
        $r->disability_type = $_POST["disability_type"];
        $r->user_telefono = $_POST["phone"];
        $r->user_f_nacimiento = $_POST["user_f_nacimiento"];
        $r->user_edad = $age;
        $r->user_pertenece_organizacion = $_POST["user_pertenece_organizacion"];
        $r->user_estado = $_POST["user_estado"];
        $r->user_profesion = $_POST["user_profesion"];
        $r->user_ocupacion = $_POST["user_ocupacion"];
        $r->user_equipo_sala_comunal = $_POST["equipo_sala_comunal"];
        $id_user_final = $r->add()[0]["id"];
        echo "Nuevo usuario";
    }



    if ($_POST["parent_ref"] != "" && $_POST["parent_ref"] != "0") {
        $parent_ref = $_POST["parent_ref"];
    } else {
        $parent_ref = $id_user_final;
    }

    $param = new ParticipantsData();
    $param->id = $_POST["id"];
    $param->id_user_final = $id_user_final;
    $param->id_activity = $_POST["id_activity"];
    $param->date_activity = $_POST["date_activity"];
    $param->estate = $_POST["user_estado"];
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
    $param->etnia = ucwords(mb_strtolower($_POST["user_etnia"]));
    $param->disability_type = $_POST["disability_type"];
    $param->equipo_sala_comunal = $_POST["equipo_sala_comunal"];
    $resul = $param->update();

    if (isset($_SESSION["section"]) and $_SESSION["section"] == "participants") {
        Core::redir($_SESSION["location"] . "&swal=Participante actualizado&pag=" . $pag);
    } else {
        Core::redir("./index.php" . $_SESSION["location"] . "&swal=Participante actualizado&pag=" . $pag);
    }
}
