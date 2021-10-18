<?php
require_once 'config.php';
include 'db_connect.php';


$sql_request = 'SELECT * FROM todolist';

$todolist = mysqli_query($db_connect, $sql_request);

$array_out = [
    ['items' => []]
];

while ($row = mysqli_fetch_array($todolist)) {
    $array_out['items'][] = array('id' => $row['id'], 'text' => $row['text'], 'checked' => boolval($row['checked']));
}
echo(json_encode($array_out));
