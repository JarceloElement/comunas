<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

include ('../../controller/Database.php');
$db = Database::connectPDO();

// $user_id = $_GET['user'];
// $code_info = $_GET['code'];
// $description = $_GET['des'];

$user_id = $_GET['user_id'];
$code_info = $_GET['code_info'];
$video_view = $_GET['video_view'];
$description = $_GET['description'];

// $user_id = $_POS['user_id'];
// $code_info = $_POS['code_info'];
// $description = $_POS['description'];

// $filename = $_POST['filename'];
// $fields[] = explode(",",$_POST['fields']);

// $query = $db->prepare("SELECT * from info_social_map WHERE user_type = 2 ");

$query = $db->prepare("INSERT INTO log_doc(user_id, code_info, video_view, description) VALUES (?, ?, ?, ?)");
// $query->bindParam('iss', $user_id, $code_info, $description);
$query->bindParam(1, $user_id, PDO::PARAM_INT);
$query->bindParam(2, $code_info, PDO::PARAM_STR);
$query->bindParam(3, $video_view, PDO::PARAM_STR);
$query->bindParam(4, $description, PDO::PARAM_STR);
// $stmt = mysqli_prepare($db, "INSERT INTO log_doc (user_id, code_info, description) VALUES (?, ?, ?)");
// mysqli_stmt_bind_param($stmt, 'iss', $user_id, $code_info, $description);



/* ejecuta sentencias prepradas */
$query->execute();
// mysqli_stmt_execute($stmt);

// $res = $query->fetchAll(PDO::FETCH_ASSOC);

?>

