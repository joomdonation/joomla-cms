<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\ValueObject\PhpVersion;

return RectorConfig::configure()
    ->withPhpVersion(PhpVersion::PHP_81)
    ->withImportNames(true, false, false, true)
    ->withBootstrapFiles([
        __DIR__ . '/build/phpstan/joomla-bootstrap.php',
    ])
    ->withPaths([
        //__DIR__ . '/administrator/components',
        __DIR__ . '/administrator/modules',
        //__DIR__ . '/administrator/templates',
        //__DIR__ . '/components',
        __DIR__ . '/modules',
        //__DIR__ . '/libraries/src/MVC',
        //__DIR__ . '/libraries/src',
        __DIR__ . '/plugins',
    ])
    ->withFileExtensions(['php'])
    ->withSkip(
        [
            '*/tmpl/*',
            '*/layouts/*',
            //'*/View/*',
            //__DIR__.'/libraries/src/MVC',
        ]
    )
    ->withRules([
        \Rector\Php80\Rector\Identical\StrStartsWithRector::class,
        \Rector\Php80\Rector\Identical\StrEndsWithRector::class,
        \Rector\Php80\Rector\NotIdentical\StrContainsRector::class,
        \Rector\Php80\Rector\Catch_\RemoveUnusedVariableInCatchRector::class,
        \Rector\Php53\Rector\Ternary\TernaryToElvisRector::class,
        \Rector\Php74\Rector\Assign\NullCoalescingOperatorRector::class,
        \Rector\Php70\Rector\Ternary\TernaryToNullCoalescingRector::class,
        \Rector\Php70\Rector\StmtsAwareInterface\IfIssetToCoalescingRector::class,
        \Rector\Php71\Rector\List_\ListToArrayDestructRector::class,
    ])
    // Potential rules
    ->withRules([
        \Rector\CodeQuality\Rector\FunctionLike\SimplifyUselessVariableRector::class,
        \Rector\DeadCode\Rector\Assign\RemoveUnusedVariableAssignRector::class,
    ])
    // Code styles rule
    ->withRules([
        \Rector\Php55\Rector\String_\StringClassNameToClassConstantRector::class,
    ])
    // Potential code quality rules
    ->withRules([
        \Rector\CodingStyle\Rector\FuncCall\CountArrayToEmptyArrayComparisonRector::class, // Performance improvement
        \Rector\CodeQuality\Rector\FuncCall\ArrayMergeOfNonArraysToSimpleArrayRector::class,
        \Rector\CodeQuality\Rector\FuncCall\ChangeArrayPushToArrayAssignRector::class,
        \Rector\CodeQuality\Rector\BooleanAnd\SimplifyEmptyArrayCheckRector::class,
        \Rector\CodeQuality\Rector\Assign\CombinedAssignRector::class,
        \Rector\CodeQuality\Rector\For_\ForRepeatedCountToOwnVariableRector::class,
        \Rector\CodeQuality\Rector\Empty_\SimplifyEmptyCheckOnEmptyArrayRector::class,
        \Rector\CodeQuality\Rector\Identical\SimplifyConditionsRector::class,
        \Rector\CodeQuality\Rector\Identical\BooleanNotIdenticalToNotIdenticalRector::class,
        \Rector\CodeQuality\Rector\Identical\StrlenZeroToIdenticalEmptyStringRector::class,
        \Rector\CodeQuality\Rector\Identical\SimplifyBoolIdenticalTrueRector::class,
        \Rector\CodeQuality\Rector\Ternary\ArrayKeyExistsTernaryThenValueToCoalescingRector::class,
        \Rector\CodeQuality\Rector\Ternary\UnnecessaryTernaryExpressionRector::class,
        \Rector\CodeQuality\Rector\Ternary\TernaryEmptyArrayArrayDimFetchToCoalesceRector::class,
        \Rector\CodeQuality\Rector\Concat\JoinStringConcatRector::class,
        \Rector\CodeQuality\Rector\If_\ExplicitBoolCompareRector::class,
        \Rector\CodeQuality\Rector\If_\SimplifyIfNullableReturnRector::class,
        \Rector\CodeQuality\Rector\If_\SimplifyIfNotNullReturnRector::class,
        \Rector\CodeQuality\Rector\If_\SimplifyIfReturnBoolRector::class,
        \Rector\CodeQuality\Rector\If_\ShortenElseIfRector::class,
        \Rector\CodeQuality\Rector\Foreach_\ForeachToInArrayRector::class,
        \Rector\CodeQuality\Rector\Foreach_\SimplifyForeachToCoalescingRector::class,

    ])
    // Blow are the optional rules which we might run and explode in the future
    ->withRules([
            \Rector\CodeQuality\Rector\Class_\CompleteDynamicPropertiesRector::class,
            \Rector\DeadCode\Rector\Foreach_\RemoveUnusedForeachKeyRector::class,
            \Rector\CodingStyle\Rector\String_\UseClassKeywordForClassNameResolutionRector::class,
            \Rector\DeadCode\Rector\Stmt\RemoveUnreachableStatementRector::class,
            \Rector\CodeQuality\Rector\Concat\JoinStringConcatRector::class,
            \Rector\CodeQuality\Rector\If_\CombineIfRector::class,
            \Rector\CodeQuality\Rector\If_\SimplifyIfElseToTernaryRector::class,
        ]
    );