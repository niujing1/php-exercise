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

$channel->exchange_declare('direct_logs', 'direct', false, false, false);
$severity = isset($argv[1]) && !empty($argv[1]) ? $argv[1] : "info";
$data = implode(' ', array_slice($argv, 2));

if (empty($data)) {
    $data = "info:hello";
}
file_put_contents("data2.txt", var_dump($data), 8);
$msg = new AMQPMessage($data);

#发送消息
$channel->basic_publish($msg, 'direct_logs', $severity);
echo "[x] Sent ", $severity, ':', $data, "\n";

//关闭链接
$channel->close();
$con->close();
















