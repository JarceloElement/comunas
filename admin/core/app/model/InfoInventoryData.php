<?php
 #[AllowDynamicProperties]

class InfoInventoryData {
	public static $tablename = "info_inventory";


	public function __construct(){
		$this->id = "";
		$this->estado = "";
		$this->code_info = "";
		$this->desc_pc = "";
		$this->t_pc_asig = "";
		$this->t_pc_ope = "";
		$this->t_pc_inope = "";
		$this->causa_pc_inop = "";
		$this->desc_impresora = "";
		$this->t_impresora = "";
		$this->t_imp_ope = "";
		$this->t_imp_inop = "";
		$this->t_escrit_ope = "";
		$this->t_escrit_inop = "";
		$this->t_escrit = "";
		$this->t_sillas_ope = "";
		$this->t_silas_inop = "";
		$this->t_sillas = "";
		$this->t_aires_ope = "";
		$this->t_aires_inop = "";
		$this->t_aires = "";

		$this->estado_name = null;
		$this->municipio_name = null;
		$this->parroquia_name = null;
		$this->ciudad_name = null;

		
	}


	// public function getPacient(){ return PacientData::getById($this->pacient_id); }
	// public function getMedic(){ return MedicData::getById($this->medic_id); }
    // public function getStatus(){ return StatusData::getById($this->status_id); }
	


	public function add(){


		if ($this->estado != null){
			$estado_n = EstadoData::getById($this->estado);
			foreach($estado_n as $p):
				$this->estado_name = $p['estado'];
			endforeach;
		}	
		  
		if ($this->municipio != null){
			$municipio_n = MunicipioData::getById($this->municipio);
			foreach($municipio_n as $p):
				$this->municipio_name = $p['municipio'];
			endforeach;
		}

		if ($this->parroquia != null){
			$parroquia_n = ParroquiaData::getById($this->parroquia);
			foreach($parroquia_n as $p):
				$this->parroquia_name = $p['parroquia'];
			endforeach;
		}

		if ($this->ciudad != null){
			$ciudad_n = CiudadData::getById($this->ciudad);
			foreach($ciudad_n as $p):
				$this->ciudad_name = $p['ciudad'];
			endforeach;
		}
		

		$sql = "insert into infocentros (
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

			observacion) ";

		$sql .= "value (
			\"$this->cod\",
			\"$this->nombre\",
			\"$this->estatus\",
			\"$this->motivo_cierre\",
			\"$this->direccion\",
			\"$this->ciudad_name\",
			\"$this->estado_name\",
			\"$this->municipio_name\",
			\"$this->parroquia_name\",
			\"$this->n_circuito\",
			\"$this->tecno_internet\",
			\"$this->proveedor\",
			\"$this->perso_contacto\",
			\"$this->telef_contacto\",
			\"$this->f_instalacion\",
			\"$this->estatus_op\",
			\"$this->transferido\",
			\"$this->central_dlci\",
			\"$this->migrado\",
			\"$this->cod_gerencia\",

			\"$this->espacio_inst\",
			\"$this->grupos_etnicos\",
			\"$this->tipo_zona\",
			\"$this->municipio_fronterizo\",
			\"$this->limite_fronterizo\",

			\"$this->observacion\")";

		return Executor::doit($sql);
	}



	public static function delById($id){
		$sql = "delete from ".self::$tablename." where id=$id";
		Executor::doit($sql);
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where id=$this->id";
		return ExecutorPg::setSql($sql);
	}



	public function update(){
		$sql = "UPDATE ".self::$tablename." set 
		estado='$this->estado', 
		code_info='$this->code_info', 
		desc_pc='$this->desc_pc', 
		t_pc_asig='$this->t_pc_asig', 
		t_pc_ope='$this->t_pc_ope', 
		t_pc_inope='$this->t_pc_inope', 
		causa_pc_inop='$this->causa_pc_inop', 
		desc_impresora='$this->desc_impresora', 
		t_impresora='$this->t_impresora', 
		t_imp_ope='$this->t_imp_ope', 
		t_imp_inop='$this->t_imp_inop', 
		t_escrit_ope='$this->t_escrit_ope', 
		t_escrit_inop='$this->t_escrit_inop', 
		t_escrit='$this->t_escrit', 
		t_sillas_ope='$this->t_sillas_ope', 
		t_silas_inop='$this->t_silas_inop', 
		t_sillas='$this->t_sillas', 
		t_aires_ope='$this->t_aires_ope', 
		t_aires_inop='$this->t_aires_inop', 
		t_aires='$this->t_aires' 
		where id=$this->id";
		
		return Executor::doit($sql);
	}

	public function updatePgXLSX()
	{
		$sql = "UPDATE ".self::$tablename." SET
		estado = ?, 
		code_info = ?, 
		desc_pc = ?, 
		t_pc_asig = ?, 
		t_pc_ope = ?, 
		t_pc_inope = ?, 
		causa_pc_inop = ?, 
		desc_impresora = ?, 
		t_impresora = ?, 
		t_imp_ope = ?, 
		t_imp_inop = ?, 
		causa_imp_inop = ?,
		desc_fotocopiadora = ?,
		t_fotocopiadora = ?,
		t_fotoc_ope = ?,
		t_fotoc_inop = ?,
		causa_fotoc_inop = ?,
		desc_video = ?,
		t_video = ?,
		estado_video = ?,
		causa_video_inop = ?,
		desc_scanner = ?,
		t_scanner = ?,
		estado_scan = ?,
		causa_scan_inop = ?,
		t_escrit_ope = ?, 
		t_escrit_inop = ?, 
		t_escrit = ?, 
		t_sillas_ope = ?, 
		t_silas_inop = ?, 
		t_sillas = ?, 
		t_aires_ope = ?, 
		t_aires_inop = ?, 
		t_aires = ? 
		where id = ?";
		$values = [
			$this->estado, 
			$this->code_info, 
			$this->desc_pc, 
			$this->t_pc_asig, 
			$this->t_pc_ope, 
			$this->t_pc_inope, 
			$this->causa_pc_inop, 
			$this->desc_impresora, 
			$this->t_impresora, 
			$this->t_imp_ope, 
			$this->t_imp_inop, 
			$this->causa_imp_inop,
			$this->desc_fotocopiadora,
			$this->t_fotocopiadora,
			$this->t_fotoc_ope,
			$this->t_fotoc_inop,
			$this->causa_fotoc_inop,
			$this->desc_video,
			$this->t_video,
			$this->estado_video,
			$this->causa_video_inop,
			$this->desc_scanner,
			$this->t_scanner,
			$this->estado_scan,
			$this->causa_scan_inop,
			$this->t_escrit_ope, 
			$this->t_escrit_inop, 
			$this->t_escrit, 
			$this->t_sillas_ope, 
			$this->t_silas_inop, 
			$this->t_sillas, 
			$this->t_aires_ope, 
			$this->t_aires_inop, 
			$this->t_aires,
			$this->id
		];
		//echo($this->id);
		ExecutorPg::update($sql, $values);
	}


	
	public static function getById($id)
	{
		$sql = "select * from " . self::$tablename . " where id=$id";
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
	
	public static function getByCode($cod){

		// POSTGRES DISTINGUE LAS MAYUSCULAS DE LA MINUSCULAS
		$code_info = trim(strtoupper($cod));

		$sql = "select * from ".self::$tablename." where code_info='$code_info'";
		$query = ExecutorPg::doit($sql);
		// return ModelPg::one($query[0][0],new InfoInventoryData());
		$array = ModelPg::one($query[0][0], new InfoInventoryData());
		if ($array->id == "") {
			return "null";
		} else {
			return $array;
		}
	}


	public static function getByKinfo($cod){

		// POSTGRES DISTINGUE LAS MAYUSCULAS DE LA MINUSCULAS
		$k_info = trim(strtoupper($cod));

		$sql = "select * from ".self::$tablename." where k_info='$k_info'";
		$query = ExecutorPg::doit($sql);
		// return ModelPg::one($query[0][0],new InfoInventoryData());
		$array = ModelPg::one($query[0][0], new InfoInventoryData());
		if ($array->id == "") {
			return "null";
		} else {
			return $array;
		}
	}


	public static function getAll(){
		$sql = "select * from ".self::$tablename." order by id desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new InfoInventoryData());
	}

	public static function getAllPendings(){
		$sql = "select * from ".self::$tablename." where date(date_at)>=date(NOW()) and status_id=1 and payment_id=1 order by date_at";
		$query = Executor::doit($sql);
		return Model::many($query[0],new InfoInventoryData());
	}

	public static function getBySQL($sql){
		$query = Executor::doit($sql);
		return Model::many($query[0],new InfoInventoryData());
	}

	public static function getOld(){
		$sql = "select * from ".self::$tablename." where date(date_at)<date(NOW()) order by date_at";
		$query = Executor::doit($sql);
		return Model::many($query[0],new InfoInventoryData());
	}
	
	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where title like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new InfoInventoryData());
	}


	public static function getStateByCode($id){
		$name = "";
		$con = Database::getCon();
		$query = $con->query("select estado from ".self::$tablename." where cod=\"$id \"");
		
		while($res = mysqli_fetch_array($query)){
			$resul[] = $res;
		  }
	
		// foreach($resul as $p):
		// 	$name.= $p['estado'];
		// endforeach;
	
		return $resul;
	}

}

?>