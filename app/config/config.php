<?php

return new \Phalcon\Config(array(

    'version' => '0.1',

    /**
     * if true, then we print a new line at the end of each execution
     *
     * If we dont print a new line,
     * then the next command prompt will be placed directly on the left of the output
     * and it is less readable.
     *
     * You can disable this behaviour if the output of your application needs to don't have a new line at end
     */
    'printNewLine' => true,
    
    'logfile' => dirname(__DIR__) . '/logs/GManager.log',
    
    'datasocket' => array(
            'type' => 'udp',
            'host' => '192.168.101.214',
            'port' => '21001'
    ),
    
    'db' => array(
        'adapter'     => 'Mysql',
        'host'        => '192.168.101.214',
        'username'    => 'ebotv3',
        'password'    => 'ebotv3',
        'dbname'      => 'ebotv3',
        'charset'     => 'utf8',
    ),
    //TDOD: Data already in regex conf use that instead
    'haps' => array(
        'attackHap',
        'killHap',
        'nadesHap',
        'playerActionHap',
        'playerEnterHap',
        'playerJoinHap',
        'suicideHap',
        'wordldHap'
    )
));
