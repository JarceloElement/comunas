<?php


// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);


define("ROOT", dirname(__FILE__));

$debug = false;
if ($debug) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}


// en servidor dedicado deberia funcionar
// session_cache_limiter('private');
// session_cache_expire(30);


// en servidor compartido
// $DURACION_SESION = 180;
// define('DURACION_SESION',$DURACION_SESION); //2 horas
// ini_set("session.cookie_lifetime",$DURACION_SESION);
// ini_set("session.gc_maxlifetime",$DURACION_SESION); 
// ini_set("session.save_path","/tmp");
// session_cache_expire($DURACION_SESION);


session_start();
// session_regenerate_id(true); 






include "core/autoload.php";
Core::$root = "";
Core::$theme = "";

// si quieres que se muestre las consultas SQL debes decomentar la siguiente linea
Core::$debug_sql = false;

$lb = new Lb();
$lb->start(); // llama autoload.php y luego a ini.php
