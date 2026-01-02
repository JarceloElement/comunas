<!-- <div class="row">
<div class="col-md-10">
<h1><i class="fa fa-home"></i> Guardando cambios...</h1>
</div> -->

<?php
/**
* BookMedik
* @author evilnapsis
**/




if(count($_POST)>0){
    $r = InfoData::getById($_POST["id"]);
    
    // echo $r->nombre;

    $r->id = $_POST["id"];
    $r->cod = $_POST["cod"];
    $r->nombre = $_POST["nombre"];
    $r->estatus = $_POST["estatus"];
    $r->motivo_cierre = $_POST["motivo_cierre"];
    $r->direccion = $_POST["direccion"];
    $r->ciudad = $_POST["ciudad"];
    $r->estado = $_POST["estado"];
    $r->municipio = $_POST["municipio"];

    $r->parroquia = $_POST["parroquia"];
    // $r->n_circuito = $_POST["n_circuito"];
    $r->tecno_internet = $_POST["tecno_internet"];
    $r->proveedor = $_POST["proveedor"];
    $r->perso_contacto = $_POST["perso_contacto"];
    $r->telef_contacto = $_POST["telef_contacto"];
    $r->f_instalacion = $_POST["f_instalacion"];
    $r->estatus_op = $_POST["estatus_op"];
    $r->transferido = $_POST["transferido"];
    // $r->central_dlci = $_POST["central_dlci"];
    // $r->migrado = $_POST["migrado"];


    $r->espacio_inst = $_POST["t_espacio"];
    $r->grupos_etnicos	 = $_POST["g_etnico"];
    $r->tipo_zona = $_POST["t_zona"];
    $r->municipio_fronterizo = $_POST["m_fronterizo"];
    $r->limite_fronterizo = $_POST["l_fronterizo"];
    $r->cod_gerencia = $_POST["cod_gerencia"];

    $r->observacion = $_POST["observacion"];





    $r->update();

// echo $_POST["perso_contacto"] . $_POST["nombre"] . $_POST["estado"];


// Core::alert("¡Infocentro Actualizado con éxito!");
}else{
Core::alert("¡Error al guardar, ya existe un Infocentro con ese nombre y código!");
}
Core::redir("./index.php?view=infocentros&swal=Infocentro actualizado");

?>

