<?php
/**
 * Local variables
 *
 * @var \Phalcon\Config $config
 * @var \Phalcon\Di\FactoryDefault\Cli $di
 */
 error_reporting(E_ALL);
 
 use Library\Logger\Logger;

$di['config'] = function () use ($config) {
    return $config;
};
/*
$di->setShared('datasocket', function () use ($config) {
    $maker = new Maker();
    echo $config->datasocket->type . '://' . $config->datasocket->host . ':' . $config->datasocket->port;
    return $maker->createServer($config->datasocket->type . '://' . $config->datasocket->host . ':' . $config->datasocket->port);
});
 * */

$di['logger'] = function () use ($config) {
    return new \Library\Logger\Logger($config->logfile);
};

$di['logger']->log('Binding MysqlDB',Logger::NOTICE);

$di['db'] = function () {
    $mysql = new PDO("mysql:host=localhost;dbname=queue",'queue','queue');
    $mysql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    $di['logger']->log('Connected to Database',Logger::NOTICE);
    return $mysql;
};
