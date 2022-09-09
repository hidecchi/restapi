<?php

header('Access-Control-Allow-Origin: *');
header("Content-type:application/json");


include_once '../../config/database.php';
include_once '../../model/event.php';

$database = new Database();
$db = $database->connect();
$event = new Event($db);

$result = $event->read();
$num = $result->rowCount();

if ($num > 0) {
    $event_array = array();
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        array_push($event_array, $row);
    }
    echo json_encode($event_array, JSON_UNESCAPED_UNICODE);
} else {
    echo json_encode(array('message' => '登録されているイベントはありません。'), JSON_UNESCAPED_UNICODE);
}
