<?php
	require_once "assets/phpemail/recaptchalib.php";

    if(isset($_POST['captchaResponse']) && !empty($_POST['captchaResponse'])):
        //your site secret key
        $secret = '6Ley_7EnAAAAADywQag5W8g06kK2jR7IUgRVUA_O';
        //get verify response data
        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['captchaResponse']);
        $responseData = json_decode($verifyResponse);
        if($responseData->success):
            //captacha validated successfully.
            // $email = !empty($_POST['email'])?$_POST['email']:'';
            // $password = !empty($_POST['password'])?$_POST['password']:'';
            // echo "captacha validated successfully.";
         	echo 1;
        else:
            echo 0;
        endif;
    else:
         echo -1;
    endif;

?>

