<?php

/**
 * PHP CS Fixer documentation:
 * - Homepage: https://cs.symfony.com/
 * - List of all available rules: https://cs.symfony.com/doc/rules/index.html
 * - List of all available rule sets: https://cs.symfony.com/doc/ruleSets/index.html
 * - Find / Compare / See History rules: https://mlocati.github.io/php-cs-fixer-configurator
 *
 * To inspect a specific rule (e.g. `blank_line_before_statement`), run:
 *
 * ```console
 * > php-cs-fixer describe blank_line_before_statement
 * ```
 *
 * ------------------------------------------------------------------------------
 *
 * `new \PhpCsFixer\Finder()` is equivalent to:
 *
 * ```php
 * \Symfony\Component\Finder\Finder::create()
 *     ->files()
 *     ->name('/\.php$/')
 *     ->exclude('vendor')
 *     ->ignoreVCSIgnored(true) // Follow rules establish in .gitignore
 *     ->ignoreDotFiles(false) // Do not ignore files starting with `.`, like `.php-cs-fixer-dist.php`
 * ;
 * ```
 */

$finder = (new PhpCsFixer\Finder())
    ->in(__DIR__)
;

return (new PhpCsFixer\Config())
    ->setRules([
        '@Symfony' => true,
    ])
    ->setUsingCache(true)
    ->setFinder($finder)
;
