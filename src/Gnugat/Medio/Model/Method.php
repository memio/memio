<?php

namespace Gnugat\Medio\Model;

class Method
{
    /**
     * @var array
     */
    private $arguments;

    /**
     * @var Body
     */
    private $body;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $visibility;

    /**
     * @param array  $arguments
     * @param Body   $body
     * @param string $name
     * @param string $visibility
     */
    public function __construct(array $arguments, Body $body, $name, $visibility = Visibility::PUBLIC_)
    {
        $this->arguments = $arguments;
        $this->body = $body;
        $this->name = $name;
        $this->visibility = $visibility;
    }

    /**
     * @return array
     */
    public function getArguments()
    {
        return $this->arguments;
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
     * @param string $visibility
     *
     * @return bool
     */
    public function hasVisibility($visibility)
    {
        return ($this->visibility === $visibility);
    }
}
