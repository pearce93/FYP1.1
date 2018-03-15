<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitac3d69c3b6395e86a7ad8ee0d3d1aec5
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Stripe\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Stripe\\' => 
        array (
            0 => __DIR__ . '/..' . '/stripe/stripe-php/lib',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitac3d69c3b6395e86a7ad8ee0d3d1aec5::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitac3d69c3b6395e86a7ad8ee0d3d1aec5::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
