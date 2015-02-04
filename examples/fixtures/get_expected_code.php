<?php

/**
 * Fixtures are stored:
 *
 * + in a directory named after the Test Class
 * + in a file named after the Test Method
 * + with an extra empty line at the end of the file
 *
 * @return string
 */
function get_expected_code()
{
    $trace = debug_backtrace();
    $testFullyQualifiedClassname = $trace[1]['class'];
    $testClass = end(explode('\\', $testFullyQualifiedClassname));
    $testMethod = $trace[1]['function'];
    $filename = __DIR__.'/'.$testClass.'/'.$testMethod.'.txt';

    return substr(file_get_contents($filename), 0, -1);
}
