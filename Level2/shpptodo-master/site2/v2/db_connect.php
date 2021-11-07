<?php
const HOST = 'mysql';
const USER = 'root';
const PASSWORD = 'root';
const DATABASE = 'shpp';

$tableName = 'todolist';
try {
    $mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);

    $sql = "CREATE TABLE IF NOT EXISTS $tableName (id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    text VARCHAR(255), checked INT)";
    $mysqli->query($sql);

} catch (mysqli_sql_exception $exception) {
    die('Connect ERROR ' . $exception);
}
