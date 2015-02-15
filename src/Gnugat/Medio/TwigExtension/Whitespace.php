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

use Gnugat\Medio\Exception\InvalidArgumentException;
use Gnugat\Medio\Model\File;
use Twig_Extension;
use Twig_SimpleFunction;

class Whitespace extends Twig_Extension
{
    /**
     * {@inheritDoc}
     */
    public function getFunctions()
    {
        return array(
            new Twig_SimpleFunction('needs_line_after', array($this, 'needsLineAfter')),
        );
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'whitespace';
    }

    /**
     * @param File   $file
     * @param string $block
     *
     * @return bool
     *
     * @throws InvalidArgumentException If given $bock is not supported
     */
    public function needsLineAfter(File $file, $block)
    {
        $constants = $file->getConstantCollection()->all();
        $properties = $file->getPropertyCollection()->all();
        $methods = $file->getMethodCollection()->all();
        if ('constants' === $block) {
            return (!empty($constants) && (!empty($properties) || !empty($methods)));
        }
        if ('properties' === $block) {
            return (!empty($properties) && !empty($methods));
        }

        throw new InvalidArgumentException('The function needs_line_after does not support given "'.$block.'"');
    }
}
