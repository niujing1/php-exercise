<?php
/**
 * Created by PhpStorm.
 * User: nj
 * Date: 16/8/24
 * Time: 16:38
 */
require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;

$con = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
$channel = $con->channel();

$channel->exchange_declare('direct_logs', 'direct', false, false, false);
list($queue, ,) = $channel->queue_declare("", false, false, true, false);
$severities = array_slice($argv, 1);
if (empty($severities)) {
    file_put_contents('php://stderr', "Usage:$argv[0] [info] [warning] [error]\n");
    exit(1);
}

foreach ($severities as $severity) {
    $channel->queue_bind($queue, 'direct_logs', $severity);
}

echo "[x] waiting for logs, To exit press ctrl + c", "\n";

$callback = function ($msg) {
    echo "[x] ", $msg->delivery_info['routing_key'], ':', $msg->body, "\n";
};
$channel->basic_consume($queue, '', false, true, false, false, $callback);

while (count($channel->callbacks)) {
    $channel->wait();
}

//php ~/www/test2/receive_logs_direct.php warning error > logs_from_rabbit.log

$channel->close();
$con->close();




















