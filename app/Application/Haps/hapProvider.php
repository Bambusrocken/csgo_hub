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
namespace Application\Haps;

use Phalcon\Di\Injectable;

/**
 * Description of hapProvider
 *
 * @author andrek
 */
abstract class hapProvider extends Injectable{
    protected $regex;
    protected $hapInfo;
    protected $di;
    protected $hapEvent;
    //protected $h_Option;
    
    public $userId = "";        //Attacker UserID
    public $userName = "";      //Attacker Username
    public $userTeam = "";      //Atacker Team
    public $userSteamid = "";   //Attacker SteamID
    public $a_pos_x  = 0;       //Attacker Position on map X-Coordinate
    public $a_pos_x  = 0;       //Attacker Position on map Y-Coordinate
    public $a_pos_x  = 0;       //Attacker Position on map z-Coordinate
    public $v_user_id = "";     //Victim UserID, user that recives the action  
    public $v_user_name = "";   //Victim UserName, user that recives the action
    public $v_user_team = "";   //Victim User team, user that recives the action
    public $v_user_steamid = "";//Victim User steamId, user that recives the action
    public $v_pos_x = 0;        //Victim Position on map X-Coordinate
    public $v_pos_y = 0;        //Victim Position on map Y-Coordinate
    public $v_pos_z = 0;        //Victim Position on map Z-Coordinate
    public $weapon;             //Weapon used for the Hap
    public $headshot;           //Was action a headshot?
    public $team;               //What team is this?
    public $team_win;           //Did that team win or lose?
    public $type;               //How did they win or lose?
    public $score;              //Score for team (or player?)
    public $players;            //Team Members
    
    protected function __construct()
    {   $this->di=getDi();
        $this->regex=$this->di['regex'][get_called_class()];
    }
    
    public function compare($hapInfo_Raw)
    {
        if (preg_match($this->regex,$hapInfo_Raw,$found)){
            $this->hapInfo = $found;
            return TRUE;
        }
        return FALSE;
    }
    
    protected function setH_Event($name) {
		$this->hapEvent = $name;
    }
    
    public function getH_Event() {
            return $this->hapEvent;
    }
    
    public function setOption($option, $value) {
            $this->$option = $value;
    }
    
    public function getOption($option) {
            return $this->$option;
    }

    private function lcf($aText) {
            //PHP 5.3
            if (function_exists('lcfirst'))
                    return lcfirst($aText);
    }
    
    //Move to the interface??
    abstract function action();
}
