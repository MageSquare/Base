<?php
/**
 * @author MageSquare Team
 * @copyright Copyright (c) 2021 MageSquare 
 * @package MageSquare_Base
 */


namespace MageSquare\Base\Debug;

/**
 * For Remote Debug
 * Same as VarDump class but with 'exit' after execution
 * @codeCoverageIgnore
 * @codingStandardsIgnoreFile
 */
class VarDie
{
    public static function execute()
    {
        if (VarDump::isAllowed()) {
            foreach (func_get_args() as $var) {
                System\Beautifier::getInstance()->beautify(VarDump::dump($var));
            }
            VarDump::magesquareExit();
        }
    }

    public static function backtrace()
    {
        if (VarDump::isAllowed()) {
            $backtrace = debug_backtrace();
            array_shift($backtrace);
            foreach ($backtrace as $route) {
                System\Beautifier::getInstance()->beautify(
                    VarDump::dump(
                        [
                            'action' => $route['class'] . $route['type'] . $route['function'] . '()',
                            'object' => $route['object'],
                            'args' => $route['args'],
                            'file' => $route['file'] . ':' . $route['line']
                        ]
                    )
                );
            }
            VarDump::magesquareExit();
        }
    }
}
