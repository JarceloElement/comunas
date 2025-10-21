
<?php

$rx = CiudadData::getRepeated($_POST["ciudad"], $_POST["id_estado"]);
if ($rx == null) {
    $r = new CiudadData();
    $r->id_estado = $_POST["id_estado"];
    $r->ciudad = $_POST["ciudad"];
    $r->capital = $_POST["capital"];
    $r->add();


    Core::alert("Ciudad agregada con éxito!");
} else {
    Core::alert("¡Error al guardar, ya existe la parroquia en ese estado!");
}
Core::redir("./index.php?view=ciudades");

?>

