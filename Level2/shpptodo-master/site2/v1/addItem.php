<?php
require_once('config.php');

$request = json_decode(file_get_contents('php://input'),true);

if (strlen($request['text']) >0) {

    $todo_list = json_decode(file_get_contents("todo.json"),true);
    $id = file_get_contents("count_id");
    file_put_contents("count_id", ++$id);

    $new_task = array(
        "id"        => $id,
        "text"      => $request['text'],
        "checked"   => false
    );

    $todo_list['items'][] = $new_task;

    file_put_contents("todo.json",json_encode($todo_list));

    echo json_encode(["id"=> $id]);
}

