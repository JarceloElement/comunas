<?php
/**
* BookMedik
* @author evilnapsis
**/
$user = MunicipioData::getById2($_GET["id"]);
$user->del();
print "<script>window.location='index.php?view=municipios';</script>";

?>