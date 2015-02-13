<?php

return array(
    'medio.templates' => __DIR__.'/../templates',

    'Twig_Loader_Filesystem' => DI\Object()
        ->constructor(DI\link('medio.templates')),

    'Twig_Environment' => DI\Object()
        ->constructor(DI\link('Twig_Loader_Filesystem'))
        ->method('addExtension', DI\Link('Gnugat\\Medio\\TwigExtension\\Phpdoc')),
);
