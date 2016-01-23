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

use Phalcon\Di;
use Library\Tools\Application\ApplicationBase;
use Library\Tools\Rcon\Rcon;


class Application extends ApplicationBase 
{
    
 
    //Moved to Abstract class pontare
    /*
    public function __construct(\Phalcon\DiInterface $dependencyInjector = null) {
       parent::__construct($dependencyInjector);
    }
    */
    
    public function execute(){
        
        $logdata='';
        //Infinitive loop for now
        $this->di['rcon']->authenticate('192.168.110.25',27015,'qwerty1234!');
        $this->di['rcon']->send('mp_restartgame 1');
        while(true) {
            
            $logdata=$this->di['udpsocket']->recvFrom();
            $data=$logdata[0];
            $ip=$logdata[1];
            
            if (!empty($data)) {
               $happening=  rtrim(substr($data,5));
               echo $happening . ':' . $ip . PHP_EOL;
            }
            
            $data=FALSE;
            $ip=FALSE;
        }
    }
}