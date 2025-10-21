<?php
 #[AllowDynamicProperties]

class InfoProcessData {
	public static $tablename = "info_process";


	public function __construct(){
		$this->id = "";
		$this->estado = "";
		$this->code_info = "";
		$this->diverciencia = "";
		$this->exp_significativa = "";
		$this->robotica = "";
		$this->minmujer = "";
		$this->cienti_tecn = "";
		$this->PNUD = "";
		$this->mapa_tec = "";
		$this->encuesta = "";
		$this->plan_4x4 = "";
		$this->inaugu_4x4 = "";
		$this->plan_conuco = "";

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
		Executor::doit($sql);
	}



	public function update(){
		$sql = "UPDATE ".self::$tablename." set 
		estado='$this->estado', 
		code_info='$this->code_info', 
		diverciencia='$this->diverciencia', 
		exp_significativa='$this->exp_significativa', 
		robotica='$this->robotica', 
		minmujer='$this->minmujer', 
		cienti_tecn='$this->cienti_tecn', 
		PNUD='$this->PNUD', 
		mapa_tec='$this->mapa_tec', 
		encuesta='$this->encuesta', 
		plan_4x4='$this->plan_4x4', 
		inaugu_4x4='$this->inaugu_4x4', 
		plan_conuco='$this->plan_conuco' 
		where id=$this->id";
		return Executor::doit($sql);
	}


	public function updatePgXLSX()
	{
		$sql = "UPDATE ".self::$tablename." SET
		estado = ?, 
		code_info = ?, 
		diverciencia = ?, 
		exp_significativa = ?, 
		robotica = ?, 
		minmujer = ?, 
		cienti_tecn = ?, 
		pnud = ?, 
		mapa_tec = ?, 
		encuesta = ?, 
		plan_4x4 = ?, 
		inaugu_4x4 = ?, 
		plan_conuco = ? 
		where id = ?";
		$values = [
			$this->estado, 
			$this->code_info, 
			$this->diverciencia, 
			$this->exp_significativa, 
			$this->robotica, 
			$this->minmujer, 
			$this->cienti_tecn, 
			$this->PNUD, 
			$this->mapa_tec, 
			$this->encuesta, 
			$this->plan_4x4, 
			$this->inaugu_4x4, 
			$this->plan_conuco,
			$this->id
		];
		//echo($this->id);
		ExecutorPg::update($sql, $values);
	}


	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new InfoProcessData());
	}
	
	
	public static function getByCode($cod){

		// POSTGRES DISTINGUE LAS MAYUSCULAS DE LA MINUSCULAS
		$code_info = trim(strtoupper($cod));

		$sql = "select * from ".self::$tablename." where code_info='$code_info'";
		$query = ExecutorPg::doit($sql);
		// return ModelPg::one($query[0][0],new InfoInventoryData());
		$array = ModelPg::one($query[0][0], new InfoProcessData());
		if ($array->id == "") {
			return "null";
		} else {
			return $array;
		}
	}


	public static function getAll(){
		$sql = "select * from ".self::$tablename." order by id desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new InfoProcessData());
	}

	public static function getAllPendings(){
		$sql = "select * from ".self::$tablename." where date(date_at)>=date(NOW()) and status_id=1 and payment_id=1 order by date_at";
		$query = Executor::doit($sql);
		return Model::many($query[0],new InfoProcessData());
	}

	public static function getBySQL($sql){
		$query = Executor::doit($sql);
		return Model::many($query[0],new InfoProcessData());
	}

	public static function getOld(){
		$sql = "select * from ".self::$tablename." where date(date_at)<date(NOW()) order by date_at";
		$query = Executor::doit($sql);
		return Model::many($query[0],new InfoProcessData());
	}
	
	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where title like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new InfoProcessData());
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