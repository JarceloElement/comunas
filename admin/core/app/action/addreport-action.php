<div class="row">
<div class="col-md-10">
<h4><i class="fa fa-home"></i> Enviando reporte...</h4>
</div>

<?php
/**
* infocentro
* @author jarcelo
**/


// se asigna en cpanel
ini_set('max_execution_time', '3000');
set_time_limit(600);

date_default_timezone_set('UTC');
date_default_timezone_set("America/La_Paz");

// convierte los caracteres especiales
function checkInput($data) 
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$imageError = "";
$isUploadSuccess = true;
$finalimage = "";
$images = "";
$code_inf = strtoupper($_POST["code_info"]);
$dir_dest = "uploads/images/reports/";
$dir_pics = "uploads/images/reports/";
$log = '';

    // ---------- IMAGE UPLOAD ----------

$imagenes_up = [];
if( !empty($_FILES['image']['name']) ){
    $imagenes_up[] = $_FILES['image'];
}
if( !empty($_FILES['image2']['name']) ){
    $imagenes_up[] = $_FILES['image2'];
}
if( !empty($_FILES['image3']['name']) ){
    $imagenes_up[] = $_FILES['image3'];
}


// bucle de imagenes
// for ($i=0; $i<count($imagenes_up); $i++){

    $handle1 = new Upload($imagenes_up[0]);
    $handle2 = new Upload($imagenes_up[1]);
    $handle3 = new Upload($imagenes_up[2]);


    // 1 preview
    if (!empty($_FILES['image']['name'])) {

        $handle = $handle1;
        $count_imag = '1';
        echo '<div class="row"><div class="col-md-10"><h4>Subiendo imagen preview: '.$count_imag.'</h4></div>';

        $handle->dir_auto_create = true;
        $handle->dir_auto_chmod = true;

        // crear preview solo de la primera
        // if ($i == 0){
            $finalimage_prev = "preview_1_".$code_inf."_".date('Y-m-d-H-i-s');
            $handle->image_resize            = true;
            $handle->image_ratio_y           = true;
            $handle->image_x                 = 300;
            $handle->file_new_name_body      = $finalimage_prev;
            $handle->image_convert           = 'webp';
            // $handle->jpeg_quality            = 80;
            $handle->process($dir_dest);
            // almacena en la var las imagenes para la DB
            $images .= $finalimage_prev.'.'.$handle->file_dst_name_ext.', ';
            echo '<div class="row"><div class="col-md-10"><h4>'.$images.'</h4></div>';
            


        
        // Comprimir imagen principal
        $finalimage = "origin_".(1)."_".$code_inf."_".date('Y-m-d-H-i-s');
        $handle->image_resize            = true;
        $handle->image_ratio_y           = true;
        $handle->image_x                 = 800;
        $handle->file_new_name_body      = $finalimage;
        $handle->image_convert           = 'jpg';
        $handle->jpeg_quality            = 70;
        $handle->process($dir_dest);


        // almacena en la var las imagenes para la DB
        if (1 < count($imagenes_up)){
            $images .= $finalimage.'.'.$handle->file_dst_name_ext.", ";
        }else {
            $images .= $finalimage.'.'.$handle->file_dst_name_ext;
        }
        echo '<div class="row"><div class="col-md-10"><h4>'.$images.'</h4></div>';



        if ($handle->processed) {
            $isUploadSuccess = true;
            $imageError = "¡Imagen preview subida con éxito!.\n".$handle->error;
            echo '<div class="row"><div class="col-md-10"><h4>'.$imageError.'</h4></div>';
        }else {
            // $isUploadSuccess = false;
            $imageError = "¡Ups! No se pudo subir la imagen preview al servidor.\n".$handle->error;
            echo '<div class="row"><div class="col-md-10"><h4>'.$imageError.'</h4></div>';
        }

        // we delete the temporary files
        $handle-> clean();

    } else {
        // if we're here, the upload file failed for some reasons
        // i.e. the server didn't receive the file
        echo '<p class="result">';
        echo '  <b> No hay imagen 1 cargada.</b><br />';
        echo '  Error: ' . $handle->error . '';
        echo '</p>';
        $imageError = "¡Ups! No se pudo subir la imagen 1 al servidor.\n".$handle->error;
    }

    // $log .= $handle->log . '<br/>';



    // imagen 2
    if (!empty($_FILES['image2']['name'])) {
        
        $handle = $handle2;
        $count_imag = '2';
        echo '<div class="row"><div class="col-md-10"><h4>Subiendo imagen: '.$count_imag.'</h4></div>';

        $handle->dir_auto_create = true;
        $handle->dir_auto_chmod = true;

        // Comprimir imagen principal
        $finalimage = "origin_".(2)."_".$code_inf."_".date('Y-m-d-H-i-s');
        $handle->image_resize            = true;
        $handle->image_ratio_y           = true;
        $handle->image_x                 = 800;
        $handle->file_new_name_body      = $finalimage;
        $handle->image_convert           = 'jpg';
        $handle->jpeg_quality            = 70;
        $handle->process($dir_dest);


        // almacena en la var las imagenes para la DB
        if (2 < count($imagenes_up)){
            $images .= $finalimage.'.'.$handle->file_dst_name_ext.", ";
        }else {
            $images .= $finalimage.'.'.$handle->file_dst_name_ext;
        }
        echo '<div class="row"><div class="col-md-10"><h4>'.$images.'</h4></div>';

        if ($handle->processed) {
            $isUploadSuccess = true;
            $imageError = "¡Imagen 2 subida con éxito!.\n".$handle->error;
            echo '<div class="row"><div class="col-md-10"><h4>'.$imageError.'</h4></div>';
        }else {
            // $isUploadSuccess = false;
            $imageError = "¡Ups! No se pudo subir la imagen 2 al servidor.\n".$handle->error;
            echo '<div class="row"><div class="col-md-10"><h4>'.$imageError.'</h4></div>';
        }

        // we delete the temporary files
        $handle-> clean();

    } else {
        // if we're here, the upload file failed for some reasons
        // i.e. the server didn't receive the file
        echo '<p class="result">';
        echo '  <b> No hay imagen 2 cargada.</b><br />';
        echo '  Error: ' . $handle->error . '';
        echo '</p>';
        $imageError = "¡Ups! No se pudo subir la imagen 2 al servidor.\n".$handle->error;
    }

    // $log .= $handle->log . '<br/>';


    // imagen 3
    if (!empty($_FILES['image3']['name'])) {
        
        $handle = $handle3;
        $count_imag = '3';
        echo '<div class="row"><div class="col-md-10"><h4>Subiendo imagen: '.$count_imag.'</h4></div>';

        $handle->dir_auto_create = true;
        $handle->dir_auto_chmod = true;

        // Comprimir imagen principal
        $finalimage = "origin_".(3)."_".$code_inf."_".date('Y-m-d-H-i-s');
        $handle->image_resize            = true;
        $handle->image_ratio_y           = true;
        $handle->image_x                 = 800;
        $handle->file_new_name_body      = $finalimage;
        $handle->image_convert           = 'jpg';
        $handle->jpeg_quality            = 70;
        $handle->process($dir_dest);


        // almacena en la var las imagenes para la DB
        if (3 < count($imagenes_up)){
            $images .= $finalimage.'.'.$handle->file_dst_name_ext.", ";
        }else {
            $images .= $finalimage.'.'.$handle->file_dst_name_ext;
        }
        echo '<div class="row"><div class="col-md-10"><h4>'.$images.'</h4></div>';

        if ($handle->processed) {
            $isUploadSuccess = true;
            $imageError = "¡Imagen 3 subida con éxito!.\n".$handle->error;
            echo '<div class="row"><div class="col-md-10"><h4>'.$imageError.'</h4></div>';
        }else {
            // $isUploadSuccess = false;
            $imageError = "¡Ups! No se pudo subir la imagen 3 al servidor.\n".$handle->error;
            echo '<div class="row"><div class="col-md-10"><h4>'.$imageError.'</h4></div>';
        }

        // we delete the temporary files
        $handle-> clean();

    } else {
        // if we're here, the upload file failed for some reasons
        // i.e. the server didn't receive the file
        echo '<p class="result">';
        echo '  <b> No hay imagen 3 cargada.</b><br />';
        echo '  Error: ' . $handle->error . '';
        echo '</p>';
        $imageError = "¡Ups! No se pudo subir la imagen 3 al servidor.\n".$handle->error;
    }

    // $log .= $handle->log . '<br/>';
            


















// }

// echo $images;




if ( ( isset($_POST["code_info"]) && isset($_POST["estado"]) ) && ($_POST["code_info"] == "" || $_POST["estado"] == "") ){
    return Core::redir($_GET['location']."&ConfirmButton=true&swal=Por favor vuelve atrás y escribe el código del infocentro.");
}

if ($_POST["estado"] == ""){
    $db = Database::getCon();
    $statement_1 = $db->query('SELECT * FROM infocentros WHERE cod ='.'"'.trim($_POST["code_info"]).'"');

    if(isset($statement_1)){
        foreach ($statement_1 as $row){
            $estado  = $row['estado'];
            $municipio  = $row['municipio'];
            $parroquia  = $row['parroquia'];
            $ciudad  = $row['ciudad'];
            $direccion  = $_POST['direccion'];
        }
    }
}
else {
    $estado  = $_POST["estado"];
    $municipio  = $_POST['municipio'];
    $parroquia  = $_POST['parroquia'];
    $ciudad  = $_POST['ciudad'];
    $direccion  = $_POST['direccion'];
}



// echo $estado;
// $rx = ReportActivityData::getRepeated($_POST["cod"],$_POST["nombre"]);
// if($rx==null){




if ($isUploadSuccess == true ){

    if ($images == ""){
        $images = "Sin registro fotográfico";
    }

    $phone = $_POST["responsable_tel"];
    $dni = $_POST["responsible_dni"];
    $email = $_POST["responsible_email"];

    if ($_POST["responsable_tipo"] == "Facilitador"){
        $sql = "UPDATE facilitators SET phone_number=\"$phone\", email=\"$email\" WHERE document_number=\"$dni\" ";

    }
    if ($_POST["responsable_tipo"] == "Coordinador" || $_POST["responsable_tipo"] == "Jefe de Estado"){
        $sql = "UPDATE coordinators SET phone_number=\"$phone\", email=\"$email\" WHERE document_number=\"$dni\" ";

    }
    if ($_POST["responsable_tipo"] != "Facilitador" && $_POST["responsable_tipo"] != "Coordinador" && $_POST["responsable_tipo"] != "Jefe de Estado"){
        $sql = "UPDATE gerencias SET phone_number=\"$phone\", email=\"$email\" WHERE document_number=\"$dni\" ";

    }

    Executor::doit($sql);




    $param = new ReportActivityData();
    $param->location = $_GET['location'];
    $param->code_info = trim(strtoupper($_POST["code_info"]));
    $param->user_id = $_SESSION['user_id'];
    $param->line_action = $_POST["linea_accion"];
    $param->report_type = $_POST["tipo_reporte"];
    $param->activity_title = $_POST["nombre_act"];

    $param->developed_content = $_POST["contenido_des"];
    $param->training_modality = $_POST["modalidad_formacion"];
    $param->duration_days = $_POST["duracion_dias"];
    $param->duration_hour = $_POST["duracion_horas"];

    $param->responsible_name = $_POST["responsable_name"];
    $param->responsible_phone = $_POST["responsable_tel"];
    $param->responsible_type = $_POST["responsable_tipo"];
    $param->responsible_dni = $_POST["responsible_dni"];
    $param->responsible_email = $_POST["responsible_email"];
    $param->personal_type = $_POST["personal_type"];
    $param->date_pub = $_POST["fecha"];

    // atencion al usuario
    if ($_POST["tipo_reporte"] == "Atención al usuario"){
        $mujer = ServicesUsersData::getBySQL("SELECT * from services_users where user_id=".$_SESSION['user_id']." AND user_genero='Mujer' AND DATE(user_fecha_reg)="."'".$_POST["fecha"]."'"." order by id asc ");
        $hombre = ServicesUsersData::getBySQL("SELECT * from services_users where user_id=".$_SESSION['user_id']." AND user_genero='Hombre' AND DATE(user_fecha_reg)="."'".$_POST["fecha"]."'"." order by id asc ");
        $Total_mujeres = count($mujer);
        $Total_hombres = count($hombre);
        $param->person_fe = $Total_mujeres;
        $param->person_ma = $Total_hombres;
        // echo "Muejeres ".$Total_mujeres;
        // echo "Homabres ".$Total_hombres;
    
    }else {
        $param->person_fe = 0;
        $param->person_ma = 0;
    }

    $param->institutions = $_POST["instituciones"];
    $param->observations = $_POST["observacion"];
    $param->name_os = $_POST["name_os"];


    $param->estate = $estado;
    $param->municipality = $municipio;
    $param->parish = $parroquia;
    $param->city = $ciudad;
    $param->address = $direccion;
    $param->image = $images;
    // $param->file_name = $file_name;

    if($_POST["code_info"] != ""){
        $param->add();
        Core::redir("./index.php?view=report&swal=Registro creado");
    }else {
        return Core::alert("Error: NO code_info");
    }

} else {
    Core::redir($_GET['location']."&swal=".$imageError);
}

?>

