<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit70b43b9ad2cee7d5080dc7f20bb328cf
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

        require __DIR__ . '/platform_check.php';

        spl_autoload_register(array('ComposerAutoloaderInit70b43b9ad2cee7d5080dc7f20bb328cf', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit70b43b9ad2cee7d5080dc7f20bb328cf', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit70b43b9ad2cee7d5080dc7f20bb328cf::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}