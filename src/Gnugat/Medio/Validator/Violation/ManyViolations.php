<?php

/*
 * This file is part of the Medio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gnugat\Medio\Validator\Violation;

use Gnugat\Medio\Validator\Violation;

class ManyViolations implements Violation
{
    /**
     * @var string
     */
    private $messages = array();

    /**
     * @param Violation $violation
     */
    public function add(Violation $violation)
    {
        if ($violation instanceof OneViolation) {
            $this->messages[] = $violation->getMessage();
        }
    }

    /**
     * @return Violation
     */
    public function get()
    {
        if (empty($this->messages)) {
            return new NoViolation();
        }
        if (1 === count($this->messages)) {
            return new OneViolation(current($this->messages));
        }

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getMessage()
    {
        return implode("\n", $this->messages);
    }
}
