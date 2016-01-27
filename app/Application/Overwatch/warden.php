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

class warden extends \Phalcon\Di\Injectable
{
    
    private $di;                //Dependecy Ínjector Container     
    //Classes from constructor for logical game data.
    private $hapWatcher;        //Happening Message service
    private $rcon;              //Rcon class
    
    private $match_id;          //Map Details
    private $server_ip;         //Actual IP of the game beeing handled
    private $rcon_password;     //Rcon Password for $server_ip
            
    function __construct($hapWatcher,$rcon,$match_id,$server_ip,$rcon_password) {
        $this->di=getDI();
        
        $di['logger']->info('Start game warden for: ' . $server_ip);
        
        $this->hapWatcher=$hapWatcher;
        $this->rcon=$rcon;
        $this->match_id=$match_id;
        $this->rcon_password=$rcon_password;
    }
}
