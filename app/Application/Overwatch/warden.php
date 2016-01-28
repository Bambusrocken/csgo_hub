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
       
    /* Classes from __construct for logical game data.
     *
     */
    private $hapWatcher;        //Happening Message service
    private $rcon;              //Rcon class
    
    private $warden_id;         //Unique ID for THIS warden
    private $game_ip;           //Actual IP and port of the game beeing handled
    private $rcon_password;     //Rcon Password for $game_ip
    /* End of__construct variable */
    
    private $ip;
    private $warden_routine;
    
    private $current_map=NULL;
    
    private $players=array();
            
    function __construct($hapWatcher,$rcon,$warden_id,$game_ip,$rcon_password) {
        $this->di=$this->getDI();
        
        $this->di['logger']->info('Start game warden for game Server: ' . $game_ip . " warden id: " . $warden_id . ".");
        
        $this->hapWatcher = $hapWatcher;
        $this->rcon = $rcon;
        $this->game_ip = $game_ip;
        $this->warden_id = $warden_id;
        $this->rcon_password = $rcon_password;
        
        $this->warden_routine =  \Matchs::findFirst(array('id'=>$this->warden_id));
        
        /*
         * Authenticate Rcon and add Overwatcher as log server (log_address_Add
         * $game_ip is in form 1.2.3.4:56789, separate using explode. 
         * $ip[0]=1.2.3.4;$ip[1]=56789
         * 
         */
        $this->ip =  explode(":", $this->game_ip);
        $this->rcon->authenticate($this->ip[0],$this->ip[1],$this->rcon_password);
        $this->rcon->send("log on; mp_logdetail 3; logaddress_add " . $this->di['config']->datasocket->host . ":" . $this->di['config']->datasocket->port);
        $this->rcon->send('mp_restartgame 1');
        
        //TODO: Manage Excpetion... boring
        //TODO: Let Warden Control the game
        
        
    }
    
    public function manageHaps($happening) {
        
        $hapEvent =$this->hapWatcher->decodeGameHap($happening);
        //echo var_dump($hapEvent['event_name']);
        
        switch ($hapEvent['event_name']) {
            case 'Match_Start' :
                $this->matchStartAction($hapEvent);
                
                //echo substr($hapEvent['properties'],4) . PHP_EOL;
                break;
            
            case 'killHap' : 
                //$this->killHapAction($hapEvent);
                break;

            default:
                $this->di['logger']->warning("Happening not (yet) managed: " . $hapEvent['event_name']);
                break;
        }
        
    }
    
    private function matchStartAction($hapEvent) {
        if ($this->current_map = NULL) {    //Map never initiated
               $this->current_map = substr($hapEvent['properties'],4);
        } elseif($this->current_map!=substr($hapEvent['properties'],4)) {
            //We have some kind of map change deal with it
        } else {
            //First map on new game server, deal with it
        } 
                
    }
    
    private function killHapAction($hapEvent) {
        
    }
    
    private function playerAction($user_id,$user_name,$user_team,$steam_id) {
        $this->di['logger']->dedug("Verifying player $user_id,$user_name,$user_team,$steam_id");
        
        array_key_exists($this->players[$steam_id],$steam_id) ? $player=$this->players[$steam_id] : $player = NULL;
        
        if ($player==NULL) {
            $player = $this->di->get('player',array($this->warden_id,$this->current_map,$steam_id));
        }
    }
}
