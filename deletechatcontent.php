<?php

// include config
include('config.php');

// access adminlog file
// $adminlog_path = $file_path . '/adminlog.txt'; 

// security audit --- is user logged in
if ($_COOKIE['loggedin'] == 'yes') {

  // if logged in then they can delete room content
  $room = $_POST['room'];

  // check for blanks

  // bannedwords TEXT
  if(strlen($room) > 0 && ($room == "room1" || $room == "room2" || $room == "room3")) {
    // set room contents to empty string
    file_put_contents($path."/$room.txt", "");

    // record change to homepage in admin log file
    //file_put_contents($adminlog_path, time() . "," . $_COOKIE['username'] . "," . "edited_homepage" . "\n", FILE_APPEND);
  } else {
    header("Location: admin.php?error=invalidroom");
    exit();
  }
  // send back to form
    header("Location: admin.php?confirmation=savedtext");
    exit();

} else {
  // send them back to admin page
  header("Location: admin.php?error=notloggedin");
  exit();
}



?>