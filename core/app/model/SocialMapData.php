<?php
class SocialMapData
{
	public static $tablename = "info_social_map";

	// Declare all properties used in the class
	public $id;
	public $user_id;
	public $user_type;
	public $progress;
	public $progress_percent;
	public $info_state;
	public $code_info;
	public $responsability_email;
	public $communes_quantity;
	public $c_comunal_quantity;
	public $other_organizations;
	public $other_organizations_related_to_info;
	public $organizations_activities_on_info;
	public $ventures_around_info;
	public $info_support_to_entrepreneurship;
	public $are_educational_institutions;
	public $info_support_to_educational_institutions;
	public $community_potentials;
	public $families_around_the_info;
	public $population_around_the_info;
	public $boy_around_the_info_0_3_age;
	public $boy_around_the_info_4_7_age;
	public $boy_around_the_info_8_11_age;
	public $teenagers_boy_around_the_info_12_15_age;
	public $youths_boy_around_the_info_16_19_age;
	public $youths_boy_around_the_info_20_23_age;
	public $youths_boy_around_the_info_24_27_age;
	public $youths_boy_around_the_info_28_31_age;
	public $adult_boy_around_the_info_32_35_age;
	public $adult_boy_around_the_info_36_39_age;
	public $adult_boy_around_the_info_40_59_age;
	public $elderman_around_the_info_60_120_age;
	public $girl_around_the_info_0_3_age;
	public $girl_around_the_info_4_7_age;
	public $girl_around_the_info_8_11_age;

	public $teenagers_girl_around_the_info_12_15_age = "";
	public $youths_girl_around_the_info_16_19_age = "";
	public $youths_girl_around_the_info_20_23_age = "";
	public $youths_girl_around_the_info_24_27_age = "";
	public $youths_girl_around_the_info_28_31_age = "";
	public $adult_girl_around_the_info_32_35_age = "";
	public $adult_girl_around_the_info_36_39_age = "";
	public $adult_girl_around_the_info_40_59_age = "";
	public $elderwoman_around_the_info_60_120_age = "";
	public $childrens_w_disability = "";
	public $major_internet_provider = "";
	public $other_internet_provider = "";
	public $in_wifi_communities_project = "";
	public $wifi_communities_project_benefited_people = "";
	public $public_schools = "";
	public $private_schools = "";
	public $n_iphone = "";
	public $n_tablets = "";
	public $n_canaimitas = "";
	public $n_laptops = "";
	public $n_pc = "";
	public $n_home_w_internet = "";
	public $user_name_os = "";


	public function __construct()
	{
		$this->user_id = "";
		$this->user_type = "";
		$this->progress = "";
		$this->progress_percent = "";
		$this->info_state = "";
		$this->code_info = "";
		$this->responsability_email = "";
		$this->communes_quantity = "";
		$this->c_comunal_quantity = "";
		$this->other_organizations = "";
		$this->other_organizations_related_to_info = "";
		$this->organizations_activities_on_info = "";
		$this->ventures_around_info = "";
		$this->info_support_to_entrepreneurship = "";
		$this->are_educational_institutions = "";
		$this->info_support_to_educational_institutions = "";
		$this->community_potentials = "";
		$this->families_around_the_info = "";
		$this->population_around_the_info = "";
		$this->boy_around_the_info_0_3_age = "";
		$this->boy_around_the_info_4_7_age = "";
		$this->boy_around_the_info_8_11_age = "";
		$this->teenagers_boy_around_the_info_12_15_age = "";
		$this->youths_boy_around_the_info_16_19_age = "";
		$this->youths_boy_around_the_info_20_23_age = "";
		$this->youths_boy_around_the_info_24_27_age = "";
		$this->youths_boy_around_the_info_28_31_age = "";
		$this->adult_boy_around_the_info_32_35_age = "";
		$this->adult_boy_around_the_info_36_39_age = "";
		$this->adult_boy_around_the_info_40_59_age = "";
		$this->elderman_around_the_info_60_120_age = "";
		$this->girl_around_the_info_0_3_age = "";
		$this->girl_around_the_info_4_7_age = "";
		$this->girl_around_the_info_8_11_age = "";
		$this->teenagers_girl_around_the_info_12_15_age = "";
		$this->youths_girl_around_the_info_16_19_age = "";
		$this->youths_girl_around_the_info_20_23_age = "";
		$this->youths_girl_around_the_info_24_27_age = "";
		$this->youths_girl_around_the_info_28_31_age = "";
		$this->adult_girl_around_the_info_32_35_age = "";
		$this->adult_girl_around_the_info_36_39_age = "";
		$this->adult_girl_around_the_info_40_59_age = "";
		$this->elderwoman_around_the_info_60_120_age = "";
		$this->childrens_w_disability = "";
		$this->major_internet_provider = "";
		$this->other_internet_provider = "";
		$this->in_wifi_communities_project = "";
		$this->wifi_communities_project_benefited_people = "";
		$this->public_schools = "";
		$this->private_schools = "";
		$this->n_iphone = "";
		$this->n_tablets = "";
		$this->n_canaimitas = "";
		$this->n_laptops = "";
		$this->n_pc = "";
		$this->n_home_w_internet = "";
		$this->user_name_os = "";
	}



	public function add()
	{


		$sql = "INSERT into info_social_map (
		user_id, 
		user_type, 
		progress, 
		progress_percent, 
        info_state, 
        code_info, 
		responsability_email, 
		communes_quantity,
		c_comunal_quantity, 
		other_organizations, 
		other_organizations_related_to_info, 
		organizations_activities_on_info, 
		ventures_around_info, 
		info_support_to_entrepreneurship, 
		are_educational_institutions, 
		info_support_to_educational_institutions, 
		community_potentials, 
		families_around_the_info, 
		population_around_the_info, 
		boy_around_the_info_0_3_age, 
		boy_around_the_info_4_7_age, 
		boy_around_the_info_8_11_age,
		teenagers_boy_around_the_info_12_15_age,
		youths_boy_around_the_info_16_19_age,
		youths_boy_around_the_info_20_23_age,
		youths_boy_around_the_info_24_27_age,
		youths_boy_around_the_info_28_31_age,
		adult_boy_around_the_info_32_35_age,
		adult_boy_around_the_info_36_39_age,
		adult_boy_around_the_info_40_59_age,
		elderman_around_the_info_60_120_age,
		girl_around_the_info_0_3_age,
		girl_around_the_info_4_7_age,
		girl_around_the_info_8_11_age,
		teenagers_girl_around_the_info_12_15_age,
		youths_girl_around_the_info_16_19_age,
		youths_girl_around_the_info_20_23_age,
		youths_girl_around_the_info_24_27_age,
		youths_girl_around_the_info_28_31_age,
		adult_girl_around_the_info_32_35_age,
		adult_girl_around_the_info_36_39_age,
		adult_girl_around_the_info_40_59_age,
		elderwoman_around_the_info_60_120_age,
		childrens_w_disability,
		major_internet_provider,
		other_internet_provider,
		in_wifi_communities_project,
		wifi_communities_project_benefited_people,
		public_schools,
		private_schools,
		n_iphone,
		n_tablets,
		n_canaimitas,
		n_laptops,
		n_pc,
		n_home_w_internet,
		user_name_os
		) ";
		$sql .= "value (
		\"$this->user_id\",
		\"$this->user_type\",
		\"$this->progress\",
		\"$this->progress_percent\",
		\"$this->info_state\",
		\"$this->code_info\",
		\"$this->responsability_email\",
		\"$this->communes_quantity\",
		\"$this->c_comunal_quantity\",
		\"$this->other_organizations\",
		\"$this->other_organizations_related_to_info\",
		\"$this->organizations_activities_on_info\",
		\"$this->ventures_around_info\",
		\"$this->info_support_to_entrepreneurship\",
		\"$this->are_educational_institutions\",
		\"$this->info_support_to_educational_institutions\",
		\"$this->community_potentials\",
		\"$this->families_around_the_info\",
		\"$this->population_around_the_info\",
		\"$this->boy_around_the_info_0_3_age\",
		\"$this->boy_around_the_info_4_7_age\",
		\"$this->boy_around_the_info_8_11_age\",
		\"$this->teenagers_boy_around_the_info_12_15_age\",
		\"$this->youths_boy_around_the_info_16_19_age\",
		\"$this->youths_boy_around_the_info_20_23_age\",
		\"$this->youths_boy_around_the_info_24_27_age\",
		\"$this->youths_boy_around_the_info_28_31_age\",
		\"$this->adult_boy_around_the_info_32_35_age\",
		\"$this->adult_boy_around_the_info_36_39_age\",
		\"$this->adult_boy_around_the_info_40_59_age\",
		\"$this->elderman_around_the_info_60_120_age\",
		\"$this->girl_around_the_info_0_3_age\",
		\"$this->girl_around_the_info_4_7_age\",
		\"$this->girl_around_the_info_8_11_age\",
		\"$this->teenagers_girl_around_the_info_12_15_age\",
		\"$this->youths_girl_around_the_info_16_19_age\",
		\"$this->youths_girl_around_the_info_20_23_age\",
		\"$this->youths_girl_around_the_info_24_27_age\",
		\"$this->youths_girl_around_the_info_28_31_age\",
		\"$this->adult_girl_around_the_info_32_35_age\",
		\"$this->adult_girl_around_the_info_36_39_age\",
		\"$this->adult_girl_around_the_info_40_59_age\",
		\"$this->elderwoman_around_the_info_60_120_age\",
		\"$this->childrens_w_disability\",
		\"$this->major_internet_provider\",
		\"$this->other_internet_provider\",
		\"$this->in_wifi_communities_project\",
		\"$this->wifi_communities_project_benefited_people\",
		\"$this->public_schools\",
		\"$this->private_schools\",
		\"$this->n_iphone\",
		\"$this->n_tablets\",
		\"$this->n_canaimitas\",
		\"$this->n_laptops\",
		\"$this->n_pc\",
		\"$this->n_home_w_internet\",
		\"$this->user_name_os\"
		)";
		return Executor::doit($sql);
	}

	public static function delById($id)
	{
		$sql = "delete from " . self::$tablename . " where id=$id";
		Executor::doit($sql);
	}
	public function del()
	{
		$sql = "delete from " . self::$tablename . " where id=$this->id";
		Executor::doit($sql);
	}

	// public function delByIdActivity()
	// {
	// 	$sql = "delete from " . self::$tablename . " where id_activity=$this->id_activity";
	// 	Executor::doit($sql);
	// }

	// public function delByIdActivity($id){
	// 	$con = Database::getCon();
	// 	$query = "delete from ".self::$tablename." where id_activity=$id";
	// 	return $query;
	// }


	public function update()
	{

		$sql = "UPDATE " . self::$tablename . " set 
		user_id=\"$this->user_id\",
		user_type=\"$this->user_type\",
		progress=\"$this->progress\",
		progress_percent=\"$this->progress_percent\",
		info_state=\"$this->info_state\",
		code_info=\"$this->code_info\",
		responsability_email=\"$this->responsability_email\",
		communes_quantity=\"$this->communes_quantity\",
		c_comunal_quantity=\"$this->c_comunal_quantity\",
		other_organizations=\"$this->other_organizations\",
		other_organizations_related_to_info=\"$this->other_organizations_related_to_info\",
		organizations_activities_on_info=\"$this->organizations_activities_on_info\",
		ventures_around_info=\"$this->ventures_around_info\",
		info_support_to_entrepreneurship=\"$this->info_support_to_entrepreneurship\",
		are_educational_institutions=\"$this->are_educational_institutions\",
		info_support_to_educational_institutions=\"$this->info_support_to_educational_institutions\",
		community_potentials=\"$this->community_potentials\",
		families_around_the_info=\"$this->families_around_the_info\",
		population_around_the_info=\"$this->population_around_the_info\",
		boy_around_the_info_0_3_age=\"$this->boy_around_the_info_0_3_age\",
		boy_around_the_info_4_7_age=\"$this->boy_around_the_info_4_7_age\",
		boy_around_the_info_8_11_age=\"$this->boy_around_the_info_8_11_age\",
		teenagers_boy_around_the_info_12_15_age=\"$this->teenagers_boy_around_the_info_12_15_age\",
		youths_boy_around_the_info_16_19_age=\"$this->youths_boy_around_the_info_16_19_age\",
		youths_boy_around_the_info_20_23_age=\"$this->youths_boy_around_the_info_20_23_age\",
		youths_boy_around_the_info_24_27_age=\"$this->youths_boy_around_the_info_24_27_age\",
		youths_boy_around_the_info_28_31_age=\"$this->youths_boy_around_the_info_28_31_age\",
		adult_boy_around_the_info_32_35_age=\"$this->adult_boy_around_the_info_32_35_age\",
		adult_boy_around_the_info_36_39_age=\"$this->adult_boy_around_the_info_36_39_age\",
		adult_boy_around_the_info_40_59_age=\"$this->adult_boy_around_the_info_40_59_age\",
		elderman_around_the_info_60_120_age=\"$this->elderman_around_the_info_60_120_age\",
		girl_around_the_info_0_3_age=\"$this->girl_around_the_info_0_3_age\",
		girl_around_the_info_4_7_age=\"$this->girl_around_the_info_4_7_age\",
		girl_around_the_info_8_11_age=\"$this->girl_around_the_info_8_11_age\",
		teenagers_girl_around_the_info_12_15_age=\"$this->teenagers_girl_around_the_info_12_15_age\",
		youths_girl_around_the_info_16_19_age=\"$this->youths_girl_around_the_info_16_19_age\",
		youths_girl_around_the_info_20_23_age=\"$this->youths_girl_around_the_info_20_23_age\",
		youths_girl_around_the_info_24_27_age=\"$this->youths_girl_around_the_info_24_27_age\",
		youths_girl_around_the_info_28_31_age=\"$this->youths_girl_around_the_info_28_31_age\",
		adult_girl_around_the_info_32_35_age=\"$this->adult_girl_around_the_info_32_35_age\",
		adult_girl_around_the_info_36_39_age=\"$this->adult_girl_around_the_info_36_39_age\",
		adult_girl_around_the_info_40_59_age=\"$this->adult_girl_around_the_info_40_59_age\",
		elderwoman_around_the_info_60_120_age=\"$this->elderwoman_around_the_info_60_120_age\",
		childrens_w_disability=\"$this->childrens_w_disability\",
		major_internet_provider=\"$this->major_internet_provider\",
		other_internet_provider=\"$this->other_internet_provider\",
		in_wifi_communities_project=\"$this->in_wifi_communities_project\",
		wifi_communities_project_benefited_people=\"$this->wifi_communities_project_benefited_people\",
		public_schools=\"$this->public_schools\",
		private_schools=\"$this->private_schools\",
		n_iphone=\"$this->n_iphone\",
		n_tablets=\"$this->n_tablets\",
		n_canaimitas=\"$this->n_canaimitas\",
		n_laptops=\"$this->n_laptops\",
		n_pc=\"$this->n_pc\",
		n_home_w_internet=\"$this->n_home_w_internet\",
		user_name_os=\"$this->user_name_os\"
		where id=$this->id";
		Executor::doit($sql);
	}

	public static function getById($id)
	{
		$sql = "select * from " . self::$tablename . " where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0], new SocialMapData());
	}

	public static function getByInfo($code_info)
	{
		$sql = "select * from " . self::$tablename . " where code_info=$code_info";
		$query = Executor::doit($sql);
		return Model::one($query[0], new SocialMapData());
	}

	public static function getByUserId($id)
	{
		$sql = "select * from " . self::$tablename . " where user_id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0], new SocialMapData());
	}


	public static function getByIdActivity($id)
	{
		$sql = "select * from " . self::$tablename . " where id_activity=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0], new SocialMapData());
	}


	public static function getNameById($id)
	{
		$con = Database::getCon();
		$query = $con->query("select * from " . self::$tablename . " where id=$id");

		while ($res = mysqli_fetch_array($query)) {
			$resul[] = $res;
		}

		// foreach($resul as $p):
		// 	$html.= "<option value='".$p['id_municipio']."'>".$p['municipio']."</option>";
		// endforeach;

		// return $html;
		return $resul;
	}

	public static function getAll()
	{
		$sql = "select * from " . self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0], new SocialMapData());
	}

	public static function getLike($q)
	{
		$sql = "select * from " . self::$tablename . " where name like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0], new SocialMapData());
	}

	public static function getBySQL($sql)
	{
		$query = Executor::doit($sql);
		return Model::many($query[0], new SocialMapData());
	}

	public static function UpdateBySQL($sql)
	{
		$query = Executor::doit($sql);
	}

	public static function getRepeated($document_number)
	{
		$sql = "select * from " . self::$tablename . " where user_dni=\"$document_number\"";
		$query = Executor::doit($sql);
		return Model::one($query[0], new SocialMapData());
	}
}
