<?php

namespace Gnugat\Medio\Model;

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
