<?php
include('server.php')
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spotlight</title>
    <link rel="stylesheet" href="styleL.css">
</head>

<body>
    <header>
        <div class="logo">
            <img src="Logo.png" alt="SPOTLIGHT" height="40px" width="40px">
        </div>
        <nav class="navigation">
            <a href="#">Home</a>
            <a href="#">About</a>
            <a href="#">Services</a>
            <a href="#">Contact</a>
        </nav>
    </header>
    <div class="wrapper-login">
        <div class="form-box">
            <h2>Login</h2>
            <form method="post" action="login.php">
                <?php include('errors.php'); ?>
                <div class="input-box">
                    <span class="icon"><ion-icon name="person"></ion-icon></span>
                    <input name="username" type="username" required name="email">
                    <label>Username</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                    <input name="password" type="password" required name="pass">
                    <label>Password</label>
                </div>
                <button type="submit" class="btn" name="login_user">Login</button>
                <div class="login-register">
                    <p>Don't have an account? <a href="signup.php" class="register-link">Register</a></p>
                </div>
            </form>
        </div>
    </div>


    <script src="script.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>




