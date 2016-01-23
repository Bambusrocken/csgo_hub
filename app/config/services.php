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
use Library\Tools\Rcon\Rcon;

$di->setshared('config', function () use ($config) {
    return $config;
});
$di->setshared('regex', function () use ($regex) {
    return $regex;
});

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
$di->setshared("rcon", function ()  {
    return new Rcon();
});

foreach($config->haps as $hapclass) {
    $di->set($hapclass, function ()  {
        return new $hapclass;
    });
}