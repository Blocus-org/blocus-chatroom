<?php

// Blocus Chatroom beta-2.0
// LICENCE: AGPL-v3-0 https://github.com/Blocus-org/blocus-chatroom/blob/main/LICENSE 
//
// Opensource instant messaging web application with enrypted database.
// Blocus-org https://org.blocus.ch
// @author Zqfd

// CONFIG

// Admin config:
$admin_interface = true; // If "true", you will be asked to create an admin account in update.php script.
$admin_mail = "blocus-org@proton.me"; // Email adress for privacy policy contact, change it to match yours.


// Database config:
$hostname = "localhost";
$username = "";
$password = "";
$dbname = "blocus_chat_db";

// Footer config:
$app_name = "Blocus-chatroom";
$app_version = "beta-2.0.4-nightly";
$source_url = ""; // If you run a modified version, create a public repository (LICENCE: GNU-AGPL-v3.0-or-later).

// Encryption key:
$encryption_key = ")J@NcRfUjXn2r5u8x/A%D*G-KaPdSgVk"; // !!! Change it to another auto-generated SHA256 key !!!

// END

// FUNCTIONS

// Set link to source code.
if($source_url != ""){
  $source_code = $source_url;
}else{
  $source_code = "https://github.com/Blocus-org/blocus-chatroom";
}

// Database connection and errors displaying.
$conn = mysqli_connect($hostname, $username, $password, $dbname);
if(!$conn){
  echo "Database connection error".mysqli_connect_error();
}

// Special chars escaping.
function sec($data){
  $data = trim($data);
  $data = stripslashes($data);  
  $data = strip_tags($data);
  return $data;
}

// END

?>

