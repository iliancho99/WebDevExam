<?php
namespace SCart;
include_once 'Loader.php';
class App
{
    private static $_instance = null;

    private function __construct(){
        \SCart\Loader::registerNamespace('SCart', dirname(__FILE__).DIRECTORY_SEPARATOR);
        \SCart\Loader::registerAutoLoad();
    }

    public function run(){
    }

    /**
     * @return \SCart\App
     */
    public static function getInstance() {
        if(self::$_instance == null) {
            self::$_instance = new \SCart\App();
        }

        return self::$_instance;
    }
}