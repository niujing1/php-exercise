<?php
/**
 * Created by PhpStorm.
 * User: nj
 * Date: 16/9/1
 * Time: 16:29
 * Desc:利用curl实现批处理
 */
echo html_entity_decode('&#94;');
echo html_entity_decode('&#45;');
exit;
//创建两个curl资源
$ch1 = curl_init();
$ch2 = curl_init();

//指定适当的url和参数
curl_setopt($ch1, CURLOPT_URL, "http://www.baidu.com");
curl_setopt($ch1, CURLOPT_HEADER, 0);
curl_setopt($ch2, CURLOPT_URL, 'http://www.sina.com');
curl_setopt($ch2, CURLOPT_HEADER, 0);

//创建curl批处理函数
$mh = curl_multi_init();

// 加上两个资源句柄
curl_multi_add_handle($mh, $ch1);
curl_multi_add_handle($mh, $ch2);

//预定义一个状态变量
$active = null;

//执行批处理
do {
    $mrc = curl_multi_exec($mh, $active);
} while ($mrc = CURLM_CALL_MULTI_PERFORM);
while ($active && $mrc == CURLM_OK) {
    if (curl_multi_select($mh) != -1) {
        do {
            $mrc = curl_multi_exec($mh, $active);
        } while ($mrc = CURLM_CALL_MULTI_PERFORM);
    }
}

//关闭各个句柄
curl_multi_remove_handle($mh, $ch1);
curl_multi_remove_handle($mh, $ch2);
curl_multi_close($mh);