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
//file_put_contents("3.txt",var_export($channel),8);

//声明一个队列
//$channel->queue_declare('task_queue', false, false, false, false);
// 为了实现持久化,这里对应声明为true
$channel->queue_declare('task_queue',false,true,false,false);
echo "[*] waiting for messages,to exit press ctrl + c." . "<br/>";

$callback = function ($msg) {
    file_put_contents("msg.txt", var_dump($msg), 8);

    //file_put_contents("2.txt",var_dump($msg),8);
    echo "[x3] received " . $msg->body . "\n";
    sleep(substr_count($msg->body, '.'));
//    echo substr_count($msg->body,'.');
    echo "[x] Done", "\n";
//    添加确认
    $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
};

#如果客户端没有确认收到信息,继续发送
$channel->basic_qos(null,1,null);
$channel->basic_consume('task_queue', '', false, false, false, false, $callback);

while (count($channel->callbacks)) {
    $channel->wait();
}






















