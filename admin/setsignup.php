
<?php
// include "core/controller/Core.php";
$debug= true;
if($debug){
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
}
Core::$logintype="signup";
// print "<script>window.location='index.php';</script>";
echo "XX".Core::$logintype;


?>
