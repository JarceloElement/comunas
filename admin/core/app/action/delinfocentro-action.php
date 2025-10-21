<?php

/**
 * InfoApp
 * @author Jarcelo
 **/
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$user = InfoData::getById($_GET["id"]);
$user->del();
print "<script>window.location='index.php?view=infocentros&swal=Eleminado" . "&estado=" . $_GET["estado"] . "&pag=" . $_GET["pag"] . "'</script>";
