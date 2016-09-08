<?php
/**
 * Created by PhpStorm.
 * User: nj
 * Date: 16/8/24
 * Time: 15:24
 */

require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

//建立链接
$con = new AMQPStreamConnection('127.0.0.1', 5672, 'guest', 'guest');
if (!$con) {
    die('cannot connect');
}
$channel = $con->channel();

$channel->exchange_declare('logs', 'fanout', false, false, false);
$data = implode(' ', array_slice($argv, 1));
file_put_contents("data.txt",var_dump($data),8);
if (empty($data)) {
    $data = "info:hello";
}
file_put_contents("data2.txt",var_dump($data),8);
$msg = new AMQPMessage($data);

#发送消息
$channel->basic_publish($msg, 'logs');
//file_put_contents("1.txt",var_dump($channel),8);
echo "[x] Sent ",$data,"\n";

//关闭链接
$channel->close();
$con->close();
















