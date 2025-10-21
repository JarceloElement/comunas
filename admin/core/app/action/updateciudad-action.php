<?php

if(count($_POST)>0){
	$user = CiudadData::getById2($_POST["id_ciudad"]);
	$user->id_estado = $_POST["id_estado"];
	$user->ciudad = $_POST["ciudad"];
	$user->capital = $_POST["capital"];
	$user->update();

Core::alert("Actualizado exitosamente!");
print "<script>window.location='index.php?view=ciudades';</script>";


}


?>