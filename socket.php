<?php
/**
 * Created by PhpStorm.
 * User: nj
 * Date: 16/9/1
 * Time: 07:48
 */
set_time_limit(0);//保证不会超时
//$socket = fsockopen("127.0.0.1",8888,$errno,$errstr,1);
$socket = fsockopen("192.168.0.2",12345,$errno,$errstr,1);
if(!$socket){
    echo "$errstr($errno)<br/>\n";
}else{
    socket_set_blocking($socket,false);
    fwrite($socket,"send data...\r\n");
    //后边加上\r\n提交请求数据,否则可能没办法获取服务端的响应,即使刷新缓冲区也无用,就只能等到关闭连接时才能获取响应
    fwrite($socket,"end \r\n");

    while (!feof($socket)){
        echo fread($socket,128);
        flush();
        ob_flush();
        sleep(2);
    }
   fclose($socket);
}
