<?php
/**
 * Created by PhpStorm.
 * User: nj
 * Date: 16/8/29
 * Time: 11:44
 */
//file_put_contents("./http.txt", 1, 8);
echo 'test';
return 123;
file_put_contents("./http.txt", var_export($_POST), 8);
//echo crc32('test');
//echo "<br/>";
//$pid = getmypid();
//$hostId = 1;
//$t = (($hostId & ((1 << 4) - 1)) << 60) + ($pid << 44);
//echo $t;
//echo "<br/>";
//echo getmypid();//获取当前进程id
//echo "<br/>";
//echo getmygid();//获取当前php脚本用户组id
//echo "<br/>";
//echo getmyuid();//获取当前php脚本所有者id
