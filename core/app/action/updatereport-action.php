






<!-- <div class="row">
<div class="col-md-10">
<h1><i class="fa fa-home"></i> Guardando reporte...</h1>
</div> -->

<?php
/**
* infocentro
* @author jarcelo
**/
// echo $_FILES['image']['name'];

// $temp = explode(".", $_FILES["file"]["name"]);
// $newfilename = round(microtime(true)) . '.' . end($temp);
// move_uploaded_file($_FILES["file"]["tmp_name"], "../img/imageDirectory/" . $newfilename);






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



        // imagen 1
        if( !empty($_FILES['image']['name']) ){
                
                $image = checkInput($_FILES["image"]["name"]);
                $imagePath  = 'uploads/images/reports/'. date('Y-m-d H:i:s') . '_' . basename($image);
                $imageExtension = pathinfo($imagePath,PATHINFO_EXTENSION);
    
                $destacada = $imagePath; #"images/".$_FILES['file']['name'];
                $nombre_origen = date('Y-m-d H:i:s').".".$imageExtension;
                // $newfilename = date('Y-m-d H:i:s') . '_' . $nombre_origen;
                // $images .= $nombre_origen.",";
                // echo $image;
                
                if($imageExtension != "jpg" && $imageExtension != "JPG" && $imageExtension != "png" && $imageExtension != "jpeg" && $imageExtension != "gif" ) 
                {
                    $imageError = "Los archivos permitidos son: .jpg, .JPG, .jpeg, .png, .gif";
                    $isUploadSuccess = false;
                    echo $imageError;
    
                }
                if(file_exists($imagePath)) 
                {
                    $imageError = "El archivo ya existe, puedes renombrarlo";
                    $isUploadSuccess = false;
                    echo $imageError;
    
                }
                if($_FILES["image"]["size"] > 1500000) 
                {
                    $imageError = "El archivo ".basename($image)." no debe exceder 5 MB de peso";
                    $isUploadSuccess = false;
                    echo $imageError;
                    Core::redir($_GET['location']."&swal=".$imageError);
                    // print "<script>window.location='index.php?view=users';</script>";
    
                }
                if($isUploadSuccess) 
                {
                    
                    // redimensionarImagen($_FILES["image"]["tmp_name"], $imagePath, 300, 350, 75);
    
                    // if($compressedImage){ 
                    //     $status = 'success'; 
                    //     $statusMsg = "La imagen se ha subido satisfactoriamente.";
                    //     echo $statusMsg;
    
    
    
                        if(!move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath)) 
                        {
                            $imageError = "Se ha producido un error al subir el archivo";
                            $isUploadSuccess = false;
                            echo $imageError;
                            
                        }else{
    
                            // crear preview
                            $destino_p="uploads/images/reports/"."preview_1_".$nombre_origen;
                            redimencionar($destacada, $destino_p, 300, 350, 100, $isUploadSuccess);
    
                            // Comprimir imagen
                            $destino_o="uploads/images/reports/"."origin_1_".$nombre_origen;
                            redimencionar($destacada, $destino_o, 800, 600, 100, $isUploadSuccess);
                            unlink($imagePath);
                            $images .= "origin_1_".$nombre_origen.", ";
                            echo $images;
                            
                        }
    
    
                }
            }
    
    
            if( !empty($_FILES['image2']['name']) ){
    
                // imagen 2
                $isUploadSuccess2 = true;
    
                $image2 = checkInput($_FILES["image2"]["name"]);
                $imagePath2  = 'uploads/images/reports/'. basename($image2);
                $imageExtension2 = pathinfo($imagePath2,PATHINFO_EXTENSION);
    
                if($imageExtension2 != "jpg" && $imageExtension2 != "JPG" && $imageExtension2 != "png" && $imageExtension2 != "jpeg" && $imageExtension2 != "gif" ) 
                {
                    $imageError = "Por favor verifica la IMAGEN 2, los archivos permitidos son: .jpg, .JPG, .jpeg, .png, .gif";
                    $isUploadSuccess2 = false;
                }
    
                if($isUploadSuccess2){
    
                    // $image2 = checkInput($_FILES["image2"]["name"]);
                    // $imagePath2  = 'uploads/images/reports/'. basename($image2);
                    $nombre_origen2 = date('Y-m-d H:i:s').".".$imageExtension2;
                    // move_uploaded_file($_FILES["image2"]["tmp_name"], "images/uploads/" . $newfilename2);
                    // $images .= $newfilename2.",";
    
                    if(!move_uploaded_file($_FILES["image2"]["tmp_name"], $imagePath2)) 
                    {
                        $imageError = "Se ha producido un error al subir el archivo";
                        $isUploadSuccess2 = false;
    
                    }else{
    
                        // Comprimir imagen
                        $destino2="uploads/images/reports/"."origin_2_".$nombre_origen2;
                        redimencionar($imagePath2, $destino2, 800, 600, 100, $isUploadSuccess2);
                        unlink($imagePath2);
                        $images .= "origin_2_".$nombre_origen2.", ";
                        // print($destino2);
    
    
                    }
                }
            }
    
    
            if( !empty($_FILES['image3']['name']) ){
    
                // imagen 2
                $isUploadSuccess3 = true;
    
                $image3 = checkInput($_FILES["image3"]["name"]);
                $imagePath3  = 'uploads/images/reports/'. basename($image3);
                $imageExtension3 = pathinfo($imagePath3,PATHINFO_EXTENSION);
    
                if($imageExtension3 != "jpg" && $imageExtension3 != "JPG" && $imageExtension3 != "png" && $imageExtension3 != "jpeg" && $imageExtension3 != "gif" ) 
                {
                    $imageError3 = "Por favor verifica la IMAGEN 3, los archivos permitidos son: .jpg, .JPG, .jpeg, .png, .gif";
                    $isUploadSuccess3 = false;
                    print($imageError3);
    
                }
    
                if($isUploadSuccess3){
    
                    // $image3 = checkInput($_FILES["image3"]["name"]);
                    // $imagePath3  = 'uploads/images/reports/'. basename($image3);
                    $nombre_origen3 = date('Y-m-d H:i:s').".".$imageExtension3;
                    // move_uploaded_file($_FILES["image3"]["tmp_name"], "images/uploads/" . $newfilename3);
                    // $images .= $newfilename3;
    
    
                    if(!move_uploaded_file($_FILES["image3"]["tmp_name"], $imagePath3)) 
                    {
                        $imageError3 = "Se ha producido un error al subir el archivo";
                        $isUploadSuccess3 = false;
                        print($imageError3);
    
                    }else{
    
                        // Comprimir imagen
                        $destino3="uploads/images/reports/"."origin_3_".$nombre_origen3;
                        redimencionar($imagePath3, $destino3, 800, 600, 100, $isUploadSuccess3);
                        unlink($imagePath3);
                        $images .= "origin_3_".$nombre_origen3;
                        // print($destino3);
    
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
    
    
    
    
    
    // $id_img = rand(1000,100);
    // $origen="images/imagen.jpg";
    // $destino="images/uploads/"."preview_".$nombre_origen;
    // $destino_temporal=tempnam("tmp/","tmp");
    


    // redimencionar($destacada, $destino, $destino_temporal, $isUploadSuccess);


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


















// $rx = ReportActivityData::getRepeated($_POST["cod"],$_POST["nombre"]);
// if($rx==null){



if ($images == ""){
    $images = "Sin registro fotográfico";
}

if(count($_POST)>0){
    $param = ReportActivityData::getById($_POST["id"]);
    
    if ($file_name == ""){
        $file_name = $param->file;
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



    $pag = $_GET["pag"];
    if ($pag == ""){
        $pag = "1";
    }

    $estado = $_POST["estado"];
    $participantes = $_POST["participantes"];
    $start_at = $_POST["start_at"];
    $finish_at = $_POST["finish_at"];

    // echo $param->activity_title;
    
    $param->code_info = strtoupper($_POST["code_info"]);
    $param->user_id = $_POST['user_id'];
    $param->line_action = $_POST["linea_accion"];
    $param->report_type = $_POST["report_type"];
    $param->activity_title = $_POST["nombre_act"];

    $param->developed_content = $_POST["contenido_des"];
    $param->training_modality = $_POST["modalidad_formacion"];
    $param->duration_days = $_POST["duracion_dias"];
    $param->duration_hour = $_POST["duracion_horas"];

    $param->responsible_name = $_POST["responsable_name"];
    $param->responsible_phone = $_POST["responsable_tel"];
    $param->responsible_type = $_POST["responsable_tipo"];
    $param->responsible_email = $_POST["responsible_email"];

    $param->date_pub = $_POST["fecha"];
    // $param->person_fe = $_POST["mujeres"];
    // $param->person_ma = $_POST["hombres"];
    $param->institutions = $_POST["instituciones"];
    $param->observations = $_POST["observacion"];
    $param->estate = $_POST["estado"];
    $param->municipality = $_POST["municipio"];
    $param->parish = $_POST["parroquia"];
    $param->city = $_POST["ciudad"];
    $param->address = $_POST["direccion"];

    // $param->file_name = $file_name;
    // $param->image = $images;

    $param->update();

}

// echo $file_name;

// echo $images;



// Core::alert("¡Reporte agregado con éxito!");
// }else{
// Core::alert("¡Error al guardar, ya existe un reporte con ese nombre y código!");
// }

// Core::alert("¡Actividad guardada exitosamente!");


// echo ("&estado=".$estado."&participantes=".$participantes."&start_at=".$start_at."&finish_at=".$finish_at."&pag=".$pag)
// Core::redir("./index.php?view=report&swal=Actividad actualizada");
print "<script>window.location='index.php?view=report&swal=Actividad actualizada"."&estado=&participantes=".$participantes."&start_at=".$start_at."&finish_at=".$finish_at."&pag=".$pag."';</script>";

?>
