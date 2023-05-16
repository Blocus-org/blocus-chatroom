<?php
  session_start();
  include_once "../php/config.php";
  if (!isset($_SESSION['unique_id'])) {
    header("location:../login");
  }elseif (!isset($admin_unique_id) && !isset($admin_username) && !isset($admin_password) OR $admin_interface === false) {
    if ($_SESSION['unique_id'] !== $admin_unique_id) {
      header("location:../dashboard");
    }else {
    echo "Admin interface is disabled. Take a look to php/config.php to manage admin interface.<br><a href='../dashboard'>go back to dashboard</a>";
    }
    die();
  }elseif ($_SESSION['unique_id'] !== $admin_unique_id) {
    header("location:../dashboard");
  }?>
  <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Blocus - ChatRoom</title>
  <link rel="stylesheet" href="../style.css">
  <link rel="icon" type="image/x-icon" href="../php/images/icons/icon.png">
  <script src="../javascript/toggle-theme.js"></script>
</head>
<body>
  <div class="wrapper">
    <section class="users">
      <header>
        <div class="content">
<?php
  $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
  if (mysqli_num_rows($sql) > 0) {
    $row = mysqli_fetch_assoc($sql);
  }
?>
          <img src="../php/images/<?php echo $row['img']; ?>" alt="">
          <div class="details">
            <span><?php echo $row['email']?></span>
            <p><?php echo $row['status']; ?></p>
          </div>
        </div>
        <a href="../php/logout?logout_id=<?php echo $row['unique_id']; ?>" class="logout">Logout</a>
      </header>
      <div class="dashboard">
        <ul class="dashboard-list">
          <h1>Admin interface</h1><br><br>
          <li class="dashboard-list-line" onclick="location.href = '../users'">
            <img class="dash-icon" src="../php/images/icons/icon.png" alt="dasboard icon"> <p>Chat with someone</p>
          </li><br>
          <li class="dashboard-list-line" onclick="location.href = '../contacts'">
            <img class="dash-icon" src="../php/images/icons/contacts.png" alt="dasboard icon"><p>Contacts</p>
          </li><br>
          <li class="dashboard-list-line" onclick="location.href = 'user-manager'">
            <img class="dash-icon" src="../php/images/icons/user.png" alt="dasboard icon"><p>Manage users</p>
          </li><br>
          <li class="dashboard-list-line" onclick="location.href = 'database'">
            <img class="dash-icon" src="../php/images/icons/database.png" alt="dasboard icon"><p>Manage database</p></a>
          </li><br>
          <li class="dashboard-list-line" onclick="toggleTheme()" id="slider">
            <img class="dash-icon" src="../php/images/icons/themes.png" alt="dasboard icon"><p>Theme (Light - Blocus)</p>
          </li><br>
        </ul>
      </div>
      <div class="users-list">
      </div>
    </section>
<?php
  include_once '../footer.php';
?>
  </div>
</body>
</html>
