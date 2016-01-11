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

namespace Config;

use Library\Tools\Factory\DI;
use Library\Tools\Factory\ServiceInterface;

class ServiceProviders implements ServiceInterface
{ 
    public function register(DI $factory){
        $factory['config'] = function ($inj) use ($config) {
            return $config;
        };
        
        $factory['logger']=function ($inj) {
        return new \Library\Logger\Logger($config->logfile);
        }; 
    }
}