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

class hapWatcher extends Injectable
{
    private $di;
    private $hapEvents;
    
    public function __construct() {
        $this->di=$this->getDI();
        echo 'hapWatcher going Live' . PHP_EOL;
        
        $this->hapEvents =  array_keys(get_object_vars($this->di['regex']->haps));      //Get All the avaliable Registred Haps from the config (config/regex.php)
    }
    
    /**
     * Decode the Source Hap using all avaliable haps and return The Hap as 
     * an Array (see corresopnding Hap class at Application/Haps/
     * 
     * @param type $message
     * @return array 
     */
    public function decodeGameHap($message) {
        foreach ($this->hapEvents as $hap ) {
            if ($this->di[$hap]->compare($message)) {
                return $this->di[$hap]->generateHap();
            }
        }
        
        return null;
    }
}