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
    $r = new SocialMapStudentsData();
    $r->user_id = $_POST["user_id"];
    $r->school_id = $_POST["school_id"];
    $r->code_info = $_POST["code_info"];
    $r->user_name_os = $_POST["user_name_os"];
    $res = $r->add();


}



if($func_get == "update"){
    if(count($_POST)>0){

        $r = SocialMapStudentsData::getById($_POST["id"]);
        $r->id = $_POST["id"];
        $r->school_name = isset($_POST["school_name"]) ? $_POST["school_name"] : $r->school_name;
        $r->school_address = isset($_POST["school_address"]) ? $_POST["school_address"] : $r->school_address;
        $r->dea_code = isset($_POST["dea_code"]) ? $_POST["dea_code"] : $r->dea_code;
        $r->school_type = isset($_POST["school_type"]) ? $_POST["school_type"] : $r->school_type;
        $r->school_n_students = isset($_POST["school_n_students"]) ? $_POST["school_n_students"] : $r->school_n_students;
        $r->school_n_students_female = isset($_POST["school_n_students_female"]) ? $_POST["school_n_students_female"] : $r->school_n_students_female;
        $r->school_n_students_male = isset($_POST["school_n_students_male"]) ? $_POST["school_n_students_male"] : $r->school_n_students_male;

        $r->update();
    
    }else {
        Core::alert("No hay parámetros enviados para actualizar");
        
    }
    Core::redir("./index.php?view=final_users&swal=Registro actualizado");

}




// 
if($func_get == "updatefield"){
    if(count($_POST)>0){
        $field = $_POST["field"];
        $id = $_POST["id"];

        if (is_array($_POST["data"])){
            $data=implode(",",$_POST['data']);
        }else {
            $data = $_POST["data"];
        }
            // $r = SocialMapStudentsData::getBySchool($_POST["code_info"],$_POST["school_id"]);
            $r = SocialMapStudentsData::getById($id);
            $r->id = $id;
            $r->$field = $data;
            $r->update();
            return $error = "Guardado";

    }else {
        Core::alert("No hay parámetros enviados para actualizar");
        
    }

}




if($func_get == "delete"){
    if (!isset( $_POST['id'])) {
        Core::alert("Error: Falta el id a eliminar");
        return;
    }

    $param = SocialMapStudentsData::getById($_POST["id"]);
    $param->del();

    // Core::alert("Eliminado exitosamente!");
    // Core::redir("./index.php?view=final_users&swal=Registro borrado");
    // print "<script>window.location='index.php?view=facilitators';</script>";
    // print "<script>window.location='index.php?view=services&swal=Eliminado&user_estado=&start_at=".$start_at."&finish_at=".$finish_at."&pag=".$pag."';</script>";

}



?>
