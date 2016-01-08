<?php

use Library\Socket\Socket;
use Library\Socket\Maker;
use Library\Tools\DI;
use Library\Logger\Logger;
use Application\Application;

 error_reporting(E_ALL);

/**
 * Read auto-loader
 */
//include __DIR__ . '/config/loader.php';

/**
 * Read the configuration
 */
$config = include __DIR__ . '/config/config.php';

/**
 * Read the services
 */
$di = new DI();
include __DIR__ . '/config/services.php';

$app =$di['app'];

/**
 * Create a console application
 */
//$console = new ConsoleApp($di);


/**
 * Process the console arguments
 */
$arguments = array();

foreach ($argv as $k => $arg) {
    if ($k == 1) {
        $arguments['task'] = $arg;
    } elseif ($k == 2) {
        $arguments['action'] = $arg;
    } elseif ($k >= 3) {
        $arguments['params'][] = $arg;
    }
}

    $di['logger']->log("Notice message",Logger::NOTICE);
    //$this->logger('Warning message, 1',Logger::WARNING);
    //$this->logger('Error message, 1',Logger::ERROR);
    //$this->logger('Fatal message, 1',Logger::FATAL);
    $di['app']->execute();

try {

    /**
     * Handle
     */
    //$console->handle($arguments);

    /**
     * If configs is set to true, then we print a new line at the end of each execution
     *
     * If we dont print a new line,
     * then the next command prompt will be placed directly on the left of the output
     * and it is less readable.
     *
     * You can disable this behaviour if the output of your application needs to don't have a new line at end
     */
    if (isset($config["printNewLine"]) && $config["printNewLine"]) {
        echo PHP_EOL;
    }

} catch (Exception $e) {
    $this->logger($e-getMessage(),Logger::NOTICE);
    exit(255);
}
