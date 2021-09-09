<?php

include("config.php");

// access usagelog file
$usagelog_path = $path . '/usagelog.txt'; 

$user_ip_addr = $_SERVER['REMOTE_ADDR'];

// record logout in admin log file
file_put_contents($usagelog_path, time() . "," . $user_ip_addr . "," . $_COOKIE['username'] . "," . "admin_logout" . "\n", FILE_APPEND);

// destroy cookies
setcookie('loggedin', '', time()-3600);
setcookie('username', '', time()-3600);

// send back to admin form
header('Location: admin.php');
exit();

?>