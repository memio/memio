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

class MethodCannotBeBothAbstractAndFinal implements Constraint
{
    /**
     * {@inheritDoc}
     */
    public function validate($model)
    {
        if ($model->isAbstract() && $model->isFinal()) {
            return new SomeViolation(sprintf('Method "%s" cannot be both abstract and final', $model->getName()));
        }

        return new NoneViolation();
    }
}
