<?php

header('Access-Control-Allow-Origin: *');
header("Content-type:application/json");

include_once '../../config/database.php';
include_once '../../model/event.php';

$database = new Database();
$db = $database->connect();

$event = new Event($db);
$event->id = isset($_GET['id']) ? $_GET['id'] : die();

$result = $event->read_single();
$event_array= array();
$event_array['data'] = $result;
echo json_encode($event_array, JSON_UNESCAPED_UNICODE);
