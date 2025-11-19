<?php


use Rector\Config\RectorConfig;
use Rector\Php55\Rector\String_\StringClassNameToClassConstantRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->importNames(false, false);
    $rectorConfig->importShortClasses(false);

    // Limit rules applied to PHP 8.3 and earlier
    $rectorConfig->phpVersion(\Rector\ValueObject\PhpVersion::PHP_83);

    // Paths to process
    $rectorConfig->paths([
        //__DIR__ . '/libraries/src',
        //__DIR__ . '/libraries/src/MVC',
        //__DIR__ . '/libraries/src/Captcha',
        //__DIR__ . '/libraries/src/Extension',
        //__DIR__ . '/libraries/src/Plugin',
        //__DIR__ . '/plugins',
        //__DIR__ . '/administrator/components',
        __DIR__ . '/components',
    ]);

    $rectorConfig->skip([
        //__DIR__ . '/libraries/src/MVC',
        //__DIR__ . '/libraries/src/Captcha',
        //__DIR__ . '/libraries/src/Extension',
        //__DIR__ . '/libraries/src/Plugin',
        //__DIR__ . '/libraries/src/Plugin/CMSPlugin.php',
        //__DIR__ . '/administrator/components/*/tmpl',
        __DIR__ . '/components/*/tmpl',
    ]);

    //$rectorConfig->rule(StringClassNameToClassConstantRector::class);
    $rectorConfig->rule(\Rector\Php55\Rector\FuncCall\GetCalledClassToStaticClassRector::class);
};
