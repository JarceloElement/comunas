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
// $edad = $fecha_actual-date("Y", strtotime($_POST["user_f_nacimiento"]));
// $fecha_servicio = date("Y,m,d", strtotime($_POST["user_fecha_servicio"]));



if($func_get == "add"){
    // $rx = ServicesUsersData::getRepeated($_POST["user_dni"]);
    // if($rx==null){
    $r = new SocialMapOrganizationsData();
    $r->user_id = $_POST["user_id"];
    $r->organization_id = $_POST["organization_id"];
    $r->code_info = $_POST["code_info"];
    $r->user_name_os = $_POST["user_name_os"];
    $res = $r->add();


}



if($func_get == "update"){
    if(count($_POST)>0){

        $r = SocialMapOrganizationsData::getById($_POST["id"]);
        $r->id = $_POST["id"];
        $r->organization_id = isset($_POST["organization_id"]) ? $_POST["organization_id"] : $r->organization_id;
        $r->organization_type = isset($_POST["organization_type"]) ? $_POST["organization_type"] : $r->organization_type;
        $r->organization_connection_type = isset($_POST["organization_connection_type"]) ? $_POST["organization_connection_type"] : $r->organization_connection_type;
        $r->organization_name = isset($_POST["organization_name"]) ? $_POST["organization_name"] : $r->organization_name;
        $r->organization_dni = isset($_POST["organization_dni"]) ? $_POST["organization_dni"] : $r->organization_dni;
        $r->organization_map_ubication = isset($_POST["organization_map_ubication"]) ? $_POST["organization_map_ubication"] : $r->organization_map_ubication;
        $r->organization_limit_area = isset($_POST["organization_limit_area"]) ? $_POST["organization_limit_area"] : $r->organization_limit_area;
        $r->organization_address = isset($_POST["organization_address"]) ? $_POST["organization_address"] : $r->organization_address;
        $r->organization_n_population = isset($_POST["organization_n_population"]) ? $_POST["organization_n_population"] : $r->organization_n_population;
        $r->organization_n_population_female = isset($_POST["organization_n_population_female"]) ? $_POST["organization_n_population_female"] : $r->organization_n_population_female;
        $r->organization_n_population_male = isset($_POST["organization_n_population_male"]) ? $_POST["organization_n_population_male"] : $r->organization_n_population_male;

        $r->update();
        return $error = "Guardado update";
    
    }else {
        Core::alert("No hay parámetros enviados para actualizar");
        
    }

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
            // $r = SocialMapOrganizationsData::getBySchool($_POST["code_info"],$_POST["school_id"]);
            $r = SocialMapOrganizationsData::getById($id);
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

    $param = SocialMapOrganizationsData::getById($_POST["id"]);
    $param->del();

    // Core::alert("Eliminado exitosamente!");
    // Core::redir("./index.php?view=final_users&swal=Registro borrado");
    // print "<script>window.location='index.php?view=facilitators';</script>";
    // print "<script>window.location='index.php?view=services&swal=Eliminado&user_estado=&start_at=".$start_at."&finish_at=".$finish_at."&pag=".$pag."';</script>";

}



?>
