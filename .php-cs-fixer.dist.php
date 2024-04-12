<?php

$finder = (new PhpCsFixer\Finder())
    ->in(__DIR__.'/src')
    ->exclude([
        'var',
        'App\OpenApiBundle'
    ])
;

return (new PhpCsFixer\Config())
    ->setRules([
        '@Symfony' => true,
    ])
    ->setFinder($finder)
;
