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
    
    /*protected $a_user_id;       //Attacker UserID
    protected $a_user_name;     //Attacker Username
    protected $a_user_team;     //Atacker Team
    protected $a_user_steamid;   //Attacker SteamID
    protected $a_pos_x;       //Attacker Position on map X-Coordinate
    protected $a_pos_x;       //Attacker Position on map Y-Coordinate
    protected $a_pos_x;       //Attacker Position on map z-Coordinate
    protected $v_user_id;     //Victim UserID, user that recives the action  
    protected $v_user_name;   //Victim UserName, user that recives the action
    protected $v_user_team;   //Victim User team, user that recives the action
    protected $v_user_steamid;//Victim User steamId, user that recives the action
    protected $v_pos_x;        //Victim Position on map X-Coordinate
    protected $v_pos_y;        //Victim Position on map Y-Coordinate
    protected $v_pos_z;        //Victim Position on map Z-Coordinate
    protected $weapon;             //Weapon used for the Hap
    protected $headshot;           //Was action a headshot?
    protected $team;               //What team is this?
    protected $team_win;           //Did that team win or lose?
    protected $type;               //How did they win or lose?
    protected $score;              //Score for team (or player?)
    protected $players;            //Team Members*/
    
    public function __construct() {    
        $this->di=$this->getDI();
        $this->regex=$this->di['regex']->haps->{get_called_class()};
        echo "Create Happening for ". get_called_class() . PHP_EOL;
        $this->di['logger']->info("Create Happening for ". get_called_class());
    }
    
    public function compare($hapInfo_Raw) {
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
    abstract function generateHap();
}
