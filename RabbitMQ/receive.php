<?php
/**
 * Created by PhpStorm.
 * User: nj
 * Date: 16/8/23
 * Time: 15:35
 * Desc: 消息接收者
 */

require_once __DIR__ . "/vendor/autoload.php";
use PhpAmqpLib\Connection\AMQPStreamConnection;

$con = new AMQPStreamConnection("localhost",5672,'guest','guest');
$channel = $con->channel();
//file_put_contents("3.txt",var_export($channel),8);

//声明一个队列
$channel->queue_declare('hello',false,false,false,false);
echo "[*] waiting for messages,to exit press ctrl + c."."<br/>";

$callback = function ($msg){
    //file_put_contents("2.txt",var_dump($msg),8);
    echo "[x] received ".$msg->body."\n";
};

$channel->basic_qos(null,1,null);
$channel->basic_consume('task_queue','',false,true,false,false,$callback);

while (count($channel->callbacks)){
    $channel->wait();
}






















