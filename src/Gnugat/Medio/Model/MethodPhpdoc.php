<?php

/*
 * This file is part of the Medio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gnugat\Medio\Model;

/**
 * @api
 */
class MethodPhpdoc
{
    /**
     * @param Method $method
     *
     * @api
     */
    public function __construct(Method $method)
    {
        $this->method = $method;
    }

    /**
     * @param Method $method
     *
     * @return MethodPhpdoc
     *
     * @api
     */
    public static function make(Method $method)
    {
        return new self($method);
    }

    /**
     * @return array
     */
    public function getParameters()
    {
        return $this->method->getArgumentCollection()->all();
    }

    /**
     * @return bool
     */
    public function isEmpty()
    {
        return empty($this->getParameters());
    }
}
