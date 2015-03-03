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

use Gnugat\Medio\Exception\DomainException;

/**
 * @api
 */
class Method
{
    /**
     * @var array
     */
    private $arguments = array();

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $visibility = 'public';

    /**
     * @var bool
     */
    private $isStatic = false;

    /**
     * @var bool
     */
    private $isAbstract = false;

    /**
     * @var bool
     */
    private $isFinal = false;

    /**
     * @var string
     */
    private $body = '';

    /**
     * @param string $name
     *
     * @api
     */
    public function __construct($name)
    {
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
        $this->arguments[] = $argument;

        return $this;
    }

    /**
     * @return array
     */
    public function allArguments()
    {
        return $this->arguments;
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
        if ($this->isAbstract()) {
            throw new DomainException("You can't declare abstract method as static: ".$this->getName());
        }
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

    /**
     * @param string $body
     *
     * @return Method
     *
     * @api
     */
    public function setBody($body)
    {
        if ($this->isAbstract()) {
            throw new DomainException("You can't set body to abstract method: ".$this->getName());
        }
        $this->body = $body;

        return $this;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @return $this
     *
     * @api
     */
    public function makeAbstract()
    {
        if ($this->isFinal()) {
            throw new DomainException("You can't declare final method as abstract: ".$this->getName());
        }
        if ($this->isStatic()) {
            throw new DomainException("You can't declare static method as abstract: ".$this->getName());
        }
        if ($this->getBody()) {
            throw new DomainException("Method contain body. You can't declare method as abstract: ".$this->getName());
        }
        $this->isAbstract = true;

        return $this;
    }

    /**
     * @return $this
     *
     * @api
     */
    public function removeAbstract()
    {
        $this->isAbstract = false;

        return $this;
    }

    /**
     * @return bool
     */
    public function isAbstract()
    {
        return $this->isAbstract;
    }

    /**
     * @return $this
     *
     * @api
     */
    public function makeFinal()
    {
        if ($this->isAbstract()) {
            throw new DomainException("You can't declare abstract method as final: ".$this->getName());
        }
        $this->isFinal = true;

        return $this;
    }

    /**
     * @return $this
     *
     * @api
     */
    public function removeFinal()
    {
        $this->isFinal = false;

        return $this;
    }

    /**
     * @return bool
     */
    public function isFinal()
    {
        return $this->isFinal;
    }
}
