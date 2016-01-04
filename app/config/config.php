<?php

return new \Phalcon\Config(array(

    'version' => '1.0',

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
    
    'logfile' => 'app/logs/GManager.log',
    
    'datasocket' => array(
            'type' => 'udp',
            'host' => 'localhost',
            'port' => '21001'
    ),
    
    'queueDB' => array(
        'adapter' => 'Mysql',
        'host' => 'localhost',
        'username' => 'queue',
        'password' => 'queue',
        'dbname' => 'queue',
        "options" => array(
            \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'",
            \PDO::ATTR_CASE => \PDO::CASE_LOWER,
            \PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true,
            \PDO::ATTR_PERSISTENT => true
        )
    )
));
