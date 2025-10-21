<?php 
	require ('../../../core/controller/Database_admin.php');
    $db = Database::connectPDO();

// Database connection info 
$dbDetails = array( 
'host' => '192.99.147.218', 
'user' => 'infoadmin', 
'pass' => 'infoadmin2050', 
'db'   => 'info_app'
); 
// mysql db table to use 
$table = 'reports'; 
// Table's primary key 
$primaryKey = 'id'; 
// Array of database columns which should be read and sent back to DataTables. 
// The `db` parameter represents the column name in the database.  
// The `dt` parameter represents the DataTables column identifier. 
$columns = array( 
array( 'db' => 'code_info', 'dt' => 1 ), 
array( 'db' => 'line_action',  'dt' => 2 ), 
array( 'db' => 'estate',      'dt' => 3 ), 
array( 'db' => 'activity_title',     'dt' => 4 ), 
array( 'db' => 'date_pub',  'dt' => 5, ),
array( 'db' => 'report_type',  'dt' => 6, ),
array( 'db' => 'responsible_name',  'dt' => 7, ),
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