<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb9752f6220adeabbece5cc8758cb1230
{
    public static $files = array (
        'c964ee0ededf28c96ebd9db5099ef910' => __DIR__ . '/..' . '/guzzlehttp/promises/src/functions_include.php',
        'a0edc8309cc5e1d60e3047b5df6b7052' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/functions_include.php',
        '37a3dc5111fe8f707ab4c132ef1dbc62' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/functions_include.php',
    );

    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Psr\\Http\\Message\\' => 17,
        ),
        'G' => 
        array (
            'GuzzleHttp\\Psr7\\' => 16,
            'GuzzleHttp\\Promise\\' => 19,
            'GuzzleHttp\\' => 11,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Psr\\Http\\Message\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/http-message/src',
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
    );

    public static $classMap = array (
        'Plivo\\Conference' => __DIR__ . '/..' . '/plivo/plivo-php/plivo.php',
        'Plivo\\DTMF' => __DIR__ . '/..' . '/plivo/plivo-php/plivo.php',
        'Plivo\\Dial' => __DIR__ . '/..' . '/plivo/plivo-php/plivo.php',
        'Plivo\\Element' => __DIR__ . '/..' . '/plivo/plivo-php/plivo.php',
        'Plivo\\GetDigits' => __DIR__ . '/..' . '/plivo/plivo-php/plivo.php',
        'Plivo\\Hangup' => __DIR__ . '/..' . '/plivo/plivo-php/plivo.php',
        'Plivo\\Message' => __DIR__ . '/..' . '/plivo/plivo-php/plivo.php',
        'Plivo\\Number' => __DIR__ . '/..' . '/plivo/plivo-php/plivo.php',
        'Plivo\\Play' => __DIR__ . '/..' . '/plivo/plivo-php/plivo.php',
        'Plivo\\PlivoError' => __DIR__ . '/..' . '/plivo/plivo-php/plivo.php',
        'Plivo\\PreAnswer' => __DIR__ . '/..' . '/plivo/plivo-php/plivo.php',
        'Plivo\\Record' => __DIR__ . '/..' . '/plivo/plivo-php/plivo.php',
        'Plivo\\Redirect' => __DIR__ . '/..' . '/plivo/plivo-php/plivo.php',
        'Plivo\\Response' => __DIR__ . '/..' . '/plivo/plivo-php/plivo.php',
        'Plivo\\RestAPI' => __DIR__ . '/..' . '/plivo/plivo-php/plivo.php',
        'Plivo\\Speak' => __DIR__ . '/..' . '/plivo/plivo-php/plivo.php',
        'Plivo\\User' => __DIR__ . '/..' . '/plivo/plivo-php/plivo.php',
        'Plivo\\Wait' => __DIR__ . '/..' . '/plivo/plivo-php/plivo.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitb9752f6220adeabbece5cc8758cb1230::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb9752f6220adeabbece5cc8758cb1230::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitb9752f6220adeabbece5cc8758cb1230::$classMap;

        }, null, ClassLoader::class);
    }
}
