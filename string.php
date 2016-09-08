<?php
/**
 * Created by PhpStorm.
 * User: nj
 * Date: 16/8/26
 * Time: 19:10
 */

class User{
    private $name = 'test';

//    __toString 会在对象转化成字符串的时候自动调用
    public function __toString()
    {
        return $this->name;
    }
}

$a = new User();
echo $a;