<?php 
  include_once "php/config.php";
  ini_set('session.cookie_minlifetime', 60 * 60 * 24 * 100);
  ini_set('session.gc_maxlifetime', 60 * 60 * 24 * 100);
  session_start();
  if(isset($_SESSION['unique_id'])){
    header("location: dashboard");
  };
  include_once "header.php";
?>
<body>
  <div class="wrapper">
    <section class="form signup">
      <header>Sign up</header>
      <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="error-text"></div>
        <div class="name-details">
          <div class="field input">
            <input type= "hidden" value= "somebody's first name" name="fname" placeholder="First name" required>
          </div>
          <div class="field input">
            <input type="hidden" value="somebody's last name" name="lname" placeholder="Last name" required>
          </div>
        </div>
        <div class="field input">
        <?php
          if(isset($_GET['bye']) && !empty($_GET['bye']) && $_GET['bye'] == 'true'){
            echo '<p class="bye">Data deleted successfully.<br><br> Delete browser cookies to remove all preferences.</p><p><br>';
          }
        ?>
          <label>Choose a username *</label></p>
          <input type="text" name="email" placeholder="Any username" required>
        </div>
        <div class="field input">
          <label>Password *</label>
          <input class="passwd" type="password" name="password" placeholder="Enter new password" required>
          <div class="show-hide">
            <span class="eye-leg"><p id="eye"><img class="dash-icon" src="php/images/icons/eye.png"></p>
          </div>
        <div class="field image">
          <p><br>Choose a profile image (optional)<p>
          <label class="image-subission-button" >Browse...
            <input id="image-subission-input"class="image-subission-input" type="file" name="image" accept="image/x-png ,image/jpeg,image/jpg">
          </label><span id="file-chosen">No files.</span>
        </div>
        <div class="field button">
          <input type="submit" name="submit" value="Continue to Chat">
        </div>
      </form>
      <div class="link">Already signed up? <a class="login-link" href="login">Login now</a></div>
    </section>
<?php
  include 'footer.php';
?>
  </div>
  <script src="javascript/pass-show-hide.js"></script>
  <script src="javascript/signup.js"></script>
  <script type="text/javascript">

  </script>
</body>
</html>
