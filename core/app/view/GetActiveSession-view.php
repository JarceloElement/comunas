<?php

$ip = $_SERVER['REMOTE_ADDR'];
$user_id = $_SESSION['user_id'];
$session_id = session_id() . "-" . $user_id . "\n";

$array = file("uploads/usuarios.dat");
$contenido = $ip . "&" . time();
$exist = 0;

// si ya existe
// for ($i = 0; $i < sizeof($array); $i++) {
//   $tmp = explode("&", $array[$i]);
//   if($tmp[0] == $ip){
//     return;
//   }
// }

foreach ($array as $a) {
  if ($a == $session_id) {
    $exist = 1;
  }
}


if ($exist == 0 && $user_id != "") {
  $fp = fopen("uploads/usuarios.dat", "w");
  $new_cont = implode('', $array) . $session_id;
  fputs($fp, $new_cont);
  fclose($fp);
  // echo "Agregar";
} elseif ($exist == 1 && $user_id == "") {
  foreach ($array as $a => $var) {
    if ($array[$a] == $session_id) {
      unset($array[$a]);
      file_put_contents("uploads/usuarios.dat", $array);
    }
  }
}

if ($user_id != "") {
  $active = "1";
} else {
  $active = "0";
  // echo $user_id;
}



// Otra forma
// $new_array = file("uploads/usuarios.dat");
// $fp = fopen("uploads/usuarios.dat", "w");
// $array = implode('', $new_array);
// fwrite($fp, $array);
// fclose($fp);



// $USUARIOS_ACTIVOS = count($array);
// echo "Hay " . $USUARIOS_ACTIVOS . " usuarios activos";



$data = array(
  "error"  => "no error",
  "active"  => $session_id
);
echo json_encode($data);
