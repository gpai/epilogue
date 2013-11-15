<?php
/*
 Epilogue Group

advisor: Jed B.

members:
Anita Marie G.
Baldwin C.
Nafiri K.
Nithin J.
Grace P.

*/


/**
 * CONFIGURE PHP ENVIORNMENT
 */
// ini_set('display_errors', 'On');
ini_set("error_log", "php-error.log");
error_reporting(E_ALL);

/**
 * IMPORTS
 */

// Libraries
require_once "lib/fb/facebook.php";

// Epilogue Code
require_once "classes/Epilogue.php";
require_once "classes/Db.php";
require_once "classes/User.php";
require_once "classes/Login.php";
require_once 'classes/Session.php';
// require_once "classes/class.lists.php";


/**
 * PROPERTIES
 */

$config = array();

$config['session']['name'] = "epi";
$config['session']['host'] = ".duidesign.com";
$config['session']['dbtable'] = "session";



$config['fb']['appId'] = '665113106856066';
$config['fb']['secret'] = '2d230b0ad9a39b85f68d4aa235d8d8ee';
$config['fb']['fileUpload'] = false; // optional
$config['fb']['scope'] = "read_stream, friends_likes, user_status";
$config['fb']['redirectLogin'] = "http://duidesign.com/j/login.php"; //"http://duidesign.com/j/login.php";
$config['fb']['redirectLogout'] = "http://duidesign.com/j/logout.php"; //"http://duidesign.com/j/login.php";
$config['fb']['cookie'] = true; // optional

$config['db']['user'] = 'Vixen_VixGrace'; 
$config['db']['password'] = 'cutie';
$config['db']['schema'] = 'Vixen_test';


/**
 * BOOTSTRAP CONNECTIONS
 */

// Initialize Facebook
$facebook = new Facebook($config['fb']);

// Initialize Session
session_name($config['session']['name']);
session_set_cookie_params(0, '/', $config['session']['host']);
session_start();

// Baldwin Foo
$db = new Db($config['db']['user'], $config['db']['password'], $config['db']['schema']);
$epilogue = new Epilogue($db, $facebook);
$epilogue->fbCheck();

// Login check, and User init
// if ($epilogue->isLoggedIn()) {
// 	$user = new User($sql, $facebook, $epilogue->id);
// }

?>