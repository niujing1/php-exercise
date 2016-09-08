<?php

/**
 * Created by PhpStorm.
 * User: nj
 * Date: 16/9/7
 * Time: 08:41
 * Desc for test template
 */
class Template
{
    private $arrayConfig = [
        'suffix' => '.m',
        'templateDir' => 'template/',
        'compileDir' => 'cache/',
        'cache_htm' => false,
        'suffix_cache' => '.htm',
        'cache_time' => 7200
    ];
    public $file;
    static private $instance = null;

    public function __construct($arrayConfig = array())
    {
        $this->arrayConfig = $arrayConfig + $this->arrayConfig;
    }

    //get tempalte instance
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new Template();
        }
        return self::$instance;
    }

    //step over set engine
    public function setConfig($key, $val)
    {
        if (is_array($key)) {
            $this->arrayConfig = $key + $this->arrayConfig;
        } else {
            $this->arrayConfig[$key] = $val;
        }
    }

    //get now engine config,just for debug
    public function getConfig($key = null)
    {
        //if give key,get key'val else return whole config array
        if ($key) {
            return $this->arrayConfig[$key];
        } else {
            return $this->arrayConfig;
        }
    }

    // 向模版中注入变量
    private $val = [];

    public function assign($key, $val)
    {
        $this->val[$key] = $val;
    }
    //注入数组变量
    public function assignArray($array)
    {
        if(is_array($array)){
            foreach ($array as $key=>$val){
                $this->v[$key]=$val;
            }
        }
    }
}

$tpl = new Template();
var_dump($tpl->getConfig());