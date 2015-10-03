<?php
$cnf["default_controller"] = "index";
$cnf["default_method"] = "index";
$cnf["namespace"]["Controllers"] = 'C:\Users\Iliyancho\Desktop\WebDevExam\Project\controllers' ;

$cnf['session']['autostart'] = true;
$cnf['session']['type'] = 'database';
$cnf['session']['name'] = '__sess';
$cnf['session']['lifetime'] = 3600;
$cnf['session']['path'] = '/';
$cnf['session']['domain'] = '';
$cnf['session']['secure'] = false;
$cnf['session']['dbConnection'] = 'default';
$cnf['session']['dbTable'] = 'sessions';
return $cnf;