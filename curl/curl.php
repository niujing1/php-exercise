<?php
/**
 * Created by PhpStorm.
 * User: nj
 * Date: 16/9/1
 * Time: 08:44
 */

//test curl upload file

file_put_contents("./www.txt",1,8);
print_r($_FILES);
exit;
$url = "https://www.baidu.com";
$ch = curl_init($url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);//将curl 执行的结果以文件流的形式返回,而不是直接输出
$res = curl_exec($ch);
if($res === false){
    echo "cUrl error:".curl_error($ch);
}
$info = curl_getinfo($ch);
curl_close($ch);
var_dump($info);
