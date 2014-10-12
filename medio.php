#!/usr/bin/env php
<?php

/*
 * This file is part of the Medio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require_once __DIR__.'/vendor/autoload.php';

use Gnugat\Medio\Container;

$application = Container::getApplication();
$application->run($argc, $argv);
