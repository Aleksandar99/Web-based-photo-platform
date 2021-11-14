<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit259a6ac559dce11222372e69760b3311
{
    public static $files = array (
        '48483d6c44b015b6d6d681c009d084a7' => __DIR__ . '/../..' . '/src/helpers.php',
    );

    public static $prefixLengthsPsr4 = array (
        'I' => 
        array (
            'ImageManipulation\\Executions\\' => 29,
            'ImageManipulation\\Exceptions\\' => 29,
            'ImageManipulation\\' => 18,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'ImageManipulation\\Executions\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/ImageManipulation/Executions',
        ),
        'ImageManipulation\\Exceptions\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/ImageManipulation/Exceptions',
        ),
        'ImageManipulation\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/ImageManipulation',
        ),
    );

    public static $fallbackDirsPsr4 = array (
        0 => __DIR__ . '/../..' . '/src',
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit259a6ac559dce11222372e69760b3311::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit259a6ac559dce11222372e69760b3311::$prefixDirsPsr4;
            $loader->fallbackDirsPsr4 = ComposerStaticInit259a6ac559dce11222372e69760b3311::$fallbackDirsPsr4;
            $loader->classMap = ComposerStaticInit259a6ac559dce11222372e69760b3311::$classMap;

        }, null, ClassLoader::class);
    }
}
