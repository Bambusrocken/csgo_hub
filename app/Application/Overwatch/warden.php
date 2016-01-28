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

/**
 * warden is where the actual gameplay are beeing tracked.
 *
 * @author andrek
 */
namespace Application\Overwatch;

class warden extends \Phalcon\Di\Injectable
{
    
    private $di;                //Dependecy Ínjector Container  
    //   
    /* Classes from constructor for logical game data.
     *
     */
    private $hapWatcher;        //Happening Message service
    private $rcon;              //Rcon class
    
    private $warden_id;         //Unique ID for THIS warden
    private $game_ip;           //Actual IP and port of the game beeing handled
    private $rcon_password;     //Rcon Password for $game_ip
    
    private $ip;
            
    function __construct($hapWatcher,$rcon,$warden_id,$game_ip,$rcon_password) {
        $this->di=$this->getDI();
        
        $this->di['logger']->info('Start game warden for game Server: ' . $game_ip . " warden id: " . $warden_id . ".");
        
        $this->hapWatcher = $hapWatcher;
        $this->rcon = $rcon;
        $this->game_ip = $game_ip;
        $this->warden_id = $warden_id;
        $this->rcon_password = $rcon_password;
        
        $this->ip =  explode(":", $this->game_ip);
        
        $this->rcon->authenticate($this->ip[0],$this->ip[1],$this->rcon_password);
        $this->rcon->send('mp_restartgame 1');
    }
    
    public function manageHaps($happening) {
        
        $hapEvent =$this->hapWatcher->decodeGameHap($happening);
        echo var_dump($hapEvent);
        
    }
}
