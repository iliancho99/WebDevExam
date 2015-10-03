<?php
error_reporting(E_ALL ^ E_NOTICE);
include '../../Framework/App.php';
\SCart\Loader::registerNamespace('Controllers', 'C:\Users\Iliyancho\Desktop\WebDevExam\Project\controllers');
$app = \SCart\App::getInstance();
$app->run();
$app->getSession()->counter+=1;
echo $app->getSession()->counter;

