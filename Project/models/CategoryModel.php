<?php
/**
 * Created by PhpStorm.
 * User: Iliyancho
 * Date: 10/3/2015
 * Time: 9:33 PM
 */

namespace models;


class CategoryModel
{
    private $db = null;

    public function __construct(){
        $this->db = new \SCart\DB\SimpleDB();
    }

    public function GetCategories(){
        $this->db->prepare("select * from categories");
        return $this->db->execute()->fetchAllAssoc();
    }

    public function GetProductsByCategory($id){
        $this->db->prepare("select * from products where categoryid = ?");
        return $this->db->execute(array($id))->fetchAllAssoc();
    }

    public function GetProductById($id){
        $this->db->prepare("select * from products where idproduct = ?");
        return $this->db->execute(array($id))->fetchAllAssoc();
    }


    public function AddToCart($id){
        $username = \SCart\App::getInstance()->getSession()->username;
        $this->db->prepare("INSERT INTO `wdbdb`.`shopcart_products`(`shopcartid`,`productid`)VALUES(?, ?);");
        return $this->db->execute(array($username, $id));
    }

    public function QuntityDecrement($id){
        $this->db->prepare("UPDATE `wdbdb`.`products`SET quantity = quantity - 1 WHERE idproduct = ?;");
        return $this->db->execute(array($id));
    }

    public function CashDecreament($username, $cash){
        $this->db->prepare("UPDATE `wdbdb`.`users`SET `cash` = ? WHERE `username` = ?;SELECT * FROM wdbdb.users;");
        return $this->db->execute(array($cash, $username));
    }

    public function AddCategory(\models\bindingmodels\CategoryBindingModel $model){
        $this->db->prepare("INSERT INTO `wdbdb`.`categories` (`name`)VALUES(?);");
        return $this->db->execute(array($model->getName()));
    }
}
