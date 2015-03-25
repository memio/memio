<?php

/*
 * This file is part of the Medio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gnugat\Medio\Validator\Constraint;

use Gnugat\Medio\Model\FullyQualifiedName;
use Gnugat\Medio\Validator\Constraint;
use Gnugat\Medio\Validator\Violation\NoneViolation;
use Gnugat\Medio\Validator\Violation\SomeViolation;

class CollectionCannotHaveNameDuplicates implements Constraint
{
    /**
     * {@inheritDoc}
     */
    public function validate($model)
    {
        $firstElement = current($model);
        $fqcn = get_class($firstElement);
        $modelType = FullyQualifiedName::make($fqcn)->getName();
        $nameCount = array();
        foreach ($model as $element) {
            $name = $element->getName();
            $nameCount[$name] = isset($nameCount[$name]) ? $nameCount[$name] + 1 : 1;
        }
        $messages = array();
        foreach ($nameCount as $name => $count) {
            if ($count > 1) {
                $messages[] = sprintf('Collection "%s" cannot have name "%s" duplicates (%s occurences)', $modelType, $name, $count);
            }
        }

        return (empty($messages) ? new NoneViolation() : new SomeViolation(implode("\n", $messages)));
    }
}
