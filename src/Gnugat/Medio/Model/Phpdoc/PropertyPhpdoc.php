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
     * @var PropertyTag
     */
    private $propertyTag;

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
     * @param PropertyTag $propertyTag
     *
     * @return PropertyPhpdoc
     *
     * @api
     */
    public function setPropertyTag(PropertyTag $propertyTag)
    {
        $this->propertyTag = $propertyTag;

        return $this;
    }

    /**
     * @return PropertyTag
     */
    public function getPropertyTag()
    {
        return $this->propertyTag;
    }

    /**
     * @return bool
     */
    public function isEmpty()
    {
        return (null === $this->propertyTag);
    }
}
