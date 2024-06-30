<?php
require_once 'User.php';
$user = new User($mysqli);
$user->logout();
header("location: login.php");
exit;
?>