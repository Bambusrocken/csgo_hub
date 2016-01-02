<?php

$loader = new \Phalcon\Loader();
$loader->registerDirs(
    array(
        __DIR__ . '/../tasks'
    )
);
$loader->registerNamespaces(array(
    'Library\Socket'    =>  __DIR__ . '/../Library/Socket'
));
$loader->register();
