<?php
require_once('header.php');

$file = file_get_contents('todo.json');

echo $file;

unset($file);