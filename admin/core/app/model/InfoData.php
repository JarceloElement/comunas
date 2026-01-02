<?php
#[AllowDynamicProperties]

class InfoData
{
	public static $tablename = "infocentros";


	public function __construct()
	{
		$this->id = "";
		$this->region_tipo = "";
		$this->cod = "";
		$this->nombre = "";
		$this->estatus = "";
		$this->abierto_en_pandemia = "";
		$this->motivo_cierre = "";
		$this->motivo_cierre_def = "";
		$this->direccion = "";
		$this->estado = null;
		$this->ciudad = null;
		$this->municipio = null;
		$this->parroquia = null;
		$this->n_circuito = "";
		$this->tecno_internet = "";
		$this->proveedor = "";
		$this->perso_contacto = "";
		$this->telef_contacto = "0";
		$this->f_instalacion = "";
		$this->f_inauguracion = "";
		$this->creacion_year = "";
		$this->estatus_op = "";
		$this->estatus_falla = "";
		$this->n_reporte = "";
		$this->transferido = "";
		$this->central_dlci = "";
		$this->fact_aba = "";
		$this->migrado = "";
		$this->estatus_migracion = "";
		$this->fecha_migracion = "";
		$this->cod_gerencia = "";
		$this->pc_wifi = "";
		$this->router_wifi = "";
		$this->antena_wifi = "";
		$this->ancho_banda_bajada = "";
		$this->ancho_banda_subida = "";
		$this->mac_pc = "";
		$this->rango_ip = "";
		$this->facili_s_coord = "";
		$this->obs_facilitador = "";
		$this->ofensiva_fase_i = "";
		$this->ofensiva_fase_ii = "";
		$this->ofensiva_fase_iii = "";
		$this->ofensiva_fase_iv = "";
		$this->ofensiva_fase_v = "";
		$this->avance_ofensiva = "";
		$this->financiamiento_ofensiva = "";

		$this->espacio_inst = "";
		$this->grupos_etnicos = "";
		$this->tipo_zona = "";
		$this->municipio_fronterizo = "";
		$this->limite_fronterizo = "";
		$this->latitud = "";
		$this->longitud = "";

		$this->observacion = "";
		$this->observacion_tecnica = "";
		$this->f_registro = "";

		$this->estado_name = null;
		$this->municipio_name = null;
		$this->parroquia_name = null;
		$this->ciudad_name = null;

		$this->servicio_pagado_por = null;
		$this->propuesto_nucleo_robotica = null;
		$this->espacio_robotica_educativa = null;
		$this->fecha_solicitud_migracion = null;
		$this->fecha_reporte = null;
		$this->fecha_solucion = null;
		$this->observacion_falla = null;
		$this->casos_resueltos_ano = null;
	}


	// public function getPacient(){ return PacientData::getById($this->pacient_id); }
	// public function getMedic(){ return MedicData::getById($this->medic_id); }
	// public function getStatus(){ return StatusData::getById($this->status_id); }





	public function add()
	{
		if ($this->estado != null) {
			$estado_n = EstadoData::getById($this->estado);
			foreach ($estado_n as $p):
				$this->estado_name = $p['estado'];
			endforeach;
		}

		if ($this->municipio != null) {
			$municipio_n = MunicipioData::getById($this->municipio);
			foreach ($municipio_n as $p):
				$this->municipio_name = $p['municipio'];
			endforeach;
		}

		if ($this->parroquia != null) {
			$parroquia_n = ParroquiaData::getById($this->parroquia);
			foreach ($parroquia_n as $p):
				$this->parroquia_name = $p['parroquia'];
			endforeach;
		}

		if ($this->ciudad != null) {
			$ciudad_n = CiudadData::getById($this->ciudad);
			foreach ($ciudad_n as $p):
				$this->ciudad_name = $p['ciudad'];
			endforeach;
		}

		$sql = "INSERT into infocentros (
			region_tipo,
			cod,
			nombre,
			estatus,
			motivo_cierre,
			direccion,
			ciudad,
			estado,
			municipio,
			parroquia,
			n_circuito,
			tecno_internet,
			proveedor,
			perso_contacto,
			telef_contacto,
			f_instalacion,
			creacion_year,
			estatus_op,
			transferido,
			central_dlci,
			migrado,
			cod_gerencia,
			espacio_inst,
			grupos_etnicos,
			tipo_zona,
			municipio_fronterizo,
			limite_fronterizo,
			observacion,
			observacion_tecnica,
			servicio_pagado_por,
			propuesto_nucleo_robotica,
			espacio_robotica_educativa,
			fecha_solicitud_migracion,
			fecha_reporte,
			fecha_solucion,
			observacion_falla,
			casos_resueltos_ano
			)";
		$sql .= " VALUES (
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?,
			?
			) RETURNING id;";
		$values = [
			$this->region_tipo,
			$this->cod,
			$this->nombre,
			$this->estatus,
			$this->motivo_cierre,
			$this->direccion,
			$this->ciudad_name,
			$this->estado_name,
			$this->municipio_name,
			$this->parroquia_name,
			$this->n_circuito,
			$this->tecno_internet,
			$this->proveedor,
			$this->perso_contacto,
			$this->telef_contacto,
			$this->f_instalacion,
			$this->creacion_year,
			$this->estatus_op,
			$this->transferido,
			$this->central_dlci,
			$this->migrado,
			$this->cod_gerencia,
			$this->espacio_inst,
			$this->grupos_etnicos,
			$this->tipo_zona,
			$this->municipio_fronterizo,
			$this->limite_fronterizo,
			$this->observacion,
			$this->observacion_tecnica,
			$this->servicio_pagado_por,
			$this->propuesto_nucleo_robotica,
			$this->espacio_robotica_educativa,
			$this->fecha_solicitud_migracion,
			$this->fecha_reporte,
			$this->fecha_solucion,
			$this->observacion_falla,
			$this->casos_resueltos_ano
		];
		$stmt_insert = ExecutorPg::insert($sql, $values)[0]["id"];


		$sql = "INSERT into info_process (
			k_info,
			estado,
			code_info
			) VALUES (?,?,?) RETURNING id;";

		$values = [
			(int)$stmt_insert,
			$this->estado_name,
			$this->cod
		];
		ExecutorPg::insert($sql, $values);

		$sql = "INSERT into info_inventory (
			k_info,
			estado,
			code_info
			) VALUES (?,?,?) RETURNING id;";

		$values = [
			(int)$stmt_insert,
			$this->estado_name,
			$this->cod
		];
		ExecutorPg::insert($sql, $values);

		return $stmt_insert;
	}



	public static function delById($id)
	{
		$sql = "delete from " . self::$tablename . " where id=$id";
		Executor::doit($sql);
	}
	public function del()
	{
		$sql = "delete from " . self::$tablename . " where id=$this->id";
		ExecutorPg::doit($sql);
	}


	public function update()
	{
		if ((int)$this->estado >= 1) {
			$estado_n = EstadoData::getById($this->estado);
			foreach ($estado_n as $p):
				$this->estado_name = $p['estado'];
			endforeach;
		} else {
			$this->estado_name = $this->estado;
		}


		if ((int)$this->municipio >= 1) {
			$municipio_n = MunicipioData::getById($this->municipio);
			foreach ($municipio_n as $p):
				$this->municipio_name = $p['municipio'];
			endforeach;
		} else {
			$this->municipio_name = $this->municipio;
		}


		if ((int)$this->parroquia >= 1) {
			$parroquia_n = ParroquiaData::getById($this->parroquia);
			foreach ($parroquia_n as $p):
				$this->parroquia_name = $p['parroquia'];
			endforeach;
		} else {
			$this->parroquia_name = $this->parroquia;
		}


		if ((int)$this->ciudad >= 1) {
			$ciudad_n = CiudadData::getById($this->ciudad);
			foreach ($ciudad_n as $p):
				$this->ciudad_name = $p['ciudad'];
			endforeach;
		} else {
			$this->ciudad_name = $this->ciudad;
		}

		$sql = "UPDATE " . self::$tablename . " set 
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
			$this->cod,
			$this->nombre,
			$this->estatus,
			$this->abierto_en_pandemia,
			$this->motivo_cierre,
			$this->motivo_cierre_def,
			$this->direccion,
			$this->ciudad_name,
			$this->estado_name,
			$this->municipio_name,
			$this->parroquia_name,
			$this->n_circuito,
			$this->tecno_internet,
			$this->proveedor,
			$this->perso_contacto,
			$this->telef_contacto,
			$this->f_instalacion,
			$this->f_inauguracion,
			$this->creacion_year,
			$this->estatus_op,
			$this->estatus_falla,
			$this->n_reporte,
			$this->transferido,
			$this->central_dlci,
			$this->fact_aba,
			$this->migrado,
			$this->estatus_migracion,
			$this->fecha_migracion,
			$this->cod_gerencia,
			$this->pc_wifi,
			$this->router_wifi,
			$this->antena_wifi,
			$this->ancho_banda_bajada,
			$this->ancho_banda_subida,
			$this->mac_pc,
			$this->rango_ip,
			$this->facili_s_coord,
			$this->obs_facilitador,
			$this->ofensiva_fase_i,
			$this->ofensiva_fase_ii,
			$this->ofensiva_fase_iii,
			$this->ofensiva_fase_iv,
			$this->ofensiva_fase_v,
			$this->avance_ofensiva,
			$this->financiamiento_ofensiva,
			$this->espacio_inst,
			$this->grupos_etnicos,
			$this->tipo_zona,
			$this->municipio_fronterizo,
			$this->limite_fronterizo,
			$this->latitud,
			$this->longitud,
			$this->observacion,
			$this->observacion_tecnica,
			$this->servicio_pagado_por,
			$this->propuesto_nucleo_robotica,
			$this->espacio_robotica_educativa,
			$this->fecha_solicitud_migracion,
			$this->fecha_reporte,
			$this->fecha_solucion,
			$this->observacion_falla,
			$this->casos_resueltos_ano,
			$this->id
		];
		return ExecutorPg::update($sql, $values);

		// try {
		// 	$result = ExecutorPg::update($sql, $values);
		// 	 if ($result !== true && $result !== "ok") {
        //     throw new Exception(is_string($result) ? $result : "Error desconocido en la actualización.");
        // }

		// 	return true;
		// } catch (Exception $e) {
		// 	return $e->getMessage();
		// }


	}


	public function updatePgXLSX()
	{
		$sql = "UPDATE " . self::$tablename . " set 
		id = ?,
		region_tipo = ?,
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
		where cod = ?;";
		$values = [
			$this->id,
			$this->region_tipo,
			$this->cod,
			$this->nombre,
			$this->estatus,
			$this->abierto_en_pandemia,
			$this->motivo_cierre,
			$this->motivo_cierre_def,
			$this->direccion,
			$this->ciudad,
			$this->estado,
			$this->municipio,
			$this->parroquia,
			$this->n_circuito,
			$this->tecno_internet,
			$this->proveedor,
			$this->perso_contacto,
			$this->telef_contacto,
			$this->f_instalacion,
			$this->f_inauguracion,
			$this->creacion_year,
			$this->estatus_op,
			$this->estatus_falla,
			$this->n_reporte,
			$this->transferido,
			$this->central_dlci,
			$this->fact_aba,
			$this->migrado,
			$this->estatus_migracion,
			$this->fecha_migracion,
			$this->cod_gerencia,
			$this->pc_wifi,
			$this->router_wifi,
			$this->antena_wifi,
			$this->ancho_banda_bajada,
			$this->ancho_banda_subida,
			$this->mac_pc,
			$this->rango_ip,
			$this->facili_s_coord,
			$this->obs_facilitador,
			$this->ofensiva_fase_i,
			$this->ofensiva_fase_ii,
			$this->ofensiva_fase_iii,
			$this->ofensiva_fase_iv,
			$this->ofensiva_fase_v,
			$this->avance_ofensiva,
			$this->financiamiento_ofensiva,
			$this->espacio_inst,
			$this->grupos_etnicos,
			$this->tipo_zona,
			$this->municipio_fronterizo,
			$this->limite_fronterizo,
			$this->latitud,
			$this->longitud,
			$this->observacion,
			$this->observacion_tecnica,
			$this->servicio_pagado_por,
			$this->propuesto_nucleo_robotica,
			$this->espacio_robotica_educativa,
			$this->fecha_solicitud_migracion,
			$this->fecha_reporte,
			$this->fecha_solucion,
			$this->observacion_falla,
			$this->casos_resueltos_ano,
			$this->cod
		];
		ExecutorPg::update($sql, $values);
	}



	public static function getById($id)
	{
		$sql = "select * from " . self::$tablename . " where id=$id and cod!=''";
		// $query = Executor::doit($sql);
		// return Model::one($query[0], new InfoData());

		$query = ExecutorPg::doit($sql);
		$array = ModelPg::one($query[0][0], new InfoData());
		if ($array->id == "") {
			return "null";
		} else {
			return $array;
		}
	}


	public static function getByEstado($estado)
	{
		$sql = "select * from " . self::$tablename . " where estado=\"$estado\"";
		$query = Executor::doit($sql);
		return Model::many($query[0], new InfoData());
	}

	public static function getByMunicipio($munic)
	{
		$sql = "select * from " . self::$tablename . " where municipio=\"$munic\"";
		$query = Executor::doit($sql);
		return Model::many($query[0], new InfoData());
	}

	public static function getByParroquia($parro)
	{
		$sql = "select * from " . self::$tablename . " where parroquia=\"$parro\"";
		$query = Executor::doit($sql);
		return Model::many($query[0], new InfoData());
	}

	public static function getByCode($cod)
	{
		$code_info = trim(strtoupper($cod));
		// $conn = DatabasePg::connectPg();
		// $row = $conn->prepare("SELECT * FROM infocentros WHERE upper(cod)='$code_info'");
		// $row->execute();
		// $data = $row->fetch(PDO::FETCH_ASSOC);
		// if ($data != '') {
		// 	return $data;
		// } else {
		// 	return null;
		// }


		$sql = "SELECT * FROM infocentros WHERE upper(cod)='$code_info' ";
		$query = ExecutorPg::doit($sql);
		// return $query;
		// return $sql;
		$array = ModelPg::one($query[0][0], new InfoData());
		if ($array->id == "") {
			return "null";
		} else {
			return $array;
		}
	}


	public static function getRepeated($cod, $nombre)
	{
		$sql = "select * from " . self::$tablename . " where cod=\"$cod\" and nombre=\"$nombre\"";
		$query = Executor::doit($sql);
		return Model::one($query[0], new InfoData());
	}



	public static function getByMail($mail)
	{
		$sql = "select * from " . self::$tablename . " where mail=\"$mail\"";
		$query = Executor::doit($sql);
		return Model::one($query[0], new InfoData());
	}

	public static function getEvery()
	{
		$sql = "select * from " . self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0], new InfoData());
	}


	public static function getAll()
	{
		$sql = "select * from " . self::$tablename . " order by f_registro desc";
		$query = Executor::doit($sql);
		return Model::many($query[0], new InfoData());
	}

	public static function getAllPendings()
	{
		$sql = "select * from " . self::$tablename . " where date(date_at)>=date(NOW()) and status_id=1 and payment_id=1 order by date_at";
		$query = Executor::doit($sql);
		return Model::many($query[0], new InfoData());
	}


	public static function getAllByPacientId($id)
	{
		$sql = "select * from " . self::$tablename . " where pacient_id=$id order by date_at";
		$query = Executor::doit($sql);
		return Model::many($query[0], new InfoData());
	}

	public static function getAllByMedicId($id)
	{
		$sql = "select * from " . self::$tablename . " where medic_id=$id order by date_at";
		$query = Executor::doit($sql);
		return Model::many($query[0], new InfoData());
	}

	public static function getBySQL($sql)
	{
		$query = Executor::doit($sql);
		return Model::many($query[0], new InfoData());
	}

	public static function getOld()
	{
		$sql = "select * from " . self::$tablename . " where date(date_at)<date(NOW()) order by date_at";
		$query = Executor::doit($sql);
		return Model::many($query[0], new InfoData());
	}

	public static function getLike($q)
	{
		$sql = "select * from " . self::$tablename . " where title like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0], new InfoData());
	}



	public static function getStateByCode($id)
	{
		$name = "";
		$con = Database::getCon();
		$query = $con->query("select estado from " . self::$tablename . " where cod=\"$id \"");

		while ($res = mysqli_fetch_array($query)) {
			$resul[] = $res;
		}

		// foreach($resul as $p):
		// 	$name.= $p['estado'];
		// endforeach;

		return $resul;
	}
}
