<?php 
  session_start();
  include_once "php/config.php";
  if (!isset($_SESSION['unique_id'])) {
    header("location: login");
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
          <a href="dashboard" class="dashboard-btn">Dashboard</a>
        </div>
        <a href="php/logout?logout_id=<?= $row['unique_id']; ?>" class="logout">Logout</a>
        <script src="javascript/toggle-theme.js"></script>
      </header>
      <div class="search">
        <span class="text">Select an user to start chat</span>
        <input type="text" placeholder="Enter name to search...">
        <button><img class="dash-icon" src="php/images/icons/search.png" alt="search icon"></button>
      </div>
      <div class="users-list">
      </div>
    </section>
<?php
  include_once 'footer.php';
?>
  </div>
  <script src="javascript/users.js"></script>
</body>
</html>
