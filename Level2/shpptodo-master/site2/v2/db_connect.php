<?php
const HOST = 'mysql';
const USER = 'root';
const PASSWORD = 'root';
const TABLE = 'shpp';
try {
    $mysqli = new mysqli(HOST, USER, PASSWORD, TABLE);
} catch (mysqli_sql_exception $exception) {
    die('Connect ERROR ' . $exception);
}
