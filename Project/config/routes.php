<?php
$cnf["*"]["namespace"] = "Controllers";
$cnf["user"]["namespace"] = 'Controllers\User';
$cnf["admin"]["namespace"] = 'Controllers\Admin';
$cnf["user"]["controllers"]["new"]["to"] = "create";
$cnf["user"]["controllers"]["new"]["methods"]["newCon"] = "NewUserMethod";
return $cnf;