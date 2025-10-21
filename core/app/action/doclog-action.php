<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require ('core/app/view/conexion.php');
$db = Database::connect();




// $filename = $_POST['filename'];
// $fields[] = explode(",",$_POST['fields']);

// $query = $db->prepare("SELECT * from info_social_map WHERE user_type = 2 ");

$query = $db->prepare("INSERT INTO log_doc (user_id, code_info, description) VALUES (?, ?, ?)");
$query->bind_param('iss', $user_id, $code_info, $description);

// $stmt = mysqli_prepare($db, "INSERT INTO log_doc (user_id, code_info, description) VALUES (?, ?, ?)");
// mysqli_stmt_bind_param($stmt, 'iss', $user_id, $code_info, $description);

$user_id = $_POS['user_id'];
$code_info = $_POS['code_info'];
$description = $_POS['description'];

/* ejecuta sentencias prepradas */
$query->execute();
// mysqli_stmt_execute($stmt);

// $res = $query->fetchAll(PDO::FETCH_ASSOC);

?>

