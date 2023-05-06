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
          <a href="dashboard.php" class="dashboard-btn">Dashboard</a>
        </div>
        <a href="php/logout.php?logout_id=<?php echo $row['unique_id']; ?>" class="logout"><p>Logout</p></a>
        <script src="javascript/toggle-theme.js"></script>
      </header><br>
      <div class="privacy-div">
        <p>Any questions about this privacy policy?<br>Contact us at <a class="privacy-p-link" href="mailto:blocus-org@proton.me"><?= $admin_mail?></a></p>
        <br><h1>Privacy policy</h1><br>
        <h3>Data you provide directly</h3><br>
        <p class="privacy-p">Username, password, and image are stored by the server, to save your session settings.</p><br>
        <p class="privacy-p">Password is encrypted in database, as no one can access it. If you lose it, you will not be able to access you account no more.</p><br>
        <p class="privacy-p">We do not sell data to anyone as we do not collect anything.</p><br>
        <h3>Cookies</h3><br>
        <p class="privacy-p">There is no third party cookies on this website.</p><br>
        <p class="privacy-p">There is necessary cookies for this website to work properly, store your theme preferences and your session(s) token(s).</p><br>
        <p>No personal data is stored in your browser.</p><br>
        <h3>Messages</h3><br>
        <p class="privacy-p">Message are encrypted with a SHA256 key to protect your privacy into the database.</p><br>
        <p class="privacy-p">Messages are deleted after 24h.</p><br>
        <p class="privacy-p">When you delete a message or if a message is deleted automaticly, it will be deleted from the database, there is no way to get it back.</p><br>
        <h3>Removal of data</h3><br>
        <p class="privacy-p">To remove data stored in your browser, you can use your browser's cookie-related controls to delete the data.</p><br>
        <p class="privacy-p">To remove data that has been stored in the website's database, you can use the "Wipe account and data" button in your dashboard.</p>
      </div>
    </section>
<?php
  include 'footer.php';
?>
  </div>
  <script src="javascript/users.js"></script>
</body>
</html>