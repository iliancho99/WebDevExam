<?php
/**
 * Created by PhpStorm.
 * User: Iliyancho
 * Date: 10/3/2015
 * Time: 9:31 PM
 */

namespace Controllers;


class Category
{
    private $model = null;
    private $app = null;

    public function __construct(){
        $this->model = new \models\CategoryModel();
        $this->app = \SCart\App::getInstance();
    }

    public function index(){
        $categories = $this->model->GetCategories();
        \SCart\View::getInstance()->categories = $categories;
        \SCart\View::getInstance()->appendToLayout("body", "loggedUser.categoriesView");
        \SCart\View::getInstance()->display("layouts.default");
    }

    public function get(){
        $products = $this->model->GetProductsByCategory($_GET["id"]);
        \SCart\View::getInstance()->products = $products;
        \SCart\View::getInstance()->appendToLayout("body", "productsView");
        \SCart\View::getInstance()->display("layouts.default");
        \SCart\App::getInstance()->getSession()->lastCategoryId = $_GET["id"];
    }

    public function addtocart(){
        $id = $_GET["id"];
        $product =  $this->model->GetProductById($id);
        if(intval($product[0]["quantity"]) <= 0 || intval($product[0]["cost"]) > intval(\SCart\App::getInstance()->getInstance()->getSession()->cash))
        {
            throw new \Exception("Error");
        }


        $this->model->AddToCart($id)->getAffectedRows();
        $this->model->QuntityDecrement($id)->getAffectedRows();
        $this->model->CashDecreament(\SCart\App::getInstance()->getSession()->username,
            \SCart\App::getInstance()->getInstance()->getSession()->cash - $product[0]["cost"])->getAffectedRows();
        \SCart\App::getInstance()->getInstance()->getSession()->cash -= $product[0]["cost"];
        header("Location: ". "/");
    }

    public function Add(){
        if (\SCart\App::getInstance()->getIsLoggedUser() && \SCart\App::getInstance()->getSession()->role > 0) {


            if ($this->app->getIsGet()) {
                $view = \SCart\View::getInstance();
                $view->appendToLayout("body", "editorAndAdmin.addCategoryView");
                $view->display('layouts.default');
            } else {
                $model = new \models\bindingmodels\CategoryBindingModel();
                $model->setName($_POST["name"]);
                $r = $this->model->AddCategory($model);
                if (!$r) {
                    die;
                }
                \SCart\App::getInstance()->addInfoMessage("Successfully ADD");
                header("Location: " . "/index.php/category");
                die;
            }
        }
    }
}