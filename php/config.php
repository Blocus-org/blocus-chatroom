<?php
  
  $admin_interface = true;
  $admin_username = "Zqfd";

  $hostname = "localhost";
  $username = "zqfd";
  $password = "AFozeRZ82199";
  $dbname = "blocus_chat_db";

  $conn = mysqli_connect($hostname, $username, $password, $dbname);
  if(!$conn){
    echo "Database connection error".mysqli_connect_error();
  }

  function sec($data){
    $data = trim($data);
    $data = stripslashes($data);  
    $data = strip_tags($data);
    return $data;
  }
?>

