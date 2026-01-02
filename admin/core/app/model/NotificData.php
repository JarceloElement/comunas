<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class NotificData
{
    public static $bot_token = "7009360168:AAHHfT7t4u0FJ6jvUgx37Bi4OZzPqFZ8dUc";

    public $t_post;
    public $chat_id;
    public $topic_id;
    public $message;
    public $id_activity;
    public $url;

    public function __construct()
    {
        $this->t_post = "";
        $this->chat_id = "";
        $this->topic_id = "";
        $this->message = "";

        $this->url = "";
    }

    public function sendTelegram()
    {

        $this->chat_id = "-1002743612224"; // Reemplaza con el ID del chat | -1002743612224/3 Info | -1002210130983/15 LN |
        $this->topic_id = "3"; // Reemplaza con el ID del tema

        $bot_token = self::$bot_token;
        $chat_id = $this->chat_id; // Reemplaza con el ID del chat
        $topic_id = $this->topic_id; // Reemplaza con el ID del tema
        $t_post = $this->t_post = "https://api.telegram.org/bot" . $bot_token . "/sendMessage";
        $message = $this->message; // Tu mensaje
        $url = $this->url; // Tu mensaje

        $data = array(
            'chat_id' => $chat_id,
            'message_thread_id' => $topic_id, // Activar si se usa un tema en un grupo
            'reply_markup' => json_encode(array(
                'inline_keyboard' => array(
                    array(
                        array(
                            'text' => 'REVISAR',
                            'url' => $url
                        )
                    )
                )
            )),
            'text' => $message,
            'parse_mode' => "HTML"
        );


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $t_post);
        $result = curl_exec($ch);
        curl_close($ch);

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
    }

    public function sendTelegram2()
    {

        $this->chat_id = "-1002210130983"; // Reemplaza con el ID del chat | -1002743612224/3 Info | -1002210130983/15 LN |
        $this->topic_id = "15"; // Reemplaza con el ID del tema

        $bot_token = self::$bot_token;
        $chat_id = $this->chat_id; // Reemplaza con el ID del chat
        $topic_id = $this->topic_id; // Reemplaza con el ID del tema
        $t_post = $this->t_post = "https://api.telegram.org/bot" . $bot_token . "/sendMessage";
        $message = $this->message; // Tu mensaje
        $url = $this->url; // Tu mensaje

        $data = array(
            'chat_id' => $chat_id,
            'message_thread_id' => $topic_id, // Activar si se usa un tema en un grupo
            'reply_markup' => json_encode(array(
                'inline_keyboard' => array(
                    array(
                        array(
                            'text' => 'REVISAR',
                            'url' => $url
                        )
                    )
                )
            )),
            'text' => $message,
            'parse_mode' => "HTML"
        );


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $t_post);
        $result = curl_exec($ch);
        curl_close($ch);

        $array = array(
            "array"  => 'null',
            "message"  => 'null',
        );

        $response = json_decode($result);

        if ($result === false) {
            $array = array(
                "array"  => 'null',
                "message"  => "Error desde la api: " . $response,
            );
            echo json_encode($array);
        } else {

            if ($response->ok) {
                $array = array(
                    "array"  => "True",
                    // "message"  => "Mensaje enviado con éxito:" . $response->description, // PHP 8
                    "message"  => "Mensaje enviado: " . json_encode($response->result), // PHP 7
                );
            } else {
                $array = array(
                    "array"  => "False",
                    "message"  => "Error al enviar el mensaje: " . $response->error_code,
                );
            }
            echo json_encode($array);
        }
    }
}
