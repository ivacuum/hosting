<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;

return RectorConfig::configure()
    ->withPreparedSets(deadCode: true)
    ->withAttributesSets(phpunit: true)
    ->withPhpSets()
    ->withSets([
        Rector\PHPUnit\Set\PHPUnitSetList::PHPUNIT_110,
        Rector\PHPUnit\Set\PHPUnitSetList::PHPUNIT_CODE_QUALITY,
    ])
    ->withPaths([
        __DIR__ . '/app',
        __DIR__ . '/tests',
    ])
    ->withSkip([
        Rector\PHPUnit\CodeQuality\Rector\ClassMethod\AddInstanceofAssertForNullableInstanceRector::class,
        Rector\PHPUnit\CodeQuality\Rector\MethodCall\AssertEmptyNullableObjectToAssertInstanceofRector::class,
        Rector\PHPUnit\CodeQuality\Rector\StmtsAwareInterface\DeclareStrictTypesTestsRector::class,
        Rector\Privatization\Rector\Class_\FinalizeTestCaseClassRector::class,
        Rector\Php55\Rector\String_\StringClassNameToClassConstantRector::class,
        Rector\Php74\Rector\Closure\ClosureToArrowFunctionRector::class,
        // Ложные срабатывания на контроллерах
        Rector\Php81\Rector\Array_\ArrayToFirstClassCallableRector::class,
        Rector\Php81\Rector\Property\ReadOnlyPropertyRector::class,
        Rector\Php81\Rector\FuncCall\NullToStrictStringFuncCallArgRector::class,
    ]);
