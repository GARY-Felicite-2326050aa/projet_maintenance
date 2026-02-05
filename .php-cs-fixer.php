<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__.'/src')
    ->in(__DIR__.'/tests');

return (new PhpCsFixer\Config())
    ->setRules([
        '@PSR12' => true,
//        'strict_param' => true,
//        'array_syntax' => ['syntax' => 'short'],
        '@Symfony' => true,
    ])
    ->setFinder($finder);
