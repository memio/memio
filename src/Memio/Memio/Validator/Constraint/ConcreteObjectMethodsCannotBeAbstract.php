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

class ConcreteObjectMethodsCannotBeAbstract implements Constraint
{
    /**
     * {@inheritDoc}
     */
    public function validate($model)
    {
        if ($model->isAbstract()) {
            return new NoneViolation();
        }
        $objectName = $model->getName();
        $messages = array();
        foreach ($model->allMethods() as $method) {
            if ($method->isAbstract()) {
                $messages[] = sprintf('Concrete Object "%s" Method "%s" cannot be abstract', $objectName, $method->getName());
            }
        }

        return (empty($messages) ? new NoneViolation() : new SomeViolation(implode("\n", $messages)));
    }
}
