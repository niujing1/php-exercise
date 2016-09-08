<?php
/**
 * Created by PhpStorm.
 * User: nj
 * Date: 16/9/1
 * Time: 11:37
 */
$data = array(
    "testfoo"=>'bar',
//    要上传的本地文件的地址
    'upload'=>"@curl.zip"
);
$ch = curl_init();

curl_setopt($ch,CURLOPT_URL,"http://test.cc:8888/curl.php");
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch,CURLOPT_POST,1);
curl_setopt($ch,CURLOPT_POSTFIELDS,$data);

$output = curl_exec($ch);
curl_close($ch);
var_dump($output) ;


