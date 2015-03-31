<?php

/*
 * This file is part of the Memio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Memio\Memio\Validator;

interface ModelValidator
{
    /**
     * @param Constraint $constraint
     */
    public function add(Constraint $constraint);

    /**
     * @param mixed $model
     *
     * @return bool
     */
    public function supports($model);

    /**
     * @param mixed $model
     *
     * @return ViolationCollection
     */
    public function validate($model);
}
