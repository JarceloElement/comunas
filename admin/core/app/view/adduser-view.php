<?php
$base = new Database();
$con = $base->connect();

$rx = UserData::getRepeated($_POST["username"],$_POST["email"]);
$rx_dni = UserData::getByDni($_POST["user_dni"]);
$rx_email = UserData::getRepeatedEmail($_POST["email"]);

if($rx_email!=null){
	$alert = "¡Ya existe un usuraio con el mismo correo!";
	print "<script>window.location='index.php?view=newuser&alert=$alert'</script>";
}
if($rx_dni!=null){
	$alert = "¡Ya existe un usuraio con el mismo documento de identidad!";
	print "<script>window.location='index.php?view=newuser&alert=$alert'</script>";
}



$is_organization = 0;



if($rx==null){

	if(count($_POST)>0){
		// $is_admin=0;
		// if(isset($_POST["is_admin"])){$is_admin=1;}
		if(isset($_POST["is_organization"])){$is_organization=1;}
		$user = new UserData();
		$user->name = $_POST["name"];
		$user->lastname = $_POST["lastname"];
		$user->username = $_POST["username"];
		$user->user_dni = $_POST["user_dni"];
		$user->email = $_POST["email"];
		$user->user_type = $_POST["user_type"];
		$user->gender = $_POST["gender"];
		$user->region = $_POST["region"];
		$user->code_info = $_POST["code_info"];
		$user->rol = $_POST["rol"];
		$user->is_organization=$is_organization;
		$user->organization_name=$_POST["organization_name"];
		$user->password = sha1(md5($_POST["password"]));
		$insert_id = $user->add();

		$user_type = $_POST["user_type"];
		$user_dni = $_POST["user_dni"];
		$user_id = $insert_id[1];
		$user_correo = $_POST["email"];

		// actualiza el correo al usuario final
		$sql = "UPDATE final_users	set user_type = ?, user_correo=?, user_dni=?, user_id=? where (user_correo='$user_correo' or user_dni='$user_dni') and user_dni!='No cedulado' and user_dni!='';";
		$values = [$user_type, $user_correo, $user_dni, (int)$user_id];
		ExecutorPg::update($sql, $values);

		print "<script>window.location='index.php?view=users&swal=Usuario creado';</script>";

	}
}else{
	// print "<script>alert('¡El usuario y correo ya existen!');</script>";
	// View::Error("<p class='alert alert-warning'>¡El usuario y correo ya existen! </p>");
	$alert = "¡Ya existe un usurio con el mismo nombre de usuario y correo!";
	// Core::alert("¡El usuario y correo ya existen!");
	print "<script>window.location='index.php?view=newuser&alert=$alert'</script>";

}

?>
