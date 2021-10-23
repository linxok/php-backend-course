<?php
require_once('header.php');

$request = json_decode(file_get_contents('php://input'),true);

if (is_array($request)){

    $todo_list = json_decode(file_get_contents("todo.json"),true);

    foreach ($todo_list['items'] as $item => $current){
        if ($current['id'] == $request['id']){
            $todo_list['items'][$item]['text'] = $request['text'];
            $todo_list['items'][$item]['checked'] = $request['checked'];

        }
    }
    file_put_contents("todo.json",json_encode($todo_list));

   echo json_encode(["ok"=> true]);

}