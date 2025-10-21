<?php
session_start();
// ---
// la tarea de este archivo es eliminar todo rastro de cookie

// -- eliminamos el usuario
if(isset($_SESSION['user_id'])){
	unset($_SESSION['user_id']);
	unset($_SESSION['user_dni']);
	unset($_SESSION['user_type']);
	unset($_SESSION['user_email']);
	unset($_SESSION['user_username']);
	unset($_SESSION['user_name']);
	unset($_SESSION['user_region']);
	unset($_SESSION['user_code_info']);
	unset($_SESSION['user_rol']);
	unset($_SESSION['is_organization']);
	unset($_SESSION['organization_name']);
	unset($_SESSION['start']);
}

session_destroy();
// v0 29 jul 2013
//estemos donde estemos nos redirije al index
print "<script>sessionStorage.removeItem('darkSwitch');</script>";
print "<script>window.location='./../index.php';</script>";
?>
