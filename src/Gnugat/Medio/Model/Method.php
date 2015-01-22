<?php

namespace Gnugat\Medio\Model;

class Method
{
    /**
     * @var ArgumentCollection
     */
    private $argumentCollection;

    /**
     * @var Body
     */
    private $body;

    /**
     * @var string
     */
    private $name;

    /**
     * @var Visibility
     */
    private $visibility;

    /**
     * @param ArgumentCollection $argumentCollection
     * @param Body               $body
     * @param string             $name
     * @param Visibility         $visibility
     */
    public function __construct(ArgumentCollection $argumentCollection, Body $body, $name, Visibility $visibility)
    {
        $this->argumentCollection = $argumentCollection;
        $this->body = $body;
        $this->name = $name;
        $this->visibility = $visibility;
    }

    /**
     * @return ArgumentCollection
     */
    public function getArgumentCollection()
    {
        return $this->argumentCollection;
    }

    /**
     * @return Body
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param Visibility $visibility
     *
     * @return bool
     */
    public function getVisibility()
    {
        return $this->visibility;
    }
}
