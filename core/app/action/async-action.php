<?php
/**
* InfoApp
* @author Jarcelo
**/

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, x-requested-with");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE");
header("Allow: POST, GET, OPTIONS, DELETE");


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
    $r = new SocialMapData();
    $r->user_id = $_POST["user_id"];
    $r->user_type = $_POST["user_type"];
    $r->info_state = $_SESSION["user_region"];
    $r->code_info = $_POST["code_info"];
    $r->responsability_email = $_POST["user_email"];
    $r->user_name_os = $_POST["user_name_os"] != "" ? $_POST["user_name_os"] : "unknown-ln";
    $r->progress = "10";
    $r->progress_percent = 0;
    $r->add();

    Core::redir("./index.php?view=socialmap");
    $message = "Registro creado";
	$_SESSION["alert"] = $message;
    // return $message;

}


// 
if($func_get == "updatefield"){
    if(count($_POST)>0){
        $field = $_POST["field"];

        // echo '--'.$_POST["field"];
        

        if (is_array($_POST["data"])){
            $data=implode(",",$_POST['data']);
        }else {
            $data = $_POST["data"];
        }

        $r = SocialMapData::getById($_POST["id"]);

        $total_field = [];
        $total_progress = [];
        foreach($r as $user){
            $total_field[] = $user;
            if ($user != ""){
                $total_progress[] = $user;
            }
        }

        if ($data != "") {
            $campos_listos = count($total_progress)+1;
        }else if ($data == "") {
            $campos_listos = count($total_progress)-1;
        }




        // $progress = $r->progress;
        // // si no hay datos en progress hace un array | de lo contrario crea un array desde el string
        // if ($progress == ""){
        //     $progress = Array();
        // }else{
        //     $progress = explode(",",$progress);
        // };
        
        // $campos_listos = count($progress);

        // // si el campo no esta en el array de progress lo agrega | luego convierte el array en cadena
        // if (!in_array($field, $progress) && $data != "") {
        //     array_unshift($progress , $field);
        //     // cuenta el total de campos listos luego de agregar el nuevo antes de convertirlo en cadena
        //     $campos_listos = count($progress);
        //     $progress = implode(",",$progress);
        // }else {
        //     // si el campo esta vacio lo buscamos en la lista del progreso y lo borramos
        //     if (in_array($field, $progress) && $data == "") {
        //         // buscar el field en el array
        //         if (($clave = array_search($field, $progress)) !== false) {
        //             unset($progress[$clave]);
        //         }
        //     }
        //     $campos_listos = count($progress);
        //     $progress = implode(",",$progress);
        // }



        $progress_total = round($campos_listos*100/count($total_field));
        if ($progress_total > 100){
            $progress_total = 100;
        }
        if ($campos_listos > count($total_field) ){
            $campos_listos = count($total_field);
        }

        $r->id = $_POST["id"];
        $r->progress = $campos_listos;
        $r->progress_percent = $progress_total;
        $r->$field = $data;
        $r->update();

        $array = array(
            "id"  => $_POST["id"],
            "field"  => $_POST["field"],
            "progress"  => $progress_total
        );

        $res = json_encode($array);
        echo $res;
        // echo "Listo";

    }else {
        $array = array(
            "id"  => 'No hay parametros en php'
        );

        $res = json_encode($array);
        echo $res;
        // echo "Error desde php";
    }

}


// updatefield_axios
if($func_get == "updatefield_axios"){

    $json = file_get_contents("php://input");
    $_POST_x = json_decode($json);

    if(count($_POST_x)>0){


        $field = $_POST_x->field;
        
        if (is_array($_POST_x->data)){
            $data=implode(",",$_POST_x->data);
        }else {
            $data = $_POST_x->data;
        }

            $r = SocialMapData::getById($_POST_x->id);

            $progress = $r->progress;
            // si no hay datos en progress hace un array | de lo contrario crea un array desde el string
            if ($progress == ""){
                $progress = Array();
            }else{
                $progress = explode(",",$progress);
            };
            
            
            
            $campos_listos = count($progress);

            // si el campo no esta en el array de progress lo agrega | luego convierte el array en cadena
            if (!in_array($field, $progress) && $data != "") {
                array_unshift($progress , $field);
                // cuenta el total de campos listos luego de agregar el nuevo antes de convertirlo en cadena
                $campos_listos = count($progress);
                $progress = implode(",",$progress);
            }else {
                // si el campo esta vacio lo buscamos en la lista del progreso y lo borramos
                if (in_array($field, $progress) && $data == "") {
                    // buscar el field en el array
                    if (($clave = array_search($field, $progress)) !== false) {
                        unset($progress[$clave]);
                    }
                }
                $campos_listos = count($progress);
                $progress = implode(",",$progress);
            }

            // FALTA OBTENER EL TOTAL DE FIELD EN $r PARA CALCULAR EL %
            $progress_total = round($campos_listos*100/59);

            $r->id = $_POST_x->id;
            $r->progress = $progress;
            $r->progress_percent = $progress_total;
            $r->$field = $data;
            $r->update();

            $array = array(
                "id"  => $_POST_x->id,
                "field"  => $_POST_x->field,
                "progress"  => $progress
            );

            $res = json_encode($array);
            echo $res;
            // echo "Listo";

    }else {
        $array = array(
            "id"  => 'No hay parametros en php'
        );

        $res = json_encode($array);
        echo $res;
        // echo "Error dese php";

        
    }


}




if($func_get == "delete"){
    if (!isset( $_GET['id'])) {
        Core::alert("Error: Falta el id a eliminar");
        return;
    }
    $estado = $_GET["user_estado"];
    $start_at = $_GET["start_at"];
    $finish_at = $_GET["finish_at"];

    $param = SocialMapData::getById($_GET["id"]);
    $param->del();

    // Core::alert("Eliminado exitosamente!");
    // Core::redir("./index.php?view=final_users&swal=Registro borrado");
    // print "<script>window.location='index.php?view=facilitators';</script>";
    print "<script>window.location='index.php?view=services&swal=Eliminado&user_estado=&start_at=".$start_at."&finish_at=".$finish_at."&pag=".$pag."';</script>";

}



?>
