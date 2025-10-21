<?php
/**
* BookMedik
* @author evilnapsis
**/
$user = ParroquiaData::getById2($_GET["id"]);
$user->del();
print "<script>window.location='index.php?view=parroquias';</script>";

?>