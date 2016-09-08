<?php
/**
 * Created by PhpStorm.
 * User: nj
 * Date: 16/8/26
 * Time: 17:48
 */

class User{
    private $name = 'defalut name';

    public function __set($name,$val)
    {
        echo 'setting {$name} to {$val}';
        $this->$name = $val;

    }

    public function __get($name)
    {
        if(!isset($name)){
            echo "no set";
            $this->$name = 'setting for you to default';
        }
        return $this->$name;
    }

    public function __call($name,$arg)
    {
        switch(count($arg)){
            case 2:
                echo $arg[0]*$arg[1];
                break;
            case 3:
                echo array_sum($arg);
                break;
            default:
                echo 'wrong use';
        }
    }
}

$user = new User();
echo $user->name;
echo $user->add(4);//wrong use
echo $user->add(3,5);//15
echo $user->add(2,3,4);//9
echo $user->add(1,2,3,4);//wrong use

