<?php
/**
* BookMedik
* @author evilnapsis
* @url http://evilnapsis.com/about/
**/

if(count($_POST)>0){
	$user = new EstadoData();
	$user->estado = $_POST["estado"];
	$user->iso = $_POST["iso"];


	$user->add();

// Core::alert("Nuevo estado agregado");
print "<script>window.location='index.php?view=estados';</script>";


}


?>