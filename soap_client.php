<?php
/**
 * Created by PhpStorm.
 * User: nj
 * Date: 16/9/2
 * Time: 16:27
 */

$client = new SoapClient(null, array(
    "location" => "http://test.cc/soap_client.php",
    'uri' => 'http://test.cc/soap_server.php',
    'style' => SOAP_RPC,
    'use' => SOAP_ENCODED,
    'trace' => 1,
    'exceptions' => 0
));

$rt = $client->getTime();
$addRes = $client->add(1,6);
echo 'addRes:'.$addRes."<br/>";
echo 'time is :'.$rt;
