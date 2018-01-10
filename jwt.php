<?php
/**
 * Created by PhpStorm.
 * User: darkmath
 * Date: 30/06/2017
 * Time: 22:39
 */


$header = [
    'alg'=>'HS256', //HMAC - Cryptography SHA-256, key
    'typ'=>'JWT'
];

$payload = [
    'name' => 'Matheus',
    'email'=>'mgbortoletto@gmail.com',
    'role'=>'ADMIN',

    ];


$header = json_encode($header);
$payload = json_encode($payload);

echo "Header: ".$header;
echo "\n\n";
echo "Payload: ".$payload;
echo "\n\n";
$header = base64_encode($header);
$payload = base64_encode($payload);

$key = "ITSTHISMYKEY?";

$signature = hash_hmac('sha256',"$header.$payload", $key, true);


echo "Header: ".$header;
echo "\n\n";
echo "Payload: ".$payload;
echo "\n\n";
echo "Signature RAW: ".$signature;
echo "\n\n";

$signature=base64_encode($signature);

echo "Signature BASE64: ".$signature;
echo "\n\n";
echo "Token: "."$header.$payload.$signature";