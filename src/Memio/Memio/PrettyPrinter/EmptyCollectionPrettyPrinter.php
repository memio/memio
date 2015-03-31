<?php

/*
 * This file is part of the Memio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Memio\Memio\PrettyPrinter;

class EmptyCollectionPrettyPrinter implements PrettyPrinterStrategy
{
    /**
     * {@inheritDoc}
     */
    public function supports($model)
    {
        return (is_array($model) && empty($model));
    }

    /**
     * {@inheritDoc}
     */
    public function generateCode($model, array $parameters = array())
    {
        return '';
    }
}
