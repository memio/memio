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

/**
 * @api
 */
class PropertyPhpdoc
{
    /**
     * @var VariableTag
     */
    private $variableTag;

    /**
     * @return PropertyPhpdoc
     *
     * @api
     */
    public static function make()
    {
        return new self();
    }

    /**
     * @param VariableTag $variableTag
     *
     * @return PropertyPhpdoc
     *
     * @api
     */
    public function setVariableTag(VariableTag $variableTag)
    {
        $this->variableTag = $variableTag;

        return $this;
    }

    /**
     * @return VariableTag
     */
    public function getVariableTag()
    {
        return $this->variableTag;
    }

    /**
     * @return bool
     */
    public function isEmpty()
    {
        return (null === $this->variableTag);
    }
}
