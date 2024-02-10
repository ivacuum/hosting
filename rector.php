<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;

return RectorConfig::configure()
    ->withPreparedSets(deadCode: true)
    ->withAttributesSets(phpunit: true)
    ->withPhpSets()
    ->withSets([
        Rector\PHPUnit\Set\PHPUnitSetList::PHPUNIT_100,
        Rector\PHPUnit\Set\PHPUnitSetList::PHPUNIT_CODE_QUALITY,
    ])
    ->withPaths([
        __DIR__ . '/app',
        __DIR__ . '/tests',
    ])
    ->withSkip([
        Rector\Php55\Rector\String_\StringClassNameToClassConstantRector::class,
        Rector\Php74\Rector\Closure\ClosureToArrowFunctionRector::class,
        Rector\Php74\Rector\LNumber\AddLiteralSeparatorToNumberRector::class,
        Rector\Php81\Rector\Property\ReadOnlyPropertyRector::class,
        Rector\Php81\Rector\ClassConst\FinalizePublicClassConstantRector::class,
        Rector\Php81\Rector\FuncCall\NullToStrictStringFuncCallArgRector::class,
        Rector\Php81\Rector\Array_\FirstClassCallableRector::class,
    ]);
