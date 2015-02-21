<?php

/*
 * This file is part of the Medio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gnugat\Medio\ValueObject;

/**
 * @api
 */
class Collection
{
    /**
     * @var array
     */
    private $elements = array();

    /**
     * @var string
     */
    private $type;

    /**
     * @param string $type
     *
     * @api
     */
    public function __construct($type)
    {
        $this->type = $type;
    }

    /**
     * @param string $type
     *
     * @return Collection
     *
     * @api
     */
    public static function make($type)
    {
        return new self($type);
    }

    /**
     * @param mixed $element
     *
     * @return Collection
     *
     * @api
     */
    public function add($element)
    {
        $this->elements[] = $element;

        return $this;
    }

    public function isEmtpy()
    {
        return empty($this->elements);
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return array
     */
    public function all()
    {
        return $this->elements;
    }
}
