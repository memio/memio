<?php

namespace Gnugat\Medio;

interface Editor
{
    /**
     * @param string $filename
     *
     * @return File
     */
    public function open($filename);

    /**
     * @param File $file
     */
    public function save(File $file);

    /**
     * @param File   $file
     * @param string $fullyQualifiedClassname
     */
    public function addUse(File $file, $fullyQualifiedClassname);

    /**
     * @param File   $file
     * @param string $className
     * @param string $variableName
     */
    public function addProperty(File $file, $className, $variableName);

    /**
     * @param File   $file
     * @param string $className
     * @param string $variableName
     */
    public function addDependency(File $file, $className, $variableName);

        /**
     * @param File   $file
     * @param string $className
     * @param string $variableName
     */
    public function addDependencyMock(File $file, $className, $variableName);
}
