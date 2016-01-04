<?php
/**
 * Local variables
 *
 * @var \Phalcon\Config $config
 * @var \Phalcon\Di\FactoryDefault\Cli $di
 */

$di->setShared('config', function () use ($config) {
    return $config;
});

$di->setShared('datasocket', function () use ($config) {
    $maker = new Maker();
    echo $config->datasocket->type . '://' . $config->datasocket->host . ':' . $config->datasocket->port;
    return $maker->createServer($config->datasocket->type . '://' . $config->datasocket->host . ':' . $config->datasocket->port);
});

$di->setShared('logger', function () use ($config) {
    return new \Phalcon\Logger\Adapter\File($config->logfile);
});
