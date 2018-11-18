<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit80041084213aa2f5b85cf6b65e3e0c23
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

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit80041084213aa2f5b85cf6b65e3e0c23::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit80041084213aa2f5b85cf6b65e3e0c23::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
