<?php
/**
 * Created by PhpStorm.
 * User: nj
 * Date: 16/8/29
 * Time: 08:38
 */

trait Hello{
    public function sayHello()
    {
        echo 'hello';
    }
}

trait World{
    public function sayWorld()
    {
        echo "world";
    }
}

class MyHelloWorld{
    use Hello,World;//trait性状的use在类的内部,类文件的use在类的外部

    public function sayMark()
    {
        echo "!";
    }
}

$a = new MyHelloWorld();
$a->sayHello();
$a->sayWorld();
$a->sayMark();