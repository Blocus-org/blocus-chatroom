<?php 
  session_start();
  include_once "php/config.php";
  if (!isset($_SESSION['unique_id'])) {
    header("location: login");
  }elseif ($_SESSION['unique_id'] === $admin_unique_id && $admin_interface === true) {
    header("location:admin/data-proc");
  }
include_once "header.php"; ?>
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
          <img src="php/images/<?php echo $row['img']; ?>" alt="">
          <div class="details">
            <span><?php echo $row['email']?></span>
            <p><?php echo $row['status']; ?></p>
          </div>
        </div>
        <a href="php/logout?logout_id=<?php echo $row['unique_id']; ?>" class="logout">Logout</a>
      </header>
      <div class="dashboard">
        <ul class="dashboard-list">
          <li class="dashboard-list-line" onclick="location.href = 'users'">
            <img class="dash-icon" src="php/images/icons/icon.png" alt="dasboard icon"> <p>Chat with someone</p>
          </li><br>
          <li class="dashboard-list-line" onclick="location.href = 'contacts'">
            <img class="dash-icon" src="php/images/icons/contacts.png" alt="dasboard icon"><p>Contacts</p>
          </li><br>
          <li class="dashboard-list-line" onclick="location.href = 'settings'">
            <img class="dash-icon" src="php/images/icons/settings.png" alt="dasboard icon"><p>Settings</p>
          </li><br>
          <li class="dashboard-list-line" onclick="toggleTheme()" id="slider">
            <img class="dash-icon" src="php/images/icons/themes.png" alt="dasboard icon"><p>Theme (Light - Blocus)</p>
          </li><br>
          <li class="dashboard-list-line" onclick="location.href = 'wipe'">
            <img class="dash-icon" src="php/images/icons/wipe.png" alt="dasboard icon"><p>Delete account and data</p>
          </li><br>
          <li class="dashboard-list-line" onclick="location.href = 'privacy-policy'">
            <img class="dash-icon" src="php/images/icons/privacy.png" alt="dasboard icon"><p>Privacy policy</p></a>
          </li>
        </ul>
      </div>
      <div class="users-list">
      </div>
    </section>
<?php
  include_once 'footer.php';
?>
  </div>
  <script src="javascript/toggle-theme.js"></script>
</body>
</html>
