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

use Gnugat\Medio\Validator\ModelValidator;

class Validator
{
    /**
     * @var array
     */
    private $modelValidators = array();

    /**
     * @param ModelValidator $modelValidator
     */
    public function add(ModelValidator $modelValidator)
    {
        $this->modelValidators[] = $modelValidator;
    }

    /**
     * @param mixed $model
     *
     * @throws \Gnugat\Medio\Exception\InvalidModelException If model is invalid
     */
    public function validate($model)
    {
        foreach ($this->modelValidators as $modelValidator) {
            if ($modelValidator->supports($model)) {
                $modelValidator->validate($model);

                return;
            }
        }
    }
}
