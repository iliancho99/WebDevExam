<?php
namespace SCart;


class FrontController
{
    private static $_instance = null;
    private $ns = null;
    private $controller = null;
    private $method = null;
    private $params = Array();
    private $router = null;

    /**
     * @return null
     */
    public function getRouter()
    {
        return $this->router;
    }

    /**
     * @param null $router
     */
    public function setRouter(\SCart\Routers\IRouter $router)
    {
        $this->router = $router;
    }

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

    public function getDefaultController(){
        $controller = \SCart\App::getInstance()->getConfig()->appConfig["default_controller"];
        if($controller) {
            return $controller;
        }

        return 'index';
    }

    public function getDefaultMethod(){
        $method = \SCart\App::getInstance()->getConfig()->appConfig["default_method"];
        if($method) {
            return $method;
        }

        return 'index';
    }

    public function dispatch(){
        if($this->router == null){
            throw new \Exception("No valid Router!");
        }
        $_uri = $this->router->getURI();
        $_rc = null;

        $routes = \SCart\App::getInstance()->getConfig()->routes;
        if(is_array($routes) && count($routes) > 0) {
            foreach ($routes as  $k => $v ) {
                if(strpos($_uri, $k) === 0 && ($_uri == $k || strpos($_uri, $k . '/') === 0) && $v["namespace"]) {
                    $this->ns = $v["namespace"];
                    $_uri = substr($_uri, strlen($k) + 1);
                    $_rc = $v;
                    break;
                }
            }

            if($this->ns == null && $routes["*"]["namespace"]){
                $this->ns = $routes["*"]["namespace"];
                $_rc = $routes["*"];
            }else if($this->ns == null && !$routes["*"]["namespace"]){
                throw new \Exception();
            }
        }else{
            throw new \Exception;
        }

        $_params = explode('/', $_uri);
        if($_params[0]) {
            $this->controller .= strtolower($_params[0]);
            if($_params[1]) {
                $this->method = strtolower($_params[1]);
                unset($_params[0], $_params[1]);
                $this->params = array_values($_params);
            }else{
                $this->method = $this->getDefaultMethod();
            }
        }else{
            $this->controller = $this->getDefaultController();
            $this->method = $this->getDefaultMethod();
        }

        if(is_array($_rc) && $_rc['controllers'] && $_rc['controllers'][$this->controller]["to"]){
            if($_rc['controllers'][$this->controller]["methods"][$this->method]) {
                $this->method = $_rc['controllers'][$this->controller]["methods"][$this->method];
            }

            if($_rc['controllers'][$this->controller]["to"]) {
                $this->controller = $_rc['controllers'][$this->controller]["to"];
            }
        }

        $f = $this->ns.'\\'.ucfirst($this->controller);
        $newController = new $f();
        $newController->{$this->method}();
    }
}