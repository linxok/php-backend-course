<?php

// не обращайте на эту функцию внимания
// она нужна для того чтобы правильно считать входные данные
function readHttpLikeInput() {
    $f = fopen( 'php://stdin', 'r' );
    $store = "";
    $toread = 0;
    while( $line = fgets( $f ) ) {
        $store .= preg_replace("/\r/", "", $line);
        if (preg_match('/Content-Length: (\d+)/',$line,$m))
            $toread=$m[1]*1;
        if ($line == "\n")
            break;
    }
    if ($toread > 0)
        $store .= fread($f, $toread);
    return $store;
}

$contents = readHttpLikeInput();

function outputHttpResponse($statuscode, $statusmessage, $headers, $body) {

    echo "HTTP/1.1 " .$statuscode . " " . $statusmessage;  echo "\n";
    echo 'Server: Apache/2.2.14 (Win32)'; echo "\n";
    echo 'Content-Length: ' . ($headers['Content-Length']);  echo "\n";
    echo 'Connection: Closed';  echo "\n";
    echo 'Content-Type: text/html; charset=utf-8';  echo "\n";   echo "\n";
    echo $body;

}

function processHttpRequest($method, $uri, $headers, $body) {
    $statusmessage ='';
    $statuscode ='';
    $bodysuma ="";

    if (!(strpos($uri, "/api") === 0) ){
        $statuscode = "404";
        $statusmessage = "Not Found";
        $body = 'not found';
    }
    if ((strpos($uri, "/checkLoginAndPassword")) && ($statuscode =="") ){
        parse_str($body, $parsearray);

        if (!(($parsearray['login']) && ($parsearray['password']))){
            $statuscode = "400";
            $statusmessage = "Bad Request";
            $body = 'not found';
        }

        if ($file = file_get_contents('./passwords.txt')){

            $explarraq =explode("\n",$file);
            for($i=0; $i< count($explarraq);$i++){
                $log_pass =explode(":",$explarraq[$i]);
                if ($log_pass[0] == $parsearray['login'] || $log_pass[1] == $parsearray['password'] ){
                    $body = '<h1 style="color:green">FOUND</h1>';
                }
            }
        }else{
            $statuscode ='500'; $statusmessage ='Internal Server Error';
        }

    }

    if (($method == "POST") && ($statuscode =='')){
        $statuscode ='200'; $statusmessage ='OK';

    }

    outputHttpResponse($statuscode, $statusmessage, $headers, $body);
}

function parseTcpStringAsHttpRequest($string) {
    return array(
        "method" => "POST",
        "uri" => "/api/checkLoginAndPassword",
        "headers" => array(
            "Host" => "shpp.me",
            "Accept'"=> "*/*",
            "Content-Type"=>"application/x-www-form-urlencoded",
            "User-Agent"=>"Mozilla/4.0",
            "Content-Length"=>"35"),
        "body" => "login=student&password=12345",
    );
}

$http = parseTcpStringAsHttpRequest($contents);
processHttpRequest($http["method"], $http["uri"], $http["headers"], $http["body"]);
