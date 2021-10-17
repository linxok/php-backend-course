<?php
require_once('config.php');

$file = file_get_contents('todo.json');

echo $file;

unset($file);