<?php

/*
 * This file is part of the Memio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Memio\Memio\Validator\Constraint;

use Memio\Memio\Validator\Constraint;
use Memio\Memio\Validator\Violation\NoneViolation;
use Memio\Memio\Validator\Violation\SomeViolation;

class ObjectArgumentCanOnlyDefaultToNull implements Constraint
{
    /**
     * {@inheritDoc}
     */
    public function validate($model)
    {
        $defaultValue = $model->getDefaultValue();
        if (!$model->isObject() || null === $defaultValue || 'null' === $defaultValue) {
            return new NoneViolation();
        }

        return new SomeViolation(sprintf('Object Argument "%s" can only default to null', $model->getName()));
    }
}
