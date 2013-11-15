<?php
require_once "includes/config.php";

var_dump($epilogue->logout(), $_POST, $_GET, $_SESSION);

die("You are logged out.");