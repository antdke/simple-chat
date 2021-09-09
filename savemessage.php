<?php
// access to file path
include("config.php");

// grab data from the client
$message = $_POST['message'];
$nickname = $_POST['nickname'];
$room = $_POST['room'];



// clean the message of impurities 
$cleaned_message = preg_replace("/[^a-zA-Z0-9 '!@#$%^&*()\"\/?.,]/", "", $message);

// get list of banned words
$banned_words = file_get_contents($path . "/banned.txt");
$banned_words_trimmed = trim($banned_words);
$banned_words_array = explode(" ", $banned_words_trimmed);

// create banned word dedection flag
$banned_word_exists = false;

//check if banned words are in cleaned message
for ($i = 0; $i < sizeof($banned_words_array); $i++) {
  // if bad word is present
  if (strpos(strtolower($cleaned_message), $banned_words_array[$i]) !== false) {
    // indicate no bad words found
    $banned_word_exists = true;
    break;
  }
}


// if all impurities have been cleansed
if (strlen($cleaned_message) > 0 && $banned_word_exists == false) {
  file_put_contents($path . "/$room.txt", "$nickname : $cleaned_message\n", FILE_APPEND);
  // if the message == "/newname" then send back data indicating so
  if ($cleaned_message == "/newname") {
    print "new name request";
    exit();
  }
} else if ($banned_word_exists == true) {
  print "banned word used";
  exit();
} else {
  print "message too short";
  exit();
}





?>