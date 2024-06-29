<?php

require_once('config/Database.php');
require_once('class/Userlogin.php');

$connectDB = new Database();
$db = $connectDB->getConnection();

$user = new UserLogin($db);
$user->logOut();
