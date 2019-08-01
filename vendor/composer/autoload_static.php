<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit5af012652246c3fe16ae48eb1bb717df
{
    public static $files = array (
        '465c4d06a035230b0bac9dbdd136e011' => __DIR__ . '/../..' . '/sonataruby/base/Defiend.php',
    );

    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Sonata\\' => 7,
        ),
        'H' => 
        array (
            'HMVC\\' => 5,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Sonata\\' => 
        array (
            0 => __DIR__ . '/../..' . '/sonataruby/base',
        ),
        'HMVC\\' => 
        array (
            0 => __DIR__ . '/../..' . '/sonataruby/third_party/MX',
        ),
    );

    public static $classMap = array (
        'Sonata\\ApiClient' => __DIR__ . '/../..' . '/sonataruby/base/Controller.php',
        'Sonata\\ApiServer' => __DIR__ . '/../..' . '/sonataruby/base/Controller.php',
        'Sonata\\Controller' => __DIR__ . '/../..' . '/sonataruby/base/Controller.php',
        'Sonata\\Format' => __DIR__ . '/../..' . '/sonataruby/base/Format.php',
        'Sonata\\Rest' => __DIR__ . '/../..' . '/sonataruby/base/Rest.php',
        'Sonata\\Services' => __DIR__ . '/../..' . '/sonataruby/base/Services.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit5af012652246c3fe16ae48eb1bb717df::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit5af012652246c3fe16ae48eb1bb717df::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit5af012652246c3fe16ae48eb1bb717df::$classMap;

        }, null, ClassLoader::class);
    }
}
