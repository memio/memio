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

/**
 * @api
 */
class ImportCollection
{
    /**
     * @var array
     */
    private $imports = array();

    /**
     * @return ImportCollection
     *
     * @api
     */
    public static function make()
    {
        return new self();
    }

    /**
     * @param Import $import
     *
     * @return ImportCollection
     *
     * @api
     */
    public function add(Import $import)
    {
        $this->imports[] = $import;

        return $this;
    }

    /**
     * @return array
     */
    public function all()
    {
        return $this->imports;
    }
}
