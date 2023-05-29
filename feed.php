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
            <button onclick="location.href = 'login.php';" class="btnLogout-popup">Logout</button>
        </div>
    </header>
    <!-- Header end -->
    <!-- Cover start -->
    <div class="cover">
        <!-- below cover area -->
        <div class="feed">
            <!-- Clubs area-->
            <div class="sidebar">
                <div class="clubs_bar" style="text-align: center; font-size: 20px; color: #405d9b; background: transparent;">
                    <img src="selfie.jpg" style="width: 150px; border-radius: 50%; border: solid 2px white;box-shadow: -49px -47px 131px -28px rgba(255,255,255,0.8);">
                    <br>
                    Marry Banda

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
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis ab enim facere pariatur
                            quibusdam
                            veniam accusantium dolores assumenda laboriosam ex perspiciatis magnam debitis, quas harum
                            dicta, aliquam
                            velit tempora officia.
                            <br><br>
                            <a href="">Like </a>. <a href="">Comment</a>. <a href="">Register</a> . <span
                                style="color: #999">May 25 2023</span>
                        </div>
                    </div>
                    <!-- post 2 -->
                    <div class="post">
                        <div>
                            <img src="user4.jpg" style="width: 75px; margin-right: 4px;">
                        </div>
                        <div>
                            <div style="font-weight: bold; color: #405d9b ">Club 2</div>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis ab enim facere pariatur
                            quibusdam
                            veniam accusantium dolores assumenda laboriosam ex perspiciatis magnam debitis, quas harum
                            dicta, aliquam
                            velit tempora officia.
                            <br><br>
                            <a href="">Like </a>. <a href="">Comment</a>. <a href="">Register</a> . <span
                                style="color: #999">May 25 2023</span>
                        </div>
                    </div>
                    <!-- post 3 -->
                    <div class="post">
                        <div>
                            <img src="user3.jpg" style="width: 75px; margin-right: 4px;">
                        </div>
                        <div>
                            <div style="font-weight: bold; color: #405d9b ">Club 3</div>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis ab enim facere pariatur
                            quibusdam
                            veniam accusantium dolores assumenda laboriosam ex perspiciatis magnam debitis, quas harum
                            dicta, aliquam
                            velit tempora officia.
                            <br><br>
                            <a href="">Like </a>. <a href="">Comment</a>. <a href="">Register</a> . <span
                                style="color: #999">May 25 2023</span>
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