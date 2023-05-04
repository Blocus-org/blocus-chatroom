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
        <script src="javascript/toggle-theme.js"></script>
      </header>
      <div class="dashboard">
        <p class="text">Dashboard-beta (1.0.0)</p><br>
        <ul class="dashboard-list">
          <a href='users.php'><li class="dashboard-list-line">Chat with somone </li></a><br>
          <li class="dashboard-list-line">Switch theme <input class="toggle_box" type="button" onclick="toggleTheme()" id="slider"></li>
        </ul>
      </div>
      <div class="users-list">
  
      </div>
    </section>
  </div>


</body>
</html>
