<?php
/**
 * Created by PhpStorm.
 * User: nj
 * Date: 16/9/5
 * Time: 09:10
 */
header('P3P: CP="CURa ADMa DEVa PSAo PSDo OUR BUS UNI PUR INT DEM STA PRE COM NAV OTC NOI DSP COR"');
setcookie('p3p',$_GET['id'],time()+3600,'/','test.cc');
var_dump($_COOKIE);//直接命令行执行是得不到cookie值的,验证了cookie是浏览器的不属于语言
//每个域名的cookie限制4k   可以使用localstorage限制本地存储
