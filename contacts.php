<?php 
  session_start();
  include_once "php/config.php";
  if(!isset($_SESSION['unique_id'])){
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
            if(mysqli_num_rows($sql) > 0){
              $row = mysqli_fetch_assoc($sql);
            }
          ?>
          <a href="dashboard" class="dashboard-btn">Dashboard</a>
        </div>
        <a href="php/logout?logout_id=<?php echo $row['unique_id']; ?>" class="logout"><p>Logout</p></a>
        <script src="javascript/toggle-theme.js"></script>
      </header>

      <br><div><p>Not available in <?= $app_version?>, work in progress<p></div>
        
    </section>
<?php
  include 'footer.php';
?>
  </div>
  <script src="javascript/users.js"></script>
</body>
</html>