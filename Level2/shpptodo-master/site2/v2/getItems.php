<?php
require_once 'header.php';
require_once 'db_connect.php';


$sql_request = 'SELECT * FROM todolist';

$todolist_db = $mysqli->query($sql_request);

$todolist_arr = [
    ['items' => []]
];

while ($task = ($todolist_db->fetch_array(MYSQLI_ASSOC))) {

    $todolist_arr['items'][] = array('id' => $task['id'], 'text' => $task['text'], 'checked' => boolval($task['checked']));
}
$mysqli->close();
echo(json_encode($todolist_arr));
