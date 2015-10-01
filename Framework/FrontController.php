<?php
namespace SCart;


class FrontController
{
    private static $_instance = null;

    private function __construct(){

    }

    /**
     * @return \SCart\FrontController
     */
    public static function getInstance() {
        if(self::$_instance == null) {
            self::$_instance = new \SCart\FrontController();
        }

        return self::$_instance;
    }

    public function dispatch(){
        $a = new \SCart\Routers\DefaultRouter();
        $a->parse();

    }

}