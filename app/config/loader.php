<?php

$loader = new \Phalcon\Loader();
$loader->registerDirs(
    array(
        __DIR__ . '/../tasks',
        __DIR__ . '/../models',
        __DIR__ . '/../Application/Haps'
    )
);
$loader->registerNamespaces(array(
    'Application'    =>  __DIR__ . '/../Application',
    'Application/Haps'    =>  __DIR__ . '/../Application/Haps',
    'Application/Game'  =>  __DIR__ . '/../Application/Game',
    'Application/Overwatch'    =>  __DIR__ . '/../Application/Overwatch',
    'Library\Socket'    =>  __DIR__ . '/../Library/Socket',
    'Library\Tools'    =>  __DIR__ . '/../Library/Tools',
    'Library\Tools\Application'    =>  __DIR__ . '/../Library/Tools/Application',
    'Library\Tools\Exceptions'    =>  __DIR__ . '/../Library/Tools/Exceptions',
    'Library\Tools\Helpers'    =>  __DIR__ . '/../Library/Tools/Helpers',
    'Library\Tools\Rcon'    =>  __DIR__ . '/../Library/Tools/Rcon'
));
$loader->register();
