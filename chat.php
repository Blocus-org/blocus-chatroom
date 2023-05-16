<?php 
  session_start();
  include_once "php/config.php";
  if (!isset($_SESSION['unique_id'])) {
    header("location: login");
  }
?>
<?php include_once "header.php"; ?>
<body>
  <div class="wrapper">
    <section class="chat-area">
      <header>
        <?php 
          $user_id = mysqli_real_escape_string($conn, sec($_GET['user_id']));
          $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$user_id}");
          if (mysqli_num_rows($sql) > 0) {
            $row = mysqli_fetch_assoc($sql);
          }else {
            header("location: users");
          }
          if (isset($_GET['delete_message']) && !empty($_GET['delete_message'])) {
            if ($_GET['user_id'] == $row['unique_id']) {
              $msg = mysqli_real_escape_string($conn, sec($_GET['delete_message']));
              $sql = mysqli_query($conn, "DELETE FROM messages WHERE msg_id = {$msg}");
            }
          }
          if (isset($_GET['nuke_conv']) && !empty($_GET['nuke_conv']) && $_GET['nuke_conv'] == "true") {
            if ($_GET['user_id'] == $row['unique_id']) {
              $outgoing_id = $_SESSION['unique_id'];
              $incoming_id = mysqli_real_escape_string($conn, sec($_GET['user_id']));
              $sql = mysqli_query($conn,
                "DELETE FROM messages WHERE (outgoing_msg_id =
                {$outgoing_id} and incoming_msg_id = {$incoming_id}) or (outgoing_msg_id =
                {$incoming_id} and incoming_msg_id = {$outgoing_id})"
              );
            }
          }
        ?>
        <a href="users" class="backicon">←</a>
        <img src="php/images/<?php echo $row['img']; ?>" alt="">
        <div class="details">
          <span><?php echo $row['email']; ?></span>
          <p><?php echo $row['status']; ?></p>
        </div>
        <div id="nuke"class="nuke">
            <img
              id="nuke-img"
              class="dash-icon nuke-img"
              src="php/images/icons/nuke.png"
              alt="nuke icon"
              onclick="location.href = 'chat?user_id=<?= sec($user_id)?>&nuke_conv=true'"
            >
        </div>
      </header>
      <p id="chatbox-scroll-mode" class="chatbox-scroll-mode"></p>
      <div class="chat-box">
      </div>
      <form action="#" class="typing-area">
        <input type="text" class="incoming_id" name="incoming_id" value="<?= $user_id; ?>" hidden>
        <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
        <button><img class="send_img" src="php/images/icons/send.png" alt="send"></button>
      </form>
    </section>
  </div>

  <script src="javascript/chat.js"></script>

</body>
</html>
