<?php
/**
 * Created by PhpStorm.
 * User: Iliyancho
 * Date: 10/1/2015
 * Time: 10:55 PM
 */

namespace SCart\Routers;


class DefaultRouter implements IRouter
{
    public function getURI() {
        return substr($_SERVER["PHP_SELF"], strlen($_SERVER["SCRIPT_NAME"]) + 1);
    }
}