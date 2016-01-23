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
namespace Library\Tools\Rcon;


/**
 * Library\Tools\Rcon\RconInterface
 * This interface must be implemented on all rcon related classes
 */
interface RconInterface
{
    /**
     * 
     * @param type $ip
     * @param type $port
     * @param type $rcon_password
     */
    public function authenticate($ip,$port,$rcon_password);
    
     /**
     * Get Last Rcon Error message
     * 
     * @return type
     */
    public function getError();
    
    /**
     * Get Sourceserver IP
     * 
     * @return type
     */
    public function getIp();
    
    /**
     * Get Sourceserver Port
     * 
     * @return type
     */
    public function getPort();
    
    /**
     * Get the Rcon password
     * 
     * @return type
     */
    public function getRconPassword();
    
    /**
     * Get Rcon status, True if Connected 
     * 
     * @return type
     */
    public function getStatus(); 
    
    
}