<?php
const HOST = 'mysql';
const USER = 'root';
const PASSWORD = 'root';
const TABLE = 'shpp';
try {
    $db_connect = mysqli_connect(HOST, USER, PASSWORD, TABLE);
} catch (mysqli_sql_exception $e) {
    die('Connect ERROR ' . $e);
}
