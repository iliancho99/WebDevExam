<?php
$cnf['default']['connection_uri']='mysql:host=localhost;dbname=wdbdb';
$cnf['default']['username']='ilian';
$cnf['default']['password']='1234';
$cnf['default']['pdo_options'][PDO::MYSQL_ATTR_INIT_COMMAND]="SET NAMES 'UTF8'";
$cnf['default']['pdo_options'][PDO::ATTR_ERRMODE]=PDO::ERRMODE_EXCEPTION;


$cnf['session']['connection_uri']='mysql:host=localhost;dbname=session';
$cnf['session']['username']='iliyan';
$cnf['session']['password']='1234';
$cnf['session']['pdo_options'][PDO::MYSQL_ATTR_INIT_COMMAND]="SET NAMES 'UTF8'";
$cnf['session']['pdo_options'][PDO::ATTR_ERRMODE]=PDO::ERRMODE_EXCEPTION;

return $cnf;