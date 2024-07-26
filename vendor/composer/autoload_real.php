<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitdd1e7c8d3f0738ff9118946bef6f5f0e
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

        spl_autoload_register(array('ComposerAutoloaderInitdd1e7c8d3f0738ff9118946bef6f5f0e', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitdd1e7c8d3f0738ff9118946bef6f5f0e', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitdd1e7c8d3f0738ff9118946bef6f5f0e::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
