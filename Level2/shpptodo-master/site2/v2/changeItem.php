<?php
require_once 'header.php';
require_once 'db_connect.php';

$request = json_decode(file_get_contents('php://input'),true);

if (strlen($request['text'] ) > 0) {

    $id = $request['id'];
    $text = $request['text'];
    $checked = $request['checked'] ? 1 : 0;

    $db_request = "UPDATE todolist SET text = $text, checked = $checked WHERE id = $id";

    if (!$mysqli->query($db_request)){

        print "Invalid DB query";
        die("Invalid DB query");
    }
    echo json_encode(array("id" => $id));
}
$mysqli->close();

