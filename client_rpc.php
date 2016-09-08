<?php

/**
 * Created by PhpStorm.
 * User: nj
 * Date: 16/9/2
 * Time: 16:07
 */
include "phprpc/phprpc_client.php";

$client = new PHPRPC_Client('http://test.cc/client_rpc.php');
echo $client->hello();