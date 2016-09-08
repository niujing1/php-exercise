<?php
/**
 * Created by PhpStorm.
 * User: nj
 * Date: 16/8/30
 * Time: 09:00
 * Desc: open-close principle
 */
//以播放器为例,定义一个处理接口
interface player
{
    public function process();
}

//实现播放器的编码和播放功能
class playerencode implements player
{
    public function process()
    {
        echo "encode <br/>";
    }
}

class playerout implements player
{
    public function process()
    {
        echo "playout <br/>";
    }
}

//实现播放器的任务调度
class playerProcess
{
    private $msg = null;

    public function __construct()
    {

    }

    public function callback(event $event)
    {
        $this->msg = $event->click();
        if ($this->msg instanceof player) {
            $this->msg->process();
        }
    }
}

//播放器的事件处理逻辑
class mp4
{
    public function work()
    {
        $playerProcess = new playerProcess();
        $playerProcess->callback(new event('encode'));
        $playerProcess->callback(new event('out'));
    }
}

//播放器的事件处理类
class event
{
    private $m;

    public function __construct($me)
    {
        $this->m = $me;
    }

    public function click()
    {
        switch ($this->m) {
            case 'encode':
                return new playerencode();
                break;
            case 'out':
                return new playerout();
                break;
        }
    }
}

//下边是调用代码
$mp4 = new mp4();
$mp4->work();

//单一职责  借口隔离  开闭原则  里氏替换  依赖倒置