<?php

header('Access-Control-Allow-Origin: *');
header("Content-type:application/json");
header('Access-Control-Allow-Methods: DELETE');
// header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,
// Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/database.php';
include_once '../../model/event.php';

$database = new Database();
$db = $database->connect();

$event = new Event($db);

$data = json_decode(file_get_contents("php://input"), true);
$event->id = $data['id'];
// $event->id = 4;

// if ($event->id == null) {
//     die();
// }
var_dump($data);

if ($event->delete()) {
    echo json_encode(
        array('message' => 'イベントが削除されました。'),
        JSON_UNESCAPED_UNICODE
    );
} else {
    echo json_encode(
        array('message' => 'イベントが削除されませんでした。'),
        JSON_UNESCAPED_UNICODE
    );
}
