<?php
/**
* InfoApp
* @author Jarcelo
**/

$func_post = "";
$func_get = "";

// if (isset($_POST['function'])){$func_post = $_POST["function"]; }
if (isset($_GET['function'])){$func_get = $_GET["function"]; }
$fecha_n = isset($_GET['user_f_nacimiento'])? $_POST["user_f_nacimiento"] :null;

// deprecated ambos
// $date = new DateTime($fecha_n);
// $formatted_date = $date->format('Y');
// $fecha_actual = date("Y",time());
// $edad = $fecha_actual-date("Y", $formatted_date);

$fecha_actual = date("Y",time());
$edad = $fecha_actual-date("Y", strtotime($fecha_n));



if($func_get == "add"){
    $rx = FinalUsersData::getRepeated($_POST["user_dni"]);
    if($rx==null){
        $r = new FinalUsersData();
        $r->user_nombres = ucfirst(strtolower($_POST["user_nombres"]));
        $r->user_apellidos = ucfirst(strtolower($_POST["user_apellidos"]));
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
        $r->user_empleado = $_POST["user_empleado"];
        $r->user_institucion = $_POST["user_institucion"];
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
        $r->add();

    // echo $_POST["cod"] . $_POST["nombre"] . $_POST["estado"] . $estado_name;

    }else{
    Core::alert("¡AVISO: no se registró, ya existe la cedula que intentas guardar!");
    Core::redir("./index.php?view=newfacilitator");

    }
    Core::redir("./index.php?view=final_users&swal=Registro creado");

}



// update
if($func_get == "update"){
    if(count($_POST)>0){

        $r = FinalUsersData::getById($_POST["id"]);
        $r->id = $_POST["id"];
        $r->user_type = $_POST["user_type"];
        $r->user_nombres = $_POST["user_nombres"];
        $r->user_apellidos = $_POST["user_apellidos"];
        $r->user_nationality = $_POST["user_nationality"];
        $r->user_dni = $_POST["user_dni"];
        $r->user_correo = $_POST["user_correo"];
        $r->user_genero = $_POST["user_genero"];
        $r->user_comunity_type = $_POST["user_comunity_type"];
        $r->user_etnia = $_POST["user_etnia"];
        $r->user_telefono = $_POST["user_telefono"];
        $r->user_f_nacimiento = $_POST["user_f_nacimiento"];
        $r->user_edad = $edad;
        $r->user_nivel_academ = $_POST["user_nivel_academ"];
        $r->user_profesion = $_POST["user_profesion"];
        $r->user_ocupacion = $_POST["user_ocupacion"];
        $r->user_empleado = $_POST["user_empleado"];
        $r->user_institucion = $_POST["user_institucion"];
        $r->user_organizacion = $_POST["user_organizacion"];
        $r->user_pertenece_organizacion = $_POST["user_pertenece_organizacion"];
        $r->user_estado = $_POST["user_estado"];
        $r->user_municipio = $_POST["user_municipio"];
        $r->user_direccion = $_POST["user_direccion"];
        $r->disability_type = $_POST["disability_type"];
        $r->update();
    
    }else {
        Core::alert("No hay parámetros enviados para actualizar");
    }

    Core::redir("./index.php?view=final_users&swal=Registro actualizado");

}



// del_facilitator
if($func_get == "delete"){
    if (!isset( # valido los parametros recibidos
        $_GET['id']
        )) {Core::alert("Error: Falta el id a eliminar");
            return;
        }
    $param = FinalUsersData::getById($_GET["id"]);
    $param->del();

    // Core::alert("Eliminado exitosamente!");


    Core::redir("./index.php?view=final_users&swal=Registro borrado");

    // print "<script>window.location='index.php?view=facilitators';</script>";

}




// getrepeatededit
if($func_get == "getrepeatededit"){



    $r_username = UserData::getRepeatedUserEdit($_POST["username"],$_POST["user_id"]);
    $rx_email = UserData::getRepeatedEmailEdit($_POST["email"],$_POST["user_id"]);
    $rx_dni = UserData::getRepeatedDniEdit($_POST["user_dni"],$_POST["user_id"]);

    if (isset($r_username->username)){ $username = $r_username->username!="" ? $r_username->username : "null";}else{$username ='null';}
    if (isset($rx_dni->user_dni)){ $dni = $rx_dni->user_dni!="" ? $rx_dni->user_dni : "null";}else{$dni ='null';}
    if (isset($rx_email->email)){ $email = $rx_email->email!="" ? $rx_email->email : "null";}else{$email ='null';}

    if ($dni!="null"){
        $array = array(
            "err"  => 'null',
            "param"  => "User: ".$username." / DNI: ".$dni." / E: ".$email,
            "text"  => '¡AVISO! ya existe un número de documento igual. Por favor, intenta con otro o busca el usuario por su DNI para modificarlo'
        );
        $res = json_encode($array);
        echo $res;
    }

    // cuando existe username y correo
    else if($username!="null" && $email!="null"){
        $array = array(
            "err"  => 'null',
            "param"  => 'Ambos '.$username." / DNI: ".$dni." / E: ".$email,
            "text"  => '¡AVISO! ya existe un usuario y un correo igual. Por favor, intenta buscarlo para editar los datos'
        );
        $res = json_encode($array);
        echo $res;
    }

    else if($username!="null"){
        $array = array(
            "err"  => 'null',
            "param"  => "USER ".$username." / DNI: ".$dni." / E: ".$email,
            "text"  => '¡AVISO! ya existe un nombre de usuario igual. Por favor, intenta con otro o busca el usuario para modificarlo'
        );
        $res = json_encode($array);
        echo $res;
    }


    // cuando existe y el correo es obligatorio
    else if($email!="null"){
        $array = array(
            "err"  => 'null',
            "param"  => "EMAIL ".$username." / DNI: ".$dni." / E: ".$email,
            "text"  => '¡AVISO! el correo ya se encuentra asignado a un usuario. Por favor, intenta con otro o busca el usuario por su correo para modificarlo'
        );
        $res = json_encode($array);
        echo $res;

    }else {
        $array = array(
            "err"  => 'false',
            "text"  => 'No existe el usuario'
        );
        $res = json_encode($array);
        echo $res;
    }

}

?>
