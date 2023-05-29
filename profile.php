<?php

session_start();
include("classes/connect.php");
include("classes/login.php");
include("classes/user.php");

if (isset($_SESSION['username'])) {
  $username = $_SESSION['username'];
} else {
  header("Location: login.php");
  die;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Spotlight</title>
  <link rel="stylesheet" href="profilestyle.css">
</head>

<body>
  <!-- Header start -->
  <header>
    <div class="header__left">
      <div class="logo">
        <img src="Logo.png" alt="SPOTLIGHT" height="50px" width="50px">
      </div>
    </div>
    <div class="header__middle">
      <div class="search_input">
        <input type="text" placeholder="Search Spotlight" />
        <span class="icon"> <ion-icon name="search-circle"></ion-icon> </span>
      </div>
    </div>
    <div class="header__right">
      <span class="icon"><ion-icon name="person-circle-outline"></ion-icon></span>
      <button onclick="location.href = 'logout.php';" class="btnLogout-popup">Logout</button>
    </div>
  </header>
  <!-- Header end --><!-- Cover start --><!-- top cover area -->
  <br>
  <div class="cover">
    <div class="cover_img">
      <img src="mountain.jpg" alt="COVER" style="width:100%">
      <img class="profile_pic" src="selfie.jpg" alt="DP">
      <br>
      <div style="font-size: 20px">
        <?php echo $username ?>
      </div>
      <br>
      <div class="menu_buttons">Feed</div>
      <div class="menu_buttons">About</div>
      <div class="menu_buttons">Clubs</div>
      <div class="menu_buttons">Photos</div>
      <div class="menu_buttons">Settings</div>
    </div>
    <!-- bottom cover area -->
    <div class="feed">
      <!-- clubs -->
      <div class="sidebar">
        <div class="clubs_bar">
          CLUBS<br>
          <div class="clubs">
            <img class="clubs_img" src="user1.jpg" alt="Club1"><br>
            Club 1
          </div>
          <div class="clubs">
            <img class="clubs_img" src="user2.jpg" alt="Club2"><br>
            Club 2
          </div>
          <div class="clubs">
            <img class="clubs_img" src="user3.jpg" alt="Club3"><br>
            Club 3
          </div>
          <div class="clubs">
            <img class="clubs_img" src="user4.jpg" alt="Club4"><br>
            Club 4
          </div>

        </div>

      </div>
      <!-- posts  area-->
      <div class="content">
        <div style="border: solid thin #aaa; padding: 10px; background-color: white;">
          <textarea placeholder="What on your mind?"></textarea>
          <input class="post_button" type="submit" value="Post">
          <br><br>
        </div>
        <!-- Posts -->
        <div class="post_bar">
          <!-- post 1 -->
          <div class="post">
            <div>
              <img src="user1.jpg" style="width: 75px; margin-right: 4px;">
            </div>
            <div>
              <div style="font-weight: bold; color: #405d9b ">Club 1</div>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis ab enim facere pariatur quibusdam
              veniam accusantium dolores assumenda laboriosam ex perspiciatis magnam debitis, quas harum dicta, aliquam
              velit tempora officia.
              <br><br>
              <a href="">Like </a>. <a href="">Comment</a>. <a href="">Register</a> . <span style="color: #999">May 25
                2023</span>
            </div>
          </div>
          <!-- post 2 -->
          <div class="post">
            <div>
              <img src="user4.jpg" style="width: 75px; margin-right: 4px;">
            </div>
            <div>
              <div style="font-weight: bold; color: #405d9b ">Club 2</div>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis ab enim facere pariatur quibusdam
              veniam accusantium dolores assumenda laboriosam ex perspiciatis magnam debitis, quas harum dicta, aliquam
              velit tempora officia.
              <br><br>
              <a href="">Like </a>. <a href="">Comment</a>. <a href="">Register</a> . <span style="color: #999">May 25
                2023</span>
            </div>
          </div>
          <!-- post 3 -->
          <div class="post">
            <div>
              <img src="user3.jpg" style="width: 75px; margin-right: 4px;">
            </div>
            <div>
              <div style="font-weight: bold; color: #405d9b ">Club 3</div>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis ab enim facere pariatur quibusdam
              veniam accusantium dolores assumenda laboriosam ex perspiciatis magnam debitis, quas harum dicta, aliquam
              velit tempora officia.
              <br><br>
              <a href="">Like </a>. <a href="">Comment</a>. <a href="">Register</a> . <span style="color: #999">May 25
                2023</span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Cover end -->

    <script src="script.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>