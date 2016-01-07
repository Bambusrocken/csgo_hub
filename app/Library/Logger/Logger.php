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
namespace Library\Logger;

use Library\Tools\Singleton;
/**
     * Logger
     * 
     * Log notices, warnings, errors or fatal errors into a log file.
     * 
     * @author gehaxelt
     */
    class Logger extends Singleton 
    {
        
        /**
         * Holds the file handle.
         * 
         * @var resource
         */
        protected $fileHandle = NULL;
        
        /**
         * The time format to show in the log.
         * 
         * @var string
         */
        protected $timeFormat = 'D, d M y H:i:s O';
        
        /**
         * The file permissions.
         */
        const FILE_CHMOD = 756;
        
        const NOTICE = '[NOTICE]';
        const WARNING = '[WARNING]';
        const ERROR = '[ERROR]';
        const FATAL = '[FATAL]';
        
        /**
         * Opens the file handle.
         * 
         * @param string $logfile The path to the loggable file.
         */
        public function __construct($logfile) {
            if($this->fileHandle == NULL){
                $this->openLogFile($logfile);
            }
        }
        
        /**
         * Closes the file handle.
         */
        public function __destruct() {
            $this->closeLogFile();
        }
        
        /**
         * Logs the message into the log file.
         * 
         * @param  string $message     The log message.
         * @param  int    $messageType Optional: urgency of the message.
         */
        public function log($message, $messageType = Logger::WARNING) {
            if($this->fileHandle == NULL){
                throw new LoggerException('Logfile is not opened.');
            }
            
            if(!is_string($message)){
                throw new LoggerException('$message is not a string');
            }
            
            if($messageType != Logger::NOTICE &&
               $messageType != Logger::WARNING &&
               $messageType != Logger::ERROR &&
               $messageType != Logger::FATAL
            ){
                throw new LoggerException('Wrong $messagetype given.');
            }
            
            $this->writeToLogFile("[".$this->getTime()."]".$messageType." - ".$message);
        }
        
        /**
         * Writes content to the log file.
         * 
         * @param string $message
         */
        private function writeToLogFile($message) {
            flock($this->fileHandle, LOCK_EX);
            fwrite($this->fileHandle, $message.PHP_EOL);
            flock($this->fileHandle, LOCK_UN);
        }
        
        /**
         * Returns the current timestamp.
         * 
         * @return string with the current date
         */
        private function getTime() {
            return date($this->timeFormat);
        }
        
        /**
         * Closes the current log file.
         */
        protected function closeLogFile() {
            if($this->fileHandle != NULL) {
                fclose($this->fileHandle);
                $this->fileHandle = NULL;
            }
        }
        
        /**
         * Opens a file handle.
         * 
         * @param string $logFile Path to log file.
         */
        public function openLogFile($logFile) {
            $this->closeLogFile();
            
            if(!is_dir(dirname($logFile))){
                if(!mkdir(dirname($logFile), Logger::FILE_CHMOD, true)){
                    throw new LoggerException('Could not find or create directory for log file.');
                }
            }
            
            if(!$this->fileHandle = fopen($logFile, 'a+')){
                throw new LoggerException('Could not open file handle.');
            }
        }
        
    }
    