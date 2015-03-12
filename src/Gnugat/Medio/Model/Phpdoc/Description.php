<?php

/*
 * This file is part of the Medio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gnugat\Medio\Model\Phpdoc;

class Description
{
    /**
     * @var array
     */
    private $description = array();

    /**
     * @param string $line
     *
     * @api
     */
    public function __construct($line)
    {
        $this->description[] = $line;
    }

    /**
     * @param string $line
     *
     * @return Description
     *
     * @api
     */
    public static function make($line)
    {
        return new self($line);
    }

    /**
     * @return Description
     *
     * @api
     */
    public function addEmptyLine()
    {
        $this->description[] = '';

        return $this;
    }


    /**
     * @param string $line
     *
     * @return Description
     *
     * @api
     */
    public function addLine($line)
    {
        $this->description[] = $line;

        return $this;
    }

    /**
     * @return array
     */
    public function all()
    {
        return $this->description;
    }
}
