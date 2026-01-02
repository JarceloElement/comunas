<div class="row">
<div class="col-md-10">
<h1><i class="fa fa-home"></i> Enviando reporte...</h1>
</div>

<?php
/**
* infocentro
* @author jarcelo
**/
// ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
// ini_set('memory_limit','512M');

// $temp = explode(".", $_FILES["file"]["name"]);
// $newfilename = round(microtime(true)) . '.' . end($temp);
// move_uploaded_file($_FILES["file"]["tmp_name"], "../img/imageDirectory/" . $newfilename);


ini_set('max_execution_time', '300');



//  PRIMERA FORMA

    // $imgFile = $_FILES['image']['name'];
    // $tmp_dir = $_FILES['image']['tmp_name'];
    // $imgSize = $_FILES['image']['size'];

    // $upload_dir = 'images/'.$imgFile; // upload directory

    // $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension

    // // valid image extensions
    // $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions

    // // rename uploading image
    // $userpic = rand(1000,1000000).".".$imgExt;

    // // allow valid image file formats
    // if(in_array($imgExt, $valid_extensions)){   
    //     // Check file size '5MB'
    //     if($imgSize < 5000000)    {
    //         move_uploaded_file($tmp_dir,$upload_dir.$userpic);
    //     }
    //     else{
    //         $errMSG = "Sorry, your file is too large.";
    //     }
    // }
    // else{
    //     $errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";  
    // }













// SEGUNDA FORMA

    $file_name = "";
    $images = "";
    $imageError = "";
    $destacada = "";
    $nombre_origen = "";
    $isUploadSuccess = true;
    $isUploadSuccess2 = true;
    $isUploadSuccess3 = true;

    $code_inf = strtoupper($_POST["code_info"]);

    if(!empty($_POST)) 
    {

        // archivo adjunto
        if( !empty($_FILES['file']['name']) ){

            $file = $_FILES["file"]["name"];
            $file_name = date('Y-m-d H:i:s')."-".$file;
            // echo $file;
            $fileSize = $_FILES['file']['size'];

            if($fileSize < 5000000) // Check file size '5MB'
            {
                move_uploaded_file($_FILES["file"]["tmp_name"], 'uploads/files/' . date('Y-m-d H:i:s')."-".$file);
            }
            else{
                $errMSG = "Sorry, your file is too large.";
            }

        }



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
        for ($i=0; $i<count($imagenes_up); $i++){

            if( !empty($imagenes_up[$i]["name"]) ){
        
                $image = checkInput($imagenes_up[$i]["name"]);
                $imagePath  = 'uploads/images/reports/'. date('Y-m-d H:i:s') . '_' . basename($image);
                $imageExtension = pathinfo($imagePath,PATHINFO_EXTENSION);
    
                $destacada = $imagePath; #"images/".$_FILES['file']['name'];
                $nombre_origen = date('Y-m-d H:i:s').".".$imageExtension;
                
                if($imageExtension != "jpg" && $imageExtension != "JPG" && $imageExtension != "png" && $imageExtension != "jpeg" && $imageExtension != "gif" ) 
                {
                    $imageError = "Los archivos permitidos son: .jpg, .JPG, .jpeg, .png, .gif";
                    $isUploadSuccess = false;
                    return Core::redir($_GET['location']."&swal=Por favor verifica la IMAGEN ".($i+1).", los archivos permitidos son: .jpg, .JPG, .jpeg, .png, .gif");
    
                }
                if(file_exists($imagePath)) 
                {
                    $imageError = "El archivo ya existe, puedes renombrarlo";
                    $isUploadSuccess = false;
    
                }
                if($imagenes_up[$i]["size"] > 7000000) 
                {
                    $imageError = "El archivo no debe exceder 7 MB";
                    $isUploadSuccess = false;
                    echo '<script>alert("La imagen 1 no debe exeder 7 MB de peso");</script>';
                    return Core::redir($_GET['location']."&swal=La imagen ".($i+1)." no debe exeder 5 MB de peso");
    
                }
                if($isUploadSuccess) 
                {
                    // redimensionarImagen($_FILES["image"]["tmp_name"], $imagePath, 300, 350, 75);
    
                    // if($compressedImage){ 
                    //     $status = 'success'; 
                    //     $statusMsg = "La imagen se ha subido satisfactoriamente.";
                    //     echo $statusMsg;
    
                    if(!move_uploaded_file($imagenes_up[$i]["tmp_name"], $imagePath)) 
                    {
                        $imageError = "Se ha producido un error al subir el archivo";
                        $isUploadSuccess = false;
                        echo '<script>alert("Se ha producido un error al subir la imagen ");</script>';
                        return Core::redir($_GET['location']."&swal=Se ha producido un error al subir la imagen ".($i+1)."");
    
                        
                    }else{
    
                        // crear preview solo de la primera
                        if ($i == 0){
                            $destino_p="uploads/images/reports/"."preview_".($i+1)."_".$code_inf."_".$nombre_origen;
                            redimencionar($destacada, $destino_p, 300, 350, 100, $isUploadSuccess);
                        }
                        // Comprimir imagen
                        $destino_o="uploads/images/reports/"."origin_".($i+1)."_".$code_inf."_".$nombre_origen;
                        redimencionar($destacada, $destino_o, 800, 600, 100, $isUploadSuccess);
                        unlink($imagePath);

                        // almacena en la var las imagenes para la DB
                        if ($i < count($imagenes_up)-1){
                            $images .= "origin_".($i+1)."_".$code_inf."_".$nombre_origen.", ";
                        }else {
                            $images .= "origin_".($i+1)."_".$code_inf."_".$nombre_origen;
                        }
                        // echo $images;
                    }
                }
            }


        }


    }





    // convierte los caracteres especiales
    function checkInput($data) 
    {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }













//  TERCERA FORMA


    // $origen = "";
    // $nombre_origen = "";
    
    // if(isset($_POST['Enviar']) && !empty($_FILES['file']['name'])){
    
    
    //     if(move_uploaded_file($_FILES['file']['tmp_name'],"images/".$_FILES['file']['name'])){
    
    //         $origen = "images/".$_FILES['file']['name'];
    //         $nombre_origen = $_FILES['file']['name'];
    //         echo 'Archivo subido correctamente.';
    //     }
    //     // }else{
    
    //     //     echo 'No se pudo subir la imagen';
    
    //     // }
    
    // }
    



    function redimencionar($destacada, $destino, $ancho, $alto, $calidad, $isUploadSuccess){

        $destino_temporal=tempnam("tmp/","tmp");
        $destino_normal=$destino;

        if(redimensionarImagen($destacada, $destino_normal, $destino_temporal, $ancho, $alto, $calidad, $isUploadSuccess) and $isUploadSuccess == true)
        {
            // guardamos la imagen redimensionada
            $fp=fopen($destino,"w");
            fputs($fp,fread(fopen($destino_temporal,"r"),filesize($destino_temporal)));
            fclose($fp);
        
            # PREVIEW AL SUBIR
            // mostramos la imagen
            // echo "<img src='" . $destino . "'>";
        
        }else{
            // la imagen original es mas pequeña que el tamaño destino
            // echo "<img src='" . $origen . "'>";
        }
     
    }
    
    
    
    # CREAR PREVIEW
    /**
     * Funcion para redimensionar imagenes
     *
     * @param string $origin Imagen origen en el disco duro ($_FILES["image1"]["tmp_name"])
     * @param string $destino Imagen destino en el disco duro ($destino=tempnam("tmp/","tmp");)
     * @param integer $newWidth Anchura máxima de la nueva imagen
     * @param integer $newHeight Altura máxima de la nueva imagen
     * @param integer $jpgQuality (opcional) Calidad para la imagen jpg
     * @return boolean true = Se ha redimensionada|false = La imagen es mas pequeña que el nuevo tamaño
     */
    function redimensionarImagen($origin,$destino_normal,$destino,$newWidth,$newHeight,$jpgQuality, $isUploadSuccess )
    {

        if ($isUploadSuccess == true){
            // getimagesize devuelve un array con: anchura,altura,tipo,cadena de 
            // texto con el valor correcto height="yyy" width="xxx"
            $datos=getimagesize($origin);
        
            // comprobamos que la imagen sea superior a los tamaños de la nueva imagen
            if($datos[0]>$newWidth || $datos[1]>$newHeight)
            {
                // creamos una nueva imagen desde el original dependiendo del tipo
                if($datos[2]==1)
                    $img=imagecreatefromgif($origin);
                if($datos[2]==2)
                    $img=imagecreatefromjpeg($origin);
                if($datos[2]==3)
                    $img=imagecreatefrompng($origin);
        
                // Redimensionamos proporcionalmente
                if(rad2deg(atan($datos[0]/$datos[1]))>rad2deg(atan($newWidth/$newHeight)))
                {
                    $anchura=$newWidth;
                    $altura=round(($datos[1]*$newWidth)/$datos[0]);
                }else{
                    $altura=$newHeight;
                    $anchura=round(($datos[0]*$newHeight)/$datos[1]);
                }
        
                // creamos la imagen nueva
                $newImage = imagecreatetruecolor($anchura,$altura);
        
                // redimensiona la imagen original copiandola en la imagen
                imagecopyresampled($newImage, $img, 0, 0, 0, 0, $anchura, $altura, $datos[0], $datos[1]);
        
                // guardar la nueva imagen redimensionada donde indicia $destino
                if($datos[2]==1)
                    imagegif($newImage,$destino);
                if($datos[2]==2)
                    imagejpeg($newImage,$destino,$jpgQuality);
                if($datos[2]==3)
                    imagepng($newImage,$destino);
        
                // eliminamos la imagen temporal
                imagedestroy($newImage);
        
                return true;


            }else{

                // guardar la imagen normal si <= a la nueva imagen
                rename($origin, $destino_normal);
                // print($origin);
                // print($destino_normal);
            }
            return false;
        }
    }






    if ( ( isset($_POST["code_info"]) && isset($_POST["estado"]) ) && ($_POST["code_info"] == "" || $_POST["estado"] == "") ){
        return Core::redir($_GET['location']."&ConfirmButton=true&swal=Por favor vuelve atrás y escribe el código del infocentro.");
    }

    if ($_POST["estado"] == ""){
        $db = Database::getCon();
        $statement_1 = $db->query('SELECT * FROM infocentros WHERE cod ='.'"'.$_POST["code_info"].'"');

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
    $param->code_info = strtoupper($_POST["code_info"]);
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
        $mujer = ServicesUsersData::getBySQL("SELECT * from services_users where user_id=".$_SESSION['user_id']." AND user_genero='Mujer' AND DATE(user_fecha_reg)="."'".$date_pub."'"." order by id asc ");
        $hombre = ServicesUsersData::getBySQL("SELECT * from services_users where user_id=".$_SESSION['user_id']." AND user_genero='Hombre' AND DATE(user_fecha_reg)="."'".$date_pub."'"." order by id asc ");
        $Total_mujeres = count($mujer);
        $Total_hombres = count($hombre);
        $param->person_fe = $Total_mujeres;
        $param->person_ma = $Total_hombres;
    
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
    $param->file_name = $file_name;

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

