<?php
/**
* @author Jarcelo

**/
require 'assets/phpemail/Exception.php';
require 'assets/phpemail/PHPMailer.php';
require 'assets/phpemail/SMTP.php';


ini_set('max_execution_time', '300');

date_default_timezone_set('UTC');
date_default_timezone_set("America/La_Paz");

$get_email = UserData::getRepeatedEmail($_POST["email"]);
$get_user = UserData::getRepeatedUser($_POST["username"]);

if($get_email!=null){
	$_SESSION["alert"] = "El correo ya se encuentra registrado. Intenta iniciar sesión.";
	print "<script>window.location='index.php?view=signup&swal=1';</script>";
	// echo "correo existe";
	return;
}
if($get_user!=null){
	$_SESSION["alert"] = "Ya existe un usuario igual";
	print "<script>window.location='index.php?view=signup&swal=1';</script>";
	// echo "usuario existe";
	return;
}

if($get_email==null && $get_user==null){

	if(count($_POST)>0){
		// $is_admin=0;
		// if(isset($_POST["is_admin"])){$is_admin=1;}
		$is_organization=0;
		if(isset($_POST["is_organization"])){$is_organization=1;}
		$user = new UserData();
		$user->name = $_POST["name"];
		$user->lastname = $_POST["lastname"];
		$user->username = $_POST["username"];
		$user->email = $_POST["email"];
		$user->user_type = $_POST["user_type"];
		$user->gender = $_POST["gender"];
		$user->region = $_POST["region"];
		$user->code_info = $_POST["code_info"];
		$user->rol = $_POST["rol"];
		$user->is_organization=$is_organization;
		$user->organization_name = $_POST["organization_name"];
		$user->password = sha1(md5($_POST["password"]));
		$user->add();

		// Contenido del correo
		$asunto = 'Registro Infocentro';
		$name = $_POST["username"];
		$email = $_POST["email"];
		$message = "¡Urra!, te has registrado de manera exitosa en la Fundación Infocentro";

		$mail = new PHPMailer\PHPMailer\PHPMailer();
		$mail->SMTPDebug = 3;                      // Enable verbose debug output
		$mail->isSMTP();                           // Set mailer to use SMTP
		$mail->SMTPAuth   = true;                  // enable SMTP authentication
		$mail->SMTPSecure = "tls";                 // sets the prefix to the servier
		$mail->Host       = "smtp.gmail.com";     // sets GMAIL as the SMTP server
		$mail->Port       = 587;                   // set the SMTP port for the GMAIL server
		$mail->Username   = "jarcelo";           // GMAIL username
		$mail->Password   = "pqnqnpjmjjefjyvx";                              

		$mail->setFrom('jarcelo@gmail.com', 'Infocentro');
		// $mail->setFrom('infoapp@domain.com', 'Infocentro');
		$mail->addReplyTo('mariolysgonzalez@gmail.com', 'Infoapp | Nuevo usuario registrado');

		$mail->addAddress($email, $name);     // Add a recipient
		$mail->isHTML(true); // Set email format to HTML
		$mail->Subject = $asunto;
		$mail->Body = <<<EOT
		$message<br><br>
		<strong>Name:</strong> $name<br>
		<strong>Email:</strong> $email<br>
		Puedes ingresar desde aquí: infoapp.lanubedev.com<br>
		Visita La nube+: www.lanubeplus.com<br>
		EOT;

		if(!$mail->send() ) {
			echo 'Message could not be sent.';
			//echo 'Mailer Error: ' . $mail->ErrorInfo;
		} else {
			echo 'Message has been sent';
		}

		$_SESSION["alert"] = "Usuario creado con éxito, ya puedes iniciar sesión";
		// print "<script>window.location='index.php?logintype=registered&swal=1'</script>";
		print "<script>window.location='index.php?&swal=1';</script>";

	}
	
}else{
	$_SESSION["alert"] = "El usuario o correo ya se encuentra registrado.";
	// print "<script>window.location='index.php?logintype=signup&swal=1';</script>";
	print "<script>window.location='index.php?view=signup&swal=1';</script>";

}

?>
