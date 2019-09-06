<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitcef829870d425199aeaf65d945194cee
{
    public static $prefixLengthsPsr4 = array (
        'n' => 
        array (
            'ninenight\\Send\\' => 15,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'ninenight\\Send\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitcef829870d425199aeaf65d945194cee::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitcef829870d425199aeaf65d945194cee::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}