<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit74b7f00564e6e92418202882d528c835
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'MercadoPago\\' => 12,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'MercadoPago\\' => 
        array (
            0 => __DIR__ . '/..' . '/mercadopago/dx-php/src/MercadoPago',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit74b7f00564e6e92418202882d528c835::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit74b7f00564e6e92418202882d528c835::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit74b7f00564e6e92418202882d528c835::$classMap;

        }, null, ClassLoader::class);
    }
}
