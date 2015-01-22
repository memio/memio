<?php

namespace Gnugat\Medio\Model;

class ArgumentCollection
{
    /**
     * @var array
     */
    private $arguments;

    /**
     * @param array $arguments
     */
    public function __construct(array $arguments)
    {
        $this->arguments = $arguments;
    }

    /**
     * @return array
     */
    public function getArguments()
    {
        return $this->arguments;
    }

    /**
     * @param Argument $argument
     */
    public function add(Argument $argument)
    {
        $this->arguments[] = $argument;
    }
}
