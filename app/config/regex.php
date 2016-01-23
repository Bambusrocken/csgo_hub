<?php

/* 
 * Copyright (C) 2016 André Karlsson <andre@sess.se>
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
 * 
 * @author Andre Karlsson <andre@sess.se>
 */

return new \Phalcon\Config(array(
    
    /**
     * Regex expressions are created based on Valve Log standard: 
     * https://developer.valvesoftware.com/wiki/HL_Log_Standard 
     * 
     * PHP Live Regex tool (http://www.phpliveregex.com/) was used to create them!
     * 
     * executed preg_match is returned as an array:
     * 
     * (Example)
     * 
     * array(
     *  0	=>	"DR_death<12><BOT><TERRORIST>" killed "tHe_slayer<2><STEAM_1:0:1782031><CT>" with "galilar"
     *  a_name	=>	DR_death
     *  1	=>	DR_death
     *  a_cid	=>	12
     *  2	=>	12
     *  a_guid	=>	BOT
     *  3	=>	BOT
     *  a_team	=>	TERRORIST
     *  4	=>	TERRORIST
     *  v_name	=>	tHe_slayer
     *  5	=>	tHe_slayer
     *  v_cid	=>	2
     *  6	=>	2
     *  v_guid	=>	STEAM_1:0:1782031
     *  7	=>	STEAM_1:0:1782031
     *  v_team	=>	CT
     *  8	=>	CT
     *  weapon	=>	galilar
     *  9	=>	galilar
     *  properties	=>	
     *  10	=>	
     *  )
     * 
     */
    
    'playerActionHap' => '/\"(?P<name>.+)<(?P<cid>\d+)><(?P<guid>.+)><(?P<team>.*)>" triggered "(?P<event_name>\S+)"(?P<properties>.*)/',
    'attackHap' => '/\"(?P<a_name>.+)<(?P<a_cid>\d+)><(?P<a_guid>.+)><(?P<a_team>.*)>" \[(?P<a_pos_x>.+) (?P<a_pos_y>.+) (?P<a_pos_z>.+)\] attacked "(?P<v_name>.+)<(?P<v_cid>\d+)><(?P<v_guid>.+)><(?P<v_team>.*)>" \[(?P<v_pos_x>.+) (?P<v_pos_y>.+) (?P<v_pos_z>.+)\] with "(?P<weapon>\S*)"(?P<properties>.*)/',
    'killHap' => '/\"(?P<a_name>.+)<(?P<a_cid>\d+)><(?P<a_guid>.+)><(?P<a_team>.*)>" killed "(?P<v_name>.+)<(?P<v_cid>\d+)><(?P<v_guid>.+)><(?P<v_team>.*)>" with "(?P<weapon>\S*)"(?P<properties>.*)/',
    'suicideHap' => '/\"(?P<name>.+)<(?P<cid>\d+)><(?P<guid>.+)><(?P<team>.*)>\" committed suicide with \"(?P<weapon>\S*)\"/',
    'worldHap' => '/World triggered "(?P<event_name>\S*)"(?P<properties>.*)/',
    'playerJoinHap' => '/\"(?P<name>.+)<(?P<cid>\d+)><(?P<guid>.+)><(?P<old_team>\S+)>" joined team "(?P<new_team>\S+)"/',
    'playerEnterHap' => '/\"(?P<name>.+)<(?P<cid>\d+)><(?P<guid>.+)><(?P<team>.*)>" entered the game/',
    /*This one (nades) are not documented on HL_Log_Standard site at Valve!!*/
    'nadesHap' => '/\"(?P<name>.+)<(?P<cid>\d+)><(?P<guid>.+)><(?P<team>.*)>" threw (?P<nade>\S+)\[(?P<pos_x>.+) (?P<pos_y>.+) (?P<pos_z>.+)\]/',
    
));
