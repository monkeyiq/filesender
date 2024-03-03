<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit278b8b2a471333aff04b3f0c8233c3f3
{
    public static $files = array (
        '7b11c4dc42b3b3023073cb14e519683c' => __DIR__ . '/..' . '/ralouphie/getallheaders/src/getallheaders.php',
        '6e3fae29631ef280660b3cdad06f25a8' => __DIR__ . '/..' . '/symfony/deprecation-contracts/function.php',
        '37a3dc5111fe8f707ab4c132ef1dbc62' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/functions_include.php',
        'e39a8b23c42d4e1452234d762b03835a' => __DIR__ . '/..' . '/ramsey/uuid/src/functions.php',
    );

    public static $prefixLengthsPsr4 = array (
        'Z' => 
        array (
            'ZipStream\\' => 10,
        ),
        'R' => 
        array (
            'Ramsey\\Uuid\\' => 12,
            'Ramsey\\Collection\\' => 18,
        ),
        'P' => 
        array (
            'Psr\\Http\\Message\\' => 17,
            'Psr\\Http\\Client\\' => 16,
        ),
        'M' => 
        array (
            'MyCLabs\\Enum\\' => 13,
        ),
        'G' => 
        array (
            'GuzzleHttp\\Psr7\\' => 16,
            'GuzzleHttp\\Promise\\' => 19,
            'GuzzleHttp\\' => 11,
        ),
        'B' => 
        array (
            'Brick\\Math\\' => 11,
            'Barracuda\\ArchiveStream\\' => 24,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'ZipStream\\' => 
        array (
            0 => __DIR__ . '/..' . '/maennchen/zipstream-php/src',
        ),
        'Ramsey\\Uuid\\' => 
        array (
            0 => __DIR__ . '/..' . '/ramsey/uuid/src',
        ),
        'Ramsey\\Collection\\' => 
        array (
            0 => __DIR__ . '/..' . '/ramsey/collection/src',
        ),
        'Psr\\Http\\Message\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/http-factory/src',
            1 => __DIR__ . '/..' . '/psr/http-message/src',
        ),
        'Psr\\Http\\Client\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/http-client/src',
        ),
        'MyCLabs\\Enum\\' => 
        array (
            0 => __DIR__ . '/..' . '/myclabs/php-enum/src',
        ),
        'GuzzleHttp\\Psr7\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/psr7/src',
        ),
        'GuzzleHttp\\Promise\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/promises/src',
        ),
        'GuzzleHttp\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/guzzle/src',
        ),
        'Brick\\Math\\' => 
        array (
            0 => __DIR__ . '/..' . '/brick/math/src',
        ),
        'Barracuda\\ArchiveStream\\' => 
        array (
            0 => __DIR__ . '/..' . '/barracudanetworks/archivestream-php/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'LoggerInterface' => __DIR__ . '/..' . '/owasp/csrf-protector-php/libs/csrf/LoggerInterface.php',
        'Stringable' => __DIR__ . '/..' . '/myclabs/php-enum/stubs/Stringable.php',
        'alreadyInitializedException' => __DIR__ . '/..' . '/owasp/csrf-protector-php/libs/csrf/csrfprotector.php',
        'baseJSFileNotFoundExceptio' => __DIR__ . '/..' . '/owasp/csrf-protector-php/libs/csrf/csrfprotector.php',
        'configFileNotFoundException' => __DIR__ . '/..' . '/owasp/csrf-protector-php/libs/csrf/csrfprotector.php',
        'csrfProtector' => __DIR__ . '/..' . '/owasp/csrf-protector-php/libs/csrf/csrfprotector.php',
        'csrfpAction' => __DIR__ . '/..' . '/owasp/csrf-protector-php/libs/csrf/csrfpAction.php',
        'csrfpCookieConfig' => __DIR__ . '/..' . '/owasp/csrf-protector-php/libs/csrf/csrfpCookieConfig.php',
        'csrfpDefaultLogger' => __DIR__ . '/..' . '/owasp/csrf-protector-php/libs/csrf/csrfpDefaultLogger.php',
        'incompleteConfigurationException' => __DIR__ . '/..' . '/owasp/csrf-protector-php/libs/csrf/csrfprotector.php',
        'jsFileNotFoundException' => __DIR__ . '/..' . '/owasp/csrf-protector-php/libs/csrf/csrfprotector.php',
        'logDirectoryNotFoundException' => __DIR__ . '/..' . '/owasp/csrf-protector-php/libs/csrf/csrfpDefaultLogger.php',
        'logFileWriteError' => __DIR__ . '/..' . '/owasp/csrf-protector-php/libs/csrf/csrfpDefaultLogger.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit278b8b2a471333aff04b3f0c8233c3f3::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit278b8b2a471333aff04b3f0c8233c3f3::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit278b8b2a471333aff04b3f0c8233c3f3::$classMap;

        }, null, ClassLoader::class);
    }
}
