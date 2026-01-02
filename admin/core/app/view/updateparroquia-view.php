<div class="row">
<div class="col-md-10">
<h1><i class="fa fa-home"></i> Guardando cambios...</h1>
</div>


<?php

if(count($_POST)>0){
	$user = ParroquiaData::getById2($_POST["id_parroquia"]);
	$user->parroquia = $_POST["name"];
	$user->id_municipio = $_POST["municipio"];
	$user->id_parroquia = $_POST["id_parroquia"];

	
	$user->update();

Core::alert("Actualizado exitosamente!");
print "<script>window.location='index.php?view=parroquias';</script>";


}


?>