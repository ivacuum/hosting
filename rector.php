<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->sets([
        Rector\Set\ValueObject\SetList::DEAD_CODE,
        Rector\Set\ValueObject\LevelSetList::UP_TO_PHP_82,
        // Rector\Laravel\Set\LaravelSetList::LARAVEL_90,
        Rector\PHPUnit\Set\PHPUnitLevelSetList::UP_TO_PHPUNIT_100,
    ]);

    $rectorConfig->skip([
        Rector\Php55\Rector\String_\StringClassNameToClassConstantRector::class,
        Rector\Php74\Rector\Closure\ClosureToArrowFunctionRector::class,
        Rector\Php74\Rector\LNumber\AddLiteralSeparatorToNumberRector::class,
        Rector\Php81\Rector\Property\ReadOnlyPropertyRector::class,
        Rector\Php81\Rector\ClassConst\FinalizePublicClassConstantRector::class,
        Rector\Php81\Rector\FuncCall\NullToStrictStringFuncCallArgRector::class,
        Rector\Php81\Rector\Array_\FirstClassCallableRector::class,
    ]);
};
