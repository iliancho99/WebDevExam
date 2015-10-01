<?php
/**
 * Created by PhpStorm.
 * User: Iliyancho
 * Date: 10/1/2015
 * Time: 10:55 PM
 */

namespace SCart\Routers;


class DefaultRouter
{
    private $controller = null;
    private $method = null;
    private $params = Array();

    public function parse() {
        $_uri = substr($_SERVER["PHP_SELF"], strlen($_SERVER["SCRIPT_NAME"]) + 1);
        $_params = explode('/', $_uri);
        if($_params[0]) {
            $this->controller .= ucfirst($_params[0]);
            if($_params[1]) {
                $this->method = $_params[1];
                unset($_params[0], $_params[1]);
                $this->params = array_values($_params);
            }
        }
    }

    public function getController(){
        return $this->controller;
    }

    public function getMethod(){
        return $this->method;
    }

    public function getGet(){
        return $this->params;
    }
}