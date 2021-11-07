<?php
require_once 'header.php';
require_once 'db_connect.php';

$request = json_decode(file_get_contents('php://input'),true);

if (strlen($request['id'] ) > 0) {

    $id = $request['id'];

    $db_request = "DELETE FROM $tableName WHERE id = '$id'";

    if (!$mysqli->query($db_request)){

        print "Invalid DB query";
        die("Invalid DB query");
    }
    echo json_encode(array("ok" => true));
}
$mysqli->close();

