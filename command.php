<?php
/**
 * Created by PhpStorm.
 * User: nj
 * Date: 16/8/30
 * Time: 08:16
 * Desc: command mode
 */
//厨师类,命令接受者和执行者
class cook
{
    public function meal()
    {
        echo "do meal" . "<br/>";
    }

    public function drink()
    {
        echo "preparing drink" . "<br/>";
    }

    public function ok()
    {
        echo "you can take it" . "<br/>";
    }
}

//command interface
interface Command
{
    public function execute();
}


//模拟服务员与厨师交互过程
class mealCommand implements Command
{
    private $cook;

//    绑定命令接受者
    public function __construct(cook $cook)
    {
        $this->cook = $cook;
    }

    public function execute()
    {
        $this->cook->meal();
    }
}

class drinkCommand implements Command
{
    private $drink;

    public function __construct(cook $cook)
    {
        $this->cook = $cook;
    }

    public function execute()
    {
        $this->cook->drink();
    }
}

//now we can call servicer
class cookControl
{
    private $mealCommand;
    private $drinkCommand;

//    将命令发送者绑定到命令接受者上
    public function addCommand(mealCommand $mealCommand, drinkCommand $drinkCommand)
    {
        $this->mealCommand = $mealCommand;
        $this->drinkCommand = $drinkCommand;
    }

    public function callmeal()
    {
        $this->mealCommand->execute();
    }

    public function calldrink()
    {
        $this->drinkCommand->execute();
    }
}

//现在可以实现命令了
$controll = new cookControl();
$cook = new cook();
$mealCommand = new mealCommand($cook);
$drinkCommand = new drinkCommand($cook);
$controll->addCommand($mealCommand,$drinkCommand);
$controll->calldrink();
$controll->callmeal();