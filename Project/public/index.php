<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
include '../../Framework/App.php';
\SCart\Loader::registerNamespace('Controllers', '..\controllers');
\SCart\Loader::registerNamespace('models', '..\models');
$app = \SCart\App::getInstance();
$app->run();



