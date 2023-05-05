<?php

  // CONFIG

  // Admin config (WIP coming soon):
  $admin_interface = true;
  $admin_username = "";
  $admin_password = "";

  // Footer config:
  $app_name = "Blocus-chatroom";
  $app_version = "beta-2.0.0";
  $source_url = "";

  // Database config:
  $hostname = "localhost";
  $username = "";
  $password = "";
  $dbname = "blocus_chat_db";

  // END

  // FUNCTIONS

  // Set link to source code
  if($source_url != ""){
    $source_code = $source_url;
  }else{
    $source_code = "https://github.com/Blocus-org/blocus-chatroom";
  }

  // Database connection and error displaying
  $conn = mysqli_connect($hostname, $username, $password, $dbname);
  if(!$conn){
    echo "Database connection error".mysqli_connect_error();
  }

  // Special chars escaping
  function sec($data){
    $data = trim($data);
    $data = stripslashes($data);  
    $data = strip_tags($data);
    return $data;
  }

  // END
?>

