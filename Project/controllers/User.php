<?php
/**
 * Created by PhpStorm.
 * User: Iliyancho
 * Date: 10/3/2015
 * Time: 4:46 PM
 */

namespace Controllers;


class User
{
    private $model = null;
    private $app = null;

    /**
     *
     */
    public function __construct(){
        $this->model = new \models\UserModel();
        $this->app = \SCart\App::getInstance();
    }

    public function Register(){
        if($this->app->getIsGet()){
            $view = \SCart\View::getInstance();
            $view->appendToLayout("body", "RegisterView");
            $view->display('layouts.default');
        }else{
            $model = new \models\bindingmodels\RegisterUserBindingModel();
            $model->setFullName($_POST["fullname"]);
            $model->setPassword($_POST["password"]);
            $model->setUsername($_POST["username"]);
            $r = $this->model->RegisterUser($model);
            if(!$r){
                \SCart\App::getInstance()->addErrorMessage("Error");
                die;
            }

            $loggedModel = new \models\bindingmodels\LoginUserBindingModel();
            $loggedModel->setPassword($_POST["password"]);
            $loggedModel->setUsername($_POST["username"]);
            $this->Login($loggedModel);
        }
    }

    public function Login(){
        if($this->app->getIsGet()){
            $view = \SCart\View::getInstance();
            $view->appendToLayout("body", "LoginView");
            $view->display('layouts.default');
        }else{
            $model = new \models\bindingmodels\LoginUserBindingModel();
            $model->setPassword($_POST["password"]);
            $model->setUsername($_POST["username"]);
            $r = $this->model->Login($model);
            if($r){
                \SCart\App::getInstance()->getSession()->username =  $_POST["username"];
                \SCart\App::getInstance()->getSession()->cash = $r[0]["cash"];
            }
            var_dump($r);
            \SCart\App::getInstance()->addInfoMessage("Successfully logged");
            header("Location: ". "/");
            die;
        }
    }

    public function Logout(){
        \SCart\App::getInstance()->getSession()->destroySession();
        \SCart\App::getInstance()->addInfoMessage("Successfully logout");
        header("Location: ". "/");


        die;
    }
}