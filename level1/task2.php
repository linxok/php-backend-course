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

function parseTcpStringAsHttpRequest($string) {
    return array(
        "method" => 'POST',
        "uri" => '/doc/test',
        "headers" =>[
            ['Host' , 'shpp.me'],
            ['Accept', 'image/gif, image/jpeg, */*'],
            ['Accept-Language','en-us'],
            ['Accept-Encoding','gzip, deflate'],
            ['User-Agent','Mozilla/4.0'],
            ['Content-Length','35']
        ],
        "body" => 'bookId=12345&author=Tan+Ah+Teck',
    );
}

$http = parseTcpStringAsHttpRequest($contents);
echo(json_encode($http, JSON_PRETTY_PRINT));
