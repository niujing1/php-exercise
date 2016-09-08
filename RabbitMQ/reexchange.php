<?php
/**
 * Created by PhpStorm.
 * User: nj
 * Date: 16/8/23
 * Time: 15:35
 * Desc: 消息接收者
 */

//运行多个work时,各个订阅者得到的消息大致相同,采用轮询机制

require_once __DIR__ . "/vendor/autoload.php";
use PhpAmqpLib\Connection\AMQPStreamConnection;

$con = new AMQPStreamConnection("localhost", 5672, 'guest', 'guest');
$channel = $con->channel();


//声明一个交换机
$channel->exchange_declare('logs', 'fanout', false, false, false);
list($queue, ,) = $channel->queue_declare('', false, false, true, false);
file_put_contents('queue.txt',var_dump($queue),8);
$channel->queue_bind($queue, 'logs');
echo "[*] waiting for messages,to exit press ctrl + c." . "<br/>";

$callback = function ($msg) {
    echo "[x] ",$msg->body,"\n";
};

#如果客户端没有确认收到信息,继续发送
$channel->basic_qos(null, 1, null);
$channel->basic_consume($queue, '', false, true, false, false, $callback);

while (count($channel->callbacks)) {
    $channel->wait();
}

$channel->close();
$con->close();




















