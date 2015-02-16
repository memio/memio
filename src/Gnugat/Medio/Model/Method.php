<?php

/*
 * This file is part of the Medio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gnugat\Medio\Model;

/**
 * @api
 */
class Method
{
    /**
     * @var ArgumentCollection
     */
    private $argumentCollection;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $visibility = 'public';

    private $isStatic = false;

    /**
     * @param string $name
     *
     * @api
     */
    public function __construct($name)
    {
        $this->argumentCollection = new ArgumentCollection();
        $this->name = $name;
    }

    /**
     * @param string $name
     *
     * @return Method
     *
     * @api
     */
    public static function make($name)
    {
        return new self($name);
    }

    /**
     * @param Argument $argument
     *
     * @return Method
     *
     * @api
     */
    public function addArgument(Argument $argument)
    {
        $this->argumentCollection->add($argument);

        return $this;
    }

    /**
     * @return ArgumentCollection
     */
    public function getArgumentCollection()
    {
        return $this->argumentCollection;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return Method
     *
     * @api
     */
    public function makePrivate()
    {
        $this->visibility = 'private';

        return $this;
    }

    /**
     * @return Method
     *
     * @api
     */
    public function makeProtected()
    {
        $this->visibility = 'protected';

        return $this;
    }

    /**
     * @return Method
     *
     * @api
     */
    public function removeVisibility()
    {
        $this->visibility = '';

        return $this;
    }

    /**
     * @return Method
     *
     * @api
     */
    public function makePublic()
    {
        $this->visibility = 'public';

        return $this;
    }

    /**
     * @return string
     */
    public function getVisibility()
    {
        return $this->visibility;
    }

    /**
     * @return bool
     */
    public function isStatic()
    {
        return $this->isStatic;
    }

    /**
     * @return Method
     *
     * @api
     */
    public function makeStatic()
    {
        $this->isStatic = true;

        return $this;
    }

    /**
     * @return Method
     *
     * @api
     */
    public function removeStatic()
    {
        $this->isStatic = false;
    }
}
