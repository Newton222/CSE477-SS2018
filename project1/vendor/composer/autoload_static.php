<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit5c3883008139e4c24de9134267758ee4
{
    public static $prefixLengthsPsr4 = array (
        'E' => 
        array (
            'Enigma\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Enigma\\' => 
        array (
            0 => __DIR__ . '/../..' . '/lib/Enigma',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit5c3883008139e4c24de9134267758ee4::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit5c3883008139e4c24de9134267758ee4::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
