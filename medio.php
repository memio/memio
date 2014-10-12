#!/usr/bin/env php
<?php

require_once __DIR__.'/vendor/autoload.php';

use Gnugat\Medio\Container;

$application = Container::getApplication();
$application->run($argc, $argv);
