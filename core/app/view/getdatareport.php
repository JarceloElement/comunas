<?php 

include ('../../controller/Database.php');
$db = Database::connectPDO();

// Database connection info 
// $dbDetails = array( 
// 'host' => '192.99.147.218', 
// 'user' => 'infoadmin', 
// 'pass' => 'infoadmin2050', 
// 'db'   => 'info_app'
// ); 

// mysql db table to use 
$table = 'info_social_map'; 
// Table's primary key 
$primaryKey = 'id'; 
// Array of database columns which should be read and sent back to DataTables. 
// The `db` parameter represents the column name in the database.  
// The `dt` parameter represents the DataTables column identifier. 
$columns = array( 
array( 'db' => 'info_state', 'dt' => 0 ),
array( 'db' => 'code_info', 'dt' => 1 ), 
array( 'db' => 'responsability_email', 'dt' => 2 ),
array( 'db' => 'communes_quantity', 'dt' => 3 ),
array( 'db' => 'c_comunal_quantity', 'dt' => 4 ),
array( 'db' => 'other_organizations', 'dt' => 5 ),
array( 'db' => 'other_organizations_related_to_info', 'dt' => 6 ),
array( 'db' => 'organizations_activities_on_info', 'dt' => 7 ),
array( 'db' => 'ventures_around_info', 'dt' => 8 )


);

// Include SQL query processing class 
require ('ssp.class.php');

if (isset($_GET['where'])){
    $where=$_GET['where'];

};

// $where="pais='Argentina' ";

// Output data as json format 
echo json_encode( 
// SSP::simple($_GET, $dbDetails, $table, $primaryKey, $columns,)
SSP::complex( $_GET, $db, $table, $primaryKey, $columns, null, $where )
);
