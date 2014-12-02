<?php

$_BASE_DIR = '/Users/Joao/FEUP/LTW/Volare/volare_web/';
$_BASE_URL = 'http://192.168.1.69:8888/';
$_DB_PATH  = 'data/database.sqlite';


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

	$dbh = new PDO('sqlite:' . $_BASE_DIR . $_DB_PATH);
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
include_once($_BASE_DIR . 'logic/classes/user.php');


?>