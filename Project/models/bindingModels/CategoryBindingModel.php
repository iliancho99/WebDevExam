<?php
/**
 * Created by PhpStorm.
 * User: Iliyancho
 * Date: 10/4/2015
 * Time: 10:16 AM
 */

namespace models\bindingmodels;


class CategoryBindingModel
{
    private $name;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
}