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

namespace Library\Helpers;

use Library\Tools\Factory\DI;

/**
 * On first call instantiate Pimple container and register the providers
 * loading them form a file. On subsequent calls returns container itself
 * or a service, if $which param is a service id.
 *
 * @param string|void $which Service id to retrieve
 * @staticvar \Library\Tools\Factory\DI $app Container instance
 * @return mixed
 * @throws \InvalidArgumentException If $which param isn't null but service is not defined
 */
function app($which = null)
{
  static $app = null;
 
  if (is_null($app)) {
    $app = new DI;
    $providers = (array) require __DIR__.'/Providers.php';
    array_walk($providers, function($class, $i, $app) {
      class_exists($class) AND $app->register(new $class);
    }, $app);
  }
 
  return is_null($which) || ! is_string($which) ? $app : $app[$which];
}