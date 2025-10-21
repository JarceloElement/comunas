<div class="row">
<div class="col-md-10">
<h1><i class="fa fa-home"></i> Enviando registro...</h1>
</div>

<?php
/**
* BookMedik
* @author evilnapsis
**/




$rx = ParroquiaData::getRepeated($_POST["municipio"],$_POST["name"]);
if($rx==null){
    $r = new ParroquiaData();
    $r->id_municipio = $_POST["municipio"];
    $r->parroquia = $_POST["name"];




    $r->add();

// echo $_POST["cod"] . $_POST["nombre"] . $_POST["estado"] . $estado_name;


Core::alert("Parroquia agregada con éxito!");
}else{
Core::alert("¡Error al guardar, ya existe la parroquia en ese estado!");
}
Core::redir("./index.php?view=parroquias");

?>

