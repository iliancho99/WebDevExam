<?php
/**
 * Created by PhpStorm.
 * User: Iliyancho
 * Date: 10/2/2015
 * Time: 9:08 PM
 */

namespace Controllers;


class Index
{
    public function index(){
        $view = \SCart\View::getInstance();
        $view->username = "Iliancho";
        if(\SCart\App::getInstance()->getIsLoggedUser()){
            $view->appendToLayout("body", "loggedUser.index");
        }else{
            $view->appendToLayout("body", "index");

        }
        $view->display("layouts.default");
    }
}