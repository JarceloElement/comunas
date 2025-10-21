<?php
class CoordinatorsData {
	public static $tablename = "coordinators";


	public function __construct(){
		$this->id = "";
		$this->name = "";
		$this->lastname = "";
		$this->document_number = "";
        $this->phone_number = "";
        $this->genero = "";
        $this->email = "";
        $this->coordination = "";
        $this->status_nom = "";
        $this->personal_type = "";
        $this->birthdate = "";
        $this->date_admission = "";
		$this->estate = null;
		$this->municipality = null;
        $this->parish = null;
		$this->observations = null;

		
	}

	public function add(){

        
        if ($this->coordination != null){
			$coord = CoordTypeData::getNameById($this->coordination);
			foreach($coord as $p):
				$this->coord_name = $p['name'];
			endforeach;
        }

        if ($this->estate != null){
			$estado_n = EstadoData::getById($this->estate);
			foreach($estado_n as $p):
				$this->estado_name = $p['estado'];
			endforeach;
		}	
		  
		if ($this->municipality != null){
			$municipio_n = MunicipioData::getById($this->municipality);
			foreach($municipio_n as $p):
				$this->municipio_name = $p['municipio'];
			endforeach;
		}

		if ($this->parish != null){
			$parroquia_n = ParroquiaData::getById($this->parish);
			foreach($parroquia_n as $p):
				$this->parroquia_name = $p['parroquia'];
			endforeach;
		}

		// if ($this->ciudad != null){
		// 	$ciudad_n = CiudadData::getById($this->ciudad);
		// 	foreach($ciudad_n as $p):
		// 		$this->ciudad_name = $p['ciudad'];
		// 	endforeach;
		// }
        
        

        $sql = "insert into coordinators
         (name,
         lastname,
         document_number,
         phone_number,
         gender,
         email,
         coordination,
         status_nom,
         personal_type,
         birthdate,
         date_admission,
         estate,
         municipality,
         parish,
         observations ) ";
        $sql .= "value (
            \"$this->name\",
            \"$this->lastname\",
            \"$this->document_number\",
            \"$this->phone_number\",
            \"$this->gender\",
            \"$this->email\",
            \"$this->coord_name\",
            \"$this->status_nom\",
            \"$this->personal_type\",
            \"$this->birthdate\",
            \"$this->date_admission\",
            \"$this->estado_name\",
            \"$this->municipio_name\",
            \"$this->parroquia_name\",
            \"$this->observations\" )";
		return Executor::doit($sql);
	}



    
	public static function delById($id){
		$sql = "delete from ".self::$tablename." where id=$id";
		Executor::doit($sql);
    }
    

	public static function getNameById($id){
		$con = Database::getCon();
		$query = $con->query("select * from ".self::$tablename." where id=$id");
		
		while($res = mysqli_fetch_array($query)){
			$resul[] = $res;
		  }
	
		// foreach($resul as $p):
		// 	$html.= "<option value='".$p['id_municipio']."'>".$p['municipio']."</option>";
		// endforeach;
	
		// return $html;
		return $resul;
	}


	public function del(){
		$sql = "delete from ".self::$tablename." where id=$this->id";
		Executor::doit($sql);
	}

	public function update(){

		if ($this->estate >= 1 and $this->estate <= 100){
			$estado_n = EstadoData::getById($this->estate);
			foreach($estado_n as $p):
				$this->estado_name = $p['estado'];
			endforeach;
		}else{$this->estado_name = $this->estate;}	
		  

		if ($this->municipality >= 1 and $this->municipality <= 1000){
			$municipio_n = MunicipioData::getById($this->municipality);
			foreach($municipio_n as $p):
				$this->municipio_name = $p['municipio'];
			endforeach;
		}else{$this->municipio_name = $this->municipality;}	
		

		if ($this->parish >= 1 and $this->parish <= 1000){
			$parroquia_n = ParroquiaData::getById($this->parish);
			foreach($parroquia_n as $p):
				$this->parroquia_name = $p['parroquia'];
			endforeach;
		}else{$this->parroquia_name = $this->parish;}	
        

		if ($this->coordination >= 1 and $this->coordination <= 100){
			$coord = CoordTypeData::getNameById($this->coordination);
			foreach($coord as $p):
				$this->coord_name = $p['name'];
			endforeach;
		}else{$this->coord_name = $this->coordination;}

		$sql = "update coordinators set 
		name=\"$this->name\", 
		lastname=\"$this->lastname\", 
		document_number=\"$this->document_number\", 
		phone_number=\"$this->phone_number\", 
		gender=\"$this->gender\", 
		email=\"$this->email\", 
		coordination=\"$this->coord_name\", 
		status_nom=\"$this->status_nom\", 
		personal_type=\"$this->personal_type\", 
		birthdate=\"$this->birthdate\", 
		date_admission=\"$this->date_admission\", 
		estate=\"$this->estado_name\", 
		municipality=\"$this->municipio_name\", 
		parish=\"$this->parroquia_name\", 
		observations=\"$this->observations\" 
		
		where id=$this->id";
		
		return Executor::doit($sql);
	}

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new CoordinatorsData());
	}


	public static function getAll(){
		$sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new CoordinatorsData());

	}
	
	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where name like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new CoordinatorsData());
	}

	public static function getBySQL($sql){
		$query = Executor::doit($sql);
		return Model::many($query[0],new CoordinatorsData());
    }
    

	public static function getRepeated($document_number){
		$sql = "select * from ".self::$tablename." where document_number=\"$document_number\"";
		$query = Executor::doit($sql);
		return Model::one($query[0],new CoordinatorsData());
	}


}

?>