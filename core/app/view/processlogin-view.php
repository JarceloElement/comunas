<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// from laptop - 10/06/2024

// session_start();

// require 'assets/phpemail/Exception.php';
// require 'assets/phpemail/PHPMailer.php';
// require 'assets/phpemail/SMTP.php';
// require_once "assets/phpemail/recaptchalib.php";

// spinner
echo '<br><br><br><div class="d-flex justify-content-center">
	<div class="spinner-border text-primary" role="status">
	<span class="sr-only">Loading...</span>
	</div>
</div>';
// $conn = DatabasePg::connectPg();
// $row_table = $conn->prepare("SELECT * from user_session where user_id='8'");
// $row_table->execute();
// $sessions = $row_table->fetchAll(PDO::FETCH_ASSOC);
// print_r($sessions);

// $myfile = fopen("uploads/usuarios.dat", "w") or die("Unable to open file!");

// $tiempo_logout = 600; // segundos tras los cuales un usuario es marcado como inactivo
// $ip = $_SERVER['REMOTE_ADDR'];

// $arr = file("uploads/usuarios.dat");
// $contenido = $ip . ":" . time() . " ";

// for ($i = 0; $i < sizeof($arr); $i++) {
// 	$tmp = explode(":", $arr[$i]);
// 	if (($tmp[0] != $ip) && ((time() - $tmp[1]) < $tiempo_logout)) {
// 		$contenido .= $ip . ":" . time() . " ";
// 	}
// }

// $fp = fopen("uploads/usuarios.dat", "w");
// fputs($fp, $contenido);
// fclose($fp);

// $array = file("uploads/usuarios.dat");

// $USUARIOS_ACTIVOS = count($array);
// echo "Hay " . $USUARIOS_ACTIVOS . " usuarios activos";





$secret = "6Ley_7EnAAAAADywQag5W8g06kK2jR7IUgRVUA_O";
$response = null;

// Verificamos la clave secreta
// $reCaptcha = new ReCaptcha($secret);
// if ($_POST["g-recaptcha-response"]) {
//   $response = $reCaptcha->verifyResponse($_SERVER["REMOTE_ADDR"],$_POST["g-recaptcha-response"]);
//  }

// if ($response != null && $response->success) {
//    // Añade aquí el código que desees en el caso de que la validación sea correcta
// //    echo "recaptcha correcta";
// //    return;
//  } else {
//    // Añade aquí el código que desees en el caso de que la validación no sea correcta o muestra
// //    echo "recaptcha NO";
//    $message = 'Por favor asegúrate de validar el capcha de "no soy un robot" ';
// 	print "<script>window.location='index.php?&swal=1';</script>";
// 	$_SESSION["alert"] = $message;
// 	// return;
// }

// $sql = "SELECT * from final_users where (user_dni = '22690237') ";
// $usuario_final = ExecutorPg::get($sql)[0][0];
// print_r($usuario_final);

// si el usuario no esta logueado
if (Session::getUID() == "") {
	$usermail = $_POST['email'];
	$pass = sha1(md5($_POST['password']));
	$found_pass = true;
	$found_user = false;
	$found = false;


	// $ROOT = $_SERVER["DOCUMENT_ROOT"];
	// include($ROOT . "/infoapp/core/controller/Database.php");

	// include('../../controller/DatabasePg.php');

	$base = new Database();
	$con = $base->connect();
	$sql_pass = "SELECT * from user where (username=\"$usermail\") and is_active=1";
	// $query_all = $con->query("SELECT * FROM user a INNER JOIN estados b ON a.estate=b.estado WHERE b.estado='".$row['estado']."' ");




	$query_pass = $con->query($sql_pass);

	// si el usuario existe compara las claves
	while ($r = $query_pass->fetch_array()) {
		$found_user = true;
		if ($r['password'] != $pass) {
			$found_pass = false;
		} else {
			$found = true;
			$_SESSION['session_id'] = session_id();
			$_SESSION['user_id'] = $r['id'];
			$_SESSION['user_dni'] = $r['user_dni'];
			$_SESSION['user_username'] = $r['username'];
			$_SESSION['user_type'] = $r['user_type'];
			$_SESSION['user_email'] = $r['email'];
			$_SESSION['user_name'] = $r['name'];
			$_SESSION['user_nombres'] = $r['name'];
			$_SESSION['user_region'] = $r['region'];
			$_SESSION['user_code_info'] = $r['code_info'];
			$_SESSION['user_rol'] = $r['rol'];
			$_SESSION['is_organization'] = $r['is_organization'];
			$_SESSION['organization_name'] = $r['organization_name'];
		}
	}

	if ($found_user == false) {
		$_SESSION["alert"] = "El usuario o correo no existen.";
		print "<script>window.location='index.php?&swal=1';</script>";
		return;
	}

	if ($found_pass == false) {
		$_SESSION["alert"] = "La clave es incorrecta. Por favor revisa tus datos.";
		print "<script>window.location='index.php?&swal=1';</script>";
		return;
	}



	if ($found == true) {
		$user_id = $_SESSION['user_id'];
		$session_id = $_SESSION['session_id'];
		$user_username = $_SESSION['user_username'];
		$session_region = $_SESSION['user_region'];
		$ip = $_SERVER['REMOTE_ADDR'];
		$_SESSION["alert"] = "";

		// guarda la session
		$conn = DatabasePg::connectPg();
		$row_table = $conn->prepare("SELECT * from user_session where user_id='$user_id'");
		$row_table->execute();
		$sessions = $row_table->fetchAll(PDO::FETCH_ASSOC);
		// print_r($sessions[0]);
		// return;
		// print "<script>sessionStorage.setItem('usersession', '$user_id');</script>";
		print "<script>localStorage.setItem('usersession', '$user_id');</script>";

		if (count($sessions) > 0) {
			$sql = "UPDATE user_session set active=1, ip='$ip', session_id='$session_id' where user_id=$user_id";
			$row_table = $conn->prepare($sql);
			$row_table->execute();
			// $sessions = $row_table->fetchAll(PDO::FETCH_ASSOC);
		} else {
			$sql = "INSERT into user_session (user_id, session_id, user_name, ip, active, region) values ($user_id, '$session_id', '$user_username', '$ip', 1, '$session_region')";
			$row_table = $conn->prepare($sql);
			$row_table->execute();
		}

		// carga las sessiones activas
		$sql = "SELECT * from user_session where active=1";
		$row_table = $conn->prepare($sql);
		$row_table->execute();
		$sessions = $row_table->fetchAll(PDO::FETCH_ASSOC);
		$_SESSION['active_session'] = count($sessions);



		// envia a edicion de usuario
		if ($_SESSION['user_dni'] == "") {
			$_SESSION["alert"] = "Por favor actualiza tu documento de identidad antes de actualizar el perfil, lugo vuelve a iniciar sesión";
			print "<script>window.location='admin/index.php?view=edituser&swal=1&id=$user_id';</script>";
		}


		// tipo de personal
		$user_code_info = $_SESSION['user_code_info'];
		$conn = DatabasePg::connectPg();
		$row_table = $conn->prepare("SELECT cod_gerencia from infocentros where cod = '$user_code_info' ");
		$row_table->execute();
		$es_gerente = $row_table->fetchAll(PDO::FETCH_ASSOC);


		if (count($es_gerente) > 0) {
			foreach ($es_gerente as $name) :
				$cod_gerencia = $name["cod_gerencia"];
			endforeach;
		} else {
			$cod_gerencia = -1;
		}
		$_SESSION["user_cod_gerencia"] = $cod_gerencia;


		//  verificar si el usuario existe en usuarios finales
		$usuario_final = array([0]);
		$user_dni = $_SESSION['user_dni'];
		$user_rol = $_SESSION['user_rol'];
		$user_correo = $_SESSION['user_email'];
		$user_email = "";
		$user_genero = "";
		$user_nombres = "";
		$user_f_nacimiento = "";

		if ($user_dni != "" && $user_dni != "No cedulado") {

			$sql = "SELECT * from final_users where (user_dni = '$user_dni') ";
			$usuario_final = FinalUsersData::getByFinalUser($_SESSION['user_dni'], $_SESSION['user_id'], $_SESSION['user_email']);

			// print_r($usuario_final);
			// return;
		}

		// Verifica si el usuario final existe y lo envia al dashboard, sino al userform de registro
		if ($usuario_final != "null") {
			$user_dni_uf = $usuario_final->user_dni;
			$user_email = $usuario_final->user_correo;
			$user_genero = $usuario_final->user_genero;
			$user_nombres = $usuario_final->user_nombres;
			$user_f_nacimiento = $usuario_final->user_f_nacimiento;
			$profile_image = $usuario_final->profile_image;
		} else {
			$_SESSION["alert"] = "Registro de perfil";
			print "<script>window.location='index.php?view=userform_new&new=0&swal=1';</script>";
		}

		if (($user_correo == $user_email && isset($user_email)) || (isset($user_dni_uf) && $user_dni == $user_dni_uf)) {

			// ingresa user_id en los datos del usuario final
			$user_id = $_SESSION['user_id'];

			$sql = "UPDATE final_users	set user_id = ?, user_type = ?  where user_dni = ?;";
			$values = [(int)$user_id, $user_rol, (int)$user_dni];
			ExecutorPg::update($sql, $values);


			if ($_SESSION['user_name'] != "") {
				$_SESSION["user_nombres"] = $_SESSION['user_name'];
			} else if ($user_nombres != "") {
				$_SESSION["user_nombres"] = $user_nombres;
			} else {
				$_SESSION["user_nombres"] = "Visitante";
			}

			$_SESSION["profile_image"] = $profile_image;
			$_SESSION["user_genero"] = $user_genero;
			$_SESSION["user_f_nacimiento"] = $user_f_nacimiento;
			$_SESSION["user_cod_gerencia"] = $cod_gerencia;
			print "<script>window.location='index.php?view=dashboard';</script>";
		} else {
			$_SESSION["alert"] = "Por favor completa tus datos de perfil";
			print "<script>window.location='index.php?view=userform_update';</script>";
		}
	} else {
		$message = "Los datos de acceso no son correctos";
		$_SESSION["alert"] = $message;
		print "<script>window.location='index.php?&swal=1';</script>";
	}
} else {
	// si el usuario esta logueado
	// print "<script>window.location='index.php';</script>";

}


















?>


<script>
	// localStorage.setItem("Nombre", "AnaWWW");
	// sessionStorage.setItem("Nombre", "TTTTTT");
</script>

<!-- 
SELECT * FROM `final_users` where user_dni=28843693
UPDATE `final_users` SET `user_dni` = '', `user_correo` = '', `user_type` = '' WHERE `final_users`.`user_dni` = 28843693 AND `id` != '53942'; 














select user_id,user_dni, count(user_dni),user_nombres,user_correo,user_estado from final_users group by user_dni having count(user_dni) > 1 and user_dni!='';





SELECT 
	facilitators.info_cod, 
	facilitators.estate, 
	facilitators.status_nom, 
	facilitators.personal_type, 
	facilitators.name, 
	facilitators.lastname, 
	facilitators.document_number, 
	facilitators.phone_number, 
	facilitators.gender, 
	facilitators.email, 
	final_users.red_x, 
	final_users.red_facebook, 
	final_users.red_instagram, 
	final_users.red_linkedin, 
	final_users.red_youtube, 
	final_users.red_tiktok, 
	final_users.red_whatsapp, 
	final_users.red_telegram, 
	final_users.red_snapchat, 
	final_users.red_pinterest from facilitators INNER JOIN final_users ON CAST(final_users.user_dni AS UNSIGNED) = CAST(facilitators.document_number AS UNSIGNED) where facilitators.estate='Lara' and (final_users.red_x!='' or final_users.red_facebook!='' or final_users.red_instagram!='' or final_users.red_linkedin!='' or final_users.red_youtube!='' or final_users.red_tiktok!='' or final_users.red_whatsapp!='' or final_users.red_telegram!='' or final_users.red_snapchat!='') GROUP BY facilitators.document_number order by facilitators.estate desc







DELETE FROM `products_list` where date_reg < '2023-10-30 00:00:00';


update reports r, infocentros i set r.info_id = i.id where (r.code_info = i.cod or r.code_info = i.region_tipo) and (r.code_info IS NULL);

update products_list r, infocentros i set r.info_id = i.id where r.code_info = i.cod and (r.code_info IS NULL);
update products_list r, infocentros i set r.info_id = i.id where (r.code_info = i.cod or r.code_info = i.region_tipo);

update participants_list r, infocentros i set r.info_id = i.id where r.code_info = i.cod;
update participants_list r, infocentros i set r.info_id = i.id where (r.code_info = i.cod or r.code_info = i.region_tipo);

update services_users r, infocentros i set r.info_id = i.id where r.user_info_cod = i.cod;
update services_users r, infocentros i set r.info_id = i.id where (r.user_info_cod = i.cod or r.user_info_cod = i.region_tipo);


update services_users r, final_users i set r.user_comunity_type = i.user_comunity_type, r.user_pertenece_organizacion = i.user_pertenece_organizacion where r.user_dni = i.user_dni;
update participants_list r, final_users i set r.user_comunity_type = i.user_comunity_type, r.user_pertenece_organizacion = i.user_pertenece_organizacion where r.document_id = i.user_dni;



https://www.infoapp.lanubedev.com/admin/index.php?view=participants&q=&code_info=&user_id=&estado=&linea_accion=&start_at=2024-05-27&finish_at=2024-05-27&swal=&pag=2



 Fatal error: Allowed memory size of 629145600 bytes exhausted (tried to allocate 20480 bytes) in /home/lanubede/public_html/infoapp.lanubedev.com/admin/core/controller/Model.php on line 32










POSGRESQL DOC | NO PHP

// Remove the longest string containing only characters from characters (a space by default) from the end of string
rtrim('trimxxxx', 'x') = trim

// Return first n characters in the string. When n is negative, return all but last |n| characters.
left('abcde', 2) = ab

// Split string on delimiter and return the given field (counting from one)
split_part('abc~@~def~@~ghi', '~@~', 2) = DEF

// null si la cadena esta vacia, de lo contrario es entero la salida 
NULLIF(your_value, '')::int

// convierte una cadena a entero
('5')::int

 
// ACTUALIZAR DESDE LA TERMINAL DE PGADMIN
update info_app.services_users set info_id = (SELECT id FROM info_app.infocentros where services_users.user_info_cod = infocentros.cod) where services_users.info_id=0;

// server
UPDATE "public"."reports" SET "estate"=(SELECT "estado" FROM "public"."infocentros" where "reports"."info_id"="infocentros"."id") WHERE "estate"='null';


-->











<!-- SUBIR IMAGENES CON PROGRESO -->
<!-- https://www.php.net/manual/es/session.upload-progress.php -->