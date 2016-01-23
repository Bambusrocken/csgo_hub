<?php

/* 
 * Copyright (C) 2016 andrek
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
 */

namespace Library\Tools\Application;

use Phalcon\DI\InjectionAwareInterface;

abstract class ApplicationBase implements ApplicationInterface, InjectionAwareInterface  {
    
    protected $di;
    protected $logger;
    
    public function __construct(\Phalcon\DiInterface $dependencyInjector = null) {
        $this->setDI($dependencyInjector);
        $this->di['logger']->info('Application Loaded!');
    }
    
    /**
     * Execute the primary application ß
     */
    public abstract function execute();
    
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
    
    public function setDI(\Phalcon\DiInterface $dependencyInjector)
    {
        $this->di = $dependencyInjector;
    }

    public function getDI()
    {
        return $this->di;
    }

}
?>