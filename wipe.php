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
        <a href="php/logout?logout_id=<?= $row['unique_id']; ?>" class="logout"><p>Logout</p></a>
        <script src="javascript/toggle-theme.js"></script>
      </header>
      <div class="wipe-account-div">
        <ul class="are-you-sure-list">
          <li class="are-you-sure-list"><p>If you delete your account you will not be able to recover your data.<br><br> Are you sure?</p></li><br>
        </ul>
        <ul>
          <a href="php/wipe?delete_account=<?= $_SESSION['unique_id']?>"><li class="are-you-sure-list">Yes</li></a>
          <a href="dashboard.php"><li class="are-you-sure-list">No</li></a>
       <ul/>
      </div>
    </section>
<?php
  include_once 'footer.php';
?>
  </div>
  <script src="javascript/users.js"></script>
</body>
</html>