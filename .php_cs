<?php

$fixers = [
    'braces',
    'elseif',
    'empty_return',
    'encoding',
    'eof_ending',
    'function_call_space',
    'function_declaration',
    'indentation',
    'line_after_namespace',
    'linefeed',
    'lowercase_constants',
    'lowercase_keywords',
    'method_argument_space',
    'multiline_spaces_before_semicolon',
    'multiple_use',
    'parenthesis',
    'short_array_syntax',
    'short_echo_tag',
    'short_tag',
    'single_line_after_imports',
    'trailing_spaces',
    'visibility',
];

return Symfony\CS\Config\Config::create()
    ->finder(Symfony\CS\Finder\DefaultFinder::create()->in(__DIR__))
    ->fixers($fixers)
    ->level(Symfony\CS\FixerInterface::SYMFONY_LEVEL)
    ->setUsingCache(true);
