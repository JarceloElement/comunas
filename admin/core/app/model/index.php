<?php
// print "<script>window.location='./index.php';</script>";
// header('Location:logout.php');

// $url = $_SERVER['REQUEST_URI'];
// echo $url;
// echo parse_url($url)["host"];



// $url_actual = "http://" . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
// $url_actual = "http://" . $_SERVER["SERVER_NAME"];
// $path = parse_url($url_actual);
// var_dump(parse_url($url_actual));
// echo $path["host"];
// echo $_SERVER['HTTP_HOST'];
header('Location:'.$_SERVER['HTTP_HOST']."/index.php");
?>

