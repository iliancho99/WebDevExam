<?php
namespace Controllers;


use SCart\App;

class Products
{
    private $model = null;
    private $app = null;

    public function __construct()
    {
        $this->model = new \models\ProductsModel();
        $this->app = \SCart\App::getInstance();
    }

    public function addProduct()
    {
        if (App::getInstance()->getIsLoggedUser() && App::getInstance()->getSession()->role > 0) {


            if ($this->app->getIsGet()) {
                $view = \SCart\View::getInstance();
                $view->appendToLayout("body", "editorAndAdmin.addProductView");
                $view->display('layouts.default');
            } else {
                $model = new \models\bindingmodels\ProductBindingModel();
                $model->setName($_POST["name"]);
                $model->setQuantity($_POST["quantity"]);
                $model->setCategoryId(\SCart\App::getInstance()->getSession()->lastCategoryId);;
                $r = $this->model->AddProduct($model);
                if (!$r) {
                   die;
                }
                \SCart\App::getInstance()->addInfoMessage("Successfully logged");
                header("Location: " . "/index.php/category/get?id=".\SCart\App::getInstance()->getSession()->lastCategoryId);

                die;
            }
        }else{
            header("Location: " . "/index.php/category/get?id=".\SCart\App::getInstance()->getSession()->lastCategoryId);
            die;
        }
    }
}