<?php

namespace Gnugat\Medio\Model;

use Gnugat\Medio\Exception\InvalidArgumentException;

class Visibility
{
    const PUBLIC_ = 'public';

    /**
     * @var string
     */
    private $visibility;

    /**
     * @param string $visibility
     *
     * @throws InvalidArgumentException If the given visibility is not allowed
     */
    public function __construct($visibility)
    {
        $allowedVisibilities = array('private', 'public', 'protected', '');
        if (!in_array($visibility, $allowedVisibilities, true)) {
            throw new InvalidArgumentException("Visibility $visibility is not allowed");
        }
        $this->visibility = $visibility;
    }
}
