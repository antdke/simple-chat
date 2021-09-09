<?php

// include config
include('config.php');

// access adminlog file
// $adminlog_path = $file_path . '/adminlog.txt'; 

// security audit --- is user logged in
if ($_COOKIE['loggedin'] == 'yes') {

  // if logged in then they can make changes to text files 
  $bannedwords = $_POST['bannedwords'];

  // check for blanks

  // bannedwords TEXT
  if(strlen($bannedwords) > 0) {
    // put changed text to the form
    file_put_contents($path.'/banned.txt', $bannedwords);
    // record change to homepage in admin log file
    //file_put_contents($adminlog_path, time() . "," . $_COOKIE['username'] . "," . "edited_homepage" . "\n", FILE_APPEND);
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