<?php
/**
 * Created by PhpStorm.
 * User: nj
 * Date: 16/9/5
 * Time: 13:46
 */
//phpinfo();
$a = 'ad';
$a = ['a','b'];
var_dump(strval($a));
var_dump((string)$a);
class A{
    public function test()
    {
      var_dump(new self());
    }
}
$a = new A();
$a->test();
exit;
//var_dump(1&1);
//$b = 0x4000000000;
$b = 4;
//$c= 0x8000000000;
$a = 1;
$a |=$b;
//$a |=$c;
var_dump($a);




exit;
ini_set('SMTP', '192.160.0.24');   // 改变 SMTP 的当前值
print get_cfg_var('SMTP'); // 返回 localhost  说明get_cfg_var 是获取配置文件里的值,ini_get是获取当前环境下的值
print ini_get('SMTP');   // 返回 192.160.0.24
var_dump(get_cfg_var('session.gc_maxlifetime'));//get_cfg_var 获取php配置项的值