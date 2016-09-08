<?php
/**
 * Created by PhpStorm.
 * User: nj
 * Date: 16/8/29
 * Time: 08:32
 */
$dir = new DirectoryIterator(dirname(__FILE__));
foreach ($dir as $fileinfo){
    if(!$fileinfo->isDir()){
        var_dump($fileinfo);//可以看出来是一个iterator对象
        echo $fileinfo->getFilename(),"<br/>",$fileinfo->getSize(),PHP_EOL;
    }
}