#测试启动的脚本
#!/usr/bin/env bash

#第一条任务(信息)
php ~/www/test2/new_task.php "first"

#第二条
php ~/www/test2/new_task.php "second"

#。。。。
php ~/www/test2/new_task.php "three"

php ~/www/test2/new_task.php "four"


##以下是消息接收端的操作
php ~/www/test2/work.php
php ~/www/test2/work.php




















