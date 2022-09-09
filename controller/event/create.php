<?php
header('Access-Control-Allow-Origin: *');
header("Content-type:application/json");
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');
// header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,
// Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/database.php';
include_once '../../model/event.php';

$database = new Database();
$db = $database->connect();

$event = new Event($db);

$data = json_decode(file_get_contents("php://input"), true);
$event->name = $data['name'];
$event->category = $data['category'];
$event->detail = $data['detail'];
$event->date = $data['date'];

if ($event->name == null || $event->category == null || $event->detail == null || $event->date == null) {
    die();
}

if ($event->create()) {
    echo json_encode(
        array('message' => 'イベントが登録されました。'),
        JSON_UNESCAPED_UNICODE
    );
} else {
    echo json_encode(
        array('message' => 'イベントが登録されませんでした。'),
        JSON_UNESCAPED_UNICODE
    );
}
