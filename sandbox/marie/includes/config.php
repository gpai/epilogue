<?php
/*
 Epilogue Group

advisor: Jed B.

members:
Anita Marie G.
Baldwin C.
Nafiri K.
Nithin J.

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
require_once 'classes/Registry.php';
require_once "classes/Epilogue.php";
require_once "classes/Database.php";
require_once "classes/User.php";
require_once "classes/Login.php";
require_once 'classes/Session.php';
// require_once "classes/class.lists.php";

echo "config file --------";


/**
 * PROPERTIES
 */



$config = array();

$config['session']['name'] = "epi";
$config['session']['host'] = "localhost";
$config['session']['dbtable'] = "session";

$config['fb']['appId'] = '665113106856066';
$config['fb']['secret'] = '2d230b0ad9a39b85f68d4aa235d8d8ee';
$config['fb']['fileUpload'] = false; // optional
$config['fb']['scope'] = "read_stream, friends_likes, user_status";
$config['fb']['redirectLogin'] = "http://localhost:8888/sandbox/marie/login.php"; // "this needs to point to right file login file location";
$config['fb']['redirectLogout'] = "http://localhost:8888/sandbox/marie/login.php"; //"this needs to point to the right logout file location";
$config['fb']['cookie'] = true; // optional

$config['db']['user'] = 'Vixen_VixGrace'; 
$config['db']['password'] = 'cutie';
$config['db']['schema'] = 'Vixen_test';
$config['db']['host'] = 'mysql2.speedypuppy.net';

echo "config file 2 -     -------";
/**
 * BOOTSTRAP CONNECTIONS
 */

// Initialize Facebook
$facebook = new Facebook($config['fb']);

// Connect to the database
$database = new Database($config['db']['user'], $config['db']['password'], $config['db']['schema'], $config['db']['host']);
echo "config file 2.1---- ????????----";
$epilogue = new Epilogue($database, $facebook);
echo "config file 2.2--------";
$epilogue->fbCheck();

/**
 * Registry -- store everything here.
 */


echo "config file 3 --------";

Registry::getInstance()->set("config", $config);
Registry::getInstance()->set("fb", $facebook);
Registry::getInstance()->set("db", $database);

// Login check, and User init
// if ($epilogue->isLoggedIn()) {
// 	$user = new User($sql, $facebook, $epilogue->id);
// }

?>