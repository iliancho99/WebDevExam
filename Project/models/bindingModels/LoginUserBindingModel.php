<?php
/**
 * Created by PhpStorm.
 * User: Iliyancho
 * Date: 10/3/2015
 * Time: 4:51 PM
 */

namespace models\bindingmodels;


class LoginUserBindingModel
{
    private $username;
    private $password;

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }
}