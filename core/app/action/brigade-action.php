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


// agregado por un tercero
if ($func_get == "add_new") {
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

        $is_new = false;

        $fecha_actual = date("Y", time());
        $edad = $fecha_actual - date("Y", strtotime($_POST["user_f_nacimiento"]));

        $r = FinalUsersData::getByUserId($_POST["id"]);
        
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
        
        if($is_new){
            $r->add();

            if($_POST["user_dni"] == "No cedulado"){
                $r = FinalUsersData::getRepeatedEmail($_POST["user_correo"]);
            }else{
                $r = FinalUsersData::getRepeatedDni($_POST["user_dni"]);

            }

            
        }else{
            $r->update();
            $r = FinalUsersData::getByUserId($_POST["id"]);
        }


        $user_brigade = new UserBrigadesData();

        $user_brigade->fk_id_user = $r->id;
        $user_brigade->fk_id_brigade = $_POST["user_brigada"];
        $user_brigade->municipio = $_POST["user_municipio"];
        $user_brigade->parroquia = $_POST["user_parroquia"];
        $user_brigade->ciudad = $_POST["user_ciudad"];
        $user_brigade->comunidad = $_POST["user_comunidad"];
        $user_brigade->info_cod = $_POST["info_cod"];

        $user_brigade->add();


        $_SESSION['user_dni'] == $_POST["user_dni"];
        $_SESSION["alert"] .= "Brigadista creado";
        Core::redir("./index.php?view=brigadistaform_new&swal=1");
    } else {
        Core::alert("No hay parámetros enviados para anexar");
    }
}


// update_finaluser | por un tercero
if ($func_get == "update") {
    if (count($_POST) > 0) {

        $fecha_actual = date("Y", time());
        $edad = $fecha_actual - date("Y", strtotime($_POST["user_f_nacimiento"]));

        // echo $_POST["id"];
        // return;
        $r = FinalUsersData::getByUserId($_POST["user_id"]);
        $r->user_id = $_POST["user_id"];
        $r->user_municipio = $_POST["user_municipio"];
        $r->red_x = $_POST["red_x"];
        $r->red_facebook = $_POST["red_facebook"];
        $r->red_instagram = $_POST["red_instagram"];
        $r->red_linkedin = $_POST["red_linkedin"];
        $r->red_youtube = $_POST["red_youtube"];
        $r->red_tiktok = $_POST["red_tiktok"];
        $r->red_whatsapp = $_POST["phone"];
        $r->red_telegram = $_POST["phone_t"];
        $r->red_snapchat = $_POST["red_snapchat"];
        $r->red_pinterest = $_POST["red_pinterest"];
        $r->update();

        $user_brigade = UserBrigadesData::getById($_POST["user_brigade_id"]);
        $user_brigade->fk_id_user = $r->id;
        $user_brigade->fk_id_brigade = $_POST["user_brigada"];
        $user_brigade->municipio = $_POST["user_municipio"];
        $user_brigade->parroquia = $_POST["user_parroquia"];
        $user_brigade->ciudad = $_POST["user_ciudad"];
        $user_brigade->comunidad = $_POST["user_comunidad"];
        $user_brigade->info_cod = $_POST["info_cod"];

        $user_brigade->update();

        // $_SESSION['user_dni'] = $_POST["user_dni"];
        $_SESSION["alert"] = "Brigadista actualizado";
        Core::redir("./admin/?view=brigadistas&swal=1");
    } else {
        Core::alert("No hay parámetros enviados para actualizar");
    }
    // Core::redir("./admin/?view=brigadistas&swal=1");
}


// del_facilitator
if ($func_get == "delete") {
    if (!isset( # valido los parametros recibidos
        $_GET['id']
    )) {
        Core::alert("Error: Falta el id a eliminar");
        return;
    }
    $param = BrigadeData::getById($_GET["id"]);
    
    $param->del();
        
    Core::redir("./index.php?view=brigadas&swal=Registro borrado");


}

// getbydni from userform_new
if ($func_get == "getUserDataByDni") {

    $user_dni = $_POST["user_dni"];
    // no esta cedulado y tiene parent_ref
    $user = FinalUsersData::getRepeatedDni($_POST["user_dni"]);

    // cuando existe el no cedulado
    if ($user != "null") {

        $user->user_estado = EstadoData::getByNmae("'$user->user_estado'")->id_estado;
        $user->user_municipio = isset(MunicipioData::getByName("'$user->user_municipio'")->id_municipio)?MunicipioData::getByName("'$user->user_municipio'")->id_municipio:null;

        $array = array(
            "success"  => 'true',
            "data" => $user,
            "text"  => "El usuario existe  (" . $user_dni . "). Verifica los datos y anexalo como brigadista"
        );
        $res = json_encode($array);
        echo $res;
        return;
    } else {
        $array = array(
            "success"  => 'false',
            "text"  => 'No existe el usuario, crea el usuario en "Gestion humana/Usuarios" y anexalo como brigadista.',
        );
        $res = json_encode($array);
        echo $res;
        return;
    }
}

if ($func_get == "getUserDataByEmail") {

    $user_correo = $_POST["user_correo"];
    // no esta cedulado y tiene parent_ref
    $user = FinalUsersData::getRepeatedEmail($user_correo);

    if ($user != "null") {
        $user->user_estado = EstadoData::getByNmae("'$user->user_estado'")->id_estado;

        $user->user_municipio = isset(MunicipioData::getByName("'$user->user_municipio'")->id_municipio)?MunicipioData::getByName("'$user->user_municipio'")->id_municipio:null;

        $array = array(
            "success"  => 'true',
            "data" => $user,
            "text"  => "El usuario existe  (" . $user_correo . "). Verifica los datos y anexalo como brigadista"
        );
        $res = json_encode($array);
        echo $res;
        return;
    } else {
        $array = array(
            "success"  => 'false',
            "text"  => 'No existe el usuario, crea el usuario en "Gestion humana/Usuarios" y anexalo como brigadista.',
        );
        $res = json_encode($array);
        echo $res;
        return;
    }
}


if ($func_get == "getUserDataById") {

    $user_id = $_POST["user_id"];
    // no esta cedulado y tiene parent_ref
    $user = FinalUsersData::getByUserId($user_id);
    if ($user != "null") {
        $user->user_estado = EstadoData::getByNmae("'$user->user_estado'")->id_estado;

        $user->user_municipio = isset(MunicipioData::getByName("'$user->user_municipio'")->id_municipio)?MunicipioData::getByName("'$user->user_municipio'")->id_municipio:null;

        

        $array = array(
            "success"  => 'true',
            "data" => $user,
            "text"  => "El usuario existe  (" . $user_id . "). Verifica los datos y anexalo como brigadista"
        );
        $res = json_encode($array);
        echo $res;
        return;
    } else {
        $array = array(
            "success"  => 'false',
            "text"  => 'No existe el usuario, crea el usuario en "Gestion humana/Usuarios" y anexalo como brigadista.',
        );
        $res = json_encode($array);
        echo $res;
        return;
    }
}


// getbyemail from userform_new
if ($func_get == "getUserbyemail") {
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

if ($func_get == "getUserbyId") {

    $user_id = $_POST["user_id"];

    $user = FinalUsersData::getById($user_id);
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


if ($func_get == "getBrigadierByDni") {

    $user_dni = $_POST["user_dni"];
    // no esta cedulado y tiene parent_ref
    $user = UserBrigadesData::getByDNI($_POST["user_dni"]);

    // cuando existe el no cedulado
    if ($user != "null") {

        $user->user_estado = EstadoData::getByNmae("'$user->user_estado'")->id_estado;
        $user->user_municipio = isset(MunicipioData::getByName("'$user->user_municipio'")->id_municipio)?MunicipioData::getByName("'$user->user_municipio'")->id_municipio:null;

        $array = array(
            "success"  => 'true',
            "data" => $user,
        );
        $res = json_encode($array);
        echo $res;
        return;
    } else {
        $array = array(
            "success"  => 'false',
        );
        $res = json_encode($array);
        echo $res;
        return;
    }
}

if ($func_get == "getBrigadierByEmail") {

    $user_correo = $_POST["user_correo"];
    // no esta cedulado y tiene parent_ref
    $user = UserBrigadesData::getByEmail($_POST["user_correo"]);

    // cuando existe el no cedulado
    if ($user != "null") {

        $user->user_estado = EstadoData::getByNmae("'$user->user_estado'")->id_estado;
        $user->user_municipio = isset(MunicipioData::getByName("'$user->user_municipio'")->id_municipio)?MunicipioData::getByName("'$user->user_municipio'")->id_municipio:null;

        $array = array(
            "success"  => 'true',
            "data" => $user,
        );
        $res = json_encode($array);
        echo $res;
        return;
    } else {
        $array = array(
            "success"  => 'false',
        );
        $res = json_encode($array);
        echo $res;
        return;
    }
}


if ($func_get == "getBrigadierByUID") {

    $user_id = $_POST["user_id"];
    // no esta cedulado y tiene parent_ref
    $user = UserBrigadesData::getByUID($_POST["user_id"]);

    // cuando existe el no cedulado
    if ($user != "null") {

        $user->user_estado = EstadoData::getByNmae("'$user->user_estado'")->id_estado;
        $user->user_municipio = isset(MunicipioData::getByName("'$user->user_municipio'")->id_municipio)?MunicipioData::getByName("'$user->user_municipio'")->id_municipio:null;

        $array = array(
            "success"  => 'true',
            "data" => $user,
        );
        $res = json_encode($array);
        echo $res;
        return;
    } else {
        $array = array(
            "success"  => 'false',
        );
        $res = json_encode($array);
        echo $res;
        return;
    }
}
