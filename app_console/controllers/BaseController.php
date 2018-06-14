<?php
namespace console\controllers;

use yii\helpers\Console;

/**
 *
 * http://www.yiichina.com/doc/guide/2.0/tutorial-console
 *
 * Class BaseController
 * @package console\controllers
 */
class BaseController extends \yii\console\controller
{
    public $message;

    public function actionIndex()
    {
        echo $this->message . "\n";

//        要输出格式的字符串很简单。以下展示了如何输出一些加粗的文字：
        $this->stdout("Hello?" . PHP_EOL, Console::BOLD);

//如果你需要建立字符串动态结合的多种样式，最好使用 ansiFormat ：
        $name = $this->ansiFormat('Alex', Console::FG_YELLOW);
        echo "Hello, my name is $name." . PHP_EOL;
    }

    // 命令 "yii example/create test" 会调用 "actionCreate('test')"
//    public function actionCreate($name) { ... }

    // 命令 "yii example/index city" 会调用 "actionIndex('city', 'name')"
    // 命令 "yii example/index city id" 会调用 "actionIndex('city', 'id')"
//    public function actionIndex($category, $order = 'name') { ... }

    // 命令 "yii example/add test" 会调用 "actionAdd(['test'])"
    // 命令 "yii example/add test1,test2" 会调用 "actionAdd(['test1', 'test2'])"
//    public function actionAdd(array $name) { ... }

    /**
     * 使用退出代码是控制台应用程序开发的最佳做法。
     *
     * 通常，执行成功的命令会返回 0。 如果命令返回一个非零数字，会认为出现错误。
     * 该返回的数字作为出错代码，用以了解错误的详细信息。
     * 例如 1 可能代表一个未知的错误， 所有的代码都将保留在特定的情况下：输入错误，丢失的文件等等。
     *
     * 你可以使用一些预定义的常数：
     * Controller::EXIT_CODE_NORMAL 值为 0;
     * Controller::EXIT_CODE_ERROR 值为 1.
     *
     * @return int
     */
    public function actionError()
    {
        if (true) {/* some problem */
            echo "A problem occured!\n";
            return 1;
        }
        // do something
        return 0;
    }
}
