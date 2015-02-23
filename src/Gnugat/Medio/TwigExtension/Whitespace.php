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
use Gnugat\Medio\Model\Contract;
use Gnugat\Medio\Model\File;
use Gnugat\Medio\Model\Object;
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
     * @param mixed  $model
     * @param string $block
     *
     * @return bool
     *
     * @throws InvalidArgumentException If given $model is not supported
     * @throws InvalidArgumentException If given $bock is not supported
     */
    public function needsLineAfter($model, $block)
    {
        if ($model instanceof Contract) {
            return $this->forContract($model, $block);
        }
        if ($model instanceof File) {
            return $this->forFile($model, $block);
        }
        if ($model instanceof Object) {
            return $this->forObject($model, $block);
        }

        throw new InvalidArgumentException('The function needs_line_after does not support given "'.get_class($model).'"');
    }

   /**
     * @param Contract $contract
     * @param string   $block
     *
     * @return bool
     *
     * @throws InvalidArgumentException If given $bock is not supported
     */
    private function forContract(Contract $contract, $block)
    {
        $constants = $contract->allConstants()->all();
        $methods = $contract->allMethods()->all();
        if ('constants' === $block) {
            return (!empty($constants) && !empty($methods));
        }

        throw new InvalidArgumentException('The function needs_line_after does not support given "'.$block.'"');
    }

    /**
     * @param File   $file
     * @param string $block
     *
     * @return bool
     *
     * @throws InvalidArgumentException If given $bock is not supported
     */
    private function forFile($file, $block)
    {
        $imports = $file->getImportCollection()->all();
        $constants = $file->getConstantCollection()->all();
        $properties = $file->getPropertyCollection()->all();
        $methods = $file->getMethodCollection()->all();
        if ('imports' === $block) {
            return !empty($imports);
        }
        if ('constants' === $block) {
            return (!empty($constants) && (!empty($properties) || !empty($methods)));
        }
        if ('properties' === $block) {
            return (!empty($properties) && !empty($methods));
        }

        throw new InvalidArgumentException('The function needs_line_after does not support given "'.$block.'"');
    }

    /**
     * @param Object $object
     * @param string $block
     *
     * @return bool
     *
     * @throws InvalidArgumentException If given $bock is not supported
     */
    private function forObject($object, $block)
    {
        $constants = $object->allConstants()->all();
        $properties = $object->allProperties()->all();
        $methods = $object->allMethods()->all();
        if ('constants' === $block) {
            return (!empty($constants) && (!empty($properties) || !empty($methods)));
        }
        if ('properties' === $block) {
            return (!empty($properties) && !empty($methods));
        }

        throw new InvalidArgumentException('The function needs_line_after does not support given "'.$block.'"');
    }
}
