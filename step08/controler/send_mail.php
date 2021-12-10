<?php

error_reporting(-1);
ini_set('display_errors', 'On');
set_error_handler("var_dump");

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With"); 

$data = json_decode(file_get_contents("php://input"));
var_dump($data);
var_dump($data->content);

$message = "Their message is :\r\n".$data->content."\r\nYou can contact them on phone ".$data->email_sender." or ".$data->tel_sender.".";
$message = wordwrap($message, 70, "\r\n");
var_dump(mail(
    "elliazabini@gmail.com",
    "You receive a answer to your job offer from ",
    "loremkjbfiuqbgdiugbeiuppgbgduigbepIOGHSODĜiNEUGBdmk",
    array(
        'From' => 'webmaster@example.com',
        'Reply-To' => 'webmaster@example.com',
        'X-Mailer' => 'PHP/' . phpversion()
    )
)
);
?>