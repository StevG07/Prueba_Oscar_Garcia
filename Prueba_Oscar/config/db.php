<?php

$paramsDb = array(
  'driver' => 'mysql',
	'host' => '127.0.0.1',
	'port' => '3306',
	'database' => 'cafeteria',
	'user' => 'root',
	'password' => ''
);


$pdo = new PDO($paramsDb['driver'].":host={$paramsDb['host']};dbname={$paramsDb['database']};port={$paramsDb['port']}", $paramsDb['user'], $paramsDb['password']);
