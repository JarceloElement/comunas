<?php

define("ROOT", dirname(__FILE__));

$debug = false;
if ($debug) {
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
}

include "core/autoload.php";


if (Session::getUID() == "") :

  if (isset($_GET["view"]) && $_GET["view"] != "index" && $_GET["view"] != "signup" && $_GET["view"] != "processlogin" && $_GET["view"] != "adduser") {
    print "<script>window.location='logout.php';</script>";
  }

endif;


Core::$root = "";

// si quieres que se muestre las consultas SQL debes decomentar la siguiente linea
Core::$debug_sql = false;

$lb = new Lb();
$lb->start(); // llama autoload.php y luego a ini.php



?>

