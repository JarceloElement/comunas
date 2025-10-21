<?php

/**
 * InfoApp
 * @author Jarcelo
 **/
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$id = $_GET["id"];

$conn = DatabasePg::connectPg();
$sql = "DELETE from info_inventory where id=$id";
$stmt = $conn->prepare($sql);
$stmt->execute();

print "<script>window.location='index.php?view=inventory&swal=Eleminado". "&estado=" . $_GET["estado"] . "&pag=" . $_GET["pag"]."'</script>";
