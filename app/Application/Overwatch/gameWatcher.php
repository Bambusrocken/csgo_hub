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
namespace Application\Overwatch;

use Phalcon\Di\Injectable;
use Phalcon\Mvc\Model\Query;

/**
 * 
 */
class gameWatcher extends Injectable
{
    private $active_wardens = array();      //Array for all active wardens
    private $already_engaged = array();
    private $di;
    //private $game_trap(array('192.168.110.25:27015' => ''))
    
    public function __construct() {
        $this->di=$this->getDI();
        echo "gameWatcher going Live" . PHP_EOL;
        $this->di['logger']->info("gameWatcher going Live");

    }
    
    /**
     * 
     */
    public function status() {
        
        //$this->di['logger']->debug('Trying to find new games from the Database');
        $query = $this->di['modelsManager']->createQuery("SELECT m.team_a_name, m.team_b_name, m.id,m.team_a, m.team_b, s.id,s.ip,s.rcon FROM matchs AS m, servers AS s, teams AS ta, teams AS tb WHERE m.auto_start=1 AND m.team_a=ta.id AND m.team_b=tb.id AND m.server_id=s.id");
        $result = $query->execute();
        echo 'SQL_DUMP' . PHP_EOL;
        
        foreach ($result as $new_warden) {
            if (!array_key_exists($new_warden['ip'], $this->active_wardens)) {  //Are there any games active on the is IP (w.x.y.x:ABCDE) already
                
                $this->di['logger']->info('Create new Game for ### ' . $this->getTeamInfo($new_warden['team_a'])['name'] . " vs " . $this->getTeamInfo($new_warden['team_b'])['name'] . " ###");
                $this->newWarden($new_warden['id'], $new_warden['ip'], $new_warden['rcon']);    //Create the Actuall warden for this new game!
                
                //TODO: Set up and exceptions for generating new wardens
            }
        }
        
        
    }
    
    /**
     * 
     * @param type $ip
     * @param type $delay
     */
    public function setGameOnHold($ip, $delay = null) {
        if (!array_key_exists($ip, $this->already_engaged)) {
            if ($delay == null) {
                $delay = $di['config']['GAME_HOLD_DELAY'];
            }
            $this->already_engaged[$ip] = time() + $delay;
            $di['logger']->info("Hold " . $ip ." for " . $delay . "seconds");
        }
    }
    
    /**
     * 
     * @param type $warden_id
     * @param type $ip
     * @param type $rcon_password
     */
    public function newWarden($warden_id,$ip,$rcon_password) {
        if (array_key_exists($ip, $this->already_engaged)) {
            
            if (time() > $this->already_engaged[$ip]) {
                unset($this->already_engaged[$ip]);
            }
        } 
        
        elseif (!array_key_exists($ip, $this->already_engaged)) {
            
            if (!array_key_exists($ip, $this->active_wardens)) {
                $this->active_wardens[$ip] = $this->di->get('warden',array($warden_id,$ip,$rcon_password));
            } else {
                //TODO: Threw Some Excpetion
            }
            
        } else {
            //TDOD: Threw Some Other Exception
        }
    }
    
    /**
     * 
     * @param type $ip
     * @return type
     */
    public function getWarden($ip) {
        if (@$this->active_wardens[$ip]) {
            return $this->active_wardens[$ip];
        } else {
            return NULL;
        }
    }
    
    /**
     * 
     * @param type $team_id
     * @return boolean
     */
    private function getTeamInfo ($team_id) {
        if (is_numeric($team_id) && $team_id > 0) {
            $query = $this->di['modelsManager']->createQuery("SELECT name, id FROM Teams where id = :id:");
            return $query->execute(
                    array (
                        'id' => $team_id
            ))->getFirst();     //Might skip getFirst since we expect only one row using Primary key
        }
        else {return FALSE;}
    }
    
}