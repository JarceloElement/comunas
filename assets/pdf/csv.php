<?php
// require ('../core/app/view/conexion.php');
// $conn = Database::connect();

// CODIGO PARA PHP 7 

/* vars for export */
// database record to be exported
// $db_record = 'reports';
// optional where query
//$where = 'WHERE 1 ORDER BY 1';
// filename for export
// $csv_filename = $db_record.'.csv';
// database variables
$hostname = "localhost";
$user = "lanubede_infoadmin";
$password = "infoadmin#2050";
$database = "lanubede_info_app";
$port = 3306;


// $conn = mysqli_connect($dbHost, $dbUsername, $dbUserpassword, $dbName, $port);
$conn = mysqli_connect($hostname, $user, $password, $database, $port);
$conn->set_charset("utf8");

/* change character set to utf8 */
if (!$conn->set_charset("utf8")) {
    printf("", $conn->error);
} else {
    printf("", $conn->character_set_name());
}


if (mysqli_connect_errno()) {
    die("Falló al conectar a MySQL: " . mysqli_connect_error());
}



$param_csv = $_GET["param_csv"];
$param_sql = $_GET["param_sql"];
$DB_name = $_GET["DB_name"];



// create empty variable to be filled with export data
$csv_export = '';
$csv_filename = $DB_name.'.csv';

// query to get data from database
if ($param_sql == "true"){
    $query = mysqli_query($conn, $param_csv);
}else{
    $query = mysqli_query($conn, "SELECT * FROM ".$param_csv);
}
$field = mysqli_field_count($conn);



// create line with field names
for($i = 0; $i < $field; $i++) {
    $csv_export.= mysqli_fetch_field_direct($query, $i)->name.'|'; //delimitador de campos
}


// newline (seems to work both on Linux & Windows servers)
$csv_export.= '
';

// loop through database query and fill export variable
while($row = mysqli_fetch_array($query)) {
    // create line with field values
    for($i = 0; $i < $field; $i++) {
        $csv_export.= '"'.$row[mysqli_fetch_field_direct($query, $i)->name].'"|'; //delimitador de campos registros
    }
    $csv_export.= '
';
}



// // Export the data and prompt a csv file for download
header("Content-type: text/x-csv");
header("Content-Disposition: attachment; filename=".$csv_filename."");
echo($csv_export);
// echo("\nParámetros de consulta: ".$param_csv);
// echo "<script type='text/javascript'> alert('$param_csv'); </script>"; // Pasar var desde PHP a JS



?>