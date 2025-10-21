<?php
 #[AllowDynamicProperties]

class InfoData {
	public static $tablename = "infocentros";


	public function __construct(){
		$this->id = "";
		$this->cod = "";
		$this->nombre = "";
		$this->estatus = "";
        $this->motivo_cierre = "";
		$this->direccion = "";
		$this->estado = null;
		$this->ciudad = null;
		$this->municipio = null;
		$this->parroquia = null;
		$this->n_circuito = "";
		$this->tecno_internet = "";
		$this->proveedor = "";
		$this->perso_contacto = "";
		$this->telef_contacto = "";
		$this->f_instalacion = "";
		$this->estatus_op = "";
		$this->transferido = "";
		$this->central_dlci = "";
		$this->migrado = "";
		$this->cod_gerencia = "";

		$this->espacio_inst = "";
		$this->grupos_etnicos = "";
		$this->tipo_zona = "";
		$this->municipio_fronterizo = "";
		$this->limite_fronterizo = "";

		


		$this->observacion = "";

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

// partiendo de que ya tenemos creado un objecto InfoData previamente utilizamos el contexto
	public function updatex(){
		$sql = "update ".self::$tablename." set title=\"$this->title\",pacient_id=\"$this->pacient_id\",medic_id=\"$this->medic_id\",date_at=\"$this->date_at\",time_at=\"$this->time_at\",note=\"$this->note\",sick=\"$this->sick\",symtoms=\"$this->symtoms\",medicaments=\"$this->medicaments\",status_id=\"$this->status_id\",payment_id=\"$this->payment_id\",price=\"$this->price\" where id=$this->id";
		Executor::doit($sql);
	}



	public function update(){
		if ($this->estado >= 1 and $this->estado <= 100){
			$estado_n = EstadoData::getById($this->estado);
			foreach($estado_n as $p):
				$this->estado_name = $p['estado'];
			endforeach;
		}else{$this->estado_name = $this->estado;}	
		  

		if ($this->municipio >= 1 and $this->municipio <= 1000){
			$municipio_n = MunicipioData::getById($this->municipio);
			foreach($municipio_n as $p):
				$this->municipio_name = $p['municipio'];
			endforeach;
		}else{$this->municipio_name = $this->municipio;}	
		

		if ($this->parroquia >= 1 and $this->parroquia <= 1000){
			$parroquia_n = ParroquiaData::getById($this->parroquia);
			foreach($parroquia_n as $p):
				$this->parroquia_name = $p['parroquia'];
			endforeach;
		}else{$this->parroquia_name = $this->parroquia;}	
		
		
		if ($this->ciudad >= 1 and $this->ciudad <= 1000){
			$ciudad_n = CiudadData::getById($this->ciudad);
			foreach($ciudad_n as $p):
				$this->ciudad_name = $p['ciudad'];
			endforeach;
		}else{$this->ciudad_name = $this->ciudad;}	
		
		
		$sql = "update infocentros set 
		cod=\"$this->cod\", 
		nombre=\"$this->nombre\", 
		estatus=\"$this->estatus\", 
		motivo_cierre=\"$this->motivo_cierre\", 
		direccion=\"$this->direccion\", 
		ciudad=\"$this->ciudad_name\", 
		estado=\"$this->estado_name\", 
		municipio=\"$this->municipio_name\", 
		parroquia=\"$this->parroquia_name\", 
		n_circuito=\"$this->n_circuito\", 
		tecno_internet=\"$this->tecno_internet\", 
		proveedor=\"$this->proveedor\", 
		perso_contacto=\"$this->perso_contacto\", 
		telef_contacto=\"$this->telef_contacto\", 
		f_instalacion=\"$this->f_instalacion\", 
		estatus_op=\"$this->estatus_op\", 
		transferido=\"$this->transferido\", 
		central_dlci=\"$this->central_dlci\", 
		migrado=\"$this->migrado\", 
		cod_gerencia=\"$this->cod_gerencia\", 

		espacio_inst=\"$this->espacio_inst\", 
		grupos_etnicos=\"$this->grupos_etnicos\", 
		tipo_zona=\"$this->tipo_zona\", 
		municipio_fronterizo=\"$this->municipio_fronterizo\", 
		limite_fronterizo=\"$this->limite_fronterizo\", 

		observacion=\"$this->observacion\" 
		
		where id=$this->id";
		
		return Executor::doit($sql);
	}



	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new InfoData());
	}

	
	public static function getByEstado($estado){
		$sql = "select * from ".self::$tablename." where estado=\"$estado\"";
		$query = Executor::doit($sql);
		return Model::many($query[0],new InfoData());

	}

	public static function getByMunicipio($munic){
		$sql = "select * from ".self::$tablename." where municipio=\"$munic\"";
		$query = Executor::doit($sql);
		return Model::many($query[0],new InfoData());

	}

	public static function getByParroquia($parro){
		$sql = "select * from ".self::$tablename." where parroquia=\"$parro\"";
		$query = Executor::doit($sql);
		return Model::many($query[0],new InfoData());

	}
	
	public static function getByCode($cod){
		$sql = "select * from ".self::$tablename." where cod=\"$cod\"";
		$query = Executor::doit($sql);
		return Model::one($query[0],new InfoData());
	}


	public static function getRepeated($cod,$nombre){
		$sql = "select * from ".self::$tablename." where cod=\"$cod\" and nombre=\"$nombre\"";
		$query = Executor::doit($sql);
		return Model::one($query[0],new InfoData());
	}



	public static function getByMail($mail){
		$sql = "select * from ".self::$tablename." where mail=\"$mail\"";
		$query = Executor::doit($sql);
		return Model::one($query[0],new InfoData());
	}

	public static function getEvery(){
		$sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new InfoData());
	}


	public static function getAll(){
		$sql = "select * from ".self::$tablename." order by f_registro desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new InfoData());
	}

	public static function getAllPendings(){
		$sql = "select * from ".self::$tablename." where date(date_at)>=date(NOW()) and status_id=1 and payment_id=1 order by date_at";
		$query = Executor::doit($sql);
		return Model::many($query[0],new InfoData());
	}


	public static function getAllByPacientId($id){
		$sql = "select * from ".self::$tablename." where pacient_id=$id order by date_at";
		$query = Executor::doit($sql);
		return Model::many($query[0],new InfoData());
	}

	public static function getAllByMedicId($id){
		$sql = "select * from ".self::$tablename." where medic_id=$id order by date_at";
		$query = Executor::doit($sql);
		return Model::many($query[0],new InfoData());
	}

	public static function getBySQL($sql){
		$query = Executor::doit($sql);
		return Model::many($query[0],new InfoData());
	}

	public static function getOld(){
		$sql = "select * from ".self::$tablename." where date(date_at)<date(NOW()) order by date_at";
		$query = Executor::doit($sql);
		return Model::many($query[0],new InfoData());
	}
	
	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where title like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new InfoData());
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