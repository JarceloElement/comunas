<?php

/**
 * InfoApp
 * @author Jarcelo
 **/
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$func_post = "";
$func_get = "";

if (isset($_POST['function'])) {
    $func_post = $_POST["function"];
}
if (isset($_GET['function'])) {
    $func_get = $_GET["function"];
}

// auto-registro
if ($func_get == "add") {
	$estado = new EstadoData();
	$estado->estado = $_POST["estado"];
	$estado->iso = $_POST["iso"];

    $estado->add();

    $array = [
        "success" => true,
    ];

    $res = json_encode($array);
    echo $res;
}


