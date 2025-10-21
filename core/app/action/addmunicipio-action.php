<div class="row">
<div class="col-md-10">
<h1><i class="fa fa-home"></i> Enviando registro...</h1>
</div>

<?php
/**
* BookMedik
* @author evilnapsis
**/




$rx = MunicipioData::getRepeated($_POST["name"],$_POST["id_estado"]);
if($rx==null){
    $r = new MunicipioData();
    $r->id_estado = $_POST["id_estado"];
    $r->municipio = $_POST["name"];




    $r->add();

// echo $_POST["cod"] . $_POST["nombre"] . $_POST["estado"] . $estado_name;


Core::alert("¡Municipio agregado con éxito!");
}else{
Core::alert("¡Error al guardar, ya existe el Municipio en ese estado!");
}
Core::redir("./index.php?view=municipios");

?>

