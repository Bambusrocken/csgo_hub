<?php

use Phalcon\Logger;

class MainTask extends \Phalcon\Cli\Task
{
    public function mainAction()
    {
        echo "Congratulations! You are now flying with Phalcon CLI!";
        echo PHP_EOL;
        $this->logger->info("This is an info message");
        
        
        
    }

}
