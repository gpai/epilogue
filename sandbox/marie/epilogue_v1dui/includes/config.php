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
ini_set('display_errors', 'On');
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
$config['fb']['scope'] = "create_event,friends_about_me,friends_activities,friends_birthday,friends_checkins,friends_education_history,friends_events,friends_groups,friends_hometown,friends_interests,friends_likes,friends_location,friends_notes,friends_online_presence,friends_photo_video_tags,friends_photos,friends_relationship_details,friends_relationships,friends_religion_politics,friends_status,friends_videos,friends_website,friends_work_history,manage_friendlists,manage_pages,offline_access,publish_checkins,publish_stream,read_friendlists,read_mailbox,read_requests,read_stream,rsvp_event,user_about_me,user_activities,user_birthday,user_checkins,user_education_history,user_events,user_groups,user_hometown,user_interests,user_likes,user_location,user_notes,user_online_presence,user_photo_video_tags,user_photos,user_relationship_details,user_relationships,user_religion_politics,user_status,user_videos,user_website,user_work_history";

$config['fb']['redirect'] = "http://duidesign.com/working/login.php"; //"http://duidesign.com/working/login.php";
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
$sql = new Db($config['db']['user'], $config['db']['password'], $config['db']['schema']);
$epilogue = new Epilogue($sql, $facebook);
$epilogue->fbCheck();

// Login check, and User init
if ($epilogue->isLoggedIn()) {
	$user = new User($sql, $facebook, $epilogue->id);
}

?>