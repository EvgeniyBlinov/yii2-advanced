<?php
namespace cent\yii2advanced\controllers;

use Yii;
use yii\console\Controller;
use yii\helpers\Console;

/**
 * ConsoleController
 *
 * ~~~
 * $this->stdout("not silent\n", Console::BOLD);
 * $this->vstdout("verbose\n", Console::BOLD);
 * ~~~
 *
 * @package yii2-advanced
 * @author Evgeniy Blinov <evgeniy_blinov@mail.ru>
**/
class ConsoleController extends Controller
{
    /**
     * @var boolean
     **/
    public $verbose = false;
    /**
     * @var boolean
     **/
    public $silent  = false;
    /**
     * @var integer of exit code
     **/
    public $exitCode = self::EXIT_CODE_NORMAL;

    /**
     * @return array of options
     */
    public function options($actionID)
    {
        return array_merge(
            parent::options($actionID),
            ['verbose', 'silent'] // global for all actions
        );
    }

    /**
     * Prints a string to STDOUT
     *
     * @param string $string the string to print
     * @return int|boolean Number of bytes printed or false on error
     */
    public function stdout($string)
    {
        if (!$this->silent) {
            return call_user_func_array(['parent', __FUNCTION__], func_get_args());
        }
        return 1;
    }

    /**
     * Prints a string to STDOUT
     *
     * @param string $string the string to print
     * @return int|boolean Number of bytes printed or false on error
     */
    public function vstdout($string)
    {
        if ($this->verbose) {
            return call_user_func_array(['parent', 'stdout'], func_get_args());
        }
        return 1;
    }
}
