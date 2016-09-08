#rabbitmqctl.sh
#!/usr/bin/env bash

#添加一个新的用户nj
/usr/local/Cellar/rabbitmq/3.6.4/sbin/rabbitmqctl add_user nj nj

#将该用户nj设置为admin
/usr/local/Cellar/rabbitmq/3.6.4/sbin/rabbitmqctl set_admin nj


#删除一个test用户
/usr/local/Cellar/rabbitmq/3.6.4/sbin/rabbitmqctl  delete_user test

#给用户nj授权工作目录
/usr/local/Cellar/rabbitmq/3.6.4/sbin/rabbitmqctl  set_permissions -p "/" nj "*" "*" "*"


#建立vhost
/usr/local/Cellar/rqbbitmq/3.6.4/sbin/rabbitmqctl  add_vhost  test.cc

#给独立域授权
/usr/local/Cellar/rabbitmq/3.6.4/sbin/rabbitmqctl  set_permissions -p "test.cc" nj "*" "*" "*"


#脚本执行一次就好,就可以建立起独立的vhost和user,对用户进行权限管理
#使用 /usr/local/Cellar/rabbitmq/3.6.4/sbin/rabbitmqctl status 来查看当前rabbitmq的状态


























