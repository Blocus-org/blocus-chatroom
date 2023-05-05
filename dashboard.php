<?php 
  session_start();
  include_once "php/config.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  } 
include_once "header.php"; ?>
<body>
  <div class="wrapper">
    <section class="users">
      <header>
        <div class="content">
          <?php 
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
            if(mysqli_num_rows($sql) > 0){
              $row = mysqli_fetch_assoc($sql);
            }
          ?>
          <img src="php/images/<?php echo $row['img']; ?>" alt="">
          <div class="details">
            <span><?php echo $row['email']?></span>
            <p><?php echo $row['status']; ?></p>
          </div>
        </div>
        <a href="php/logout.php?logout_id=<?php echo $row['unique_id']; ?>" class="logout">Logout</a>
      </header>
      <div class="dashboard">
      <br>
        <ul class="dashboard-list">
          <li class="dashboard-list-line" onclick="location.href = 'users.php'"><img class="dash-icon" src="icons/icon.png"> <p>Chat with somone</p></li><br>
          <li class="dashboard-list-line" onclick="location.href = 'contacts.php'"><img class="dash-icon" src="icons/contacts.png"><p>Contacts</p></li><br>
          <li class="dashboard-list-line" onclick="location.href = 'php/settings.php'"><img class="dash-icon" src="icons/settings.png"><p>Settings</p></li><br>
          <li class="dashboard-list-line" onclick="toggleTheme()" id="slider"><img class="dash-icon" src="icons/themes.png"><p>Theme (Light - Dark)</p></li><br>
          <li class="dashboard-list-line" onclick="location.href = 'php/wipe-account.php'"><img class="dash-icon" src="icons/wipe.png"><p>Wipe account and data</p></li><br>
        </ul>
      </div>
      <div class="users-list">
      </div>
    </section>
<?php
include 'footer.php';
?>
  </div>
  <script src="javascript/toggle-theme.js"></script>
</body>
</html>
