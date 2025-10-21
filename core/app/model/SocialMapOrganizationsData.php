<?php
class SocialMapOrganizationsData {
	public static $tablename = "info_social_map_organizations";


	public function __construct(){
		$this->user_id = "";
		$this->organization_id = "";
		$this->code_info = "";
		$this->o_state = "";
		$this->organization_type = "";
		$this->organization_connection_type = "";
		$this->organization_name = "";
		$this->organization_dni = "";
		$this->organization_map_ubication = "";
		$this->organization_limit_area = "";
		$this->organization_address = "";
		$this->organization_n_population = "";
		$this->organization_n_population_female = "";
		$this->organization_n_population_male = "";
		$this->user_name_os = "";
	}


	public function add(){
		$sql = "INSERT into info_social_map_organizations (
        user_id,
        organization_id, 
        code_info, 
        o_state, 
        organization_type, 
        organization_connection_type, 
        organization_name, 
        organization_dni, 
        organization_map_ubication, 
        organization_limit_area, 
        organization_address, 
        organization_n_population, 
        organization_n_population_female, 
        organization_n_population_male, 
        user_name_os) ";
		$sql .= "value (
        \"$this->user_id\", 
        \"$this->organization_id\", 
        \"$this->code_info\", 
        \"$this->o_state\", 
        \"$this->organization_type\", 
        \"$this->organization_connection_type\", 
        '$this->organization_name', 
        \"$this->organization_dni\", 
        \"$this->organization_map_ubication\", 
        \"$this->organization_limit_area\", 
        '$this->organization_address', 
        \"$this->organization_n_population\", 
        \"$this->organization_n_population_female\", 
        \"$this->organization_n_population_male\", 
        \"$this->user_name_os\"
        )";
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

// partiendo de que ya tenemos creado un objecto SocialMapOrganizationsData previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." 
        set user_id=\"$this->user_id\",
        organization_id=\"$this->organization_id\",
        code_info=\"$this->code_info\",
        o_state=\"$this->o_state\",
        organization_type=\"$this->organization_type\",
        organization_connection_type=\"$this->organization_connection_type\",
        organization_name='$this->organization_name',
        organization_dni=\"$this->organization_dni\",
        organization_map_ubication=\"$this->organization_map_ubication\",
        organization_limit_area=\"$this->organization_limit_area\",
        organization_address='$this->organization_address',
        organization_n_population=\"$this->organization_n_population\",
        organization_n_population_female=\"$this->organization_n_population_female\",
        organization_n_population_male=\"$this->organization_n_population_male\",
        user_name_os=\"$this->user_name_os\"
        where id=$this->id";
		Executor::doit($sql);
	}

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new SocialMapOrganizationsData());
	}

    public static function getByInfo($code_info){
		$sql = "select * from ".self::$tablename." where code_info=$code_info";
		$query = Executor::doit($sql);
		return Model::one($query[0],new SocialMapOrganizationsData());
	}

    public static function getBySchool($code_info,$school_id){
		$sql = "select * from ".self::$tablename." where code_info=$code_info and school_id=$school_id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new SocialMapOrganizationsData());
	}

	public static function getAll(){
		$sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new SocialMapOrganizationsData());

	}
	
	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where name like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SocialMapOrganizationsData());
	}

	public static function getBySQL($sql){
		$query = Executor::doit($sql);
		return Model::many($query[0],new SocialMapOrganizationsData());
	}


}

?>