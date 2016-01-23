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

use Library\Tools\Rcon\RconProvider;
//use Library\Tools\Rcon\RconInterface;

class Rcon extends RconProvider 
{
    
    /**
     * 
     * @param type $cmd
     * @return boolean
     * 
     * TODO Implement Exception on error! 
     */
    public function send($cmd){
        
         if (($this->gameserver != null) && $this->getStatus()){
                 return $this->tryRconExec($cmd);
        }else {
            return false;
        }
    }
    
    /**
     * 
     * @param type $cmd
     * @return type
     * @var type $response
     */
    private function tryRconExec($cmd){
        
        $resopnse=$this->gameserver->rconExec($cmd);
        
        if(($this->gameserver!=null)&& $this->getStatus()) {
            return $resopnse;
        }else {
            $this->di['logger']->debug("Unable to  Execute RCON command : " . $cmd . "on " . $this->getIp() . ":" . $this->getPort() . " (" . $this->getError() . ")");
            //throw new \Library\Tools\Exceptions\RconException("Can't Execute Rcon command : " . $cmd . "on " . $this->getIp() . ":" . $this->getPort() . " (" . $this->getError() . ")");
        }
    }
    
}