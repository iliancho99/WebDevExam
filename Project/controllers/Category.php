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

    public function get($params){
        $products = $this->model->GetProductsByCategory($_GET["id"]);
        \SCart\View::getInstance()->products = $products;
        \SCart\View::getInstance()->appendToLayout("body", "productsView");
        \SCart\View::getInstance()->display("layouts.default");
    }

    public function addtocart(){
        $id = $_GET["id"];
        $product =  $this->model->GetProductById($id);
        if($product[0]["quantity"] <= 0){
            throw new \Exception("The product is sold!");
        }

        $this->model->AddToCart($id)->getAffectedRows();
        $this->model->QuntityDecrement($id)->getAffectedRows();

        header("Location: ". "/");
    }

}