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
 * An abstract type which defines behavior using methods.
 *
 * @api
 */
interface Structure
{
    /**
     * @return string
     */
    public function getName();


    /**
     * @param Method $method
     *
     * @return Structure
     */
    public function addMethod(Method $method);

    /**
     * @return \Gnugat\Medio\ValueObject\Collection
     */
    public function allMethods();
}
