<?php
phpinfo();

// // Start Session
// session_start();
// // Show banner
// echo '<b>Session Support Checker</b><hr />';
// // Check if the page has been reloaded
// if(!isset($_GET['reload']) OR $_GET['reload'] != 'true') {
//    // Set the message
//    $_SESSION['MESSAGE'] = 'Session support enabled!<br />';
//    // Give user link to check
//    echo '<a href="?reload=true">Click HERE</a> to check for PHP Session Support.<br />';
// } else {
//    // Check if the message has been carried on in the reload
//    if(isset($_SESSION['MESSAGE'])) {
//       echo $_SESSION['MESSAGE'];
//    } else {
//       echo 'Sorry, it appears session support is not enabled, or your PHP version is too old. <a href="?reload=false">Click HERE</a> to go back.<br />';
//    }
// }

// include('core/controller/DatabasePg.php');

// $conn = DatabasePg::connectPg();
// $row_table = $conn->prepare("SELECT * from infocentros where cod = 'AMA16' ");
// $row_table->execute();
// $info = $row_table->fetchAll(PDO::FETCH_ASSOC);
// print_r($info);
