<?php
require_once "includes/config.php";
require_once "includes/classes/FacebookFriend.php";
require_once "includes/classes/Registry.php";
require_once "includes/classes/Database.php";
require_once "includes/classes/Epilogue.php";
require_once "includes/classes/Favorite.php";
require_once "includes/classes/Login.php";
require_once "includes/classes/Memorial.php";
require_once "includes/classes/Photo.php";
require_once "includes/classes/Session.php";
require_once "includes/classes/User.php";
require_once "includes/classes/Video.php";
//Need to get a list of posts from Marie.

$posts= new Post();
$user_id="";
$getAllPosts=$posts->getPosts($user_id);
//Save changes that they made onto DB.
$memorial_id="";
$arr_of="";
$editPosts=$posts->insertDeceasedPosts($arr_of, $memorial_id);
include "editPost.phtml";
?>