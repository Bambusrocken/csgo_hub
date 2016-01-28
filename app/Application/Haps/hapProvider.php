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
    
    public function __construct() {    
        $this->di=$this->getDI();
        $this->regex=$this->di['regex']->haps->{get_called_class()};
        echo "Create Happening for ". get_called_class() . PHP_EOL;
        $this->di['logger']->info("Create Happening for ". get_called_class());
    }
    
    /** 
     * Comapring the message with the registered regex to get the Happening,
     * and return it as an Array
     * 
     * Since there is only (currently) two Haps generating the array key 
     * 'event_name' from the regex Capture groups. We add the 
     * called_class as 'event_name'. This is used for declassification 
     * in the warden     
     *    
     * @param type $hapInfo_Raw
     * @return boolean
     */
    public function compare($hapInfo_Raw) {
        if (preg_match($this->regex,$hapInfo_Raw,$found)){
            $this->hapInfo = $found;
            
            if (!array_key_exists('event_name', $this->hapInfo)) {
                $this->hapInfo['event_name']=get_called_class();
            }
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
