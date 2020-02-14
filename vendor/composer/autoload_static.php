<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit478056a3d87f3987054a2fb7def5482a
{
    public static $prefixLengthsPsr4 = array (
        'm' => 
        array (
            'model\\' => 6,
        ),
        'h' => 
        array (
            'helper\\' => 7,
        ),
        'c' => 
        array (
            'controller\\' => 11,
            'config\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'model\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app/model',
        ),
        'helper\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app/helper',
        ),
        'controller\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app/controller',
        ),
        'config\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app/config',
        ),
    );

    public static $classMap = array (
        'config\\Database' => __DIR__ . '/../..' . '/app/config/Database.php',
        'controller\\RegisterController' => __DIR__ . '/../..' . '/app/controller/RegisterController.php',
        'helper\\Session' => __DIR__ . '/../..' . '/app/helper/Session.php',
        'helper\\Validation' => __DIR__ . '/../..' . '/app/helper/Validation.php',
        'model\\user\\User' => __DIR__ . '/../..' . '/app/model/user/User.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit478056a3d87f3987054a2fb7def5482a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit478056a3d87f3987054a2fb7def5482a::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit478056a3d87f3987054a2fb7def5482a::$classMap;

        }, null, ClassLoader::class);
    }
}