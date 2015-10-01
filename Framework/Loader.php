<?php
namespace SCart;


final class Loader
{

    private static $namespaces;
    private function __construct(){

    }

    public static function registerAutoLoad() {
        spl_autoload_register(array("\\SCart\\Loader", 'autoload'));
    }

    public static function autoload($class){
        foreach (self::$namespaces as $k => $v) {
            if(strpos($class, $k) === 0){
                $file = str_replace('\\', DIRECTORY_SEPARATOR, $class);
                $file = substr_replace($file, $v, 0, strlen($k)).'.php';
                $file = realpath($file);
                echo $file;
                if($file && is_readable($file)) {
                    include $file;
                }else{
                    //throw new \Exception();
                }
            }
            break;
        }

    }

    public static function registerNamespace($namespace, $path) {
        $namespace = trim($namespace);
        if(strlen($namespace) > 0){
            if(!$path) {
                throw new \Exception('Invalid path');
            }

            $_path = realpath($path);
            if($_path && is_dir($_path) && is_readable($_path)){
                self::$namespaces[$namespace] = $_path;
            } else {
                throw new \Exception('Namespace directory error!');
            }
        }else{
            throw new \Exception('Invalid namespace');
        }
    }
}