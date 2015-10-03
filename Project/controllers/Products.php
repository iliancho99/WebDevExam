<?php
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

    public function addToCart(){
        echo "Hello from cart";
    }
}