<?php 
  include_once "php/config.php";
  ini_set('session.cookie_lifetime', 60 * 60 * 24 * 100);
  ini_set('session.gc_maxlifetime', 60 * 60 * 24 * 100);
  session_start();
  if(isset($_SESSION['unique_id'])){
    header("location: users.php");
  };
  include_once "header.php";
?>
<body>
  <div class="wrapper">
    <section class="form signup">
      <header>Sign up<script src="javascript/toggle-theme.js"></script></header>
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
          <label>Choose a username *</label>
          <input type="text" name="email" placeholder="Any username" required>
        </div>
        <div class="field input">
          <label>Password *</label>
          <input type="password" name="password" placeholder="Enter new password" required>
          <i class="fas fa-eye"></i>
        </div>
        <div class="field image">
          <p>Choose a profile image (optional)<p>
          <label class="image-subission-button" >Browse...
            <input id="image-subission-input"class="image-subission-input" type="file" name="image" accept="image/x-png ,image/jpeg,image/jpg">
          </label><span id="file-chosen">No files.</span>
        </div>
        <div class="field button">
          <input type="submit" name="submit" value="Continue to Chat">
        </div>
      </form>
      <div class="link">Already signed up? <a class="login-link" href="login.php">Login now</a></div>
    </section>
<?php
  include 'footer.php';
?>
  </div>
  <script src="javascript/pass-show-hide.js"></script>
  <script src="javascript/signup.js"></script>
  <script type="text/javascript">
    const actualBtn = document.getElementById('image-subission-input');
    const fileChosen = document.getElementById('file-chosen');

    actualBtn.addEventListener('change', function(){
      fileChosen.textContent = 'Profile image: ' + this.files[0].name
    })
  </script>
</body>
</html>
