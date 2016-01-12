<?php

use Phalcon\Di\FactoryDefault as DI;
use Application\Application;



 error_reporting(E_ALL);

/**
 * Read auto-loader
 */
include __DIR__ . '/config/loader.php';

/**
 * Read the configuration
 */
$config = include __DIR__ . '/config/config.php';

/**
 * Read the services
 */
$di = new DI();
include __DIR__ . '/config/services.php';

$logger=$di['logger'];
$udpsocket=$di['udpsocket'];

while(true){
    $buffarray = $udpsocket->recvFrom();
    echo $buffarray[0].' : '.$buffarray[1].PHP_EOL;
}

$logger->info("INFO");

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
    $logger->error($e-getMessage());
    exit(255);
}
