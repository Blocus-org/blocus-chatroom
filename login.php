<?php 
  include_once "php/config.php";
  ini_set('session.cookie_lifetime', 60 * 60 * 24 * 100);
  ini_set('session.gc_minlifetime', 60 * 60 * 24 * 100);
  session_start();
  if(isset($_SESSION['unique_id'])){
    header("location: dashboard");
  }
  include_once "header.php"; 
?>
<body>
  <div class="wrapper">
    <section class="form login">
      <header>Login</header>
      <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="error-text"></div>
        <div class="field input">
          <label>Username</label>
          <input type="text" name="email" placeholder="Enter your username" required>
        </div>
        <div class="field input">
          <label>Password</label>
          <input class="passwd" type="password" name="password" placeholder="Enter your password" required>
          <div class="show-hide">
            <span class="eye-leg"><p id="eye"><img class="dash-icon" src="php/images/icons/eye.png"></p>
          </div>
        </div>
        <div class="field button">
          <input class ='logout'type="submit" name="submit" value="Continue to Chat">
        </div>
      </form>
      <div class="link">Not yet signed up? <a class="signup-link" href="index">Signup now</a></div>
    </section>
<?php
  include 'footer.php';
?>
  </div>
  </div>
  <script src="javascript/pass-show-hide.js"></script>
  <script src="javascript/login.js"></script>
</body>
</html>
