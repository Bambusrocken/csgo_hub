<?php
/**
 * Local variables
 *
 * @var \Phalcon\Config $config
 * @var \Phalcon\Di\FactoryDefault\Cli $di
 */
 error_reporting(E_ALL);
 
use Phalcon\Logger\Adapter\File as LoggerFile;
use Phalcon\Db\Adapter\Pdo\Mysql as PdoMysql;
use Library\Socket\Maker as UDSPSocket;

$di->setshared('config', function () use ($config) {
    return $config;
});
/*
$di->setShared('datasocket', function () use ($config) {
    $maker = new Maker();
    echo $config->datasocket->type . '://' . $config->datasocket->host . ':' . $config->datasocket->port;
    return $maker->createServer($config->datasocket->type . '://' . $config->datasocket->host . ':' . $config->datasocket->port);
});
 * */

$di->setshared('logger', function () use ($config) {
    return new LoggerFile($config->logfile);
});


$di->set("db", function () use ($config) {
    return new PdoMysql(
        array(
            "host"     => $config->db->host,
            "username" => $config->db->user,
            "password" => $config->db->password,
            "dbname"   => $config->db->dbname
        )
    );
});

$di->set("udpsocket", function () use ($config) {
    $maker = new UDSPSocket();
    return $maker->createServer($config->datasocket->type.'://'.$config->datasocket->host.':'.$config->datasocket->port);
});
