<div class="row">
<div class="col-md-10">
<h1><i class="fa fa-home"></i> Guardando cambios...</h1>
</div>


<?php

if(count($_POST)>0){
	$user = MunicipioData::getById2($_POST["id_municipio"]);
	$user->municipio = $_POST["name"];
	$user->id_estado = $_POST["estado"];

	
	$user->update();

Core::alert("Actualizado exitosamente!");
print "<script>window.location='index.php?view=municipios';</script>";


}


?>