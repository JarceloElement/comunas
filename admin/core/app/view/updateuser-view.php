<?php
// session_start();

$base = new Database();
$con = $base->connect();


if (count($_POST) > 0) {
	$is_admin = 0;
	// if(isset($_POST["is_admin"])){$is_admin=1;}
	$is_active = 0;
	$is_organization = 0;
	if (isset($_POST["is_active"])) {
		$is_active = 1;
	}
	if (isset($_POST["is_organization"])) {
		$is_organization = 1;
	}
	$user_dni = $_POST["user_dni"];

	$user = UserData::getById($_POST["user_id"]);
	$user->name = $_POST["name"];
	$user->lastname = $_POST["lastname"];
	$user->username = $_POST["username"];
	$user->user_dni = $user_dni;
	$user->email = $_POST["email"];
	$user->user_type = $_POST["user_type"];
	$user->gender = $_POST["gender"];
	$user->region = $_POST["region"];
	$user->code_info = $_POST["code_info"];
	$user->rol = $_POST["rol"];
	$user->is_active = $is_active;
	$user->is_organization = $is_organization;
	$user->organization_name = $_POST["organization_name"];
	$user->update();

	if ($_POST["password"] != "") {
		$user->password = sha1(md5($_POST["password"]));
		$user->update_passwd();
		// print "<script>alert('Se ha actualizado el password');</script>";
	}

	$_SESSION['user_dni'] == $user_dni;

	$user_type = $_POST["user_type"];
	$user_id = $_POST["user_id"];
	$user_correo = $_POST["email"];

	// actualiza el correo al usuario participante
	$sql = "UPDATE final_users	set user_type = ?, user_correo=?, user_dni=?  where user_id = ?;";
	$values = [$user_type, $user_correo, $user_dni, (int)$user_id];
	ExecutorPg::update($sql, $values);

	print "<script>window.location='index.php?view=users&swal=Usuario modificado';</script>";
}
