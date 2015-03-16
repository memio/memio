<?php

/*
 * This file is part of the Medio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gnugat\Medio\Config;

/**
 * @api
 */
class Path
{
    /**
     * @return string
     *
     * @api
     */
    public static function config()
    {
        return __DIR__;
    }

    /**
     * @return string
     *
     * @api
     */
    public static function templates()
    {
        return __DIR__.'/../templates';
    }
}
