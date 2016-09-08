<?php

/**
 * Created by PhpStorm.
 * User: nj
 * Date: 16/9/2
 * Time: 16:02
 */
//step1: down phprpc for php 解压
//把客户端和服务端部署到同一个服务器测试
include "phprpc/phprpc_server.php";

class Server
{
    static function hello()
    {
      return "hello sever";
    }
}
$server = new PHPRPC_Server();
$server->add('hello','Server');
$server->start();
