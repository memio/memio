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

use Gnugat\Medio\ValueObject\Collection;

/**
 * @api
 */
class Method
{
    /**
     * @var Collection
     */
    private $arguments;

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
        $this->arguments = new Collection('Gnugat\\Medio\\Model\\Argument');
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
        $this->arguments->add($argument);

        return $this;
    }

    /**
     * @return array
     */
    public function allArguments()
    {
        return $this->arguments->all();
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

    /**
     * @param string $body
     *
     * @return Method
     *
     * @api
     */
    public function setBody($body)
    {
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
}
