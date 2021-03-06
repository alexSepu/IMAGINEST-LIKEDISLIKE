<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitae367bc3993ea2144d104011a52c223f
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitae367bc3993ea2144d104011a52c223f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitae367bc3993ea2144d104011a52c223f::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitae367bc3993ea2144d104011a52c223f::$classMap;

        }, null, ClassLoader::class);
    }
}
