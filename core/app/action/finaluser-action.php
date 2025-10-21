<?php

/**
 * InfoApp
 * @author Jarcelo
 **/
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);


$func_post = "";
$func_get = "";

if (isset($_POST['function'])) {
    $func_post = $_POST["function"];
}
if (isset($_GET['function'])) {
    $func_get = $_GET["function"];
}


// agregado por un tercero
if ($func_get == "add_new") {
    $fecha_actual = date("Y", time());
    $edad = $fecha_actual - date("Y", strtotime($_POST["user_f_nacimiento"]));

    // ---------- IMAGE UPLOAD ----------
    $images = $_POST["profile"];
    $user_id = $_SESSION['user_id'];
    $dir_pics = "uploads/profile/";
    $log = '';

    if (isset($_FILES['profile_image'])) {
        // echo "SI imagen";

        $handle = new Upload($_FILES['profile_image']);
        $handle->dir_auto_create = true;
        $handle->dir_auto_chmod = true;

        if ($handle->uploaded) {

            // crear preview solo de la primera
            // $finalimage_prev = "profile_" . $user_id . "_" . date('Y-m-d-H-i-s');
            $finalimage_prev = "profile_" . $user_id . "_" . date('Y-m-d');
            $handle->image_resize            = true;
            $handle->image_ratio_y           = true;
            $handle->image_x                 = 420;
            $handle->file_new_name_body      = $finalimage_prev;
            $handle->image_convert           = 'webp';
            $handle->file_overwrite = true;
            $handle->process($dir_pics);
            // almacena en la var las imagenes para la DB
            $images = $finalimage_prev . '.' . $handle->file_dst_name_ext;

            // we check if everything went OK
            if ($handle->processed) {

                // $param = UserData::getById($_POST["user_id"]);
                // $param->profile_image = $images;
                // $param->update();

                // everything was fine !
                // echo '<p class="result">';
                // echo '  <b>File uploaded with success</b><br />';
                // echo '  <img src="' . $dir_pics . '/' . $handle->file_dst_name . '" />';
                // $info = getimagesize($handle->file_dst_pathname);
                // echo '  File: <a href="' . $dir_pics . '/' . $handle->file_dst_name . '">' . $handle->file_dst_name . '</a><br/>';
                // echo '   (' . $info['mime'] . ' - ' . $info[0] . ' x ' . $info[1] . ' -  ' . round(filesize($handle->file_dst_pathname) / 256) / 4 . 'KB)';
                // echo '</p>';
            } else {
                // one error occured
                // echo '<p class="result">';
                // echo '  <b>No se pudo subir la imagen</b><br />';
                // echo '  Error: ' . $handle->error . '';
                // echo '</p>';
                $_SESSION["alert"] = $handle->error;
            }


            // we delete the temporary files
            $handle->clean();
        } else {
            // if we're here, the upload file failed for some reasons
            // i.e. the server didn't receive the file
            // echo '<p class="result">';
            // echo '  Error: ' . $handle->error . '<br/>';
            // echo '  <b>No se pudo subir la imagen de perfil</b>';
            // echo '</p>';

        }
        $log .= $handle->log . '<br />';
    } else {
        echo "No imagen";
    }


    // ================================

    // echo $images;
    if ($_POST["child_number"] == '' || $_POST["child_number"] == 'null') {
        $child_number = 0;
    }
    $r = new FinalUsersData();
    $r->user_id = 0;
    $r->user_nombres = ucwords(mb_strtolower($_POST["user_nombres"]));
    $r->user_nombre_2 = ucwords(mb_strtolower($_POST["user_nombre_2"]));
    $r->user_apellidos = ucwords(mb_strtolower($_POST["user_apellidos"]));
    $r->user_apellido_2 = ucwords(mb_strtolower($_POST["user_apellido_2"]));
    $r->user_nationality = $_POST["user_nationality"];
    $r->user_has_document = $_POST["user_has_document"];
    $r->user_dni = $_POST["user_dni"];
    $r->parent_dni = $_POST["parent_dni"];
    $r->child_number = $child_number;
    $r->parent_ref = $_POST["parent_ref"];
    $r->user_correo = $_POST["user_correo"];
    $r->user_genero = $_POST["user_genero"];
    $r->user_etnia = $_POST["user_etnia"];
    $r->disability_type = $_POST["disability_type"];
    $r->user_telefono = $_POST["user_telefono"];
    $r->user_f_nacimiento = $_POST["user_f_nacimiento"];
    $r->user_edad = $edad;
    $r->user_comunity_type = $_POST["user_comunity_type"];
    $r->user_nivel_academ = $_POST["user_nivel_academ"];
    $r->user_profesion = $_POST["user_profesion"];
    $r->user_ocupacion = $_POST["user_ocupacion"];
    $r->user_empleado = $_POST["user_empleado"];
    $r->user_institucion = $_POST["user_institucion"];
    $r->user_pertenece_organizacion = $_POST["user_pertenece_organizacion"];
    $r->user_organizacion = $_POST["user_organizacion"];
    $r->user_estado = $_POST["user_estado"];
    $r->user_municipio = $_POST["user_municipio"];
    $r->user_direccion = $_POST["user_direccion"];
    $r->red_x = $_POST["red_x"];
    $r->red_facebook = $_POST["red_facebook"];
    $r->red_instagram = $_POST["red_instagram"];
    $r->red_linkedin = $_POST["red_linkedin"];
    $r->red_youtube = $_POST["red_youtube"];
    $r->red_tiktok = $_POST["red_tiktok"];
    $r->red_whatsapp = $_POST["red_whatsapp"];
    $r->red_telegram = $_POST["red_telegram"];
    $r->red_snapchat = $_POST["red_snapchat"];
    $r->red_pinterest = $_POST["red_pinterest"];
    $r->profile_image = $images;
    $result = $r->add();
    $id = $result[0]["id"];
    Core::redir("./admin/index.php?view=services&swal=Usuario registrado con éxito. ID:" . $id);
}

// auto-registro
if ($func_get == "add") {
    $fecha_actual = date("Y", time());
    $edad = $fecha_actual - date("Y", strtotime($_POST["user_f_nacimiento"]));

    // ---------- IMAGE UPLOAD ----------
    $images = $_POST["profile"];
    $user_id = $_SESSION['user_id'];
    $dir_pics = "uploads/profile/";
    $log = '';

    if (isset($_FILES['profile_image'])) {
        // echo "SI imagen";

        $handle = new Upload($_FILES['profile_image']);
        $handle->dir_auto_create = true;
        $handle->dir_auto_chmod = true;

        if ($handle->uploaded) {

            // crear preview solo de la primera
            // $finalimage_prev = "profile_" . $user_id . "_" . date('Y-m-d-H-i-s');
            $finalimage_prev = "profile_" . $user_id . "_" . date('Y-m-d');
            $handle->image_resize            = true;
            $handle->image_ratio_y           = true;
            $handle->image_x                 = 420;
            $handle->file_new_name_body      = $finalimage_prev;
            $handle->image_convert           = 'webp';
            $handle->file_overwrite = true;
            $handle->process($dir_pics);
            // almacena en la var las imagenes para la DB
            $images = $finalimage_prev . '.' . $handle->file_dst_name_ext;

            // we check if everything went OK
            if ($handle->processed) {

                // $param = UserData::getById($_POST["user_id"]);
                // $param->profile_image = $images;
                // $param->update();

                // everything was fine !
                // echo '<p class="result">';
                // echo '  <b>File uploaded with success</b><br />';
                // echo '  <img src="' . $dir_pics . '/' . $handle->file_dst_name . '" />';
                // $info = getimagesize($handle->file_dst_pathname);
                // echo '  File: <a href="' . $dir_pics . '/' . $handle->file_dst_name . '">' . $handle->file_dst_name . '</a><br/>';
                // echo '   (' . $info['mime'] . ' - ' . $info[0] . ' x ' . $info[1] . ' -  ' . round(filesize($handle->file_dst_pathname) / 256) / 4 . 'KB)';
                // echo '</p>';
            } else {
                // one error occured
                // echo '<p class="result">';
                // echo '  <b>No se pudo subir la imagen</b><br />';
                // echo '  Error: ' . $handle->error . '';
                // echo '</p>';
                $_SESSION["alert"] = $handle->error;
            }


            // we delete the temporary files
            $handle->clean();
        } else {
            // if we're here, the upload file failed for some reasons
            // i.e. the server didn't receive the file
            // echo '<p class="result">';
            // echo '  Error: ' . $handle->error . '<br/>';
            // echo '  <b>No se pudo subir la imagen de perfil</b>';
            // echo '</p>';

        }
        $log .= $handle->log . '<br />';
    } else {
        echo "No imagen";
    }


    // ================================

    // echo $images;

    $r = new FinalUsersData();
    $r->user_id = $_SESSION["user_id"];
    $r->user_type = $_SESSION["user_rol"];
    $r->user_nombres = ucwords(mb_strtolower($_POST["user_nombres"]));
    $r->user_apellidos = ucwords(mb_strtolower($_POST["user_apellidos"]));
    $r->user_nationality = $_POST["user_nationality"];
    $r->user_has_document = $_POST["user_has_document"];
    $r->user_dni = $_POST["user_dni"];
    $r->user_correo = $_POST["user_correo"];
    $r->user_genero = $_POST["user_genero"];
    $r->user_etnia = $_POST["user_etnia"];
    $r->disability_type = $_POST["disability_type"];
    $r->user_telefono = $_POST["user_telefono"];
    $r->user_f_nacimiento = $_POST["user_f_nacimiento"];
    $r->user_edad = $edad;
    $r->user_nivel_academ = $_POST["user_nivel_academ"];
    $r->user_profesion = $_POST["user_profesion"];
    $r->user_ocupacion = $_POST["user_ocupacion"];
    $r->user_empleado = $_POST["user_empleado"];
    $r->user_institucion = $_POST["user_institucion"];
    $r->user_pertenece_organizacion = $_POST["user_pertenece_organizacion"];
    $r->user_organizacion = $_POST["user_organizacion"];
    $r->user_estado = $_POST["user_estado"];
    $r->user_municipio = $_POST["user_municipio"];
    $r->user_direccion = $_POST["user_direccion"];
    $r->red_x = $_POST["red_x"];
    $r->red_facebook = $_POST["red_facebook"];
    $r->red_instagram = $_POST["red_instagram"];
    $r->red_linkedin = $_POST["red_linkedin"];
    $r->red_youtube = $_POST["red_youtube"];
    $r->red_tiktok = $_POST["red_tiktok"];
    $r->red_whatsapp = $_POST["red_whatsapp"];
    $r->red_telegram = $_POST["red_telegram"];
    $r->red_snapchat = $_POST["red_snapchat"];
    $r->red_pinterest = $_POST["red_pinterest"];
    $r->profile_image = $images;
    $r->add();

    $_SESSION['user_dni'] == $_POST["user_dni"];
    $_SESSION["alert"] = "Gracias por registrar tu perfil";
    Core::redir("./index.php?view=dashboard&swal=1");
}



// update_finaluser | por un tercero
if ($func_get == "update") {
    if (count($_POST) > 0) {

        $fecha_actual = date("Y", time());
        $edad = $fecha_actual - date("Y", strtotime($_POST["user_f_nacimiento"]));
        if ($_POST["child_number"] == '' || $_POST["child_number"] == 'null') {
            $child_number = 0;
        }
        // echo $_POST["id"];
        // return;
        $r = FinalUsersData::getByUserId($_POST["id"]);
        $r->user_id = $_POST["user_id"];
        $r->user_nombres = ucwords(mb_strtolower($_POST["user_nombres"]));
        $r->user_nombre_2 = ucwords(mb_strtolower($_POST["user_nombre_2"]));
        $r->user_apellidos = ucwords(mb_strtolower($_POST["user_apellidos"]));
        $r->user_apellido_2 = ucwords(mb_strtolower($_POST["user_apellido_2"]));
        $r->user_nationality = $_POST["user_nationality"];
        $r->user_has_document = $_POST["user_has_document"];
        $r->user_dni = $_POST["user_dni"];
        $r->parent_dni = $_POST["parent_dni"];
        $r->child_number = $child_number;
        $r->parent_ref = $_POST["parent_ref"];
        $r->user_correo = $_POST["user_correo"];
        $r->user_genero = $_POST["user_genero"];
        $r->user_etnia = $_POST["user_etnia"];
        $r->disability_type = $_POST["disability_type"];
        $r->user_telefono = $_POST["user_telefono"];
        $r->user_f_nacimiento = $_POST["user_f_nacimiento"];
        $r->user_edad = $edad;
        $r->user_nivel_academ = $_POST["user_nivel_academ"];
        $r->user_profesion = $_POST["user_profesion"];
        $r->user_ocupacion = $_POST["user_ocupacion"];
        $r->user_empleado = $_POST["user_empleado"];
        $r->user_institucion = $_POST["user_institucion"];
        $r->user_pertenece_organizacion = $_POST["user_pertenece_organizacion"];
        $r->user_organizacion = $_POST["user_organizacion"];
        $r->user_estado = $_POST["user_estado"];
        $r->user_municipio = $_POST["user_municipio"];
        $r->user_direccion = $_POST["user_direccion"];
        $r->red_x = $_POST["red_x"];
        $r->red_facebook = $_POST["red_facebook"];
        $r->red_instagram = $_POST["red_instagram"];
        $r->red_linkedin = $_POST["red_linkedin"];
        $r->red_youtube = $_POST["red_youtube"];
        $r->red_tiktok = $_POST["red_tiktok"];
        $r->red_whatsapp = $_POST["red_whatsapp"];
        $r->red_telegram = $_POST["red_telegram"];
        $r->red_snapchat = $_POST["red_snapchat"];
        $r->red_pinterest = $_POST["red_pinterest"];
        $r->update();

        $_SESSION['user_dni'] = $_POST["user_dni"];
    } else {
        Core::alert("No hay parámetros enviados para actualizar");
    }
    $_SESSION["alert"] = "Usuario actualizado";
    Core::redir("./admin/index.php?view=final_users&swal=1");
}



// update_finaluser | auto-registro
if ($func_get == "perfil_update") {
    if (count($_POST) > 0) {


        // ---------- IMAGE UPLOAD ----------
        $images = $_POST["profile"];
        $user_id = $_SESSION['user_id'];
        $dir_pics = "uploads/profile/";
        $log = '';

        if (isset($_FILES['profile_image'])) {
            // echo "SI imagen";

            $handle = new Upload($_FILES['profile_image']);
            $handle->dir_auto_create = true;
            $handle->dir_auto_chmod = true;

            if ($handle->uploaded) {

                // crear preview solo de la primera
                // $finalimage_prev = "profile_" . $user_id . "_" . date('Y-m-d-H-i-s');
                $finalimage_prev = "profile_" . $user_id . "_" . date('Y-m-d');
                $handle->image_resize            = true;
                $handle->image_ratio_y           = true;
                $handle->image_x                 = 420;
                $handle->file_new_name_body      = $finalimage_prev;
                $handle->image_convert           = 'webp';
                $handle->file_overwrite = true;
                $handle->process($dir_pics);
                // almacena en la var las imagenes para la DB
                $images = $finalimage_prev . '.' . $handle->file_dst_name_ext;

                // we check if everything went OK
                if ($handle->processed) {

                    // $param = UserData::getById($_POST["user_id"]);
                    // $param->profile_image = $images;
                    // $param->update();

                    // everything was fine !
                    // echo '<p class="result">';
                    // echo '  <b>File uploaded with success</b><br />';
                    // echo '  <img src="' . $dir_pics . '/' . $handle->file_dst_name . '" />';
                    // $info = getimagesize($handle->file_dst_pathname);
                    // echo '  File: <a href="' . $dir_pics . '/' . $handle->file_dst_name . '">' . $handle->file_dst_name . '</a><br/>';
                    // echo '   (' . $info['mime'] . ' - ' . $info[0] . ' x ' . $info[1] . ' -  ' . round(filesize($handle->file_dst_pathname) / 256) / 4 . 'KB)';
                    // echo '</p>';
                } else {
                    // one error occured
                    // echo '<p class="result">';
                    // echo '  <b>No se pudo subir la imagen</b><br />';
                    // echo '  Error: ' . $handle->error . '';
                    // echo '</p>';
                    $_SESSION["alert"] = $handle->error;
                }


                // we delete the temporary files
                $handle->clean();
            } else {
                // if we're here, the upload file failed for some reasons
                // i.e. the server didn't receive the file
                // echo '<p class="result">';
                // echo '  Error: ' . $handle->error . '<br/>';
                // echo '  <b>No se pudo subir la imagen de perfil</b>';
                // echo '</p>';

            }
            $log .= $handle->log . '<br />';
        } else {
            echo "No imagen";
        }


        // ================================

        // echo $images;

        $fecha_actual = date("Y", time());
        $edad = $fecha_actual - date("Y", strtotime($_POST["user_f_nacimiento"]));

        if ($_POST["child_number"] == '' || $_POST["child_number"] == 'null') {
            $child_number = 0;
        }


        // echo $_POST["id"];
        // return;
        $r = FinalUsersData::getByUserId($_POST["id"]);
        $r->user_id = $_POST["user_id"];
        $r->user_nombres = ucwords(mb_strtolower($_POST["user_nombres"]));
        $r->user_nombre_2 = ucwords(mb_strtolower($_POST["user_nombre_2"]));
        $r->user_apellidos = ucwords(mb_strtolower($_POST["user_apellidos"]));
        $r->user_apellido_2 = ucwords(mb_strtolower($_POST["user_apellido_2"]));
        $r->user_nationality = $_POST["user_nationality"];
        $r->user_has_document = $_POST["user_has_document"];
        $r->user_dni = $_POST["user_dni"];
        $r->parent_dni = $_POST["parent_dni"];
        $r->child_number = $child_number;
        $r->parent_ref = $_POST["parent_ref"];
        $r->user_correo = $_POST["user_correo"];
        $r->user_genero = $_POST["user_genero"];
        $r->user_etnia = $_POST["user_etnia"];
        $r->disability_type = $_POST["disability_type"];
        $r->user_telefono = $_POST["user_telefono"];
        $r->user_f_nacimiento = $_POST["user_f_nacimiento"];
        $r->user_edad = $edad;
        $r->user_nivel_academ = $_POST["user_nivel_academ"];
        $r->user_profesion = $_POST["user_profesion"];
        $r->user_ocupacion = $_POST["user_ocupacion"];
        $r->user_empleado = $_POST["user_empleado"];
        $r->user_institucion = $_POST["user_institucion"];
        $r->user_pertenece_organizacion = $_POST["user_pertenece_organizacion"];
        $r->user_organizacion = $_POST["user_organizacion"];
        $r->user_estado = $_POST["user_estado"];
        $r->user_municipio = $_POST["user_municipio"];
        $r->user_direccion = $_POST["user_direccion"];
        $r->red_x = $_POST["red_x"];
        $r->red_facebook = $_POST["red_facebook"];
        $r->red_instagram = $_POST["red_instagram"];
        $r->red_linkedin = $_POST["red_linkedin"];
        $r->red_youtube = $_POST["red_youtube"];
        $r->red_tiktok = $_POST["red_tiktok"];
        $r->red_whatsapp = $_POST["red_whatsapp"];
        $r->red_telegram = $_POST["red_telegram"];
        $r->red_snapchat = $_POST["red_snapchat"];
        $r->red_pinterest = $_POST["red_pinterest"];
        $r->profile_image = $images;
        $r->update();

        $_SESSION['user_dni'] == $_POST["user_dni"];
        $_SESSION["alert"] .= "Perfil actualizado";
        Core::redir("./index.php?view=userform_update&swal=1");
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
    $param = FinalUsersData::getById($_GET["id"]);
    $param->del();

    // Core::alert("Eliminado exitosamente!");


    Core::redir("./index.php?view=final_users&swal=Registro borrado");

    // print "<script>window.location='index.php?view=facilitators';</script>";

}


// getrepeated userform
if ($func_get == "getrepeated") {
    $rx_dni = FinalUsersData::getRepeatedDni($_POST["dni"]);
    $rx_email = FinalUsersData::getRepeatedEmail($_POST["email"]);
    // $rx_id = FinalUsersData::getByUserId($_POST["user_id"]);
    $user_has_document = $_POST["user_has_document"];


    $dni = "null";
    $email = "null";

    if (isset($_POST["dni"]) && $rx_dni != "null" && $user_has_document == "Si" && $_POST["dni"] != "No cedulado") {
        $dni = $rx_dni->user_dni;
    } else if ($rx_dni == "null" && $user_has_document != "Si") {
        $dni = "null";
    }


    if (isset($_POST["email"]) && $rx_email != "null" && $_POST["email"] != "") {
        $email = $rx_email->user_correo;
    } else if (isset($_POST["email"]) && $rx_email != "null" && $_POST["email"] == "") {
        $email = "null";
    } else if ($rx_email == "null") {
        $email = "null";
    }


    // echo "DNI: ".$dni;
    // echo "EMAIL: ".$email;


    // cuando existe dni y correo
    if ($dni != "null" && $email != "null") {
        $array = array(
            "err"  => 'null',
            "param"  => 'ambos: ' . $dni . "-" . $email,
            "text"  => '¡AVISO! el Nº de documento y el correo ya estan registrados, actualiza los datos en el menú Configuración / usuario'
        );
        $res = json_encode($array);
        echo $res;
    } else if ($dni != "null") {
        $array = array(
            "err"  => 'null',
            "param"  => 'dni: ' . $dni . "-" . $email,
            "text"  => '¡AVISO! el Nº de documento ya está registrado, actualiza los datos en el menú Configuración / usuario'
        );
        $res = json_encode($array);
        echo $res;
    }

    // cuando existe y el correo es obligatorio
    else if ($email != "null") {
        $array = array(
            "err"  => 'null',
            "param"  => 'email: -' . $dni . "-" . $email,
            "otro"  => $user_has_document,
            "text"  => '¡AVISO! el correo ya se encuentra registrado, actualiza los datos en el menú Configuración / usuario'
        );
        $res = json_encode($array);
        echo $res;
    } else {
        $array = array(
            "err"  => 'false',
            "text"  => 'No existe el usuario'
        );
        $res = json_encode($array);
        echo $res;
    }
}






// getbyparent_ref from userform_new
if ($func_get == "getbyparent_ref") {

    $child_number = $_POST["child_number"];
    // no esta cedulado y tiene parent_ref
    $rx_parent_ref = FinalUsersData::getRepeatedParentRef($_POST["parent_ref"]);

    // cuando existe el no cedulado
    if ($rx_parent_ref != "null") {
        $array = array(
            "err"  => 'null',
            "user_nombres"  => $rx_parent_ref->user_nombres . ' ' . $rx_parent_ref->user_nombre_2,
            "user_apellidos"  => $rx_parent_ref->user_apellidos . ' ' . $rx_parent_ref->user_apellido_2,
            "param"  => 'parent_ref',
            "text"  => "¡AVISO! ya existe el Nº de hijo (" . $child_number . ") de éste representante, asegúrate que sea el mismo o prueba con otro número de hijo.\nEl hijo encontrado es: " . $rx_parent_ref->user_nombres . " " . $rx_parent_ref->user_nombre_2 . " " . $rx_parent_ref->user_apellidos . " " . $rx_parent_ref->user_apellido_2
        );
        $res = json_encode($array);
        echo $res;
        return;
    } else {
        $array = array(
            "err"  => 'No existe el usuario',
            "param"  => ''
        );
        $res = json_encode($array);
        echo $res;
        return;
    }
}




// getbydni from userform_new
if ($func_get == "getbydni") {

    $user_dni = $_POST["user_dni"];
    // no esta cedulado y tiene parent_ref
    $rx_parent_ref = FinalUsersData::getRepeatedDni($_POST["user_dni"]);

    // cuando existe el no cedulado
    if ($rx_parent_ref != "null") {
        $array = array(
            "err"  => 'null',
            "user_nombres"  => $rx_parent_ref->user_nombres . ' ' . $rx_parent_ref->user_nombre_2,
            "user_apellidos"  => $rx_parent_ref->user_apellidos . ' ' . $rx_parent_ref->user_apellido_2,
            "param"  => 'dni',
            "text"  => "¡AVISO! ya existe un usuario con el mismo documento de identidad (" . $user_dni . "). Verifica si es el mismo y podrás editar sus datos desde el panel Gestión humana/Usuarios.\nEl usuario es: " . $rx_parent_ref->user_nombres . " " . $rx_parent_ref->user_nombre_2 . " " . $rx_parent_ref->user_apellidos . " " . $rx_parent_ref->user_apellido_2
        );
        $res = json_encode($array);
        echo $res;
        return;
    } else {
        $array = array(
            "err"  => 'No existe el usuario',
            "param"  => ''
        );
        $res = json_encode($array);
        echo $res;
        return;
    }
}



// getbyemail from userform_new
if ($func_get == "getbyemail") {
    $user = FinalUsersData::getRepeatedEmail($_POST["user_correo"]);
    // cuando existe el no cedulado
    if ($user != "null") {
        $array = array(
            "err"  => 'null',
            "user_nombres"  => $user->user_nombres . ' ' . $user->user_nombre_2,
            "user_apellidos"  => $user->user_apellidos . ' ' . $user->user_apellido_2,
            "param"  => 'email',
            "text"  => "¡AVISO! el correo ya se encuentra registrado, puedes buscarlo y editarlo desde Gestión Humana.\nEl usuario es: " . $user->user_nombres . " " . $user->user_nombre_2 . " " . $user->user_apellidos . " " . $user->user_apellido_2
        );
        $res = json_encode($array);
        echo $res;
        return;
    } else {
        $array = array(
            "err"  => 'No existe el usuario',
            "param"  => ''
        );
        $res = json_encode($array);
        echo $res;
        return;
    }
}




// getrepeated userform_update
if ($func_get == "getrepeatedupdateuser") {
    $rx_parent_ref = FinalUsersData::getRepeatedParentRefUpdate($_POST["id"], $_POST["parent_ref"]);
    $user_has_document = $_POST["user_has_document"];

    $child_number = $_POST["child_number"];
    $parent_dni = $_POST["parent_dni"];
    $parent_ref = "null";


    if (isset($_POST["parent_ref"]) && $rx_parent_ref != "null" && $user_has_document != "Si") {
        $parent_ref = $rx_parent_ref->parent_ref;
    } else if ($rx_parent_ref == "null" && $user_has_document == "Si") {
        $parent_ref = "null";
    }


    // cuando existe el no cedulado
    if ($parent_ref != "null") {
        $array = array(
            "err"  => 'null',
            "user_nombres"  => $rx_parent_ref->user_nombres . ' ' . $rx_parent_ref->user_nombre_2,
            "user_apellidos"  => $rx_parent_ref->user_apellidos . ' ' . $rx_parent_ref->user_apellido_2,
            "param"  => 'parent_ref',
            "text"  => "¡AVISO! ya existe el Nº de hijo (" . $child_number . ") de éste representante (" . $parent_dni . "), asegúrate que sea el mismo o prueba con otro número de hijo.\nEl hijo encontrado es: " . $rx_parent_ref->user_nombres . " " . $rx_parent_ref->user_nombre_2 . " " . $rx_parent_ref->user_apellidos . " " . $rx_parent_ref->user_apellido_2
        );
        $res = json_encode($array);
        echo $res;
        return;
    } else {
        $array = array(
            "err"  => 'false',
            "text"  => 'No existe el usuario'
        );
        $res = json_encode($array);
        echo $res;
    }
}




// getrepeatedsignup
if ($func_get == "getrepeatedsignup") {

    $r_username = UserData::getRepeatedUser($_POST["username"]);
    $rx_email = UserData::getRepeatedEmail($_POST["email"]);
    $rx_dni = UserData::getRepeatedDni($_POST["user_dni"]);


    $dni = "null";
    $email = "null";

    if (isset($r_username) && isset($_POST["username"])) {
        $username = $r_username->username;
    } else if (!isset($r_username) && isset($_POST["username"])) {
        $username = "null";
    }

    if (isset($rx_dni) && isset($_POST["user_dni"]) && $_POST["user_dni"] != "") {
        $dni = $rx_dni->user_dni;
    } else if ($rx_dni->user_dni == "") {
        $dni = "null";
    }


    if (isset($rx_email) && isset($_POST["email"]) && $_POST["email"] != "") {
        $email = $rx_email->email;
    } else if (isset($rx_email) && isset($_POST["email"]) && $_POST["email"] == "") {
        $email = "null";
    } else if ($rx_email->email == "") {
        $email = "null";
    }

    // echo "DNI: ".$dni;
    // echo "EMAIL: ".$email;




    if ($dni != "null") {
        $array = array(
            "err"  => 'null',
            "param"  => $dni,
            "text"  => '¡AVISO! ya existe el número de documento registrado'
        );
        $res = json_encode($array);
        echo $res;
    }

    // cuando existe username y correo
    else if ($username != "null" && $email != "null") {
        $array = array(
            "err"  => 'null',
            "param"  => 'Ambos',
            "text"  => '¡AVISO! ya existe un usuario y un correo igual'
        );
        $res = json_encode($array);
        echo $res;
    } else if ($username != "null") {
        $array = array(
            "err"  => 'null',
            "param"  => $username,
            "text"  => '¡AVISO! ya existe ese nombre de usuario'
        );
        $res = json_encode($array);
        echo $res;
    }


    // cuando existe y el correo es obligatorio
    else if ($email != "null") {
        $array = array(
            "err"  => 'null',
            "param"  => $email,
            "text"  => '¡AVISO! ya existe un correo igual'
        );
        $res = json_encode($array);
        echo $res;
    } else {
        $array = array(
            "err"  => 'false',
            "text"  => 'No existe el usuario'
        );
        $res = json_encode($array);
        echo $res;
    }
}

// getbydni from userform_new
if ($func_get == "getUserDataByDni") {

    $user_dni = $_POST["user_dni"];
    // no esta cedulado y tiene parent_ref
    $user = FinalUsersData::getRepeatedDni($_POST["user_dni"]);

    // cuando existe el no cedulado
    if ($user != "null") {
        $array = $user;
        $res = json_encode($array);
        echo $res;
        return;
    } else {
        $array = array(
            "err"  => 'No existe el usuario',
            "param"  => ''
        );
        $res = json_encode($array);
        echo $res;
        return;
    }
}