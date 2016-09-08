<?php

/**
 * Created by PhpStorm.
 * User: nj
 * Date: 16/8/26
 * Time: 18:19
 * Desc: test __call and __callStatic
 */
abstract class ActiveRecord
{
    protected static $table;
    protected $fieldvalues;
    public $select;

    public function findById($id)
    {
        $query = "select * from " . static::$table . "where id={$id}";
        return self::createDomain($query);
    }

    public function __get($fieldname)
    {
        return $this->fieldvalues[$fieldname];
    }

    public function __callStatic($method, $args)
    {
        $field = preg_replace('/^findBy(\w*)$/', '${1}', $method);// 正则中${0}得到的是完整的匹配,${1}第一个括号里的匹配
        $query = "select * from " . static::$table . " where $field = " . $args[0];
        return self::createDomain($query);
    }

    private static function createDomain($query)
    {
        $class = get_called_class();
        $domain = new $class();
        $domain->fieldvalues = array();
        $domain->select = $query;
        foreach ($class::$fields as $field => $value) {
            $domain->fieldValues[$field] = "TODO:set from sql result";
        }
        return $domain;
    }
}

class Customer extends ActiveRecord
{
    protected static $table = 'custdb';
    protected static $fields = array(
        'id' => 'int',
        'eamil' => 'varchar',
        'lastname' => 'varchar',
    );
}

class Sales extends ActiveRecord
{
    protected static $table = 'salesdb';
    protected static $fields = array(
        'id' => 'int',
        'item' => 'varchar',
        'qty' => 'int',
    );
}

var_dump(assert("select * from custdb where id = 123" == Customer::findById(123)->select));
var_dump(assert("TODO::set from sql result" == Customer::findById(123)->email));
var_dump(assert("set from salesdb where id = 321" == Sales::findById(321)->select));

var_dump(assert("set from custdb where Lastname = 'test'" == Customer::findByLastName('test')->select));