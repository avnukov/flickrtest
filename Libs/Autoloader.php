<?php
namespace Libs;

class Autoloader
{
    public static function load($className) {
        if (substr($className, 0, 1) === '\\') {
            $className = substr($className, 1);
        }

        $classPath = str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';

        include_once(PROJECT_PATH . DIRECTORY_SEPARATOR . $classPath);
    }
}
