<?php

declare(strict_types=1);

use Rector\CodeQuality\Rector\ClassMethod\LocallyCalledStaticMethodToNonStaticRector;
use Rector\CodeQuality\Rector\Identical\FlipTypeControlToUseExclusiveTypeRector;
use Rector\CodeQuality\Rector\If_\ExplicitBoolCompareRector;
use Rector\Config\RectorConfig;
use Rector\Php81\Rector\ClassMethod\NewInInitializerRector;
use Rector\Php81\Rector\Property\ReadOnlyPropertyRector;
use Rector\Php83\Rector\ClassMethod\AddOverrideAttributeToOverriddenMethodsRector;
use Rector\PHPUnit\Set\PHPUnitSetList;
use Rector\Strict\Rector\Empty_\DisallowedEmptyRuleFixerRector;
use Rector\ValueObject\PhpVersion;
use Rector\Set\ValueObject\SetList;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->phpVersion(PhpVersion::PHP_83);

    $rectorConfig->paths([
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ]);

    $rectorConfig->sets([
        SetList::PHP_81,
        SetList::CODE_QUALITY,
        PHPUnitSetList::PHPUNIT_100,
    ]);
    $rectorConfig->rule(AddOverrideAttributeToOverriddenMethodsRector::class);
    $rectorConfig->skip([
        FlipTypeControlToUseExclusiveTypeRector::class,
        NewInInitializerRector::class => [
            __DIR__ . '/src/SDK/Trace/Sampler/ParentBased.php',
        ],
        ReadOnlyPropertyRector::class => [
            __DIR__ . '/src/SDK/Metrics/Stream/SynchronousMetricStream.php',
            __DIR__ . '/tests/Unit/Extension/Propagator',
        ],
        DisallowedEmptyRuleFixerRector::class,
        ExplicitBoolCompareRector::class,
        LocallyCalledStaticMethodToNonStaticRector::class,
    ]);
};
