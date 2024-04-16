<?php

$finder = (new PhpCsFixer\Finder())
    ->in(__DIR__.'/src')
    ->append([
        __DIR__.'/.php-cs-fixer.dist.php',
        __DIR__.'/rector.php',
    ])
    ->exclude([
        'var',
        'src/OpenApiBundle',
    ])
;

return (new PhpCsFixer\Config())
    ->setRules([
        '@Symfony' => true,
    ])
    ->setFinder($finder)
;
