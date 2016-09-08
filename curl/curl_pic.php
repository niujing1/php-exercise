<?php
/**
 * Created by PhpStorm.
 * User: nj
 * Date: 16/9/1
 * Time: 08:51
 */
//使用curl抓取图片
header("Content-type:image/jpg");
$ch = curl_init();

curl_setopt($ch,CURLOPT_URL,"http://upload.univs.cn/2012/0104/1325645511371.jpg");
//curl_setopt($ch,CURLOPT_URL,"http://test.cc/apple.png");
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch,CURLOPT_HEADER,1);

$out = curl_exec($ch);

$info = curl_getinfo($ch);
curl_close($ch);

//var_dump($out);exit;
file_put_contents("/Users/nj/www/test/test.jpg",$out);
$size = filesize("/Users/nj/www/test/test.jpg");
var_dump($size);
