<?php

namespace Gnugat\Medio;

class Convertor
{
    /**
     * @param string $fullyQualifiedClassname
     *
     * @return string
     */
    public function toClassName($fullyQualifiedClassname)
    {
        $parts = explode('\\', $fullyQualifiedClassname);

        return end($parts);
    }

    /**
     * @param string $className
     *
     * @return string
     */
    public function toVariableName($className)
    {
        $className[0] = strtolower($className[0]);

        return $className;
    }
}
