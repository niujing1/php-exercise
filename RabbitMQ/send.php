<?php
/**
 * Created by PhpStorm.
 * User: nj
 * Date: 16/8/23
 * Time: 14:56
 * Desc:use for test rabbitmq
 */
//echo 'test';exit;
//var_dump(__DIR__);
//$a = 1;
//$b = 2;
//echo $a ;
//exit;
//$a = 0.2;
//$b = 0.18;
//var_dump(bcadd($a,$b,6));
//exit();
//phpinfo();exit;
require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

//建立链接
$con = new AMQPStreamConnection('127.0.0.1',5672,'guest','guest');
if(!$con){
    die('cannot connect');
}
$channel = $con->channel();


$channel->queue_declare('hello',false,false,false,false);
$msg = new AMQPMessage('hi');

#发送消息
$channel->basic_publish($msg,'','hello');
//file_put_contents("1.txt",var_dump($channel),8);

echo "[x] Sent 'hi' ";

//关闭链接
$channel->close();
$con->close();


















