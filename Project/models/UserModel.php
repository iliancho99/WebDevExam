<?php

namespace models;
class UserModel
{
    private $db = null;

    public function __construct(){
        $this->db = new \SCart\DB\SimpleDB();
    }

    public function RegisterUser(\models\bindingmodels\RegisterUserBindingModel $model){
        $this->db->prepare("INSERT INTO `wdbdb`.`shopcarts`(`username`)VALUES(?);");
        $username = $model->getUsername();
        $r = $this->db->execute(array($username));
        if(!$r){
            return $r;
        }
        $this->db->prepare("INSERT INTO `wdbdb`.`users`(username, fullname, password)VALUES(?, ?, ?);");
        return $this->db->execute(array($model->getUsername(), $model->getFullName(), $model->getPassword()));
    }

    public function Login(\models\bindingmodels\LoginUserBindingModel $model){
        $this->db->prepare("Select * From Users Where username= ? and password = ?");
        return $this->db->execute(array($model->getUsername(), $model->getPassword()))->fetchAllAssoc();
    }



}