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

use Library\Tools\Exceptions\RconException;
use Library\Tools\Rcon\RconInterface;
use Phalcon\Di\Injectable;

/**
 * Abstract class to Provide Rcon conection
 */
abstract class RconProvider extends Injectable implements RconInterface
{
    
    private $ip;
    private $port;
    private $rcon_password;
    private $error;
    private $status;
    //protected $logger;
    protected $di;
    protected $gameserver=null;
    
    /**
     * Constructor for the new class
     */
    public function __construct() {
        $this->di=$this->getDI();
        $this->di['logger']->info("Rcon loaded");
    }
    
    /**
     * Authenticate to the Sourceserver
     * 
     * @param type $ip
     * @param type $port
     * @param type $rcon_password
     */
    public function authenticate($ip,$port,$rcon_password){
        $this->ip = $ip;
        $this->port = $port;
        $this->rcon_password = $rcon_password;
        $this->di['logger']->debug("Trying to Authenticate to SourceServer");
        if (!$this->_auth()){
            $this->di['logger']->error("Can't Authenticate to SourceServer on " . $this->getIp() . ":" . $this->getPort() . " (" . $this->getError() . ")");
            //throw new RconException("Can't Authenticate to SourceServer on " . $this->getIp() . ":" . $this->getPort() . " (" . $this->getError() . ")");
        }
    }
    
    /**
     * Get Last Rcon Error message
     * 
     * @return type
     */
    public function getError(){
        return $this->error;
    }
    
    /**
     * Get Sourceserver IP
     * 
     * @return type
     */
    public function getIp(){
        return $this->ip;
    }
    
    /**
     * Get Sourceserver Port
     * 
     * @return type
     */
    public function getPort(){
        return $this->port;
    }
    
    /**
     * Get the Rcon password in clear text
     * 
     * @return type
     */
    public function getRconPassword(){
        return $this->rcon_password;
    }
    
    /**
     * Get Rcon status, True if Connected 
     * 
     * @return type
     */
    public function getStatus(){
        return $this->status;
    }
    
    //-----------Helpers------------
    
    /**
     * Authenticate the Rcon Connection and set status.
     * 
     * NOT used
     */
    private function tryRconAuth() {
        if(!$this->gameserver->rconAuth($this->getRconPassword())) {
            $this->status=false;
        }else{
            $this->status=true;
        }
    }
    
    /**
     * Helper to create the acctual SourceServer (steamcondenser)
     * 
     * @return boolean
     */
    private function _auth() {
        $this->di['logger']->debug($this->getIp().':'.$this->getPort() . '@' . $this->getRconPassword());
        $this->gameserver = new \SourceServer($this->getIp(), $this->getPort());
        try {
            $this->gameserver->rconAuth($this->getRconPassword());
            $this->di['logger']->debug($this->getIp().':'.$this->getPort() . '@' . $this->getRconPassword());
            $this->status = true;
            return true;
        } catch (\Exception $e) {
            $this->error = $e->getMessage();
            $this->status = false;
            return false;
        }
    }
}