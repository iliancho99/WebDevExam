<?php
/**
 * Created by PhpStorm.
 * User: Iliyancho
 * Date: 10/1/2015
 * Time: 8:10 PM
 */

namespace SCart;


class Config
{
    private static $_instance = null;
    public $_configFolder = null;
    private $_configArray = array() ;


    private function __construct(){

    }

    /**
     * @return \SCart\Config
     */
    public static function getInstance() {
        if(self::$_instance == null) {
            self::$_instance = new \SCart\Config();
        }

        return self::$_instance;
    }

    public function setConfigFolder($configureFolder)
    {
        if (!$configureFolder) {
            throw new \Exception();
        }

        $_configFolder = realpath($configureFolder);

        if ($_configFolder != False && is_dir($_configFolder) && is_readable($_configFolder)) {
        $this->_configArray = array();
        $this->_configFolder = $_configFolder;
        }else{
            throw new \Exception("stop");
        }
    }

    public function __get($name) {
        if(!$this->_configArray[$name]){
            $this->includeConfigFile($this->_configFolder . DIRECTORY_SEPARATOR . $name . '.php');
        }

        if($this->_configArray[$name]) {
            return $this->_configArray[$name];
        }

        return null;
    }

    public function includeConfigFile($path){
        if(!$path) {
            throw new \Exception;
        }

        $_file = realpath($path);
        if($_file != false && is_file($_file) && is_readable($_file)) {
            $_basename = explode('.php', basename($_file))[0];
            $this->_configArray[$_basename] = include $_file;
        }else{
            throw new \Exception;
        }
    }
}