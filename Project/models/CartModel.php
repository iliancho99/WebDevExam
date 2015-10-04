<?php
/**
 * Created by PhpStorm.
 * User: Iliyancho
 * Date: 10/4/2015
 * Time: 9:35 AM
 */

namespace models;


class CartModel
{
    private $db = null;

    public function __construct(){
        $this->db = new \SCart\DB\SimpleDB();
    }

    public function GetCart($id){
        $this->db->prepare("Select sp.shopcartid, sp.productId, p.Name , Count(p.Name) as count from shopcart_products sp Left Join products p on p.idproduct = sp.productid where sp.shopcartid = ? group by sp.shopcartid, sp.productId, p.Name");
        return $this->db->execute(array($id));
    }
}