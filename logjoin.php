<?php

include("config.php");

// access usagelog file
$usagelog_path = $path . '/usagelog.txt'; 

// grab user and pass
$nickname = $_POST['nickname'];
$room = $_POST['room'];
$user_ip_addr = $_SERVER['REMOTE_ADDR'];

file_put_contents($usagelog_path, time() . "," . $user_ip_addr . "," . $nickname . "," . "user_joined_$room" . "\n", FILE_APPEND);

header('Location: admin.php');
exit();
?>