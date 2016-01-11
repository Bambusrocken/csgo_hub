<?php

/* 
 * Copyright (C) 2016 André Karlsson <andre@sess.se>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 * 
 * @author Andre Karlsson <andre@sess.se>
 */
namespace Application;

error_reporting(E_ALL);
include_once APP_ROOT . 'app' . DIRECTORY_SEPARATOR . 'Library'. DIRECTORY_SEPARATOR . 'Tools'. DIRECTORY_SEPARATOR . 'Helpers'. DIRECTORY_SEPARATOR . 'Helpers.php';

use Library\Tools\Factory\DI;
use Library\Socket\Maker;
use Library\Logger\Logger;
use Library\Tools\Application\ApplicationBase;


class Application extends ApplicationBase 
{
    private $logger;
    
    public function __construct() {
        app('logger')->log("Notice message",Logger::NOTICE);
    }
    /**
     * Execute the primary application 
     */
    public function execute() {
        $logger->log('Application executet', Logger::NOTICE);
    }
    
    /**
     * Return friendly name of Application
     * 
     * @return string Name and version of application
     */
    public function getName() {
        
    }
    
    /**
     * Return the version only
     * 
     * @return string Version of main application only
     */
    public function getVersion() {
        
    }
}