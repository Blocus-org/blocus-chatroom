<?php 
  session_start();

  include_once "../php/config.php";
  
  if (!isset($_SESSION['unique_id'])) {
    header("location:../login"); 
  }elseif (!isset($admin_unique_id) && 
    !isset($admin_username) && !isset($admin_password) || $admin_interface === false) {
    if ($_SESSION['unique_id'] !== $admin_unique_id) {
      header("location:../dashboard");
    }else {
    echo "Admin interface is disabled. Take a look to php/config.php to manage admin interface.
    <br><a href='../dashboard.php'>go back to dashboard</a>";
    }
    die();
  }elseif ($_SESSION['unique_id'] !== $admin_unique_id) {
    header("location:../dashboard");
  }

  $alert_box = "";

  if (!isset($_GET['delete_user']) && !empty($_GET['delete_user'])) {
    $accout_to_delete = mysqli_real_escape_string($conn, sec($_GET['delete_user']));
    $sql = "";
  }
?>
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
          <a href="../dashboard" class="dashboard-btn">Dashboard</a>
        </div>
        <a href="../php/logout?logout_id=<?php echo $row['unique_id']; ?>" class="logout">Logout</a>
      </header>
      <br><p class="use"><a href="user-manager">
        <img class="dash-icon nuke-img" src="../php/images/icons/refresh.png" alt="refresh icon"></a></p><br>
        <p>
          <span style="color:red;">Wanring</span>: Deleting an account is definitive!</p><br>
      <p><?= $alert_box; ?></p>
      <div class="users-list">

      </div>
    </section>
<?php
  include_once '../footer.php';
?>
  </div>
  <script type="text/javascript">
const usersList = document.querySelector(".users-list")

const refreshList = () =>{
  let xhr = new XMLHttpRequest()
  xhr.open("GET", "users", true)
  xhr.onload = ()=>{
    if(xhr.readyState === XMLHttpRequest.DONE){
        if(xhr.status === 200){
          let data = xhr.response
            usersList.innerHTML = data
          
        }
    }
  }
  xhr.send()
}

refreshList()
  </script>
</body>
</html>
