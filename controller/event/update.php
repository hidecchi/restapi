<?php

header('Access-Control-Allow-Origin: *');
header("Content-type:application/json");
header('Access-Control-Allow-Methods: PUT');
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
$event->id = $data['id'];

if ($event->name == null || $event->category == null || $event->detail == null || $event->date == null || $event->id == null) {
    die();
}

if ($event->update()) {
    echo json_encode(
        array('message' => 'イベントが更新されました。'),
        JSON_UNESCAPED_UNICODE
    );
} else {
    echo json_encode(
        array('message' => 'イベントが更新されませんでした。'),
        JSON_UNESCAPED_UNICODE
    );
}
