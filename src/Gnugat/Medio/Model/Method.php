<?php

namespace Gnugat\Medio\Model;

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
    private $visibility;

    /**
     * @param ArgumentCollection $argumentCollection
     * @param string             $name
     * @param string             $visibility
     */
    public function __construct(ArgumentCollection $argumentCollection, $name, $visibility)
    {
        $this->argumentCollection = $argumentCollection;
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
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getVisibility()
    {
        return $this->visibility;
    }
}
