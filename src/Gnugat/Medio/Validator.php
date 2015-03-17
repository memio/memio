<?php

/*
 * This file is part of the Medio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gnugat\Medio;

use Gnugat\Medio\Validator\ValidatorStrategy;

class Validator
{
    /**
     * @var array
     */
    private $validatorStrategies = array();

    /**
     * @param ValidatorStrategy $validatorStrategy
     */
    public function add(ValidatorStrategy $validatorStrategy)
    {
        $this->validatorStrategies[] = $validatorStrategy;
    }

    /**
     * @param mixed $model
     *
     * @throws \Gnugat\Medio\Exception\DomainException If model violates some constraints
     */
    public function validate($model)
    {
        foreach ($this->validatorStrategies as $validatorStrategy) {
            if ($validatorStrategy->supports($model)) {
                $validatorStrategy->validate($model);

                return;
            }
        }
    }
}
