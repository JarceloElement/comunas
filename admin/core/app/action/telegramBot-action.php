<?php

$input = file_get_contents('php://input');
$data = json_decode($input, true);
$message = isset($data['message']) ? $data['message'] : null;

$bot_token = "7009360168:AAHHfT7t4u0FJ6jvUgx37Bi4OZzPqFZ8dUc"; // Reemplaza con tu token de bot
$chat_id = "-1002210130983"; // Reemplaza con el ID del chat | -1001950174259/647 Info | -1002210130983/15 LN | Jarcelo: 1023233085
$topic_id = "15"; // Reemplaza con el ID del tema
// $message = "Esto es un ejemplo";


// $url_get = "https://api.telegram.org/bot7009360168:AAHHfT7t4u0FJ6jvUgx37Bi4OZzPqFZ8dUc/getUpdates"; // Consultar mensajes recibidos
$url = "https://api.telegram.org/bot" . $bot_token . "/sendMessage";
$data = array(
    'chat_id' => $chat_id,
    'message_thread_id' => $topic_id, // Activar si se usa un tema en un grupo
    'reply_markup' => json_encode(array(
        'inline_keyboard' => array(
            array(
                array(
                    'text' => 'Ver más',
                    'url' => 'http://infoapp2.infocentro.gob.ve'
                )
            )
        )
    )),
    'text' => $message,
    'parse_mode' => "HTML"
);

// $ch = curl_init($url);
$ch = curl_init();
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, $url);
$result = curl_exec($ch);
curl_close($ch);

// Manejar la respuesta (opcional)

$array = array(
    "array"  => 'null',
    "message"  => 'null',
);

$response = json_decode($result);


if ($result === false) {
    $array = array(
        "array"  => 'null',
        "message"  => "Error al enviar el mensaje: " . $response->error_code,
    );
    echo json_encode($array);
} else {

    if ($response->ok) {
        $array = array(
            "array"  => $result,
            // "message"  => "Mensaje enviado con éxito:" . $response->description, // PHP 8
            "message"  => "Mensaje enviado: " . json_encode($response->result), // PHP 7
        );
    } else {
        $array = array(
            "array"  => $result,
            "message"  => "Error al enviar el mensaje: " . $response->error_code,
        );
    }
    echo json_encode($array);
}
