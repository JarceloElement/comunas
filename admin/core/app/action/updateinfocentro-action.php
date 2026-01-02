<?php
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(0);
header('Content-Type: application/json');

$code_info = trim(strtoupper($_POST["cod"]));







if (count($_POST) > 0) {

    // verificar si el infocentro existe para evitar errores de llave foranea
    $rx = InfoData::getByCode($code_info);


    if (isset($rx->cod) && $rx->cod == $code_info && $rx->id != $_POST["id"]) {
        $array = array(
            "data"  => "code",
            "alert" => "¡AVISO! Ya existe otro infocentro con ese código, por favor verifica, solo puedes tener un infocentro con ese código.",
            "alert_type" => "warning"
        );
        $res = json_encode($array);
        echo $res;
        return;
    } else {
        $array = array(
            "data"  => "",
            "alert" => "El infocentro no existe",
            "alert_type" => "warning"
        );
    }



    // $r = InfoData::getById($_POST["id"]);

    // $r->id = $_POST["id"];
    // $r->cod = $code_info;
    // $r->nombre = $_POST["nombre"];
    // $r->estatus = $_POST["estatus"];
    // $r->motivo_cierre = $_POST["motivo_cierre"];
    // $r->direccion = $_POST["direccion"];
    // $r->ciudad = $_POST["ciudad"];
    // $r->estado = $_POST["estado"];
    // $r->municipio = $_POST["municipio"];

    // $r->parroquia = $_POST["parroquia"];
    // // $r->n_circuito = $_POST["n_circuito"];
    // $r->tecno_internet = $_POST["tecno_internet"];
    // $r->proveedor = $_POST["proveedor"];
    // $r->perso_contacto = $_POST["perso_contacto"];
    // $r->telef_contacto = $_POST["telef_contacto"];
    // $r->f_instalacion = $_POST["f_instalacion"];
    // $r->estatus_op = $_POST["estatus_op"];
    // $r->transferido = $_POST["transferido"];
    // // $r->central_dlci = $_POST["central_dlci"];
    // // $r->migrado = $_POST["migrado"];


    // $r->espacio_inst = $_POST["t_espacio"];
    // $r->grupos_etnicos = $_POST["g_etnico"];
    // $r->tipo_zona = $_POST["t_zona"];
    // $r->municipio_fronterizo = $_POST["m_fronterizo"];
    // $r->limite_fronterizo = $_POST["l_fronterizo"];
    // $r->cod_gerencia = $_POST["cod_gerencia"];

    // $r->servicio_pagado_por = $_POST["servicio_pagado_por"];
    // $r->propuesto_nucleo_robotica = $_POST["propuesto_nucleo_robotica"];
    // $r->espacio_robotica_educativa = $_POST["espacio_robotica_educativa"];
    // $r->fecha_solicitud_migracion = $_POST["fecha_solicitud_migracion"];
    // $r->fecha_reporte = $_POST["fecha_reporte"];
    // $r->fecha_solucion = $_POST["fecha_solucion"];
    // $r->observacion_falla = $_POST["observacion_falla"];
    // $r->casos_resueltos_ano = $_POST["casos_resueltos_ano"];

    // $r->observacion = $_POST["observacion"];



    $sql = "UPDATE infocentros set 
		cod = ?, 
		nombre = ?, 
		estatus = ?, 
		abierto_en_pandemia = ?, 
		motivo_cierre = ?, 
		motivo_cierre_def = ?, 
		direccion = ?, 
		ciudad = ?, 
		estado = ?, 
		municipio = ?, 
		parroquia = ?, 
		n_circuito = ?, 
		tecno_internet = ?, 
		proveedor = ?, 
		perso_contacto = ?, 
		telef_contacto = ?, 
		f_instalacion = ?, 
		f_inauguracion = ?, 
		creacion_year = ?, 
		estatus_op = ?, 
		estatus_falla = ?, 
		n_reporte = ?, 
		transferido = ?, 
		central_dlci = ?, 
		fact_aba = ?, 
		migrado = ?, 
		estatus_migracion = ?, 
		fecha_migracion = ?, 
		cod_gerencia = ?, 
		pc_wifi = ?, 
		router_wifi = ?, 
		antena_wifi = ?, 
		ancho_banda_bajada = ?, 
		ancho_banda_subida = ?, 
		mac_pc = ?, 
		rango_ip = ?, 
		facili_s_coord = ?, 
		obs_facilitador = ?, 
		ofensiva_fase_i = ?, 
		ofensiva_fase_ii = ?, 
		ofensiva_fase_iii = ?, 
		ofensiva_fase_iv = ?, 
		ofensiva_fase_v = ?, 
		avance_ofensiva = ?, 
		financiamiento_ofensiva = ?, 
		espacio_inst = ?, 
		grupos_etnicos = ?, 
		tipo_zona = ?, 
		municipio_fronterizo = ?, 
		limite_fronterizo = ?, 
		latitud = ?, 
		longitud = ?, 
		observacion = ?, 
		observacion_tecnica = ?,
		servicio_pagado_por = ?,
		propuesto_nucleo_robotica = ?,
		espacio_robotica_educativa = ?,
		fecha_solicitud_migracion = ?,
		fecha_reporte = ?,
		fecha_solucion = ?,
		observacion_falla = ?,
		casos_resueltos_ano = ?
		where id = ?;";
    $values = [
        $code_info,
        $_POST["nombre"],
        $_POST["estatus"],
        $_POST["abierto_en_pandemia"],
        $_POST["motivo_cierre"],
        $_POST["motivo_cierre_def"],
        $_POST["direccion"],
        $_POST["ciudad"],
        $_POST["estado"],
        $_POST["municipio"],
        $_POST["parroquia"],
        $_POST["n_circuito"],
        $_POST["tecno_internet"],
        $_POST["proveedor"],
        $_POST["perso_contacto"],
        $_POST["telef_contacto"],
        $_POST["f_instalacion"],
        $_POST["f_inauguracion"],
        $_POST["creacion_year"],
        $_POST["estatus_op"],
        $_POST["estatus_falla"],
        $_POST["n_reporte"],
        $_POST["transferido"],
        $_POST["central_dlci"],
        $_POST["fact_aba"],
        $_POST["migrado"],
        $_POST["estatus_migracion"],
        $_POST["fecha_migracion"],
        $_POST["cod_gerencia"],
        $_POST["pc_wifi"],
        $_POST["router_wifi"],
        $_POST["antena_wifi"],
        $_POST["ancho_banda_bajada"],
        $_POST["ancho_banda_subida"],
        $_POST["mac_pc"],
        $_POST["rango_ip"],
        $_POST["facili_s_coord"],
        $_POST["obs_facilitador"],
        $_POST["ofensiva_fase_i"],
        $_POST["ofensiva_fase_ii"],
        $_POST["ofensiva_fase_iii"],
        $_POST["ofensiva_fase_iv"],
        $_POST["ofensiva_fase_v"],
        $_POST["avance_ofensiva"],
        $_POST["financiamiento_ofensiva"],
        $_POST["t_espacio"],
        $_POST["g_etnico"],
        $_POST["t_zona"],
        $_POST["m_fronterizo"],
        $_POST["l_fronterizo"],
        $_POST["latitud"],
        $_POST["longitud"],
        $_POST["observacion"],
        $_POST["observacion_tecnica"],
        $_POST["servicio_pagado_por"],
        $_POST["propuesto_nucleo_robotica"],
        $_POST["espacio_robotica_educativa"],
        $_POST["fecha_solicitud_migracion"],
        $_POST["fecha_reporte"],
        $_POST["fecha_solucion"],
        $_POST["observacion_falla"],
        $_POST["casos_resueltos_ano"],
        $_POST["id"]
    ];

    // ExecutorPg::update($sql, $values);


    try {
        $result = ExecutorPg::update($sql, $values);
        // Si tu función retorna algo, puedes verificarlo aquí
        // if ($result !== true && $result !== "ok") {
        //     throw new Exception(is_string($result) ? $result : "Error desconocido en la actualización.");
        // }

        // $result = $r->update();

        $array = array(
            "data"  => "",
            "alert" => "Infocentro actualizado con éxito.",
            "alert_type" => "dashboard"
        );
    } catch (Exception $e) {
        $array = array(
            "data"  => "",
            "alert" => "¡Error: " . $e->getMessage() . "!",
            "alert_type" => "error"
        );
    }
    echo json_encode($array);
    return;


} else {
    Core::alert("¡Error al guardar, ya existe un Infocentro con ese nombre y código!");
}
// Core::redir("./index.php?view=infocentros&swal=Infocentro actualizado&" . $_SESSION["location"]);
