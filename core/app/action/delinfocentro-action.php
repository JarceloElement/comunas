<?php
/**
* BookMedik
* @author evilnapsis
**/
$user = InfoData::getById($_GET["id"]);
$user->del();
print "<script>window.location='index.php?view=infocentros&swal=Eleminado';</script>";

?>