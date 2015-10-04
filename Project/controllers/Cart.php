<?php
/**
 * Created by PhpStorm.
 * User: Iliyancho
 * Date: 10/4/2015
 * Time: 9:34 AM
 */

namespace Controllers;


class Cart
{
        private $model = null;
        private $app = null;

        public function __construct(){
            $this->model = new \models\CartModel();
            $this->app = \SCart\App::getInstance();
        }

        public function index(){
        if (\SCart\App::getInstance()->getIsLoggedUser()) {
            $products =  $this->model->GetCart($this->app->getSession()->username)->fetchAllAssoc();
            $view = \SCart\View::getInstance();
            $view->products = $products;
            $view->appendToLayout("body", "cartView");
            $view->display('layouts.default');
        }
    }
}