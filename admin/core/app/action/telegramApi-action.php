<?php

// PHP 8.2+ is required.

// Instala MadelineProto si no existe
if (!file_exists('madeline.php')) {
    copy('https://phar.madelineproto.xyz/madeline.php', 'madeline.php');
}
include 'madeline.php';

if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/vendor/autoload.php';
}

use danog\MadelineProto\API;

// Configura tus credenciales de Telegram (reemplaza con tus datos)
$settings = [
    'app_info' => [
        'api_id' => 24942097, // Tu api_id de Telegram
        'api_hash' => '790ec288a4214e9383bb85a526afbb7b', // Tu api_hash de Telegram
    ],
];

$MadelineProto = new API('session.madeline', $settings);

// Inicia sesión (la primera vez pedirá código de Telegram en consola)
$MadelineProto->start();

// Ejemplo: enviar un mensaje a un usuario/canal/chat
try {
    $peer = '@jarcelo'; // Reemplaza con username, número o ID de chat
    $message = '¡Hola desde MadelineProto!';
    $result = $MadelineProto->messages->sendMessage([
        'peer' => $peer,
        'message' => $message,
    ]);
    echo "Mensaje enviado correctamente:\n";
    print_r($result);
} catch (Exception $e) {
    echo "Error al enviar el mensaje: " . $e->getMessage();
}



$array = array(
    "array"  => 'null',
    "message"  => $result,
);

// if ($result === false) {
//     $array = array(
//         "array"  => 'null',
//         "message"  => "Error al enviar el mensaje.",
//     );
// } else {
//     $array = array(
//         "array"  => $res,
//         "message"  => "Mensaje enviado correctamente.",
//     );
// }
echo json_encode($array);
