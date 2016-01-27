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
use Application\Overwatch\gameWatcher;
use Phalcon\Mvc\Model\Manager as ModelsManager;
use Application\Overwatch\hapWatcher;
use Application\Game\score;
use Application\Game\player;
use Application\Game\map;

$di->setshared('config', function () use ($config) {
    return $config;
});
$di->setshared('regex', function () use ($regex) {
    return $regex;
});

$di->setshared('logger', function () use ($config) {
    return new LoggerFile($config->logfile);
});

$di->setShared('db', function () use ($config) {
    $dbConfig = $config->db->toArray();
    $adapter = $dbConfig['adapter'];
    unset($dbConfig['adapter']);

    $class = 'Phalcon\Db\Adapter\Pdo\\' . $adapter;

    return new $class($dbConfig);
});

$di->setshared("udpsocket", function () use ($config) {
    $maker = new UDSPSocket();
    return $maker->createServer($config->datasocket->type.'://'.$config->datasocket->host.':'.$config->datasocket->port);
});
$di->set("rcon", function ()  {
    return new Rcon();
});

foreach(array_keys(get_object_vars($di['regex']->haps)) as $hapclass) {
    $di->setshared($hapclass, function () use ($hapclass) {
        return new $hapclass;
    });
    //echo $hapclass . PHP_EOL;
}

$di->set('modelsManager', function() {
      return new ModelsManager();
});

$di->setshared('gameWatcher', function () {
    return new gameWatcher();
});

$di->setshared('hapWatcher', function () {
    return new hapWatcher();
});
$di->set('score', function () {
    return new score();
});

$di->set('player', function () {
    return new player;
});

$di->set('map', function () {
    return new score();
});

$di->set('player', function () {
    return new player();
});

$di->set('warden', function ($match_id,$server_ip,$rcon_password)  use ($di) {
    return new warden($di['hapWatcher'],$di['rcon'],$match_id,$server_ip,$rcon_password);
});




