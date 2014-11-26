<?php

$_BASE_DIR = '/Users/Joao/FEUP/LTW/Volare/volare_web/';
$_BASE_URL = 'http://volare:8888/';
define('database_path', 'data/database.sqlite');

/*
== ------------------------------------------------------------------- ==
== @@ FirePHP Debug
== ------------------------------------------------------------------- ==
*/

require_once($_BASE_DIR . 'assets/plugins/firephp/fb.php');
$firephp = FirePHP::getInstance(true);
ob_start();


/*
== ------------------------------------------------------------------- ==
== @@ Database Connection
== ------------------------------------------------------------------- ==
*/

try {

	$dbh = new PDO('sqlite:' . database_path);
	$dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {

	die($e->getMessage());

}


/*
== ------------------------------------------------------------------- ==
== @@ Classes
== ------------------------------------------------------------------- ==
*/

include_once($_BASE_DIR . 'logic/classes/poll.php');


?>