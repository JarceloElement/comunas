<?php

/**
 * InfoApp
 * @author Jarcelo
 **/

$debug = true;
if ($debug) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

if (isset($_GET['alterdb'])) {
    alter_db();
}
if (isset($_GET['setdb']) && $_GET['setdb'] == 1) {
    create_products_type();
}
if (isset($_GET['setdb']) && $_GET['setdb'] == 2) {
    create_personal_type();
}
if (isset($_GET['setdb']) && $_GET['setdb'] == 3) {
    create_final_users();
}
if (isset($_GET['setdb']) && $_GET['setdb'] == 4) {
    create_services_users();
}
if (isset($_GET['setdb']) && $_GET['setdb'] == 5) {
    create_etnia_type();
}
if (isset($_GET['setdb']) && $_GET['setdb'] == 6) {
    create_disability_type();
}
if (isset($_GET['setdb']) && $_GET['setdb'] == 7) {
    create_info_social_map();
}
if (isset($_GET['setdb']) && $_GET['setdb'] == 8) {
    create_info_social_map_educations();
}
if (isset($_GET['setdb']) && $_GET['setdb'] == 9) {
    create_info_social_map_organizations();
}
if (isset($_GET['setdb']) && $_GET['setdb'] == 10) {
    create_survey_personal_technological_capabilities();
}
if (isset($_GET['setdb']) && $_GET['setdb'] == 11) {
    create_strategic_action();
}
if (isset($_GET['setdb']) && $_GET['setdb'] == 12) {
    create_info_process();
}
if (isset($_GET['setdb']) && $_GET['setdb'] == 13) {
    create_info_inventory();
}
if (isset($_GET['setdb']) && $_GET['setdb'] == 14) {
    create_professions();
}
if (isset($_GET['setdb']) && $_GET['setdb'] == 15) {
    create_occupations();
}
if (isset($_GET['setdb']) && $_GET['setdb'] == 16) {
    create_dimentions();
}
if (isset($_GET['setdb']) && $_GET['setdb'] == 17) {
    create_services_type();
}







// $imagePath  = "uploads/images/reports/origin_1_AMA000_2022-09-07 18:36:22.jpg";

// if ( is_writable($imagePath) ) { 
//     $outPut = unlink($imagePath); 
// } else { 
//     $outPut ="No existe o no tienes permisos de escritura"; 
// } 
// # Prueba
// var_dump($outPut); 


// VERIFICA SI EXISTE EL REGISTRO SI NO LO CREA
// $table_name = "products_type";
// $row_test_name = "name";
// $row_test_value = "Video";
// $row_test_value_to = "Video";
// $con->query('UPDATE '.$table_name.' SET '.$row_test_name.' = "'.$row_test_value_to.'" WHERE '.$row_test_name.' = "'.$row_test_value.'" ');
// $exist = mysqli_affected_rows($con);
// if($exist == 0){Executor::doit('INSERT INTO products_type ('.$row_test_name.') value ("Video")');}
// echo $exist;



// crear atributo en tabla si no existe
// if ($con->query("SHOW COLUMNS FROM personal_type WHERE Field = 'type' ")->num_rows == 0){ echo "No existe el atributo";}; 



$products_type = 0;
$personal_type = 0;
$final_users = 0;
$services_users = 0;
$etnia_type = 0;
$disability_type = 0;
$info_social_map = 0;
$info_social_map_educations = 0;
$create_info_social_map_organizations = 0;
$create_survey_personal_technological_capabilities = 0;
$create_strategic_action = 0;
$create_info_process = 0;
$create_info_inventory = 0;
$create_professions = 0;
$create_occupations = 0;
$create_dimentions = 0;
$create_services_type = 0;

// Cuenta las tablas inexistentes
$con = Database::getCon();
$table_to_create = 0;
if ($con->query("SHOW TABLES FROM lanubede_info_app WHERE Tables_in_lanubede_info_app = 'products_type' ")->num_rows != 1) {
    $table_to_create += 1;
    $products_type = 1;
}
if ($con->query("SHOW TABLES FROM lanubede_info_app WHERE Tables_in_lanubede_info_app = 'personal_type' ")->num_rows != 1) {
    $table_to_create += 1;
    $personal_type = 1;
}
if ($con->query("SHOW TABLES FROM lanubede_info_app WHERE Tables_in_lanubede_info_app = 'final_users' ")->num_rows != 1) {
    $table_to_create += 1;
    $final_users = 1;
}
if ($con->query("SHOW TABLES FROM lanubede_info_app WHERE Tables_in_lanubede_info_app = 'services_users' ")->num_rows != 1) {
    $table_to_create += 1;
    $services_users = 1;
}
if ($con->query("SHOW TABLES FROM lanubede_info_app WHERE Tables_in_lanubede_info_app = 'etnia_type' ")->num_rows != 1) {
    $table_to_create += 1;
    $etnia_type = 1;
}
if ($con->query("SHOW TABLES FROM lanubede_info_app WHERE Tables_in_lanubede_info_app = 'disability_type' ")->num_rows != 1) {
    $table_to_create += 1;
    $disability_type = 1;
}
if ($con->query("SHOW TABLES FROM lanubede_info_app WHERE Tables_in_lanubede_info_app = 'info_social_map' ")->num_rows != 1) {
    $table_to_create += 1;
    $info_social_map = 1;
}
if ($con->query("SHOW TABLES FROM lanubede_info_app WHERE Tables_in_lanubede_info_app = 'info_social_map_educations' ")->num_rows != 1) {
    $table_to_create += 1;
    $info_social_map_educations = 1;
}
if ($con->query("SHOW TABLES FROM lanubede_info_app WHERE Tables_in_lanubede_info_app = 'info_social_map_organizations' ")->num_rows != 1) {
    $table_to_create += 1;
    $create_info_social_map_organizations = 1;
}
if ($con->query("SHOW TABLES FROM lanubede_info_app WHERE Tables_in_lanubede_info_app = 'personal_technological_capabilities' ")->num_rows != 1) {
    $table_to_create += 1;
    $create_survey_personal_technological_capabilities = 1;
}
if ($con->query("SHOW TABLES FROM lanubede_info_app WHERE Tables_in_lanubede_info_app = 'strategic_action' ")->num_rows != 1) {
    $table_to_create += 1;
    $create_strategic_action = 1;
}
if ($con->query("SHOW TABLES FROM lanubede_info_app WHERE Tables_in_lanubede_info_app = 'info_process' ")->num_rows != 1) {
    $table_to_create += 1;
    $create_info_process = 1;
}
if ($con->query("SHOW TABLES FROM lanubede_info_app WHERE Tables_in_lanubede_info_app = 'info_inventory' ")->num_rows != 1) {
    $table_to_create += 1;
    $create_info_inventory = 1;
}
if ($con->query("SHOW TABLES FROM lanubede_info_app WHERE Tables_in_lanubede_info_app = 'professions' ")->num_rows != 1) {
    $table_to_create += 1;
    $create_professions = 1;
}
if ($con->query("SHOW TABLES FROM lanubede_info_app WHERE Tables_in_lanubede_info_app = 'occupations' ")->num_rows != 1) {
    $table_to_create += 1;
    $create_occupations = 1;
}
if ($con->query("SHOW TABLES FROM lanubede_info_app WHERE Tables_in_lanubede_info_app = 'specific_action' ")->num_rows != 1) {
    $table_to_create += 1;
    $create_dimentions = 1;
}
if ($con->query("SHOW TABLES FROM lanubede_info_app WHERE Tables_in_lanubede_info_app = 'services_type' ")->num_rows != 1) {
    $table_to_create += 1;
    $create_services_type = 1;
}



// echo $con->query("SHOW COLUMNS FROM lanubede_info_app.reports ")->num_rows;


// Funciones para crear las tablas
// 1
function create_products_type()
{

    // Crea la tabla
    $sql = "CREATE TABLE IF NOT EXISTS products_type (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(50) NOT NULL
        -- apellidos VARCHAR(50) NOT NULL,
        -- email VARCHAR(50),
        -- fecha TIMESTAMP
        )";
    Executor::doit($sql)[1];

    // Crea registros
    $row_test_name = "name";
    Executor::doit('INSERT INTO products_type (' . $row_test_name . ') value ("Video")');
    Executor::doit('INSERT INTO products_type (' . $row_test_name . ') value ("Audio")');
    Executor::doit('INSERT INTO products_type (' . $row_test_name . ') value ("Imágen")');
    Executor::doit('INSERT INTO products_type (' . $row_test_name . ') value ("Infografía")');
    Executor::doit('INSERT INTO products_type (' . $row_test_name . ') value ("Mural")');
    Executor::doit('INSERT INTO products_type (' . $row_test_name . ') value ("Cartelera")');
    Executor::doit('INSERT INTO products_type (' . $row_test_name . ') value ("Insumo agrícola")');
    Executor::doit('INSERT INTO products_type (' . $row_test_name . ') value ("Otro")');

    // echo '<h4 class="title">Tabla creada con éxito!</h4>';
    View::Error("<p class='alert alert-success' style='padding:10px 10px;'>¡Tabla creada con éxito! </p>");
}


// 2
function create_personal_type()
{

    // Crea la tabla
    $sql = "CREATE TABLE IF NOT EXISTS personal_type (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        type VARCHAR(50) NOT NULL
        )";
    Executor::doit($sql)[1];

    // Crea registros
    $type = "type";
    Executor::doit('INSERT INTO personal_type (' . $type . ') value ("Nómina")');
    Executor::doit('INSERT INTO personal_type (' . $type . ') value ("Institucional")');
    Executor::doit('INSERT INTO personal_type (' . $type . ') value ("Colaborador")');


    View::Error("<p class='alert alert-success' style='padding:10px 10px;'>¡Tabla creada con éxito! </p>");

    // echo "<p class='alert alert-success'>¡Tabla creada con éxito!</p>";
    // echo '<h4 class="title">Tabla creada con éxito!</h4>';
}
// 3
function create_final_users()
{

    // Crea la tabla
    $sql = "CREATE TABLE IF NOT EXISTS final_users (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        user_nombres VARCHAR(50) NOT NULL,
        user_apellidos VARCHAR(50) NOT NULL,
        user_dni VARCHAR(50) NOT NULL,
        user_correo VARCHAR(50),
        user_telefono VARCHAR(50),
        user_genero VARCHAR(50),
        user_f_nacimiento DATE,
        user_nivel_academ VARCHAR(200),
        user_profesion VARCHAR(200),
        user_empleado VARCHAR(200),
        user_institucion VARCHAR(200),
        user_estado VARCHAR(200),
        user_municipio VARCHAR(200),
        user_direccion VARCHAR(200),
        user_fecha_reg TIMESTAMP
        )";
    Executor::doit($sql)[1];
    // echo '<h4 class="title">Tabla creada con éxito!</h4>';
    View::Error("<p class='alert alert-success' style='padding:10px 10px;'>¡Tabla creada con éxito! </p>");
}
// 4
function create_services_users()
{

    // Crea la tabla
    $sql = "CREATE TABLE IF NOT EXISTS services_users (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        user_id VARCHAR(50) NOT NULL,
        user_info_cod VARCHAR(50) NOT NULL,
        user_nombres VARCHAR(50) NOT NULL,
        user_apellidos VARCHAR(50) NOT NULL,
        user_dni VARCHAR(50) NOT NULL,
        user_correo VARCHAR(50),
        user_telefono VARCHAR(50),
        user_genero VARCHAR(50),
        user_f_nacimiento DATE,
        user_nivel_academ VARCHAR(200),
        user_profesion VARCHAR(200),
        user_empleado VARCHAR(200),
        user_institucion VARCHAR(200),
        user_estado VARCHAR(200),
        user_municipio VARCHAR(200),
        user_direccion VARCHAR(200),
        user_tipo_servicio VARCHAR(200),
        user_name_os VARCHAR(200),
        user_fecha_reg TIMESTAMP
        )";
    Executor::doit($sql)[1];
    // echo '<h4 class="title">Tabla creada con éxito!</h4>';
    View::Error("<p class='alert alert-success' style='padding:10px 10px;'>¡Tabla creada con éxito! </p>");
}

// 5
function create_etnia_type()
{

    // Crea la tabla
    $table = "etnia_type";
    $sql = "CREATE TABLE IF NOT EXISTS $table (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL
        )";
    Executor::doit($sql)[1];

    // Crea registros
    $field = "name";
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("No aplica")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Akawayo")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Añú/Paraujano")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Arawak")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Arutani/Uruak")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Ayaman")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Baniva")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Baré")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Barí")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Chaima")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("E`ñepá/Panare")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Gayón")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Guanano")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Inga")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Japreria")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Jirajara")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Jivi/Guajibo/Sikwani/Amorúa")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Jodi")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Kaketío")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Kariña")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Kechwa")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Kubeo")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Kuiva")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Kumanagoto")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Kurripako")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Mako")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Makushi")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Mapoyo/Wanai")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Matako")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Pemón (Arekuna, Kamarakoto, Taurepán)")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Piapoko/Chase")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Piaroa/Huottöjä")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Píritu")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Puinave")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Sáliva")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Sanemá")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Sapé")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Timote/Timotocuica")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Tukano")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Tunebo")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Waikerí")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Wapishana")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Warao")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Warekena")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Wayuu/Guajiro")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Yanomami/Shiriana")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Yaruro/Pumé")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Yavarana")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Yekwana")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Yeral/Ñengatú")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Yukpa")');


    View::Error("<p class='alert alert-success' style='padding:10px 10px;'>¡Tabla creada con éxito! </p>");

    // echo "<p class='alert alert-success'>¡Tabla creada con éxito!</p>";
    // echo '<h4 class="title">Tabla creada con éxito!</h4>';
}
// 6
function create_disability_type()
{

    // Crea la tabla
    $table = "disability_type";
    $sql = "CREATE TABLE IF NOT EXISTS $table (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        disability VARCHAR(200) NOT NULL
        )";
    Executor::doit($sql)[1];

    // Crea registros
    $field = "disability";
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("No aplica")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Otra - Claves Especiales")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Auditiva - Sensorial")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Visual - Sensorial")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Mudez - Sensorial")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Sordociega - Sensorial")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Comunicación - Sensorial")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Motriz - Inferior")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Motriz - Superior")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Mental")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Baja talla")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Autismo")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Multiple")');

    // echo '<h4 class="title">Tabla creada con éxito!</h4>';
    View::Error("<p class='alert alert-success' style='padding:10px 10px;'>¡Tabla disability_type creada con éxito! </p>");
}
// 7
function create_info_social_map()
{

    // Crea la tabla
    $table = "info_social_map";
    $sql = "CREATE TABLE IF NOT EXISTS $table (
        id INT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        user_id INT(20) NOT NULL,
        code_info VARCHAR(20) NOT NULL,
        responsability_email VARCHAR(200),
        communes_quantity VARCHAR(20),
        c_comunal_quantity VARCHAR(20),
        other_organizations VARCHAR(200),
        other_organizations_related_to_info VARCHAR(200),
        organizations_activities_on_info VARCHAR(200),
        ventures_around_info VARCHAR(20),
        info_support_to_entrepreneurship VARCHAR(200),
        are_educational_institutions VARCHAR(20),
        info_support_to_educational_institutions VARCHAR(200),
        community_potentials VARCHAR(200),
        families_around_the_info VARCHAR(20),
        population_around_the_info VARCHAR(20),
        boy_around_the_info_0_3_age VARCHAR(20),
        boy_around_the_info_4_7_age VARCHAR(20),
        boy_around_the_info_8_11_age VARCHAR(20),
        teenagers_boy_around_the_info_12_15_age VARCHAR(20),
        youths_boy_around_the_info_16_19_age VARCHAR(20),
        youths_boy_around_the_info_20_23_age VARCHAR(20),
        youths_boy_around_the_info_24_27_age VARCHAR(20),
        youths_boy_around_the_info_28_31_age VARCHAR(20),
        adult_boy_around_the_info_32_35_age VARCHAR(20),
        adult_boy_around_the_info_36_39_age VARCHAR(20),
        adult_boy_around_the_info_40_59_age VARCHAR(20),
        elderman_around_the_info_60_120_age VARCHAR(20),
        girl_around_the_info_0_3_age VARCHAR(20),
        girl_around_the_info_4_7_age VARCHAR(20),
        girl_around_the_info_8_11_age VARCHAR(20),
        teenagers_girl_around_the_info_12_15_age VARCHAR(20),
        youths_girl_around_the_info_16_19_age VARCHAR(20),
        youths_girl_around_the_info_20_23_age VARCHAR(20),
        youths_girl_around_the_info_24_27_age VARCHAR(20),
        youths_girl_around_the_info_28_31_age VARCHAR(20),
        adult_girl_around_the_info_32_35_age VARCHAR(20),
        adult_girl_around_the_info_36_39_age VARCHAR(20),
        adult_girl_around_the_info_40_59_age VARCHAR(20),
        elderwoman_around_the_info_60_120_age VARCHAR(20),
        childrens_w_disability VARCHAR(20),
        major_internet_provider VARCHAR(50),
        other_internet_provider VARCHAR(50),
        in_wifi_communities_project VARCHAR(200),
        wifi_communities_project_benefited_people VARCHAR(200),
        public_schools VARCHAR(200),
        private_schools VARCHAR(200),
        n_iphone VARCHAR(20),
        n_tablets VARCHAR(20),
        n_canaimitas VARCHAR(20),
        n_laptops VARCHAR(20),
        n_pc VARCHAR(20),
        n_home_w_internet VARCHAR(20),
        user_name_os VARCHAR(200),
        date_reg TIMESTAMP
        )";
    Executor::doit($sql)[1];

    // echo '<h4 class="title">Tabla creada con éxito!</h4>';
    View::Error("<p class='alert alert-success' style='padding:10px 10px;'>¡Tabla info_social_map creada con éxito! </p>");
}


// 8
function create_info_social_map_educations()
{

    // Crea la tabla
    $sql = "CREATE TABLE IF NOT EXISTS info_social_map_educations (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        user_id INT(20),
        school_id INT(20),
        code_info VARCHAR(20),
        school_type VARCHAR(20),
        school_name VARCHAR(20),
        school_n_students VARCHAR(20),
        school_n_students_female VARCHAR(20),
        school_n_students_male VARCHAR(20),
        school_n_iphone VARCHAR(20),
        user_name_os VARCHAR(20),
        date_reg TIMESTAMP
        )";
    Executor::doit($sql)[1];
    // echo '<h4 class="title">Tabla creada con éxito!</h4>';
    View::Error("<p class='alert alert-success' style='padding:10px 10px;'>¡Tabla creada con éxito! </p>");
}


// 9
function create_info_social_map_organizations()
{

    // Crea la tabla
    $sql = "CREATE TABLE IF NOT EXISTS info_social_map_organizations (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        user_id INT(20),
        organization_id INT(20),
        code_info VARCHAR(20) ,
        organization_type VARCHAR(20),
        organization_connection_type VARCHAR(20),
        organization_name VARCHAR(100),
        organization_dni VARCHAR(20),
        organization_map_ubication VARCHAR(100),
        organization_limit_area VARCHAR(100),
        organization_n_population VARCHAR(20),
        organization_n_population_female VARCHAR(20),
        organization_n_population_male VARCHAR(20),
        user_name_os VARCHAR(20),
        date_reg TIMESTAMP
        )";
    Executor::doit($sql)[1];
    // echo '<h4 class="title">Tabla creada con éxito!</h4>';
    View::Error("<p class='alert alert-success' style='padding:10px 10px;'>¡Tabla creada con éxito! </p>");
}



// 10
function create_survey_personal_technological_capabilities()
{

    // Crea la tabla
    $sql = "CREATE TABLE IF NOT EXISTS personal_technological_capabilities (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        user_id INT(20),
        user_type VARCHAR(100),
        user_dni VARCHAR(50),
        user_email VARCHAR(100),
        user_name VARCHAR(100),
        user_lastname VARCHAR(100),
        code_info VARCHAR(20),
        info_name VARCHAR(100),
        user_state VARCHAR(100),
        user_municipality VARCHAR(100),
        user_parish VARCHAR(100),
        user_zone_type VARCHAR(100),
        user_blender_user_skills VARCHAR(100),
        user_python_user_skills VARCHAR(100),
        user_stop_motion_skills VARCHAR(100),
        user_web_design_skills VARCHAR(100),
        user_wordpress_skills VARCHAR(100),
        user_html_skills VARCHAR(100),
        user_PHP_skills VARCHAR(100),
        user_blog_design_skills VARCHAR(100),
        user_digital_magazine_skills VARCHAR(100),
        user_digital_economy_skills VARCHAR(100),
        user_crypto_assets_skills VARCHAR(100),
        user_e_bank_patria_skills VARCHAR(100),
        user_e_commerce_skills VARCHAR(100),
        user_use_movile_devices_skills VARCHAR(100),
        user_technical_support_computers_devices_skills VARCHAR(100),
        user_technical_support_movile_devices_skills VARCHAR(100),
        user_network_technical_support_skills VARCHAR(100),
        user_social_media_management_skills VARCHAR(100),
        user_social_media_security_skills VARCHAR(100),
        user_imagen_design_skills VARCHAR(100),
        user_mobile_video_editing_skills VARCHAR(100),
        user_remote_communication_skills VARCHAR(100),
        user_libre_office_applications_skills VARCHAR(100),
        user_meme_creations_skills VARCHAR(100),
        user_presentations_creations_skills VARCHAR(100),
        user_accounting_books_skills VARCHAR(100),
        user_budget_cration_skills VARCHAR(100),
        user_strategic_planning_skills VARCHAR(100),
        user_project_elaboration_skills VARCHAR(100),
        user_collective_diagnosis_skills VARCHAR(100),
        user_situational_analysis_tecniques_skills VARCHAR(100),
        user_systematization_community_experiences_skills VARCHAR(100),
        user_content_assertive_organizational_communication_skills VARCHAR(100),
        user_robotics_skills VARCHAR(100),
        user_artificial_intelligence_skills VARCHAR(100),
        user_programming_skills VARCHAR(100),
        user_application_creation_skills VARCHAR(100),
        user_training_needs VARCHAR(100),
        user_potential_contribution_for_areas_PNCT VARCHAR(100),
        user_know_PNI_infocentro VARCHAR(100),
        user_potential_contribution_for_PNI_infocentro VARCHAR(100),

        user_name_os VARCHAR(20),
        date_reg TIMESTAMP
        )";
    Executor::doit($sql)[1];
    // echo '<h4 class="title">Tabla creada con éxito!</h4>';
    View::Error("<p class='alert alert-success' style='padding:10px 10px;'>¡Tabla creada con éxito! </p>");
}




// 11
function create_strategic_action()
{

    // Crea la tabla
    $sql = "CREATE TABLE IF NOT EXISTS strategic_action (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        line_id INT,
        line_action VARCHAR(200),
        name_action VARCHAR(500),
        FOREIGN KEY (line_id) REFERENCES actions_line(line_id) ON DELETE CASCADE
        )";
    Executor::doit($sql)[1];
    // echo '<h4 class="title">Tabla creada con éxito!</h4>';


    // Crea registros
    // $row_test_1 = "line_action";
    // $row_test_2 = "name_action";
    // Executor::doit('INSERT INTO strategic_action (line_action, name_action) value ("'.$row_test_1.'","'.$row_test_1.'")');


    View::Error("<p class='alert alert-success' style='padding:10px 10px;'>¡Tabla creada con éxito! </p>");
}


// 12
function create_info_process()
{

    // Crea la tabla
    $sql = "CREATE TABLE IF NOT EXISTS info_process (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        k_info INT,
        estado VARCHAR(50),
        code_info VARCHAR(50),
        diverciencia VARCHAR(200),
        exp_significativa VARCHAR(200),
        robotica VARCHAR(200),
        minmujer VARCHAR(200),
        cienti_tecn VARCHAR(200),
        PNUD VARCHAR(200),
        mapa_tec VARCHAR(200),
        encuesta VARCHAR(200),
        plan_4x4 VARCHAR(200),
        inaugu_4x4 VARCHAR(200),
        plan_conuco VARCHAR(200),
        FOREIGN KEY (k_info) REFERENCES infocentros(id) ON DELETE CASCADE ON UPDATE CASCADE
        )";
    Executor::doit($sql)[1];
    View::Error("<p class='alert alert-success' style='padding:10px 10px;'>¡Tabla creada con éxito! </p>");
}


// 13
function create_info_inventory()
{

    // Crea la tabla
    $sql = "CREATE TABLE IF NOT EXISTS info_inventory (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        k_info INT,
        estado VARCHAR(50),
        code_info VARCHAR(50),
        desc_pc VARCHAR(200),
        t_pc_asig VARCHAR(200),
        t_pc_ope VARCHAR(200),
        t_pc_inope VARCHAR(200),
        causa_pc_inop VARCHAR(1000),
        desc_impresora VARCHAR(1000),
        t_impresora VARCHAR(200),
        t_imp_ope VARCHAR(200),
        t_imp_inop VARCHAR(200),
        t_escrit_ope VARCHAR(200),
        t_escrit_inop VARCHAR(200),
        t_escrit VARCHAR(200),
        t_sillas_ope VARCHAR(200),
        t_silas_inop VARCHAR(200),
        t_sillas VARCHAR(200),
        t_aires_ope VARCHAR(200),
        t_aires_inop VARCHAR(200),
        t_aires VARCHAR(200),
        FOREIGN KEY (k_info) REFERENCES infocentros(id) ON DELETE CASCADE ON UPDATE CASCADE
        )";
    Executor::doit($sql)[1];
    View::Error("<p class='alert alert-success' style='padding:10px 10px;'>¡Tabla creada con éxito! </p>");
}


// 14
function create_professions()
{

    // Crea la tabla
    $table = "professions";
    $sql = "CREATE TABLE IF NOT EXISTS $table (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        p_name VARCHAR(100)
        )";
    Executor::doit($sql)[1];

    // Crea registros
    $field = "p_name";
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Desarrollador/a web")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Oftalmólogo/a")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Diseñador/a gráfico")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Psicólogo/a")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Odontólogo/a")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Maestro/a")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Maestro/a de educación especial")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Logopeda")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Abogado/a")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Economista")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Especialista en E-commerce")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Periodista")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Músico/a")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Veterinario/a")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Asesor/a financiero")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Piloto de aeronaves")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Juez/a")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Fisioterapeuta")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Administrador/a de empresas")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Administrador/a de RRHH")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Administrador/a financiero")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Politólogo/a")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Desarrollador/a de videojuegos")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Programador")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Director/a de museos")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Trabajador/a social")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Historiador/a")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Notario/a")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Técnico/a en recursos humanos")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Fotógrafo/a")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Biólogo/a")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Compositor/a musical")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Arquitecto/a")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Especialista en turismo y comercio")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Entrenador físico")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Investigador/a criminológico/a")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Terapeuta ocupacional")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Geógrafo/a")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Pedagogo/a")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Farmacéutico/a")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Estadístico/a")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Operador/a turístico")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Diseñador/a de moda")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Perito en lingüística forense")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Gestor medioambiental")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Enfermero/a")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Bombero/a")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Arqueólogo/a")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Contador/a")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Constructor civil")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Electricista")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Químico/a")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Físico/a")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Guardia de seguridad")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Policía")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Publicista")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Profesor/a en informática")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Ingeniero/a informático")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Ingeniero/a en sistemas")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Ingeniero/a civil")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Ingeniero/a eléctrico")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Ingeniero/a mecánica")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Ingeniero/a en computación")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Ingeniero/a industrial")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Ingeniero/a en electrónica")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Ingeniero/a en telecomunicaciones")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Ingeniero/a ambiental")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Licenciado/a en educación integral")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Licenciado/a en educación preescolar")');

    View::Error("<p class='alert alert-success' style='padding:10px 10px;'>¡Tabla creada con éxito! </p>");
}

// 15
function create_occupations()
{

    // Crea la tabla
    $table = "occupations";
    $sql = "CREATE TABLE IF NOT EXISTS $table (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        p_name VARCHAR(100)
        )";
    Executor::doit($sql)[1];

    // Crea registros
    $field = "p_name";
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Formador/a en TIC")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Disc jokey DJ")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Escritor/a")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Orfebre")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Marinero/a")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Corte y costura")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Buceo")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Ebanista")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Minería")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Doctor/a")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Bodeguero/a")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Secretario/a")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Agricultor/a")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Ganadero/a")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Coleador/a")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Fiscal de tránsito")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Deportista")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Portero/a")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Cauchero/a")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Técnico de reparación")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Dibujante")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Recepcionista")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Camarero/a")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Bartender")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Niñero/a")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Auxiliar contable")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Conductor/a")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Camarero/a")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Alfarero/a")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Ebanista")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Albañil")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Jardinería")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Gestor/a comercial")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Tatuador/a")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Maquillador/a")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Manicurista")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Pedicurista")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Técnico en refrigeración")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Transportista")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Chofer")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Ferretero")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Pescador/a")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Cocinero/a")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Serigrafista")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Tapicero/a")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Repostero/a")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Decorador/a de interiores")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Marroquinero/a")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Estibador/a")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Cajero/a")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Tareas dirigidas")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Sastre")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Lutier")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Cantante")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Actor")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Actriz")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Recreación")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Herrero/a")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Zapatero/a")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Lustra botas")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Joyería")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Carnicero/a")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Peluquero/a")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Mecánico/a")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Cerrajero/a")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Panadero/a")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Artista plástico")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Pintor/a de casas")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Tapicería")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Creador/a de contenido digital")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Desarrollador/a web")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Oftalmólogo/a")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Diseñador/a gráfico")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Psicólogo/a")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Odontólogo/a")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Maestro/a")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Maestro/a de educación especial")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Abogado/a")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Comercio electrónico")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Periodista")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Locutor")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Músico/a")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Veterinario/a")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Asesor/a financiero")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Piloto de aeronaves")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Piloto de drones")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Juez/a")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Fisioterapeuta")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Administrador/a")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Político")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Desarrollo de videojuegos")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Programación")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Director de orquesta")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Trabajo social")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Cronista/a")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Notario/a")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Mecánica de autos")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Mecánica de motos")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Mecánica de bicicletas")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Fotografía")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Biólogo/a")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Compositor/a musical")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Arquitecto/a")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Turismo y comercio")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Entrenador físico")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Entrenador de animales")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Criminológico/a")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Terapeuta ocupacional")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Farmacéutico/a")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Operador/a turístico")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Diseño de moda")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Forense")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Enfermero/a")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Bombero/a")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Arqueólogo/a")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Contador/a")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Constructor civil")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Electricista")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Químico/a")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Físico/a")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Guardia de seguridad")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Policía")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Militar")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Publicista")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Ingeniero/a civil")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Electrónica")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Telecomunicaciones")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Camarógrafo")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Traductor")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Cineasta")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Carpintería")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Docente")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Docente de preescolar")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Docente universitario")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Intérprete de lenguaje de señas")');

    View::Error("<p class='alert alert-success' style='padding:10px 10px;'>¡Tabla creada con éxito! </p>");
}


// 16
function create_dimentions()
{


    Executor::doit('ALTER TABLE strategic_action ADD INDEX(name_action);');

    Executor::doit("INSERT INTO strategic_action (line_action,name_action) value ('Comunidades de participación digital','Sistema de información abierta y accesible')");
    Executor::doit("INSERT INTO strategic_action (line_action,name_action) value ('Comunidades de participación digital','Fortalecimiento tecnológico Comunitario')");
    Executor::doit("INSERT INTO strategic_action (line_action,name_action) value ('Comunidades de participación digital','Promoción de Experiencias vinculadas a las Tic')");
    Executor::doit("INSERT INTO strategic_action (line_action,name_action) value ('Comunidades de participación digital','Logros de la Ciencia y las TIC')");
    Executor::doit("INSERT INTO strategic_action (line_action,name_action) value ('Comunidades de participación digital','Políticas del MPPCYT')");
    Executor::doit("INSERT INTO strategic_action (line_action,name_action) value ('Comunidades de participación digital','Comunidades indígenas, campesinos y afrodescendiente en las Tic')");
    Executor::doit("INSERT INTO strategic_action (line_action,name_action) value ('Comunidades de participación digital','Política de Acompañamiento Nacional')");

    Executor::doit("INSERT INTO strategic_action (line_action,name_action) value ('Comunidades de aprendizaje','Formación en TIC')");
    Executor::doit("INSERT INTO strategic_action (line_action,name_action) value ('Comunidades de aprendizaje','Creación de contenidos formativos')");

    Executor::doit("INSERT INTO strategic_action (line_action,name_action) value ('Acceso abierto','Infocentros adecuados')");
    Executor::doit("INSERT INTO strategic_action (line_action,name_action) value ('Acceso abierto','Servicio Wifi')");
    Executor::doit("INSERT INTO strategic_action (line_action,name_action) value ('Acceso abierto','Núcleos de NNA')");
    Executor::doit("INSERT INTO strategic_action (line_action,name_action) value ('Acceso abierto','Núcleos y Mega Núcleos de Robótica')");
    Executor::doit("INSERT INTO strategic_action (line_action,name_action) value ('Acceso abierto','Laboratorios de Ciencias y Tecnologías')");


    // Crea la tabla
    $table_1 = "specific_action";
    $sql = "CREATE TABLE IF NOT EXISTS $table_1 (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        INDEX (name_specific_action),
        k_strategic INT,
        name_strategic VARCHAR(500),
        name_specific_action VARCHAR(500),
        FOREIGN KEY (name_strategic) REFERENCES strategic_action(name_action) ON DELETE CASCADE ON UPDATE CASCADE
        )";
    Executor::doit($sql)[1];

    // Crea registros
    $reg = "INSERT INTO " . $table_1 . " (name_strategic,name_specific_action) value (
    'Sistema de información abierta y accesible',
    'Proceso de diagnóstico participativo con perspectiva tecnológica'
    )";
    Executor::doit($reg);
    // Crea registros
    $reg = "INSERT INTO " . $table_1 . " (name_strategic,name_specific_action) value (
    'Sistema de información abierta y accesible',
    'Experiencias impulsadas en el ámbito local, nacional e internacional'
    )";
    Executor::doit($reg);
    // Crea registros
    $reg = "INSERT INTO " . $table_1 . " (name_strategic,name_specific_action) value (
    'Fortalecimiento tecnológico Comunitario',
    'Sensibilización de las comunidades sobre los procesos de inclusión digital'
    )";
    Executor::doit($reg);
    // Crea registros
    $reg = "INSERT INTO " . $table_1 . " (name_strategic,name_specific_action) value (
    'Fortalecimiento tecnológico Comunitario',
    'Organizaciones haciendo uso de las herramientas para mejorar su entorno'
    )";
    Executor::doit($reg);
    // Crea registros
    $reg = "INSERT INTO " . $table_1 . " (name_strategic,name_specific_action) value (
    'Fortalecimiento tecnológico Comunitario',
    'Encuentro de voceros y voceras'
    )";
    Executor::doit($reg);
    // Crea registros
    $reg = "INSERT INTO " . $table_1 . " (name_strategic,name_specific_action) value (
    'Fortalecimiento tecnológico Comunitario',
    'Construcción colectiva de las normas de funcionamiento de los infocentros'
    )";
    Executor::doit($reg);
    // Crea registros
    $reg = "INSERT INTO " . $table_1 . " (name_strategic,name_specific_action) value (
    'Fortalecimiento tecnológico Comunitario',
    'Tejer asociaciones, inclusivas, solidarias e innovadoras para la cooperación, intercambio, complementariedad y articulación entre la experiencias e instituciones afines para el apoyo técnico, administrativo, científico, de innovación, planificación y aplicabilidad del proyecto en los territorios comunitarios'
    )";
    Executor::doit($reg);
    // Crea registros
    $reg = "INSERT INTO " . $table_1 . " (name_strategic,name_specific_action) value (
    'Fortalecimiento tecnológico Comunitario',
    'Sostenibilidad y sustentabilidad en la gestión comunal de los infocentros'
    )";
    Executor::doit($reg);
    // Crea registros
    $reg = "INSERT INTO " . $table_1 . " (name_strategic,name_specific_action) value (
    'Fortalecimiento tecnológico Comunitario',
    'Apoyo en Jornadas Especiales de registro digital en función de la dignificación del bienestar social'
    )";
    Executor::doit($reg);
    // Crea registros
    $reg = "INSERT INTO " . $table_1 . " (name_strategic,name_specific_action) value (
    'Fortalecimiento tecnológico Comunitario',
    'Eventos públicos como forma de fomentar la participación ciudadana'
    )";
    Executor::doit($reg);
    // Crea registros
    $reg = "INSERT INTO " . $table_1 . " (name_strategic,name_specific_action) value (
    'Promoción de Experiencias vinculadas a las Tic',
    'Procesos de investigación sobre las buenas prácticas, realidades sobre el uso, acceso y apropiación tecnológica'
    )";
    Executor::doit($reg);
    // Crea registros
    $reg = "INSERT INTO " . $table_1 . " (name_strategic,name_specific_action) value (
    'Promoción de Experiencias vinculadas a las Tic',
    'Intercambiar información innovadora sobre la comunicación digital'
    )";
    Executor::doit($reg);
    // Crea registros
    $reg = "INSERT INTO " . $table_1 . " (name_strategic,name_specific_action) value (
    'Promoción de Experiencias vinculadas a las Tic',
    'Producción de contenidos digitales  por parte de organizaciones sociales con el uso de medios multiplataformas: Canal YouTube, Redes Sociales. Radio Web, entre otros'
    )";
    Executor::doit($reg);
    // Crea registros
    $reg = "INSERT INTO " . $table_1 . " (name_strategic,name_specific_action) value (
    'Promoción de Experiencias vinculadas a las Tic',
    'Difusión de experiencias concretas sobre el uso de las TIC en cuanto a la producción, análisis y promoción de la Ciencia y la Tecnología'
    )";
    Executor::doit($reg);
    // Crea registros
    $reg = "INSERT INTO " . $table_1 . " (name_strategic,name_specific_action) value (
    'Logros de la Ciencia y las TIC',
    'Promoción sobre las líneas de trabajo del Plan Nacional de Comunidades TIC: Posicionamiento comunicacional institucional de la Fundación Infocentro'
    )";
    Executor::doit($reg);
    // Crea registros
    $reg = "INSERT INTO " . $table_1 . " (name_strategic,name_specific_action) value (
    'Logros de la Ciencia y las TIC',
    'Creación de contenidos digitales (canal de YouTube, Redes Sociales, radio web) en apoyo al -proceso político - científico nacional'
    )";
    Executor::doit($reg);
    // Crea registros
    $reg = "INSERT INTO " . $table_1 . " (name_strategic,name_specific_action) value (
    'Logros de la Ciencia y las TIC',
    'Creación de contenidos digitales (canal de YouTube, Redes Sociales, radio web) en apoyo al proceso político - científico nacional'
    )";
    Executor::doit($reg);
    // Crea registros
    $reg = "INSERT INTO " . $table_1 . " (name_strategic,name_specific_action) value (
    'Políticas del MPPCYT',
    'Fomentar procesos de apropiación de las TIC en la vida cotidiana'
    )";
    Executor::doit($reg);
    // Crea registros
    $reg = "INSERT INTO " . $table_1 . " (name_strategic,name_specific_action) value (
    'Comunidades indígenas, campesinos y afrodescendiente en las Tic',
    'Reconocimiento de los saberes ancestrales de nuestra gente, que hace ciencia y lo convierte en conocimientos colectivos'
    )";
    Executor::doit($reg);
    // Crea registros
    $reg = "INSERT INTO " . $table_1 . " (name_strategic,name_specific_action) value (
    'Política de Acompañamiento Nacional',
    'Jornada y construcción colectiva con los equipos estadales de trabajo'
    )";
    Executor::doit($reg);
    // Crea registros
    $reg = "INSERT INTO " . $table_1 . " (name_strategic,name_specific_action) value (
    'Política de Acompañamiento Nacional',
    'Promover espacios de encuentros para garantizar el funcionamiento sistémico de la plataforma'
    )";
    Executor::doit($reg);
    // Crea registros
    $reg = "INSERT INTO " . $table_1 . " (name_strategic,name_specific_action) value (
    'Política de Acompañamiento Nacional',
    'Visitas realizadas a los infocentros'
    )";
    Executor::doit($reg);
    // Crea registros
    $reg = "INSERT INTO " . $table_1 . " (name_strategic,name_specific_action) value (
    'Política de Acompañamiento Nacional',
    'Articulación para el desarrollo de una cultura científica - tecnológica'
    )";
    Executor::doit($reg);
    // Crea registros
    $reg = "INSERT INTO " . $table_1 . " (name_strategic,name_specific_action) value (
    'Política de Acompañamiento Nacional',
    'Activación en las multiplataformas comunicacionales'
    )";
    Executor::doit($reg);
    // Crea registros
    $reg = "INSERT INTO " . $table_1 . " (name_strategic,name_specific_action) value (
    'Política de Acompañamiento Nacional',
    'Movilización política popular'
    )";
    Executor::doit($reg);
    // Crea registros
    $reg = "INSERT INTO " . $table_1 . " (name_strategic,name_specific_action) value (
    'Política de Acompañamiento Nacional',
    'Acompañamiento a las organizaciones sociales y sus procesos de inclusión digital'
    )";
    Executor::doit($reg);
    // Crea registros
    $reg = "INSERT INTO " . $table_1 . " (name_strategic,name_specific_action) value (
    'Política de Acompañamiento Nacional',
    'Seguimiento, monitoreo y evaluación a los planes de trabajo de los infocentros sobre inclusión digital'
    )";
    Executor::doit($reg);


    // ----
    // Crea registros
    $reg = "INSERT INTO " . $table_1 . " (name_strategic,name_specific_action) value (
    'Formación en TIC',
    'Formación en habilidades digitales'
    )";
    Executor::doit($reg);
    // Crea registros
    $reg = "INSERT INTO " . $table_1 . " (name_strategic,name_specific_action) value (
    'Formación en TIC',
    'Establecer alianzas con instituciones educativas, organizaciones u otras entidades que aporten recursos y apoyo para la implementación del plan de formación'
    )";
    Executor::doit($reg);
    // Crea registros
    $reg = "INSERT INTO " . $table_1 . " (name_strategic,name_specific_action) value (
    'Formación en TIC',
    'Nivelar las habilidades del equipo humano de la Fundación Infocentro'
    )";
    Executor::doit($reg);
    // Crea registros
    $reg = "INSERT INTO " . $table_1 . " (name_strategic,name_specific_action) value (
    'Creación de contenidos formativos',
    'Innovar en los planes formativos, haciendo énfasis en pedagogías y metodologías TIC para la multiplicación de contenidos'
    )";
    Executor::doit($reg);


    // ---
    // Crea registros
    $reg = "INSERT INTO " . $table_1 . " (name_strategic,name_specific_action) value (
    'Infocentros adecuados',
    'Proceso asambleario para la postulación de nuevos facilitadores'
    )";
    Executor::doit($reg);
    // Crea registros
    $reg = "INSERT INTO " . $table_1 . " (name_strategic,name_specific_action) value (
    'Infocentros adecuados',
    'Modernización de la info e infraestructura'
    )";
    Executor::doit($reg);
    // Crea registros
    $reg = "INSERT INTO " . $table_1 . " (name_strategic,name_specific_action) value (
    'Infocentros adecuados',
    'Participación activa de la comunidad en el reacondicionamiento físico del Infocentro'
    )";
    Executor::doit($reg);
    // Crea registros
    $reg = "INSERT INTO " . $table_1 . " (name_strategic,name_specific_action) value (
    'Servicio Wifi',
    'Modernización de la info e infraestructura'
    )";
    Executor::doit($reg);
    // Crea registros
    $reg = "INSERT INTO " . $table_1 . " (name_strategic,name_specific_action) value (
    'Servicio Wifi',
    'Interacción para el encuentro y la articulación de las comunidades a fin de garantizar las buenas prácticas de la vida cotidiana'
    )";
    Executor::doit($reg);
    // Crea registros
    $reg = "INSERT INTO " . $table_1 . " (name_strategic,name_specific_action) value (
    'Servicio Wifi',
    'Uso de Medios digitales multiplataformas'
    )";
    Executor::doit($reg);
    // Crea registros
    $reg = "INSERT INTO " . $table_1 . " (name_strategic,name_specific_action) value (
    'Núcleos de NNA',
    'Captación de los NNA de las unidades educativas del punto y círculo del Infocentro'
    )";
    Executor::doit($reg);
    // Crea registros
    $reg = "INSERT INTO " . $table_1 . " (name_strategic,name_specific_action) value (
    'Núcleos de NNA',
    'Acercamiento de los NNA a experiencias de la Ciencia y la Tecnología'
    )";
    Executor::doit($reg);
    // Crea registros
    $reg = "INSERT INTO " . $table_1 . " (name_strategic,name_specific_action) value (
    'Núcleos de NNA',
    'Espacios de encuentro y articulación entre los promotores y animadores de trabajo con niñas, niños y adolescentes'
    )";
    Executor::doit($reg);
    // Crea registros
    $reg = "INSERT INTO " . $table_1 . " (name_strategic,name_specific_action) value (
    'Núcleos de NNA',
    'Creación de contenidos digitales por parte de NNA vinculados a los núcleos o Infocentros con trabajo con el eje de actuación'
    )";
    Executor::doit($reg);
    // Crea registros
    $reg = "INSERT INTO " . $table_1 . " (name_strategic,name_specific_action) value (
    'Núcleos y Mega Núcleos de Robótica',
    'Espacio de encuentro para el intercambio de conocimientos e investigaciones sobre la Ciencia y las TIC'
    )";
    Executor::doit($reg);
    // Crea registros
    $reg = "INSERT INTO " . $table_1 . " (name_strategic,name_specific_action) value (
    'Núcleos y Mega Núcleos de Robótica',
    'Desarrollo de diseños de robots'
    )";
    Executor::doit($reg);
    // Crea registros
    $reg = "INSERT INTO " . $table_1 . " (name_strategic,name_specific_action) value (
    'Núcleos y Mega Núcleos de Robótica',
    'Impulsar proyectos tecnológicos para generar emprendedores en el área de las TIC'
    )";
    Executor::doit($reg);
    // Crea registros
    $reg = "INSERT INTO " . $table_1 . " (name_strategic,name_specific_action) value (
    'Laboratorios de Ciencias y Tecnologías',
    'Acercamiento al uso de la Ciencia y las TIC (proceso práctico)'
    )";
    Executor::doit($reg);
    // Crea registros
    $reg = "INSERT INTO " . $table_1 . " (name_strategic,name_specific_action) value (
    'Laboratorios de Ciencias y Tecnologías',
    'Espacio de encuentro para el intercambio de conocimientos e investigaciones sobre la Ciencia y las TIC'
    )";
    Executor::doit($reg);
    // Crea registros
    $reg = "INSERT INTO " . $table_1 . " (name_strategic,name_specific_action) value (
    'Laboratorios de Ciencias y Tecnologías',
    'Promover soluciones tecnológicas que permitan avanzar en los procesos de inclusión digital'
    )";
    Executor::doit($reg);
    // Crea registros
    $reg = "INSERT INTO " . $table_1 . " (name_strategic,name_specific_action) value (
    'Laboratorios de Ciencias y Tecnologías',
    'Innovación, creación de mejores versiones en el campo de la Ciencia y las TIC'
    )";
    Executor::doit($reg);
    // Crea registros
    $reg = "INSERT INTO " . $table_1 . " (name_strategic,name_specific_action) value (
    'Laboratorios de Ciencias y Tecnologías',
    'Impulsar proyectos tecnológicos para generar  emprendedores en el área de la Ciencia y las TIC'
    )";
    Executor::doit($reg);





    // Crea la tabla
    $table_2 = "training_type";
    $sql_2 = "CREATE TABLE IF NOT EXISTS $table_2 (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        INDEX (name_training_type),
        name_line_action VARCHAR(500),
        name_strategic_action VARCHAR(500),
        name_specific_action VARCHAR(500),
        name_training_type VARCHAR(500),
        FOREIGN KEY (name_specific_action) REFERENCES specific_action(name_specific_action) ON DELETE CASCADE ON UPDATE CASCADE
        )";
    Executor::doit($sql_2)[1];

    // Crea registros
    Executor::doit("INSERT INTO " . $table_2 . " (name_line_action,name_strategic_action,name_specific_action,name_training_type) value ('Comunidades de aprendizaje','Formación en TIC','Formación en habilidades digitales','Semillero Científico')");
    Executor::doit("INSERT INTO " . $table_2 . " (name_line_action,name_strategic_action,name_specific_action,name_training_type) value ('Comunidades de aprendizaje','Formación en TIC','Formación en habilidades digitales','Robótica')");
    Executor::doit("INSERT INTO " . $table_2 . " (name_line_action,name_strategic_action,name_specific_action,name_training_type) value ('Comunidades de aprendizaje','Formación en TIC','Formación en habilidades digitales','Redes Sociales')");
    Executor::doit("INSERT INTO " . $table_2 . " (name_line_action,name_strategic_action,name_specific_action,name_training_type) value ('Comunidades de aprendizaje','Formación en TIC','Formación en habilidades digitales','Diseño y edición multimedia')");
    Executor::doit("INSERT INTO " . $table_2 . " (name_line_action,name_strategic_action,name_specific_action,name_training_type) value ('Comunidades de aprendizaje','Formación en TIC','Formación en habilidades digitales','Ofimática y aplicaciones')");
    Executor::doit("INSERT INTO " . $table_2 . " (name_line_action,name_strategic_action,name_specific_action,name_training_type) value ('Comunidades de aprendizaje','Formación en TIC','Formación en habilidades digitales','Programación y gestión de proyectos')");
    Executor::doit("INSERT INTO " . $table_2 . " (name_line_action,name_strategic_action,name_specific_action,name_training_type) value ('Comunidades de aprendizaje','Formación en TIC','Formación en habilidades digitales','Seguridad e Internet')");
    Executor::doit("INSERT INTO " . $table_2 . " (name_line_action,name_strategic_action,name_specific_action,name_training_type) value ('Comunidades de aprendizaje','Formación en TIC','Formación en habilidades digitales','Igualdad de Género')");
    Executor::doit("INSERT INTO " . $table_2 . " (name_line_action,name_strategic_action,name_specific_action,name_training_type) value ('Comunidades de aprendizaje','Formación en TIC','Formación en habilidades digitales','Diversidad Funcional')");
    Executor::doit("INSERT INTO " . $table_2 . " (name_line_action,name_strategic_action,name_specific_action,name_training_type) value ('Comunidades de aprendizaje','Formación en TIC','Formación en habilidades digitales','Habilidades digitales para la productividad')");





    // Crea la tabla
    $table_3 = "level_training";
    $sql_3 = "CREATE TABLE IF NOT EXISTS $table_3 (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name_level_training VARCHAR(500)
        )";
    Executor::doit($sql_3)[1];

    // Crea registros
    $field_3 = "name_level_training";
    Executor::doit("INSERT INTO " . $table_3 . " (" . $field_3 . ") value ('Básico')");
    Executor::doit("INSERT INTO " . $table_3 . " (" . $field_3 . ") value ('Intermedio')");
    Executor::doit("INSERT INTO " . $table_3 . " (" . $field_3 . ") value ('Avanzado')");

    View::Error("<p class='alert alert-success' style='padding:10px 10px;'>¡Tabla creada con éxito! </p>");
}




// 17
function create_services_type()
{

    // Crea la tabla
    $table = "services_type";
    $sql = "CREATE TABLE IF NOT EXISTS $table (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        services_name VARCHAR(500)
        )";
    Executor::doit($sql)[1];

    // Crea registros
    $field = "services_name";
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Obtención de información relacionada con la salud o con servicios médicos")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Obtención de información sobre organizaciones gubernamentales en general")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Interacción con organizaciones gubernamentales en general")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Envío o recepción de mensajes electrónicos")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Llamadas telefónicas a través del Protocolo de Internet")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Publicación de información o de mensajes instantáneos")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Compra o pedido de bienes y servicios")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Operaciones bancarias por Internet")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Actividades de educación o aprendizaje")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Uso o descarga de video juegos")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Descarga de películas, imágenes y música, programas de televisión o videos, programas de radio o música")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Descarga de programas informáticos")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Lectura o descarga de periódicos, revistas en línea o libros electrónicos")');
    Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Interacción y producción de contenidos en redes sociales y medios digitales de comunicación")');

    View::Error("<p class='alert alert-success' style='padding:10px 10px;'>¡Tabla creada con éxito! </p>");
}












// Alter DB
function alter_db()
{
    // Executor::doit('ALTER TABLE facilitators add column personal_type VARCHAR(50) DEFAULT "Nómina" AFTER status_nom;');
    // Executor::doit('ALTER TABLE coordinators add column personal_type VARCHAR(50) DEFAULT "Nómina" AFTER status_nom;');
    // Executor::doit('ALTER TABLE gerencias add column personal_type VARCHAR(50) DEFAULT "Nómina" AFTER status_nom;');
    // Executor::doit('ALTER TABLE reports add column personal_type VARCHAR(50) AFTER responsible_email;');
    // Executor::doit('ALTER TABLE reports add column name_os VARCHAR(50) DEFAULT NULL AFTER institutions;');
    // Executor::doit('ALTER TABLE reports add column report_type VARCHAR(50) DEFAULT NULL AFTER line_action;');
    // Executor::doit('ALTER TABLE reports add column user_id VARCHAR(50) DEFAULT NULL AFTER code_info;');
    // Executor::doit('ALTER TABLE reports add column is_active BOOLEAN DEFAULT 1 AFTER id;');

    // Executor::doit('ALTER TABLE reports add column hour_activity VARCHAR(50) DEFAULT NULL AFTER date_pub;');
    // Executor::doit('ALTER TABLE reports add column organized_by_info VARCHAR(50) DEFAULT NULL AFTER personal_type;');
    // Executor::doit('ALTER TABLE reports add column status_activity BOOLEAN DEFAULT 1 AFTER is_active;');
    // Executor::doit('ALTER TABLE reports add column notific TEXT(5000) DEFAULT NULL AFTER observations;');

    // Executor::doit('ALTER TABLE user add column code_info VARCHAR(50) DEFAULT NULL AFTER user_type;');
    // Executor::doit('ALTER TABLE user add column is_organization VARCHAR(50) DEFAULT 0 AFTER code_info;');
    // Executor::doit('ALTER TABLE user add column organization_name VARCHAR(50) DEFAULT NULL AFTER is_organization;');
    // Executor::doit('ALTER TABLE user add column gender VARCHAR(50) DEFAULT NULL AFTER user_type;');
    // Executor::doit('ALTER TABLE final_users add column user_organizacion VARCHAR(200) DEFAULT NULL AFTER user_institucion;');
    // Executor::doit('ALTER TABLE final_users add column user_etnia VARCHAR(200) DEFAULT NULL AFTER user_genero;');
    // Executor::doit('ALTER TABLE final_users add column user_edad VARCHAR(200) DEFAULT NULL AFTER user_f_nacimiento;');
    // Executor::doit('ALTER TABLE final_users add column disability_type VARCHAR(200) DEFAULT NULL AFTER user_etnia;');
    // Executor::doit('ALTER TABLE services_users add column user_edad VARCHAR(200) DEFAULT NULL AFTER user_f_nacimiento;');
    // Executor::doit('ALTER TABLE services_users add column user_fecha_servicio DATE DEFAULT NULL AFTER user_tipo_servicio;');
    // Executor::doit('ALTER TABLE services_users add column disability_type DATE DEFAULT NULL AFTER user_genero;');
    // Executor::doit('ALTER TABLE participants_list add column etnia VARCHAR(200) DEFAULT NULL AFTER email;');
    // Executor::doit('ALTER TABLE participants_list add column line_action VARCHAR(200) DEFAULT NULL AFTER id_activity;');
    // Executor::doit('ALTER TABLE participants_list add column report_type VARCHAR(200) DEFAULT NULL AFTER action_line;');
    // Executor::doit('ALTER TABLE participants_list add column disability_type VARCHAR(200) DEFAULT NULL AFTER etnia;');
    // Executor::doit('ALTER TABLE info_social_map add column info_state VARCHAR(50) DEFAULT NULL AFTER user_id;');
    // Executor::doit('ALTER TABLE info_social_map add column user_type VARCHAR(50) DEFAULT NULL AFTER user_id;');
    // Executor::doit('ALTER TABLE info_social_map add column progress TEXT(5000) DEFAULT NULL AFTER user_type;');
    // Executor::doit('ALTER TABLE info_social_map add column progress_percent VARCHAR(50) DEFAULT 0 AFTER progress;');
    // Executor::doit('ALTER TABLE info_social_map_educations add column dea_code VARCHAR(50) DEFAULT NULL AFTER school_type;');
    // Executor::doit('ALTER TABLE info_social_map_educations add column s_state VARCHAR(50) DEFAULT NULL AFTER code_info;');
    // Executor::doit('ALTER TABLE info_social_map_organizations add column organization_connection_type VARCHAR(50) DEFAULT NULL AFTER organization_type;');
    // Executor::doit('ALTER TABLE info_social_map_organizations add column o_state VARCHAR(50) DEFAULT NULL AFTER code_info;');

    $con = Database::getCon();

    if ($con->query(" select COLUMN_NAME from information_schema.columns where table_name = 'reports' and  column_name = 'date_ini' and table_schema = 'lanubede_info_app' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE reports add column date_ini DATE AFTER date_pub;');
    }
    if ($con->query(" select COLUMN_NAME from information_schema.columns where table_name = 'reports' and  column_name = 'date_end' and table_schema = 'lanubede_info_app' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE reports add column date_end DATE AFTER date_ini;');
    }
    if ($con->query(" select COLUMN_NAME from information_schema.columns where table_name = 'infocentros' and  column_name = 'ofensiva_fase_I' and table_schema = 'lanubede_info_app' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE infocentros add column ofensiva_fase_I VARCHAR(200) AFTER espacio_inst;');
    }
    if ($con->query(" select COLUMN_NAME from information_schema.columns where table_name = 'infocentros' and  column_name = 'ofensiva_fase_II' and table_schema = 'lanubede_info_app' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE infocentros add column ofensiva_fase_II VARCHAR(200) AFTER ofensiva_fase_I;');
    }
    if ($con->query(" select COLUMN_NAME from information_schema.columns where table_name = 'infocentros' and  column_name = 'ofensiva_fase_III' and table_schema = 'lanubede_info_app' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE infocentros add column ofensiva_fase_III VARCHAR(200) AFTER ofensiva_fase_II;');
    }
    if ($con->query(" select COLUMN_NAME from information_schema.columns where table_name = 'infocentros' and  column_name = 'ofensiva_fase_IV' and table_schema = 'lanubede_info_app' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE infocentros add column ofensiva_fase_IV VARCHAR(200) AFTER ofensiva_fase_III;');
    }
    if ($con->query(" select COLUMN_NAME from information_schema.columns where table_name = 'infocentros' and  column_name = 'ofensiva_fase_V' and table_schema = 'lanubede_info_app' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE infocentros add column ofensiva_fase_V VARCHAR(200) AFTER ofensiva_fase_IV;');
    }
    if ($con->query(" select COLUMN_NAME from information_schema.columns where table_name = 'infocentros' and  column_name = 'avance_ofensiva' and table_schema = 'lanubede_info_app' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE infocentros add column avance_ofensiva VARCHAR(200) AFTER ofensiva_fase_V;');
    }
    if ($con->query(" select COLUMN_NAME from information_schema.columns where table_name = 'infocentros' and  column_name = 'financiamiento_ofensiva' and table_schema = 'lanubede_info_app' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE infocentros add column financiamiento_ofensiva VARCHAR(200) AFTER avance_ofensiva;');
    }
    if ($con->query(" select COLUMN_NAME from information_schema.columns where table_name = 'infocentros' and  column_name = 'estatus_falla' and table_schema = 'lanubede_info_app' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE infocentros add column estatus_falla VARCHAR(200) AFTER estatus_op;');
    }
    if ($con->query(" select COLUMN_NAME from information_schema.columns where table_name = 'infocentros' and  column_name = 'N_reporte' and table_schema = 'lanubede_info_app' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE infocentros add column N_reporte VARCHAR(200) AFTER estatus_falla;');
    }
    if ($con->query(" select COLUMN_NAME from information_schema.columns where table_name = 'infocentros' and  column_name = 'PC_wifi' and table_schema = 'lanubede_info_app' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE infocentros add column PC_wifi VARCHAR(200) AFTER N_reporte;');
    }
    if ($con->query(" select COLUMN_NAME from information_schema.columns where table_name = 'infocentros' and  column_name = 'router_wifi' and table_schema = 'lanubede_info_app' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE infocentros add column router_wifi VARCHAR(200) AFTER PC_wifi;');
    }
    if ($con->query(" select COLUMN_NAME from information_schema.columns where table_name = 'infocentros' and  column_name = 'antena_wifi' and table_schema = 'lanubede_info_app' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE infocentros add column antena_wifi VARCHAR(200) AFTER router_wifi;');
    }
    if ($con->query(" select COLUMN_NAME from information_schema.columns where table_name = 'infocentros' and  column_name = 'ancho_banda_bajada' and table_schema = 'lanubede_info_app' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE infocentros add column ancho_banda_bajada VARCHAR(200) AFTER antena_wifi;');
    }
    if ($con->query(" select COLUMN_NAME from information_schema.columns where table_name = 'infocentros' and  column_name = 'ancho_banda_subida' and table_schema = 'lanubede_info_app' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE infocentros add column ancho_banda_subida VARCHAR(200) AFTER ancho_banda_bajada;');
    }
    if ($con->query(" select COLUMN_NAME from information_schema.columns where table_name = 'infocentros' and  column_name = 'MAC_PC' and table_schema = 'lanubede_info_app' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE infocentros add column MAC_PC VARCHAR(200) AFTER ancho_banda_subida;');
    }
    if ($con->query(" select COLUMN_NAME from information_schema.columns where table_name = 'infocentros' and  column_name = 'rango_ip' and table_schema = 'lanubede_info_app' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE infocentros add column rango_ip VARCHAR(200) AFTER MAC_PC;');
    }
    if ($con->query(" select COLUMN_NAME from information_schema.columns where table_name = 'infocentros' and  column_name = 'facili_s_coord' and table_schema = 'lanubede_info_app' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE infocentros add column facili_s_coord VARCHAR(200) AFTER rango_ip;');
    }
    if ($con->query(" select COLUMN_NAME from information_schema.columns where table_name = 'infocentros' and  column_name = 'obs_facilitador' and table_schema = 'lanubede_info_app' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE infocentros add column obs_facilitador VARCHAR(200) AFTER facili_s_coord;');
    }
    if ($con->query(" select COLUMN_NAME from information_schema.columns where table_name = 'infocentros' and  column_name = 'fact_aba' and table_schema = 'lanubede_info_app' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE infocentros add column fact_aba VARCHAR(200) AFTER migrado;');
    }
    if ($con->query(" select COLUMN_NAME from information_schema.columns where table_name = 'infocentros' and  column_name = 'estatus_migracion' and table_schema = 'lanubede_info_app' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE infocentros add column estatus_migracion VARCHAR(200) AFTER fact_aba;');
    }
    if ($con->query(" select COLUMN_NAME from information_schema.columns where table_name = 'infocentros' and  column_name = 'fecha_migracion' and table_schema = 'lanubede_info_app' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE infocentros add column fecha_migracion VARCHAR(200) AFTER estatus_migracion;');
    }
    if ($con->query(" select COLUMN_NAME from information_schema.columns where table_name = 'infocentros' and  column_name = 'motivo_cierre_def' and table_schema = 'lanubede_info_app' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE infocentros add column motivo_cierre_def VARCHAR(200) AFTER motivo_cierre;');
    }
    if ($con->query(" select COLUMN_NAME from information_schema.columns where table_name = 'infocentros' and  column_name = 'abierto_en_pandemia' and table_schema = 'lanubede_info_app' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE infocentros add column abierto_en_pandemia VARCHAR(200) AFTER estatus;');
    }
    if ($con->query(" select COLUMN_NAME from information_schema.columns where table_name = 'infocentros' and  column_name = 'f_inauguracion' and table_schema = 'lanubede_info_app' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE infocentros add column f_inauguracion VARCHAR(200) AFTER f_instalacion;');
    }
    if ($con->query(" select COLUMN_NAME from information_schema.columns where table_name = 'infocentros' and  column_name = 'latitud' and table_schema = 'lanubede_info_app' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE infocentros add column latitud VARCHAR(200) AFTER limite_fronterizo;');
    }
    if ($con->query(" select COLUMN_NAME from information_schema.columns where table_name = 'infocentros' and  column_name = 'longitud' and table_schema = 'lanubede_info_app' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE infocentros add column longitud VARCHAR(200) AFTER latitud;');
    }
    if ($con->query(" select COLUMN_NAME from information_schema.columns where table_name = 'infocentros' and  column_name = 'region_tipo' and table_schema = 'lanubede_info_app' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE infocentros add column region_tipo VARCHAR(200) AFTER id;');
    }

    if ($con->query("SHOW COLUMNS FROM info_process WHERE Field = 'estado' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE info_process add column estado VARCHAR(200) AFTER id;');
    };
    if ($con->query("SHOW COLUMNS FROM info_process WHERE Field = 'k_info' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE info_process add column k_info INT AFTER id;');
    };
    if ($con->query("SHOW COLUMNS FROM info_inventory WHERE Field = 'estado' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE info_inventory add column estado VARCHAR(200) AFTER id;');
    };
    if ($con->query("SHOW COLUMNS FROM info_inventory WHERE Field = 'k_info' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE info_inventory add column k_info INT AFTER id;');
    };
    Executor::doit('ALTER TABLE info_process ADD FOREIGN KEY (k_info) REFERENCES infocentros(id) ON DELETE CASCADE ON UPDATE CASCADE;');
    Executor::doit('ALTER TABLE info_inventory ADD FOREIGN KEY (k_info) REFERENCES infocentros(id) ON DELETE CASCADE ON UPDATE CASCADE;');
    if ($con->query("SHOW COLUMNS FROM strategic_action WHERE Field = 'line_id' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE strategic_action add column line_id INT AFTER id;');
    };
    Executor::doit('ALTER TABLE strategic_action ADD FOREIGN KEY (line_id) REFERENCES actions_line(line_id) ON DELETE CASCADE ON UPDATE CASCADE;');

    if ($con->query("SHOW COLUMNS FROM final_users WHERE Field = 'user_id' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE final_users add column user_id INT AFTER id;');
    };
    if ($con->query("SHOW COLUMNS FROM final_users WHERE Field = 'red_x' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE final_users add column red_x VARCHAR(200) AFTER user_direccion;');
    };
    if ($con->query("SHOW COLUMNS FROM final_users WHERE Field = 'red_facebook' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE final_users add column red_facebook VARCHAR(200) AFTER red_x;');
    };
    if ($con->query("SHOW COLUMNS FROM final_users WHERE Field = 'red_instagram' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE final_users add column red_instagram VARCHAR(200) AFTER red_facebook;');
    };
    if ($con->query("SHOW COLUMNS FROM final_users WHERE Field = 'red_linkedin' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE final_users add column red_linkedin VARCHAR(200) AFTER red_instagram;');
    };
    if ($con->query("SHOW COLUMNS FROM final_users WHERE Field = 'red_youtube' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE final_users add column red_youtube VARCHAR(200) AFTER red_linkedin;');
    };
    if ($con->query("SHOW COLUMNS FROM final_users WHERE Field = 'red_tiktok' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE final_users add column red_tiktok VARCHAR(200) AFTER red_youtube;');
    };
    if ($con->query("SHOW COLUMNS FROM final_users WHERE Field = 'red_whatsapp' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE final_users add column red_whatsapp VARCHAR(200) AFTER red_tiktok;');
    };
    if ($con->query("SHOW COLUMNS FROM final_users WHERE Field = 'red_telegram' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE final_users add column red_telegram VARCHAR(200) AFTER red_whatsapp;');
    };
    if ($con->query("SHOW COLUMNS FROM final_users WHERE Field = 'red_snapchat' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE final_users add column red_snapchat VARCHAR(200) AFTER red_telegram;');
    };
    if ($con->query("SHOW COLUMNS FROM final_users WHERE Field = 'red_pinterest' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE final_users add column red_pinterest VARCHAR(200) AFTER red_snapchat;');
    };
    if ($con->query("SHOW COLUMNS FROM final_users WHERE Field = 'user_nationality' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE final_users add column user_nationality VARCHAR(50) DEFAULT "V" AFTER user_apellidos;');
    };
    if ($con->query("SHOW COLUMNS FROM final_users WHERE Field = 'user_comunity_type' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE final_users add column user_comunity_type VARCHAR(50) DEFAULT "No aplica" AFTER user_genero;');
    };
    if ($con->query("SHOW COLUMNS FROM final_users WHERE Field = 'user_pertenece_organizacion' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE final_users add column user_pertenece_organizacion VARCHAR(50) DEFAULT "No aplica" AFTER user_organizacion;');
    };
    if ($con->query("SHOW COLUMNS FROM final_users WHERE Field = 'user_has_document' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE final_users add column user_has_document VARCHAR(50) DEFAULT "" AFTER user_nationality;');
    };
    if ($con->query("SHOW COLUMNS FROM final_users WHERE Field = 'user_ocupacion' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE final_users add column user_ocupacion VARCHAR(100) DEFAULT "" AFTER user_profesion;');
    };
    if ($con->query("SHOW COLUMNS FROM final_users WHERE Field = 'user_type' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE final_users add column user_type VARCHAR(100) DEFAULT "" AFTER id;');
    };
    if ($con->query("SHOW COLUMNS FROM final_users WHERE Field = 'parent_dni' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE final_users add column parent_dni VARCHAR(50) DEFAULT "No aplica" AFTER user_dni;');
    };
    if ($con->query("SHOW COLUMNS FROM final_users WHERE Field = 'child_number' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE final_users add column child_number INT AFTER parent_dni;');
    };
    if ($con->query("SHOW COLUMNS FROM final_users WHERE Field = 'user_nombre_2' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE final_users add column user_nombre_2 VARCHAR(50) DEFAULT "" AFTER user_nombres;');
    };
    if ($con->query("SHOW COLUMNS FROM final_users WHERE Field = 'user_apellido_2' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE final_users add column user_apellido_2 VARCHAR(50) DEFAULT "" AFTER user_apellidos;');
    };
    if ($con->query("SHOW COLUMNS FROM final_users WHERE Field = 'parent_ref' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE final_users add column parent_ref VARCHAR(50) DEFAULT "No aplica" AFTER child_number;');
    };

    if ($con->query("SHOW COLUMNS FROM user WHERE Field = 'user_dni' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE user add column user_dni VARCHAR(50) DEFAULT "" AFTER lastname;');
    };

    if ($con->query("SHOW COLUMNS FROM participants_list WHERE Field = 'lastname' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE participants_list add column lastname VARCHAR(50) DEFAULT "" AFTER name;');
    };
    if ($con->query("SHOW COLUMNS FROM participants_list WHERE Field = 'user_f_nacimiento' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE participants_list add column user_f_nacimiento DATE AFTER document_id;');
    };
    if ($con->query("SHOW COLUMNS FROM participants_list WHERE Field = 'user_nationality' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE participants_list add column user_nationality VARCHAR(50) DEFAULT "" AFTER name;');
    };
    if ($con->query("SHOW COLUMNS FROM participants_list WHERE Field = 'user_has_document' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE participants_list add column user_has_document VARCHAR(50) DEFAULT "" AFTER user_nationality;');
    };
    if ($con->query("SHOW COLUMNS FROM participants_list WHERE Field = 'parent_dni' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE participants_list add column parent_dni VARCHAR(50) DEFAULT "No aplica" AFTER document_id;');
    };
    if ($con->query("SHOW COLUMNS FROM participants_list WHERE Field = 'child_number' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE participants_list add column child_number INT AFTER parent_dni;');
    };
    if ($con->query("SHOW COLUMNS FROM participants_list WHERE Field = 'name_2' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE participants_list add column name_2 VARCHAR(50) DEFAULT "" AFTER name;');
    };
    if ($con->query("SHOW COLUMNS FROM participants_list WHERE Field = 'lastname_2' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE participants_list add column lastname_2 VARCHAR(50) DEFAULT "" AFTER lastname;');
    };
    if ($con->query("SHOW COLUMNS FROM participants_list WHERE Field = 'parent_ref' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE participants_list add column parent_ref VARCHAR(50) DEFAULT "No aplica" AFTER child_number;');
    };
    if ($con->query("SHOW COLUMNS FROM participants_list WHERE Field = 'uid_fac' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE participants_list add column uid_fac VARCHAR(50) DEFAULT "" AFTER id;');
    };
    if ($con->query("SHOW COLUMNS FROM participants_list WHERE Field = 'id_user_final' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE participants_list add column id_user_final VARCHAR(50) DEFAULT "" AFTER id;');
    };

    if ($con->query("SHOW COLUMNS FROM reports WHERE Field = 'specific_action' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE reports add column specific_action VARCHAR(500) DEFAULT "" AFTER report_type;');
    };
    if ($con->query("SHOW COLUMNS FROM reports WHERE Field = 'training_type' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE reports add column training_type VARCHAR(500) DEFAULT "" AFTER specific_action;');
    };
    if ($con->query("SHOW COLUMNS FROM reports WHERE Field = 'training_level' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE reports add column training_level VARCHAR(500) DEFAULT "" AFTER training_type;');
    };
    if ($con->query("SHOW COLUMNS FROM reports WHERE Field = 'info_id' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE reports add column info_id INT AFTER id;');
    };

    if ($con->query("SHOW COLUMNS FROM services_users WHERE Field = 'user_ocupacion' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE services_users add column user_ocupacion VARCHAR(500) DEFAULT "" AFTER user_profesion;');
    };
    if ($con->query("SHOW COLUMNS FROM services_users WHERE Field = 'info_id' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE services_users add column info_id INT AFTER user_id;');
    };
    if ($con->query("SHOW COLUMNS FROM services_users WHERE Field = 'user_comunity_type' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE services_users add column user_comunity_type VARCHAR(500) DEFAULT "N/A" AFTER user_genero;');
    };
    if ($con->query("SHOW COLUMNS FROM services_users WHERE Field = 'user_pertenece_organizacion' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE services_users add column user_pertenece_organizacion VARCHAR(500) DEFAULT "N/A" AFTER user_comunity_type;');
    };
    if ($con->query("SHOW COLUMNS FROM products_list WHERE Field = 'info_id' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE products_list add column info_id INT AFTER estate;');
    };
    if ($con->query("SHOW COLUMNS FROM participants_list WHERE Field = 'info_id' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE participants_list add column info_id INT AFTER estate;');
    };
    if ($con->query("SHOW COLUMNS FROM participants_list WHERE Field = 'user_comunity_type' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE participants_list add column user_comunity_type VARCHAR(500) DEFAULT "N/A" AFTER gender;');
    };
    if ($con->query("SHOW COLUMNS FROM participants_list WHERE Field = 'user_pertenece_organizacion' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE participants_list add column user_pertenece_organizacion VARCHAR(500) DEFAULT "N/A" AFTER user_comunity_type;');
    };



 
    if ($con->query("SHOW COLUMNS FROM products_type WHERE Field = 'tipo_categoria' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE products_type add column tipo_categoria VARCHAR(50) DEFAULT "" AFTER id;');
    };
    if ($con->query("SHOW COLUMNS FROM products_type WHERE Field = 'cod_producto' ")->num_rows != 1) {
        Executor::doit('ALTER TABLE products_type add column cod_producto VARCHAR(50) DEFAULT "" AFTER name;');
    };






    // if ($con->query("SHOW COLUMNS FROM strategic_action WHERE Field = 'k_info' ")->num_rows != 1){Executor::doit('ALTER TABLE strategic_action add column k_info INT AFTER id;');}; 
    // Executor::doit('ALTER TABLE specific_action ADD FOREIGN KEY (k_strategic) REFERENCES strategic_action(id) ON DELETE CASCADE ON UPDATE CASCADE;');

    // deshabilitar las claves foraneas para poder eliminar y editar las tablas secundarias
    Executor::doit('SET FOREIGN_KEY_CHECKS=0;');




    // Executor::doit('INSERT INTO etnia_type (name) value ("No aplica")');








    // crear tablas
    // table session
    if ($con->query("SHOW TABLES FROM lanubede_info_app WHERE Tables_in_lanubede_info_app = 'user_session' ")->num_rows != 1) {

        $table_1 = "user_session";
        $sql = "CREATE TABLE IF NOT EXISTS $table_1 (
        id INT(100) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        user_id INT(100),
        user_name VARCHAR(100) COLLATE latin1_spanish_ci,
        session_id VARCHAR(100) COLLATE latin1_spanish_ci,
        ip VARCHAR(100) COLLATE latin1_spanish_ci,
        fecha_reg datetime DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci";
        Executor::doit($sql)[1];
    }

    // categoria_productos
    if ($con->query("SHOW TABLES FROM infoappdb01 WHERE Tables_in_infoappdb01 = 'categoria_productos' ")->num_rows != 1) {
        $table_1 = "categoria_productos";
        $sql = "CREATE TABLE IF NOT EXISTS $table_1 (
        id INT(100) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        categoria VARCHAR(200) COLLATE latin1_spanish_ci,
        cod_categoria VARCHAR(50) COLLATE latin1_spanish_ci,
        fecha_reg datetime DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci";
        echo $table_1."-";
        print_r(Executor::doit($sql[1]));

        Executor::doit('INSERT INTO categoria_productos (categoria,cod_categoria) value ("Aplicación móvil","FI-OCE-01")');
        Executor::doit('INSERT INTO categoria_productos (categoria,cod_categoria) value ("Audios","FI-OCE-02")');
        Executor::doit('INSERT INTO categoria_productos (categoria,cod_categoria) value ("Diseño gráfico","FI-OCE-03")');
        Executor::doit('INSERT INTO categoria_productos (categoria,cod_categoria) value ("Escrito","FI-OCE-04")');
        Executor::doit('INSERT INTO categoria_productos (categoria,cod_categoria) value ("Fotografía","FI-OCE-05")');
        Executor::doit('INSERT INTO categoria_productos (categoria,cod_categoria) value ("Portal","FI-OCE-06")');
        Executor::doit('INSERT INTO categoria_productos (categoria,cod_categoria) value ("Radio","FI-OCE-07")');
        Executor::doit('INSERT INTO categoria_productos (categoria,cod_categoria) value ("Redes sociales","FI-OCE-08")');
        Executor::doit('INSERT INTO categoria_productos (categoria,cod_categoria) value ("Revista","FI-OCE-09")');
        Executor::doit('INSERT INTO categoria_productos (categoria,cod_categoria) value ("TV","FI-OCE-10")');
        Executor::doit('INSERT INTO categoria_productos (categoria,cod_categoria) value ("Videos","FI-OCE-11")');
    }






    // Crea registros
    // $table = "disability_type";
    // $field = "disability";
    // Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("No aplica")');
    // Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Física")');
    // Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Mental")');
    // Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Intelectual")');
    // Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Sensorial - Auditiva")');
    // Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Sensorial - Visual")');
    // Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Sensorial - Sordociega")');
    // Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Baja talla")');
    // Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Autismo")');
    // Executor::doit('INSERT INTO ' . $table . ' (' . $field . ') value ("Multiple")');
}






Core::$debug_sql = true;

// eliminar registros de varias tablas
// DELETE tablaA.*, tablaB.* FROM tablaA, TablaB WHERE tablaA.id = tablaB.id;

?>






<!-- VIEW HTML -->

<?php
if ($table_to_create != 0) {
    echo '<i class="fa fa-database"></i><h4 class="title">¡Hay <b>' . $table_to_create . '</b> tablas pendiente por crear!</h4>';
}
?>

<div class="row">
    <div class="col-md-12">

        <!-- Botones para crear las tablas inexistentes -->
        <?php if ($products_type == 1) { ?>
            <div class="col-lg-4">
                <a href="./index.php?view=database&setdb=1" class="btn btn-info btn-block">Crear tabla "products_type" en BD</a>
            </div>
        <?php } ?>

        <?php if ($personal_type == 1) { ?>
            <div class="col-lg-4">
                <a href="./index.php?view=database&setdb=2" class="btn btn-info btn-block">Crear tabla "personal_type"</a>
            </div>
        <?php } ?>

        <?php if ($final_users == 1) { ?>
            <div class="col-lg-4">
                <a href="./index.php?view=database&setdb=3" class="btn btn-info btn-block">Crear tabla "final_users"</a>
            </div>
        <?php } ?>

        <?php if ($services_users == 1) { ?>
            <div class="col-lg-4">
                <a href="./index.php?view=database&setdb=4" class="btn btn-info btn-block">Crear tabla "services_users"</a>
            </div>
        <?php } ?>

        <?php if ($etnia_type == 1) { ?>
            <div class="col-lg-4">
                <a href="./index.php?view=database&setdb=5" class="btn btn-info btn-block">Crear tabla "etnia_type"</a>
            </div>
        <?php } ?>

        <?php if ($disability_type == 1) { ?>
            <div class="col-lg-4">
                <a href="./index.php?view=database&setdb=6" class="btn btn-info btn-block">Crear tabla "disability_type"</a>
            </div>
        <?php } ?>

        <?php if ($info_social_map == 1) { ?>
            <div class="col-lg-4">
                <a href="./index.php?view=database&setdb=7" class="btn btn-info btn-block">Crear tabla "info_social_map"</a>
            </div>
        <?php } ?>

        <?php if ($info_social_map_educations == 1) { ?>
            <div class="col-lg-4">
                <a href="./index.php?view=database&setdb=8" class="btn btn-info btn-block">Crear tabla "info_social_map_educations"</a>
            </div>
        <?php } ?>

        <?php if ($create_info_social_map_organizations == 1) { ?>
            <div class="col-lg-4">
                <a href="./index.php?view=database&setdb=9" class="btn btn-info btn-block">Crear tabla "info_social_map_organizations"</a>
            </div>
        <?php } ?>

        <?php if ($create_survey_personal_technological_capabilities == 1) { ?>
            <div class="col-lg-4">
                <a href="./index.php?view=database&setdb=10" class="btn btn-info btn-block">Crear tabla "personal_technological_capabilities"</a>
            </div>
        <?php } ?>

        <?php if ($create_strategic_action == 1) { ?>
            <div class="col-lg-4">
                <a href="./index.php?view=database&setdb=11" class="btn btn-info btn-block">Crear tabla "strategic_action"</a>
            </div>
        <?php } ?>

        <?php if ($create_info_process == 1) { ?>
            <div class="col-lg-4">
                <a href="./index.php?view=database&setdb=12" class="btn btn-info btn-block">Crear tabla "info_process"</a>
            </div>
        <?php } ?>

        <?php if ($create_info_inventory == 1) { ?>
            <div class="col-lg-4">
                <a href="./index.php?view=database&setdb=13" class="btn btn-info btn-block">Crear tabla "info_inventory"</a>
            </div>
        <?php } ?>

        <?php if ($create_professions == 1) { ?>
            <div class="col-lg-4">
                <a href="./index.php?view=database&setdb=14" class="btn btn-info btn-block">Crear tabla "professions"</a>
            </div>
        <?php } ?>

        <?php if ($create_occupations == 1) { ?>
            <div class="col-lg-4">
                <a href="./index.php?view=database&setdb=15" class="btn btn-info btn-block">Crear tabla "occupations"</a>
            </div>
        <?php } ?>

        <?php if ($create_dimentions == 1) { ?>
            <div class="col-lg-4">
                <a href="./index.php?view=database&setdb=16" class="btn btn-info btn-block">Crear tablas de "dimensiones"</a>
            </div>
        <?php } ?>

        <?php if ($create_services_type == 1) { ?>
            <div class="col-lg-4">
                <a href="./index.php?view=database&setdb=17" class="btn btn-info btn-block">Crear tablas de "services_type"</a>
            </div>
        <?php } ?>


        <!-- Si no hay tablas pendien por crear -->
        <?php if ($table_to_create == 0) { ?>
            <div class="col-lg-4">
                <i class="fa fa-database"></i>
                <h4 class="title">¡La base de datos está completa!</h4>
                <!-- <a class="disabled" href="./index.php?view=database&setdb=true" class="btn btn-info btn-block">La base de datos está completa</a> -->
            </div>
        <?php } ?>



        <div class="col-lg-4">
            <a href="./index.php?view=database&alterdb=true" class="btn btn-info btn-block">Alter BD</a>
        </div>

    </div class="col-md-12">
</div class="row">