<?php

// si el usuario no esta logueado
if(Session::getUID()=="") {
	$user = $_POST['mail'];
	$pass = sha1(md5($_POST['password']));

	$base = new Database();
	$con = $base->connect();
	$sql = "SELECT * from user where (email= \"".$user."\" or username= \"".$user."\") and password= \"".$pass."\" and is_active=1";
	
    // $query_all = $con->query("SELECT * FROM user a INNER JOIN estados b ON a.estate=b.estado WHERE b.estado='".$row['estado']."' ");
	
	//print $sql;
	$query = $con->query($sql);
	$found = false;
	$userid = null;

	while($r = $query->fetch_array()){
		$found = true ;
		$userid = $r['id'];
		$admin = $r['user_type'];
		$email = $r['email'];
		$username = $r['username'];
		$region = $r['region'];
		$code_info = $r['code_info'];
		$rol = $r['rol'];
		$organization_name = $r['organization_name'];
	}

	if($found==true) {
	//	print $userid;
		$_SESSION['user_id']=$userid ;
		$_SESSION['user_type']=$admin ;
		$_SESSION['user_email']=$email ;
		$_SESSION['user_name']=$username ;
		$_SESSION['user_region']=$region ;
		$_SESSION['user_code_info']=$code_info ;
		$_SESSION['user_rol']=$rol ;
		$_SESSION['organization_name']=$organization_name ;
	//	setcookie('userid',$userid);
	//	print $_SESSION['userid'];
		print "Cargando ... $user";
		print "<script>window.location='index.php?view=home';</script>";
	}else {
		print "<script>window.location='index.php?view=login';</script>";
	}

}else{
	print "<script>window.location='index.php?view=home';</script>";
	
}
?>