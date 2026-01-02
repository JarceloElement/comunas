<div class="row">
<div class="col-md-10">
<h1><i class="fa fa-home"></i> Guardando cambios...</h1>
</div>


<?php

if(count($_POST)>0){
	$user = EstadoData::getById2($_POST["id_estado"]);
	$user->estado = $_POST["estado"];
	$user->iso = $_POST["iso"];

	
	$user->update();

Core::alert("Actualizado exitosamente!");
print "<script>window.location='index.php?view=estados';</script>";


}


?>