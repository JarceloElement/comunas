<?php

/**
 * InfoApp
 * @author Jarcelo
 **/


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$code_info = trim(strtoupper($_POST["cod"]));

$rx = InfoData::getByCode($code_info);

if ($rx == 'null') {
    $r = new InfoData();
    $r->cod = $code_info;
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
    $r->creacion_year = $_POST["f_instalacion"];
    $r->estatus_op = $_POST["estatus_op"];
    $r->transferido = $_POST["transferido"];
    // $r->central_dlci = $_POST["central_dlci"];
    // $r->migrado = $_POST["migrado"];

    $r->espacio_inst = $_POST["t_espacio"];
    $r->grupos_etnicos     = $_POST["g_etnico"];
    $r->tipo_zona = $_POST["t_zona"];
    $r->municipio_fronterizo = $_POST["m_fronterizo"];
    $r->limite_fronterizo = $_POST["l_fronterizo"];
    $r->cod_gerencia = $_POST["cod_gerencia"];

    $r->servicio_pagado_por = $_POST["servicio_pagado_por"];
    $r->propuesto_nucleo_robotica = $_POST["propuesto_nucleo_robotica"];
    $r->espacio_robotica_educativa = $_POST["espacio_robotica_educativa"];
    $r->fecha_solicitud_migracion = $_POST["fecha_solicitud_migracion"];
    $r->fecha_reporte = $_POST["fecha_reporte"];
    $r->fecha_solucion = $_POST["fecha_solucion"];
    $r->observacion_falla = $_POST["observacion_falla"];
    $r->casos_resueltos_ano = $_POST["casos_resueltos_ano"];

    $r->observacion = $_POST["observacion"];
    $r->add();

Core::redir('./index.php?view=infocentros&swal=Infocentro creado');

} else {
    Core::alert("¡Error al guardar, ya existe un Infocentro con el código: (".$_POST["cod"].")!");
}
