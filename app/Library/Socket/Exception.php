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

namespace Library\Socket;

use RuntimeException;

class Exception extends RuntimeException
{
    /**
     * Create an Exception after a socket operation on the given $resource failed
     *
     * @param resource $resource
     * @param string   $messagePrefix
     * @return self
     * @uses socket_last_error() to get last socket error code
     * @uses socket_clear_error() to clear socket error code
     * @uses self::createFromCode() to automatically construct exception with full error message
     */
    public static function createFromSocketResource($resource, $messagePrefix = 'Socket operation failed')
    {
        $code = socket_last_error($resource);
        socket_clear_error($resource);
        return self::createFromCode($code, $messagePrefix);
    }
    /**
     * Create an Exception after a global socket operation failed (like socket creation)
     *
     * @param string $messagePrefix
     * @return self
     * @uses socket_last_error() to get last global error code
     * @uses socket_clear_error() to clear global error code
     * @uses self::createFromCode() to automatically construct exception with full error message
     */
    public static function createFromGlobalSocketOperation($messagePrefix = 'Socket operation failed')
    {
        $code = socket_last_error();
        socket_clear_error();
        return self::createFromCode($code, $messagePrefix);
    }
    /**
     * Create an Exception for given error $code
     *
     * @param int    $code
     * @param string $messagePrefix
     * @return self
     * @throws Exception if given $val is boolean false
     * @uses self::getErrorMessage() to translate error code to error message
     */
    public static function createFromCode($code, $messagePrefix = 'Socket error')
    {
        return new self($messagePrefix . ': ' . self::getErrorMessage($code), $code);
    }
    /**
     * get error message for given error code
     *
     * @param int $code error code
     * @return string
     * @uses socket_strerror() to translate error code to error message
     * @uses get_defined_constants() to check for related error constant
     */
    protected static function getErrorMessage($code)
    {
        $string = socket_strerror($code);
        // search constant starting with SOCKET_ for this error code
        foreach (get_defined_constants() as $key => $value) {
            if($value === $code && strpos($key, 'SOCKET_') === 0) {
                $string .= ' (' . $key . ')';
                break;
            }
        }
        return $string;
    }
}