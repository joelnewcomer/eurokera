<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit062794c6a69850589282f3f14a4d4a2c
{
    public static $prefixesPsr0 = array (
        'x' => 
        array (
            'xrstf\\Composer52' => 
            array (
                0 => __DIR__ . '/..' . '/xrstf/composer-php52/lib',
            ),
        ),
    );

    public static $classMap = array (
        'WPML_Dependencies' => __DIR__ . '/..' . '/wpml-shared/wpml-lib-dependencies/src/dependencies/class-wpml-dependencies.php',
        'WPML_Sticky_Links' => __DIR__ . '/../..' . '/classes/class-wpml-sticky-links.php',
        'xrstf\\Composer52\\AutoloadGenerator' => __DIR__ . '/..' . '/xrstf/composer-php52/lib/xrstf/Composer52/AutoloadGenerator.php',
        'xrstf\\Composer52\\Generator' => __DIR__ . '/..' . '/xrstf/composer-php52/lib/xrstf/Composer52/Generator.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixesPsr0 = ComposerStaticInit062794c6a69850589282f3f14a4d4a2c::$prefixesPsr0;
            $loader->classMap = ComposerStaticInit062794c6a69850589282f3f14a4d4a2c::$classMap;

        }, null, ClassLoader::class);
    }
}
