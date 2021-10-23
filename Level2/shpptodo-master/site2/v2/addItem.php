<?php
require_once 'header.php';
require_once 'db_connect.php';

$request = json_decode(file_get_contents('php://input'),true);

if (strlen($request['text']) >0) {

    $text = $request['text'];

    $db_request = "INSERT INTO todolist (text, checked) VALUES ('$text',0)";

    $mysqli->query($db_request);

    $get_last_id = $mysqli->insert_id;

    echo json_encode(array("id" => $get_last_id));

}
