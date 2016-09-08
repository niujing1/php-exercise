<?php
/**
 * Created by PhpStorm.
 * User: nj
 * Date: 16/8/30
 * Time: 18:33
 */
$html = file_get_contents("http://www.baidu.com");
//print_r($http_response_header);//$http_response_header变量会保存http响应的报头

//$fp = fopen('https://www.baidu.com','r');
//print_r(stream_context_get_params($fp));
//print_r(stream_get_meta_data($fp));//fopen等函数打开的数据流信息可以使用steam_get_meta_data来获取

function parseHeaders( $headers )
{
    $head = array();
    foreach( $headers as $k=>$v )
    {
        $t = explode( ':', $v, 2 );
        if( isset( $t[1] ) )
            $head[ trim($t[0]) ] = trim( $t[1] );
        else
        {
            $head[] = $v;
            if( preg_match( "#HTTP/[0-9\.]+\s+([0-9]+)#",$v, $out ) )
                $head['reponse_code'] = intval($out[1]);
        }
    }
    return $head;
}

$res = parseHeaders($http_response_header);
//var_dump($res);

//模拟灌水机器人
$data = array('author'=>'test','mail'=>'test@test.com','text'=>'test');
$data = http_build_query($data);

$opts = array(
    'http'=>array(
        'method'=>'post',
        'header'=>'Content-type:application/x-www-form-urlencode'.
            "\r\n"."Content-length:".strlen($data)."\r\n",
        'content'=>$data,
        'Cookie:PHPSSESIONID=...',
        'Referer:http://aiyooyoo.com/index.php/archives/7'."\r\n",
    )
);
$content = stream_context_create($opts);
//var_dump($content);
$h = file_get_contents('test.cc/tw.php',false,$content);
var_dump($h);
//$m = file_get_contents('http://aiyooyoo.com/index.php/archives/7/comment',false,$content);
//var_dump($m);
