<?php

declare(strict_types=1);

use Rector\Caching\ValueObject\Storage\FileCacheStorage;
use Rector\Config\RectorConfig;
use Rector\Set\ValueObject\SetList;

return RectorConfig::configure()
    ->withCache(
        '/tmp/rector',
        FileCacheStorage::class
    )
    ->withPaths([
        __DIR__,
    ])
    ->withSkip([
        // —— Excluded paths ———————————————————————————————————————————————————
        // Excluded folders
        __DIR__.'/vendor',

        // —— Excluded rules ———————————————————————————————————————————————————
    ])
    ->withSets([
        // —— PHP ——————————————————————————————————————————————————————————————
        SetList::PHP_72,
    ])
    ->withRules([
    ]);
