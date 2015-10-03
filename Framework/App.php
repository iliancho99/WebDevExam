<?php
namespace SCart;
include_once 'Loader.php';
class App
{
    private static $_instance = null;
    private $_config = null;
    private $_frontController = null;
    private $router = null;
    private $_dbConnections = array();
    private $_session = null;

    /**
     * @return null
     */
    public function getRouter()
    {
        return $this->router;
    }

    /**
     * @param null $router
     */
    public function setRouter($router)
    {
        $this->router = $router;
    }



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
        if($this->router == null){
            $this->router = new \SCart\Routers\DefaultRouter();
        }
        $this->_frontController->setRouter($this->router);

        $_sess = $this->_config->appConfig['session'];
        if ($_sess['autostart']) {
            if ($_sess['type'] == 'native') {
                $_s = new \SCart\Session\NativeSession($_sess['name'], $_sess['lifetime'], $_sess['path'], $_sess['domain'], $_sess['secure']);
            } else if ($_sess['type'] == 'database') {
                $_s = new \SCart\Session\DBSession($_sess['dbConnection'],
                    $_sess['name'], $_sess['dbTable'], $_sess['lifetime'], $_sess['path'], $_sess['domain'], $_sess['secure']);
            } else {
                throw new \Exception('No valid session', 500);
            }

            $this->setSession($_s);
        }
        $this->_frontController->dispatch();

    }

    public function setSession(\SCart\Session\ISession $session) {
        $this->_session = $session;
    }

    /**
     *
     * @return \SCart\Session\ISession
     */
    public function getSession() {
        return $this->_session;
    }


    public function getDBConnection($connection = 'default') {
        if (!$connection) {
            throw new \Exception('No connection identifier providet', 500);
        }
        if ($this->_dbConnections[$connection]) {
            return $this->_dbConnections[$connection];
        }
        $_cnf = $this->getConfig()->database;
        if (!$_cnf[$connection]) {
            throw new \Exception('No valid connection identificator is provided', 500);
        }
        $dbh = new \PDO($_cnf[$connection]['connection_uri'], $_cnf[$connection]['username'],
            $_cnf[$connection]['password'], $_cnf[$connection]['pdo_options']);
        $this->_dbConnections[$connection] = $dbh;
        return $dbh;
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

    public function __destruct(){
        if($this->_session != null){
            $this->_session->saveSession();
        }
    }
}