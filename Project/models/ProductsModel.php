<?php
/**
 * Created by PhpStorm.
 * User: Iliyancho
 * Date: 10/4/2015
 * Time: 10:03 AM
 */

namespace models;


class ProductsModel
{
    private $db = null;

    public function __construct(){
        $this->db = new \SCart\DB\SimpleDB();
    }

    public function AddProduct(\models\bindingmodels\ProductBindingModel $model){
       $this->db->prepare("SELECT * FROM wdbdb.users;INSERT INTO `wdbdb`.`products` (`categoryId`,`name`,`quantity`)VALUES(?, ?, ?);");
        return $this->db->execute(array($model->getCategoryId(), $model->getName(), $model->getQuantity()));
    }

    public function EditProduct(\models\bindingmodels\ProductBindingModel $model){
       $this->db->prepare("SELECT * FROM wdbdb.users;INSERT INTO `wdbdb`.`products` (`categoryId`,`name`,`quantity`)VALUES(?, ?, ?);");
        return $this->db->execute( $model->getName(), $model->getQuantity());
    }
}
