<?php

namespace Gnugat\Medio\Php;

class Body
{
    /**
     * @var array
     */
    private $lines;

    /**
     * @param array $lines
     */
    public function __construct(array $lines)
    {
        $this->lines = $lines;
    }

    /**
     * @return array
     */
    public function getLines()
    {
        return $this->lines;
    }
}
