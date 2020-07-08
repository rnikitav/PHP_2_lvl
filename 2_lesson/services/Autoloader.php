<?php


class Autoloader
{
    public function loadClass($className)
    {
        $className = str_replace('App\\', '' , $className);
        $file = dirname(__DIR__) . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';
        if (!file_exists($file)) {
            throw new \Exception("File is not found: {$file}");
        }
        require $file;
    }
}
