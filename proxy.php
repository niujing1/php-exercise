<?php

/**
 * Created by PhpStorm.
 * User: nj
 * Date: 16/8/29
 * Time: 10:00
 */
class Mysql
{
    public static function connect($db)
    {
        echo "连接到数据库${db[0]}<br/>";
    }
}

class Proxy
{
    private $target;

    function __construct($tar)
    {
        $this->target[] = new $tar();
    }

    function __call($name, $arguments)
    {
        // TODO: Implement __call() method.
        foreach ($this->target as $obj){
            $r = new ReflectionClass($obj);
            if($method = $r->getMethod($name)){
                if($method->isPublic()&&!$method->isAbstract()){
                    echo "before Log<br/>";
                    $method->invoke($obj,$arguments);//invoke()执行一个反射的方法,执行失败会返回一个reflection Exception
                    echo "after Log<br/>";
                }
            }
        }
    }
}

$obj = new Proxy('Mysql');
var_dump($obj->connect('member'));
var_dump($obj->connect('test'));