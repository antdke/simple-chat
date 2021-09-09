<?php

include("config.php");

// access usagelog file
$usagelog_path = $path . '/usagelog.txt'; 

// grab user and pass
$username = $_POST['username'];
$password = $_POST['password'];
$user_ip_addr = $_SERVER['REMOTE_ADDR'];

// check for blanks
if ($username && $password) {
  // access teacheraccounts.txt for correct creds
  $data = file_get_contents($path."/admincreds.txt");
  // split data into rows
  $data_rows = explode("\n", $data);

  // iterate through the split rows of the array
  for ($i = 0; $i < count($data_rows); $i++) {
    // check each row to see if the supplied user and pass match up to any of the authorized creds on file

    // split each row
    $creds = explode(",", $data_rows[$i]);

    // check if valid
    if ($username == $creds[0] && $password == $creds[1]) {
      // record login in usage log file
      file_put_contents($usagelog_path, time() . "," . $user_ip_addr . "," . $creds[0] . "," . "admin_login" . "\n", FILE_APPEND);
      // login success
      print "yay";
      // drop a cookie
      setcookie('loggedin', 'yes');
      setcookie('username', $creds[0]);

      // send back to form with no error
      header('Location: admin.php');
      exit();
    
    } else {
      // back to form with incorrect creds error
      header('Location: admin.php?error=incorrect');
      continue;
    }
  }


} else {
  // send them back to form with missing info error
  header('Location: admin.php?error=missinginfo');
  exit();
}





?>