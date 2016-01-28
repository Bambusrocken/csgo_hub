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
 * Description of player
 *
 * @author andrek
 */
namespace Application\Game;


class player {
    
    private $id = 0;
    private $match_id = 0;
    private $map_id = 0;
    private $save_mode = null;
    private $steamid = "";
    private $ip = "";
    private $online = true;
    private $kills = 0;
    private $assists = 0;
    private $deaths = 0;
    private $hs_kills = 0;
    private $hs = 0;
    private $bombs_planted = 0;
    private $bomb_detonated = 0;
    private $bombs_defused = 0;
    private $tk = 0;
    private $point = 0;
    private $name = "";
    private $mysql_id = 0;
    private $currentSide = "";
    private $killRound = 0;
    private $alive = true;
    private $firstKill = 0;
    private $v1 = 0;
    private $v2 = 0;
    private $v3 = 0;
    private $v4 = 0;
    private $v5 = 0;
    private $k1 = 0;
    private $k2 = 0;
    private $k3 = 0;
    private $k4 = 0;
    private $k5 = 0;
    private $firstSide = "";
    private $checkBDD = false;
    private $gotFirstKill = false;
    private $needSave = false;
    
    private $di;
    
    public function __construct() {
        $this->di=$this->getDI();
    }
}
