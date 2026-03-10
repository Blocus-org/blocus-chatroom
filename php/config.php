<?php
  $hostname = "localhost";
  $username = "zqfd";
  $password = "AFozeRZ82199";
  $dbname = "blocus_chat_db";

  $conn = mysqli_connect($hostname, $username, $password, $dbname);
  if(!$conn){
    echo "Database connection error".mysqli_connect_error();
  }
?>

