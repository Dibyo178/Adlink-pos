<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita73eb94b00c90433560237d7d4934f6a
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Picqer\\Barcode\\' => 15,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Picqer\\Barcode\\' => 
        array (
            0 => __DIR__ . '/..' . '/picqer/php-barcode-generator/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInita73eb94b00c90433560237d7d4934f6a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInita73eb94b00c90433560237d7d4934f6a::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInita73eb94b00c90433560237d7d4934f6a::$classMap;

        }, null, ClassLoader::class);
    }
}