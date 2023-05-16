<?php
  // Update.php alpha-1.1 --WIP Feel free to report any issues at https://github.com/Blocus-org/blocus-chatroom/issues or at blocus-org@proton.me
  //
  // /!\ WARNING SENSIBLE DATA use with caution and remove the file after use!!
  // This file only check if everything is ok (at this time), it will soon connect to the official repository to update automaticly.
  // You can choose the repo in php/config.php, this file can be modified to fit other projetcts!
  //
  // @Blocus-org
  // @Zqfd
  // AGPL-v3.0-or-later

  session_start();
  $version = "alpha-1.1.4";
  define("Path_to_config", "php/config.php");
  $test = file_get_contents(Path_to_config);

  // Advice
  echo "update.php $version. for Debian 11 Bullseye<br><br>Feel free to report any issues at 
    <a href='https://github.com/Blocus-org/blocus-chatroom/issues'>
    the blocus-chatroom official repository</a> or at 
    <a href='mailto:blocus-org@proton.me'>blocus-org@proton.me</a><br><br>
    <span style='color:Red;'>
    <br>PLEASE REMOVE THIS FILE FROM YOUR SERVER WHEN YOU ARE DONE!!<br></span><br>";
  echo '<h3>Checking requirements...</h3>';

  // Check PHP version
  $php_version=phpversion();

  if ((int) $php_version < 7) {
    $php_error = " ☒ PHP version checked: --------  
    <span style='color:Red;'>$php_version - too old! You need PHP 7.0 or later.</span><br>";
    echo $php_error;
  }else {
    $php_error = false;
    echo " ☑ PHP version checked: -------- 
    <span style='color:green;'>". $php_version ." - OK</span><br>";
  }

  // Check read and permission on config file
  if (!$test) {
    $php_error = " ☒ Checked read permission on config.php: --------  
      <span style='color:Red;'>Cannot read config file... Please check files permissions (read and write permission for 
        wwww-data on full website)</span><br>";
    echo $php_error;
  }else {
    $filecontent = $test;
    $filecontent_backup = $test;
    $pos = strpos($filecontent, '$balise');
    $data = "\$write_permission_test = 'success'; //Generated by update.php DO NOT MODIFY";
     echo " ☑ Checked read permission on config.php: --------
      <span style='color:green;'>Read - OK</span><br>";
    if (file_put_contents(Path_to_config, $filecontent)) {
      file_put_contents(Path_to_config, $filecontent_backup);
      echo " ☑ Checked write permission on config.php: --------
       <span style='color:green;'>Write - OK</span><br>";
    }else {
      $php_error = " ☒ Checked write permission on config.php: --------
        <span style='color:Red;'>Cannot write config file... Please check files permissions (read and write permission for wwww-data on full website)</span><br>";
      echo $php_error;
    }
  }

if (!$php_error) {
  include_once 'php/config.php';
}

  // Check if mysql is installed
  if (!extension_loaded('mysqli')) {
    $mysql_error = " ☒ PHP mysqli extension checked: --------
      <span style='color:Red;'>mysqli extension must be installed</span><br>";
    echo $mysql_error;
  }else {
    echo " ☑ PHP mysqli extension checked: -------- 
    <span style='color:green;'> Enabled - OK</span><br>";
  }

  // Check the connection to the database, and returns version
  function find_SQL_Version() {
    global $mysql_error;
    if (!$mysql_error) {
      global $conn;
      if (!$conn) {
        $mysql_error = " ☒ MySQL connection checked: --------  
        <span style='color:Red;'>Unable to connect to the database.</span><br>";
        echo $mysql_error;
      }else {
        $mysql_error = false;
        echo " ☑ MySQL connection checked: --------  
        <span style='color:Green;'>Connected - OK</span><br>";
        $mysql_version = mysqli_get_server_info($conn);
        return $mysql_version;
      }
    }
  }

  // Check MySQL version
  $mysql_version = find_SQL_Version();
  if (!empty($mysql_version)) {
    if ((int) $mysql_version<8) {
        if ($mysql_version==-1) {
          $mysql_error=" ☒ MySQL version checked: --------  
          <span style='color:Red;'>$mysql_version - too old! You need MySQL 8.0 or later</span><br>";
          echo $mysql_error;
        }else { $mysql_error=" ☒ MySQL version checked: --------  
        <span style='color:Red;'>$mysql_version - too old! You need MySQL 8.0 or later.</span><br>";
        echo $mysql_error;
      }
    }else {
      $mysql_error = false;
      echo  " ☑ MySQL version checked: -------- 
      <span style='color:Green;'>". $mysql_version ." - OK</span><br>";
    }
  }

  // Check if sessions are enabled
  $_SESSION['myscriptname_sessions_work']=1;
  if (empty($_SESSION['myscriptname_sessions_work'])) {
    $session_error=" ☒ Sessions checked: -------- 
    <span style='color:Red;'>Sessions disabled, Please enable sessions in php.ini.</span><br>";
    echo $session_error;
  }else {
    $session_error = false;
    echo " ☑ Sessions checked: -------- 
    <span style='color:green;'>Enabled - OK</span><br>";
  }

  // Display the admin account creation form
  if (!$php_error && !$mysql_error && !$session_error) {
    if ($admin_interface === true && !isset($admin_password) && !isset($admin_username) && !isset($admin_unique_id)) {
      echo '<br><br><span style="color:green;">Check successfull!</span><br><br> Please create an admin account:<br><br>
        <form action="#" method="POST" id="admin-form" class="admin-form">
          <input type="hidden" name="fname" class="fname" id="fname" value="somebody\'s first name">
          <input type="hidden" name="lname" class="lname" id="lname" value="somebody\'s last name">
          <label for "admin-username">Username</label><br> 
          <input type="text" name="admin-username" class="admin-username" id="admin-username"><br><br>
          <label for ="admin-passwd">Password (more than 10 characters)</label><br>
          <input type="password" name="admin-passwd" class="admin-passwd" id="admin-passwd"><br><br>
          <input type="submit" value="Send">
        </form>';
    }else {
      echo '<br><br><span style="color:green;">Check successfull!<br><br> Admin interface is set up on "'.$admin_interface.'", you can change settings in php/config.php.</a></span><br>';
    }
  }else {
    echo '<br><br><span style="color:red;">Check failed... <a href="update.php">check again</a></span> ';
  }

  // Create admin account and writing php/config.php
  if (isset($_POST['admin-username']) && isset($_POST['admin-passwd'])) {
    if (!empty($_POST['admin-username']) && !empty($_POST['admin-passwd']) && $_POST['admin-username'] !== '' && $_POST['admin-passwd'] !== '') {
      if (strlen($_POST['admin-passwd']) >= 10) {
        $last_activity = time();
        $ran_id = rand(time(), 100000000);
        $fname = mysqli_real_escape_string($conn, sec($_POST['fname']));
        $lname = mysqli_real_escape_string($conn, sec($_POST['lname']));
        $unencrypted_password = sec($_POST['admin-passwd']);
        $username = sec($_POST['admin-username']);
        $password = password_hash($unencrypted_password, PASSWORD_DEFAULT);
        $filecontent = file_get_contents('php/config.php');
        $pos = strpos($filecontent, '$admin_mail');
        $status = "Active now";
        $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$username}'");
        $data1 = "\$admin_password = '$unencrypted_password'; //Generated by update.php DO NOT MODIFY";
        $data2 = "\$admin_username = '$username'; //Generated by update.php DO NOT MODIFY";
        if (mysqli_num_rows($sql) > 0) {
            echo '<span style="color:red;">'. $username .' - This username already exist!</span>';
        }else {
          if (!isset($admin_password) && !isset($admin_username) && !isset($admin_unique_id)) {
            $filecontent = substr($filecontent, 0, $pos)."".$data1."\r\n".substr($filecontent, $pos);
            $filecontent = substr($filecontent, 0, $pos)."".$data2."\r\n".substr($filecontent, $pos);
          }else {
            die();
          }
          $sql2 = mysqli_query($conn, "INSERT INTO users (unique_id, fname, lname, email, password, img, status, last_activity) VALUES ({$ran_id}, '{$fname}','{$lname}', '{$username}', '{$password}', 'admin.png', '{$status}', '{$last_activity}')");
          if ($sql2) {
            $select_sql2 = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$username}'");
            if (mysqli_num_rows($select_sql2) > 0) {
                $result = mysqli_fetch_assoc($select_sql2);
                $_SESSION['unique_id'] = $result['unique_id'];
                $admin_unique_id = $_SESSION['unique_id'];
                $data3 = "\$admin_unique_id = '$admin_unique_id'; //Generated by update.php DO NOT MODIFY";
                $filecontent = substr($filecontent, 0, $pos)."".$data3."\r\n".substr($filecontent, $pos);
                file_put_contents("php/config.php", $filecontent);
                echo '<span style="color:green;">Success!<br><br> Your are logged as admin: '. $username .' <a href="index.php">Go to app -></a></span';
                header("location: update.php");
            }
          }
        }
      }else {
        echo '<span style="color:red;">Password must be larger than 10 characters for the admin account!</span>';
      }
    }else {
      echo '<span style="color:red;">All input fields are required!</span>';
    }
  }
?>
