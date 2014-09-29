#!/usr/bin/env php
<?php

require_once __DIR__.'/vendor/autoload.php';

$application = new Application();
$application->run($argc, $argv);
