<?php
/**
 * Created by PhpStorm.
 * User: nj
 * Date: 16/8/23
 * Time: 14:56
 * Desc:use for test rabbitmq
 */

require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
$a = 1;

//建立链接
$con = new AMQPStreamConnection('127.0.0.1',5672,'guest','guest');

if(!$con){
    die('cannot connect');
}
$channel = $con->channel();


//$channel->queue_declare('new_task',false,false,false,false);
//为了保证一个客户端失去连接时,消息不丢失,可以将它声明为一个持久化的队列
$channel->queue_declare('new_task2',false,true,false,false);
//这里是send里边没有的操作
//var_export($argv,true);
//var_dump($argv);
//file_put_contents('test.txt',var_export($argv,true));
$data = implode('',array_slice($argv,1));
if(empty($data)){
    $data = "hello world";
}
//$msg = new AMQPMessage('hi');
$msg = new AMQPMessage($data,array('delivery_mode'=>2));//消息持久化
#发送消息
$channel->basic_publish($msg,'','task_queue');
//file_put_contents("1.txt",var_dump($channel),8);

echo "[x] Sent ",$data,"\n";

//关闭链接
$channel->close();
$con->close();


















