<?php
namespace SCart;
include_once 'Loader.php';
class App
{
    private static $_instance = null;
    private $_config = null;
    private $_frontController = null;

    private function __construct(){
        \SCart\Loader::registerNamespace('SCart', dirname(__FILE__).DIRECTORY_SEPARATOR);
        \SCart\Loader::registerAutoLoad();
        $this->_config = \SCart\Config::getInstance();
    }

    public function setConfigFolder($path) {
        $this->_config->setConfigFolder($path);
    }

    public function getConfigFolder() {
        return $this->_config->_configFolder;
    }
    /*
     * @return \SCart\Config
     */
    public function getConfig() {
        return $this->_config;
    }


    public function run() {
        if($this->getConfigFolder() == null) {
            $this->setConfigFolder('../config');
        }

        $this->_frontController =\SCart\FrontController::getInstance();
        $this->_frontController->dispatch();

    }

    /**
     * @return \SCart\App
     */
    public static function getInstance() {
        if(self::$_instance == null) {
            self::$_instance = new \SCart\App();
        }

        return self::$_instance;
    }
}