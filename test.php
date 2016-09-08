<?php
/**
 * Created by PhpStorm.
 * User: nj
 * Date: 16/8/26
 * Time: 10:22
 */

$method = 'findByLastName';
$field = preg_replace('/^findBy(\w*)$/','${1}',$method);
var_dump($field);
exit;

echo 2<<2;
echo "<br/>";
echo 1<<2;
echo "<br/>";
echo 3<<2;

exit;
$pid = 65536;

echo $pid << 44;
echo 1 << 4;
echo "Invalid parameter \$toCoordType:123";
