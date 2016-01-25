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


class gameWatcher extends Injectable
{
    private $active_games;
    private $di;
    //private $game_trap(array('192.168.110.25:27015' => ''))
    
    public function __construct() {
        $this->di=$this->getDI();
        echo "gameWatcher going Live" . PHP_EOL;
        $this->di['logger']->info("gameWatcher going Live");

    }
    
    public function status() {
        
        $this->di['logger']->debug('Trying to find new games from the Database');
        $query = $this->di['modelsManager']->createQuery("SELECT m.team_a_name, m.team_b_name, m.id,ta.name,tb.name, s.id,s.ip,s.rcon FROM matchs AS m, servers AS s, teams as ta, teams as tb WHERE m.auto_start=1 AND m.team_a_name=ta.name AND m.team_b_name=tb.name AND m.server_id=s.id");
        $result = $query->execute();
        echo 'SQL_DUMP' . PHP_EOL;
        
        foreach ($result as $row) {
            echo var_dump($row);
        }
        
        
    }
    
    public function getMatch($ip) {
        if (@$this->matchs[$ip]) {
            return $this->matchs[$ip];
        } else {
            return null;
        }
    }
    
}