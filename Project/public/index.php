<?php
include '../../Framework/App.php';
\SCart\Loader::registerNamespace('Test\Models', 'C:\Users\Iliyancho\Desktop\WebDevExam\Project\models\Models');
$app = \SCart\App::getInstance();

$app->run();
new Test\Models\Test();