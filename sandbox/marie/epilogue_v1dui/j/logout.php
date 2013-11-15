<?php
require_once "includes/config.php";

Login::logout();

if (!Login::isLoggedIn()) {
	echo "You are logged out. Click <a href='login.php'>here</a> to login again.";
} else {
	echo "WHA?! Crazy error!";
}