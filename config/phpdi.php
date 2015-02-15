<?php

use DI\Container;

return array(
    'medio.templates' => __DIR__.'/../templates',

    'Twig_Loader_Filesystem' => DI\object()
        ->constructor(DI\link('medio.templates')),

    'Twig_Environment' => DI\factory(function (Container $c) {
        $twig = new Twig_Environment($c->get('Twig_Loader_Filesystem'));
        $twig->addExtension($c->get('Gnugat\\Medio\\TwigExtension\\Phpdoc'));
        $twig->addExtension($c->get('Gnugat\\Medio\\TwigExtension\\Whitespace'));

        return $twig;
    }),
);
