<?php
/**
* @author Jarcelo
* @brief 
**/
// include('node_modules/upload/src/class.upload.php'); Esta en autoload.php

$dir_dest = "storage/images/";
$dir_pics = "storage/images/";
$log = '';

    // ---------- IMAGE UPLOAD ----------


    $handle = new Upload($_FILES['image_field']);
    if ($handle->uploaded) {

        // yes, the file is on the server
        // below are some example settings which can be used if the uploaded file is an image.
        $handle->image_resize            = true;
        $handle->image_ratio_y           = true;
        $handle->image_x                 = 400;
        // $handle->image_ratio_x = true;
        // $handle->image_y = 200;
        $handle->file_new_name_body = 'render';

        // $handle->image_min_width = 1000;
        // $handle->image_min_height = 500;

        $handle->image_convert = 'jpg';
        $handle->jpeg_quality = 100;
        // $handle->file_force_extension = true;
        
        // $handle->image_convert = 'webp';
        // $handle->webp_quality = 10;

        // $handle->file_new_name_ext = 'txt';
        // $handle->file_overwrite = true;

        // $handle->image_pixelate = 5;

        // $handle->image_unsharp = true;
        // $handle->image_unsharp_amount = 200;
        
        // $handle->image_text = 'Demo';
        // $handle->image_text_y = -5;

        // $handle->image_crop = array("20%",40,30,20);



        // now, we start the upload 'process'. That is, to copy the uploaded file
        $handle->dir_auto_create = true;
        $handle->dir_auto_chmod = true;
        $handle->process($dir_dest);

        // we check if everything went OK
        if ($handle->processed) {
            // everything was fine !
            echo '<p class="result">';
            echo '  <b>File uploaded with success</b><br />';
            echo '  <img src="'.$dir_pics.'/' . $handle->file_dst_name . '" />';
            $info = getimagesize($handle->file_dst_pathname);
            echo '  File: <a href="'.$dir_pics.'/' . $handle->file_dst_name . '">' . $handle->file_dst_name . '</a><br/>';
            echo '   (' . $info['mime'] . ' - ' . $info[0] . ' x ' . $info[1] .' -  ' . round(filesize($handle->file_dst_pathname)/256)/4 . 'KB)';
            echo '</p>';
        } else {
            // one error occured
            echo '<p class="result">';
            echo '  <b>File not uploaded to the wanted location</b><br />';
            echo '  Error: ' . $handle->error . '';
            echo '</p>';
        }


        // we delete the temporary files
        $handle-> clean();

    } else {
        // if we're here, the upload file failed for some reasons
        // i.e. the server didn't receive the file
        echo '<p class="result">';
        echo '  <b>File not uploaded on the server</b><br />';
        echo '  Error: ' . $handle->error . '';
        echo '</p>';
    }

    $log .= $handle->log . '<br />';
		// Core::redir("./?view=edituser&id=".$_POST["id"]);





    // ---------- MULTIPLE UPLOADS ----------

    // // as it is multiple uploads, we will parse the $_FILES array to reorganize it into $files
    // $files = array();
    // foreach ($_FILES['my_field'] as $k => $l) {
    //     foreach ($l as $i => $v) {
    //         if (!array_key_exists($i, $files))
    //             $files[$i] = array();
    //         $files[$i][$k] = $v;
    //     }
    // }

    // // now we can loop through $files, and feed each element to the class
    // foreach ($files as $file) {

    //     // we instanciate the class for each element of $file
    //     $handle = new Upload($file);

    //     // then we check if the file has been uploaded properly
    //     // in its *temporary* location in the server (often, it is /tmp)
    //     if ($handle->uploaded) {

    //         // now, we start the upload 'process'. That is, to copy the uploaded file
    //         // from its temporary location to the wanted location
    //         // It could be something like $handle->process('/home/www/my_uploads/');
    //         $handle->process($dir_dest);

    //         // we check if everything went OK
    //         if ($handle->processed) {
    //             // everything was fine !
    //             echo '<p class="result">';
    //             echo '  <b>File uploaded with success</b><br />';
    //             echo '  File: <a href="'.$dir_pics.'/' . $handle->file_dst_name . '">' . $handle->file_dst_name . '</a>';
    //             echo '   (' . round(filesize($handle->file_dst_pathname)/256)/4 . 'KB)';
    //             echo '</p>';
    //         } else {
    //             // one error occured
    //             echo '<p class="result">';
    //             echo '  <b>File not uploaded to the wanted location</b><br />';
    //             echo '  Error: ' . $handle->error . '';
    //             echo '</p>';
    //         }

    //     } else {
    //         // if we're here, the upload file failed for some reasons
    //         // i.e. the server didn't receive the file
    //         echo '<p class="result">';
    //         echo '  <b>File not uploaded on the server</b><br />';
    //         echo '  Error: ' . $handle->error . '';
    //         echo '</p>';
    //     }

    //     $log .= $handle->log . '<br />';
    // }


?>