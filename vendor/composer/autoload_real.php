<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit5a5e12fba4eed5ab0ac7f432f56ad08c
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInit5a5e12fba4eed5ab0ac7f432f56ad08c', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit5a5e12fba4eed5ab0ac7f432f56ad08c', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit5a5e12fba4eed5ab0ac7f432f56ad08c::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}