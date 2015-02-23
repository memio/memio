<?php

/*
 * This file is part of the Medio project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gnugat\Medio\TwigExtension;

use Gnugat\Medio\ValueObject\Collection as Col;
use Twig_Extension;
use Twig_SimpleFunction;

class Collection extends Twig_Extension
{
    /**
     * {@inheritDoc}
     */
    public function getFunctions()
    {
        return array(
            new Twig_SimpleFunction('make_collection', array($this, 'makeCollection')),
        );
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'collection';
    }

    /**
     * @param array $elements
     *
     * @return Collection
     */
    public function makeCollection(array $elements)
    {
        $type = 'Gnugat\\Medio\\Model\\Argument';
        if (!empty($elements)) {
            $element = current($elements);
            $type = get_class($element);
        }
        $collection = new Col($type);
        foreach ($elements as $element) {
            $collection->add($element);
        }

        return $collection;
    }
}
