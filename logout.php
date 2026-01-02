<?php
session_start();
// ---
// la tarea de este archivo es eliminar todo rastro de cookie


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// borramos la session
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : "";
// echo $user_id;
require('core/controller/DatabasePg.php');
if ($user_id != "") {
    $sql = "UPDATE user_session set active=0, session_id='user_closed' where user_id=$user_id";
    $conn = DatabasePg::connectPg();
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    // $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
}


// Destruir todas las variables de sesión.
$_SESSION = array();
$_COOKIE = array();
session_unset();
session_destroy();




//estemos donde estemos nos redirije al index
print "<script>sessionStorage.removeItem('darkSwitch');</script>";
print "<script>localStorage.removeItem('usersession');</script>";
print "<script>window.location='index.php';</script>";
