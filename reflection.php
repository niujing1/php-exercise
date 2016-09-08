<?php
/**
 * Created by PhpStorm.
 * User: nj
 * Date: 16/8/29
 * Time: 08:51
 */

class Person{
    public  $name;
    protected  $gender;

    public function __get($name)
    {
        if(!isset($name)){
            echo "setting for you default";
            $this->$name = "default";
        }
        return $this->$name;
    }

    public function __set($name,$value)
    {
        $this->$name = $value;
    }

    public function say()
    {
        echo $this->name."<br/>".$this->gender;
    }
}

$student = new Person();
$student->name = 'Tom';
$student->gender = 'famel';
//echo $student->say();

//使用反射来获取person的类属性和方法列表
$reflection = new ReflectionObject($student);
var_dump($reflection->getMethods());

$props = $reflection->getProperties();// 使用getProperties来获取类包含的所有属性
foreach ($props as $key=>$prop){
    echo $prop->getName()."<br/>";
}

echo "<hr/>";

//使用getMethod来获取所有的类方法
$methods = $reflection->getMethods();
var_dump($methods);
foreach ($methods as $method){
    echo $method->getName()."<br/>";
}

echo "<hr/>";

//当然,也可以不使用反射,使用class函数同样可以得到
//返回类属性的关联数组
var_dump(get_object_vars($student));// 只能获取public属性的属性列表
echo "<hr/>";
//返回类属性
var_dump(get_class_vars(get_class($student)));
echo "<hr/>";
//返回由类的方法名组成的数组
var_dump(get_class_methods(get_class($student)));
echo "<hr/>";

//返回属性列表所属的类
var_dump(get_class($student));
echo "<hr/>";

//获取类的原型
$obj = new ReflectionClass('person');
$className = $obj->getName();
$methods = $props = [];
//var_dump($obj->getProperties());
foreach ($obj->getProperties() as $v){
//    var_dump($v);
    $props[$v->getName()] = $v;
}

foreach ($obj->getMethods() as $method){
    $methods[$v->getName()] = $v;
}

echo "class {$className}"."{<br/>";
var_dump($props);
echo "<br/>";
//var_dump($methods);
is_array($props)&&ksort($props);
foreach ($props as $k=>$v){
    echo "<br/>";
    echo $v->isPublic()?'public':'',$v->isProtected()?'protected':'',$v->isPrivate()?'private':'',$v->isStatic()?:'';
    echo " {$k}<br/>{$v}";//$k是gender  $v是protected $gender
}



foreach ($methods as $k=>$v){
    echo "<br/> function {$k}(){}<br/>";
}
echo "<br/>}";

