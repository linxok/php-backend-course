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
        if ($line == "\r\n")
            break;
    }
    if ($toread > 0)
        $store .= fread($f, $toread);
    return $store;
}

$contents = readHttpLikeInput();

function outputHttpResponse($statuscode, $statusmessage, $headers, $body) {

    echo "HTTP/1.1 " .$statuscode . " " . $statusmessage;
    echo "\n";
    echo 'Server: Apache/2.2.14 (Win32)';
    echo "\n";
    echo 'Connection: Closed';
    echo "\n";
    echo 'Content-Type: text/html; charset=utf-8';
    echo "\n";
    echo 'Content-Length: ' . $headers['Content-Length'];
    echo "\n";
    echo "\n";
    echo $body;

}

function processHttpRequest($method, $uri, $headers, $body) {
    $statusmessage ='';
    $statuscode ='';
    $bodysuma ="";

    if (!(strpos($uri, "/sum") === 0) ){
        $statuscode = "404";
        $statusmessage = "Not Found";
        $body = 'not found';
    }
    if (($daposition = strpos($uri, "?nums=")) && ($statuscode =="") ){

        $bodysuma = explode(",",substr($uri, $daposition + strlen('?nums=' )));

        $summ =0;
        for ($i =0; $i < count($bodysuma); $i++){
            $summ += $bodysuma[$i];
        }
        $body = $summ;
        $headers['Content-Length'] = strlen((string)$body);
    } elseif($statuscode == ''){
        $statuscode = "400";
        $statusmessage = "Bad Request";
        $body = 'not found';
    }

    if (($method == "GET") && ($statuscode =='')){
        $statuscode ='200'; $statusmessage ='OK';

    }

    outputHttpResponse($statuscode, $statusmessage, $headers, $body);
}

function parseTcpStringAsHttpRequest($string) {
    return array(
        "method" => "GET",
        "uri" => "/sum?nums=1,2,3,4",
        "headers" => array(
            "Host" => "shpp.me",
            "Accept'"=> "image/gif, image/jpeg, */*",
            "Accept-Language"=>"en-us",
            "Accept-Encoding"=>"gzip, deflate",
            "User-Agent"=>"Mozilla/4.0",
            "Content-Length"=>"35"),
        "body" => "",
    );
}

$http = parseTcpStringAsHttpRequest($contents);
processHttpRequest($http["method"], $http["uri"], $http["headers"], $http["body"]);
