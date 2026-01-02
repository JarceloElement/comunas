<?php
class SocialMapStudentsData {
	public static $tablename = "info_social_map_educations";


	public function __construct(){
		$this->user_id = "";
		$this->school_id = "";
		$this->code_info = "";
		$this->s_state = "";
		$this->school_type = "";
		$this->school_name = "";
		$this->school_address = "";
		$this->dea_code = "";
		$this->school_n_students = "";
		$this->school_n_students_female = "";
		$this->school_n_students_male = "";
		$this->user_name_os = "";
	}


	public function add(){
		$sql = "INSERT into info_social_map_educations (
        user_id,
        school_id, 
        code_info, 
        s_state, 
        school_type, 
        school_name, 
        school_address, 
        dea_code, 
        school_n_students, 
        school_n_students_female, 
        school_n_students_male, 
        user_name_os) ";
		$sql .= "value (
        \"$this->user_id\", 
        \"$this->school_id\", 
        \"$this->code_info\", 
        \"$this->s_state\", 
        \"$this->school_type\", 
        \"$this->school_name\", 
        \"$this->school_address\", 
        \"$this->dea_code\", 
        \"$this->school_n_students\", 
        \"$this->school_n_students_female\", 
        \"$this->school_n_students_male\", 
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

// partiendo de que ya tenemos creado un objecto SocialMapStudentsData previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." 
        set user_id=\"$this->user_id\",
        school_id=\"$this->school_id\",
        code_info=\"$this->code_info\",
        s_state=\"$this->s_state\",
        school_type=\"$this->school_type\",
        school_name='$this->school_name',
        school_address='$this->school_address',
        dea_code=\"$this->dea_code\",
        school_n_students=\"$this->school_n_students\",
        school_n_students_female=\"$this->school_n_students_female\",
        school_n_students_male=\"$this->school_n_students_male\",
        user_name_os=\"$this->user_name_os\"
        where id=$this->id";
		Executor::doit($sql);
	}

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new SocialMapStudentsData());
	}

    public static function getByInfo($code_info){
		$sql = "select * from ".self::$tablename." where code_info=$code_info";
		$query = Executor::doit($sql);
		return Model::one($query[0],new SocialMapStudentsData());
	}

    public static function getBySchool($code_info,$school_id){
		$sql = "select * from ".self::$tablename." where code_info=$code_info and school_id=$school_id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new SocialMapStudentsData());
	}

	public static function getAll(){
		$sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new SocialMapStudentsData());

	}
	
	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where name like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SocialMapStudentsData());
	}

	public static function getBySQL($sql){
		$query = Executor::doit($sql);
		return Model::many($query[0],new SocialMapStudentsData());
	}


}

?>