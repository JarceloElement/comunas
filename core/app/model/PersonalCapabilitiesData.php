<?php
#[AllowDynamicProperties]
class PersonalCapabilitiesData
{
	public static $tablename = "encuesta_capacidades_tecnologicas";

	public $user_id;
	public $user_type;
	public $personal_type;
	public $user_email;
	public $user_dni;
	public $user_name;
	public $user_lastname;
	public $user_phone;
	public $code_info;
	public $info_name;
	public $user_state;
	public $user_municipality;
	public $user_parish;
	public $user_zone_type;
	public $user_blender_user_skills;
	public $user_python_user_skills;
	public $user_stop_motion_skills;
	public $user_web_design_skills;
	public $user_wordpress_skills;
	public $user_html_skills;
	public $user_PHP_skills;
	public $user_blog_design_skills;
	public $user_digital_magazine_skills;
	public $user_digital_economy_skills;
	public $user_crypto_assets_skills;
	public $user_e_bank_patria_skills;
	public $user_e_commerce_skills;
	public $user_use_movile_devices_skills;
	public $user_technical_support_computers_devices_skills;
	public $user_technical_support_movile_devices_skills;
	public $user_network_technical_support_skills;
	public $user_social_media_management_skills;
	public $user_social_media_security_skills;
	public $user_imagen_design_skills;
	public $user_mobile_video_editing_skills;
	public $user_remote_communication_skills;
	public $user_libre_office_applications_skills;
	public $user_meme_creations_skills;
	public $user_presentations_creations_skills;
	public $user_accounting_books_skills;
	public $user_budget_cration_skills;
	public $user_strategic_planning_skills;
	public $user_project_elaboration_skills;
	public $user_collective_diagnosis_skills;
	public $user_situational_analysis_tecniques_skills;
	public $user_systematization_community_experiences_skills;
	public $user_content_assertive_organizational_communication_skills;
	public $user_robotics_skills;
	public $user_artificial_intelligence_skills;
	public $user_programming_skills;
	public $user_application_creation_skills;
	public $user_greater_technological_skill;
	public $user_greater_technological_skill_level;
	public $user_training_needs;
	public $user_other_training_needs;
	public $user_know_PNCT_MincCYT;
	public $user_potential_contribution_for_areas_PNCT;
	public $user_know_PNI_infocentro;
	public $user_potential_contribution_for_PNI_infocentro;
	public $knowledge_remote_learning;
	public $participation_virtual_training;
	public $experience_online_training;
	public $know_platform_aprendiendo_juntos;
	public $training_received_aprendiendo_juntos;
	public $interest_to_training_on_aprendiendo_juntos;
	public $know_benefits_online_training;
	public $suggestions_provided;
	public $user_name_os;
	public $date_update;

	public function __construct()
	{
		$this->user_id = "";
		$this->user_type = "";
		$this->personal_type = "";
		$this->user_email = "";
		$this->user_dni = "";
		$this->user_name = "";
		$this->user_lastname = "";
		$this->user_phone = "";
		$this->code_info = "";
		$this->info_name = "";
		$this->user_state = "";
		$this->user_municipality = "";
		$this->user_parish = "";
		$this->user_zone_type = "";
		$this->user_blender_user_skills = "";
		$this->user_python_user_skills = "";
		$this->user_stop_motion_skills = "";
		$this->user_web_design_skills = "";
		$this->user_wordpress_skills = "";
		$this->user_html_skills = "";
		$this->user_PHP_skills = "";
		$this->user_blog_design_skills = "";
		$this->user_digital_magazine_skills = "";
		$this->user_digital_economy_skills = "";
		$this->user_crypto_assets_skills = "";
		$this->user_e_bank_patria_skills = "";
		$this->user_e_commerce_skills = "";
		$this->user_use_movile_devices_skills = "";
		$this->user_technical_support_computers_devices_skills = "";
		$this->user_technical_support_movile_devices_skills = "";
		$this->user_network_technical_support_skills = "";
		$this->user_social_media_management_skills = "";
		$this->user_social_media_security_skills = "";
		$this->user_imagen_design_skills = "";
		$this->user_mobile_video_editing_skills = "";
		$this->user_remote_communication_skills = "";
		$this->user_libre_office_applications_skills = "";
		$this->user_meme_creations_skills = "";
		$this->user_presentations_creations_skills = "";
		$this->user_accounting_books_skills = "";
		$this->user_budget_cration_skills = "";
		$this->user_strategic_planning_skills = "";
		$this->user_project_elaboration_skills = "";
		$this->user_collective_diagnosis_skills = "";
		$this->user_situational_analysis_tecniques_skills = "";
		$this->user_systematization_community_experiences_skills = "";
		$this->user_content_assertive_organizational_communication_skills = "";
		$this->user_robotics_skills = "";
		$this->user_artificial_intelligence_skills = "";
		$this->user_programming_skills = "";
		$this->user_application_creation_skills = "";
		$this->user_greater_technological_skill = "";
		$this->user_greater_technological_skill_level = "";
		$this->user_training_needs = "";
		$this->user_other_training_needs = "";
		$this->user_know_PNCT_MincCYT = "";
		$this->user_potential_contribution_for_areas_PNCT = "";
		$this->user_know_PNI_infocentro = "";
		$this->user_potential_contribution_for_PNI_infocentro = "";

		$this->knowledge_remote_learning = "";
		$this->participation_virtual_training = "";
		$this->experience_online_training = "";
		$this->know_platform_aprendiendo_juntos = "";
		$this->training_received_aprendiendo_juntos = "";
		$this->interest_to_training_on_aprendiendo_juntos = "";
		$this->know_benefits_online_training = "";
		$this->suggestions_provided = "";


		$this->user_name_os = "";
		$this->date_update = "";
	}



	public function add()
	{


		$sql = "INSERT into personal_technological_capabilities (
		user_id, 
		user_type, 
		personal_type, 
		user_email, 
		user_dni, 
		user_name, 
		user_lastname, 
		user_phone, 
		code_info, 
		info_name, 
		user_state, 
		user_municipality, 
		user_parish, 
		user_zone_type, 
		user_blender_user_skills, 
		user_python_user_skills, 
		user_stop_motion_skills, 
		user_web_design_skills, 
		user_wordpress_skills, 
		user_html_skills, 
		user_PHP_skills, 
		user_blog_design_skills, 
		user_digital_magazine_skills, 
		user_digital_economy_skills, 
		user_crypto_assets_skills, 
		user_e_bank_patria_skills, 
		user_e_commerce_skills, 
		user_use_movile_devices_skills, 
		user_technical_support_computers_devices_skills, 
		user_technical_support_movile_devices_skills, 
		user_network_technical_support_skills, 
		user_social_media_management_skills, 
		user_social_media_security_skills, 
		user_imagen_design_skills, 
		user_mobile_video_editing_skills, 
		user_remote_communication_skills, 
		user_libre_office_applications_skills, 
		user_meme_creations_skills, 
		user_presentations_creations_skills, 
		user_accounting_books_skills, 
		user_budget_cration_skills, 
		user_strategic_planning_skills, 
		user_project_elaboration_skills, 
		user_collective_diagnosis_skills, 
		user_situational_analysis_tecniques_skills, 
		user_systematization_community_experiences_skills, 
		user_content_assertive_organizational_communication_skills, 
		user_robotics_skills, 
		user_artificial_intelligence_skills, 
		user_programming_skills, 
		user_application_creation_skills, 
		user_greater_technological_skill, 
		user_greater_technological_skill_level, 
		user_training_needs, 
		user_other_training_needs, 
		user_know_PNCT_MincCYT, 
		user_potential_contribution_for_areas_PNCT, 
		user_know_PNI_infocentro, 
		user_potential_contribution_for_PNI_infocentro, 
		knowledge_remote_learning, 
		participation_virtual_training, 
		experience_online_training, 
		know_platform_aprendiendo_juntos, 
		training_received_aprendiendo_juntos, 
		interest_to_training_on_aprendiendo_juntos, 
		know_benefits_online_training, 
		suggestions_provided, 
		user_name_os
		) ";
		$sql .= "value (
		\"$this->user_id\",
		\"$this->user_type\",
		\"$this->personal_type\",
		\"$this->user_email\",
		\"$this->user_dni\",
		\"$this->user_name\",
		\"$this->user_lastname\",
		\"$this->user_phone\",
		\"$this->code_info\",
		\"$this->info_name\",
		\"$this->user_state\",
		\"$this->user_municipality\",
		\"$this->user_parish\",
		\"$this->user_zone_type\",
		\"$this->user_blender_user_skills\",
		\"$this->user_python_user_skills\",
		\"$this->user_stop_motion_skills\",
		\"$this->user_web_design_skills\",
		\"$this->user_wordpress_skills\",
		\"$this->user_html_skills\",
		\"$this->user_PHP_skills\",
		\"$this->user_blog_design_skills\",
		\"$this->user_digital_magazine_skills\",
		\"$this->user_digital_economy_skills\",
		\"$this->user_crypto_assets_skills\",
		\"$this->user_e_bank_patria_skills\",
		\"$this->user_e_commerce_skills\",
		\"$this->user_use_movile_devices_skills\",
		\"$this->user_technical_support_computers_devices_skills\",
		\"$this->user_technical_support_movile_devices_skills\",
		\"$this->user_network_technical_support_skills\",
		\"$this->user_social_media_management_skills\",
		\"$this->user_social_media_security_skills\",
		\"$this->user_imagen_design_skills\",
		\"$this->user_mobile_video_editing_skills\",
		\"$this->user_remote_communication_skills\",
		\"$this->user_libre_office_applications_skills\",
		\"$this->user_meme_creations_skills\",
		\"$this->user_presentations_creations_skills\",
		\"$this->user_accounting_books_skills\",
		\"$this->user_budget_cration_skills\",
		\"$this->user_strategic_planning_skills\",
		\"$this->user_project_elaboration_skills\",
		\"$this->user_collective_diagnosis_skills\",
		\"$this->user_situational_analysis_tecniques_skills\",
		\"$this->user_systematization_community_experiences_skills\",
		\"$this->user_content_assertive_organizational_communication_skills\",
		\"$this->user_robotics_skills\",
		\"$this->user_artificial_intelligence_skills\",
		\"$this->user_programming_skills\",
		\"$this->user_application_creation_skills\",
		\"$this->user_greater_technological_skill\",
		\"$this->user_greater_technological_skill_level\",
		\"$this->user_training_needs\",
		\"$this->user_other_training_needs\",
		\"$this->user_know_PNCT_MincCYT\",
		\"$this->user_potential_contribution_for_areas_PNCT\",
		\"$this->user_know_PNI_infocentro\",
		\"$this->user_potential_contribution_for_PNI_infocentro\",
		\"$this->knowledge_remote_learning\",
		\"$this->participation_virtual_training\",
		\"$this->experience_online_training\",
		\"$this->know_platform_aprendiendo_juntos\",
		\"$this->training_received_aprendiendo_juntos\",
		\"$this->interest_to_training_on_aprendiendo_juntos\",
		\"$this->know_benefits_online_training\",
		\"$this->suggestions_provided\",
		\"$this->user_name_os\"
		)";
		return Executor::doit($sql);
	}


	public function addPg()
	{
		$sql = "INSERT into encuesta_capacidades_tecnologicas (
		user_id, 
		user_type, 
		personal_type, 
		user_email, 
		user_dni, 
		user_name, 
		user_lastname, 
		user_phone, 
		code_info, 
		info_name, 
		user_state, 
		user_municipality, 
		user_parish, 
		user_zone_type, 
		user_blender_user_skills, 
		user_python_user_skills, 
		user_stop_motion_skills, 
		user_web_design_skills, 
		user_wordpress_skills, 
		user_html_skills, 
		user_PHP_skills, 
		user_blog_design_skills, 
		user_digital_magazine_skills, 
		user_digital_economy_skills, 
		user_crypto_assets_skills, 
		user_e_bank_patria_skills, 
		user_e_commerce_skills, 
		user_use_movile_devices_skills, 
		user_technical_support_computers_devices_skills, 
		user_technical_support_movile_devices_skills, 
		user_network_technical_support_skills, 
		user_social_media_management_skills, 
		user_social_media_security_skills, 
		user_imagen_design_skills, 
		user_mobile_video_editing_skills, 
		user_remote_communication_skills, 
		user_libre_office_applications_skills, 
		user_meme_creations_skills, 
		user_presentations_creations_skills, 
		user_accounting_books_skills, 
		user_budget_cration_skills, 
		user_strategic_planning_skills, 
		user_project_elaboration_skills, 
		user_collective_diagnosis_skills, 
		user_situational_analysis_tecniques_skills, 
		user_systematization_community_experiences_skills, 
		user_content_assertive_organizational_communication_skills, 
		user_robotics_skills, 
		user_artificial_intelligence_skills, 
		user_programming_skills, 
		user_application_creation_skills, 
		user_greater_technological_skill, 
		user_greater_technological_skill_level, 
		user_training_needs, 
		user_other_training_needs, 
		user_know_PNCT_MincCYT, 
		user_potential_contribution_for_areas_PNCT, 
		user_know_PNI_infocentro, 
		user_potential_contribution_for_PNI_infocentro, 
		knowledge_remote_learning, 
		participation_virtual_training, 
		experience_online_training, 
		know_platform_aprendiendo_juntos, 
		training_received_aprendiendo_juntos, 
		interest_to_training_on_aprendiendo_juntos, 
		know_benefits_online_training, 
		suggestions_provided, 
		user_name_os,
		date_update
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
			);";
		$values = [
			$this->user_id,
			$this->user_type,
			$this->personal_type,
			$this->user_email,
			$this->user_dni,
			$this->user_name,
			$this->user_lastname,
			$this->user_phone,
			$this->code_info,
			$this->info_name,
			$this->user_state,
			$this->user_municipality,
			$this->user_parish,
			$this->user_zone_type,
			$this->user_blender_user_skills,
			$this->user_python_user_skills,
			$this->user_stop_motion_skills,
			$this->user_web_design_skills,
			$this->user_wordpress_skills,
			$this->user_html_skills,
			$this->user_PHP_skills,
			$this->user_blog_design_skills,
			$this->user_digital_magazine_skills,
			$this->user_digital_economy_skills,
			$this->user_crypto_assets_skills,
			$this->user_e_bank_patria_skills,
			$this->user_e_commerce_skills,
			$this->user_use_movile_devices_skills,
			$this->user_technical_support_computers_devices_skills,
			$this->user_technical_support_movile_devices_skills,
			$this->user_network_technical_support_skills,
			$this->user_social_media_management_skills,
			$this->user_social_media_security_skills,
			$this->user_imagen_design_skills,
			$this->user_mobile_video_editing_skills,
			$this->user_remote_communication_skills,
			$this->user_libre_office_applications_skills,
			$this->user_meme_creations_skills,
			$this->user_presentations_creations_skills,
			$this->user_accounting_books_skills,
			$this->user_budget_cration_skills,
			$this->user_strategic_planning_skills,
			$this->user_project_elaboration_skills,
			$this->user_collective_diagnosis_skills,
			$this->user_situational_analysis_tecniques_skills,
			$this->user_systematization_community_experiences_skills,
			$this->user_content_assertive_organizational_communication_skills,
			$this->user_robotics_skills,
			$this->user_artificial_intelligence_skills,
			$this->user_programming_skills,
			$this->user_application_creation_skills,
			$this->user_greater_technological_skill,
			$this->user_greater_technological_skill_level,
			$this->user_training_needs,
			$this->user_other_training_needs,
			$this->user_know_PNCT_MincCYT,
			$this->user_potential_contribution_for_areas_PNCT,
			$this->user_know_PNI_infocentro,
			$this->user_potential_contribution_for_PNI_infocentro,
			$this->knowledge_remote_learning,
			$this->participation_virtual_training,
			$this->experience_online_training,
			$this->know_platform_aprendiendo_juntos,
			$this->training_received_aprendiendo_juntos,
			$this->interest_to_training_on_aprendiendo_juntos,
			$this->know_benefits_online_training,
			$this->suggestions_provided,
			$this->user_name_os,
			$this->date_update
		];
		$resul = ExecutorPg::insert($sql, $values);
		return $resul[0];
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

	public function delByIdActivity()
	{
		$sql = "delete from " . self::$tablename . " where id_activity=$this->id_activity";
		Executor::doit($sql);
	}

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
		personal_type=\"$this->personal_type\",
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



	public function updatePg()
	{
		$sql = "UPDATE encuesta_capacidades_tecnologicas set 
		user_type = ?, 
		personal_type = ?, 
		user_email = ?, 
		user_dni = ?, 
		user_name = ?, 
		user_lastname = ?, 
		user_phone = ?, 
		code_info = ?, 
		info_name = ?, 
		user_state = ?, 
		user_municipality = ?, 
		user_parish = ?, 
		user_zone_type = ?, 
		user_blender_user_skills = ?, 
		user_python_user_skills = ?, 
		user_stop_motion_skills = ?, 
		user_web_design_skills = ?, 
		user_wordpress_skills = ?, 
		user_html_skills = ?, 
		user_PHP_skills = ?, 
		user_blog_design_skills = ?, 
		user_digital_magazine_skills = ?, 
		user_digital_economy_skills = ?, 
		user_crypto_assets_skills = ?, 
		user_e_bank_patria_skills = ?, 
		user_e_commerce_skills = ?, 
		user_use_movile_devices_skills = ?, 
		user_technical_support_computers_devices_skills = ?, 
		user_technical_support_movile_devices_skills = ?, 
		user_network_technical_support_skills = ?, 
		user_social_media_management_skills = ?, 
		user_social_media_security_skills = ?, 
		user_imagen_design_skills = ?, 
		user_mobile_video_editing_skills = ?, 
		user_remote_communication_skills = ?, 
		user_libre_office_applications_skills = ?, 
		user_meme_creations_skills = ?, 
		user_presentations_creations_skills = ?, 
		user_accounting_books_skills = ?, 
		user_budget_cration_skills = ?, 
		user_strategic_planning_skills = ?, 
		user_project_elaboration_skills = ?, 
		user_collective_diagnosis_skills = ?, 
		user_situational_analysis_tecniques_skills = ?, 
		user_systematization_community_experiences_skills = ?, 
		user_content_assertive_organizational_communication_skills = ?, 
		user_robotics_skills = ?, 
		user_artificial_intelligence_skills = ?, 
		user_programming_skills = ?, 
		user_application_creation_skills = ?, 
		user_greater_technological_skill = ?, 
		user_greater_technological_skill_level = ?, 
		user_training_needs = ?, 
		user_other_training_needs = ?, 
		user_know_PNCT_MincCYT = ?, 
		user_potential_contribution_for_areas_PNCT = ?, 
		user_know_PNI_infocentro = ?, 
		user_potential_contribution_for_PNI_infocentro = ?, 
		knowledge_remote_learning = ?, 
		participation_virtual_training = ?, 
		experience_online_training = ?, 
		know_platform_aprendiendo_juntos = ?, 
		training_received_aprendiendo_juntos = ?, 
		interest_to_training_on_aprendiendo_juntos = ?, 
		know_benefits_online_training = ?, 
		suggestions_provided = ?, 
		user_name_os = ?,
		date_update = ?
		where user_id = ?;
		";
		$values = [
			$this->user_type,
			$this->personal_type,
			$this->user_email,
			$this->user_dni,
			$this->user_name,
			$this->user_lastname,
			$this->user_phone,
			$this->code_info,
			$this->info_name,
			$this->user_state,
			$this->user_municipality,
			$this->user_parish,
			$this->user_zone_type,
			$this->user_blender_user_skills,
			$this->user_python_user_skills,
			$this->user_stop_motion_skills,
			$this->user_web_design_skills,
			$this->user_wordpress_skills,
			$this->user_html_skills,
			$this->user_PHP_skills,
			$this->user_blog_design_skills,
			$this->user_digital_magazine_skills,
			$this->user_digital_economy_skills,
			$this->user_crypto_assets_skills,
			$this->user_e_bank_patria_skills,
			$this->user_e_commerce_skills,
			$this->user_use_movile_devices_skills,
			$this->user_technical_support_computers_devices_skills,
			$this->user_technical_support_movile_devices_skills,
			$this->user_network_technical_support_skills,
			$this->user_social_media_management_skills,
			$this->user_social_media_security_skills,
			$this->user_imagen_design_skills,
			$this->user_mobile_video_editing_skills,
			$this->user_remote_communication_skills,
			$this->user_libre_office_applications_skills,
			$this->user_meme_creations_skills,
			$this->user_presentations_creations_skills,
			$this->user_accounting_books_skills,
			$this->user_budget_cration_skills,
			$this->user_strategic_planning_skills,
			$this->user_project_elaboration_skills,
			$this->user_collective_diagnosis_skills,
			$this->user_situational_analysis_tecniques_skills,
			$this->user_systematization_community_experiences_skills,
			$this->user_content_assertive_organizational_communication_skills,
			$this->user_robotics_skills,
			$this->user_artificial_intelligence_skills,
			$this->user_programming_skills,
			$this->user_application_creation_skills,
			$this->user_greater_technological_skill,
			$this->user_greater_technological_skill_level,
			$this->user_training_needs,
			$this->user_other_training_needs,
			$this->user_know_PNCT_MincCYT,
			$this->user_potential_contribution_for_areas_PNCT,
			$this->user_know_PNI_infocentro,
			$this->user_potential_contribution_for_PNI_infocentro,
			$this->knowledge_remote_learning,
			$this->participation_virtual_training,
			$this->experience_online_training,
			$this->know_platform_aprendiendo_juntos,
			$this->training_received_aprendiendo_juntos,
			$this->interest_to_training_on_aprendiendo_juntos,
			$this->know_benefits_online_training,
			$this->suggestions_provided,
			$this->user_name_os,
			$this->date_update,
			$this->user_id,
		];

		// return $sql;
		return ExecutorPg::update($sql, $values);
	}


	public static function getById($id)
	{
		$sql = "select * from " . self::$tablename . " where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0], new PersonalCapabilitiesData());
	}

	public static function getByInfo($code_info)
	{
		$sql = "select * from " . self::$tablename . " where code_info=$code_info";
		$query = Executor::doit($sql);
		return Model::one($query[0], new PersonalCapabilitiesData());
	}

	public static function getByUserId($id)
	{
		$sql = "select * from " . self::$tablename . " where user_id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0], new PersonalCapabilitiesData());
	}


	public static function getByIdActivity($id)
	{
		$sql = "select * from " . self::$tablename . " where id_activity=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0], new PersonalCapabilitiesData());
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
		return Model::many($query[0], new PersonalCapabilitiesData());
	}

	public static function getLike($q)
	{
		$sql = "select * from " . self::$tablename . " where name like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0], new PersonalCapabilitiesData());
	}

	public static function getBySQL($sql)
	{
		$query = Executor::doit($sql);
		return Model::many($query[0], new PersonalCapabilitiesData());
	}

	public static function UpdateBySQL($sql)
	{
		$query = Executor::doit($sql);
	}

	public static function getRepeated($document_number)
	{
		$sql = "select * from " . self::$tablename . " where user_dni=\"$document_number\"";
		$query = Executor::doit($sql);
		return Model::one($query[0], new PersonalCapabilitiesData());
	}


	public static function getByIdPg($id)
	{

		$sql = "SELECT * from encuesta_capacidades_tecnologicas where id=$id";
		$query = ExecutorPg::doit($sql);
		// return $query;
		// return $sql;
		if ($query === []) {
			$array = ModelPg::one($query[0][0], new PersonalCapabilitiesData());
			if ($array->id == "") {
				return "null";
			} else {
				return $array;
			}
		} else {
			return "null";
		}
	}


	public static function getRepeatedPg($user_dni)
	{
		$sql = "select * from encuesta_capacidades_tecnologicas where user_dni='$user_dni'";
		$query = ExecutorPg::doit($sql);
		// return $query;
		if ($query[0]->user_dni) {
			$array = ModelPg::one($query[0], new PersonalCapabilitiesData());
			if ($array->id == "") {
				return "null";
			} else {
				return $array;
			}
		} else {
			return "null";
		}
	}

	public static function getAllPg($sql)
	{
		$conn = DatabasePg::connectPg();

		if (Core::$debug_sql) {
			print "<pre>" . $sql . "</pre>";
		}
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		$data = $stmt->fetchAll(PDO::FETCH_OBJ);
		$TotalReg = $stmt->rowCount();
		return array($data, $TotalReg);
	}
}
