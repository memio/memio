<?php

/*
 * This file is part of the Memio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Memio\Memio\Model\Phpdoc;

use Memio\Memio\ValueObject\Type;

class VariableTag
{
    /**
     * @var Type
     */
    private $type;

    /**
     * @param string $type
     *
     * @api
     */
    public function __construct($type)
    {
        $this->type = new Type($type);
    }

    /**
     * @param string $type
     *
     * @return PropertyTag
     *
     * @api
     */
    public static function make($type)
    {
        return new self($type);
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type->getName();
    }
}
